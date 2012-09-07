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

session_start();

switch($tipo_informativo)
{
	case "I":
		$para = $email_usuario;
		$assunto = "In�cio do Curso '".$nome_curso."' SA�pO NEAD - FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Seja bem vindo ao Curso '".$nome_curso."' ofertado pela Institui��o\n";
		$mensagem.= " '".$nome_instituicao."' com in�cio na data de ".$data_inicio." e com\n";
		$mensagem.= " t�rmino na data ".$data_final.", durante o curso, o nosso ve�culo de";
		$mensagem.= " estudos a Dist�ncia ser� o SA�pO - Sistema de Apoio a Aprendizagem Online.\n\n";
		$mensagem.= "Para acessar o SA�pO siga as instru��es abaixo:\n\n";
		$mensagem.= "1. Acesse o site do NEAD www.nead.fepe.org.br\n";
		$mensagem.= "2. No topo da p�gina voc� encontrar� a �rea 'Ambiente Virtual'\n";
		$mensagem.= "3. Utilize os dados a seguir para acessar o SA�pO:\n\n";
		$mensagem.= "   Usu�rio: ".$login_usuario."\n";
		$mensagem.= "   Senha: ".$senha_usuario."\n\n";
		$mensagem.= "4. Preencha os campos 'Usu�rio' e 'Senha' com os dados acima e clique em 'Entrar'\n";
		$mensagem.= "5. No menu 'Institui��es' clique no nome da Institui��o '".$nome_instituicao."'\n";
		$mensagem.= "6. Em 'Meus Cursos' observe se o Curso '".$nome_curso."' est� dispon�vel\n";
		$mensagem.= "7. Para acessar o Curso clique no nome do Curso ou na palavra acessar\n\n";
		$mensagem.= "  Aten��o! Para sua seguran�a em seu primeiro acesso altere sua senha conforme instru��es:\n\n";
		$mensagem.= "1. Acesse o M�dulo PERFIL que se encontra na Barra de Ferramentas\n";
		$mensagem.= "2. Clique em Dados Cadastrais e depois em Editar Dados Cadastrais\n";
		$mensagem.= "3. Informe a Senha Autal, digite a Nova Senha nos campos solicitados e Clique em Gravar.\n\n";
		$mensagem.= "   Qualquer d�vida ou sugest�o entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco dispon�vel em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site da FEPE www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "N�cleo de Educa��o a Dist�ncia - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		$enviou = enviarEmail($de, $para, $assunto, $mensagem);
	break;
	
	case "F":
		$para = $email_usuario;
		$assunto = "Fim do Curso '".$nome_curso."' SA�pO NEAD - FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Esta mensagem tem o intu�to de informar que o Curso '".$nome_curso."' \n";
		$mensagem.= " ofertado pela Institui��o '".$nome_instituicao."' encontra-se encerrado a partir desta data.\n\n";
		$mensagem.= "   Gostar�amos de agradecer a sua participa��o, qualquer d�vida ou sugest�o entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco dispon�vel em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site da FEPE www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "   N�cleo de Educa��o a Dist�ncia - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		$enviou = enviarEmail($de, $para, $assunto, $mensagem);
	break;
	
	case "U":
		$para = $email_usuario;
		$assunto = "Informativo SA�pO NEAD/FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Seus dados foram atualizados em nosso Sistema, ";
		$mensagem.= "para acessar o SA�pO siga os passos abaixo:\n\n";
		$mensagem.= "1. Acesse o site do NEAD www.nead.fepe.org.br\n";
		$mensagem.= "2. No topo da p�gina voc� encontrar� a �rea 'Ambiente Virtual'\n";
		$mensagem.= "3. Utilize os dados a seguir para acessar o SA�pO:\n\n";
		$mensagem.= "   Usu�rio: ".$login_usuario."\n";
		$mensagem.= "   Senha: ".$senha_usuario."\n\n";
		$mensagem.= "4. Preencha os campos 'Usu�rio' e 'Senha' com os dados acima e clique em 'Entrar'\n";
		$mensagem.= "5. No menu 'Institui��es' clique no nome da Institui��o '".$nome_instituicao."'\n";
		$mensagem.= "6. Em 'Meus Cursos' observe se o Curso '".$nome_curso."' est� dispon�vel\n";
		$mensagem.= "7. Para acessar o Curso clique no nome do Curso ou na palavra acessar\n\n";
		$mensagem.= "   Qualquer d�vida ou sugest�o entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco dispon�vel em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site do NEAD: www.nead.fepe.org.br\n";
		$mensagem.= "Site da FEPE: www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "N�cleo de Educa��o a Dist�ncia - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		enviarEmail($de, $para, $assunto, $mensagem);
	break;
}
?>