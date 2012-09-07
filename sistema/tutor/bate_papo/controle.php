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
include("../../../classes/sala_bate_papo.php");
include("../../../classes/mensagem_bate_papo.php");

$acao_bate_papo = $_POST["acao_bate_papo"];

if (!empty($acao_bate_papo))
{
	$sala_bate_papo = new sala_bate_papo();
	
	$cod_bate_papo = explode(";", $_POST["cod_sala"]);
	$cod_bate_papo = $cod_bate_papo[0];
	$cod_turma = $_SESSION["cod_turma"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$nome_sala = $_POST["nome_sala"];
	$descricao_sala = $_POST["descricao_sala"];
	$data_bate_papo = date("Y-m-d");
	$hora_bate_papo = date("H:m:s");
	$vagas = $_POST["vagas_bate_papo"];
	$situacao = $_POST["situacao_bate_papo"];
	
	if ($vagas == "")
		$vagas = 0;
	
	switch($acao_bate_papo)
	{		
		case "novo_bate_papo":
			$sala_bate_papo->setCodigoUsuario($cod_usuario);
			$sala_bate_papo->setCodigoTurma($cod_turma);
			$sala_bate_papo->setNome($nome_sala);
			$sala_bate_papo->setDescricao($descricao_sala);
			$sala_bate_papo->setDataBatePapo($data_bate_papo);
			$sala_bate_papo->setHoraBatePapo($hora_bate_papo);
			$sala_bate_papo->setVagas($vagas);
			$sala_bate_papo->setSituacao($situacao);
			$sala_bate_papo->inserir();
			
			$_SESSION["mensagem_bate_papo"] = "Sala de Bate Papo Cadastrada com Sucesso!";
		break;
		
		case "editar_bate_papo":
			$sala_bate_papo->setNome($nome_sala);
			$sala_bate_papo->setDescricao($descricao_sala);
			$sala_bate_papo->setVagas($vagas);
			$sala_bate_papo->setSituacao($situacao);
			$sala_bate_papo->alterar($cod_bate_papo, $cod_turma);
			
			$_SESSION["mensagem_bate_papo"] = "Alterações Realizadas com Sucesso!";
		break;
		
		case "encerrar_bate_papo":		
			if ($_POST["codigosSalasBatePapo"])
			{
				$codigos_bate_papo = explode(";", $_POST["codigosSalasBatePapo"]);
				$total = sizeof($codigos_bate_papo);
				
				for ($i = 0; $i < $total; $i++)
				{
					if (!empty($codigos_bate_papo[$i]))
					{
						$sala_bate_papo->encerrar($codigos_bate_papo[$i], $cod_turma);
					}
				}
			}
			
			$_SESSION["mensagem_bate_papo"] = "Sala(s) de Bate Papo Encerrada(s) com Sucesso!";
		break;
		
		case "excluir_bate_papo":
			if ($_POST["codigosSalasBatePapo"])
			{
				$codigos_bate_papo = explode(";", $_POST["codigosSalasBatePapo"]);
				$total = sizeof($codigos_bate_papo);
				
				for ($i = 0; $i < $total; $i++)
				{
					if (!empty($codigos_bate_papo[$i]))
					{
						$sala_bate_papo->excluir($codigos_bate_papo[$i], $cod_turma);
						//$colecao_mensagem = new mensagem_bate_papo();
						//$colecao_mensagem->excluir($codigos_bate_papo[$i]);
					}
				}
			}
			
			$_SESSION["mensagem_bate_papo"] = "Sala(s) de Bate Papo Excluída(s) com Sucesso!";
		break;
	}
	
	header("Location: index.php");
	exit;
}
else
{
	header("Location: index.php");
	exit;
}
?>