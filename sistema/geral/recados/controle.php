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
include("../../../classes/recado.php");

if ($_POST["acao"])
{
	//Instancia objeto Edital
	$recado = new recado();
	$acao = $_POST["acao"];
	$autor = $_SESSION["cod_usuario"];
	$assunto = trim($_POST["assuntoRecado"]);
	$mensagem = trim($_POST["mensagemRecado"]);
	$cod_destinatario = $_POST["codigosDestinos"];
	$destinatarios = explode(";", $_POST["codigosDestinos"]);
	$codigosRecados = explode(";", $_POST["codigosDestinos"]);
	$cod_turma = $_SESSION["cod_turma"];
	$pastaDestino = $_POST["pastaDestino"];
	$pagina = $_POST["pagina"];
	$qtd_listagem = $_POST["qtd_listagem"];
	$ordenacao = $_POST["ordenacao"];
	$url = "index.php?pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;
	
	switch($acao)
	{
		//Novo
		case "novo":
			$data_recado = date("Y-m-d");
			$hora_recado = date("H:i:s");
		
			$recado->setCodigoAutor($autor);
			$recado->setAssunto($assunto);
			$recado->setDestinatario($cod_destinatario);
			$recado->setMensagem($mensagem);
			$recado->setDataRecado($data_recado);
			$recado->setHora($hora_recado);
			$recado->inserir();
			
			$pasta = "E";
			$situacao = "N";
			$total = sizeof($destinatarios);
			$recado->recuperaCodigo();
			$cod_recado = $recado->getCodigo();
			$recado->recadoDestinatario($cod_recado, $autor, $cod_turma, "S", "L");
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($destinatarios[$i] != "")
				{
					$cod_usuario = $destinatarios[$i];
					$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
				}
			}
			
			$_SESSION["mensagem_recado"] = "Recado enviado com sucesso!";
			header("Location: ".$url."&pasta=".$pasta." ");	
		break;
		
		case "encaminhar":
			$data_recado = date("Y-m-d");
			$hora_recado = date("H:i:s");
		
			$recado->setCodigoAutor($autor);
			$recado->setAssunto($assunto);
			$recado->setDestinatario($cod_destinatario);
			$recado->setMensagem($mensagem);
			$recado->setDataRecado($data_recado);
			$recado->setHora($hora_recado);
			$recado->inserir();
			
			$pasta = "S";
			$situacao = "L";
			$recado->recuperaCodigo();
			$cod_recado = $recado->getCodigo();
			$cod_usuario = $autor;
			
			//Cadastra Recado para o Usuário que esta enviando
			$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
			$pasta = "E";
			$situacao = "N";
			$total = sizeof($destinatarios);
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($destinatarios[$i] != "")
				{
					$cod_usuario = $destinatarios[$i];
					$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
				}
			}
			
			$_SESSION["mensagem_recado"] = "Recado enviado com sucesso!";
			header("Location: ".$url."&pasta=".$pasta." ");		
		break;
		
		case "responder":
			$data_recado = date("Y-m-d");
			$hora_recado = date("H:i:s");
		
			$recado->setCodigoAutor($autor);
			$recado->setAssunto($assunto);
			$recado->setDestinatario($cod_destinatario);
			$recado->setMensagem($mensagem);
			$recado->setDataRecado($data_recado);
			$recado->setHora($hora_recado);
			$recado->inserir();
			
			$pasta = "S";
			$situacao = "L";
			$recado->recuperaCodigo();
			$cod_recado = $recado->getCodigo();
			$cod_usuario = $autor;
			
			//Cadastra Recado para o Usuário que esta enviando
			$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
			$pasta = "E";
			$situacao = "N";
			$total = sizeof($destinatarios);
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($destinatarios[$i] != "")
				{
					$cod_usuario = $destinatarios[$i];
					$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
				}
			}
		
			$_SESSION["mensagem_recado"] = "Recado enviado com sucesso!";
			header("Location: ".$url."&pasta=".$pasta." ");		
		break;
		
		case "responderTodos":
			$data_recado = date("Y-m-d");
			$hora_recado = date("H:i:s");
		
			$recado->setCodigoAutor($autor);
			$recado->setAssunto($assunto);
			$recado->setDestinatario($cod_destinatario);
			$recado->setMensagem($mensagem);
			$recado->setDataRecado($data_recado);
			$recado->setHora($hora_recado);
			$recado->inserir();
			
			$pasta = "S";
			$situacao = "L";
			$recado->recuperaCodigo();
			$cod_recado = $recado->getCodigo();
			$cod_usuario = $autor;
			
			//Cadastra Recado para o Usuário que esta enviando
			$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
			$pasta = "E";
			$situacao = "N";
			$total = sizeof($destinatarios);
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($destinatarios[$i] != "")
				{
					$cod_usuario = $destinatarios[$i];
					$recado->recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao);
				}
			}
			
			$_SESSION["mensagem_recado"] = "Recado enviado com sucesso!";
			header("Location: ".$url."&pasta=".$pasta." ");			
		break;
		
		case "lixeira":
			$total = sizeof($codigosRecados);
			$pasta = "L";
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigosRecados[$i] != "")
				{
					$cod_recado = $codigosRecados[$i];
					$recado->alterarPastaRecado($cod_recado, $autor, $cod_turma, $pasta, $pastaDestino);
				}
			}
			
			$_SESSION["mensagem_recado"] = "Recado(s) movido(s) para a Lixeira com sucesso!";
			header("Location: ".$url."&pasta=E ");
		break;
		
		case "excluir":
			$total = sizeof($codigosRecados);
			$pasta = $pastaDestino;
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigosRecados[$i] != "")
				{
					$cod_recado = $codigosRecados[$i];
					$recado->excluirRecadoDestinatario($cod_recado, $autor, $cod_turma, $pasta);
				}
			}
			
			$recado->verificaDependencia($cod_recado);
			$dependencia = $recado->linhas;
			
			if ($dependencia == 0)
			{
				$recado->excluir($cod_recado);
			}
				
			$_SESSION["mensagem_recado"] = "Recado(s) excluído(s) com sucesso!";
			header("Location: ".$url."&pasta=".$pasta." ");
		break;
		
		case "naolida":
			$total = sizeof($codigosRecados);
			$pasta = $pastaDestino;
			$situacao = "N";
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigosRecados[$i] != "")
				{
					$cod_recado = $codigosRecados[$i];
					$recado->alterarSituacaoRecado($cod_recado, $autor, $cod_turma, $pasta, $situacao);
				}
			}
			
			switch($pasta)
			{
				case "E":
					$pasta = "E";
				break;
				
				case "S":
					$pasta = "S";
				break;
			}
			
			header("Location: ".$url."&pasta=".$pasta." ");
		break;
		
		case "restaurar":
			$total = sizeof($codigosRecados);
			$pasta = "E";
			$origem = "L";
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigosRecados[$i] != "")
				{
					$cod_recado = $codigosRecados[$i];
					$recado->alterarPastaRecado($cod_recado, $autor, $cod_turma, $pasta, $origem);
				}
			}
			
			$_SESSION["mensagem_recado"] = "Recado(s) restaurado(s) para a Caixa de Entrada com sucesso!";
			header("Location: ".$url."&pasta=L");
		break;
	}
}
?>