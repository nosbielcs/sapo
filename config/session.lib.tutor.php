<?php
/*
=====================================================================
#  PROJETO: Sa�po                                                   #
#  FUNCA��O ECUM�NICA DE PROTE��O AO EXCEPCIONAL                    #
#                                                                   #
#  Programa��o                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

//Arquivo de Verifica��o durante a navega��o de TUTORES
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
	$_SESSION['auth_msg'] = urlencode("Voc� presica efetuar o login");
	header("location: ../index.php");
	exit;
}*/
?>