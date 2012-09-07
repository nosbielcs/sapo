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
include("../../../classes/atividade.php");
include("../../../classes/atividade_arquivo.php");
include("../../../classes/atividade_usuario.php");
include("../../../classes/evento.php");
include("../../../classes/usuario.php");
include("../../../classes/recado.php");
include("../../../classes/upload.php");
include("../../../funcoes/funcoes.php");

$acao = $_POST["acao"];

if (!empty($acao))
{
	$pagina = $_POST["pagina"];
	$qtd_listagem = $_POST["quantidade"];
	$ordem = $_POST["ordem"];
	$filtro = $_POST["filtro"];
	$url = "pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordem."&filtro=".$filtro."#topo";
	
	$cod_atividade = explode(";", $_POST["cod_atividade"]);
	$cod_atividade = $cod_atividade[0];
	$titulo_atividade = $_POST["titulo_atividade"];
	$descricao = $_POST["descricao"];
	$remove_anexos = $_POST["cod_arquivos"];

	$total_anexos = $_POST["total_anexo"];
	$valor = $_POST["valor"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$data_atividade = date("Y-m-d");
	$hora_atividade = date("H:i:s");
	$dia_entrega = $_POST["dia"];
	$mes_entrega = $_POST["mes"];
	$ano_entrega = $_POST["ano"];
	$hora_entrega = $_POST["hora"];
	$minuto_entrega = $_POST["minuto"];
	$data_entrega = $ano_entrega."-".$mes_entrega."-".$dia_entrega;
	$hora_entrega = $hora_entrega.":".$minuto_entrega.":00";
	$cod_turma = $_SESSION["cod_turma"];
	$codigos_atividades = explode(";", $_POST["codigos_atividades"]);
	$valida = 0;
	
	if ($acao == "anexar_arquivo")
	{
		$cod_atividade = $_POST["cod_atividade"];
		$descricao = $_POST["descricao_arquivo"];
		$cod_usuario = $_POST["cod_usuario"];
		$data_entrega = date("Y-m-d");
		$hora_entrega = date("H:i:s");
		$cod_turma = $_SESSION["cod_turma"];
		
		$diretorio_atividade = $_SESSION["dir_atividades"].$cod_atividade."/";
		$diretorio_atividade = verificaDiretorio($diretorio_atividade);
		$diretorio_atividade_alunos = $diretorio_atividade."alunos/";
		$diretorio_atividade_alunos = verificaDiretorio($diretorio_atividade_alunos);
		$diretorio_atividade_usuario = verificaDiretorio($diretorio_atividade_alunos.$cod_usuario."/");
		$upload = new Upload($HTTP_POST_FILES);
		$upload->maxupload_size = (($_SESSION["QUOTA"]/10)*4);
		$nome_arquivo = $upload->getFilename("arquivo_atividade_usuario");
		
		if (!$upload->save($diretorio_atividade_usuario, "arquivo_atividade_usuario", true, 0755))
		{
			$valida = 1;
			$acao.= ($i + 1).";".$nome_arquivo.";upload;";	
		}
		else
		{
			$atividade_usuario = new atividade_usuario();
			$atividade_usuario->carregar($cod_atividade, $cod_usuario);
			$existe = $atividade_usuario->linhas;
			
			if ($existe > 0)
			{
				$atividade_usuario->setDescricao($descricao);				
				$atividade_usuario->setAnexo($nome_arquivo);
				$atividade_usuario->setDataEntrega($data_entrega);
				$atividade_usuario->setHoraEntrega($hora_entrega);
				$atividade_usuario->alterarAnexo($cod_atividade, $cod_usuario);
			}
			else
			{			
				$atividade_usuario->setCodigoAtividade($cod_atividade);
				$atividade_usuario->setCodigoUsuario($cod_usuario);
				$atividade_usuario->setNota("");
				$atividade_usuario->setComentario("Não Corrigida");
				$atividade_usuario->setDescricao($descricao);				
				$atividade_usuario->setAnexo($nome_arquivo);
				$atividade_usuario->setDataEntrega($data_entrega);
				$atividade_usuario->setHoraEntrega($hora_entrega);
				$atividade_usuario->setDataCorrecao("0000-00-00");
				$atividade_usuario->setHoraCorrecao("0000-00-00");
				$atividade_usuario->setSituacao("A");
				$atividade_usuario->inserir();
			}
			
			$acao = "anexar_atividade";
		}
	}
	else
		if ($acao == "excluir_anexo_aluno")
		{
			$cod_aluno = $_POST["cod_aluno"];
					
			$atividade_usuario = new atividade_usuario();
			$atividade_usuario->carregar($cod_atividade, $cod_aluno);
			$existe = $atividade_usuario->linhas;
			$arquivo_usuario = $atividade_usuario->getAnexo();
			
			$diretorio_atividade = $_SESSION["dir_atividades"].$cod_atividade."/";
			$diretorio_atividade = verificaDiretorio($diretorio_atividade);
			$diretorio_atividade_alunos = $diretorio_atividade."alunos/";
			$diretorio_atividade_alunos = verificaDiretorio($diretorio_atividade_alunos);
			$diretorio_atividade_usuario = verificaDiretorio($diretorio_atividade_alunos.$cod_aluno."/");
		
			if (unlink($diretorio_atividade_usuario.$arquivo_usuario))
				$atividade_usuario->excluir($cod_atividade, $cod_aluno);
		}
		else
		{
			//Verifica os Arquivos
			if ($total_anexos > 0)
			{
				$diretorio = $_SESSION["dir_atividades"];
				$upload = new Upload($HTTP_POST_FILES);
				$quota_turma = tamanhoDiretorio($diretorio, "");
				$upload->maxupload_size = (($_SESSION["QUOTA"]/10)*4);
				$valida = 0;
				
				//Verifica se a QUOTA da Turma é suficiente para os novos Arquivos
				for ($i = 0; $i < $total_anexos; $i++)
				{
					$input_anexo = "anexo_".($i + 1);
					$total = $total + $upload->getFileSize($input_anexo);
				}
				$total = $total + $quota_turma;
				
				if ($total > $_SESSION["QUOTA"])
				{
					$valida = 1;
					$acao = "quota";
				}
				else
					$valida = 0;
				
				if ($valida == 0)
				{
					
					for ($i = 0; $i < $total_anexos; $i++)
					{
						$nome_arquivo = $upload->getFilename($input_anexo);
						
						//verifica a quota
						if (($total = $quota_turma + $upload->getFileSize($input_anexo)) > $_SESSION["QUOTA"])
						{
							$valida = 1;
							$acao = "quota";
						}
						else
							if ( ($upload->getFileMimeType($input_anexo) != "text/xml") and 
								 ($upload->getFileMimeType($input_anexo) != "text/html") and 
								 ($upload->getFileMimeType($input_anexo) != "text/plain") and
								 ($upload->getFileMimeType($input_anexo) != "text/richtext") and 
								 ($upload->getFileMimeType($input_anexo) != "application/pdf") and
								 ($upload->getFileMimeType($input_anexo) != "application/zip") and
								 ($upload->getFileMimeType($input_anexo) != "application/vnd.ms-excel") and
								 ($upload->getFileMimeType($input_anexo) != "application/vnd.ms-powerpoint") and
								 ($upload->getFileMimeType($input_anexo) != "application/msword") )
							{
								$valida = 1;
								$acao = "tipo";
							}
							else
								//verifica o tamanho maximo de upload
								if ($upload->getFileSize($input_anexo) >= $upload->maxupload_size)
								{
									$valida = 1;
									$acao = "tamanho";
								}
								else
									//verifica se o arquivo existe
									if (file_exists($diretorio.$nome_arquivo))
									{
										$valida = 1;
										$acao = "existe";				
									}
					}
				}
				else
					$acao = "quota";
			}
			
			if ($valida == 0)
			{
				//Instancia objeto atividade
				$atividade = new atividade();
				
				switch($acao)
				{
					case "novo":
						$atividade->setCodigoTurma($cod_turma);
						$atividade->setCodigoUsuario($cod_usuario);
						$atividade->setAtividade($titulo_atividade);
						$atividade->setDescricao($descricao);
						$atividade->setValor($valor);
						$atividade->setDataAtividade($data_atividade);
						$atividade->setHoraAtividade($hora_atividade);
						$atividade->setDataEntrega($data_entrega);
						$atividade->setHoraEntrega($hora_entrega);
						$atividade->inserir();
						
						$atividade->recuperaCodigo();
						$cod_atividade = $atividade->getCodigo();
						
						//Cadastra Evento de Entrega da Atividade
						$evento = new evento();
						$evento->setCodigoTurma($cod_turma);
						$evento->setCodigoUsuario($cod_usuario);
						$evento->setAssunto("Entrega de Atividade");
						$evento->setDescricao("Data de Entrega da Atividade \"$titulo_atividade\"");
						$evento->setDataEvento($data_entrega);
						$evento->setHora($hora_entrega);
						$evento->setTipo("A");
						$evento->setSituacao("A");
						$evento->inserir();
						
						$cod_evento = $evento->recuperaCodigo();
						
						$atividade->ligaAtividadeEvento($cod_atividade, $cod_evento);
						$acao = "novo";
					break;
					
					case "editar":
						$atividade->setCodigoUsuario($cod_usuario);
						$atividade->setAtividade($titulo_atividade);
						$atividade->setDescricao($descricao);
						$atividade->setValor($valor);
						$atividade->setDataEntrega($data_entrega);
						$atividade->setHoraEntrega($hora_entrega);
						$atividade->alterar($cod_atividade, $cod_turma);
						$acao = "editar";
						
						$cod_evento = $atividade->recuperaCodigoEvento($cod_atividade);
				
						$evento = new evento();
						$evento->alterarDataHora($cod_evento, $data_entrega, $hora_entrega);
					break;
					
					case "corrigir":
						$cod_autor = $_SESSION["cod_usuario"];
						$cod_aluno = $_POST["cod_aluno"];
						$nota = $_POST["nota_atividade"];
						$comentario = $_POST["comentario_atividade"];
						$data_correcao = date("Y-m-d");
						$hora_correcao = date("H:i:s");
						$situacao = $_POST["situacao_atividade"];
						
						$atividade_usuario = new atividade_usuario();
						$atividade_usuario->carregar($cod_atividade, $cod_aluno);
						$existe = $atividade_usuario->linhas;
						
						$atividade_usuario->setNota($nota);
						$atividade_usuario->setComentario($comentario);
						$atividade_usuario->setDataCorrecao($data_correcao);
						$atividade_usuario->setHoraCorrecao($hora_correcao);
						$atividade_usuario->setSituacao($situacao);
						
						if ($existe > 0)
						{
							$atividade_usuario->alterarComentario($cod_atividade, $cod_aluno);
							$atividade_usuario->alterarNota($cod_atividade, $cod_aluno);
						}
						else
						{
							$atividade_usuario->setCodigoAtividade($cod_atividade);
							$atividade_usuario->setCodigoUsuario($cod_aluno);
							$atividade_usuario->setDataEntrega("0000-00-00");
							$atividade_usuario->setHoraEntrega("0000-00-00");
							$atividade_usuario->inserir();
						}
						
						switch($situacao)
						{
							case "C":
								$situacao = "Corrigido";
							break;
							
							case "R":
								$situacao = "Refazer";
							break;
						}
						
						$usuario = new usuario();
						$usuario->carregar($cod_aluno);
						$nome_usuario = $usuario->getNome();
										
						$assunto = "Informativo SA²pO: Correção de Atividade";
						$mensagem.= "  Prezado(a) <b>".$nome_usuario."</b>,\n\n";
						$mensagem.= "sua Atividade foi corrigida, verifique os dados a seguir:\n\n";
						$mensagem.= "Nota: <b>".$nota."</b>\n";
						$mensagem.= "Comentário: <b>".$comentario."</b>\n";
						$mensagem.= "Data de Correção: <b>".formataData($data_correcao, "/")."</b>\n";
						$mensagem.= "Hora de Correção: <b>".substr($hora_correcao, 0 , 5)."</b>\n";
						$mensagem.= "Situacao: <b>".$situacao."</b>\n\n";
						$mensagem.= "Esta mensagem foi gerada automaticamente e é regida pela Política de Privacidade dos Usuários do SA²pO - Sistema de Apoio a Aprendizagem Online";
						
						$recado = new recado();
						$data_recado = date("Y-m-d");
						$hora_recado = date("H:i:s");
						$recado->setCodigoAutor($cod_autor);
						$recado->setAssunto($assunto);
						$recado->setDestinatario($cod_aluno.";");
						$recado->setMensagem($mensagem);
						$recado->setDataRecado($data_recado);
						$recado->setHora($hora_recado);
						$recado->inserir();
						
						$recado->recuperaCodigo();
						$cod_recado = $recado->getCodigo();
						
						$recado->recadoDestinatario($cod_recado, $cod_aluno, $cod_turma, "E", "N");
						
						$acao = "corrigir";
					break;
					
					case "excluir":
						$arquivos = new atividade_arquivo();
						//$arquivo = new atividade_arquivo();
						$total = sizeof($codigos_atividades);
						
						for ($i = 0; $i < $total; $i++)
						{
							if ($codigos_atividades[$i] != "")
							{
								$arquivos->colecao($codigos_atividades[$i]);
								$total_arquivos = $arquivos->linhas;
								$arquivos->data["cod_arquivo"];
														
								if ($total_arquivos > 0)
								{
									$diretorio_atividade = $_SESSION["dir_atividades"].$codigos_atividades[$i]."/";
									/*for ($j = 0; $j < $total_arquivos; $j++)
									{
										$diretorio_atividade = $_SESSION["dir_atividades"].$codigos_atividades[$i]."/";
										$cod_arquivo = $arquivos->data["cod_arquivo"];
										$arquivo->carregar($cod_arquivo);
										$nome_arquivo = $arquivo->getNome();
										unlink($diretorio_atividade.$nome_arquivo);  
										$arquivo->excluir($cod_arquivo);
										$arquivos->proximo();
									}*/
									rmdir($diretorio_atividade);
								}
								//else
								//rmdir($diretorio_atividade);
		
								$atividade->excluir($codigos_atividades[$i], $cod_turma);
								/*$cod_evento = $atividade->recuperaCodigoEvento($codigos_atividades[$i]);
								
								if (!empty($cod_evento))
								{
									$atividade->excluirVinculoAtividadeEvento($codigos_atividades[$i], $cod_evento);
									$evento = new evento();
									$evento->excluir($cod_evento, $cod_turma);
								}*/
							}
						}
						
						$acao = "excluir";
					break;
				}
				
				if ($remove_anexos != "")
				{
					$arquivo = new atividade_arquivo();
					$diretorio_atividade = $_SESSION["dir_atividades"].$cod_atividade."/";
					$anexos = explode(";", $remove_anexos);
					$total = sizeof($anexos);
					
					for ($i = 0; $i < $total; $i++)
					{
						if ($anexos[$i] != "")
						{
							$cod_arquivo = $anexos[$i];
							$arquivo->carregar($cod_arquivo);
							$nome_arquivo = $arquivo->getNome();
							unlink($diretorio_atividade.$nome_arquivo);
							$arquivo->excluir($cod_arquivo);					
						}
					}
				}
			
				if ($total_anexos > 0)
				{
					$diretorio_atividade = $_SESSION["dir_atividades"].$cod_atividade."/";
					verificaDiretorio($diretorio_atividade);
					$valida = 0;
					
					$arquivo = new atividade_arquivo();
					
					for ($i = 0; $i < $total_anexos; $i++)
					{
						$input_anexo = "anexo_".($i + 1);
						$input_descricao = "descr_anexo_".($i + 1);
						$nome_arquivo = $upload->getFilename($input_anexo);
						$descricao = $_POST[$input_descricao];
						$tamanho = $upload->getFileSize($input_anexo);
						$tipo = $upload->getFileMimeType($input_anexo);
						
						$arquivo->setCodigoAtividade($cod_atividade);
						$arquivo->setNome($nome_arquivo);
						$arquivo->setDescricao($descricao);
						$arquivo->setTamanho($tamanho);
						$arquivo->setTipo($tipo);
						$arquivo->inserir();
						
						//verifica se o arquivo existe
						if (!$upload->save($diretorio_atividade, $input_anexo, true, 0700))
						{
							$valida = 1;
							$acao = "upload";				
						}
					}
					
					if ($valida == 0)
						$acao = "novo";
					else
						$acao = "erro_anexo";
				}
			}
		}
		
		// echo $acao;
		switch($acao)
		{
			case "novo":
				$_SESSION["mensagem_atividade"] = "Atividade Cadastrada com Sucesso!";
				header("Location: index.php?".$url);
			break;
			
			case "editar":
				$_SESSION["mensagem_atividade"] = "Alterações Realizadas com Sucesso!";
				header("Location: index.php?".$url);
			break;
			
			case "excluir":
				$_SESSION["mensagem_atividade"] = "Atividade(s) Removida(s) com Sucesso!";
				header("Location: index.php?".$url);
			break;
			
			case "corrigir":
				$_SESSION["mensagem_atividade"] = "Atividade Corrigida com Sucesso!";
				header("Location: visualiza.php?cod_atividade=".$cod_atividade."&".$url);
			break;
			
			case "anexar_atividade":
				$_SESSION["mensagem_atividade"] = "Arquivo Anexado com Sucesso!";
				header("Location: visualiza.php?cod_atividade=".$cod_atividade."&".$url);
			break;
			
			case "excluir_anexo_aluno":
				$_SESSION["mensagem_atividade"] = "Arquivo Removido com Sucesso!";
				header("Location: visualiza.php?cod_atividade=".$cod_atividade."&".$url);
			break;
			
			case "":
				$_SESSION["mensagem_atividade"] = "";
				header("Location: .php");
			break;
			
			case "":
				$_SESSION["mensagem_atividade"] = "";
				header("Location: .php");
			break;
			
			case "":
				$_SESSION["mensagem_atividade"] = "";
				header("Location: .php");
			break;
			
			case "":
				$_SESSION["mensagem_atividade"] = "";
				header("Location: .php");
			break;
		}
}
?>