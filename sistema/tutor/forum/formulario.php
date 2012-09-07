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
include("../../../classes/curso.php");
include("../../../classes/perfil.php");
include("../../../classes/forum.php");
include("../../../classes/mensagem_forum.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "forum";

$acao = $_POST["acao"];
$acao_voltar = $_POST["acao_voltar"];
$cod_mensagem = $_POST["cod_mensagem"];
$cod_forum = $codigos = explode(";", $_POST["codigosForum"]);
$cod_forum = $cod_forum[0];

if (empty($cod_forum))
	$cod_forum = $_POST["cod_forum"];

switch($acao)
{
	case "novo_forum":
		$titulo = "Novo Tópico";
	break;
	
	case "editar_forum":
		$titulo = "Editar Tópico";
		$forum = new forum();
		$forum->carregar($cod_forum);
		
		$assunto = $forum->getAssunto();
		$mensagem = $forum->getMensagem();
	break;
	
	case "editar_msg":
		$titulo = "Editar Mensagem";
		$mensagem = new mensagem_forum();
		$mensagem->carregar($cod_mensagem);
		
		$assunto = $mensagem->getAssunto();
		$mensagem = $mensagem->getMensagem();
	break;
}

if ($_POST["pagina"])
	$pagina = $_POST["pagina"];
else
	$pagina = 1;

if ($_POST["quantidade"])
	$quantidade = $_POST["quantidade"];
else
	$quantidade = 5;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	$ordem = 1;
	
$acao_voltar = $_POST["acao_voltar"];

if (empty($acao_voltar))
	$acao_voltar = "index";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script type="text/javascript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	function voltar()
	{
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.forum.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		       if ($acao_voltar == 'visualiza')
		   	   {
		?>
					document.forum.action = "visualiza.php";
		<?
		       }
		?>
		document.forum.submit();
	}
</script>

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
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"><img src="../../../imagens/cantos1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
				<td valign="baseline" bgcolor="#CCCCCC"><img src="../../../imagens/icones/forum/titulo_novo_debate.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantos8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantos7.gif"><img src="../../../imagens/cantos2.gif" width="10" height="10" border="0"></td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"></td>
		  <td height="42" bgcolor="#E8E8E8" width="100%" align="right"></td>
		  <td width="10" background="../../../imagens/cantos7.gif"></td>
		</tr>
		<tr>
		  <td width="10" background="../../../imagens/cantos5.gif"></td>
		  <td colspan="2">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2" bgcolor="#E8E8E8">
			  <tr>
				<td width="100%">
				  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="1" background="../../../imagens/traco13.gif"><img src="../../../imagens/traco13.gif" border="0"></td>
					</tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" cellpadding="0" cellspacing="0" border="0">
				    <tr>
					  <td>
					    <form name="forum" method="post" action="controle.php">
						  <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
						    <tr>
							  <td colspan="4" class="cinza"><?php echo $titulo; ?></td>
						    </tr>
						    <tr>
							  <td colspan="4" height="15"></td>
						    </tr>
						    <tr>
							  <td></td>
							  <td class="preto" width="100" align="right">Assunto:</td>
							  <td width="10">&nbsp;</td>
							  <td><input type="text" size="60" maxlength="80" value="<?php echo $assunto; ?>" name="assunto"></td>
						    </tr>
						    <tr>
							  <td colspan="4" height="15"></td>
						    </tr>
						    <tr>
							  <td width="80" valign="top" align="center"> 
							  	<?php 
									$tabela_smilies = montaTabelaSmilies($smilies, "../../../imagens/icones/smilies/", "msg_forum", "forum", "vertical", "#E8E8E8"); 
									echo $tabela_smilies; 
							    ?>
							  </td>
							  <td class="preto" align="right" valign="top">Mensagem:</td>
							  <td></td>
							  <td><textarea cols="45" rows="15" name="mensagem"><?php echo $mensagem; ?></textarea></td>
						    </tr>
						    <tr>
							  <td colspan="4" height="15"></td>
						    </tr>
							<tr>
							  <td colspan="3">
							    <input type="hidden" name="cod_forum" value="<?php echo $cod_forum; ?>">
								<input type="hidden" name="cod_mensagem" value="<?php echo $cod_mensagem; ?>">
								<input type="hidden" name="acao" value="<?php echo $acao; ?>">
								<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
								<input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
								<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							  </td>
							  <td>
							    <table align="left" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="34"><img src="../../../imagens/icones/forum/lado_esquerda1.gif" width="20" height="34"></td>
                                    <td height="34" bgcolor="#e8e8e8"><a onClick="JavaScript: cadastrarForum();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" title="Gravar" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" title="Voltar" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
                                    <td height="34"><img src="../../../imagens/icones/forum/lado_direita1.gif" width="20" height="34"></td>
                                  </tr>
                                </table
							  ></td>
							</tr>
							<tr>
							  <td colspan="3" height="15"></td>
						    </tr>
						  </table>
					    </form>
					  </td>
					</tr>
				  </table>
				  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td background="../../../imagens/traco13.gif"></td>
					</tr>
				  </table>
				</td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantos7.gif">&nbsp;</td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantos4.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantos6.gif" colspan="2"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantos3.gif" width="10" height="10" border="0"></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
