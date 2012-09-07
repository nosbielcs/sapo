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
include("../../../classes/perfil.php");
include("../../../classes/usuario.php");
include("../../../funcoes/funcoes.php");

//Registra Variáveis que vieram do Formulário
$acao_perfil = $_POST["acao_perfil"];
$cod_usuario = $_SESSION["cod_usuario"];

if (!empty($acao_perfil))
{
	$usuario = new usuario();
	$usuario->carregar($cod_usuario);
	$perfil = new perfil();
	$perfil->carregar($cod_usuario);
	
	if ($perfil->linhas == 0)
	{
		$perfil->setCodigoUsuario($cod_usuario);
		$perfil->inserir();
		$perfil->carregar($cod_usuario);
	}
	
	$cod_perfil = $perfil->getCodigo();
	
	switch ($acao_perfil)
	{
		case "dados_pessoais":
			$nome_usuario = $_POST["nomePerfil"];
			$sexo_usuario = $_POST["sexoPerfil"];
			$dia_nascimento = $_POST["dia"];
			$mes_nascimento = $_POST["mes"];
			$ano_nascimento = $_POST["ano"];
			$data_nascimento = $ano_nascimento."-".$mes_nascimento."-".$dia_nascimento;
			
			$usuario->setNome($nome_usuario);
			$usuario->setSexo($sexo_usuario);
			$usuario->setDataNascimento($data_nascimento);
			$usuario->alterarDadosPessoais($cod_usuario);
			
			$foto = $_POST["imagemAtualPerfil"];
			$miniatura = $_POST["imagemMiniaturaAtualPerfil"];
			$imagem_nova = $_FILES["imagemNovaPerfil"];
			$sem_imagem = $_POST["semImagemPerfil"];
			$cidade = $_POST["cidadePerfil"];
			$uf = $_POST["ufPerfil"];
			$descricao_pessoal = $_POST["descrPessoalPerfil"];
			$interesses = $_POST["interessesPerfil"];
			$site_pessoal = validaWebSite($_POST["sitePessoalPerfil"]);
			$apelido = $_POST["apelidoChat"];
			
			//Verifica Imagem e se precisa redimensionar
			if ($imagem_nova["name"] != "")
			{
				$diretorio = "../../../arquivos/perfil/".$cod_usuario."/";
				removerDiretorio($diretorio);
				verificaDiretorio($diretorio);
				move_uploaded_file($imagem_nova["tmp_name"], $diretorio.$imagem_nova["name"]);
				$foto = $imagem_nova["name"];
				$miniatura = redimensionaImagem($foto, $diretorio);
				chmod($diretorio.$foto, 0777);
				
				if ($foto != $miniatura)
					chmod($diretorio.$miniatura, 0777);
			}
			
			if (($foto == "") or ($sem_imagem == "true"))
			{
				$foto = "sem_foto.gif";
				$miniatura = "sem_foto.gif";
			}
			
			$perfil->setApelido($apelido);
			$perfil->setDescricaoPessoal($descricao_pessoal);
			$perfil->setInteresse($interesses);
			$perfil->setCidade($cidade);
			$perfil->setUF($uf);
			$perfil->setSitePessoal($site_pessoal);
			$perfil->setFoto($foto);
			$perfil->setMiniatura($miniatura);
			
			$perfil->alterarDadosPessoais($cod_perfil);
			
			$_SESSION["aba_perfil"] = $acao_perfil;
		break;
		
		case "dados_profissionais":
			$profissao = $_POST["profissaoPerfil"];
			$empresa = $_POST["empresaPerfil"];
			$cargo = $_POST["cargoPerifl"];
			$site_profissional = validaWebSite($_POST["siteProfissionalPerfil"]);
			$detalhes = $_POST["detalhesPerfil"];
			
			$perfil->setDescricaoPessoal($descricao);
			$perfil->setProfissao($profissao);
			$perfil->setCargo($cargo);
			$perfil->setEmpresa($empresa);
			$perfil->setDetalhes($detalhes);
			$perfil->setSiteProfissional($site_profissional);
			
			$perfil->alterarDadosProfissionais($cod_perfil);

			$_SESSION["aba_perfil"] = $acao_perfil;
		break;
		
		case "dados_cadastrais":
			$senha_atual = $usuario->getSenha();
			$senha_informada = $_POST["senhaInformada"];
			$senha_nova = $_POST["senhaNova"];
			$confirma_senha = $_POST["confirmaSenha"];
			$login = $_POST["loginPerfil"];
			$cpf = $_POST["cpfPerfil"];
			$email = $_POST["emailPerfil"];
			
			if ($senha_informada != "") 
			{
				if ($senha_informada != $senha_atual)
					$_SESSION["erro_senha_atual"] = 1;
				else
					$_SESSION["erro_senha_atual"] = 0;
			}
			else
				$_SESSION["erro_senha_atual"] = 1;
				
			if (($senha_nova != "") and ($confirma_senha != ""))
			{
				if ($senha_nova != $confirma_senha)
					$_SESSION["erro_senha_nova"] = 1;
				else
					$_SESSION["erro_senha_nova"] = 0;
			}
			else
				$_SESSION["erro_senha_nova"] = 0;
			
			if (($_SESSION["erro_senha_atual"] == 0) and ($_SESSION["erro_senha_nova"]) == 0)
			{
				if (!empty($senha_nova))
					$senha = $senha_nova;
				else
					$senha = $senha_atual;
					
				$usuario->setCPF($cpf);
				$usuario->setLogin($login);
				$usuario->setSenha($senha);
				$usuario->setEmail($email);
				
				$usuario->alterarDadosCadastrais($cod_usuario);
				
				unset($_SESSION["erro_senha_atual"]);
				unset($_SESSION["erro_senha_nova"]);
				
				$_SESSION["aba_perfil"] = $acao_perfil;
			}
			else
			{
				$_SESSION["aba_perfil"] = "formulario_dados_cadastrais";
				$_SESSION["email"] = $email;
				$_SESSION["apelido"] = $apelido;
				$_SESSION["cpf"] = $cpf;
			}
		break;
	}
}/*
//Dados Pessoais
$nome = $_SESSION["nome"];
$dia_nasc = $_SESSION["dia_nasc"];
$mes_nasc = $_SESSION["mes_nasc"];
$ano_nasc = $_SESSION["ano_nasc"];
$data_nascimento = $ano_nasc."-".$mes_nasc."-".$dia_nasc;
$sexo = $_SESSION["sexo"];
$descricao = $_SESSION["descricao"];
$interesse = $_SESSION["interesse"];
$foto = $_SESSION["foto"];
$miniatura = $_SESSION["miniatura"];
$cidade = $_SESSION["cidade"];
$uf = $_SESSION["uf"];
$semImagem = $_SESSION["semImagem"];
$site_pessoal = validaWebSite($_SESSION["site_pessoal"]);
$site_profissional = validaWebSite($_SESSION["site_profissional"]);

//Dados Profissionais
$profissao = $_SESSION["profissao"];
$empresa = $_SESSION["empresa"];
$cargo = $_SESSION["cargo"];
$detalhes = $_SESSION["detalhes"];

//Dados Cadastrais
$login = $_SESSION["login"];
$email = $_SESSION["email"];
$cpf = $_SESSION["cpf"];

if ($_SESSION["senhaNova"] != "")
	$senha = $_SESSION["senhaNova"];
else
	$senha = $_SESSION["senha_usuario"];

//Cria Objeto Perfil
$perfil = new perfil();
//Seta valores para Alterações na Base de Dados
$perfil->setDescricaoPessoal($descricao);
$perfil->setInteresse($interesse);
$perfil->setProfissao($profissao);
$perfil->setCargo($cargo);
$perfil->setEmpresa($empresa);
$perfil->setDetalhes($detalhes);
$perfil->setCidade($cidade);
$perfil->setUF($uf);
$perfil->setSitePessoal($site_pessoal);
$perfil->setSiteProfissional($site_profissional);
$perfil->setFoto($foto);
$perfil->setMiniatura($miniatura);
if ($_SESSION["acao_perfil"] == "novo_perfil")
{
	$perfil->setCodigoUsuario($cod_usuario);
	$perfil->inserir();
}
else
	$perfil->alterar($cod_perfil, $cod_usuario);
//

//Cria Objeto Usuario
$usuario = new usuario();
//Seta valores para Alterações na Base de Dados
$usuario->setCodigo($cod_usuario);
$usuario->setNome($nome);
$usuario->setDataNascimento($data_nascimento);
$usuario->setCPF($cpf);
$usuario->setSexo($sexo);
$usuario->setEmail($email);
$usuario->setLogin($login);
$usuario->setSenha($senha);
$usuario->AtualizaPerfil();

//Libera Variáveis
unset($_SESSION["acao_perfil"]);

//Direciona para a Página de Mensagem
header("Location: mensagem.htm");
exit;*/
header("Location: index.php");
exit;
?>