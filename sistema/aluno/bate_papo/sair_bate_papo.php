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

include("../../../config/session.lib.aluno.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/usuario_bate_papo.php");
include("../../../classes/mensagem_bate_papo.php");

$data_entrada = $_SESSION["data_entrada"];
$hora_entrada = $_SESSION["hora_entrada"];
$cod_sala = $_SESSION["cod_sala"];
$cod_usuario = $_SESSION["cod_usuario"];
$cor_mensagem = $_SESSION["cor_mensagem"];
$usuario_bate_papo = new usuario_bate_papo();
$situacao = "I";
$usuario_bate_papo->alterar($cod_usuario, $cod_sala, $data_entrada, $hora_entrada, $situacao);

$modo_mensagem = "";
$mensagem = "Saiu da Sala de Bate Papo";
$data_saida = date("Y-m-d");
$hora_saida = date("H:i:s");
$reservado = "N";

$mensagem_bate_papo = new mensagem_bate_papo();
$mensagem_bate_papo->setCodigoSala($cod_sala);
$mensagem_bate_papo->setCodigoUsuario($cod_usuario);
$mensagem_bate_papo->setCodigoDestinatario(0);
$mensagem_bate_papo->setModoMensagem($modo_mensagem);
$mensagem_bate_papo->setMensagem($mensagem);
$mensagem_bate_papo->setCorMensagem($cor_mensagem);
$mensagem_bate_papo->setDataMensagem($data_saida);
$mensagem_bate_papo->setHoraMensagem($hora_saida);
$mensagem_bate_papo->setReservado($reservado);
$mensagem_bate_papo->inserir();

unset($_SESSION["data_comparacao"]);
unset($_SESSION["hora_comparacao"]);
unset($_SESSION["data_entrada"]);
unset($_SESSION["hora_entrada"]);
unset($_SESSION["cod_sala"]);
unset($_SESSION["modo_mensagem"]);
unset($_SESSION["rolagem"]);
unset($_SESSION["reservado"]);
unset($_SESSION["destinatario"]);
?>
<html>
<head>
<title>Sair Bate Papo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="window.parent.location.href = 'sair.htm'">

</body>
</html>