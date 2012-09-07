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
	
$arquivo = $_SESSION["tipo_acesso"]."/SA²pO - Manual do Usuário.pdf";

header("Content-type: application/save");
header('Content-Disposition: attachment; filename="'.basename($arquivo).'"');
header('Expires: 0');
header('Pragma: no-cache');
readfile($arquivo);

?>