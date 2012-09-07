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

include("../../config/session.lib.tutor.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/atividade.php");
include("../../classes/atividade_usuario.php");
include("../../classes/curso.php");
include("../../classes/forum.php");
include("../../classes/mensagem_forum.php");
include("../../classes/log.php");
include("../../classes/perfil.php");
include("../../classes/recado.php");
include("../../classes/turma.php");
include("../../classes/usuario.php");
include("../../classes/usuario_online.php");
include("../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "inicial";
//echo _DB_NAME_;
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
<?php include("../geral/topo.php"); ?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../imagens/cantoA7.gif" width="10" height="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../imagens/cantoA10.gif" height="10"><img src="../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" id="td_linha_menu_esquerdo" valign="top">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../imagens/cantoA7.gif" valign="top"></td>
		  <?php include("../geral/ferramentas.php"); ?> 
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
		  <td>
		    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td align="left" valign="top" width="50%" height="100%"><?php include("../geral/boas_vindas.php"); ?></td>
			    <td valign="top" width="50%" height="100%"><?php include("../geral/dados_pessoais.php"); ?></td>
			  </tr>
		    </table>
	  	  </td>
		</tr>
		<tr>
		  <td>
		    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td align="left" valign="top" width="50%" height="100%"><?php include("../geral/recados.php"); ?></td>
			    <td valign="top" width="50%" height="100%"><?php include("../geral/topicos.php"); ?></td>
			  </tr>
		    </table>
	      </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include("../geral/info.php"); ?>
</body>
</html>
