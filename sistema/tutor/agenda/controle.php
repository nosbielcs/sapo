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
include("../../../classes/evento.php");

if ($_POST["acao"])
	$acao = $_POST["acao"];
		
if (!empty($acao))
{
	if ($_POST["cod_evento"])
		$cod_evento = $_POST["cod_evento"];
	
	$dia_evento = $_POST["dia"];
	$mes_evento = $_POST["mes"];
	
	if (($mes_evento > 0) and ($mes_evento < 10))
		$mes_evento = "0".$mes_evento;
		
	$ano_evento = $_POST["ano"];
	$hora_evento = $_POST["hora"];
	$minuto_evento = $_POST["minuto"];
	$assunto_evento = $_POST["assunto"];
	$descricao_evento = $_POST["descricao"];
	$situacao_evento= $_POST["situacao"];
	$tipo = $_POST["tipo_evento"];
	$cod_turma = $_SESSION["cod_turma"];
	$cod_usuario = $_SESSION["cod_usuario"];
	
	if ($_POST["pagina"])
		$pagina = $_POST["pagina"];
	else
		$pagina = 1;
			
	if ($_POST["quantidade"])
		$quantidade = $_POST["quantidade"];
	else
		$quantidade = 5;
			
	if ($_POST["ordem"])
		$ordem = $_POST["ordem"];
	else
		$ordem = 1;

	$url = "index.php?pag=".$pagina."&qtd=".$quantidade."&ordem=".$ordem;
	
	$evento = new evento();
		
	switch($acao)
	{
		case "novo":		
			$data_evento = $ano_evento."-".$mes_evento."-".$dia_evento;
			$hora_evento = $hora_evento.":".$minuto_evento.":00";
		
			$evento->setCodigoUsuario($cod_usuario);
			$evento->setCodigoTurma($cod_turma);
			$evento->setAssunto($assunto_evento);
			$evento->setDescricao($descricao_evento);
			$evento->setDataEvento($data_evento);
			$evento->setHora($hora_evento);
			$evento->setTipo($tipo);
			$evento->setSituacao($situacao_evento);
			$evento->inserir();
	
			$_SESSION["mensagem_evento"] = "Evento Cadastrado com Sucesso!";
		break;

		case "editar":
			$data_evento = $ano_evento."-".$mes_evento."-".$dia_evento;
			$hora_evento = $hora_evento.":".$minuto_evento.":00";
		
			$evento->setCodigoUsuario($cod_usuario);
			$evento->setAssunto($assunto_evento);
			$evento->setDescricao($descricao_evento);
			$evento->setDataEvento($data_evento);
			$evento->setHora($hora_evento);
			$evento->setTipo($tipo);
			$evento->setSituacao($situacao_evento);
			$evento->alterar($cod_evento);
			
			if ($tipo == "A")
			{
				$atividade = new atividade();
				$cod_atividade = $evento->recuperaCodigoAtividade($cod_evento);
				
				$atividade->alterarDataHora($cod_atividade, $cod_turma, $data_evento, $hora_evento);
			}
			
			$_SESSION["mensagem_evento"] = "Alterações Realizadas com Sucesso!";
		break;
		
		case "excluir":
			$evento->excluir($cod_evento, $cod_turma);
			$_SESSION["mensagem_evento"] = "Evento Excluído com Sucesso!";
		break;
	}
	
	header("Location: ".$url);
	exit;
}
else
{
	header("Location: index.php");
	exit;

}
?>