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

include("../config/session.lib.php");
include("../config/config.bd.php");
include("../classes/classe_bd.php");
include("../classes/usuario.php");
include("../classes/log.php");
include("../funcoes/funcoes.php");

$data_log = date("Y-m-d");
$hora_log = date("H:i:s");

if (isset($_SESSION["cod_usuario"]))
{
	if (isset($_SESSION["cod_turma"]))
		$cod_turma = $_SESSION["cod_turma"];
	else
		$cod_turma = 0;
		
	logSistema($_SESSION["cod_usuario"], $cod_turma, "Efetuou Logoff", session_id(), $data_log, $hora_log);
?>
<html>
<head>
<title>Sa&sup2;pO</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../funcoes/funcoes.js"></script>

<script language="JavaScript">
	setTimeout("self.close();", 4000);
</script>

<body onLoad="JavaScript: redimensionar(this, 350, 190);">
  <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f1f3f3">
	<tr>
	  <td class="cinza_simples" align="center" valign="middle">Você acaba de sair do <b>S</b>istem<b>a</b> de <b>A</b>poio &agrave; <b>Ap</b>rendizagem <b>O</b>nLine. Obrigado por acessar o Sa²Po.</td>
	</tr>
  </table>
</body>
</html>
<?php
}

session_unset();
session_destroy();
?>