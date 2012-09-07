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
include("../../../classes/conteudo.php");
include("../../../classes/conteudo_usuario.php");
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
$modulo = "conteudo";

$cod_turma = $_SESSION["cod_turma"];
$total_conteudos = new conteudo();
$total_conteudos->colecao($cod_turma, "");
$quantidade = $total_conteudos->linhas;

//Ordenação e Paginação
if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_nome = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_ordena_tamanho = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_nome = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_ordena_tamanho = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena_nome.= "&qtd=".$limite;
	$url_ordena_data.= "&qtd=".$limite;
	$url_ordena_tamanho.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
		$url_ordena_tamanho.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["conteudo_qtd_lst"]))
			$limite = $_SESSION["conteudo_qtd_lst"];
		else
			$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
		$url_ordena_tamanho.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordem;
}
else
{
	if (isset($_SESSION["conteudo_ordem"]))
		$ordem = $_SESSION["conteudo_ordem"];
	else
		$ordem = 1;
	$url_qtd.= "&ordem=".$ordem;	
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$conteudos = new conteudo();
$conteudos->paginacao($cod_turma, $limite, $inicio, $ordem);
$total_conteudo = $conteudos->linhas;
		
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

<body topmargin="0" leftmargin="0" onLoad="JavaScript: defineLayer();">
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
          <td height="42" bgcolor="#F5E2EC" width="100%" align="right"></td>
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
				  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
				  <?php
					if ($total_conteudo > 0)
					{
				  ?>
					<tr>
					  <td width="100%">&nbsp;</td>
					  <td width="100">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <form name="paginacao_forum" action="index.php" method="post">
						  <tr>
							<td class="campos" align="right">Listagem</td>
							<td width="10">&nbsp;</td>
							<td width="50">
							  <select name="qtd_listagem" onChange="JavaScript: paginacaoConteudo('<?php echo $url_qtd; ?>');">
								<option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
								<option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
								<option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
								<option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
								<option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
							  </select>
							</td>
						  </tr>
						  </form>
						</table>
					  </td>
					</tr>
					<tr>
					  <td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td colspan="2" height="10"></td>
						</tr>
						<tr bgcolor="#E8BBD1"> 
						  <td align="center"></td>
						  <td width="30"></td>
						  <td class="preto">Conte&uacute;do&nbsp;&nbsp;<?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nome.= "&ordem=3";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_nome.= "&ordem=4";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descri&ccedil;&atilde;o\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descri&ccedil;&atilde;o';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						  <td width="90" class="preto" align="center">Data&nbsp;&nbsp;
						    <?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_data.= "&ordem=1";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_data.= "&ordem=2";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						  <td width="90" class="preto" align="center">Tamanho&nbsp;&nbsp;
						    <?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_tamanho.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_tamanho.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_tamanho.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_tamanho.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_tamanho.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Decrescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_tamanho.= "&ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_tamanho.= "&ordem=6";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_tamanho."'\" title=\"Ordem Crescente por Tamanho do Conte&uacute;do\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Tamanho do Conte&uacute;do';\" onMouseOut=\"JavaScript: window.status = 'SA&sup2;pO - Sistema de Apoio &agrave; Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						  <td width="90" class="preto" align="center">Acesso</td>
						</tr>
						<tr> 
						  <td colspan="6" height="15"></td>
						</tr>
						<?php
							$cor_fundo = "magenta_linha_1";
							
							for ($i = 0; $i < $total_conteudo; $i++)
							{
								$cod_curso = $_SESSION["cod_curso"];
								$cod_conteudo = $conteudos->data["cod_conteudo"];
								$conteudo = new conteudo();
								$conteudo->carregar($cod_conteudo);
								
								$nome_conteudo = $conteudo->getNome();
								$descricao_conteudo = $conteudo->getDescricao();
								$cod_hierarquia = $conteudo->getCodigoHierarquia();
								$data_conteudo = formataData($conteudo->getDataConteudo(), "/");
								$hora_conteudo = $conteudo->getHoraConteudo();
								$tipo_conteudo = $conteudo->getTipo();
								
								if (($cod_hierarquia == 0) and ($i > 0))
									$linha = "<tr><td colspan=\"5\" height=\"1\" background=\"../../../imagens/traco10.gif\"></td></tr><tr><td colspan=\"5\" height=\"10\"></td></tr>";
								else
									$linha = "";
								
								if ($tipo_conteudo != "site")
								{
									$tamanho = $conteudo->getTamanho();
									$tamanho_por_pagina = $tamanho_por_pagina + $tamanho;
									$tamanho = tamanhoArquivo($tamanho);
								}
								else
								{
									$tamanho = "-";
									$permissao = "-";
									$icone = "<img src=\"../../../imagens/icones/conteudo/link.gif\" title=\"Link para site na Internet\">";
								}
								
								switch($tipo_conteudo)
								{
									case "html":
										$diretorio_especifico = str_replace(" ", "_", $nome_conteudo);
										$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/html/";
										$diretorio_arquivo = $diretorio_conteudo.$diretorio_especifico."/";
										$icone = "<img src=\"../../../imagens/icones/conteudo/html.gif\" title=\"Link para site Local\">";
									break;
									
									case "doc":
										$nome_arquivo = str_replace(".doc","", $nome_conteudo);
										$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
										$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/doc/".$diretorio_especifico."/";
										$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
										$icone = "<img src=\"../../../imagens/icones/conteudo/doc.gif\" title=\"Documento de Texto\">";
									break;
									
									case "powerpoint":
										$nome_arquivo = str_replace(".ppt","", $nome_conteudo);
										$nome_arquivo = str_replace(".pps","", $nome_conteudo);
										$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
										$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/ppt/".$diretorio_especifico."/";
										$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
										$icone = "<img src=\"../../../imagens/icones/conteudo/pps.gif\" title=\"Documento de Apresentação de Slides\">";
									break;
									
									case "pdf":
										$nome_arquivo = str_replace(".pdf","", $nome_conteudo);
										$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
										$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/pdf/".$diretorio_especifico."/";
										$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
										$icone = "<img src=\"../../../imagens/icones/conteudo/pdf.gif\" title=\"Documento de Texto Criptografado\">";
									break;
								}
									
								if ($cor_fundo == "magenta_linha_1")
									$cor_fundo = "magenta_linha_2";
								else
									$cor_fundo = "magenta_linha_1";
									
								//Verfifica Acesso ao Conteudo
								$conteudo_usuario = new conteudo_usuario();
								$conteudo_usuario->carregar($cod_conteudo, $cod_usuario);
								$acesso = $conteudo_usuario->getAcesso();
								
								if ($acesso == "P")
									$permissao = "Permitido";
								else
									if ($acesso == "N")
										$permissao = "Negado";
									else
										if ($tipo_conteudo == "site")
											$permissao = "Permitido";
										else
											$permissao = "Negado";
										
								$cod_usuario = $_SESSION["cod_usuario"];
								$login_usuario = $_SESSION["login_usuario"];
								$senha_usuario = $_SESSION["senha_usuario"];
								
								if ($acesso == "")
								{
									$acesso = "P";
									if ($tipo_conteudo == "html")
										forneceAcessoConteudo($cod_conteudo, $cod_usuario, $cod_turma, $diretorio_arquivo, $login_usuario, $senha_usuario, $acesso, true, "diretorio");
									else
										forneceAcessoConteudo($cod_conteudo, $cod_usuario, $cod_turma, $diretorio_conteudo, $login_usuario, $senha_usuario, $acesso, true, "diretorio");
								}
								else
									if ($acesso == "P")
										if ($tipo_conteudo == "html")
											forneceAcessoConteudo($cod_conteudo, $cod_usuario, $cod_turma, $diretorio_arquivo, $login_usuario, $senha_usuario, $acesso, false, "diretorio");
										else
											forneceAcessoConteudo($cod_conteudo, $cod_usuario, $cod_turma, $diretorio_conteudo, $login_usuario, $senha_usuario, $acesso, false, "diretorio");
								//
								$diretorio_arquivo_ = "";
								
								$total_caracteres = strlen($diretorio_arquivo);
							
								for($x = 0; $x < $total_caracteres; $x++)
									$diretorio_arquivo_ .= substituiCaracter($diretorio_arquivo[$x], "link");
						?>
						<tr>
						  <td colspan="6" height="2"></td>
						</tr>
						<tr class="<?php echo $cor_fundo; ?>"> 
						  <td align="center"></td>
						  <?php
							if ($tipo_conteudo == "site")
							{
								if ($cod_hierarquia != 0)
									$link_conteudo = "&nbsp;&nbsp;<a href=\"".$nome_conteudo."\" title=\"".$descricao_conteudo_."\" target=\"_blank\" class=\"link_magenta\" onMouseOver=\"JavaScript: window.status = '".$descricao_conteudo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\">".$descricao_conteudo."</a>";
								else
									$link_conteudo = "<a href=\"".$nome_conteudo."\" title=\"".$descricao_conteudo_."\" target=\"_blank\" class=\"link_magenta\" onMouseOver=\"JavaScript: window.status = '".$descricao_conteudo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\">".$descricao_conteudo."</a>";
							}
							else
							{
								if ($cod_hierarquia != 0)
									$link_conteudo = "&nbsp;&nbsp;<a onClick=\"JavaScript: visualizaConteudo(".$cod_conteudo.", '".$diretorio_arquivo_."', '".$tipo_conteudo."')\" title=\"".$descricao_conteudo."\" class=\"link_magenta\" onMouseOver=\"JavaScript: window.status = 'Visualizar Conteúdo ".$descricao_conteudo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\">".$descricao_conteudo."</a>";
								else
									$link_conteudo = "<a onClick=\"JavaScript: visualizaConteudo(".$cod_conteudo.", '".$diretorio_arquivo_."', '".$tipo_conteudo."')\" title=\"".$descricao_conteudo."\" class=\"link_magenta\" onMouseOver=\"JavaScript: window.status = 'Visualizar Conteúdo ".$descricao_conteudo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\">".$descricao_conteudo."</a>";
							}							
						  ?>
						  <td align="center"><?php echo $icone; ?></td>
						  <td><?php echo $link_conteudo; ?></td>
						  <td align="center" class="preto_simples"><?php echo $data_conteudo; ?></td>
						  <td align="center" class="preto_simples"><?php echo $tamanho; ?></td>
						  <td align="center" class="magenta"><?php echo $permissao; ?></td>
						</tr>
						<tr>
						  <td colspan="6" height="2"></td>
						</tr>
						<?php
								$conteudos->proximo();
							}	
						?>
						<tr> 
						  <td colspan="6" height="15"></td>
						</tr>
						<?php			
							for ($j = 0; $j < $quantidade; $j++)
							{
								$cod_conteudo = $total_conteudos->data["cod_conteudo"];
								$conteudo = new conteudo();
								$conteudo->carregar($cod_conteudo);
								$tipo_conteudo = $conteudo->getTipo();
								
								if ($tipo_conteudo != "site")
								{
									$tamanho = $conteudo->getTamanho();
									$tamanho_total_conteudos = $tamanho_total_conteudos + $tamanho;
									$tamanho = tamanhoArquivo($tamanho);
								}
								
								$total_conteudos->proximo();
							}
						?>
						<tr> 
						  <td colspan="6" height="15"></td>
						</tr>
						<tr> 
						  <td colspan="6">
						    <table width="100%" cellpadding="0" cellspacing="0">
							  <tr>
							    <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $quantidade, $url, true); ?></td>
								<td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $quantidade; ?></font></td>
							  </tr>
							</table>
						  </td>
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
					  <td align="center" class="vermelho_simples">Nenhum Conte&uacute;do Cadastrado.</td>
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
