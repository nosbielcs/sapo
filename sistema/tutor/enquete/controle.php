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
include("../../../classes/conteudo.php");
include("../../../classes/enquete.php");
include("../../../funcoes/funcoes.php");

$acao = $_POST["acao"];

if (!empty($acao))
{	
	$cod_usuario = $_SESSION["cod_usuario"];
	$cod_enquete = $_POST["cod_enquete"];
	$total_opcoes = $_POST["total_opcoes"];
	$descricao = $_POST["descricao"];
	$situacao = $_POST["situacao"];
	$data_enquete = date("Y-m-d");
	$hora_enquete = date("H:i:s");
	$data_limite = $_POST["data_limite"];
	
	if ($data_limite == 0)
	{
		$dia_fim = $_POST["dia_fim"];
		$mes_fim = $_POST["mes_fim"];
		$ano_fim = $_POST["ano_fim"];
		$hora_fim = $_POST["hora_fim"];
		$minuto_fim = $_POST["minuto_fim"];
		$data_fim = $ano_fim."-".$mes_fim."-".$dia_fim;
		$hora_fim = $hora_fim.":".$minuto_fim.":00";
	}
	else
	{
		$data_fim = "0000-00-00";
		$hora_fim = "00:00:00";
	}
	
	$cod_turma = $_SESSION["cod_turma"];
	
	$pagina = $_POST["pagina"];
	$quantidade = $_POST["quantidade"];
	$ordem = $_POST["ordem"];
	
	$url = "?pag=".$pagina."&qtd=".$quantidade."&ordem=".$ordem;
	$enquete = new enquete();

	switch($acao)
	{		
		case "novo":
			$enquete->setTurma($cod_turma);
			$enquete->setCodigoUsuario($cod_usuario);
			$enquete->setDescricao($descricao);
			$enquete->setDataEnquete($data_enquete);
			$enquete->setHoraEnquete($hora_enquete);
			$enquete->setDataFim($data_fim);
			$enquete->setHoraFim($hora_fim);
			$enquete->setSituacao($situacao);
			$enquete->inserir();
			
			$enquete->recuperaCodigo();
			$cod_enquete = $enquete->getCodigo();
			
			for ($i = 0; $i < $total_opcoes; $i++)
			{
				$opcao = "opcao_".($i + 1);
				$texto = $_POST[$opcao];
				$voto = 0;
				$enquete->inserirOpcao($cod_enquete, $texto, $voto);
			}
			
			$_SESSION["mensagem_enquete"] = "Enquete Cadastrada com Sucesso!";
			header("Location: index.php".$url);
		break;
		
		case "editar":
			$_SESSION["mensagem_enquete"] = "Alterações Realizadas com Sucesso!";
			header("Location: index.php".$url);
		break;
		
		case "excluir":
			$_SESSION["mensagem_enquete"] = "Enquete Excluída com Sucesso!";
			header("Location: index.php".$url);
		break;
	}
}
else
{
	header("Location: index.php");
	exit;
}
?>