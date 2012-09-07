<?php
/*
=====================================================================
#  PROJETO: Sa�po                                                   #
#  FUNCA��O ECUM�NICA DE PROTE��O AO EXCEPCIONAL                    #
#                                                                   #
#  Programa��o                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

//Recupera senha
include("config/config.bd.php");
include("classes/classe_bd.php");
include("classes/classe.phpmailer.php");
include("classes/usuario.php");
include("funcoes/funcoes.php");

$email = $_POST["email"];

if ($email == "")
	$erro_email = 1;
else
  	if (!eregi("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $email))
    	$erro_email = 2;
  	else
    	$erro_email = 0;  

if ($erro_email == 0)
{
	$usuario = new usuario();
	$usuario->recuperarLoginSenha($email);
	
	if ($usuario->linhas == 0)
	{
		$erro_email = 3;
	}
	else
	{
		$total = $usuario->linhas;
		
		$assunto = "Recupera��o de senha Sistema SA�pO - NEAD / FEPE";
		$de = "";
		$para = $email;
		
		$mensagem = "   Foi solicitado a Recupera��o de Usu�rio e Senha vinculados ao Endere�o de e-mail\n";
		$mensagem.= "\"".$email."\" e o(s) seguinte(s) resultado(s) foi(ram) encontrado(s):\n\n";
		
		for ($i = 0; $i < $total; $i++)
		{
			$login = $usuario->data["login"];
			$senha = $usuario->data["senha"];
			$email_usuario = $usuario->data["email"];
			$nome = $usuario->data["nome"];
			
			$mensagem.= "Nome: ".$nome."\n";
			$mensagem.= "Login: ".$login."\n";
			$mensagem.= "Senha: ".$senha."\n\n";
			
			$usuario->proximo();
		}
		
		$mensagem.= "Esta Mensagem foi gerada automaticamente pelo Sistema SA�pO, por favor n�o responda.\n\n";
		$mensagem.= "   Qualquer d�vida ou sugest�o entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1800 Ramal 1835\n";
		$mensagem.= "- Fale Conosco dispon�vel em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site da FEPE www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "   N�cleo de Educa��o a Dist�ncia - NEAD / FEPE";
		
		$enviou = enviarEmail($de, $para, $assunto, $mensagem);
			
		if (!$enviou)
			$erro_email = "enviado";
		else
			$erro_email = 4;
		//mail($email_usuario, "Recupera��o de senha Sistema Sa�pO - NEAD / FEPE", $msg, "From: nead@fepe.org.br");
	}
}
else
{
	$erro_email = $erro_email;
}

header("Location: recupera_senha.php?erro_email=".$erro_email."&email=".$email);
?>