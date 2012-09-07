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

include("../../../config/session.lib.admin.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/usuario.php");

$login_usuario = $_GET["login"];

$usuario = new usuario();
echo $retorno = $usuario->verificaDisponibilidadeLogin($login_usuario);
?>