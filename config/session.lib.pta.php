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

//Arquivo de Verifica��o durante a navega��o de ADMINISTRADORES
if ((!isset($_SESSION["nome_usuario"])) or (!isset($_SESSION["cod_usuario"])) or ($_SESSION["tipo_acesso"] != "pta"))
{
	if (file_exists("../index.php"))
		header("location: ../index.php");
	else
		header("location: ../../index.php");
	
	exit;
}
?>