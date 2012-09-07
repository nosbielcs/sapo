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
include("../../../classes/conteudo_usuario.php");
include("../../../classes/conteudo.php");
include("../../../funcoes/funcoes.php");

if (($_GET["cod_conteudo"]) and ($_GET["cod_usuario"]) and ($_GET["diretorio"]))
{
	$cod_conteudo = $_GET["cod_conteudo"];
	$cod_usuario = $_GET["cod_usuario"];
	$diretorio = $_GET["diretorio"];
	$tipo_conteudo = $_GET["tipo_conteudo"];
	$total_caracteres = strlen($diretorio);

	$diretorio_ = "";
	for($x = 0; $x < $total_caracteres; $x++)
		$diretorio_ .= substituiCaracter($diretorio[$x], "link");
		
	//echo $diretorio_;exit;
		
	$conteudo = new conteudo();
	$conteudo->carregar($cod_conteudo);
	$nome_conteudo = $conteudo->getDescricao();
	
	$conteudo_usuario = new conteudo_usuario();
	$conteudo_usuario->carregar($cod_conteudo, $cod_usuario);
	$acesso = $conteudo_usuario->getAcesso();
	
	if ($acesso == "P")
		$onLoad = "JavaScript: visualizaConteudo(".$cod_conteudo.", '".$diretorio_."', '".$tipo_conteudo."'); setTimeout('self.close();', 3000);";
	else
	{
		if ($acesso == "N")
		{
			header("Location: mensagem.php?acesso_conteudo=N&conteudo=".$nome_conteudo);
			exit;
		}
		else
		{
			header("Location: mensagem.php?acesso_conteudo=N&conteudo=".$nome_conteudo);
			exit;
		}
	}
}
?>
<html>
<head>
<title>Sa&sup2;po - Sistema de Apoio &agrave; Aprendizagem Online - Conte&uacute;do - Verifica&ccedil;&atilde;o de Acesso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<body onLoad="<?php echo $onLoad; ?>">
<table width="98%" height="98%" cellpadding="0" cellspacing="0" border="0" align="center" class="tabelaMenu">
  <tr>
    <td class="conteudoTextoBold" align="center" valign="middle">Por Favor Aguarde ...</td>
</table>
</body>
</html>