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
include("../../../classes/forum.php");
include("../../../classes/mensagem_forum.php");
include("../../../classes/usuario.php");

if ($_POST["acao"])
	$acao = $_POST["acao"];

if ($acao)
{
	$cod_forum = $_POST["cod_forum"];
	
	if ($_POST["codigosForum"])
		$codigos = explode(";", $_POST["codigosForum"]);
	else
		$codigos = explode(";", $cod_forum);

	if ($_POST["cod_mensagem"])
		$cod_mensagem = $_POST["cod_mensagem"];
	else
		if ($_GET["cod_mensagem"])
			$cod_mensagem = $_GET["cod_mensagem"];
			
	if ($_POST["pagina"])
		$pagina = $_POST["pagina"];
	else
		$pagina = 1;
			
	if ($_POST["quantidade"])
		$quantidade = $_POST["quantidade"];
	else
		$quantidade = 5;
			
	if ($_POST["ordem"])
		$ordem = $_POST["ordem"];
	else
		$ordem = 1;

	$url = "?pag=".$pagina."&qtd=".$quantidade."&ordem=".$ordem;
			
	$cod_turma = $_SESSION["cod_turma"];
	$assunto = $_POST["assunto"];
	$msg = $_POST["mensagem"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$situacao = "A";
	$data_forum = date("Y-m-d");
	$hora_forum = date("H:i:s");
	$listagem = 10;

	//Instancia objeto forum
	$forum = new forum();
	$mensagem = new mensagem_forum();
	
	switch($acao)
	{
		case "novo_forum":
			$forum->setCodigoUsuario($cod_usuario);
			$forum->setCodigoTurma($cod_turma);
			$forum->setAssunto($assunto);
			$forum->setMensagem($msg);
			$forum->setDataForum($data_forum);
			$forum->setHora($hora_forum);
			$forum->setSituacao($situacao);
			$forum->setVisualizacoes(0);
			$forum->inserir();
			$_SESSION["mensagem_forum"] = "Tópico cadastrado com sucesso!";	
			
			$forum->acessoForum($cod_forum, $cod_usuario);
		break;
		
		case "editar_forum":
			$forum->setCodigoEditor($cod_usuario);
			$forum->setDataEdicao($data_forum);
			$forum->setHoraEdicao($hora_forum);
			$forum->setAssunto($assunto);
			$forum->setMensagem($msg);
			$forum->alterar($cod_forum, $cod_turma);
			$acao = "msg";
			$_SESSION["mensagem_forum"] = "Alterações realizadas com sucesso!";	
			
			$forum->excluiAcessoForum($cod_forum);
			$forum->acessoForum($cod_forum, $cod_usuario);
		break;
		
		case "excluir_forum":
			$total = sizeof($codigos);
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigos[$i] != "")
				{
					//$mensagem->excluirMensagensForum($codigos[$i]);
					$forum->excluir($codigos[$i], $cod_turma);
					//$forum->excluiAcessoForum($codigos[$i]);
				}
			}
			$acao = "forum";
			$_SESSION["mensagem_forum"] = "Tópico(s) excluído(s) com sucesso!";	
		break;
		
		case "nova_msg":
			$mensagem->setCodigoForum($cod_forum);	
			$mensagem->setCodigoUsuario($cod_usuario);
			$mensagem->setAssunto($assunto);
			$mensagem->setMensagem($msg);
			$mensagem->setDataMensagem($data_forum);
			$mensagem->setHora($hora_forum);
			$mensagem->setSituacao("A");
			$mensagem->inserir();
			
			$forum->excluiAcessoForum($cod_forum);
			$forum->acessoForum($cod_forum, $cod_usuario);
			$acao = "msg";
			
			$_SESSION["mensagem_forum"] = "Mensagem cadastrada com sucesso!";
		break;
		
		case "editar_msg":
			$mensagem->setCodigoEditor($cod_usuario);
			$mensagem->setDataEdicao($data_forum);
			$mensagem->setHoraEdicao($hora_forum);
			$mensagem->setAssunto($assunto);
			$mensagem->setMensagem($msg);
			$mensagem->alterar($cod_mensagem);
			$forum->excluiAcessoForum($cod_forum);
			$acao = "msg";
			
			$_SESSION["mensagem_forum"] = "Alterações realizadas com sucesso!";	
		break;
		
		case "excluir_msg":
			$mensagem->excluir($cod_mensagem);
			$acao = "msg";
			
			$_SESSION["mensagem_forum"] = "Mensagem excluída com sucesso!";	
		break;
	}
	
	
	switch($acao)
	{
		case "msg":
			$forum->totalMensagens($cod_forum);
			$linhas = $forum->linhas;
			
			if ($linhas != 0)
			{
				$total_paginas = ceil($linhas / $listagem);
						 
				if ($acao == "msg")
					$url.= "&cod_forum=".$cod_forum."&pag=".$total_paginas."#ultimaMensagem";
				else
					$url.= "&cod_forum=".$cod_forum;
			}
			else
			{
				if ($acao == "msg")
					$url.= "&cod_forum=".$cod_forum."#ultimaMensagem";
				else
					$url.= "&cod_forum=".$cod_forum;
			}
			
			header("Location: visualiza.php".$url);
		break;
		
		case "forum":
			header("Location: index.php".$url);
		break;
		
		case "novo_forum":
			$cod_forum = $forum->recuperaCodigo();
			header("Location: visualiza".$url."&cod_forum=".$cod_forum);
		break;
	}
}
?>