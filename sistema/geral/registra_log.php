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

include("../../config/session.lib.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/log.php");
include("../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$acao = $_GET["acao"];
$data_log = date("Y-m-d");
$hora_log = date("H:i:s");
$redireciona = $_GET["redireciona"];

logSistema($cod_usuario, $cod_turma, $acao, session_id(), $data_log, $hora_log);
//header("Location: ".$redireciona);
//exit;
//echo "<script type=\"text/javascript\">window.alert('Log');
/*$log = new log_sistema();
$log->setCodigoUsuario($cod_usuario);
$log->setCodigoTurma($cod_turma);
$log->setAcao($acao);
$log->setSessionID(session_id());
$log->setDataLog($data_log);
$log->setHoraLog($hora_log);
$log->inserir();
*/
?>