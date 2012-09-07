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
include("../../../classes/usuario.php");
include("../../../classes/perfil.php");
include("../../../funcoes/funcoes.php");

$usuario = new usuario();
$usuario->carregar($_SESSION["cod_usuario"]);
$senha_atual = $usuario->getSenha();

//Dados Pessoais
$_SESSION["nome"] = $_POST["nomePerfil"];
$_SESSION["dia_nasc"] = $_POST["dia"];
$_SESSION["mes_nasc"] = $_POST["mes"];
$_SESSION["ano_nasc"] = $_POST["ano"];
$_SESSION["sexo"] = substr($_POST["sexoPerfil"], 0, 1);
$_SESSION["descricao"] = $_POST["descrPessoalPerfil"];
$_SESSION["interesse"] = $_POST["interessesPerfil"];
$_SESSION["foto"] = $_POST["imagemAtualPerfil"];
$_SESSION["miniatura"] = $_POST["miniaturaPerfil"];
$_SESSION["cidade"] = $_POST["cidadePerfil"];
$_SESSION["uf"] = $_POST["ufPerfil"];
$_SESSION["semImagem"] = $_POST["semImagemPerfil"];
$_SESSION["imagem_nova"] = $_FILES["imagemNovaPerfil"];
$_SESSION["site_pessoal"] = $_POST["sitePessoalPerfil"];
$_SESSION["site_profissional"] = $_POST["siteProfissionalPerfil"];

//Dados Profissionais
$_SESSION["profissao"] = $_POST["profissaoPerfil"];
$_SESSION["empresa"] = $_POST["empresaPerfil"];
$_SESSION["cargo"] = $_POST["cargoPerifl"];
$_SESSION["detalhes"] = $_POST["detalhesPerfil"];
$_SESSION["cod_perfil"] = $_POST["cod_perfil"];

//Dados Cadastrais
$_SESSION["login"] = $_POST["loginPerfil"];
$_SESSION["cpf"] = $_POST["cpfPerfil"];
$_SESSION["email"] = $_POST["emailPerfil"];
$_SESSION["senhaAtual"] = $_POST["senhaAtual"];
$_SESSION["senhaNova"] = $_POST["senhaNova"];
$_SESSION["confirmaSenha"] = $_POST["confirmaSenha"];

//Valida Login
if (($_SESSION["login"] != "") and ($_SESSION["login"] != $_SESSION["login_usuario"]))
{
	$usuario->verificaLogin($_SESSION["login"]);
	
	if ($usuario->linhas > 0)
		$_SESSION["erro_login"] = 1;
	else
		$_SESSION["erro_login"] = 0;
}
else
	{	
		if ($_SESSION["login"] != "")
			$_SESSION["erro_login"] = 0;
		else
			$_SESSION["erro_login"] = 1;
	}
//

//Valida Email
if ($_SESSION["email"] != "")
{
	if (!eregi("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $_SESSION["email"]))
   		$_SESSION["erro_email"] = 1;
	else
    	$_SESSION["erro_email"] = 0;
}
else
	$_SESSION["erro_email"] = 0;
//
	
//Valida CPF
$cpf = validaCPF($_SESSION["cpf"]);

if ($cpf == 0)
	$_SESSION["erro_cpf"] = 0;
else
	$_SESSION["erro_cpf"] = 1;
//

//Valida Senhas
if ($_SESSION["senhaAtual"] != "") 
{
	if ($_SESSION["senhaAtual"] != $senha_atual)
		$_SESSION["erro_senha_atual"] = 1;
	else
		$_SESSION["erro_senha_atual"] = 0;
}
else
	$_SESSION["erro_senha_atual"] = 0;
	
if (($_SESSION["senhaNova"] != "") and ($_SESSION["confirmaSenha"] != ""))
{
	if ($_SESSION["senhaNova"] != $_SESSION["confirmaSenha"])
		$_SESSION["erro_senha_nova"] = 1;
	else
		$_SESSION["erro_senha_nova"] = 0;
}
else
	$_SESSION["erro_senha_nova"] = 0;

//echo "Login: ".$_SESSION["erro_login"]." email: ".$_SESSION["erro_email"]." cpf: ".$_SESSION["erro_cpf"]." senha atual: ".$_SESSION["erro_senha_atual"]." senha nova:".$_SESSION["erro_senha_nova"]."<br>";
$erros = $_SESSION["erro_login"] + $_SESSION["erro_email"] + $_SESSION["erro_cpf"] + $_SESSION["erro_senha_atual"] + $_SESSION["erro_senha_nova"];
//exit;
if ($erros > 0)
{	
	header("Location: formulario.php?DadosCadastrais");
	exit;
}
else
{
	//Verifica Imagem e se precisa redimensionar
	if ($_SESSION["imagem_nova"]["name"] != "")
	{
		$diretorio = "../../../arquivos/perfil/".$_SESSION["cod_usuario"]."/";
		move_uploaded_file($_SESSION["imagem_nova"]["tmp_name"], $diretorio.$_SESSION["imagem_nova"]["name"]);
		$_SESSION["foto"] = $_SESSION["imagem_nova"]["name"];
		$_SESSION["miniatura"] = redimensionaImagem($_SESSION["foto"], $diretorio);
	}
	
	if (($_SESSION["foto"] == "") or ($_SESSION["semImagem"] == "true"))
	{
		$_SESSION["foto"] = "sem_foto.gif";
		$_SESSION["miniatura"] = "sem_foto.gif";
	}
	
	header("Location: controle.php");
	exit;
}
?>