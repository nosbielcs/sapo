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
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>
<body topmargin="0" leftmargin="0">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#CFE7B8">
	  <tr>
		<td valign="top" align="center" width="100">
		<?php 
			$tabela_smilies = montaTabelaSmilies($smilies, "../../../imagens/icones/smilies/", "insere_mensagem_bate_papo", "chat", "vertical", "#CFE7B8"); 
			echo $tabela_smilies; 
		?>
		</td>
	  </tr>
	</table>
</body>
</html>
