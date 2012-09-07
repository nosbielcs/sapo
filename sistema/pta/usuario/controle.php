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
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/classe.phpmailer.php");
include("../../../classes/classe.smtp.php");
include("../../../funcoes/funcoes.php");

$pagina = $_POST["pagina"];
$qtd_listagem = $_POST["quantidade"];
$ordenacao = $_POST["ordenacao"];
$url = "?pag=".$pagina."&qtd=".$qtd_listagem."&ordem=".$ordenacao;
$nome_curso = $_SESSION["nome_curso"];
$cod_curso = $_SESSION["cod_curso"];

if ($_GET["acao_usuario"])
{
	$acao_usuario = $_GET["acao_usuario"];
	$cod_usuario_pta = $_GET["cod_usuario"];
	$cod_turma = $_GET["cod_turma"];
}
else
	$acao_usuario = $_POST["acao_usuario"];

$acesso = $_POST["tipo_acesso"];
$nome_instituicao = $_SESSION["nome_instituicao"];
$codigo_curso_inscrito = $_POST["codigo_curso_inscrito"];

if (!empty($acao_usuario))
{
	if (($acao_usuario == "novo") or ($acao_usuario == "editar") or ($acao_usuario == "excluir_usuario"))
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
			if (($acao_usuario == "editar")	or ($opcao_senha == "enviar_senha"))
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
	}

	switch($acao_usuario)
	{
		case "novo":
			$usuario = new usuario();
			$retorno = $usuario->verificaDisponibilidadeLogin($login_usuario);
			
			if (!$retorno)
			{
				$cod_turma = $_POST["curso_turmas"];
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
				$cod_usuario_pta = $usuario->getCodigo();
				$usuario->vinculaUsuarioTurma($cod_turma, $cod_usuario_pta, $acesso, $situacao_usuario);
				$_SESSION["mensagem_usuario_pta"] = "Usuário cadastrado com Sucesso!";
			}
		break;
		
		case "editar":
			$usuario = new usuario();
			$usuario->setNome($nome_usuario);
			$usuario->setCPF($cpf_usuario);
			$usuario->setEmail($email_usuario);
			$usuario->setSexo($sexo_usuario);
			$usuario->setDataNascimento($data_nascimento);
			$usuario->setLogin($login_usuario);
			$usuario->setSenha($senha_usuario);
			$usuario->alterar($cod_usuario_pta);
			$_SESSION["mensagem_usuario_pta"] = "Alterações realizadas com Sucesso!";
		break;
		
		case "desvincular_turma":
			$usuario = new usuario();
			$usuario->desvincularTurma($cod_usuario_pta, $cod_turma);
			$_SESSION["mensagem_usuario_pta"] = "Alterações realizadas com Sucesso!";
		break;
		
		case "excluir_usuario":
			$usuario_turma = new turma();
			$usuario_turma->desvinculaUsuarioTurma($cod_usuario_pta, $cod_turma);	
		break;
		
		case "inscritos":
			$vetor_inscritos = $_POST["usuariosExportar"];
			$total_inscritos = count($vetor_inscritos);
			$cod_turma = $_POST["curso_turmas"];
			$opcao_senha = $_POST["enviar_email"];
			
			$turma = new turma();
			$turma->carregar($cod_turma);
			$descricao_turma = $turma->getDescricao();
			
			for ($i = 0; $i < $total_inscritos; $i++)
			{
				$conexao = mysql_connect("localhost", "inscricao", "F3!nScp3");
				$db = mysql_select_db("inscricao", $conexao);
				$cpf = $vetor_inscritos[$i];				
				$sql = "SELECT nome, cpf, data_nasc, email FROM inscritos WHERE cpf = '".$cpf."' AND cod_cur = ".$codigo_curso_inscrito;
				$resultado = mysql_query($sql);
				mysql_data_seek($resultado, 0);
				$retorno = mysql_fetch_assoc($resultado);
				mysql_close($conexao);
				
				$nome_usuario = $retorno["nome"];
				$cpf_usuario = $retorno["cpf"];
				$login_usuario = $cpf;
				$senha_usuario = md5(mktime().$cpf_usuario.$nome_usuario);
				$senha_usuario = substr($senha_usuario, 0, 15);
				$data_nascimento = $retorno["data_nasc"];
				$dia_nascimento = substr($data_nascimento, 0, 2);
				$mes_nascimento = substr($data_nascimento, 3, 2);
				$ano_nascimento = substr($data_nascimento, 6, 4);
				$data_nascimento = $ano_nascimento."-".$mes_nascimento."-".$dia_nascimento;
				$email_usuario = $retorno["email"];
				$data_usuario = date("Y-m-d");
				$hora_usuario = date("H:m:s");
				$situacao_usuario = "A";
				
				$usuario = new usuario();
				$usuario->setNome($nome_usuario);
				$usuario->setCPF($cpf_usuario);
				$usuario->setEmail($email_usuario);
				$usuario->setSexo("F");
				$usuario->setDataNascimento($data_nascimento);
				$usuario->setDataUsuario($data_usuario);
				$usuario->setHora($hora_usuario);
				$usuario->setLogin($login_usuario);
				$usuario->setSenha($senha_usuario);
				$usuario->setSituacao($situacao_usuario);
				$usuario->inserir();
				
				$usuario->recuperaCodigo();
				$cod_usuario = $usuario->getCodigo();
				$usuario->vinculaUsuarioTurma($cod_turma, $cod_usuario, $acesso, $situacao_usuario);
				
				if ($opcao_senha == "on")
				{
					$tipo_informativo = "U";
					include("mensagem.php");
				}
			}

			$_SESSION["mensagem_usuario_pta"] = "Inscritos vinculados ao SA²pO com Sucesso!";
		break;
		
		case "sapo":
			$codigos = explode(";", $_POST["codigos_usuarios"]);
			$cod_turma = $_POST["curso_turmas"];
			$total = sizeof($codigos);
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigos[$i] != "")
				{
					$cod_usuario = $codigos[$i];
					$usuario = new usuario();
					$usuario->vinculaUsuarioTurma($cod_turma, $codigos[$i], $acesso, "A");
				}
			}

			$_SESSION["mensagem_usuario_pta"] = "Usuário vinculado com Sucesso!";
		break;
		
		case "informativo":
			$codigos = explode(";", $_POST["codigos_usuarios"]);
			$cod_turma = $_POST["curso_turmas"];
			$total = sizeof($codigos);
			
			$curso = new curso();
			$curso->carregar($cod_curso);
			$data_inicio = formataData($curso->getDataInicio(), "/");
			$data_final = formataData($curso->getDataFim(), "/");
			
			for ($i = 0; $i < $total; $i++)
			{
				if ($codigos[$i] != "")
				{
					$cod_usuario = $codigos[$i];
					$usuario = new usuario();
					$usuario->carregar($codigos[$i]);
					$email_usuario = $usuario->getEmail();
					$nome_usuario = $usuario->getNome();
					$login_usuario = $usuario->getLogin();
					$senha_usuario = $usuario->getSenha();
					
					if ($_POST["tipo_informativo"])
					{
						$tipo_informativo = $_POST["tipo_informativo"];
						include("mensagem.php");
					}
				}
			}
			
			$_SESSION["mensagem_usuario_pta"] = "Informativo enviado com Sucesso!";
		break;
	}

	if (($opcao_senha == "enviar_senha") or ($opcao_senha == "gerar_nova"))
	{
		$tipo_informativo = "U";
		include("mensagem.php");
	}
}

header("Location: index.php".$url);
exit;
?>