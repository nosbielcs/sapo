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
include("../../../classes/enquete.php");
include("../../../funcoes/funcoes.php");

$modulo = "enquete";
$cod_conteudo = $_GET["cod_conteudo"];

$conteudo = new conteudo();
$conteudo->carregar($cod_conteudo);

$nome_conteudo = $conteudo->getNome();
$descricao_conteudo = $conteudo->getDescricao();


$diretorio_conteudo = $_GET["diretorio"];
$total_caracteres = strlen($diretorio_conteudo);
			
for($x = 0; $x < $total_caracteres; $x++)
	$diretorio_conteudo_ .= substituiCaracter($diretorio_conteudo[$x], "link");

$link_conteudo = "<a onClick=\"JavaScript: abas('conteudoPlataforma'); setTimeout('carregarConteudo()', 3000);\" class=\"link_magenta\" onMouseOver=\"JavaScript: window.status = 'Visualizar Conteúdo ".$nome_conteudo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\">".$nome_conteudo."</a>";

?>
<html>
<head>
<title>Conteúdo - <?php echo $descricao_conteudo; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script type="text/javascript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
  function carregarConteudo()
  {
  		window.location.href ='<? echo $diretorio_conteudo; ?>';
		redimensionar(window, (window.screen.width / 1.5), (window.screen.height / 1.5));
  }
</script>

<body topmargin="0" leftmargin="0" onLoad="redimensionaJanela('conteudoPlataforma');"> 
	<div id="conteudoPlataforma">
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
		  <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr> 
			  <td class="preto" width="140" align="right">Descri&ccedil;&atilde;o:</td>
			  <td width="10">&nbsp;</td>
			  <td class="preto_simples"><?php echo $descricao_conteudo; ?></td>
			</tr>
			<tr> 
			  <td colspan="3" height="15"></td>
			</tr>
			<tr> 
			  <td class="preto" align="right" valign="top">Link para o Arquivo:</td>
			  <td>&nbsp;</td>
			  <td><?php echo $link_conteudo; ?></td>
			</tr>
			<tr> 
			  <td colspan="3" height="15"></td>
			</tr>
			<tr> 
			  <td colspan="2">&nbsp;</td>
			  <td align="left"><input type="button" name="fecha" value="Fechar" onClick="JavaScript: self.close();"></td>
			</tr>
		  </table>
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
	</div>
	<div id="carregandoConteudo" style="display: none">
	  <table width="100%" cellpadding="0" cellspacing="0">
		<tr>
		  <td class="magenta">Aguarde, carregando Conteúdo...</td>
		</tr>
		<tr>
		  <td><img src="../../../imagens/outros/loading.gif" border="0"></td>
		</tr>
	  </table>
	</div>
</body>
</html>