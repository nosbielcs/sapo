<?php
/*
=====================================================================
#  PROJETO: Sa²po                                                   #
#  FUNCAÇÃO ECUMÊNICA DE PROTEÇÃO AO EXCEPCIONAL                    #
#                                                                   #
#  Programação                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

session_start();

include("../../../config/session.lib.tutor.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/usuario.php");
include("../../../classes/conteudo.php");
include("../../../classes/conteudo_usuario.php");
include("../../../classes/upload.php");
include("../../../funcoes/funcoes.php");

ini_set("upload_max_filesize", $_SESSION["UPLOAD_MAXIMO"]);

$acao = $_POST["acao"];

if (!empty($acao))
{
	if ($_POST["tipo_conteudo"])
		$tipo_conteudo = $_POST["tipo_conteudo"];
	else
		$tipo_conteudo = $_POST["tipo_conteudo_"];
	
	$cod_conteudo = $_POST["cod_conteudo"];
	$descricao_conteudo = $_POST["descricao_conteudo"];
	$conteudo_protegido = $_POST["protegido"];
	$conteudo_principal = $_POST["principal"];
	$cod_hierarquia = $_POST["hierarquia_conteudo"];
	
	if ($conteudo_protegido == "sim")
		$protegido = "S";
	else
		$protegido = "N";
		
	if ($conteudo_principal == "sim")
		$conteudo_principal = "S";
	else
		$conteudo_principal = "N";
	
	$total_anexos = $_POST["total_anexo"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$data_conteudo = date("Y-m-d");
	$hora_conteudo = date("H:i:s");
	$cod_turma = $_SESSION["cod_turma"];
	$codigos_conteudos = explode(";", $_POST["codigos_conteudos"]);
	$valida = true;
	
	$pagina = $_POST["pagina"];
	$qtd_listagem = $_POST["quantidade"];
	$ordenacao = $_POST["ordenacao"];
	$url = "pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;
	
	//Altera Permissões do Conteúdo aos Usuários da Turma
	if ($acao == "conteudo_permissoes")
	{
		if ($_POST["cod_conteudo"])
		{
			$codigo = $_POST["cod_conteudo"];
			$conteudo_permissao = new conteudo();
			$conteudo_permissao->carregar($codigo);
			$tipo_conteudo = $conteudo_permissao->getTipo();
			$nome_conteudo = $conteudo_permissao->getNome();
			
			switch($tipo_conteudo)
			{
				case "html":
					$diretorio_conteudo = $_SESSION["dir_html"];
					$nome_arquivo = str_replace(" ", "_", $nome_conteudo);
				break;
				
				case "doc":
					$diretorio_conteudo = $_SESSION["dir_doc"];
					$nome_conteudo = str_replace(".doc","", $nome_conteudo);
					$nome_arquivo = str_replace(" ", "_", $nome_conteudo);
				break;
				
				case "powerpoint":
					$diretorio_conteudo = $_SESSION["dir_ppt"];
					$nome_conteudo = str_replace(".ppt","", $nome_conteudo);
					$nome_conteudo = str_replace(".pps","", $nome_conteudo);
					$nome_arquivo = str_replace(" ", "_", $nome_conteudo);
				break;
				
				case "pdf":
					$diretorio_conteudo = $_SESSION["dir_pdf"];
					$nome_conteudo = str_replace(".pdf","", $nome_conteudo);
					$nome_arquivo = str_replace(" ", "_", $nome_conteudo);
				break;
			}
		}
		
		$codigos_permissao = explode(";", $_POST["codigos_permissao"]);
		$total_permissoes = sizeof($codigos_permissao);
	
		$usuarios = new usuario();
		$usuarios->colecaoUsuarioTurma($cod_turma, "L", "");
		
		$total_usuarios = $usuarios->linhas;
		
		//Diretório e arquivo que define os acessos
		$arquivo = $diretorio_conteudo.$nome_arquivo."/.htpasswd";
			
		for ($i = 0; $i < $total_usuarios; $i++)
		{
			$cod_usuario = $usuarios->data["cod_usuario"];
			
			$usuario = new usuario();
			$usuario->carregar($cod_usuario);
			$login_usuario = $usuario->getLogin();
			$senha_usuario = $usuario->getSenha();
			$achou = "false";
			
			for ($j = 0; $j < $total_permissoes; $j ++)
			{
				if (($codigos_permissao[$j] != "") and ($codigos_permissao[$j] == $cod_usuario))
				{
					$usuario_conteudo = new conteudo_usuario();
					$usuario_conteudo->carregar($cod_conteudo, $cod_usuario);
					$acesso = $usuario_conteudo->getAcesso();
					
					if ($acesso == "")
					{
						$acesso = "P";
						$usuario_conteudo->setCodigoConteudo($codigo);
						$usuario_conteudo->setCodigoUsuario($cod_usuario);
						$usuario_conteudo->setCodigoTurma($cod_turma);
						$usuario_conteudo->setAcesso($acesso);
						$usuario_conteudo->inserir();
					}
						
					$usuario_conteudo->alterarAcesso($cod_conteudo, $cod_usuario, "P");
					
					if (!file_exists($arquivo))
					{
						exec("/usr/sbin/htpasswd2 -bc ".$arquivo." ".$_SESSION["login_usuario"]." '".$_SESSION["senha_usuario"]."'");
						exec("/usr/sbin/htpasswd2 -b ".$arquivo." ".$login_usuario." '".$senha_usuario."'");
					}
					else
					{
						exec("/usr/sbin/htpasswd2 -b ".$arquivo." ".$login_usuario." '".$senha_usuario."'");
					}
					
					$achou = "true";
				}
			}
			
			if ($achou == "false")
			{
				$usuario_conteudo = new conteudo_usuario();
				$usuario_conteudo->alterarAcesso($cod_conteudo, $cod_usuario, "N");
				exec("/usr/sbin/htpasswd2 -D ".$arquivo." ".$login_usuario);
			}
				
			$usuarios->proximo();
		}
		
		$_SESSION["mensagem_conteudo"] = "Permissões atualizadas com Sucesso!";
		header("Location: index.php?".$url);
		exit;
	}
	else
	{
		//Verifica os Arquivos
		if (($tipo_conteudo != "site") and ($acao == "novo"))
		{
			$upload = new Upload($HTTP_POST_FILES);

			switch($tipo_conteudo)
			{
				case "html":
					$diretorio_conteudo = $_SESSION["dir_html"];
					verificaDiretorio($diretorio_conteudo);
					$nome_conteudo = str_replace(".zip","", $upload->getFileName("nome_conteudo"));
					$arquivo_zip = str_replace(" ","\ ", $nome_conteudo).".zip";
					$nome_arquivo = str_replace(" ", "_", $nome_conteudo);
				break;
				
				case "doc":
					$diretorio_conteudo = $_SESSION["dir_doc"];
					verificaDiretorio($diretorio_conteudo);
					$nome_arquivo = str_replace(".doc","", $upload->getFileName("nome_conteudo"));
					$nome_conteudo = $upload->getFileName("nome_conteudo");
				break;
				
				case "powerpoint":
					$diretorio_conteudo = $_SESSION["dir_ppt"];
					verificaDiretorio($diretorio_conteudo);
					$nome_arquivo = str_replace(".ppt","", $upload->getFileName("nome_conteudo"));
					$nome_arquivo = str_replace(".pps","", $nome_arquivo);
					$nome_conteudo = $upload->getFileName("nome_conteudo");
				break;
				
				case "pdf":
					$diretorio_conteudo = $_SESSION["dir_pdf"];
					verificaDiretorio($diretorio_conteudo);
					$nome_arquivo = str_replace(".pdf","", $upload->getFileName("nome_conteudo"));
					$nome_conteudo = $upload->getFileName("nome_conteudo");
				break;
			}
			
			//Verifica Diretório de Conteúdo HTML	
			$diretorio_html = $_SESSION["dir_html"];
			$total_html = tamanhoDiretorio($diretorio_html, "");
			
			//Verifica Diretório de Conteúdo DOC	
			$diretorio_doc = $_SESSION["dir_doc"];
			$total_doc = tamanhoDiretorio($diretorio_doc, "");
			
			//Verifica Diretório de Conteúdo POWERPOINT
			$diretorio_ppt = $_SESSION["dir_ppt"];
			$total_ppt = tamanhoDiretorio($diretorio_ppt, "");
			
			//Verifica Diretório de Conteúdo PDF	
			$diretorio_pdf = $_SESSION["dir_pdf"];
			$total_pdf = tamanhoDiretorio($diretorio_pdf, "");
			
			//Total da Quota da Turma Somandos todos os Diretórios de Conteúdos
			$quote_turma = $total_html + $total_doc + $total_ppt + $total_pdf;
			
			//Tamanho Total do Upload, configuração da Turma
			$upload->maxupload_size = $_SESSION["UPLOAD_MAXIMO"];
			//echo $upload->getFileMimeType("nome_conteudo");exit;
		
			$tamanho_conteudo = $upload->getFileSize("nome_conteudo");
			$total = $total + $tamanho_conteudo;
			$total = $total + $quota_turma;

			if ($total > $_SESSION["QUOTA"])
			{
				$valida = false;
				$erro.= $nome_conteudo.";quota;";
				$acao = "erro_conteudo";
			}
			else
				if ( ($upload->getFileMimeType("nome_conteudo") == "") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/pdf") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/x-zip-compressed") and
					 ($upload->getFileMimeType("nome_conteudo") != 'application/zip') and
					 ($upload->getFileMimeType("nome_conteudo") != "application/vnd.ms-powerpoint") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/msword") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/vnd.openxmlformats-officedocument.presentationml.presentation") and
					 ($upload->getFileMimeType("nome_conteudo") != "application/octet-stream") )
				{
					$valida = false;
					$erro.= $nome_conteudo.";tipo;";
					$acao = "erro_conteudo";
				}
				else
					//verifica o tamanho maximo de upload
					if ($upload->getFileSize("nome_conteudo") >= $upload->maxupload_size)
					{
						$valida = false;
						$erro.= $nome_conteudo.";tamanho;";
						$acao = "erro_conteudo";
					}
					else
						//verifica se o arquivo existe
						if (file_exists($diretorio_conteudo.$nome_conteudo))
						{
							$valida = false;
							$erro.= $nome_conteudo.";existe;";
							$acao = "erro_conteudo";				
						}
		}
		else
			$nome_conteudo = validaWebSite($_POST["nome_conteudo"]);
		
		if ($valida)
		{
			//Instancia objeto conteudo
			$conteudo = new conteudo();
			
			switch($acao)
			{
				case "novo":
					$conteudo->setCodigoTurma($cod_turma);
					$conteudo->setCodigoUsuario($cod_usuario);
					$conteudo->setCodigoHierarquia($cod_hierarquia);
					if ($tipo_conteudo == "site")
					{
						$conteudo->setNome($nome_conteudo);
						$conteudo->setTamanho(0);	
					}
					else
						if ($tipo_conteudo == "html")
						{
							$conteudo->setNome($nome_arquivo);
							$conteudo->setTamanho($tamanho_conteudo);
						}
						else
						{
							$conteudo->setNome($nome_conteudo);
							$conteudo->setTamanho($tamanho_conteudo);
						}
					
					$conteudo->setDescricao($descricao_conteudo);
					$conteudo->setTipo($tipo_conteudo);
					$conteudo->setProtegido($protegido);
					$conteudo->setPrincipal($conteudo_principal);
					$conteudo->setDataConteudo($data_conteudo);
					$conteudo->setHoraConteudo($hora_conteudo);
					$conteudo->inserir();
					$acao = "novo";
				break;
				
				case "editar":
					$cod_conteudo = explode(";", $_POST["cod_conteudo"]);
					$cod_conteudo = $cod_conteudo[0];
					
					$conteudo->setCodigoTurma($cod_turma);
					$conteudo->setCodigoUsuario($cod_usuario);
					$conteudo->setCodigoHierarquia($cod_hierarquia);
					$conteudo->setDescricao($descricao_conteudo);
					$conteudo->setTipo($tipo_conteudo);
					$conteudo->setProtegido($protegido);
					$conteudo->setPrincipal($conteudo_principal);
					$conteudo->alterar($cod_conteudo, $cod_turma);
					$acao = "editar";
				break;
				
				case "excluir":
					$total = sizeof($codigos_conteudos);
					
					for ($i = 0; $i < $total; $i++)
					{
						if ($codigos_conteudos[$i] != "")
						{
							$cod_conteudo = $codigos_conteudos[$i];
							$conteudo->carregar($cod_conteudo);
							$nome_conteudo = $conteudo->getNome();
							$tipo_conteudo = $conteudo->getTipo();
							
							if ($tipo_conteudo != "site")
							{
								switch($tipo_conteudo)
								{
									case "html":
										$diretorio_conteudo = $_SESSION["dir_html"];
										$nome_conteudo = str_replace(".zip","", $nome_conteudo);
									break;
									
									case "doc":
										$diretorio_conteudo = $_SESSION["dir_doc"];
										$nome_conteudo = str_replace(".doc","", $nome_conteudo);
									break;
									
									case "powerpoint":
										$diretorio_conteudo = $_SESSION["dir_ppt"];
										$nome_conteudo = str_replace(".ppt","", $nome_conteudo);
										$nome_conteudo = str_replace(".pps","", $nome_conteudo);
									break;
									
									case "pdf":
										$diretorio_conteudo = $_SESSION["dir_pdf"];
										$nome_conteudo = str_replace(".pdf","", $nome_conteudo);
									break;
								}
								
								//$conteudo_usuario = new conteudo_usuario();
								//$conteudo_usuario->excluir($cod_conteudo, $cod_turma);
								excluirDiretorio($diretorio_conteudo.str_replace(" ", "_", $nome_conteudo)."/");
							}
													  
							$conteudo->excluir($cod_conteudo, $cod_turma);
						}
					}
					$acao = "excluir";
				break;
			}
				
			if (($tipo_conteudo != "site") and ($acao == "novo"))
			{		
				$valida = true;
				
				//Cria Diretório para o Conteúdo
				if ($tipo_conteudo != "html")
				{
					$destino = $diretorio_conteudo.str_replace(" ", "_", $nome_arquivo)."/";
					verificaDiretorio($destino);
				}
				else
					$destino = $diretorio_conteudo;
	
				//Verifica se fez o Download do Arquivo
				if (!$upload->save($destino, "nome_conteudo", true, 0777))
				{
						$valida = false;
						$erro.= $nome_conteudo.";upload;";
						
						if ($tipo_conteudo != "html")
							removerDiretorio($diretorio_conteudo.$nome_arquivo);
							
						$conteudo->recuperaCodigo();
						$cod_conteudo = $conteudo->getCodigo();
						$conteudo->excluir($cod_conteudo, $cod_turma);
				}
				else
				{
					if ($tipo_conteudo == "html")
					{
						$destino = $diretorio_conteudo.$nome_arquivo."/"; 
						exec("/usr/bin/unzip -d ".$diretorio_conteudo.$nome_arquivo."/ ".$diretorio_conteudo.$arquivo_zip);
						unlink($diretorio_conteudo.$nome_conteudo.".zip");
						$htpasswd = ".htpasswd";
					}
					
$apache_conf_conteudo = "
<Directory \"".$destino."\">
Options Indexes FollowSymLinks Includes MultiViews
AllowOverride AuthConfig
Order allow,deny
Allow from all
AuthUserFile ".$destino.".htpasswd
AuthGroupFile /dev/null
AuthName \"Acesso Restrito ao Conteúdo ".$nome_conteudo."\"
AuthType Basic
<Limit GET POST>
require valid-user
</Limit>
</Directory>
";
					$handle = fopen (APACHE_CONF, "a");
					fwrite($handle, $apache_conf_conteudo);
					fclose($handle);
					exec("/usr/sbin/htpasswd2 -bc ".$destino.".htpasswd ".$_SESSION["login_usuario"]." ".$_SESSION["senha_usuario"]);
					exec("/usr/bin/sudo /usr/sbin/httpd2 -k graceful");
				}
						
				if ($valida)
				{
					$conteudo->recuperaCodigo();
					$cod_conteudo = $conteudo->getCodigo();
					
					$tutores = new usuario();
					$tutores->colecaoUsuarioTurma($cod_turma, "T", "");
					$total_tutores = $tutores->linhas;
					
					for ($i = 0; $i < $total_tutores; $i++)
					{
						$cod_usuario = $tutores->data["cod_usuario"];
						$acesso = "P";
						$conteudo_usuario = new conteudo_usuario();
						$conteudo_usuario->setCodigoConteudo($cod_conteudo);
						$conteudo_usuario->setCodigoUsuario($cod_usuario);
						$conteudo_usuario->setCodigoTurma($cod_turma);
						$conteudo_usuario->setAcesso($acesso);
						$conteudo_usuario->inserir();
						$tutores->proximo();
					}
					
					$alunos = new usuario();
					$alunos->colecaoUsuarioTurma($cod_turma, "L", "");
					$total_alunos = $alunos->linhas;
					
					if (($conteudo_protegido == "sim") and ($tipo_conteudo != "site"))
						$acesso = "N";
					else
						$acesso = "P";
						
					for ($i = 0; $i < $total_alunos; $i++)
					{
						$cod_usuario = $alunos->data["cod_usuario"];
						$conteudo_usuario = new conteudo_usuario();
						$conteudo_usuario->setCodigoConteudo($cod_conteudo);
						$conteudo_usuario->setCodigoUsuario($cod_usuario);
						$conteudo_usuario->setCodigoTurma($cod_turma);
						$conteudo_usuario->setAcesso($acesso);
						$conteudo_usuario->inserir();
						$alunos->proximo();
					}
				}
				else
				{
					//echo "linha 474";//header("Location: mensagem.php?acao=erro_conteudo&erro_conteudo=".$erro);
					//exit;
				}
			}
			else
			{
				/*$_SESSION["mensagem_conteudo"] = "Conteúdo Cadastrado com Sucesso!";
				header("Location: index.php?".$url);
				exit;*/
			}
		}
		else
		{
			//echo "linha 487 ".$erro.$upload->getFileMimeType("nome_conteudo");//header("Location: mensagem.php?acao=".$acao."&erro_conteudo=".$erro." ");
			//exit;
		}
	}
	
	switch($acao)
	{
		case "novo":
			$_SESSION["mensagem_conteudo"] = "Conteúdo Cadastrado com Sucesso!";
			header("Location: index.php?".$url);
		break;
		
		case "editar":
			$_SESSION["mensagem_conteudo"] = "Alterações Realizadas com Sucesso!";
			header("Location: index.php?".$url);
		break;
		
		case "excluir":
			$_SESSION["mensagem_conteudo"] = "Conteúdo Excluído com Sucesso!";
			header("Location: index.php?".$url);
		break;
		
		case "erro_conteudo":
			$erro = explode(";", $erro);
			$total_erros = sizeof($erro);
			
			$mensagem.= "O(s) seguinte(s) problema(s) foi(ram) encontrado(s) ao Cadastrar o Novo Conteúdo:<br><br>";
			
			for ($i = 0; $i < $total_erros; $i++)
			{
				$erro_ = $erro[($i + 1)];
			
				if ($erro_ != "")
				{
					switch($erro_)
					{
						case "quota":
							$mensagem.= "- O Tamanho do Arquivo ultrapassa a Cota de Arquivos da Turma<br>";
						break;
						
						case "tipo":
							$mensagem.= "- O Tipo de Arquivo não é permitido ou não equivale ao Tipo selecionado<br>";
						break;
						
						case "tamanho":
							$mensagem.= "- O Tamanho do Arquivo ultrapassa o tamanho Máximo de 2 MB<br>";
						break;
						
						case "existe":
							$mensagem.= "- O Arquivo já existe no Sistema<br>";
						break;
					}
				}
			}
			
			$_SESSION["mensagem_conteudo"] = $mensagem;
			header("Location: index.php?".$url);
		break;
	}
}
else
{
	header("Location: index.php");
	exit;
}
?>