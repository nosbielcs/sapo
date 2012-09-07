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
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "enquete";
$onLoad = "onLoad=\"JavaScript: defineLayer();\"";

$cod_turma = $_SESSION["cod_turma"];
$total_enquetes = new enquete();
$total_enquetes->colecao($cod_turma);
$quantidade = $total_enquetes->linhas;

//Ordenação e Paginação
if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_nome = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_ordena_total_votos = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_nome = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_ordena_total_votos = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena_nome.= "&qtd=".$limite;
	$url_ordena_data.= "&qtd=".$limite;
	$url_ordena_total_votos.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
		$url_ordena_total_votos.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["enquete_qtd_lst"]))
			$limite = $_SESSION["enquete_qtd_lst"];
		else
			$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
		$url_ordena_total_votos.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordem;
}
else
{
	if (isset($_SESSION["enquete_ordem"]))
		$ordem = $_SESSION["enquete_ordem"];
	else
		$ordem = 1;
	$url_qtd.= "&ordem=".$ordem;	
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$enquetes = new enquete();
$enquetes->paginacao($cod_turma, $limite, $inicio, $ordem);
$total_enquete = $enquetes->linhas;
		
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
          <td height="42" bgcolor="#F5E2EC" width="100%" align="right"><a onClick="JavaScript: novaEnquete();" class="link_magenta" onMouseOver="JavaScript: window.status = 'Nova Enquete';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer">Nova Enquete</a></td>
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
				  <?php
					if ($total_enquete > 0)
					{
				  ?>
				  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
					  <td width="100%">&nbsp;</td>
					  <td width="100">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <form name="paginacao_enquete" action="index.php" method="post">
						  <tr>
							<td class="campos" align="right">Listagem</td>
							<td width="10">&nbsp;</td>
							<td width="50">
							  <select name="qtd_listagem" onChange="JavaScript: paginacaoEnquete('<?php echo $url_qtd; ?>');">
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
					<?php 
						if (isset($_SESSION["mensagem_enquete"]))
						{
					  ?>
					<tr>
				      <td align="center" class="vermelho_simples" colspan="2"><?php echo $_SESSION["mensagem_enquete"]; ?></td>
					</tr>
					<?php
							unset($_SESSION["mensagem_enquete"]);
						}
					?>
					<tr>
					  <td colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<form name="enquete" method="post">
						<tr>
						  <td width="30" align="center"><input type="checkbox" name="todos_enquetes" onClick="marcaTodosEnquetes('mostra_enquete');"></td>
						  <td colspan="4" class="magenta" align="left">&nbsp;Marcar/Desmarcar Todos</td>
						</tr>
						<tr bgcolor="#E8BBD1"> 
						  <td align="center"></td>
						  <td class="preto">Enquete&nbsp;&nbsp;<?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nome.= "&ordem=3";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nome.= "&ordem=4";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_nome.= "&ordem=4";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Descrição\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Descrição';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						  <td width="90" class="preto" align="center">Data&nbsp;&nbsp;<?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_data.= "&ordem=1";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_data.= "&ordem=2";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_data.= "&ordem=2";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						  <td width="90" class="preto" align="center">Votos&nbsp;&nbsp;<?php
							  	if ($_GET["ordem"])
								{ 
									$ordem = $_GET["ordem"];
									
									switch($ordem) 
									{
										case 1:
											$url_ordena_total_votos.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_total_votos.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_total_votos.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_total_votos.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_total_votos.= "&ordem=6";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Decrescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_total_votos.= "&ordem=5";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
									}
								} 
								else
								{
									$url_ordena_total_votos.= "&ordem=6";
									echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_total_votos."'\" title=\"Ordem Crescente por Total de Votos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Votos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
								}		  
						  ?></td>
						</tr>
						<tr> 
						  <td colspan="5" height="15"></td>
						</tr>
						<?php
							$cor_fundo = "magenta_linha_1";
							
							for ($i = 0; $i < $total_enquete; $i++)
							{
								$cod_curso = $_SESSION["cod_curso"];
								$cod_enquete = $enquetes->data["cod_enquete"];
								$enquete = new enquete();
								$enquete->carregar($cod_enquete);
								
								$descricao_enquete = $enquete->getDescricao();
								$data_enquete = formataData($enquete->getDataEnquete(), "/");
								$hora_enquete = $enquete->getHoraEnquete();
								
								$link_enquete = "<a onClick=\"JavaScript: visualizaEnquete(".$cod_enquete.");'\" title=\"Visualizar Enquete\" onMouseOver=\"JavaScript: window.status = 'Visualizar Enquete';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" class=\"link_magenta\">".$descricao_enquete."</a>";
									
								if ($cor_fundo == "magenta_linha_1")
									$cor_fundo = "magenta_linha_2";
								else
									$cor_fundo = "magenta_linha_1";
						?>
						<tr>
						  <td height="1" colspan="5" class="<?php echo $cor_fundo; ?>"></td>
						</tr>
						<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_enquete; ?>">
						  <td align="center"><?php echo "<input type='checkbox' name='".$cod_enquete."' value='".$cod_enquete."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaCodigosEnquetes();\">"; ?></td>
						  <td><?php echo $link_enquete; ?></td>
						  <td align="center" class="preto_simples"><?php echo $data_enquete; ?></td>
						  <td align="center" class="preto_simples"><?php echo $total_votos; ?></td>
						</tr>
						<tr>
						  <td height="1" colspan="5" class="<?php echo $cor_fundo; ?>"></td>
						</tr>
						<?php
								$enquetes->proximo();
							}	
			
							for ($j = 0; $j < $quantidade; $j++)
							{
								$cod_enquete = $total_enquetes->data["cod_enquete"];
								$enquete = new enquete();
								$enquete->carregar($cod_enquete);
								
								$total_enquetes->proximo();
							}
						?>
						<tr>
						  <td colspan="5" height="15"></td>
						</tr>
						<tr> 
						  <td colspan="5">
						    <input type="hidden" name="codigos_enquetes" value="">
							<input type="hidden" name="cod_enquete" value="">
							<input type="hidden" name="acao" value="">
							<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
							<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
						  </td>
						</tr>
						<tr> 
						  <td colspan="5">
						    <table align="center" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							    <td height="34"><img src="../../../imagens/icones/conteudo/lado_esquerda1.gif" width="20" height="34"></td>
							    <td height="34" bgcolor="#E8BBD1"><a onClick="JavaScript: editarEnquete();" onMouseOver="JavaScript: window.status = 'Editar Enquete';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" alt="Editar Enquete" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: excluirenquete();" onMouseOver="JavaScript: window.status = 'Excluir Enquete';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Excluir</span><img src="../../../imagens/icones/geral/tipo1/excluir.gif" alt="Excluir Enquete" width="30" height="30" border="0" align="middle"></a></td>
							    <td height="34"><img src="../../../imagens/icones/conteudo/lado_direita1.gif" width="20" height="34"></td>
							  </tr>
						    </table>
						  </td>
						</tr>
						<tr>
						  <td colspan="5" height="15"></td>
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
				    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <form name="enquete" method="post">
					  <tr> 
					    <td align="center" class="vermelho_simples">Nenhuma Enquete Cadastrada.</td>
					  </tr>
					  <tr>
					    <td>
						  <input type="hidden" name="acao" value="">
						  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
					  	  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
					   	  <input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
						</td>
					  </tr>
					  </form>
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
