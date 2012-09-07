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
include("../../../classes/edital.php");

$acao = $_POST["acao"];

if (!empty($acao))
{
	$cod_edital = $_POST["cod_edital"];
	$cod_turma = $_SESSION["cod_turma"];
	$usuario = $_SESSION["cod_usuario"];
	$assunto = $_POST["assunto"];
	$mensagem = $_POST["mensagem"];
	$data_edital = date("Y-m-d");
	$hora_edital = date("H:m:s");
	
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

	$url = "index.php?pag=".$pagina."&qtd=".$quantidade."&ordem=".$ordem;
	$situacao = "A";
	
	//Instancia objeto Edital
	$edital = new edital();
	switch($acao)
	{
		//Editar
		case "editar":
			$data_edital = date("Y-m-d");
			$hora_edital = date("H:m:s");
		
			$edital->setCodigoUsuario($usuario);
			$edital->setAssunto($assunto);
			$edital->setMensagem($mensagem);
			$edital->setDataEdital($data_edital);
			$edital->setHora($hora_edital);
			$edital->setSituacao($situacao);
			$edital->alterar($cod_edital);	
			
			$_SESSION["mensagem_edital"] = "Alterações realizadas com sucesso!";			
		break;
		
		//Excluir
		case "excluir":
			$edital->excluir($cod_edital);
			//$edital->excluirEditalTurma($cod_edital, $cod_turma);
			
			$_SESSION["mensagem_edital"] = "Edital excluído com sucesso!";
		break;
		
		//Inserir
		case "novo":	
			$edital->setCodigoUsuario($usuario);
			$edital->setCodigoTurma($cod_turma);
			$edital->setAssunto($assunto);
			$edital->setMensagem($mensagem);
			$edital->setDataEdital($data_edital);
			$edital->setHora($hora_edital);
			$edital->setSituacao($situacao);
			$edital->inserir();
			
			$_SESSION["mensagem_edital"] = "Edital cadastrado com sucesso!";
		break;
	}
	
	header("Location: ".$url);
	exit;
}
else
{
	header("Location: index.php");
	exit;
}
?>