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

$atividades = new atividade();
$atividades->colecao($cod_turma);

$quantidade = $atividades->linhas;
$usuarios_turma = new usuario();
$usuarios_turma->colecaoUsuarioTurma($cod_turma, "L", "");
$total_usuarios = $usuarios_turma->linhas;

//Ordenação e Paginação
if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["atividade_qtd_lst"]))
			$limite = $_SESSION["atividade_qtd_lst"];
		else
			$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordem;
}
else
{
	if (isset($_SESSION["atividade_ordem"]))
		$ordem = $_SESSION["atividade_ordem"];
	else
		$ordem = 1;
	$url_qtd.= "&ordem=".$ordem;	
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$atividades->paginacao($cod_turma, $limite, $inicio, $ordem);
$total_atividades = $atividades->linhas;
//
		
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
		<td height="42" bgcolor="#ffecce" width="100%" align="right"></td>
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
				<?php
				if ($total_atividades > 0)
				{
				?>
				<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <form name="paginacao_atividade" action="index.php" method="post">
					  <tr>
						<td class="campos" align="right">Listagem</td>
						<td width="10">&nbsp;</td>
						<td width="50">
						  <select name="qtd_listagem" onChange="JavaScript: paginacaoAtividade('<?php echo $url_qtd; ?>');">
							<option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
							<option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
							<option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
							<option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
							<option value="todos" <?php if ($limite == "todos") echo "selected"; ?>>Todos</option>
						  </select>
						</td>
					  </tr>
					  </form>
					</table>
				  </td>
				</tr>
				<tr>
				  <td colspan="2">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <form name="visualizaAtividade" action="atividade.php" method="post" target="_parent">
					  <tr>
					    <td colspan="7" height="10"></td>
					  </tr>
					<tr class="laranja_linha_1">
					  <td width="90" class="preto" align="center">Data&nbsp;&nbsp;
					  <?php
						  if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=2";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 7:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 8:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=1";
								echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Data\"></a>";
							}		  
					  ?>
					  </td>
					  <td class="preto">Atividade&nbsp;&nbsp;
					  <?php
						  if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=6";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Decrescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 7:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 8:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=5";
								echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
							}		  
					  ?>
					  </td>
					  <td class="preto" align="center">Material</td>
					  <td class="preto" align="center">Data / Hora Entrega&nbsp;&nbsp;
					  <?php
						  if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=4";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Decrescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 7:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 8:
										$url_ordena.= "&ordem=3";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=3";
								echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Data / Hora de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data / Hora de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
							}		  
					  ?>
					  </td>
					  <td class="preto" align="center">Valor&nbsp;&nbsp;
					  <?php
						  if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 7:
										$url_ordena.= "&ordem=8";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 8:
										$url_ordena.= "&ordem=7";
										echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Decrescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=3";
								echo "<a onClick=\"window.location.href = '".$url_ordena."'\" title=\"Ordem Crescente por Valor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Valor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
							}		  
					  ?>
					  </td>
					  <td width="110" class="preto" align="center">Situação</td>
					</tr>
					<tr> 
					  <td colspan="7"  height="15"></td>
					</tr>
					<?php
						$cor_fundo = "laranja_linha_1";
						
						for ($i = 0; $i < $total_atividades; $i++)
						{
							$cod_atividade = $atividades->data["cod_atividade"];
							$atividade = new atividade();
							$atividade->carregar($cod_atividade);
							
							$nome_atividade = $atividade->getAtividade();
							$descricao_atividade = $atividade->getDescricao();
								
							$data_atividade = formataData($atividade->getDataAtividade(), "/");
							$hora_atividade = $atividade->getHoraAtividade();
							$data_entrega = formataData($atividade->getDataEntrega(), "/");
							$hora_entrega = $atividade->getHoraEntrega();
							$hora_entrega = substr($hora_entrega, 0, 5);
							
							$valor = $atividade->getValor();
							
							$anexo = new atividade_arquivo();
							$anexo->colecao($cod_atividade);
							$total_anexos = $anexo->linhas;
							
							if ($total_anexos == 0)
								$arquivos = "-";
							else
								$arquivos = $total_anexos;
								
							if ($cor_fundo == "laranja_linha_2")
								$cor_fundo = "laranja_linha_1";
							else
								$cor_fundo = "laranja_linha_2";
								
							//Verifica se o Usuário já realizou a Atividade
							$atividade_usuario = new atividade_usuario();
							$atividade_usuario->carregar($cod_atividade, $cod_usuario);
							$achou = $atividade_usuario->linhas;
							
							if ($achou == 0)
							{
								$situacao = "Não Entregue";
								$data_entrega_usuario = "-";
								$nota = "-";
							}
							else
								if ($achou == 1)
								{						
									$situacao = $atividade_usuario->getSituacao();
									switch($situacao)
									{
										case "A":
											$situacao = "Aguardando Correção";
										break;
										
										case "C":
											$situacao = "Corrigido";
										break;
										
										case "R":
											$situacao = "Refazer";
										break;
									}
									
									$data_entrega_usuario = formataData($atividade_usuario->getDataEntrega(), "/");
									$hora_entrega_usuario = $atividade_usuario->getHoraEntrega();
									$data_entrega_usuario = $data_entrega_usuario." às ".$hora_entrega_usuario;
									$nota = $atividade_usuario->getNota();
									if ($nota == "")
										$nota = "-";
								}
					?>
					<tr class="<?php echo $cor_fundo; ?>">
					  <td align="center" class="preto_simples"><?php echo $data_atividade; ?></td>
					  <td><a OnClick="JavaScript: visualizarAtividade(<?php echo $cod_atividade; ?>)" onMouseOver="JavaScript: window.status = 'Visualizar Atividade <?php echo $nome_atividade; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Visualizar Atividade <?php echo $nome_atividade; ?>" style="cursor:pointer" class="link_laranja"><?php echo $nome_atividade; ?></a></td>
					  <td align="center" class="preto_simples"><?php echo $arquivos; ?></td>
					  <td align="center" class="preto_simples"><?php echo $data_entrega." até às ".$hora_entrega." horas"; ?></td>
					  <td align="center" class="preto_simples"><?php echo $valor; ?></td>
					  <td align="center" class="preto_simples"><?php echo $situacao; ?></td>
					</tr>
					<?php
							$atividades->proximo();
						}	
					?>
					<tr> 
					  <td colspan="7" height="15"></td>
					</tr>
					<tr> 
					  <td colspan="7"><?php echo paginacao($pagina, $inicio, $limite, $quantidade, $url, true); ?></td>
					</tr>
					<tr> 
					  <td colspan="7" height="15"></td>
					</tr>
					<tr> 
					  <td colspan="7" height="15">
						<input type="hidden" name="cod_atividade" value="">
						<input type="hidden" name="acao" value="">
						<input type="hidden" name="acao_voltar" value="index">
						<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
						<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
					  </td>
					</tr>
					</form>
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
				  <td align="center" class="vermelho_simples">Nenhuma Atividade Cadastrada.</td>
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
