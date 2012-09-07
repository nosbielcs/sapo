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
include("../../../classes/usuario.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");
include("../../../classes/conteudo.php");
include("../../../classes/conteudo_usuario.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Sa&sup2;po - Conte&uacute;dos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/treeview.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>
<?php
	$conteudos = new conteudo();
	$conteudos_ = $conteudos->arvoreConteudos($_SESSION["cod_turma"]);
	$total_conteudo = $conteudos->linhas;
	$cod_turma = $_SESSION["cod_turma"];
	$cod_curso = $_SESSION["cod_curso"];

	$total_conteudos_ = sizeof($conteudos_);
	
	echo "<script>function carregaMenu()";
	echo "{";
	echo "trv = new treeview(\"menuConteudos\");";
	
	for ($x = 0; $x < $total_conteudos_; $x++)
	{
		$cod_curso = $_SESSION["cod_curso"];
		$cod_conteudo = $conteudos_[$x]["cod_conteudo"];
		$descricao = $conteudos_[$x]["descricao"];
		$tipo_conteudo = $conteudos_[$x]["tipo"];
		
		//
		$conteudo_especifico = new conteudo();
		$conteudo_especifico->carregar($cod_conteudo);
		
		$nome_conteudo = $conteudo_especifico->getNome();
		$descricao_conteudo = $conteudo_especifico->getDescricao();
			
		$data_conteudo = formataData($conteudo_especifico->getDataConteudo(), "/");
		$hora_conteudo = $conteudo_especifico->getHoraConteudo();
		$tipo_conteudo = $conteudo_especifico->getTipo();
		
		switch($tipo_conteudo)
		{
			case "html":
				$diretorio_especifico = str_replace(" ", "_", $nome_conteudo);
				$diretorio_conteudo = "../../../arquivos/".$cod_curso."/".$cod_turma."/html/";
				$diretorio_arquivo = $diretorio_conteudo.$diretorio_especifico."/";
			break;
			
			case "doc":
				$nome_arquivo = str_replace(".doc","", $nome_conteudo);
				$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
				$diretorio_conteudo = "../../../arquivos/".$cod_curso."/".$cod_turma."/doc/".$diretorio_especifico."/";
				$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
			break;
			
			case "powerpoint":
				$nome_arquivo = str_replace(".ppt","", $nome_conteudo);
				$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
				$diretorio_conteudo = "../../../arquivos/".$cod_curso."/".$cod_turma."/ppt/".$diretorio_especifico."/";
				$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
			break;
			
			case "pdf":
				$nome_arquivo = str_replace(".pdf","", $nome_conteudo);
				$diretorio_especifico = str_replace(" ", "_", $nome_arquivo);
				$diretorio_conteudo = "../../../arquivos/".$cod_curso."/".$cod_turma."/pdf/".$diretorio_especifico."/";
				$diretorio_arquivo = $diretorio_conteudo.$nome_conteudo;
			break;
		}
		
		$diretorio_arquivo_ = "";
		
		$total_caracteres = strlen($diretorio_arquivo);
	
		for($y = 0; $y < $total_caracteres; $y++)
			$diretorio_arquivo_ .= substituiCaracter($diretorio_arquivo[$y], "link");
		
		if ($tipo_conteudo == "site")
		{
			$link_conteudo = $diretorio_arquivo;
		}
		else
		{
			$link_conteudo = "JavaScript: visualizaConteudo(".$cod_conteudo.", '".$diretorio_arquivo_."', '".$tipo_conteudo."')";
		}
		//
		
		if ($conteudos_[$x]["cod_hierarquia"] == 0)
		{
			$cod_conteudo = $conteudos_[$x]["cod_conteudo"];
			
			echo "objeto = trv.add('".$descricao."', \"".$link_conteudo."\", null, ".$conteudos_[$x]["cod_conteudo"].");";
			//echo "trv.addLoader('action=".$conteudos_[$x]["cod_conteudo"]."', objeto);";
		}
		else
		{
			echo "trv.add('".$descricao."', \"".$link_conteudo."\", ".$conteudos_[$x]["cod_hierarquia"].", ".$conteudos_[$x]["cod_conteudo"].");";
		}
		
		
	}

	echo "document.getElementById('mensagemCarregando').style.display = \"none\";";
	echo "document.getElementById('menuConteudos').style.display = \"block\";";
	echo "}";
	echo "</script>";
?>
<script>

window.onload = function()
{
	setTimeout("carregaMenu();", 3000);
	
}

</script>
</head>
<body>
	<div id="mensagemCarregando"><h2>Aguarde, carregando Conteúdo...</h2></div>
	<div id="menuConteudos"></div>
</body>
</html>
