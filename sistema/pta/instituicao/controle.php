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
include("../../../classes/usuario.php");
include("../../../classes/classe.phpmailer.php");
include("../../../classes/classe.smtp.php");
include("../../../funcoes/funcoes.php");


$acao_usuario = $_POST["acao_usuario"];
$nome_instituicao = $_SESSION["nome_instituicao"];

if (!empty($acao_usuario))
{
	$cod_usuario_pta = $_POST["cod_usuario_pta"];
	$cod_instituicao = $_SESSION["cod_instituicao"];
	$nome_usuario = $_POST["nome_usuario_instituicao"];
	$cpf_usuario = $_POST["cpf_usuario_instituicao"];
	$sexo_usuario = $_POST["sexo_usuario_instituicao"];
	$email_usuario = $_POST["email_usuario_instituicao"];
	$dia_nascimento = $_POST["dia_nascimento"];
	$mes_nascimento = $_POST["mes_nascimento"];
			
	if (($mes_nascimento > 0) && ($mes_nascimento < 9))
		$mes_nascimento = "0".$mes_nascimento;
		
	$ano_nascimento = $_POST["ano_nascimento"];
	$login_usuario = $_POST["login_usuario_instituicao"];
	$senha_usuario = $_POST["senha_usuario_instituicao"];
	$opcao_senha = $_POST["usuario_instituicao_login_senha"];
	
	if (($opcao_senha == "cadastrar_login") or ($opcao_senha == "gerar_nova"))
	{
		$senha_usuario = md5(mktime().$cpf_usuario.$nome_usuario);
		$senha_usuario = substr($senha_usuario, 0, 15);
	}
	else
		if (($acao_usuario == "editar")	or ($opcao_senha = "enviar_senha"))
		{
			$usuario = new usuario();
			$usuario->carregar($cod_usuario_pta);
			$senha_usuario = $usuario->getSenha();
			$login_usuario = $usuario->getLogin();
		}
		
	$data_nascimento = $ano_nascimento."-".$mes_nascimento."-".$dia_nascimento;
	$data_usuario = date("Y-m-d");
	$hora_usuario = date("H:m:s");
	$situacao_usuario = $_POST["usuario_instituicao_situacao"];

	$usuario = new usuario();
	$usuario->setNome($nome_usuario);
	$usuario->setCPF($cpf_usuario);
	$usuario->setEmail($email_usuario);
	$usuario->setSexo($sexo_usuario);
	$usuario->setDataNascimento($data_nascimento);
	$usuario->setLogin($login_usuario);
	$usuario->setSenha($senha_usuario);
	$usuario->alterar($cod_usuario_pta);

	if (($opcao_senha == "enviar_senha") or ($opcao_senha == "gerar_nova"))
	{
		$tipo_informativo = "U";
		include("mensagem.php");
	}
}

header("Location: index.php");
exit;
?>