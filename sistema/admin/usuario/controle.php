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
include("../../../classes/usuario.php");
include("../../../classes/classe.phpmailer.php");
include("../../../funcoes/funcoes.php");

$pagina = $_POST["pagina"];
$qtd_listagem = $_POST["quantidade"];
$ordenacao = $_POST["ordenacao"];
$url = "?pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;

$acao_usuario = $_POST["acao_usuario"];

if (!empty($acao_usuario))
{
	$cod_usuario_instituicao = $_POST["cod_usuario_instituicao"];
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

	$usuario = new usuario();
	
	if (($opcao_senha == "cadastrar_login") or ($opcao_senha == "gerar_nova"))
	{
		$senha_usuario = md5(mktime().$cpf_usuario.$nome_usuario);
		$senha_usuario = substr($senha_usuario, 0, 15);
	}
	else
		if (($acao_usuario == "editar")	or ($opcao_senha == "enviar_senha"))
		{
			$usuario->carregar($cod_usuario_instituicao);
			$senha_usuario = $usuario->getSenha();
			$login_usuario = $usuario->getLogin();
		}
		
	$data_nascimento = $ano_nascimento."-".$mes_nascimento."-".$dia_nascimento;
	$data_usuario = date("Y-m-d");
	$hora_usuario = date("H:m:s");
	$situacao_usuario = $_POST["usuario_instituicao_situacao"];
	$acesso = "I";

	switch($acao_usuario)
	{
		case "novo":
			$retorno = $usuario->verificaDisponibilidadeLogin($login_usuario);
			
			if (retorno)
			{
				$usuario->setNome($nome_usuario);
				$usuario->setCPF($cpf_usuario);
				$usuario->setEmail($email_usuario);
				$usuario->setSexo($sexo_usuario);
				$usuario->setDataNascimento($data_nascimento);
				$usuario->setDataUsuario($data_usuario);
				$usuario->setHora($hora_usuario);
				$usuario->setLogin($login_usuario);
				$usuario->setSenha($senha_usuario);
				$usuario->setSituacao($situacao_usuario);
				$usuario->inserir();
				
				$usuario->recuperaCodigo();
				$cod_usuario_instituicao = $usuario->getCodigo();
				$usuario->vinculaUsuarioInstituicao($cod_instituicao, $cod_usuario_instituicao, $acesso, $situacao_usuario);
			}
		break;
		
		case "editar":		
			$usuario->setNome($nome_usuario);
			$usuario->setCPF($cpf_usuario);
			$usuario->setEmail($email_usuario);
			$usuario->setSexo($sexo_usuario);
			$usuario->setDataNascimento($data_nascimento);
			$usuario->setLogin($login_usuario);
			$usuario->setSenha($senha_usuario);
			$usuario->alterar($cod_usuario_instituicao);
			
			$usuario->atualizaSituacaoInstituicao($cod_usuario_instituicao, $cod_instituicao, $situacao_usuario);
		break;
		
		case "excluir_usuario":
			$usuario->excluir($cod_usuario_instituicao);	
		break;
	}
	
	if (($opcao_senha == "enviar_senha") or ($opcao_senha == "gerar_nova"))
	{
		$para = $email_usuario;
		$assunto = "Informativo Sa²po NEAD/FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario."\n\n";
		$mensagem.= "	Seus dados foram atualizados em nosso Sistema, ";
		$mensagem.= "para acessar o Sa²po utilize os dados a seguir:\n";
		$mensagem.= "Login: ".$login_usuario."\n";
		$mensagem.= "Senha: ".$senha_usuario."\n\n";
		$mensagem.= "Site do NEAD: www.nead.fepe.org.br\n";
		$mensagem.= "Site da FEPE: www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "Núcleo de Educação a Distância - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		enviarEmail($de, $para, $assunto, $mensagem);
	}
}

header("Location: index.php".$url);
exit;
?>