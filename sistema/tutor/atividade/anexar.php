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
include("../../../classes/atividade.php");
include("../../../classes/atividade_arquivo.php");
include("../../../classes/atividade_usuario.php");
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
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "atividades";

$cod_atividade = $_POST["cod_atividade"];
$cod_aluno = $_POST["cod_aluno"];
$acao = $_POST["acao"];
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

<script type="text/javascript">
	function voltar()
	{
		document.anexar_atividade.action = "visualiza.php";
		document.anexar_atividade.submit();
	}
</script>

<body topmargin="0" leftmargin="0" <?php echo $onLoad; ?>>
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
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"><img src="../../../imagens/cantoq1.gif" width="10" height="10" border="0"></td>
		<td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="3" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			  <td bgcolor="#ffcc80"><img src="../../../imagens/icones/avaliacao/titulo_atividades_propostas.gif" width="250" height="52"></td>
			</tr>
		  </table>
		</td>
		<td height="10" background="../../../imagens/cantoq8.gif" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoq7.gif"><img src="../../../imagens/cantoq2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"></td>
		<td height="42" bgcolor="#ffecce" width="100%" align="right"><a onClick="JavaScript: novaAtividade();" onMouseOver="JavaScript: window.status = 'Nova Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_laranja">Nova Atividade</a></td>
		<td width="10" background="../../../imagens/cantoq7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../../imagens/cantoq5.gif"></td>
		<td colspan="2" bgcolor="#ffecce">
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
			  <td width="100%" bgcolor="#ffecce">
			    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="1" background="../../../imagens/traco11.gif"><img height="1" src="../../../imagens/traco11.gif" border="0"></td>
				  </tr>
				  <tr>
				    <td height="10"></td>
				  </tr>
			    </table>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFE3B9">
				  <tr>
					<td valign="top" align="center">
					<?php
					if ((!empty($cod_atividade)) and (!empty($cod_aluno)))
					{
						$atividade = new atividade();
						$atividade->carregar($cod_atividade);
				
						$nome_atividade = $atividade->getAtividade();
						
						$aluno = new usuario();
						$aluno->carregar($cod_aluno);
						
						$nome_aluno = $aluno->getNome();
					?>
					  <form name="anexar_atividade" action="controle.php" method="post" enctype="multipart/form-data">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							  <tr>
								<td colspan="3" class="preto" align="left">Anexar Arquivo na Atividade</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" width="140" align="right">Aluno:</td>
								<td width="10">&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $nome_aluno; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" width="140" align="right">Atividade:</td>
								<td width="10">&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $nome_atividade; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td colspan="3" class="preto" align="left">Anexar Trabalho</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Arquivo:</td>
								<td>&nbsp;</td>
								<td align="left"><input type="file" name="arquivo_atividade_usuario"></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Descrição do Arquivo:</td>
								<td>&nbsp;</td>
								<td class="conteudoTexto" valign="top" align="left"><textarea name="descricao_arquivo" cols="45" rows="10"></textarea></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"><input type="hidden" name="acao" value="anexar_arquivo"><input type="hidden" name="cod_atividade" value="<?php echo $cod_atividade; ?>"><input type="hidden" name="cod_usuario" value="<?php echo $cod_aluno; ?>"><input type="hidden" name="pagina" value="<?php echo $pagina; ?>"><input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"></td>
							  </tr>
							  <tr>
								<td colspan="3">
								  <table align="center" border="0" cellspacing="0" cellpadding="0">
								    <tr>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_esquerdo1.gif" width="20" height="34"></td>
									  <td height="34" bgcolor="#FFECCE"><a onClick="JavaScript: document.anexar_atividade.submit();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Gravar" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_direito1.gif" width="20" height="34"></td>
								    </tr>
								  </table>
								</td>
							  </tr>
							</table>
						  </td>
						</tr>
					  </table>
					  </form>
					<?php
					}
					?>
					</td>
				  </tr>
				  <tr>
				    <td height="15"></td>
				  </tr>
				</table>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="10"></td>
				  </tr>
				  <tr>
					<td height="1" background="../../../imagens/traco11.gif"><img height="1" src="../../../imagens/traco11.gif" border="0"></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../../imagens/cantoq7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantoq4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../../imagens/cantoq6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantoq3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
