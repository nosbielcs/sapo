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
include("../../../classes/atividade_usuario.php");
include("../../../classes/curso.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "atividades";

if ($_GET["cod_atividade"])
	$cod_atividade = $_GET["cod_atividade"];
else
	$cod_atividade = $_POST["cod_atividade"];

$atividade = new atividade();
$atividade->carregar($cod_atividade);

$nome_atividade = $atividade->getAtividade();
$descricao_atividade = $atividade->getDescricao();
	
$data_atividade = formataData($atividade->getDataAtividade(), "/");
$hora_atividade = $atividade->getHoraAtividade();
$data_entrega = formataData($atividade->getDataEntrega(), "/");
$hora_entrega = $atividade->getHoraEntrega();
$hora_atividade = substr($hora_atividade, 0, 5);
$hora_entrega = substr($hora_entrega, 0 , 5);

$valor = $atividade->getValor();

$anexo = new atividade_arquivo();
$anexo->colecao($cod_atividade);
$total_anexos = $anexo->linhas;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	if ($_GET["ordem"])
		$ordem = $_GET["ordem"];
	else
		$ordem = 1;

//Ordenação Listagem
if ($_POST["pagina"])
{
	$pagina = $_POST["pagina"];
	$url_ordenacao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_ordena_nome = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_ordena_nota = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_ordena_envio = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_ordena_correcao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_ordena_data = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
	$url_qtd = "visualiza.php?cod_atividade=".$cod_atividade."&pag=1";
}
else
	if ($_GET["pag"])
	{
		$pagina = $_GET["pag"];
		$url_ordenacao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_nome = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_nota = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_envio = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_correcao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_data = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_qtd = "visualiza.php?cod_atividade=".$cod_atividade."&pag=1";
	}
	else
	{
		$pagina = 1;
		$url_ordenacao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_nome = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_nota = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_envio = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_correcao = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_ordena_data = "visualiza.php?cod_atividade=".$cod_atividade."&pag=".$pagina;
		$url_qtd = "visualiza.php?cod_atividade=".$cod_atividade."&pag=1";
	}

if ($_POST["quantidade"])
{
	$limite = $_POST["quantidade"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena_nome.= "&qtd=".$limite;
	$url_ordena_nota.= "&qtd=".$limite;
	$url_ordena_envio.= "&qtd=".$limite;
	$url_ordena_correcao.= "&qtd=".$limite;
	$url_ordena_data.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_nota.= "&qtd=".$limite;
		$url_ordena_envio.= "&qtd=".$limite;
		$url_ordena_correcao.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["atividade_qtd_lst"]))
			$limite = $_SESSION["atividade_qtd_lst"];
		else
			$limite = 10;
			
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_nome.= "&qtd=".$limite;
		$url_ordena_nota.= "&qtd=".$limite;
		$url_ordena_envio.= "&qtd=".$limite;
		$url_ordena_correcao.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}

if ($_POST["filtro"])
{
	$filtro = $_POST["filtro"];
	$url_ordenacao.= "&filtro=".$filtro;
	$url_ordena_nome.= "&filtro=".$filtro;
	$url_ordena_nota.= "&filtro=".$filtro;
	$url_ordena_envio.= "&filtro=".$filtro;
	$url_ordena_correcao.= "&filtro=".$filtro;
	$url_ordena_data.= "&filtro=".$filtro;
}
else
	if ($_GET["filtro"])
	{
		$filtro = $_GET["filtro"];
		$url_ordenacao.= "&filtro=".$filtro;
		$url_ordena_nome.= "&filtro=".$filtro;
		$url_ordena_nota.= "&filtro=".$filtro;
		$url_ordena_envio.= "&filtro=".$filtro;
		$url_ordena_correcao.= "&filtro=".$filtro;
		$url_ordena_data.= "&filtro=".$filtro;
	}
	else
		$filtro = "";

if ($_GET["ordem"])
{
	$ordenacao = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordenacao."#topo";
}
else
{
	$ordenacao = 1;
	$url_qtd.= "&ordem=".$ordenacao."#topo";
}

$atividades_usuarios = new atividade_usuario();
$atividades_usuarios->paginacaoAtividadesEntregues($cod_turma, $cod_atividade, "T", "0", 1, $filtro);
$total = $atividades_usuarios->linhas;

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "visualiza.php?ordem=".$ordenacao."&cod_atividade=".$cod_atividade."&filtro=".$filtro;
//
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
		document.editar_atividade.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.editar_atividade.submit();
	}
	
	function filtroAtividade()
	{
		document.editar_atividade.action = "visualiza.php#topo";
		document.editar_atividade.submit();
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
		<td height="42" bgcolor="#ffecce" width="100%" align="right"><a onClick="JavaScript: novaAtividade();" onMouseOver="JavaScript: window.status = 'Nova Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_laranja">Nova Atividade</a></td>
		<td width="10" background="../../../imagens/cantoq7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../../imagens/cantoq5.gif"></td>
		<td colspan="2" bgcolor="#ffecce">
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
		    <form name="editar_atividade" action="formulario.php" method="post">
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
				<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td valign="top" align="center">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE3B9">
						<tr>
						  <td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							  <?php 
								if (isset($_SESSION["mensagem_atividade"]))
								{
							  ?>
							  <tr>
							    <td align="center" class="vermelho_simples" colspan="3"><?php echo $_SESSION["mensagem_atividade"]; ?></td>
							  </tr>
							  <?php
									unset($_SESSION["mensagem_atividade"]);
								}
							  ?>
							  <tr>
								<td class="preto" width="140" align="right">Atividade:</td>
								<td width="10">&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $nome_atividade; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Descricao:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo nl2br($descricao_atividade); ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Data / Hora de Cadastro:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $data_atividade." às ".$hora_atividade; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Data / Hora de Entrega:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $data_entrega." até as ".$hora_entrega; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Valor:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $valor; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Arquivos Anexos:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left">
								<?php
									if ($total_anexos  > 0)
									{
										echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
										
										for ($i = 0; $i < $total_anexos; $i++)
										{
											$cod_arquivo = $anexo->data["cod_arquivo"];
											$arquivo = new atividade_arquivo();
											$arquivo->carregar($cod_arquivo);
											$nome_arquivo = $arquivo->getNome();
											$descricao_arquivo = $arquivo->getDescricao();
											
											echo "  <tr>";
											echo "    <td>";
											echo "      <a onClick=\"JavaScript: window.location.href = 'download.php?cod_atividade=".$cod_atividade."&arquivo=".$nome_arquivo."'\" onMouseOver=\"JavaScript: window.status = 'Baixar Arquivo ".$nome_arquivo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Baixar Arquivo\" style=\"cursor:pointer\" class=\"link_laranja\">".$nome_arquivo."</a>";
											echo "    </td>";
											echo "  </tr>";
											echo "  <tr>";
											echo "    <td class=\"preto_simples\">";
											echo "      ".$descricao_arquivo;
											echo "    </td>";
											echo "  </tr>";
											
											if (($i + 1) < $total_anexos)
											{
												echo "  <tr>";
												echo "    <td>";
												echo "      &nbsp;";
												echo "    </td>";
												echo "  </tr>";
											}
											
											$anexo->proximo();
										}
										
										echo "</table>";
									}
									else
										echo "Nenhum arquivo em anexo";
								?>
								</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"><input type="hidden" name="cod_atividade" value="<?php echo $cod_atividade; ?>"><input type="hidden" name="cod_aluno" value=""><input type="hidden" name="acao" value="editar"><input type="hidden" name="acao_voltar" value="visualiza"><input type="hidden" name="pagina" value="<?php echo $pagina; ?>"><input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="filtro" value="<?php echo $filtro; ?>"></td>
							  </tr>
							  <tr>
								<td colspan="3">
								  <table align="center" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_esquerdo1.gif" width="20" height="34"></td>
									  <td height="34" bgcolor="#FFECCE"><a onClick="JavaScript: document.editar_atividade.submit();" onMouseOver="JavaScript: window.status = 'Editar Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Editar Atividade" style="cursor:pointer" class="dcontexto"><span>Editar Atividade</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_direito1.gif" width="20" height="34"></td>
									</tr>
								  </table>
								</td>
							  </tr>
							  <tr>
							    <td colspan="3" height="15"></td>
							  </tr>
							</table>
						  </td>
						</tr>
					  </table>
					</td>
				  </tr>
				  <tr>
					<td height="15"><a name="topo"></a></td>
				  </tr>
				  <tr>
					<td>
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
						<tr>
						  <td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							  <tr>
								<td colspan="8">
								  <table cellpadding="0" cellspacing="0" width="100%">
								    <tr>
									  <td class="preto">Atividades Entregues</td>
									  <td class="preto" align="right">Listagem:</td>
									  <td width="10"></td>
									  <td width="50">
									    <select name="quantidade" onChange="JavaScript: filtroAtividade();">
										  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
										  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
										  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
										  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
										  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
									    </select>
									  </td>
									  <td class="preto" align="right">Filtro:</td>
									  <td width="10"></td>
									  <td width="80" align="right">
									    <select name="filtro" onChange="JavaScript: filtroAtividade();">
										  <option value="E" <?php if ($filtro == "E") echo "selected"; ?>>Entregue</option>
										  <option value="N" <?php if ($filtro == "N") echo "selected"; ?>>Não Entregue</option>
										  <option value="C" <?php if ($filtro == "C") echo "selected"; ?>>Corrigido</option>
										  <option value="A" <?php if ($filtro == "A") echo "selected"; ?>>Aguardando Correção</option>
										  <option value="R" <?php if ($filtro == "R") echo "selected"; ?>>Refazer</option>
										  <option value="" <?php if ($filtro == "") echo "selected"; ?>>Todos</option>
										</select>
									  </td>
									</tr>
								  </table>
								</td>
							  </tr>
							  <tr>
								<td colspan="8" height="15"></td>
							  </tr>
							  <?php
							  	$atividades_usuarios->paginacaoAtividadesEntregues($cod_turma, $cod_atividade, $limite, $inicio, $ordenacao, $filtro);
								
								$total_usuarios = $atividades_usuarios->linhas;
								
								if ($total_usuarios > 0)
								{				
							  ?>
							  <tr bgcolor="#FFE3B9">
								<td class="preto" align="left" width="25%">Nome&nbsp;&nbsp;<?php
									switch($ordem) 
									{
										case 1:
											$url_ordena_nome.= "&ordem=2#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Crescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_nome.= "&ordem=1#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nome."'\" title=\"Ordem Decrescente por Nome\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nome';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}  
							  ?></td>
								<td class="preto" align="center" width="8%">Arquivo</td>
								<td class="preto" align="center" width="10%">Nota&nbsp;&nbsp;<?php
									switch($ordem) 
									{
										case 1:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Crescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_nota.= "&ordem=4#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_nota.= "&ordem=3#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_nota."'\" title=\"Ordem Decrescente por Nota\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Nota';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}  
							  ?></td>
								<td class="preto" align="center" width="15%">Comentário</td>
								<td class="preto" align="center" width="12%">Entrega&nbsp;&nbsp;
								  <?php
									switch($ordem) 
									{
										case 1:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_envio.= "&ordem=6#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Crescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_envio.= "&ordem=5#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_envio."'\" title=\"Ordem Decrescente por Data de Entrega\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Entrega';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}  
							  ?></td>
								<td class="preto" align="center" width="12%">Correção&nbsp;&nbsp;<?php
									switch($ordem) 
									{
										case 1:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 2: 
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 3:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 4:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 5:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
										break;
										
										case 6:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 7:
											$url_ordena_correcao.= "&ordem=8#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Decrescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
										
										case 8:
											$url_ordena_correcao.= "&ordem=7#topo";
											echo "<a onClick=\"JavaScript: window.location.href = '".$url_ordena_correcao."'\" title=\"Ordem Crescente por Data de Correção\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data de Correção';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
										break;
									}  
							  ?></td>
								<td class="preto" align="center" width="10%">Situação</td>
								<td class="preto" align="center" width="8%">Açao</td>
							  </tr>
							  <tr>
								<td colspan="8" height="15"></td>
							  </tr>
							  <?php
								  	for ($j = 0; $j < $total_usuarios; $j++)
									{
										$cod_usuario = $atividades_usuarios->data["cod_usuario"];									
										$nome = reduzTexto($atividades_usuarios->data["nome"], 25);
										$nome_completo = $atividades_usuarios->data["nome"];
										
										if (!empty($atividades_usuarios->data["cod_atividade"]))
										{
											$link_corrigir = "<a onClick=\"JavaScript: corrigirAtividade(".$cod_atividade.", ".$cod_usuario.")\" class=\"link_laranja\" onMouseOver=\"JavaScript: window.status = 'Verificar Atividade Entregue por ".$nome_completo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='Verificar Atividade Entregue por ".$nome_completo."'>".$nome."</a>";
											$data_entrega = formataData($atividades_usuarios->data["data_entrega"], "/");
											$data_correcao = formataData($atividades_usuarios->data["data_correcao"], "/");
											
											if ($data_correcao == "00/00/0000")
												$data_correcao = "-";
											
											$situacao = $atividades_usuarios->data["situacao"];
											
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
											
											$arquivo = $atividades_usuarios->data["anexo"];
											
											if (empty($arquivo))
											{
												$link_anexar_arquivo = "<a onClick=\"JavaScript: anexarArquivoAtividadeAluno(".$cod_atividade.", ".$cod_usuario.")\" onMouseOver=\"JavaScript: window.status = 'Anexar Arquivo';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='Anexar Arquivo' class=\"link_laranja\">Anexar</a>";
												$link_arquivo_entregue = "-";
											}
											else
											{
												$link_anexar_arquivo = "<a onClick=\"JavaScript: excluirArquivoAtividadeAluno(".$cod_atividade.", ".$cod_usuario.")\" onMouseOver=\"JavaScript: window.status = 'Excluir Arquivo';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='Excluir Arquivo' class=\"link_vermelho\">Excluir</a>";
												$link_arquivo_entregue = "<a onClick=\"JavaScript: window.location.href = 'download.php?cod_atividade=".$cod_atividade."&cod_usuario=".$cod_usuario."&arquivo=".$arquivo."'\" onMouseOver=\"JavaScript: window.status = 'Baixar Arquivo ".$arquivo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" title=\"Baixar Arquivo '".$arquivo."' entregue por ".$nome_completo."\" class=\"link_laranja\" target=\"_blank\">Baixar</a>";
											}
											
											$comentario = $atividades_usuarios->data["comentario"];
											$nota =$atividades_usuarios->data["nota"];
											
											if ($nota == "")
												$nota = "-";
											
											if ($comentario != "")
											{
												$comentario_m = reduzTexto($atividades_usuarios->data["comentario"], 15);
												$comentario = "<a onClick=\"JavaScript: corrigirAtividade(".$cod_atividade.", ".$cod_usuario.");\" onMouseOver=\"JavaScript: window.status = 'Verificar Atividade Entregue por ".$nome."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='".$comentario."' class=\"link_laranja\">".$comentario_m."</a>";	
											}
											else
												$comentario = $atividades_usuarios->data["comentario"];
													
											$entregou = true;
										}
										else
										{
											$link_corrigir = "<a onClick=\"JavaScript: corrigirAtividade(".$cod_atividade.", ".$cod_usuario.")\" class=\"link_laranja\" onMouseOver=\"JavaScript: window.status = '".$nome_completo." não entregou a Atividade';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='".$nome_completo." não entregou a Atividade'>".$nome."</a>";
											//$link_corrigir = $nome;
											$situacao = "Não Entregou";
											$data_entrega = "-";
											$data_correcao = "-";
											$arquivo = "-";
											$nota = "-";
											$comentario = "-";
											$link_arquivo_entregue = "-";
											$link_anexar_arquivo = "<a onClick=\"JavaScript: anexarArquivoAtividadeAluno(".$cod_atividade.", ".$cod_usuario.")\" onMouseOver=\"JavaScript: window.status = 'Anexar Arquivo';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\" title='Anexar Arquivo' class=\"link_laranja\">Anexar</a>";
											$entregou = false;
										}
										
										if ($cor_fundo == "laranja_linha_1")
											$cor_fundo = "laranja_linha_2";
										else
											$cor_fundo = "laranja_linha_1";
							  ?>
							  <tr class="<?php echo $cor_fundo; ?>">
							    <td colspan="8" height="5"></td>
							  </tr>
							  <tr class="<?php echo $cor_fundo; ?>">
								<td class="laranja_simples" align="left"><?php echo $link_corrigir; ?></td>
								<td class="laranja_simples" align="center"><?php echo $link_arquivo_entregue; ?></td>
								<td class="laranja_simples" align="center"><?php echo $nota; ?></td>
								<td class="laranja_simples" align="center"><?php echo $comentario; ?></td>
								<td class="laranja_simples" align="center"><?php echo $data_entrega; ?></td>
								<td class="laranja_simples" align="center"><?php echo $data_correcao; ?></td>
								<td class="laranja_simples" align="center"><?php echo $situacao; ?></td>
								<td class="laranja_simples" align="center"><?php echo $link_anexar_arquivo; ?></td>
							  </tr>
							  <tr class="<?php echo $cor_fundo; ?>">
							    <td colspan="8" height="5"></td>
							  </tr>
							  <?php										
										$atividades_usuarios->proximo();
									}

									if (($pagina == 1) or ($limite == "T"))
									{
										if ($limite == "T")
											$listagem = "1 - ".$total;
										else
											$listagem = "1 - ".$limite;

									}
									else
									{
										$listados = ($limite * $pagina);
										if ($listados > $total)
											$listados = $total;
											
										$lista = ($limite * ($pagina - 1)) + 1;
										$listagem = $lista." - ".$listados;
									}
									
									if ($listagem < $limite)
										$listagem = $j;
							  ?>
							  <tr>
							    <td colspan="8" height="15"></td>
							  </tr>
							  <tr> 
							    <td colspan="8">
								  <table width="100%" cellpadding="0" cellspacing="0">
								    <tr>
									  <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total, $url, true); ?></td>
									  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $listagem."/"; ?></font><font class="preto"><?php echo $total; ?></font></td>
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
							    <td colspan="8" class="vermelho_simples" align="center">Nenhum Resultado Encontrado!</td>
							  </tr>
							  <?php
								}
							  ?>
							</table>
						  </td>
						</tr>
					  </table>
					</td>
				  </tr>
				</table>
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
			</form>
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