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
include("../../../classes/forum.php");
include("../../../classes/mensagem_forum.php");
include("../../../classes/perfil.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

$acao = $_POST["acao"];
$cod_forum = $_POST["cod_forum"];
$tipo = $_POST["tipo"];
$citacao = $_POST["citacao"];
$qtd_listagem = $_POST["listagem"];
$modulo = "forum";

if ($acao == "responder")
{

}
else
	if ($acao == "citar")
	{
		if ($tipo == "forum")
		{
			$citar = new forum();
			$citar->carregar($cod_forum);
		}
		else
			if ($tipo == "mensagem")
			{
				$citar = new mensagem_forum();
				$citar->carregar($citacao);
			}
		
		$autor = $citar->getNomeUsuario();
		$mensagem = $citar->getMensagem();
		
		$texto = formataCitacaoForum($autor, $mensagem);
	}

$cod_forum = $_POST["cod_forum"];
$cod_turma = $_SESSION["cod_turma"];
$acao = "nova_msg";

$forum = new forum();
$forum->carregar($cod_forum);

$assunto = $forum->getAssunto();
$autor = $forum->getNomeUsuario();
$cod_autor = $forum->getCodigoUsuario();
$mensagem = nl2br($forum->getMensagem());
$data_forum = formataData($forum->getDataForum(), "/");
$hora_forum = $forum->getHora();
$visualizacoes = $forum->getVisualizacoes() + 1;
$forum->totalMsgsUsuario($cod_autor);
$total_msgs = $forum->data["total"];

//Atualiza Total de Visualizações
$forum->atualizaVisualizacoes($cod_forum, $cod_turma, $visualizacoes);

$pagina = $_POST["pag"];

if (!isset($pagina))
{
	$pagina = 1;	
}

$acao_voltar = $_POST["acao_voltar"];

if ($acao_voltar == "")
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
				  <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td valign="top" align="center">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr> 
						  <td class="preto">Responder Fórum</td>
						</tr>
						<tr> 
						  <td valign="top">
							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
							  <tr> 
								<form action="controle.php" name="tela_forum" method="post">
								  <td valign="top">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									  <tr> 
										<td colspan="3" height="15"></td>
									  </tr>
									  <tr> 
										<td width="80" valign="top" align="center"> 
										  <?php 
											$tabela_smilies = montaTabelaSmilies($smilies, "../../../imagens/icones/smilies/", "msg_forum", "forum", "vertical", "#E8E8E8"); 
											echo $tabela_smilies; 
										  ?>
										</td>
										<td valign="top">
										  <table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr> 
											  <td width="80" valign="top" align="right" class="preto">Assunto:</td>
											  <td width="5">&nbsp;</td>
											  <td align="left"><input type="text" name="assunto" maxlength="80" size="50"></td>
											</tr>
											<tr> 
											  <td colspan="3" height="15"></td> 
											</tr>
											<tr> 
											  <td valign="top" align="right" class="preto">Mensagem:</td>
											  <td>&nbsp;</td>
											  <td valign="top" align="left"><textarea name="mensagem" cols="40" rows="12"><?php echo $texto; ?></textarea></td>
											</tr>
											<tr>
											  <td>
											    <input type="hidden" name="acao" value="<?php echo $acao; ?>"> 
											    <input type="hidden" name="cod_forum" value="<?php echo $cod_forum; ?>"> 
												<input type="hidden" name="listagem" value="<?php echo $qtd_listagem; ?>">
											  </td>
											  <td colspan="2">
											    <table align="left" border="0" cellspacing="0" cellpadding="0">
												  <tr>
												    <td height="10"></td>
												  </tr>
												  <tr>
												    <td height="34"><img src="../../../imagens/icones/forum/lado_esquerda1.gif" width="20" height="34"></td>
												    <td height="34" bgcolor="#E8E8E8"><a onClick="JavaScript: enviaRespostaForum();" class="dcontexto"><span>Enviar</span><img src="../../../imagens/icones/geral/tipo1/enviar.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavScript: voltarForum(<?php echo $cod_forum; ?>, 'visualiza');" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
												    <td height="34"><img src="../../../imagens/icones/forum/lado_direita1.gif" width="20" height="34"></td>
												  </tr>
												  <tr>
												    <td height="10"></td>
												  </tr>
											    </table>
											  </td>
											</tr>
										  </table>
										</td>
									  </tr>
									  <tr> 
										<td colspan="3"></td>
									  </tr>
									  <tr> 
										<td colspan="3" height="15"></td> 
									  </tr>
									</table>
								  </td>
								</form>
							  </tr>
							</table>
						  </td>
						</tr>
					  </table>
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
