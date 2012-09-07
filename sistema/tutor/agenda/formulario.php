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
include("../../../classes/evento.php");
include("../../../classes/perfil.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "agenda";

if ($_POST["acao"])
{
	$acao = $_POST["acao"];
	
	switch($acao)
	{
		case "editar":
			$titulo = "Editar Evento";
			$cod_evento = $_POST["cod_evento"];
			$evento = new evento();
			$evento->carregar($cod_evento);
			
			$dia_evento = substr($evento->getDataEvento(), 8, 2);
			$mes_evento = substr($evento->getDataEvento(), 5, 2);
			$ano_evento = substr($evento->getDataEvento(), 0, 4);
			$hora_evento = substr($evento->getHora(), 0, 2);
			$minuto_evento = substr($evento->getHora(), 3, 2);
			$assunto_evento = $evento->getAssunto();
			$descricao_evento = $evento->getDescricao();
			$situacao_evento = $evento->getSituacao();
			$tipo = $evento->getTipo();
		break;
		
		case "novo":
			$titulo = "Novo Evento";
			$dia_evento = date("d");
			$mes_evento = date("m");
			$ano_evento = date("Y");
			$hora_evento = date("H");
			$minuto_evento = date("i");
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

<script language="JavaScript">
	function gravarDados()
	{
		if (document.eventos.acao.value == "novo")
		{
			var diaEvento = document.eventos.dia.value;
			var mesEvento = parseInt(document.eventos.mes.value) - 1;
			var anoEvento = document.eventos.ano.value;
			var horaEvento = document.eventos.hora.value;
			var minutosEvento = document.eventos.minuto.value;
			var segundosEvento = 0;
			var dataEvento = new Date(anoEvento, mesEvento, diaEvento, horaEvento, minutosEvento, segundosEvento);
			var dataAtual = new Date();
			var diaAtual = dataAtual.getDate();
			var mesAtual = parseInt(dataAtual.getMonth()) + 1;
			var anoAtual = dataAtual.getFullYear();
			var erroData = false;
			if (document.eventos.assunto.value.length == 0)
			{
				window.alert("Campo Evento em branco.");
				document.eventos.assunto.focus();
			}
			else
				{			
					if (dataEvento < dataAtual)
						erroData = true;
					else
						erroData = false;
					
					if (erroData == true)
						window.alert("A data do Evento não pode ser menor que a data Atual, considerando dia, mês, ano, horas e minutos.");
					else
						{
							if (document.eventos.descricao.value.length == 0)
							{
								window.alert("Campo Descrição em Branco.");
								document.eventos.descricao.focus();
							}
							else
								document.eventos.submit();
						}
				}
		}
		else
			document.eventos.submit();
	}
	
	function voltar()
	{
		document.eventos.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.eventos.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: atualizaDiasdoMes('<?php echo $dia_evento; ?>', '<?php echo $mes_evento; ?>', '<?php echo $ano_evento; ?>', 'eventos', 'dia'); defineLayer();">
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
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoo10.gif"><img src="../../../imagens/cantoo1.gif" width="10" height="10" border="0"></td>
            <td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="3" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td bgcolor="#C5C8DA"><img src="../../../imagens/icones/agenda/titulo_novos_eventos.gif" width="250" height="52"></td>
                </tr>
              </table>
		    </td>
            <td height="10" background="../../../imagens/cantoo8.gif" width="436" valign="top"></td>
            <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoo7.gif"><img src="../../../imagens/cantoo2.gif" width="10" height="10" border="0"></td>
          </tr>
          <tr>
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoo10.gif"></td>
            <td height="42" bgcolor="#D7D9E5" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Visualizar Eventos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_purpura">Visualizar Eventos</a></td>
            <td width="10" background="../../../imagens/cantoo7.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../../../imagens/cantoo5.gif"></td>
            <td colspan="2" bgcolor="#D7D9E5">
			  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                <tr>
                  <td width="100%" bgcolor="#D7D9E5">
				    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="1" background="../../../imagens/traco9.gif"></td>
                      </tr>
					  <tr>
					    <td height="10"></td>
					  </tr>
                    </table>
					<table width="95%" align="center" bgcolor="#C5C8DA">
					  <form action="controle.php" method="post" name="eventos">
						<tr>
							<td colspan="3" class="preto"><?php echo $titulo; ?></td>
						</tr>
						<tr>
							<td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td width="80" align="right" class="preto">Evento:</td>
						  <td width="10">&nbsp;</td>
						  <td><input name="assunto" type="text" id="evento" size="50" value="<?php echo $assunto_evento; ?>"></td>
						</tr>
						<tr>
							<td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td align="right" class="preto">Data:</td>
						  <td>&nbsp;</td>
						  <td>
						      <select name="dia"></select> 
							  <select name="mes" onChange="JavaScript: atualizaDiasdoMes(document.eventos.dia.value, document.eventos.mes.value, document.eventos.ano.value, 'eventos', 'dia');">
								  <option value="1" <?php if ($mes_evento == "01") echo "selected"; ?>>Janeiro</option>
								  <option value="2" <?php if ($mes_evento == "02") echo "selected"; ?>>Fevereiro</option>
								  <option value="3" <?php if ($mes_evento == "03") echo "selected"; ?>>Mar&ccedil;o</option>
								  <option value="4" <?php if ($mes_evento == "04") echo "selected"; ?>>Abril</option>
								  <option value="5" <?php if ($mes_evento == "05") echo "selected"; ?>>Maio</option>
								  <option value="6" <?php if ($mes_evento == "06") echo "selected"; ?>>Junho</option>
								  <option value="7" <?php if ($mes_evento == "07") echo "selected"; ?>>Julho</option>
								  <option value="8" <?php if ($mes_evento == "08") echo "selected"; ?>>Agosto</option>
								  <option value="9" <?php if ($mes_evento == "09") echo "selected"; ?>>Setembro</option>
								  <option value="10" <?php if ($mes_evento == "10") echo "selected"; ?>>Outubro</option>
								  <option value="11" <?php if ($mes_evento == "11") echo "selected"; ?>>Novembro</option>
								  <option value="12" <?php if ($mes_evento == "12") echo "selected"; ?>>Dezembro</option>
							  </select>
							  <select name="ano" onChange="JavaScript: atualizaDiasdoMes(document.eventos.dia.value, document.eventos.mes.value, document.eventos.ano.value, 'eventos', 'dia');">
								  <option value="<?php echo date("Y"); ?>" <?php if ($ano_evento == date("Y")) echo "selected"; ?>><?php echo date(Y); ?></option>
								  <option value="<?php echo date("Y") + 1; ?>" <?php if ($ano_evento == date("Y") + 1) echo "selected"; ?>><?php echo date(Y)+1; ?></option>
								  <option value="<?php echo date("Y") + 2; ?>" <?php if ($ano_evento == date("Y") + 2) echo "selected"; ?>><?php echo date(Y)+2; ?></option>
								  <option value="<?php echo date("Y") + 3; ?>" <?php if ($ano_evento == date("Y") + 3) echo "selected"; ?>><?php echo date(Y)+3; ?></option>
							  </select>
						  </td>
						</tr>
						<tr>
							<td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td align="right" class="preto">Hora:</td>
						  <td width="10">&nbsp;</td>
						  <td>
							  <select name="hora">
							  <?php
							  for ($i = 0; $i < 24; $i++)
							  {
								if($i >= 0 and $i <= 9)
								{
								  if ($hora_evento == $i)
									  echo "<option value=\"0".$i."\" selected>0".$i."</option>";
								  else
									  echo "<option value=\"0".$i."\">0".$i."</option>";	
								}
								elseif ($i >= 10)
								{
									if ($hora_evento == $i)
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
								  if ($minuto_evento == $i)
									  echo "<option value=\"0$i\" selected>0".$i."</option>";
								  else
									  echo "<option value=\"0$i\">0".$i."</option>";	
								}
								else
									if ($i >=10)
									{
									  if ($minuto_evento == $i)
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
						  <td valign="top" align="right" class="preto">Descri&ccedil;&atilde;o:</td>
						  <td width="10">&nbsp;</td>
						  <td><textarea name="descricao" cols="45" rows="10" id="descricao"><?php echo $descricao_evento; ?></textarea></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td class="preto" align="right">Categoria:</td>
						  <td width="10">&nbsp;</td>
						  <td>
						    <select name="tipo_evento">
							  <option value="C" <?php if ($tipo == "C") echo "selected"; ?>>Bate Papo</option>
							  <option value="E" <?php if ($tipo == "E") echo "selected"; ?>>Encontro Presencial</option>
							  <option value="A" <?php if ($tipo == "A") echo "selected"; ?>>Entrega de Atividade</option>
							  <option value="I" <?php if ($tipo == "I") echo "selected"; ?>>Início do Curso</option>
							  <option value="F" <?php if ($tipo == "F") echo "selected"; ?>>Fim do Curso</option>
							</select>
						  </td>
						</tr>
						<tr>
							<td colspan="3" height="15">
							<input type="hidden" name="titulo_evento" value="<?php echo $titulo; ?>">  
							<input type="hidden" name="acao" value="<?php echo $acao; ?>">
							<input type="hidden" name="cod_evento" value="<?php echo $cod_evento; ?>">
							<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">  
							<input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
							<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							</td>
						</tr>
						<tr>
						  <td align="right" class="preto">Situacao:</td>
						  <td width="10">&nbsp;</td>
						  <td>
							<select name="situacao">
							  <option value="A" <?php if ($situacao_evento == "A") echo "selected"; ?>>Ativo</option>
							  <option value="I" <?php if ($situacao_evento == "I") echo "selected"; ?>>Inativo</option>
							</select>
						  </td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td colspan="3">
						    <table align="center" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td height="34"><div align="right"><img src="../../../imagens/icones/geral/tipo1/lado_esquerda.gif" width="20" height="34"></div></td>
								<td height="34" bgcolor="#D7D9E5"><a onClick="JavaScript: gravarDados();" class="dcontexto" onMouseOver="JavaScript: window.status = 'Gravar Evento';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" alt="Gravar Evento" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" alt="Voltar" width="30" height="30" border="0" align="middle"></a></td>
								<td height="34"><div align="left"><img src="../../../imagens/icones/geral/tipo1/lado_direita.gif" width="20" height="34"></div></td>
							  </tr>
							</table>
						  </td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
					  </form>
					</table>
                    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td height="1" background="../../../imagens/traco9.gif"></td>
					</tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../../imagens/cantoo7.gif">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantoo4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../../imagens/cantoo6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantoo3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>