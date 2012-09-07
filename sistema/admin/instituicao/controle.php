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
include("../../../classes/instituicao.php");
include("../../../funcoes/funcoes.php");

$acao_instituicao = $_POST["acao_instituicao"];

if (!empty($acao_instituicao))
{
	$cod_instituicao = $_POST["cod_instituicao"];
	$nome = $_POST["nome"];
	$descricao = $_POST["descricao"];
	$site = validaWebSite($_POST["site"]);
	$email = $_POST["email"];
	$endereco = $_POST["endereco"];
	$telefone = $_POST["telefone"];
	$cep = $_POST["cep"];
	$cidade = $_POST["cidade"];
	$uf = $_POST["uf"];
	$pais = $_POST["pais"];
	$imagem_atual = $_POST["imagem_atual_insituicao"];
	$imagem_nova = $_FILES["imagem_nova_instituicao"];
	
	if (!empty($imagem_nova))
		$imagem = $imagem_nova["name"];
	else
		$imagem = $imagem_atual;
	
	$instituicao = new instituicao();
			
	switch($acao_instituicao)
	{
		case "novo":
			$instituicao->setNome($nome);
			$instituicao->setDescricao($descricao);
			$instituicao->setCidade($cidade);
			$instituicao->setEndereco($endereco);
			$instituicao->setCEP($cep);
			$instituicao->setTelefone($telefone);
			$instituicao->setEmail($email);
			$instituicao->setSite($site);
			$instituicao->setUF($uf);
			$instituicao->setImagem($imagem);
			$instituicao->inserir();
			
			$instituicao->recuperaCodigo();
			$cod_instituicao = $instituicao->getCodigo();
			$_SESSION["mensagem_instituicao"] = "Cadastro realizado com Sucesso!";
		break;
		
		case "editar":
			$instituicao->setNome($nome);
			$instituicao->setDescricao($descricao);
			$instituicao->setCidade($cidade);
			$instituicao->setEndereco($endereco);
			$instituicao->setCEP($cep);
			$instituicao->setTelefone($telefone);
			$instituicao->setEmail($email);
			$instituicao->setSite($site);
			$instituicao->setUF($uf);
			$instituicao->setImagem($imagem);
			$instituicao->alterar($cod_instituicao);
			
			$_SESSION["mensagem_instituicao"] = "Dados Atualizados com Sucesso!";
		break;
	}
	
	if (!empty($imagem_nova))
	{
		$diretorio = "../../../arquivos/".$cod_instituicao."/imagens/";
		rmdir($diretorio);
		verificaDiretorio($diretorio);
		move_uploaded_file($imagem_nova["tmp_name"], $diretorio.$imagem_nova["name"]);
	}
}
header("Location: index.php");
?>