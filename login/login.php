<?php
/*
=====================================================================
#  PROJETO: Sapo                                                    #
#  FUNCA?O ECUM?ICA DE PROTE?O AO EXCEPCIONAL                       #
#                                                                   #
#  Programa?o                                                       #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

session_start();

include("../config/config.bd.php");
include("../classes/classe_bd.php");
include("../classes/log.php");
include("../classes/usuario.php");
include("../funcoes/funcoes.php");

//Funcao para autenticar sessoes
function session_registra()
{
	//Autenticar o login e a senha

	//Registra a hora que o usuario logou
	$time_ini = md5(mktime());
	
	//Criptografa o login e a senha
	$session_usuario = md5($_POST['login'].$_POST['senha']);
	$_SESSION['session_key'] = $time_ini.$session_usuario.session_id();
	$_SESSION['session_user'] = $_POST['login'];
	$_SESSION['current_session'] = $_POST['login']."=".$_SESSION['session_key'];
}

if (($_POST['login']) and ($_POST['senha']))
{
	$consulta = new usuario();
	$consulta->efetuarLogin($_POST["login"], $_POST["senha"]);
	
	if($consulta->linhas > 0)
	{
		//if (($consulta->getLogin() == "suporte") or ($consulta->getLogin() == "cleibson") or ($consulta->getLogin() == "louseslayer") or ($consulta->getLogin() == "admin") or ($consulta->getLogin() == "teste"))
		//{
			session_registra();
			$_SESSION["cod_usuario"] = $consulta->getCodigo();
			$_SESSION["login_usuario"] = $consulta->getLogin();
			$_SESSION["senha_usuario"] = $consulta->getSenha();
			$_SESSION["nome_usuario"] = $consulta->getNome();
			$_SESSION["email_usuario"] = $consulta->getEmail();
			$_SESSION["situacao_usuario"] = $consulta->getSituacao();
			
			$data_log = date("Y-m-d");
			$hora_log = date("H:i:s");
			logSistema($_SESSION["cod_usuario"], 0, "Efetuou Login", session_id(), $data_log, $hora_log);
			
			header("Location: ../sistema/index.php");
			exit;
		/*}
		else
		{
			header("Location: ../manutencao.htm");
			exit;
		}*/
	}
	else
	{
		$_SESSION["erro_login"] = 1;
		header("Location: ../index.php");
		exit;
	}
}
else
	header("Location: ../index.php");
?>