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

//Arquivo de Verificação após efetuar LOGIN
if ((!isset($_SESSION["nome_usuario"])) or (!isset($_SESSION["cod_usuario"])))
{
	if (file_exists("../index.php"))
		header("location: ../index.php");
	else
		header("location: ../../index.php");
		
	exit;
}
?>