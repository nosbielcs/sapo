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

include("../../../config/session.lib.pta.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");

$acao_curso = $_POST["acao_curso"];

if (!empty($acao_curso))
{
	$pagina = $_POST["pagina"];
	$qtd_listagem = $_POST["quantidade"];
	$ordenacao = $_POST["ordenacao"];
	$url = "?pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;
	
	$cod_curso = $_POST["cod_curso"];
	$cod_instituicao = $_SESSION["cod_instituicao"];
	$nome = $_POST["nome"];
	$descricao = $_POST["descricao"];
	$vagas = $_POST["vagas"];
	$dia_inicio = $_POST["dia_inicio"];
	$mes_inicio = $_POST["mes_inicio"];
	$ano_inicio = $_POST["ano_inicio"];
	$dia_fim = $_POST["dia_fim"];
	$mes_fim = $_POST["mes_fim"];
	$ano_fim = $_POST["ano_fim"];
	
	$imagem_atual = $_POST["imagem_atual_curso"];
	$imagem_nova = $_FILES["imagem_nova_curso"];
	
	if (!empty($imagem_nova))
		$imagem = $imagem_nova["name"];
	else
		$imagem = $imagem_atual;
			
	if (($mes_inicio > 0) and ($mes_inicio < 10))
		$mes_inicio = "0".$mes_inicio;
		
	if (($mes_fim > 0) and ($mes_fim < 10))
		$mes_fim = "0".$mes_fim;
		
	$data_inicio = $ano_inicio."-".$mes_inicio."-".$dia_inicio;
	$data_fim = $ano_fim."-".$mes_fim."-".$dia_fim;
	$qtde_horas = $_POST["qtde_horas"];
	$situacao = $_POST["situacao_curso"];
	
	//Instancia objeto curso
	$curso = new curso();
	
	switch($acao_curso)
	{
		case "novo":	
			$curso->setCodigoInstituicao($cod_instituicao);
			$curso->setNome($nome);
			$curso->setDescricao($descricao);
			$curso->setVagas($vagas);
			$curso->setDataInicio($data_inicio);
			$curso->setDataFim($data_fim);
			$curso->setQtdeHoras($qtde_horas);
			$curso->setSituacao($situacao);
			$curso->setImagem($imagem);
			$curso->inserir();
			
			$curso->recuperaCodigo();
			$cod_curso = $curso->getCodigo();
			$_SESSION["mensagem_curso"] = "Cadastro realizado com Sucesso!";
		break;

		case "editar":
			$curso->setCodigoUsuario($usuario);
			$curso->setAssunto($assunto);
			$curso->setMensagem($mensagem);
			$curso->setDatacurso($data_curso);
			$curso->setHora($hora_curso);
			$curso->setSituacao($situacao);
			$curso->setImagem($imagem);
			$curso->alterar($cod_curso);
			
			$_SESSION["mensagem_curso"] = "Alterações realizadas com Sucesso!";
		break;
		
		case "excluir":
			$curso->excluir($cod_curso);
			$_SESSION["mensagem_curso"] = "Exclusão realizadas com Sucesso!";
		break;
	}
	
	if (!empty($imagem_nova))
	{
		$diretorio = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/imagens/";
		rmdir($diretorio);
		verificaDiretorio($diretorio);
		move_uploaded_file($imagem_nova["tmp_name"], $diretorio.$imagem_nova["name"]);
	}
}

header("Location: index.php".$url);
exit;
?>