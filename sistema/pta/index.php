<?php
/*
=====================================================================
#  PROJETO: Sa²po 2.0 Beta                                          #
#  FUNCAÇÃO ECUMÊNICA DE PROTEÇÃO AO EXCEPCIONAL                    #
#                                                                   #
#  Programação                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

session_start();

include("../../config/session.lib.pta.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/curso.php");
include("../../classes/instituicao.php");
include("../../classes/suporte.php");
include("../../classes/turma.php");
include("../../classes/usuario.php");
include("../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$modulo = "inicial";

$usuario = new usuario();
$usuario->carregar($cod_usuario);
$nome = $usuario->getNome();
$data_nascimento = formataData($usuario->getDataNascimento(), "/");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>
<script language="JavaScript" src="../../funcoes/funcoes.js"></script>

<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" rowspan="4" background="../../imagens/cantoA7.gif" valign="top"><img src="../../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
    <td width="240" height="10" nowrap background="../../imagens/cantoA11.gif" bgcolor="#FCFFEE"></td>
    <td width="10" height="10" bgcolor="#FCFFEE" background="../../imagens/cantoA11.gif"></td>
    <td height="10" background="../../imagens/cantoA11.gif"></td>
    <td width="10" rowspan="2" valign="top" background="../../imagens/cantoA10.gif"><img src="../../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td width="240" height="110" bgcolor="#FCFFEE">            
      <table width="240" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left"><img src="../../imagens/logos/sapo.gif" width="230" height="89" onClick="JavaScript: abas('menu_esquerdo');"></td>
        </tr>
      </table>
    </td>
    <td width="10" valign="middle" bgcolor="#FCFFEE"><img src="../../imagens/traco1.gif" width="2" height="99"></td>
    <td width="100%" bgcolor="#FCFFEE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
		    <table width="100%" height="110" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><iframe width="100%" height="110" frameborder="0" scrolling="no" src="../geral/calendario.php"></iframe></td>
              </tr>
            </table>      
          </td>
          <td width="10" align="center"><img src="../../imagens/traco1.gif" width="2" height="99" border="0"></td>
          <td width="120" align="center"><img src="../../imagens/logos/fepe.gif" width="109" height="97"></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../imagens/cantoA7.gif" width="10" height="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../imagens/cantoA10.gif" height="10"><img src="../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td colspan="3" id="td_linha_menu_esquerdo" valign="top">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../imagens/cantoA7.gif" valign="top"></td>
		  <?php include("../geral/ferramentas_admin.php"); ?> 
		  <td width="10" valign="top" background="../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	  <table width="100%" cellpadding="0" cellspacing="0">
	    <tr>
		  <td align="left" valign="top"><?php include("../geral/boas_vindas_admin.php"); ?></td>
		</tr>
		<tr>
		  <td height="10"></td>
		</tr>
		<tr>
		  <td valign="top" width="50%"><?php include("../geral/solicitacoes.php"); ?></td>
		</tr>
      </table>
	</td>
  </tr>
</table>

</body>
</html>