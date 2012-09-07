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

if ($_POST["acao"])
{
	$acao = $_POST["acao"];
	$acao_voltar = $_POST["acao_voltar"];
	
	if (empty($acao_voltar))
		$acao_voltar = "index";
	
	switch($acao)
	{
		case "novo":
		    $titulo = "Nova Atividade";
			$imagem = "../../../imagens/icones/avaliacao/titulo_atividades_adicionar.gif";
			$dia_atividade = date("d");
			$mes_atividade = date("m");
			$ano_atividade = date("Y");
			$hora_atividade = date("H");
			$minuto_atividade = date("i");			
		break;
		
		case "editar":
			$titulo = "Editar Atividade";
			$imagem = "../../../imagens/icones/avaliacao/titulo_atividades_editar.gif";
			$atividade = new atividade();
			$atividade->carregar($cod_atividade);
			
			$titulo_atividade = $atividade->getAtividade();
			$descricao = $atividade->getDescricao();
			$data_entrega = $atividade->getDataEntrega();
			$dia_atividade = substr($data_entrega, 8, 2);
			$mes_atividade = substr($data_entrega, 5, 2);
			$ano_atividade = substr($data_entrega, 0, 4);
			$hora_entrega = $atividade->getHoraEntrega();
			$hora_atividade = substr($hora_entrega, 0, 2);
			$minuto_atividade = substr($hora_entrega, 3, 2);
			$valor = $atividade->getValor();
			
			$anexos = new atividade_arquivo();
			$anexos->colecao($cod_atividade);
			
			$total = $anexos->linhas;
			if ($total > 0)
			{
				$arquivo = new atividade_arquivo();
				
				for ($i = 0; $i < $total; $i++)	
				{
					$cod_arquivo = $anexos->data["cod_arquivo"];
					$arquivo->carregar($cod_arquivo);
					$cod_arquivo = $arquivo->getCodigoArquivo();
					$nome_arquivo = $arquivo->getNome();
					$descricao_arquivo = $arquivo->getDescricao();
					$onLoad.= "adicionaAnexo(".($i + 1).", 'files', ".$cod_arquivo.", '".$nome_arquivo."', '".$descricao_arquivo."');";
					
					$anexos->proximo();
				}
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
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.cad_atividade.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.cad_atividade.action = "visualiza.php";
		<?
		   }
		?>
		document.cad_atividade.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: atualizaDiasdoMes('<?php echo $dia_atividade; ?>', '<?php echo $mes_atividade; ?>', '<?php echo $ano_atividade; ?>', 'cad_atividade', 'dia'); defineLayer(); <?php echo $onLoad; ?>">
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
			  <td bgcolor="#ffcc80"><img src="<?php echo $imagem; ?>" width="250" height="52"></td>
			</tr>
		  </table>
		</td>
		<td height="10" background="../../../imagens/cantoq8.gif" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoq7.gif"><img src="../../../imagens/cantoq2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"></td>
		<td height="42" bgcolor="#ffecce" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Nova Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_laranja">Visualizar Atividades</a></td>
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
				<table width="95%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
				  <td>
					<form name="cad_atividade" action="controle.php" method="post" enctype="multipart/form-data">
					  <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFE3B9">
						<tr>
						  <td colspan="3" class="laranja"><?php echo $titulo; ?></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td class="preto" width="100" align="right">Atividade:</td>
						  <td width="10">&nbsp;</td>
						  <td><input type="text" width="100" maxlength="80" value="<?php echo $titulo_atividade; ?>" name="titulo_atividade"></td>
						</tr>
						<tr>
						  <td colspan="7">&nbsp;</td>
						</tr>
						<tr>
						  
						<td class="preto" align="right" valign="top">Descri&ccedil;&atilde;o:</td>
						  <td>&nbsp;</td>
						  <td><textarea cols="45" rows="15" name="descricao"><?php echo $descricao; ?></textarea></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  
						<td align="right" class="preto">Data de Entrega:</td>
						  <td>&nbsp;</td>
						  <td>
							  <select name="dia"></select> 
							  <select name="mes" onChange="JavaScript: atualizaDiasdoMes(document.cad_atividade.dia.value, document.cad_atividade.mes.value, document.cad_atividade.ano.value, 'cad_atividade', 'dia');">
								  <option value="1" <?php if ($mes_atividade == "01") echo "selected"; ?>>Janeiro</option>
								  <option value="2" <?php if ($mes_atividade == "02") echo "selected"; ?>>Fevereiro</option>
								  <option value="3" <?php if ($mes_atividade == "03") echo "selected"; ?>>Mar&ccedil;o</option>
								  <option value="4" <?php if ($mes_atividade == "04") echo "selected"; ?>>Abril</option>
								  <option value="5" <?php if ($mes_atividade == "05") echo "selected"; ?>>Maio</option>
								  <option value="6" <?php if ($mes_atividade == "06") echo "selected"; ?>>Junho</option>
								  <option value="7" <?php if ($mes_atividade == "07") echo "selected"; ?>>Julho</option>
								  <option value="8" <?php if ($mes_atividade == "08") echo "selected"; ?>>Agosto</option>
								  <option value="9" <?php if ($mes_atividade == "09") echo "selected"; ?>>Setembro</option>
								  <option value="10" <?php if ($mes_atividade == "10") echo "selected"; ?>>Outubro</option>
								  <option value="11" <?php if ($mes_atividade == "11") echo "selected"; ?>>Novembro</option>
								  <option value="12" <?php if ($mes_atividade == "12") echo "selected"; ?>>Dezembro</option>
							  </select>
							  <select name="ano" onChange="JavaScript: atualizaDiasdoMes(document.cad_atividade.dia.value, document.cad_atividade.mes.value, document.cad_atividade.ano.value, 'cad_atividade', 'dia');">
								  <option value="<?php echo date("Y"); ?>" <?php if ($ano_atividade == date("Y")) echo "selected"; ?>><?php echo date(Y); ?></option>
								  <option value="<?php echo date("Y") + 1; ?>" <?php if ($ano_atividade == date("Y") + 1) echo "selected"; ?>><?php echo date(Y)+1; ?></option>
								  <option value="<?php echo date("Y") + 2; ?>" <?php if ($ano_atividade == date("Y") + 2) echo "selected"; ?>><?php echo date(Y)+2; ?></option>
								  <option value="<?php echo date("Y") + 3; ?>" <?php if ($ano_atividade == date("Y") + 3) echo "selected"; ?>><?php echo date(Y)+3; ?></option>
							  </select>
						  </td>
						</tr>
						<tr>
							<td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td align="right" class="preto">Hora de Entrega:</td>
						  <td width="10">&nbsp;</td>
						  <td>
							  <select name="hora">
							  <?php
							  for ($i = 0; $i < 24; $i++)
							  {
								if($i >= 0 and $i <= 9)
								{
								  if ($hora_atividade == $i)
									  echo "<option value=\"0".$i."\" selected>0".$i."</option>";
								  else
									  echo "<option value=\"0".$i."\">0".$i."</option>";	
								}
								elseif ($i >= 10)
								{
									if ($hora_atividade == $i)
										echo "<option value=\"".$i."\" selected>".$i."</option>";
									else
										echo "<option value=\"".$i."\">".$i."</option>";
								}	
							  }
							  
							  ?>
							  </select>
							  <select name="minuto">
							  <?php
							  for ($i = 0; $i < 60; $i++)
							  {
								if($i >= 0 and $i <= 9)
								{
								  if ($minuto_atividade == $i)
									  echo "<option value=\"0$i\" selected>0".$i."</option>";
								  else
									  echo "<option value=\"0$i\">0".$i."</option>";	
								}
								else
									if ($i >=10)
									{
									  if ($minuto_atividade == $i)
										  echo "<option value=\"$i\" selected>".$i."</option>";
									  else
										  echo "<option value=\"$i\">".$i."</option>";
									}	
							  }
							  ?>
							  </select>
						  </td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td class="preto" width="100" align="right">Valor:</td>
						  <td width="10">&nbsp;</td>
						  <td><input type="text" width="50" maxlength="10" value="<?php echo $valor; ?>" name="valor"></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td><a onClick="JavaScript: adicionaInput(contaInput('file', 'cad_atividade')<?php if ($acao == "editar") echo " + contaInput('textarea', 'cad_atividade') - 1"; ?>, 'files', 'file');" onMouseOver="JavaScript: window.status = 'Adicionar Anexo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" title="Adicionar Anexo" class="link_laranja">Adicionar Anexo</a></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td colspan="3" id="files"></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td colspan="3">
						    <input type="hidden" name="cod_atividade" value="<?php echo $cod_atividade; ?>">
							<input type="hidden" name="acao" value="<?php echo $acao; ?>">
							<input type="hidden" name="total_anexo" value="0">
							<input type="hidden" name="cod_arquivos" value="">
							<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">  
							<input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
							<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						    <table align="center" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							    <td height="34"><img src="../../../imagens/icones/avaliacao/lado_esquerdo1.gif" width="20" height="34"></td>
							    <td height="34" bgcolor="#FFECCE"><a onClick="JavaScript: cadastrarAtividade();" onMouseOver="JavaScript: window.status = 'Gravar Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Gravar Atividade" style="cursor:pointer" class="dcontexto"><span>Gravar Atividade</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
							    <td height="34"><img src="../../../imagens/icones/avaliacao/lado_direito1.gif" width="20" height="34"></td>
							  </tr>
						    </table>
						  </td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
					  </table>
					</form>
				  </td>
				</tr>
			  </table>
				<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
