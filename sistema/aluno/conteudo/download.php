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

session_start();

$arquivo = $_SESSION["dir_atividades"].$_GET["cod_atividade"]."/".$_GET["arquivo"];

header("Content-type: application/save");
header('Content-Disposition: attachment; filename="'.basename($arquivo).'"');
header('Expires: 0');
header('Pragma: no-cache');
readfile($arquivo);

?>