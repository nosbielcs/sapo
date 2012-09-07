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

include("../../../config/session.lib.super.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/perfil.php");
include("../../../classes/forum.php");
include("../../../classes/mensagem_bate_papo.php");
include("../../../classes/turma.php");
include("../../../classes/sala_bate_papo.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_bate_papo.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "bate_papo";

if ($_GET["acao"])
{
	$data_atual = $_SESSION["data_atual"];
	$hora_atual = $_SESSION["hora_atual"];
	$cod_sala = $_SESSION["cod_sala"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$usuario_bate_papo = new usuario_bate_papo();
	$situacao = "I";
	$usuario_bate_papo->alterar($cod_usuario, $cod_sala, $data_atual, $hora_atual, $situacao);
	
	unset($_SESSION["data_atual"]);
	unset($_SESSION["hora_atual"]);
	unset($_SESSION["cod_sala"]);
	unset($_SESSION["modo_mensagem"]);
	unset($_SESSION["rolagem"]);
	unset($_SESSION["reservado"]);
	unset($_SESSION["destinatario"]);
}

if ($_GET["ordem"])
	$ordem = $_GET["ordem"];
else
{
	if (isset($_SESSION["bate_papo_ordem"]))
		$ordem = $_SESSION["bate_papo_ordem"];
	else
		$ordem = 1;
}

$cod_turma = $_SESSION["cod_turma"];
$salas_bate_papo = new sala_bate_papo();
$salas_bate_papo->colecao($cod_turma, $ordem);

$total_salas_bate_papo = $salas_bate_papo->linhas;
?>
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
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"><img src="../../../imagens/cantot1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2" bgcolor="#99CC66">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
			    <td bgcolor="#99CC66"><img src="../../../imagens/icones/bate_papo/titulo_bate_papo.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantot8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantot7.gif"><img src="../../../imagens/cantot2.gif" width="10" height="10" border="0"></td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"></td>
		  <td height="42" align="right" bgcolor="#CFE7B8" width="100%"></td>
		  <td width="10" background="../../../imagens/cantot7.gif"></td>
	    </tr>
	    <tr>
		  <td width="10" background="../../../imagens/cantot5.gif"></td>
		  <td colspan="2" bgcolor="#CFE7B8">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
			  <tr>
			    <td width="100%" bgcolor="#CFE7B8">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
				    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
					<?php
					if ($total_salas_bate_papo > 0)
					{
				  	?>
					<tr>
					  <td colspan="3" class="verde">Escolha uma cor para identifica&ccedil;&atilde;o:</td>
					</tr>
					<tr>
					  <td colspan="3">
						<table width="200" cellpadding="0" cellspacing="0">
						  <tr>
							<td class="bp_cor01"><input type="radio" name="cor_mensagem" value="bp_cor01" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor02"><input type="radio" name="cor_mensagem" value="bp_cor02" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor03"><input type="radio" name="cor_mensagem" value="bp_cor03" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor04"><input type="radio" name="cor_mensagem" value="bp_cor04" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor05"><input type="radio" name="cor_mensagem" value="bp_cor05" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor06"><input type="radio" name="cor_mensagem" value="bp_cor06" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor07"><input type="radio" name="cor_mensagem" value="bp_cor07" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor08"><input type="radio" name="cor_mensagem" value="bp_cor08" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor09"><input type="radio" name="cor_mensagem" value="bp_cor09" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
						  </tr>
						  <tr>
							<td class="bp_cor10"><input type="radio" name="cor_mensagem" value="bp_cor10" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor11"><input type="radio" name="cor_mensagem" value="bp_cor11" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor12"><input type="radio" name="cor_mensagem" value="bp_cor12" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor13"><input type="radio" name="cor_mensagem" value="bp_cor13" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor14"><input type="radio" name="cor_mensagem" value="bp_cor14" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor15"><input type="radio" name="cor_mensagem" value="bp_cor15" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor16"><input type="radio" name="cor_mensagem" value="bp_cor16" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor17"><input type="radio" name="cor_mensagem" value="bp_cor17" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
							<td class="bp_cor18"><input type="radio" name="cor_mensagem" value="bp_cor18" onClick="JavaScript: document.salas_bate_papo.cor_mensagem.value = this.value;"></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td colspan="3" height="15"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
					<form name="salas_bate_papo" action="controle.php" method="post">
					<tr>
					  <td colspan="2">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <?php 
							if (isset($_SESSION["mensagem_bate_papo"]))
							{
						  ?>
						  <tr>
						    <td align="center" class="vermelho_simples" colspan="7"><?php echo $_SESSION["mensagem_bate_papo"]; ?></td>
						  </tr>
						  <?php
								unset($_SESSION["mensagem_bate_papo"]);
							}
						  ?>
						<tr bgcolor="#99CC66">
						  <td width="90" class="preto" align="center">Data&nbsp;&nbsp;<?php
							  if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_data = "index.php?ordem=1";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordenar Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_data = "index.php?ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_data = "index.php?ordem=2";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
							<td class="preto">Sala&nbsp;&nbsp;<?php
							  if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nome = "index.php?ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_nome = "index.php?ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_nome = "index.php?ordem=5";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
							<td class="preto" align="center">Descri&ccedil;&atilde;o</td>
							<td class="preto" align="center" width="70">Vagas&nbsp;&nbsp;<?php
							  if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem)
									{
										case 1:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordenar Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_vagas = "index.php?ordem=4";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Decrescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_vagas = "index.php?ordem=3";
											echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_vagas = "index.php?ordem=3";
									echo "<a onClick=\"JavaScipt: window.location.href = '".$url_ordena_vagas."'\" title=\"Ordem Crescente por Vagas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Vagas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
							<td class="preto" align="center" width="80">Conectados&nbsp;&nbsp;<?php
							  /*
							  if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordenar Crescente por Situação\"></a>";
										break;
										
										case 3:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 4:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 5:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 6:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 7:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Situação\"></a>";
										break;
										
										case 8:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\" alt=\"Ordem Decrescente por Situação\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_nome.= "&ordem=3";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Vagas\"></a>";
								}
								*/		  
							?></td>
							<td class="preto" width="80">Situação&nbsp;&nbsp;<?php
							  if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_nome.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_nome.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Fechada\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Fechada';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_nome.= "&ordem=8";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordenar por Situação Aberta\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Situação Aberta';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
							?></td>
						</tr>
						<tr> 
						  <td colspan="7">&nbsp;</td>
						</tr>
						<?php
							$cor_fundo = "verde_linha_1";
							
							for ($i = 0; $i < $total_salas_bate_papo; $i++)
							{
								$cod_sala = $salas_bate_papo->data["cod_sala"];
								$sala_bate_papo = new sala_bate_papo();
								$sala_bate_papo->carregar($cod_sala);
								
								$nome_sala = $sala_bate_papo->getNome();
								$descricao_sala = $sala_bate_papo->getDescricao();
									
								$data_sala = formataData($sala_bate_papo->getDataBatePapo(), "/");
								$hora_sala = $sala_bate_papo->getHoraBatePapo();
								$vagas = $sala_bate_papo->getVagas();
								$situacao = $sala_bate_papo->getSituacao();
								
								if ($situacao == "A")
								{
									$situacao = "Aberta";
									$link_sala = "JavaScript: abreSalaBatePapo(".$cod_sala.")";
								}
								else
								{
									$situacao = "Fechada";
									$link_sala = "JavaScript: salaBatePapoFechada(".$cod_sala.")";
								}
									
								if ($cor_fundo == "verde_linha_1")
									$cor_fundo = "verde_linha_2";
								else
									$cor_fundo = "verde_linha_1";
									
								$usuarios_bate_papo = new usuario_bate_papo();
								$usuarios_bate_papo->colecao($cod_sala);
								$total_usuarios_bate_papo = $usuarios_bate_papo->linhas;
								$usuarios_conectados = 0;
								
								for ($j = 0; $j < $total_usuarios_bate_papo; $j++)
								{
									$cod_usuario = $usuarios_bate_papo->data["cod_usuario"];
									$sala_usuario = $usuarios_bate_papo->data["cod_sala"];
									$data_usuario = $usuarios_bate_papo->data["data"];
									$hora_usuario = $usuarios_bate_papo->data["hora"];
									$usuario_chat = new usuario_bate_papo();
									$usuario_chat->verificarSituacao($cod_usuario, $sala_usuario, $data_usuario, $hora_usuario);
									$situacao_usuario = $usuario_chat->getSituacao();
									
									//$nome = $usuario->getNome();
									//$busca = $oUsers->searchIT("", $cod_usuario, 1);
									
									if ($situacao_usuario == "A")
										$usuarios_conectados++;
									/*{
										if (count($busca) > 0)
										{
											$usuarios_conectados++;
										}
										else
										{
											$situacao = "I";
											$usuario_bate_papo = new usuario_bate_papo();
											$usuario_bate_papo->alterarSatuts($cod_usuario, $cod_sala, $situacao);
											$modo_mensagem = "";
											$mensagem = "Saiu da Sala de Bate Papo";
											
											$reservado = "N";
											$mensagem_bate_papo = new mensagem_bate_papo();
											$mensagem_bate_papo->setCodigoSala($sala_usuario);
											$mensagem_bate_papo->setCodigoUsuario($cod_usuario);
											$mensagem_bate_papo->setCodigoDestinatario(0);
											$mensagem_bate_papo->setModoMensagem($modo_mensagem);
											$mensagem_bate_papo->setMensagem($mensagem);
											$mensagem_bate_papo->setDataMensagem($data_saida);
											$mensagem_bate_papo->setHoraMensagem($hora_saida);
											$mensagem_bate_papo->setReservado($reservado);
											$mensagem_bate_papo->inserir();
										}
									}*/
									
									$usuarios_bate_papo->proximo();
								}
									
						?>
						<tr>
				          <td height="1" colspan="7" class="<?php echo $cor_fundo; ?>"></td>
					    </tr>
						<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_sala; ?>"> 
						  <td align="center" class="preto_simples"><?php echo $data_sala; ?></td>
						  <td><a onMouseOver="JavaScript: window.status = 'Acessar Sala de Bate Papo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_verde"><?php echo $nome_sala; ?></a></td>
						  <td align="center" class="preto_simples"><?php echo $descricao_sala; ?></td>
						  <td align="center" class="preto_simples"><?php echo $vagas; ?></td>
						  <td align="center" class="preto_simples"><?php echo $usuarios_conectados; ?><input type="hidden" id="conectados_<?php echo $cod_sala; ?>" name="conectado_<?php echo $cod_sala; ?>" value="<?php echo $usuarios_conectados; ?>"></td>
						  <td align="center" class="preto_simples"><?php echo $situacao; ?></td>
						</tr>
						<tr>
				          <td height="1" colspan="7" class="<?php echo $cor_fundo; ?>"></td>
					    </tr>
						<?php
								$salas_bate_papo->proximo();
							}
						?>
						<tr> 
						  <td colspan="7" height="15"></td>
						</tr>
						</table>
					  </td>
					</tr>
				  <?php
					}
					else
					{
				  ?>
					<tr>
					  <td align="center" class="vermelho_simples">Nenhuma Sala de Bate Papo Cadastrada.</td>
					</tr>
				  <?php
					}
				  ?>
				    <tr> 
					  <td colspan="7">
					  	<input type="hidden" name="cor_mensagem" value="">
						<input type="hidden" name="codigosSalasBatePapo" value="">
						<input type="hidden" name="acao_bate_papo" value="">
						<input type="hidden" name="cod_sala_bate_papo" value="">
					  </td>
					</tr>
				  </form>
				  </table>
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
					</tr>
				  </table>
				</td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantot7.gif">&nbsp;</td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantot4.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantot6.gif" colspan="2"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantot3.gif" width="10" height="10" border="0"></td>
	    </tr>
	  </table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
