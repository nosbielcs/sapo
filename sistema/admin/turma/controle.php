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

include("../../../config/session.lib.admin.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/turma.php");

$acao_turma = $_POST["acao_turma"];

if (!empty($acao_turma))
{
	$pagina = $_POST["pagina"];
	$qtd_listagem = $_POST["quantidade"];
	$ordenacao = $_POST["ordenacao"];
	$url = "?pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;
	
	$cod_turma = $_POST["cod_turma"];
	$cod_curso = $_POST["curso_instituicao"];
	$descricao = $_POST["descricao"];
	$vagas = $_POST["vagas"];
	$dia_inicio = $_POST["dia_inicio"];
	$mes_inicio = $_POST["mes_inicio"];
	$ano_inicio = $_POST["ano_inicio"];
	$dia_fim = $_POST["dia_fim"];
	$mes_fim = $_POST["mes_fim"];
	$ano_fim = $_POST["ano_fim"];
	$cota = $_POST["cota"];
		
	$data_inicio = $ano_inicio."-".$mes_inicio."-".$dia_inicio;
	$data_fim = $ano_fim."-".$mes_fim."-".$dia_fim;
	$qtde_horas = $_POST["qtde_horas"];
	$situacao = $_POST["situacao_turma"];
	
	//Instancia objeto turma
	$turma = new turma();
	
	switch($acao_turma)
	{
		case "novo":	
			$turma->setCodigoCurso($cod_curso);
			$turma->setDescricao($descricao);
			$turma->setVagas($vagas);
			$turma->setDataInicio($data_inicio);
			$turma->setDataFim($data_fim);
			$turma->setQtdeHoras($qtde_horas);
			$turma->setCotaArquivos($cota);
			$turma->setSituacao($situacao);
			$turma->inserir();
			//$_SESSION["mensagem_turma"] = "Cadastro realizado com Sucesso!";
		break;

		case "editar":
			$turma->setCodigoCurso($cod_curso);
			$turma->setDescricao($descricao);
			$turma->setVagas($vagas);
			$turma->setDataInicio($data_inicio);
			$turma->setDataFim($data_fim);
			$turma->setQtdeHoras($qtde_horas);
			$turma->setCotaArquivos($cota);
			$turma->setSituacao($situacao);
			$turma->alterar($cod_turma);
			//$_SESSION["mensagem_turma"] = "Alterações realizadas com Sucesso!";
		break;
		
		case "excluir":
			$turma->excluir($cod_turma);
			//$_SESSION["mensagem_turma"] = "Exclusão realizadas com Sucesso!";
		break;
	}
}

header("Location: index.php".$url);
exit;
?>