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
include("../../../classes/perfil.php");
include("../../../classes/forum.php");
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
$modulo = "forum";

$cod_usuario_acesso = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$num_forum = new forum();
$num_forum->colecao($cod_turma);
	
$quantidade = $num_forum->linhas;

//Paginação e Listagem
if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_topico = "index.php?pag=".$pagina;
	$url_ordena_respostas = "index.php?pag=".$pagina;
	$url_ordena_autor = "index.php?pag=".$pagina;
	$url_ordena_exibicoes = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_topico = "index.php?pag=".$pagina;
	$url_ordena_respostas = "index.php?pag=".$pagina;
	$url_ordena_autor = "index.php?pag=".$pagina;
	$url_ordena_exibicoes = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena_topico.= "&qtd=".$limite;
	$url_ordena_respostas.= "&qtd=".$limite;
	$url_ordena_autor.= "&qtd=".$limite;
	$url_ordena_exibicoes.= "&qtd=".$limite;
	$url_ordena_data.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_topico.= "&qtd=".$limite;
		$url_ordena_respostas.= "&qtd=".$limite;
		$url_ordena_autor.= "&qtd=".$limite;
		$url_ordena_exibicoes.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["forum_qtd_lst"]))
			$limite = $_SESSION["forum_qtd_lst"];
		else
			$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_topico.= "&qtd=".$limite;
		$url_ordena_respostas.= "&qtd=".$limite;
		$url_ordena_autor.= "&qtd=".$limite;
		$url_ordena_exibicoes.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordem;
}
else
{
	if (isset($_SESSION["forum_ordem"]))
		$ordem = $_SESSION["forum_ordem"];
	else
		$ordem = 1;
	$url_qtd.= "&ordem=".$ordem;	
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$num_forum->paginacaoForum($cod_turma, $limite, $inicio, $ordem);
$total_forum = $num_forum->linhas;
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
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"><img src="../../../imagens/cantos1.gif" width="10" height="10" border="0"></td>
		<td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="3" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			  <td bgcolor="#CCCCCC"><img src="../../../imagens/icones/forum/titulo_topicos_abertos.gif" width="300" height="52"></td>
			</tr>
		  </table>
		</td>
		<td height="10" background="../../../imagens/cantos8.gif" width="436" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantos7.gif"><img src="../../../imagens/cantos2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"></td>
		  <td height="42" bgcolor="#E8E8E8" width="100%" align="right"><a onClick="JavaScript: novoForum();" onMouseOver="JavaScript: window.status = 'Adicionar novo Tópico para Debate';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_cinza">Novo T&oacute;pico para Debate</a></td>
		<td width="10" background="../../../imagens/cantos7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../../imagens/cantos5.gif"></td>
		<td colspan="2" bgcolor="#e8e8e8">
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
			  <td width="100%">
			    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="1" background="../../../imagens/traco13.gif"><img src="../../../imagens/traco13.gif" border="0" height="1"></td>
				  </tr>
				  <tr>
				    <td height="10"></td>
				  </tr>
				</table>
				<?php
				if ($total_forum > 0)
				{
				?>
				<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right">
				  <form name="paginacao_forum" action="<?php echo $url_ordenacao; ?>" method="post">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td width="100%" class="campos" align="right">Listagem</td>
					  <td width="10">&nbsp;</td>
					  <td width="50">
						<select name="qtd_listagem" onChange="JavaScript: paginacaoForum('<?php echo $url_qtd; ?>');">
						  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
						</select>
					  </td>
					</tr>
				  </table>
				  </form>
				  <form action="../../geral/perfil_usuario.php" method="post" name="perfil_participante">
					<input type="hidden" name="cod_participante">
					<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
					<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
					<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
					<input type="hidden" name="acao_voltar" value="forum">
				  </form>
				  </td>
				</tr>
				<tr>
				  <td height="10"></td>
				</tr>
				<tr>
				  <td>
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<form name="tela_forum" method="post">
					<tr bgcolor="#CCCCCC">
					  <td>&nbsp;</td>
					  <td>
					    <table width="100%" cellpadding="0" cellspacing="0">
						  <tr>
						    <td width="25%" class="preto">Tópico&nbsp;&nbsp;<?php 
								if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_topico.= "&ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Decrescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 9:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 10:
											$url_ordena_topico.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_topico.= "&ordem=6";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_topico."'\" title=\"Ordem Crescente por T&oacute;pico\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por T&oacute;pico';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}
							  ?></td>
							  <td width="15%" align="center" class="preto">Respostas&nbsp;&nbsp;<?php 
								if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_respostas.= "&ordem=7";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Descrescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 9:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 10:
											$url_ordena_respostas.= "&ordem=8";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_respostas.= "&ordem=8";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Total de Respostas\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Respostas';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}
							  ?></td>
							  <td width="20%" align="center" class="preto">Autor&nbsp;&nbsp;<?php 
								if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_autor.= "&ordem=3";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Decrescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_respostas.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_respostas."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 9:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 10:
											$url_ordena_autor.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_autor.= "&ordem=4";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}
							  ?></td>
							  <td width="15%" align="center" class="preto">Exibições&nbsp;&nbsp;<?php 
								if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 9:
											$url_ordena_exibicoes.= "&ordem=10";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 10:
											$url_ordena_exibicoes.= "&ordem=9";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Decrescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_exibicoes.= "&ordem=10";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Total de Exibi&ccedil;&otilde;es\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Exibi&ccedil;&otilde;es';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}
							  ?></td>
							  <td width="25%" align="left" class="preto">Última Mensagem&nbsp;&nbsp;<?php
								if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Decrescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_data.= "&ordem=1";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 9:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 10:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_exibicoes.= "&ordem=2";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_exibicoes."'\" title=\"Ordem Crescente por Última Mensagem\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Última Mensagem';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}
							  ?></td>
						  </tr>
					    </table>
					  </td>
					</tr>
					<tr> 
					  <td colspan="3" height="15"></td>
					</tr>
					<?php
						$cor_fundo = "cinza_linha_1";
						
						for ($i=0; $i < $total_forum; $i++)
						{
							$cod_forum = $num_forum->data["cod_forum"];
							$forum = new forum();
							$forum->carregar($cod_forum);
							$cod_usuario = $forum->getCodigoUsuario();
							$autor = $forum->getNomeUsuario();
							$autor_c = $autor;
							$autor = reduzTexto($autor, 15);
							$topico = $forum->getAssunto();
							$topico_c = $topico;
							$topico = reduzTexto($topico, 35);
							$data_forum = $forum->data["data"];
							$hora_forum = $forum->data["hora"];
							$hora_forum = substr($hora_forum, 0, 5);
							$exibicoes = $forum->getVisualizacoes();
							
							$num_msgs = new forum();
							$num_msgs->colecaoMensagens($cod_forum);
							$total_msgs = $num_msgs->linhas;
							
							//Verifica se o Usuario acessou o Fórum
							$acesso_forum = $forum->verificaAcesso($cod_forum, $cod_usuario_acesso);
			
							if ($acesso_forum == "false")
							{
								$imagem_forum = "<img src=\"../../../imagens/icones/forum/nao_lida.gif\" border=\"0\">";
								$estilo = "link_cinza";
							}
							else
							{
								$imagem_forum = "<img src=\"../../../imagens/icones/forum/lida.gif\" border=\"0\">";
								$estilo = "link_cinza_visitado";
							}
							
							//Atualiza total de Respostas
							$forum->atualizaRespostas($cod_forum, $cod_turma, $total_msgs);
							
							//Verifica quantas páginas o fórum possue
							$forum->totalMensagens($cod_forum);
							$linhas = $forum->linhas;
							
							if ($linhas != 0)
							{
								$total_paginas = ceil($linhas / 10);
								$pagina_forum = $total_paginas;
							}
							
							$link_paginas = "";
							if ($total_paginas > 1)
							{
								$link_paginas = "<br><font class=\"".$estilo."\">[Páginas&nbsp;";
								
								if ($total_paginas > 5)
								{
									$limite_paginas = $total_paginas - 3;
								}
								
								for ($x = 0; $x < $total_paginas; $x++)
								{
									if (((($x + 1) == 1) or ($total_paginas < 5)) or (($total_paginas > 5) and (($x + 1) > $limite_paginas)))
									{			
										$link_paginas.= "<a OnClick=\"JavaScript: lerForum(".$cod_forum.", ".($x + 1).", 'forum')\" title=\"Ir para página ".($x + 1)."\" onMouseOver=\"JavaScript: window.status = 'Ir para página ".($x + 1)." ';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"".$estilo."\">".($x + 1)."";
									
										if (($x + 1) < $total_paginas)
											$link_paginas.= "</a>,&nbsp;";
										else
											$link_paginas.= "</a>";
									}
									else
										if (($x + 1) == ($limite_paginas))
											$link_paginas.= "...&nbsp;";
								}
								
								$link_paginas.= "]</font>";
							}
							//
							if ($total_msgs > 0)
							{
								$data_msg = $num_msgs->data["data"];
								$hora_msg = $num_msgs->data["hora"];
								$hora_msg = substr($hora_msg, 0, 5);
								$autor_msg = $num_msgs->data["nome"];
								$autor_msg_c = $autor_msg;
								$cod_usuario_msg = $num_msgs->data["cod_usuario"];
								$autor_msg = reduzTexto($autor_msg, 15);
								$ultima_msg = formataData($data_msg, "/")." ".$hora_msg." <a onClick=\"JavaScript: visualizarPerfil(".$cod_usuario_msg.", '../../geral/');\" title=\"Visualizar Perfil do Usuário ".$autor_msg_c."\" onMouseOver=\"JavaScript: window.status = 'Visualizar Perfil do Usuário ".$autor_msg_c."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"".$estilo."\">".$autor_msg."</a>";
							}
							else
								$ultima_msg = formataData($data_forum, "/")." ".$hora_forum." <a onClick=\"JavaScript: visualizarPerfil(".$cod_usuario.", '../../geral/');\" title=\"Visualizar Perfil do Usuário ".$autor_c."\" onMouseOver=\"JavaScript: window.status = 'Visualizar Perfil do Usuário ".$autor_c."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"".$estilo."\">".$autor."</a>";
							
							if ($cor_fundo == "cinza_linha_1")
								$cor_fundo = "cinza_linha_2";
							else
								$cor_fundo = "cinza_linha_1";
					?>
					<tr class="<?php echo $cor_fundo; ?>">
					  <td align="center" valign="middle"><?php echo $imagem_forum; ?>&nbsp;</td>
					  <td>
					    <table width="100%" cellpadding="0" cellspacing="0">
						  <tr class="<?php echo $cor_fundo; ?>">
							<td colspan="5" height="5"></td>
						  </tr>
						  <tr> 
						    <td width="25%"><a OnClick="JavaScript: lerForum(<?php echo $cod_forum; ?>, 1, 'forum')" title="<?php echo $topico_c; ?>" onMouseOver="JavaScript: window.status = 'Ler Fórum';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="<?php echo $estilo; ?>"><?php echo $topico; ?></a><?php echo $link_paginas; ?></td>
						    <td width="15%" align="center" class="preto_simples"><?php echo $total_msgs; ?></td>
						    <td width="20%" align="center"><a onClick="visualizarPerfil(<?php echo $cod_usuario; ?>, '../perfil/');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $autor_c; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="<?php echo $estilo; ?>" title="Visualizar Perfil do Usuário <?php echo $autor_c; ?>"><?php echo $autor; ?></a></td>
						    <td width="15%" align="center" class="preto_simples"><?php echo $exibicoes; ?></td>
						    <td width="25%" align="left" class="preto_simples"><?php echo $ultima_msg; ?></td>
						  </tr>
						  <tr class="<?php echo $cor_fundo; ?>">
							<td colspan="5" height="5"></td>
						  </tr>
					    </table>
					  </td>
					</tr>
					<?php
							$num_forum->proximo();
						}
					?>
					<tr> 
					  <td colspan="3" height="15"></td>
					</tr>
					<tr> 
					  <td colspan="3">
						<table width="100%" cellpadding="0" cellspacing="0">
						  <tr>
							<td><?php if ($limite == "todos") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $quantidade, $url, true); ?></td>
							<td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $quantidade; ?></font></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr> 
					  <td colspan="3" height="15"></td>
					</tr>
					<tr> 
					  <td colspan="3">
						<input type="hidden" name="cod_forum" value="">
						<input type="hidden" name="acao" value="">
						<input type="hidden" name="acao_voltar" value="index">
						<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
						<input type="hidden" name="pag" value="">
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
				    <td align="center" class="vermelho_simples">Nenhum Tópico Cadastrado.</td>
				  </tr>
				</table>
				<?php
				}
			    ?>
				<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="10"></td>
				  </tr>
				  <tr>
					<td height="1" background="../../../imagens/traco13.gif"><img src="../../../imagens/traco13.gif" border="0" height="1"></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../../imagens/cantos7.gif">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantos4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../../imagens/cantos6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantos3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>