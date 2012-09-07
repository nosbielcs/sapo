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

include("../../../config/session.lib.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/configuracao.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "config";

if (isset($_SESSION["cod_config"]))
{
	$turma_qtd_lst = $_SESSION["turma_qtd_lst"];
	$turma_cat_lst = $_SESSION["turma_cat_lst"];
	$turma_ordem = $_SESSION["turma_ordem"];
	$edital_qtd_lst = $_SESSION["edital_qtd_lst"];
	$edital_ordem = $_SESSION["edital_ordem"];
	$agenda_qtd_lst = $_SESSION["agenda_qtd_lst"];
	$agenda_ordem = $_SESSION["agenda_ordem"];
	$recado_qtd_lst = $_SESSION["recado_qtd_lst"];
	$recado_ordem = $_SESSION["recado_ordem"];
	$conteudo_qtd_lst = $_SESSION["conteudo_qtd_lst"];
	$conteudo_ordem = $_SESSION["conteudo_ordem"];
	$atividade_qtd_lst = $_SESSION["atividade_qtd_lst"];
	$atividade_ordem = $_SESSION["atividade_ordem"];
	$forum_qtd_lst = $_SESSION["forum_qtd_lst"];
	$forum_ordem = $_SESSION["forum_ordem"];
	$bate_papo_qtd_lst = $_SESSION["bate_papo_qtd_lst"];
	$bate_papo_ordem = $_SESSION["bate_papo_ordem"];
}
else
{
	$configuracao = new config();
	$configuracao->carregar($cod_usuario, $cod_turma);
	
	if ($configuracao->linhas > 0)
	{
		$turma_qtd_lst = $configuracao->getQtdLstTurma();
		$turma_cat_lst = $configuracao->getCatLstTurma();
		$turma_ordem = $configuracao->getOrdenacaoTurma();
		$edital_qtd_lst = $configuracao->getQtdLstEdital();
		$edital_ordem = $configuracao->getOrdenacaoEdital();
		$agenda_qtd_lst = $configuracao->getQtdLstAgenda();
		$agenda_ordem = $configuracao->getOrdenacaoAgenda();
		$recado_qtd_lst = $configuracao->getQtdLstRecado();
		$recado_ordem = $configuracao->getOrdenacaoRecado();
		$conteudo_qtd_lst = $configuracao->getQtdLstConteudo();
		$conteudo_ordem = $configuracao->getOrdenacaoConteudo();
		$atividade_qtd_lst = $configuracao->getQtdLstAtividade();
		$atividade_ordem = $configuracao->getOrdenacaoAtividade();
		$forum_qtd_lst = $configuracao->getQtdLstForum();
		$forum_ordem = $configuracao->getOrdenacaoForum();
		$bate_papo_qtd_lst = $configuracao->getQtdLstBatePapo();
		$bate_papo_ordem = $configuracao->getOrdenacaoBatePapo();
	}
	else
	{
		$turma_qtd_lst = "P";
		$turma_cat_lst = "P";
		$turma_ordem = "P";
		$edital_qtd_lst = "P";
		$edital_ordem = "P";
		$agenda_qtd_lst = "P";
		$agenda_ordem = "P";
		$recado_qtd_lst = "P";
		$recado_ordem = "P";
		$conteudo_qtd_lst = "P";
		$conteudo_ordem = "P";
		$atividade_qtd_lst = "P";
		$atividade_ordem = "P";
		$forum_qtd_lst = "P";
		$forum_ordem = "P";
		$bate_papo_qtd_lst = "P";
		$bate_papo_ordem = "P";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO - Configura&ccedil;&otilde;es</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	var vetorAbas = new Array();
	vetorAbas[0] = new selecionarAba('dados_pessoais');
	vetorAbas[1] = new selecionarAba('dados_profissionais');
	vetorAbas[2] = new selecionarAba( 'dados_cadastrais');
	vetorAbas[3] = new selecionarAba( 'formulario_dados_pessoais');
	vetorAbas[4] = new selecionarAba( 'formulario_dados_profissionais');
	vetorAbas[5] = new selecionarAba( 'formulario_dados_cadastrais');
</script>

<body topmargin="0" leftmargin="0">
<?php include("../topo.php"); ?>
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
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE">
	    <tr>
		  <td colspan="3" height="5"></td>
		</tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantov10.gif"><img src="../../../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantoA11.gif" valign="top" bgcolor="FCFFEE"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantov7.gif"><img src="../../../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
	    </tr>
	    <tr>
		  <td width="10" background="../../../imagens/cantoA7.gif"></td>
		  <td bgcolor="#FCFFEE">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <form name="configuracao" method="post" action="controle.php">
			  <tr>
			    <td class="preto">
				  <table width="100%" cellpadding="0" cellspacing="0">
				    <tr>
					  <td width="10"></td>
					  <td class="preto">Configurações</td>
					  <td align="right"><a onClick="JavaScript: document.configuracao.submit();" onMouseOver="JavaScript: window.status = 'Salvar Configurações';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_preto">Salvar Configurações</a></td>
					</tr>
				  </table>
				</td>
			  </tr>
			  <tr>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td class="vermelho_simples" align="center" height="15"><?php 
						if (isset($_SESSION["mensagem_config"])) 
						{ 
							echo $_SESSION["mensagem_config"]; 
							unset($_SESSION["mensagem_config"]);
						}
					?></td>
					</tr>
					<tr>
					  <td>
						<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" height="100%" valign="top"><?php include("config_turma.php"); ?></td>
							<td width="50%" height="100%" valign="top"><?php include("config_edital.php"); ?></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" height="100%" valign="top"><?php include("config_agenda.php"); ?></td>
							<td width="50%" height="100%" valign="top"><?php include("config_recado.php"); ?></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" height="100%" valign="top"><?php include("config_conteudo.php"); ?></td>
							<td width="50%" height="100%" valign="top"><?php include("config_atividade.php"); ?></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" height="100%" valign="top"><?php include("config_forum.php"); ?></td>
							<td width="50%" height="100%" valign="top"><?php include("config_bate_papo.php"); ?></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td height="5"><input type="hidden" name="acao_config" value="salvar"></td>
					</tr>
				  </table>
				</td>
			  </tr>
			  </form>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantoA10.gif"></td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantoA9.gif"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>