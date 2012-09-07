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

//Arquivo de Verificação durante a navegação de ADMINISTRADORES
if ((!isset($_SESSION["nome_usuario"])) or (!isset($_SESSION["cod_usuario"])) or ($_SESSION["tipo_acesso"] != "pta"))
{
	if (file_exists("../index.php"))
		header("location: ../index.php");
	else
		header("location: ../../index.php");
	
	exit;
}
?>