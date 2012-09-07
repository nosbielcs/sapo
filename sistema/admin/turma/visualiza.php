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

include("../../../config/session.lib.admin.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$modulo = "turmas";

if ($_POST["cod_turma"])
{
	$acao_voltar = $_POST["acao_voltar"];
	
	if (empty($acao_voltar))
		$acao_voltar = "index";
		
    $cod_turma = $_POST["cod_turma"];
	$turma = new turma();
	$turma->carregar($cod_turma);
	$cod_curso = $turma->getCodigoCurso();
	$descricao = $turma->getDescricao();
	$vagas = $turma->getVagas();
	$data_inicio = $turma->getDataInicio();
	$qtde_horas = $turma->getQtdeHoras();
	$data_fim = $turma->getDataFim();
	$data_inicio = formataData($data_inicio, "/");
	$data_fim = formataData($data_fim, "/");
	
	$curso = new curso();
	$curso->carregar($cod_curso);
	$nome_curso = $curso->getNome();
}
else
{
	header("Location: index.php");
	exit;
}
	
if ($_POST["pagina"])
	$pagina = $_POST["pagina"];
else
	$pagina = 1;

if ($_POST["quantidade"])
	$quantidade = $_POST["quantidade"];
else
	$quantidade = 10;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	$ordem = 1;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO Administra&ccedil;&atilde;o - Institui&ccedil;&otilde;es</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes_turma.js"></script>

<script type="text/javascript">
	function voltar()
	{
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.turma_instituicao.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.turma_instituicao.action = "visualiza.php";
		<?
		   }
		?>
		document.turma_instituicao.submit();
	}
</script>

<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" rowspan="4" background="../../../imagens/cantoA7.gif" valign="top"><img src="../../../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
    <td width="240" height="10" background="../../../imagens/cantoA11.gif" bgcolor="#FCFFEE"></td>
    <td width="10" height="10" bgcolor="#FCFFEE" background="../../../imagens/cantoA11.gif"></td>
    <td height="10" background="../../../imagens/cantoA11.gif"></td>
    <td width="10" rowspan="2" valign="top" background="../../../imagens/cantoA10.gif"><img src="../../../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td width="240" height="110" bgcolor="#FCFFEE">            
      <table width="240" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left"><img src="../../../imagens/logos/sapo.gif" width="230" height="89" onClick="JavaScript: abas('menu_esquerdo');"></td>
        </tr>
      </table>
    </td>
    <td width="10" valign="middle" bgcolor="#FCFFEE"><img src="../../../imagens/traco1.gif" width="2" height="99"></td>
    <td width="100%" bgcolor="#FCFFEE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
		    <table width="100%" height="110" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><iframe width="100%" height="110" frameborder="0" scrolling="no" src="../../geral/calendario.php"></iframe></td>
              </tr>
            </table>       
          </td>
          <td width="10" align="center"><img src="../../../imagens/traco1.gif" width="2" height="99" border="0"></td>
          <td width="120" align="center"><img src="../../../imagens/logos/fepe.gif" width="109" height="97"></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
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
		    <?php include("../../geral/ferramentas_admin.php"); ?>
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
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
                <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="3" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                      <td><img src="../../../imagens/icones/perfil/titulo_dados_pessoais.gif" width="250" height="52"></td>
                    </tr>
                  </table>
				</td>
                <td height="10" background="../../../imagens/cantoL8.gif"></td>
                <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
              </tr>
              <tr>
                <td width="10" height="42" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
                <td height="42" bgcolor="#D5FFD5" width="100%" align="right"><a onClick="JavaScript: editarTurma(<?php echo $cod_turma; ?>);" style="cursor: pointer" class="link_verde">Editar Turma</a>&nbsp;</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				    <form name="turma_instituicao" method="post">
					<tr>
					  <td class="verde">Informa&ccedil;&otilde;es Sobre a Turma</td>
					</tr>
					<tr>
					  <td colspan="3" height="15"></td>
					</tr>
					<tr>
					  <td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="140" class="campos" align="right">Curso:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $nome_curso; ?></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td width="140" class="campos" align="right" valign="top">Descrição:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $descricao; ?></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td width="140" class="campos" align="right">Vagas:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $vagas; ?></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td width="140" class="campos" align="right">Total de Horas:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $qtde_horas; ?> horas</td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td width="140" class="campos" align="right">Data de In&iacute;cio:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $data_inicio; ?></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td width="140" class="campos" align="right">Data de Fim:</td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="verde_simples" align="left"><?php echo $data_fim; ?></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td height="10"><input type="hidden" name="acao_turma" value=""><input type="hidden" name="cod_turma"><input type="hidden" name="acao_voltar" value="visualiza"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"></td>
					</tr>
					<tr>
					  <td align="center">
					    <table border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
						    <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
						    <td bgcolor="#99FF99"><a onClick="JavaScript: editarTurma(<?php echo $cod_turma; ?>);" onMouseOver="JavaScript: window.status = 'Editar Curso';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
						    <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
						  </tr>
					    </table>
					  </td>
					</tr>
					</form>
				  </table>
				</td>
                <td width="10" align="right" background="../../../imagens/cantoL7.gif">&nbsp;</td>
              </tr>
              <tr>
                <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoL5.gif"><img src="../../../imagens/cantoL4.gif" width="10" height="10" border="0"></td>
                <td height="10" background="../../../imagens/cantoL6.gif" colspan="2"></td>
                <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL3.gif" width="10" height="10" border="0"></td>
              </tr>
            </table>
	      </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>