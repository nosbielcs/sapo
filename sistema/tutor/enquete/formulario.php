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
include("../../../classes/enquete.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "enquete";

$acao = $_POST["acao"];
$cod_enquete = $_POST["cod_enquete"];
$cod_curso = $_SESSION["cod_curso"];
$cod_turma = $_SESSION["cod_turma"];
$pagina = $_POST["pagina"];
$quantidade = $_POST["quantidade"];
$ordem = $_POST["ordem"];

$tamanho = strlen($cod_enquete);
$onLoad = "JavaScript: defineLayer();";

if ($_POST["acao"])
{
	$acao = $_POST["acao"];
	
	switch($acao)
	{
		case "novo":
			$titulo = "Nova Enquete";			
			$dia_fim = date("d");
			$mes_fim = date("m");
			$ano_fim = date("Y");
			$hora_fim = date("H");
			$minuto_fim = date("i");
		break;
		
		case "editar":
			if ($cod_enquete[$tamanho - 1] == ";")
				$cod_enquete = trim(str_replace(";", "", $cod_enquete));
				
			$titulo = "Editar Conteúdo";
			$enquete = new enquete();
			$enquete->carregar($cod_enquete);
			
			$nome_enquete = $enquete->getNome();
			$descricao_enquete = $enquete->getDescricao();
			$data_fim = $enquete->getDataFim();
			$hora_fim = $enquete->getHoraFim();
			$situacao = $enquete->getSituacao();
		break;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script language="JavaScript" src="../../../funcoes/funcoes_enquete.js"></script>

<script type="text/javascript">
	function voltar()
	{
		document.cad_enquete.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.cad_enquete.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: defineLayer(); atualizaDiasdoMes('<?php echo $dia_fim; ?>', '<?php echo $mes_fim; ?>', '<?php echo $ano_fim; ?>', 'cad_enquete', 'dia_fim');">
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
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"><img src="../../../imagens/cantop1.gif" width="10" height="10" border="0"></td>
          <td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="3" bgcolor="#FFFFFF"></td>
              </tr>
              <tr>
                <td bgcolor="#E8BBD1"><img src="../../../imagens/icones/conteudo/titulo_materiais_disponiveis.gif" width="250" height="52"></td>
              </tr>
            </table>
		  </td>
          <td height="10" background="../../../imagens/cantop8.gif" width="436" valign="top"></td>
          <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantop7.gif"><img src="../../../imagens/cantop2.gif" width="10" height="10" border="0"></td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"></td>
          <td height="42" bgcolor="#F5E2EC" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_magenta">Voltar</a></td>
          <td width="10" background="../../../imagens/cantop7.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../../../imagens/cantop5.gif"></td>
          <td colspan="2" bgcolor="#F5E2EC">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
              <tr>
                <td width="100%" bgcolor="#F5E2EC">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="1" background="../../../imagens/traco10.gif"></td>
                    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
                  </table>
				  <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center">
					<tr>
					  <td>
						<form name="cad_enquete" action="controle.php" method="post">
						<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#E8BBD1">
						  <tr> 
							<td colspan="3" class="magenta"><?php echo $titulo; ?></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td class="preto" width="80" align="right" valign="top">Enquete:</td>
							<td width="10"></td>
							<td align="left"><textarea name="descricao" cols="60" rows="4"></textarea></td>
						  </tr>						  
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr>
						    <td class="preto" align="right">Data Limite?</td>
							<td width="10"></td>
							<td class="preto">Sim<input type="radio" name="data_limite" value="0" onClick="JavaScript: visualizaData(0);">Não<input type="radio" name="data_limite" checked value="1" onClick="JavaScript: visualizaData(1);"></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="15"></td>
						  </tr>
						  <tr>
						    <td colspan="3">
							  <div id="dataLimite" style="display:none">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
									<td width="80" align="right" class="preto">Data de Fim:</td>
									<td width="10"></td>
									<td>
									  <select name="dia_fim"></select> 
									  <select name="mes_fim" onChange="JavaScript: atualizaDiasdoMes(document.cad_enquete.dia_fim.value, document.cad_enquete.mes_fim.value, document.cad_enquete.ano_fim.value, 'cad_enquete', 'dia_fim');">
										  <option value="1" <?php if ($mes_fim == "01") echo "selected"; ?>>Janeiro</option>
										  <option value="2" <?php if ($mes_fim == "02") echo "selected"; ?>>Fevereiro</option>
										  <option value="3" <?php if ($mes_fim == "03") echo "selected"; ?>>Mar&ccedil;o</option>
										  <option value="4" <?php if ($mes_fim == "04") echo "selected"; ?>>Abril</option>
										  <option value="5" <?php if ($mes_fim == "05") echo "selected"; ?>>Maio</option>
										  <option value="6" <?php if ($mes_fim == "06") echo "selected"; ?>>Junho</option>
										  <option value="7" <?php if ($mes_fim == "07") echo "selected"; ?>>Julho</option>
										  <option value="8" <?php if ($mes_fim == "08") echo "selected"; ?>>Agosto</option>
										  <option value="9" <?php if ($mes_fim == "09") echo "selected"; ?>>Setembro</option>
										  <option value="10" <?php if ($mes_fim == "10") echo "selected"; ?>>Outubro</option>
										  <option value="11" <?php if ($mes_fim == "11") echo "selected"; ?>>Novembro</option>
										  <option value="12" <?php if ($mes_fim == "12") echo "selected"; ?>>Dezembro</option>
									  </select>
									  <select name="ano_fim" onChange="JavaScript: atualizaDiasdoMes(document.cad_enquete.dia_fim.value, document.cad_enquete.mes_fim.value, document.cad_enquete.ano_fim.value, 'cad_enquete', 'dia_fim');">
										  <option value="<?php echo date("Y"); ?>" <?php if ($ano_fim == date("Y")) echo "selected"; ?>><?php echo date(Y); ?></option>
										  <option value="<?php echo date("Y") + 1; ?>" <?php if ($ano_fim == date("Y") + 1) echo "selected"; ?>><?php echo date(Y)+1; ?></option>
										  <option value="<?php echo date("Y") + 2; ?>" <?php if ($ano_fim == date("Y") + 2) echo "selected"; ?>><?php echo date(Y)+2; ?></option>
										  <option value="<?php echo date("Y") + 3; ?>" <?php if ($ano_fim == date("Y") + 3) echo "selected"; ?>><?php echo date(Y)+3; ?></option>
									  </select>
									</td>
								  </tr>
								  <tr>
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr>
									<td align="right" class="preto">Hora de Fim:</td>
									<td width="10"></td>
									<td>
									  <select name="hora_fim">
									  <?php
									  for ($i = 0; $i < 24; $i++)
									  {
										if($i >= 0 and $i <= 9)
										{
										  if ($hora_fim == $i)
											  echo "<option value=\"0".$i."\" selected>0".$i."</option>";
										  else
											  echo "<option value=\"0".$i."\">0".$i."</option>";	
										}
										elseif ($i >= 10)
										{
											if ($hora_fim == $i)
												echo "<option value=\"".$i."\" selected>".$i."</option>";
											else
												echo "<option value=\"".$i."\">".$i."</option>";
										}	
									  }
									  
									  ?>
									  </select>
									  <select name="minuto_fim">
									  <?php
									  for ($i = 0; $i < 60; $i++)
									  {
										if($i >= 0 and $i <= 9)
										{
										  if ($minuto_fim == $i)
											  echo "<option value=\"0$i\" selected>0".$i."</option>";
										  else
											  echo "<option value=\"0$i\">0".$i."</option>";	
										}
										else
											if ($i >= 10)
											{
											  if ($minuto_fim == $i)
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
							    </table>
							  </div>
							</td>
						  </tr>
						  <tr>
						    <td></td>
						    <td width="10"></td>
							<td><a onClick="JavaScript: adicionaOpcaoEnquete(contaInput('text', 'cad_enquete'), 'enquete');" onMouseOver="JavaScript: window.status = 'Adicionar Opção';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" title="Adicionar Opção" class="link_magenta">Adicionar Opção</a></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr>
							<td id="enquete" colspan="3"></td>
						  </tr>
						  <tr>
						    <td class="preto" align="right">Situação:</td>
							<td width="10"></td>
							<td>
							  <select name="situacao">
							    <option value="A">Ativo</option>
								<option value="I">Inativo</option>
							  </select>
							</td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td colspan="2">
							  <input type="hidden" name="cod_enquete" value="<?php echo $cod_conteudo; ?>"> 
							  <input type="hidden" name="total_opcoes" value=""> 
							  <input type="hidden" name="acao" value="<?php echo $acao; ?>">
							  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>"> 
							  <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
							  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							</td>
							<td>
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td height="34"><img src="../../../imagens/icones/conteudo/lado_esquerda.gif" width="20" height="34"></td>
								  <td height="34" bgcolor="#F5E2EC"><a onClick="JavaScript: cadastrarEnquete();" onMouseOver="JavaScript: window.status = 'Gravar Conteúdo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" alt="" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" alt="Fechar formul&aacute;rio" width="30" height="30" border="0" align="middle"></a></td>
								  <td height="34"><img src="../../../imagens/icones/conteudo/lado_direita.gif" width="20" height="34"></td>
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
                      <td height="1" background="../../../imagens/traco10.gif"></td>
                    </tr>
                  </table>
				</td>
              </tr>
            </table>
	      </td>
          <td width="10" align="right" background="../../../imagens/cantop7.gif">&nbsp;</td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantop4.gif" width="10" height="10" border="0"></td>
          <td height="10" background="../../../imagens/cantop6.gif" colspan="2"></td>
          <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantop3.gif" width="10" height="10" border="0"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
