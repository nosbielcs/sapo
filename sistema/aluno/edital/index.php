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
include("../../../classes/edital.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "edital";

$editais = new edital();
$editais->colecao($cod_turma);
$total_editais = $editais->linhas;

if ($_GET["acao"])
{
	$acao = $_GET["acao"];
	if (($acao == "novo") or ($acao == "editar"))
		$onLoad = "OnLoad=\"JavaScript: alternarAbas('formulario_edital');\"";
	else
		$onLoad = "OnLoad=\"JavaScript: alternarAbas('visualiza_edital');\"";
}

if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_paginacao = "index.php?pag=".$pagina;
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_paginacao = "index.php?pag=".$pagina;
}
	
if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
}
else
{
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["edital_qtd_lst"]))
			$limite = $_SESSION["edital_qtd_lst"];
		else
			$limite = 5;
		$url_ordenacao.= "&qtd=".$limite;
	}
}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
}
else
{
	if (isset($_SESSION["edital_ordem"]))
		$ordem = $_SESSION["edital_ordem"];
	else
		$ordem = 1;
}
	
$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$editais->paginacao($cod_turma, $limite, $inicio, $ordem);
$qtd_listagem = $editais->linhas;

if ($_GET["ordem"])
{
	switch($ordem) 
	{
		case 1:
			$url_ordenacao.= "&ordem=2";
			$url_paginacao = "index.php?pag=".$pagina;
			$link_ordenacao = "<a onClick=\"window.location.href = '".$url_ordenacao."'\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Ordem Crescente por Data\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
		break;
		
		case 2:
			$url_ordenacao.= "&ordem=1";
			$url_paginacao = "index.php?pag=".$pagina;
			$link_ordenacao = "<a onClick=\"window.location.href = '".$url_ordenacao."'\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Ordem Decrescente por Data\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
		break;
	}
}
else
{
	$url_ordenacao.= "&ordem=2";
	$url_paginacao = "index.php?pag=".$pagina;
	$link_ordenacao = "<a onClick=\"window.location.href = '".$url_ordenacao."'\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Ordem Crescente por Data\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
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
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/canton10.gif"><img src="../../../imagens/canton1.gif" width="10" height="10" border="0"></td>
            <td width="301" height="52" rowspan="2" bgcolor="#C5D8EB">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="3" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td bgcolor="#EDC0AF"><img src="../../../imagens/icones/edital/titulo_ultimos_recados.gif" width="250" height="52"></td>
                </tr>
              </table>
		    </td>
            <td height="10" background="../../../imagens/canton8.gif" width="436" valign="top"></td>
            <td width="10" height="10" align="right" valign="top" background="../../../imagens/canton7.gif"><img src="../../../imagens/canton2.gif" width="10" height="10" border="0"></td>
          </tr>
          <tr>
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/canton10.gif"></td>
            <td height="42" bgcolor="#F7E3DB" width="100%" align="right"></td>
            <td width="10" background="../../../imagens/canton7.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../../../imagens/canton5.gif"></td>
            <td colspan="2" bgcolor="#F7E3DB">
			  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                <tr>
                  <td width="100%" bgcolor="#F7E3DB">
				    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="1" background="../../../imagens/traco8.gif"></td>
                      </tr>
					  <tr>
					    <td height="10"></td>
					  </tr>
                    </table>
					<?php
						if ($qtd_listagem > 0)
						{
					?>
					<table width="95%" align="center">
					  
					  <tr>
						<td width="100%">&nbsp;</td>
						<td width="100">
						  <table width="100%" border="0" cellpadding="0" cellspacing="0">
							<form name="paginacao_edital" action="index.php" method="post">
							<tr>
							  <td class="campos" align="right">Listagem</td>
							  <td width="10">&nbsp;</td>
							  <td width="50">
								<select name="qtd_listagem" onChange="JavaScript: paginacao('<?php echo $url_paginacao; ?>', 'paginacao_edital');">
								  <option value="1" <?php if ($limite == 1) echo "selected"; ?>>1</option>
								  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
								  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
								  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
								  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
								</select>
							  </td>
							</tr>
							</form>
							<form action="../../geral/perfil_usuario.php" method="post" name="perfil_participante">
							  <input type="hidden" name="cod_participante">
							  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
							  <input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
							  <input type="hidden" name="acao_voltar" value="edital">
							</form>
						  </table>
						</td>
						<td>
						  <table width="100%">
							<tr>	      
							  <td width="60" class="campos">Ordenação</td>
							  <td width="5">&nbsp;</td>
							  <td><?php echo $link_ordenacao; ?></td>
							</tr>
						  </table>
						</td>
					  </tr>
					  <?php 
						if (isset($_SESSION["mensagem_edital"]))
						{
					  ?>
					  <tr>
						<td align="center" class="vermelho_simples" colspan="3"><?php echo $_SESSION["mensagem_edital"]; ?></td>
					  </tr>
					  <?php
							unset($_SESSION["mensagem_edital"]);
						}
					  ?>
					</table>
					<table width="95%" align="center">
 					<?php
							for ($i = 0; $i < $qtd_listagem; $i++)
							{
								$edital = new edital();
								$cod_edital = $editais->data["cod_edital"];
								$edital->carregar($cod_edital);
								$cod_usuario = $edital->getCodigoUsuario();
								$assunto = $edital->getAssunto();
								$mensagem = $edital->getMensagem();
								$data_edital = $edital->getDataEdital();
								$hora = $edital->getHora();
								$hora = substr($hora, 0, 5);
								
								$autor = new usuario();
								$autor->carregar($cod_usuario);
								$nome_autor = $autor->getNome();
					?>
					  <tr>
					    <td>
						  <table width="100%" align="center" bgcolor="#F4D8CE">
						  <tr> 
							<td class="preto" align="right" width="70">Assunto:</td>
							<td width="10">&nbsp;</td>
							<td class="marron_simples" align="left" width="100%"><?php echo $assunto; ?></td>
						  </tr>
						  <tr>
							<td width="70" class="preto" valign="top" align="right">Mensagem:</td>
							<td width="10">&nbsp;</td>
							<td class="marron_simples" align="left" width="100%"><?php echo nl2br($mensagem); ?></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr>
							<td width="70" class="preto" align="right">Autor:</td>
							<td width="10">&nbsp;</td>
							<td width="100%">
							  <table width="100%">
								<tr>
								  <td><a onClick="JavaScript: visualizarPerfil(<?php echo $cod_usuario; ?>, '../perfil/');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome_autor; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_marron"><?php echo $nome_autor; ?></a></td>
								  <td class="preto" align="right">Data / Hora:</td>
								  <td width="10">&nbsp;</td>
								  <td class="marron_simples"><?php echo formataData($data_edital, "/")." às ".$hora; ?></td>
								</tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
				      <?php
					  		   if (($i + 1) < $qtd_listagem)
							   {
					  ?>
					  <tr>
					    <td height="15"></td>
					  </tr>
					  <?php
					  			}
								
								$editais->proximo();	
							}
				  	  ?>
					  <tr>
					    <td>
						  <table width="100%" align="center">
						    <tr>
							  <td><?php echo paginacao($pagina, $inicio, $qtd_listagem, $total_editais, $url, true); ?></td>
						      <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $total_editais; ?></font></td>
							</tr>
						  </table>
						</td>
					  </tr>
					 
				    </table>
					<?php
						}
						else
						{
					?>
					<table width="95%" align="center" cellpadding="0" cellspacing="0">
					  <tr> 
					    <td align="center" class="vermelho_simples">Nenhum Edital Cadastrado.</td>
					  </tr>
					</table>
					<?php
						}
					?>
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
<?php include("../../geral/info.php") ?>
</body>
</html>
