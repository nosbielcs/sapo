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
include("../../../classes/usuario.php");
include("../../../funcoes/funcoes.php");

?>
<html>
<head>
<title>Bate Papo - Mensagem</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: mensagensBatePapo();">
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td valign="top">
	  <table width="100%" cellpadding="0" cellspacing="0">
	  	<tr>
		  <td id="batePapoMensagens" class="preto_simples"></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</body>
</html>