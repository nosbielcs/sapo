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

switch($tipo_informativo)
{
	case "I":
		$para = $email_usuario;
		$assunto = "Início do Curso '".$nome_curso."' SA²pO NEAD - FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Seja bem vindo ao Curso '".$nome_curso."' ofertado pela Instituição\n";
		$mensagem.= " '".$nome_instituicao."' com início na data de ".$data_inicio." e com\n";
		$mensagem.= " término na data ".$data_final.", durante o curso, o nosso veículo de";
		$mensagem.= " estudos a Distância será o SA²pO - Sistema de Apoio a Aprendizagem Online.\n\n";
		$mensagem.= "Para acessar o SA²pO siga as instruções abaixo:\n\n";
		$mensagem.= "1. Acesse o site do NEAD www.nead.fepe.org.br\n";
		$mensagem.= "2. No topo da página você encontrará a área 'Ambiente Virtual'\n";
		$mensagem.= "3. Utilize os dados a seguir para acessar o SA²pO:\n\n";
		$mensagem.= "   Usuário: ".$login_usuario."\n";
		$mensagem.= "   Senha: ".$senha_usuario."\n\n";
		$mensagem.= "4. Preencha os campos 'Usuário' e 'Senha' com os dados acima e clique em 'Entrar'\n";
		$mensagem.= "5. No menu 'Instituições' clique no nome da Instituição '".$nome_instituicao."'\n";
		$mensagem.= "6. Em 'Meus Cursos' observe se o Curso '".$nome_curso."' está disponível\n";
		$mensagem.= "7. Para acessar o Curso clique no nome do Curso ou na palavra acessar\n\n";
		$mensagem.= "  Atenção! Para sua segurança em seu primeiro acesso altere sua senha conforme instruções:\n\n";
		$mensagem.= "1. Acesse o Módulo PERFIL que se encontra na Barra de Ferramentas\n";
		$mensagem.= "2. Clique em Dados Cadastrais e depois em Editar Dados Cadastrais\n";
		$mensagem.= "3. Informe a Senha Autal, digite a Nova Senha nos campos solicitados e Clique em Gravar.\n\n";
		$mensagem.= "   Qualquer dúvida ou sugestão entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco disponível em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site da FEPE www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "Núcleo de Educação a Distância - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		$enviou = enviarEmail($de, $para, $assunto, $mensagem);
	break;
	
	case "F":
		$para = $email_usuario;
		$assunto = "Fim do Curso '".$nome_curso."' SA²pO NEAD - FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Esta mensagem tem o intuíto de informar que o Curso '".$nome_curso."' \n";
		$mensagem.= " ofertado pela Instituição '".$nome_instituicao."' encontra-se encerrado a partir desta data.\n\n";
		$mensagem.= "   Gostaríamos de agradecer a sua participação, qualquer dúvida ou sugestão entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco disponível em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site da FEPE www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "   Núcleo de Educação a Distância - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		$enviou = enviarEmail($de, $para, $assunto, $mensagem);
	break;
	
	case "U":
		$para = $email_usuario;
		$assunto = "Informativo SA²pO NEAD/FEPE";
		$mensagem = "Prezado(a) ".$nome_usuario.",\n\n";
		$mensagem.= "	Seus dados foram atualizados em nosso Sistema, ";
		$mensagem.= "para acessar o SA²pO siga os passos abaixo:\n\n";
		$mensagem.= "1. Acesse o site do NEAD www.nead.fepe.org.br\n";
		$mensagem.= "2. No topo da página você encontrará a área 'Ambiente Virtual'\n";
		$mensagem.= "3. Utilize os dados a seguir para acessar o SA²pO:\n\n";
		$mensagem.= "   Usuário: ".$login_usuario."\n";
		$mensagem.= "   Senha: ".$senha_usuario."\n\n";
		$mensagem.= "4. Preencha os campos 'Usuário' e 'Senha' com os dados acima e clique em 'Entrar'\n";
		$mensagem.= "5. No menu 'Instituições' clique no nome da Instituição '".$nome_instituicao."'\n";
		$mensagem.= "6. Em 'Meus Cursos' observe se o Curso '".$nome_curso."' está disponível\n";
		$mensagem.= "7. Para acessar o Curso clique no nome do Curso ou na palavra acessar\n\n";
		$mensagem.= "   Qualquer dúvida ou sugestão entre em contato com nossa Equipe pelos seguintes meios:\n\n";
		$mensagem.= "- Telefone (041) 3111-1835\n";
		$mensagem.= "- Fale Conosco disponível em nosso site www.nead.fepe.org.br\n";
		$mensagem.= "- E-mail nead@fepe.org.br\n\n";
		$mensagem.= "Site do NEAD: www.nead.fepe.org.br\n";
		$mensagem.= "Site da FEPE: www.fepe.org.br\n\n";
		$mensagem.= "Atenciosamente,\n";
		$mensagem.= "Núcleo de Educação a Distância - NEAD / FEPE";
		
		$de = "From: nead@fepe.org.br (FEPE - NEAD)";
		enviarEmail($de, $para, $assunto, $mensagem);
	break;
}
?>