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
include("../../../classes/edital.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

if ($_POST["acao"])
{		
	$acao = $_POST["acao"];
	switch($acao)
	{
		case "novo":
			$titulo = "Novo Edital";
			$imagem_edital = "<img src=\"../../../imagens/icones/edital/titulo_novo_edital.gif\" border=\"0\">";
		break;
				
		case "editar":
			$cod_edital = $_POST["cod_edital"];
			$imagem_edital = "<img src=\"../../../imagens/icones/edital/titulo_editar_recados.gif\" border=\"0\">";
			
			if ($cod_edital)
			{
				$titulo = "Editar Edital";
				$edital = new edital();
				$edital->carregar($cod_edital);
				$cod_edital = $edital->getCodigo();
				$cod_usuario = $edital->getCodigoUsuario();
				$assunto = $edital->getAssunto();
				$mensagem = $edital->getMensagem();
				$data_edital = $edital->getDataEdital();
				$hora = $edital->getHora();
				
				$autor = new usuario();
				$autor->carregar($cod_usuario);
				$nome_autor = $autor->getNome();
			}
		break;
	}
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
	
$modulo = "edital";

?>
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
		document.visualizaEdital.action ="index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.visualizaEdital.submit();
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
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/canton10.gif"><img src="../../../imagens/canton1.gif" width="10" height="10" border="0"></td>
            <td width="301" height="52" rowspan="2" bgcolor="#C5D8EB">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="3" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td bgcolor="#EDC0AF"><?php echo $imagem_edital; ?></td>
                </tr>
              </table>
		    </td>
            <td height="10" background="../../../imagens/canton8.gif" width="436" valign="top"></td>
            <td width="10" height="10" align="right" valign="top" background="../../../imagens/canton7.gif"><img src="../../../imagens/canton2.gif" width="10" height="10" border="0"></td>
          </tr>
          <tr>
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/canton10.gif"></td>
            <td height="42" bgcolor="#F7E3DB" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Visualizar Editais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_marron">Visualizar Editais</a></td>
            <td width="10" background="../../../imagens/canton7.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../../../imagens/canton5.gif"></td>
            <td colspan="2" bgcolor="#F7E3DB">
			  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                <tr>
                  <td width="100%" bgcolor="#F7E3DB">
				    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <form name="visualizaEdital" method="post">
                      <tr>
                        <td height="1" background="../../../imagens/traco8.gif"></td>
                      </tr>
					  <tr>
					    <td height="10">
						  <input type="hidden" name="cod_edital" value="">
						  <input type="hidden" name="acao" value="">
						  <input type="hidden" name="ordem" value="">
						  <input type="hidden" name="pagina" value="">
						  <input type="hidden" name="quantidade" value="">
						</td>
					  </tr>
					  </form>
                    </table>
					<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#F4D8CE">
					<form action="controle.php" name="edital" method="post">
					<tr> 
					  <td colspan="3" align="left" class="marron"><?php echo $titulo; ?></td>
					</tr>
					<tr> 
					  <td colspan="3" height="15"></td>
					</tr>
					<tr> 
					  <td width="100" class="preto" align="right">Assunto:</td>
					  <td width="10">&nbsp;</td>
					  <td><input type="text" name="assunto" size="45" maxlength="80" value="<?php echo $assunto; ?>"></td>
					</tr>
					<tr>
					  <td colspan="3" height="15"></td>
					</tr>
					<tr> 
					  <td width="100" class="preto" align="right" valign="top">Mensagem:</td>
					  <td width="10">&nbsp;</td>
					  <td><textarea cols="45" rows="10" name="mensagem"><?php echo $mensagem; ?></textarea></td>
					</tr>
					<tr>
					  <td colspan="3" height="15"></td>
					</tr>
					<tr>
					  <td colspan="3">
					    <table border="0" align="center" cellpadding="0" cellspacing="0">
					      <tr>
						    <td height="34"><img src="../../../imagens/icones/edital/lado_esquerda.gif" width="20" height="34"></td>
						    <td height="34" bgcolor="#F7E3DB"><a onClick="JavaScript: cadastraEdital();" onMouseOver="JavaScript: window.status = 'Gravar Edital';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" alt="Gravar" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();"  onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" alt="Cancelar" width="30" height="30" border="0" align="middle"></a></td>
						    <td height="34"><img src="../../../imagens/icones/edital/lado_direita.gif" width="20" height="34"></td>
					      </tr>
					    </table>
					</td>
					</tr>
					<tr>
					  <td colspan="3" height="15"><input type="hidden" name="acao" value="<?php echo $acao; ?>"><input type="hidden" name="cod_edital" value="<?php echo $cod_edital; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pagina; ?>"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"></td>
					</tr>
					</form>
				  </table>
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
					    <td height="10"></td>
					  </tr>
                      <tr>
                        <td height="1" background="../../../imagens/traco8.gif"></td>
                      </tr>
                    </table>
				  </td>
                </tr>
              </table>
			</td>
            <td width="10" align="right" background="../../../imagens/canton7.gif">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/canton4.gif" width="10" height="10" border="0"></td>
            <td height="10" background="../../../imagens/canton6.gif" colspan="2"></td>
            <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/canton3.gif" width="10" height="10" border="0"></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>