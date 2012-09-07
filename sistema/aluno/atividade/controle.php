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

include("../../../config/session.lib.aluno.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/atividade_usuario.php");
include("../../../classes/atividade.php");
include("../../../classes/recado.php");
include("../../../classes/usuario.php");
include("../../../classes/upload.php");
include("../../../funcoes/funcoes.php");

$acao_atividade_usuario = $_POST["acao_atividade_usuario"];
$cod_turma = $_SESSION["cod_turma"];

if ($acao_atividade_usuario)
{
	$cod_atividade = $_POST["cod_atividade"];
	$descricao = $_POST["descricao_arquivo"];
	$remove_anexos = $_POST["cod_arquivos"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$data_entrega = date("Y-m-d");
	$hora_entrega = date("H:i:s");
	$cod_turma = $_SESSION["cod_turma"];
	
	$diretorio_atividade = $_SESSION["dir_atividades"].$cod_atividade."/";
	$diretorio_atividade = verificaDiretorio($diretorio_atividade);
	$diretorio_atividade_alunos = $diretorio_atividade."alunos/";
	$diretorio_atividade_alunos = verificaDiretorio($diretorio_atividade_alunos);
	$diretorio_atividade_usuario = $diretorio_atividade_alunos.$cod_usuario."/";
	$upload = new Upload($HTTP_POST_FILES);
	$upload->maxupload_size = (($_SESSION["QUOTA"]/10)*4);
	$nome_arquivo = $upload->getFilename("arquivo_atividade_usuario");
	$valida = true;
	
	if ($valida)
	{					
		if ( ($upload->getFileMimeType("arquivo_atividade_usuario") != "text/xml") and 
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "text/html") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "text/plain") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "text/richtext") and 
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/pdf") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/zip") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/x-zip-compressed") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/save") and
			 ($upload->getFileMimeType("arquivo_atividade_usuario") != "application/msword") )
		{
			$valida = false;
			$acao = "tipo";
		}
		else
			//verifica o tamanho maximo de upload
			if ($upload->getFileSize("arquivo_atividade_usuario") >= $upload->maxupload_size)
			{
				$valida = false;
				$acao = "tamanho";
			}
			else
				//verifica se o arquivo existe
				if (file_exists($diretorio_atividade_usuario.$nome_arquivo))
				{
					$valida = false;
					$acao = "existe";				
				}
				else
				{
					verificaDiretorio($diretorio_atividade_usuario);
					
					if (!$upload->save($diretorio_atividade_usuario, "arquivo_atividade_usuario", true, 0700))
					{
						$valida = false;
						$acao = "upload";				
					}
				}
	}

	if ($valida)
	{
		//Instancia objeto atividade
		$atividade_usuario = new atividade_usuario();
		
		switch($acao_atividade_usuario)
		{
			case "responder":
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
				$acao = "responder";
				
				$atividade = new atividade();
				$atividade->carregar($cod_atividade);
				$nome_atividade = $atividade->getAtividade();
				
				$usuario = new usuario();
				$usuario->colecaoUsuarioTurma($cod_turma, "T", "");
				$total_usuario = $usuario->linhas;
								
				$assunto = "Informativo SA²pO: Atividade Entregue por ".$_SESSION["nome_usuario"];
				$mensagem = "  O usuário <b>".$_SESSION["nome_usuario"]."</b> anexou ao SA²pO um Arquivo referente ";
				$mensagem.= "a Atividade <b>".$nome_atividade."</b> e esta Aguardando Correção.\n\n";
				$mensagem.= "Arquivo: ".$nome_arquivo."\n";
				$mensagem.= "Descrição: ".$descricao."\n";
				$mensagem.= "Data de Entrega: ".formataData($data_entrega, "/")."\n";
				$mensagem.= "Hora de Entrega: ".substr($hora_entrega, 0 , 5)."\n\n";
				$mensagem.= "Esta mensagem foi gerada automaticamente e é regida pela Política de Privacidade dos Usuários do SA²pO - Sistema de Apoio a Aprendizagem Online";
				
				$recado = new recado();
				$data_recado = date("Y-m-d");
				$hora_recado = date("H:i:s");
				$recado->setCodigoAutor($cod_usuario);
				$recado->setAssunto($assunto);
				$pasta = "E";
				$situacao = "N";
			
				for ($i = 0; $i < $total_usuario; $i++)
				{
					$destinatarios.= $usuario->data["cod_usuario"].";";
				}
				
				$recado->setDestinatario($destinatarios);
				$recado->setMensagem($mensagem);
				$recado->setDataRecado($data_recado);
				$recado->setHora($hora_recado);
				$recado->inserir();
				
				$destinatarios = explode(";", $destinatarios);
				$total = sizeof($destinatarios);
				$recado->recuperaCodigo();
				$cod_recado = $recado->getCodigo();
				
				for ($i = 0; $i < $total; $i++)
				{
					if ($destinatarios[$i] != "")
					{
						$cod_destinatario = $destinatarios[$i];
						$recado->recadoDestinatario($cod_recado, $cod_destinatario, $cod_turma, $pasta, $situacao);
					}
				}
				
				$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
				
			break;
		}
	}
	
	switch($acao)
	{
		case "responder":
			$_SESSION["mensagem_atividade"] = "Atividade Entregue com Sucesso!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
		
		case "quota":
			$_SESSION["mensagem_atividade"] = "A Cota da Turma excedeu, por favor entre em contato com seu Tutor ou com o Suporte Técnico!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
		
		case "tipo":
			$_SESSION["mensagem_atividade"] = "Tipo de Arquivo Inválido! Por favor verifique as Extensões permitidas!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
		
		case "tamanho":
			$_SESSION["mensagem_atividade"] = "O Arquivo excedeu o Tamanho Máximo de 2 MegaBytes!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
		
		case "existe":
			$_SESSION["mensagem_atividade"] = "Arquivo Existente!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
		
		case "upload":
			$_SESSION["mensagem_atividade"] = "Problemas ao Enviar o Arquivo ao nosso Servidor, se o problema persistir entre em contato com o Suporte Técnico!";
			header("Location: visualiza.php?cod_atividade=".$cod_atividade);
		break;
	}
}
?>