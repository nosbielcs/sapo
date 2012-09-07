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

//Arquivo de Verificação durante a navegação de TUTORES
if ((!isset($_SESSION["nome_usuario"])) or (!isset($_SESSION["cod_usuario"])) or ($_SESSION["tipo_acesso"] != "tutor")  or (!isset($_SESSION["cod_turma"])))
{
	if (file_exists("../index.php"))
		header("location: ../index.php");
	else
		header("location: ../../index.php");
	exit;
}
/*if (($_SESSION["current_session"] != ($_SESSION["session_user"]."=".$_SESSION["session_key"])) or ($_SESSION["tipo_acesso"] != "tutor")  or (!isset($_SESSION["cod_turma"])))
{
	$_SESSION['auth_msg'] = urlencode("Você presica efetuar o login");
	header("location: ../index.php");
	exit;
}*/
?>