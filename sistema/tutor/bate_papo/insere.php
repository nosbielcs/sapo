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

include("../../../config/session.lib.tutor.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/mensagem_bate_papo.php");

$cod_sala = $_SESSION["cod_sala"];
$cod_usuario = $_SESSION["cod_usuario"];
$modo_mensagem = $_POST["modo_mensagem"];
$mensagem = $_POST["mensagem_bate_papo"];
$cor_mensagem = $_SESSION["cor_mensagem"];
$destinatario = $_POST["destinatario"];
$data_mensagem = date("Y-m-d");
$hora_mensagem = date("H:i:s");

$_SESSION["modo_mensagem"] = $modo_mensagem;
$_SESSION["destinatario"] = $destinatario;

if ($_POST["bate_papo_rolagem"] == "rolagem")
	$_SESSION["rolagem"] = "S";
else
	$_SESSION["rolagem"] = "N";

if ($_POST["bate_papo_reservado"] == "reservado")
	$_SESSION["reservado"] = "S";
else
	$_SESSION["reservado"] = "N";
	
$reservado = $_SESSION["reservado"];
$mensagem = htmlentities($mensagem);
$mensagem_bate_papo = new mensagem_bate_papo();
$mensagem_bate_papo->setCodigoSala($cod_sala);
$mensagem_bate_papo->setCodigoUsuario($cod_usuario);
$mensagem_bate_papo->setCodigoDestinatario($destinatario);
$mensagem_bate_papo->setModoMensagem($modo_mensagem);
$mensagem_bate_papo->setMensagem($mensagem);
$mensagem_bate_papo->setCorMensagem($cor_mensagem);
$mensagem_bate_papo->setDataMensagem($data_mensagem);
$mensagem_bate_papo->setHoraMensagem($hora_mensagem);
$mensagem_bate_papo->setReservado($reservado);
$mensagem_bate_papo->inserir();

header("Location: mensagem_bate_papo.php");

?>