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

include("../../../config/session.lib.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/recado.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "recados";

//Início Código de Contagem de Mensagens por Pasta
$pastas = new recado();

for ($i = 0; $i < 3; $i++)
{
	if ($i == 0)
		$pasta = "E";
	else
		if ($i == 1)
			$pasta = "S";
		else
			if ($i == 2)
				$pasta = "L";
		
	$pastas->qtdeMsgsPasta($cod_usuario, $cod_turma, $pasta);
	$total = $pastas->linhas;

	for ($j = 0; $j < $total; $j++)
	{
		$situacao = $pastas->data["situacao"];
		if ($pasta == $situacao)
		{
			if ($i == 0)
				$total_msgs_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$total_msgs_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$total_msgs_lixeira = $pastas->data["qtde"];
		}
		else
		{
			if ($i == 0)
				$msgs_nlidas_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$msgs_nlidas_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = $pastas->data["qtde"];
		}
	
		$pastas->proximo();
	}
	
	if ($total == 1)
	{
		if ($i == 0)
				$msgs_nlidas_entrada = 0;
			else
				if ($i == 1)
					$msgs_nlidas_saida = 0;
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = 0;
	}
	else
		if ($total == 0)
		{
			if ($i == 0)
			{
				$total_msgs_entrada = 0;
				$msgs_nlidas_entrada = 0;
			}
			else
			{
				if ($i == 1)
				{
					$total_msgs_saida = 0;
					$msgs_nlidas_saida = 0;
				}
				else
					if ($i == 2)
					{
						$total_msgs_lixeira = 0;
						$msgs_nlidas_lixeira = 0;
					}
			}
		}
}
//Fim Código de Contagem de Mensagens por Pasta

//Início Código
$url_ordenacao = "";
$url_ordena_situacao = "";
$url_ordena_assunto = "";
$url_ordena_autor = "";
$url_ordena_data = "";

if ($_GET["pasta"])
{
	$pasta = $_GET["pasta"];
	$pasta_url = $pasta;
	switch($pasta)
	{
		case "E":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_caixa_de_entrada.gif\">";
			$pasta = "E";
			$acao = "lixeira";
			$acao_botao = "naolida";
			$botao = "mudar_nao_lida.gif";
			$mensagem_botao = "Mudar Status para N&atilde;o Lida";
		break;
		
		case "S":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_caixa_de_saida.gif\">";
			$pasta = "S";
			$acao = "excluir";
			$acao_botao = "naolida";
			$botao = "mudar_nao_lida.gif";
			$mensagem_botao = "Mudar Status para <b>N&atilde;o Lida";
		break;
		
		case "L":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_lixeira.gif\">";
			$pasta = "L";
			$acao = "excluir";
			$acao_botao = "restaurar";
			$botao = "restaurar.gif";
			$mensagem_botao = "Restaurar Mensagem";
		break;		
	}
}
else
{
	$pasta_url = "E";
	$titulo = "<img src=\"../../../imagens/icones/recados/titulo_caixa_de_entrada.gif\">";
	$pasta = "E";
	$acao = "lixeira";
	$acao_botao = "naolida";
	$botao = "mudar_nao_lida.gif";
	$mensagem_botao = "Mudar Status para <b>N&atilde;o Lida";
}

//Objeto recado
$recados = new recado();
$recados->colecaoRecado($cod_usuario, $cod_turma, $pasta);
$total_recados = $recados->linhas;

if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_situacao = "index.php?pag=".$pagina;
	$url_ordena_assunto = "index.php?pag=".$pagina;
	$url_ordena_autor = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_ordena_situacao = "index.php?pag=".$pagina;
	$url_ordena_assunto = "index.php?pag=".$pagina;
	$url_ordena_autor = "index.php?pag=".$pagina;
	$url_ordena_data = "index.php?pag=".$pagina;
	$url_qtd = "index.php?pag=1";
}

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
	$url_ordena_situacao.= "&qtd=".$limite;
	$url_ordena_assunto.= "&qtd=".$limite;
	$url_ordena_autor.= "&qtd=".$limite;
	$url_ordena_data.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_situacao.= "&qtd=".$limite;
		$url_ordena_assunto.= "&qtd=".$limite;
		$url_ordena_autor.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["recado_qtd_lst"]))
			$limite = $_SESSION["recado_qtd_lst"];
		else
			$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
		$url_ordena_situacao.= "&qtd=".$limite;
		$url_ordena_assunto.= "&qtd=".$limite;
		$url_ordena_autor.= "&qtd=".$limite;
		$url_ordena_data.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
	$url_qtd.= "&ordem=".$ordem;
}
else
{
	if (isset($_SESSION["recado_ordem"]))
		$ordem = $_SESSION["recado_ordem"];
	else
		$ordem = 1;
	$url_qtd.= "&ordem=".$ordem;	
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem."&pasta=".$pasta_url;

$url_ordenacao.= "&pasta=".$pasta_url;
$url_ordena_situacao.= "&pasta=".$pasta_url;
$url_ordena_data.= "&pasta=".$pasta_url;
$url_qtd.= "&pasta=".$pasta_url;

$recados->paginacao($cod_usuario, $cod_turma, $pasta, $limite, $inicio, $ordem);
$qtd_listagem = $recados->linhas;
//Fim Código		
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
<?php include("../topo.php"); ?>
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
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
		    <div id="pastas_recados">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"><img src="../../../imagens/cantom1.gif" width="10" height="10" border="0"></td>
				<td width="301" height="52" rowspan="2" bgcolor="#C5D8EB">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="3" bgcolor="#FFFFFF"></td>
					</tr>
					<tr>
					  <td><?php echo $titulo; ?></td>
					</tr>
				  </table>
				</td>
				<td height="10" background="../../../imagens/cantom8.gif" valign="top"></td>
				<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom2.gif" width="10" height="10" border="0"></td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"></td>
				<td height="42" bgcolor="#E2ECF5" width="100%">
				  <table align="right" cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: window.location.href= 'index.php?pasta=E';" onMouseOver="JavaScript: window.status = 'Caixa de Entrada';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Entrada">Caixa de Entrada (<?php echo $total_msgs_entrada."/".$msgs_nlidas_entrada; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href= 'index.php?pasta=S';" onMouseOver="JavaScript: window.status = 'Caixa de Saída';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Saída">Caixa de Saída (<?php echo $total_msgs_saida."/".$msgs_nlidas_saida; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href= 'index.php?pasta=L';" onMouseOver="JavaScript: window.status = 'Lixeira';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Lixeira">Lixeira (<?php echo $total_msgs_lixeira."/".$msgs_nlidas_lixeira; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: novoRecado('<?php echo $pasta; ?>', '<?php echo $pagina; ?>', '<?php echo $limite; ?>', '<?php echo $ordem; ?>', 'novo_recado');" onMouseOver="JavaScript: window.status = 'Novo Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Novo Recado">Novo Recado</a></td>
					</tr>
				  </table>
				</td>
				<td width="10" background="../../../imagens/cantom7.gif"></td>
			  </tr>
			  <tr>
				<td width="10" background="../../../imagens/cantom5.gif"></td>
				<td colspan="2" bgcolor="#E2ECF5">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
					<tr>
					  <td width="100%" bgcolor="#E2ECF5">
						<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						  <tr>
                            <td height="10"></td>
                          </tr>
						</table>
					    <?php
							if ($qtd_listagem > 0)
							{
						?>
						<table width="100%" cellpadding="0" cellspacing="0">
						  <tr>
							<td align="right">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
							    <form name="mostra_recados" action="<?php echo $url_ordenacao; ?>" method="post">
								<tr>
								  <td align="right" class="campos">Listagem</td>
								  <td width="10">&nbsp;</td>
								  <td width="50">
									<select name="qtd_listagem" onChange="JavaScript: paginacaoRecados('<?php echo $url_qtd; ?>');">
									  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
									  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
									  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
									  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
									  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
									</select>
								  </td>
								</tr>
								</form>
								<form action="../../geral/perfil_usuario.php" method="post" name="perfil_participante">
								  <input type="hidden" name="cod_participante">
								  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
								  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
								  <input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
								  <input type="hidden" name="acao_voltar" value="recados">
								</form>
							  </table>
							</td>
						  </tr>
						  <?php 
						  	if (isset($_SESSION["mensagem_recado"]))
							{
						  ?>
						  <tr>
						    <td align="center" class="vermelho_simples"><?php echo $_SESSION["mensagem_recado"]; ?></td>
						  </tr>
						  <?php
						  		unset($_SESSION["mensagem_recado"]);
						  	}
						  ?>
						  <tr>
							<td valign="top" align="left">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
							    <form name="mostraRecados" method="post">
								<tr>
								  <td width="20" align="center"><input type="checkbox" name="todos" onClick="marcaTodosRecados('mostraRecados');"></td>
								  <td class="azul" colspan="2" align="left">&nbsp;Marcar/Desmarcar Todos</td>
								</tr>
								<tr class="azul_linha_1">
								  <td width="20" class="preto" align="center">&nbsp;</td>
								  <td width="80" class="preto" align="center">Situação&nbsp;&nbsp;<?php 
									if ($_GET["ordem"])
									{ 
										$ordem = $_GET["ordem"];
										
										switch($ordem) 
										{
											case 1:
												$url_ordena_situacao.= "&ordem=4";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_situacao."'\" title=\"Ordenar por Mensagens Não Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Não Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 2: 
												$url_ordena_situacao.= "&ordem=4";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_situacao."'\" title=\"Ordenar por Mensagens Não Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Não Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 3:
												$url_ordena_situacao.= "&ordem=4";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_situacao."'\" title=\"Ordenar por Mensagens Não Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Não Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
											break;
											
											case 4:
												$url_ordena_situacao.= "&ordem=3";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_situacao."'\" title=\"Ordenar por Mensagens Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 5:
												$url_ordena_assunto.= "&ordem=3";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordenar por Mensagens Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 6:
												$url_ordena_assunto.= "&ordem=3";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordenar por Mensagens Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 7:
												$url_ordena_assunto.= "&ordem=3";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordenar por Mensagens Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 8:
												$url_ordena_assunto.= "&ordem=3";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordenar por Mensagens Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
										}
									} 
									else
									{
										$url_ordena_situacao.= "&ordem=3";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_situacao."'\" title=\"Ordenar por Mensagens Não Lidas\" onMouseOver=\"JavaScript: window.status = 'Ordenar por Mensagens Não Lidas';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									}
								  ?>
								  </td>
								  <td align="left">
								    <table width="100%" cellpadding="0" cellspacing="0">
									  <tr>
									    <td width="40%" class="preto">Assunto&nbsp;&nbsp;<?php 
									if ($_GET["ordem"])
									{ 
										$ordem = $_GET["ordem"];
										
										switch($ordem) 
										{
											case 1:
												$url_ordena_assunto.= "&ordem=6";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 2: 
												$url_ordena_assunto.= "&ordem=6";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Decrescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 3:
												$url_ordena_assunto.= "&ordem=6";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 4:
												$url_ordena_assunto.= "&ordem=6";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 5:
												$url_ordena_assunto.= "&ordem=6";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 6:
												$url_ordena_assunto.= "&ordem=5";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Decrescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
											break;
											
											case 7:
												$url_ordena_assunto.= "&ordem=5";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
											break;
											
											case 8:
												$url_ordena_assunto.= "&ordem=5";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_assunto."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
										}
									} 
									else
									{
										$url_ordena_data.= "&ordem=6";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Assunto\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Assunto';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									}
								  ?>
										</td>
								        <td width="30%" class="preto" align="center">Autor&nbsp;&nbsp;<?php 
									if ($_GET["ordem"])
									{ 
										$ordem = $_GET["ordem"];
										
										switch($ordem) 
										{
											case 1:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 2: 
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 3:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 4:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 5:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 6:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 7:
												$url_ordena_autor.= "&ordem=8";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Decrescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
											break;
											
											case 8:
												$url_ordena_autor.= "&ordem=7";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
										}
									} 
									else
									{
										$url_ordena_autor.= "&ordem=7";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_autor."'\" title=\"Ordem Crescente por Autor\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Autor';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									}
								  ?>
										</td>
								        <td width="30%" class="preto" align="center">Data / Hora&nbsp;&nbsp;<?php 
									if ($_GET["ordem"])
									{ 
										$ordem = $_GET["ordem"];
										
										switch($ordem) 
										{
											case 1:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 2: 
												$url_ordena_data.= "&ordem=1";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
											break;
											
											case 3:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 4:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 5:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 6:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 7:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
											
											case 8:
												$url_ordena_data.= "&ordem=2";
												echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
											break;
										}
									} 
									else
									{
										$url_ordena_data.= "&ordem=2";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena_data."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									}
								  ?>
								        </td>
									  </tr>
									</table>
								  </td>
								</tr>
								<?php
										$cor_fundo = "azul_linha_1";
										for ($i = 0; $i < $qtd_listagem; $i++)
										{
											$recado = new recado();
											$autor = new usuario();
											
											$recado->carregar($recados->data["cod_recado"]);
											$cod_autor = $recado->getCodigoAutor();
											$autor->carregar($cod_autor);
											
											$cod_recado = $recado->getCodigo();
											$assunto = $recado->getAssunto();
											$assunto_c = $assunto;
											$assunto = reduzTexto($assunto, 35);
											$mensagem = $recado->getMensagem();
											$autor = $autor->getNome();
											$autor_c = $autor;
											$autor = reduzTexto($autor, 15);
											$data_recado = $recado->getDatarecado();
											$hora = $recado->getHora();
											$hora = substr($hora, 0, 5);
											$situacao = $recados->data["situacao"];
											
											if ($situacao == "L")
												$imagem = "<img src=\"../../../imagens/icones/recados/lido.gif\" title=\"Recado lido\">";
											else
												if ($situacao == "N")
													$imagem = "<img src=\"../../../imagens/icones/recados/nao_lido.gif\" title=\"Recado não lido\">";
											
											if ($cor_fundo == "azul_linha_1")
												$cor_fundo = "azul_linha_2";
											else
												$cor_fundo = "azul_linha_1";
						
								?>
								<tr>
								  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
								</tr>
								<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_recado; ?>"> 
								  <td width="20" align="center">
								  <?php echo "<input type='checkbox' name='".$cod_recado."' value='".$cod_recado."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoRecados();\">"; ?>
								  </td>
								  <td width="80" align="center"><?php echo $imagem; ?></td>
								  <td>
								    <table width="100%" cellpadding="0" cellspacing="0">
									  <tr>
									    <td width="40%" align="left"><a class="link_azul" onClick="JavaScript: lerRecado(<?php echo $cod_recado; ?>, '<?php echo $pasta; ?>', '<?php echo $situacao; ?>', '<?php echo $pagina; ?>', '<?php echo $limite; ?>', '<?php echo $ordem; ?>');" onMouseOver="JavaScript: window.status = 'Ler Recado <?php echo $assunto_c; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" title="<?php echo $assunto_c; ?>"><?php echo $assunto; ?></a></td>
								        <td width="30%" align="center"><a class="link_azul" onClick="JavaScript: visualizarPerfil(<?php echo $cod_autor; ?>, '../perfil/')" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $autor_c; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" title="<?php echo $autor_c; ?>"><?php echo $autor; ?></a></td>
								        <td width="30%" align="center" class="preto_simples"><?php echo formataData($data_recado, "/")." ".$hora; ?></td>
									  </tr>
									</table>
								  </td>
								</tr>
								<tr>
								  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
								</tr>
								<?php
											$recados->proximo();
										}
								?>
								<tr>
								  <td colspan="3">
									<input type="hidden" name="codigosDestinos" value="">
									<input type="hidden" name="destinoRecado" value="">
									<input type="hidden" name="situacao" value="">
									<input type="hidden" name="acao" value="<?php echo $acao; ?>">
									<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
									<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
									<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
									<input type="hidden" name="pastaDestino" value="<?php echo $pasta; ?>">
									<input type="hidden" name="pasta" value="<?php echo $pasta; ?>">
									<input type="hidden" name="cod_recado" value="">
								  </td>
								</tr>
								<tr>
								  <td colspan="3" height="15"></td>
								</tr>
								<tr>
								  <td colspan="3">
								    <table width="100%" cellpadding="0" cellspacing="0">
									  <tr>
									    <td colspan="2"><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total_recados, $url, true, "link_azul"); ?></td>
								  		<td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $total_recados; ?></font></td>
									  </tr>
									</table>
								  </td>
								</tr>
								<tr>
								  <td colspan="3" height="15"></td>
								</tr> 
								<tr>
								  <td colspan="3">
								    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="34"><img src="../../../imagens/icones/recados/lado_esquerda1.gif" width="20" height="34"></td>
                                        <td height="34" bgcolor="#C5D8EB"><a onClick="JavaScript: alterarStatusRecado('<?php echo $acao_botao; ?>');" onMouseOver="JavaScript: window.status = '<?php echo $mensagem_botao; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span><?php echo $mensagem_botao; ?></span><img src="../../../imagens/icones/geral/tipo1/<?php echo $botao; ?>" alt="Mudar Status" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="excluirRecado(<?php echo "'".$acao."'"; ?>, <?php echo "'".$pasta."'"; ?>);" onMouseOver="JavaScript: window.status = 'Excluir Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Excluir</span><img src="../../../imagens/icones/geral/tipo1/excluir.gif" alt="Limpar formul&aacute;rio" width="30" height="30" border="0" align="middle"></a></td>
                                        <td height="34"><img src="../../../imagens/icones/recados/lado_direita1.gif" width="20" height="34"></td>
                                      </tr>
                                    </table>
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
						  	if (isset($_SESSION["mensagem_recado"]))
							{
						?>
						<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						  <tr>
							<td align="center" class="vermelho_simples"><?php echo $_SESSION["mensagem_recado"]; ?></td>
						  </tr>
						</table>
						<?php
								unset($_SESSION["mensagem_recado"]);
							}
							else
							{
						?>
					    <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						  <tr>
						    <td height="10"></td>
						  </tr>
						  <tr>
						    <td class="vermelho_simples" align="center">A sua <?php if ($pasta == "E") echo "Caixa de Entrada"; else if ($pasta == "S") echo "Caixa de Saída"; else if ($pasta == "L") echo "Lixeira"; ?> esta vazia.</td>
						  </tr>
						  <tr>
						    <td height="10"></td>
						  </tr>
					    </table>
					    <?php
							}
					    ?>
						<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
						  <form name="novo_recado" method="post">
						  <tr>
					        <td height="10">
							<input type="hidden" name="codigosDestinos" value="">
							<input type="hidden" name="destinoRecado" value="">
							<input type="hidden" name="acao" value="<?php echo $acao; ?>">
							<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
							<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
							<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							<input type="hidden" name="pastaDestino" value="<?php echo $pasta; ?>">
							<input type="hidden" name="pasta" value="<?php echo $pasta; ?>">
							<input type="hidden" name="cod_recado" value="">
							</td>
					      </tr>
						  <tr>
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						  </form>
						</table>
					  </td>
					</tr>
				  </table>
				</td>
				<td width="10" align="right" background="../../../imagens/cantom7.gif">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantom4.gif" width="10" height="10" border="0"></td>
				<td height="10" background="../../../imagens/cantom6.gif" colspan="2"><img src="../../../imagens/cantom6.gif" height="10"></td>
				<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom3.gif" width="10" height="10" border="0"></td>
			  </tr>
			</table>
		  </div>
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
