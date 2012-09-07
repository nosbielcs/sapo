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

include("../../../config/session.lib.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../funcoes/funcoes.php");

$cod_curso = $_GET["cod_curso"];
$curso = new curso();
$curso->carregar($cod_curso);

$data_inicio = formataData($curso->getDataInicio(), "/");
$data_fim = formataData($curso->getDataFim(), "/");

echo $data_inicio."|".$data_fim;
?>