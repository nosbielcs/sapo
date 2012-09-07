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
include("../../../classes/curso.php");
include("../../../classes/perfil.php");
include("../../../classes/forum.php");
include("../../../classes/mensagem_bate_papo.php");
include("../../../classes/turma.php");
include("../../../classes/sala_bate_papo.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_bate_papo.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "bate_papo";

$acao_bate_papo = $_POST["acao_bate_papo"];
$cod_sala =  $_POST["cod_sala_bate_papo"];

switch($acao_bate_papo)
{
	case "novo_bate_papo":
		$titulo = "Nova Sala de Bate Papo";
	break;
	
	case "editar_bate_papo":
		$titulo = "Editar Sala de Bate Papo";
		
		$bate_papo = new sala_bate_papo();
		$bate_papo->carregar($cod_sala);
		
		$nome_sala = $bate_papo->getNome();
		$descricao_sala = $bate_papo->getDescricao();
		$vagas = $bate_papo->getVagas();
		$situacao = $bate_papo->getSituacao();
	break;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<body topmargin="0" leftmargin="0">
<?php include("../../geral/topo.php"); ?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../../imagens/cantoA7.gif" height="10" width="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../../imagens/cantoA10.gif" height="10"><img src="../../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" valign="top" id="td_linha_menu_esquerdo">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../../imagens/cantoA7.gif" valign="top">&nbsp;</td>
		  <?php include("../../geral/ferramentas.php"); ?>
		  <td width="10" valign="top" background="../../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"><img src="../../../imagens/cantot1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2" bgcolor="#99CC66">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
			    <td bgcolor="#99CC66"><img src="../../../imagens/icones/bate_papo/titulo_bate_papo.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantot8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantot7.gif"><img src="../../../imagens/cantot2.gif" width="10" height="10" border="0"></td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"></td>
		  <td height="42" align="right" bgcolor="#CFE7B8" width="100%"></td>
		  <td width="10" background="../../../imagens/cantot7.gif"></td>
	    </tr>
	    <tr>
		  <td width="10" background="../../../imagens/cantot5.gif"></td>
		  <td colspan="2" bgcolor="#CFE7B8">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
			  <tr>
			    <td width="100%" bgcolor="#CFE7B8">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
				    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				    <tr>
					  <td><iframe width="100%" height="350" frameborder="0" scrolling="no" src="bate_papo.php"></iframe></td>
					</tr>
				  </table>
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
					</tr>
				  </table>
				</td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantot7.gif">&nbsp;</td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantot4.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantot6.gif" colspan="2"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantot3.gif" width="10" height="10" border="0"></td>
	    </tr>
	  </table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
