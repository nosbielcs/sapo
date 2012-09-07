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

include("../config/session.lib.php");
include("../config/config.bd.php");
include("../classes/classe_bd.php");
include("../classes/configuracao.php");
include("../classes/curso.php");
include("../funcoes/funcoes.php");
include("../classes/instituicao.php");
include("../classes/log.php");
include("../classes/turma.php");
include("../classes/usuario.php");
include("../classes/usuario_online.php");

$cod_turma = $_POST["cod_turma"];
$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$email_usuario = $_SESSION["email_usuario"];
$cod_inst = $_POST["cod_inst"];
$acesso = $_POST["acesso"];

$data_log = date("Y-m-d");
$hora_log = date("H:i:s");

if (!empty($cod_turma))
{
	$_SESSION["cod_turma"] = $cod_turma ;
	
	if ($_POST["acesso"])
	{
		$usuario = new usuario();
		$usuario->verificaAcesso($cod_usuario, $cod_turma, $acesso);

		if ($usuario->linhas == 0)
			$usuario->verificaAcessoInstituicao($cod_usuario, $cod_inst, $acesso);

		if ($usuario->linhas == 0)
		{
			header("Location: index.php");
			exit;
		}
		else
		{
			$_SESSION["acesso"] = $acesso;
			$total_visitas = $usuario->data["visitas"];
			
			if ($total_visitas == 0)
			{
				$total_visitas = 0;
				$_SESSION["total_visitas"] = 1;
				$_SESSION["data_visita"] = date("d/m/Y");
				$_SESSION["hora_visita"] = date("H:i:s");
			}
			else
			{
				$_SESSION["total_visitas"] = $total_visitas;
				$_SESSION["data_visita"] = $usuario->data["data_visita"];
				$_SESSION["hora_visita"] = $usuario->data["hora_visita"];
			}
			
			switch($acesso)
			{
				case "A":
					$diretorio = "admin/";
					$_SESSION["tipo_acesso"] = "admin";
				break;
				
				case "I":
					$diretorio = "pta/";
					$_SESSION["tipo_acesso"] = "pta";
				break;
				
				case "T":
					$diretorio = "tutor/";
					$_SESSION["tipo_acesso"] = "tutor";
				break;
				
				case "P":
					$diretorio = "supervisor/";
					$_SESSION["tipo_acesso"] = "supervisor";
				break;
				
				case "L":
					$diretorio = "aluno/";
					$_SESSION["tipo_acesso"] = "aluno";
				break;
				
				case "S":
					$diretorio = "tutor/";
					$_SESSION["tipo_acesso"] = "tutor";
				break;
			}
			
			if ($acesso == "A")
			{
				$_SESSION["cod_instituicao"] = $cod_inst;
				$instituicao = new instituicao();
				$instituicao->carregar($_SESSION["cod_instituicao"]);
				$_SESSION["nome_instituicao"] = $instituicao->getNome();
				$_SESSION["imagem_instituicao"] = $instituicao->getImagem();
				
				//Verifica Diretório da Instituição
				$_SESSION["dir_instituicao"] = verificaDiretorio(_FILE_DIR.$_SESSION["cod_instituicao"]."/"); 
				
				//Verifica Diretório de Imagens da Instituição
				$_SESSION["dir_imagens_instituicao"] = verificaDiretorio($_SESSION["dir_instituicao"]."imagens/");
			
				//Verifica Diretório de Cursos da Instituição
				$_SESSION["dir_cursos_instituicao"] = verificaDiretorio($_SESSION["dir_instituicao"]."cursos/");
				
				$visitas = ++$total_visitas;
				$data_visita = date("Y-m-d");
				$hora_visita = date("H:i:s");
				$usuario->atualizaVisitaInstituicao($_SESSION["cod_usuario"], $cod_inst, $visitas, $data_visita, $hora_visita);
				
				header("Location: ".$diretorio."index.php");
				exit;
			}
			else
				if ($acesso == "I")
				{
					//Dados Instituição
					$_SESSION["cod_instituicao"] = $cod_inst;
					$instituicao = new instituicao();
					$instituicao->carregar($_SESSION["cod_instituicao"]);
					$_SESSION["nome_instituicao"] = $instituicao->getNome();
					$_SESSION["imagem_instituicao"] = $instituicao->getImagem();
					
					//Dados Curso
					$_SESSION["cod_curso"] = $cod_turma;
					$curso = new curso();
					$curso->carregar($_SESSION["cod_curso"]);
					$_SESSION["nome_curso"] = $curso->getNome();
					$_SESSION["situacao_curso"] = $curso->getSituacao();
					
					
					//Verifica Diretório da Instituição
					$_SESSION["dir_instituicao"] = verificaDiretorio(_FILE_DIR.$_SESSION["cod_instituicao"]."/");
									
					//Verifica Diretório do Curso
					$_SESSION["dir_cursos_instituicao"] = verificaDiretorio($_SESSION["dir_instituicao"]."cursos/".$_SESSION["cod_curso"]);
					
					$visitas = ++$total_visitas;
					$data_visita = date("Y-m-d");
					$hora_visita = date("H:i:s");
					$usuario->atualizaVisitaInstituicao($_SESSION["cod_usuario"], $cod_inst, $visitas, $data_visita, $hora_visita);
					
					header("Location: ".$diretorio."index.php");
					exit;
				}
				else
					if (($acesso == "L") or ($acesso == "T") or ($acesso == "S") or ($acesso == "P"))			 
					{
						if ($acesso != "P")
						{
							$oUsers = new usuario_online;
							$oUsers->setUsuario(session_id(), Array("cod_usuario" => $cod_usuario, "nome_usuario" => $nome_usuario, "email" => $email_usuario, "cod_turma" => $cod_turma, "acesso" => $acesso));
						}
						
						//Dados Turma
						$turma = new turma();
						$turma->carregar($_SESSION["cod_turma"]);
						$cod_curso = $turma->getCodigoCurso();
						$cota_arquivos = $turma->getCotaArquivos();
						$upload_maximo = $turma->getUploadMaximo();
						$_SESSION["situacao_turma"] = $turma->getSituacao();
						
						$curso = new curso();
						$curso->carregar($cod_curso);
						
						$_SESSION["cod_curso"] = $cod_curso;
						$_SESSION["cod_instituicao"] = $curso->getCodigoInstituicao();
						$_SESSION["nome_curso"] = $curso->getNome();
						$_SESSION["nome_turma"] = $turma->getDescricao();
						
						$instituicao = new instituicao();
						$instituicao->carregar($_SESSION["cod_instituicao"]);
						$_SESSION["imagem_instituicao"] = $instituicao->getImagem();
						
						//Verifica Diretório de Arquivos
						$_SESSION["dir_arquivos"] = verificaDiretorio(_FILE_DIR);
						
						//Verifica Diretório da Instituição
						$_SESSION["dir_instituicao"] = verificaDiretorio(_FILE_DIR.$_SESSION["cod_instituicao"]."/"); 
						
						//Verifica Diretório de Imagens da Instituição
						$_SESSION["dir_imagens_instituicao"] = verificaDiretorio($_SESSION["dir_instituicao"]."imagens/");
						
						//Verifica Diretório da Instituição
						$_SESSION["dir_cursos_instituicao"] = verificaDiretorio($_SESSION["dir_instituicao"]."cursos/");
						
						//Verifica Diretório do Curso
						$_SESSION["dir_curso"] = verificaDiretorio($_SESSION["dir_cursos_instituicao"].$_SESSION["cod_curso"]."/");
						
						//Verifica Diretório de Imagens do Curso
						$_SESSION["dir_imagens_curso"] = verificaDiretorio($_SESSION["dir_curso"]."imagens/");
						
						//Verifica Diretório da Turma
						$_SESSION["dir_turma"] = verificaDiretorio($_SESSION["dir_curso"].$_SESSION["cod_turma"]."/");
						
						//Verifica Diretório de Documentos da Turma
						$_SESSION["dir_doc"] = verificaDiretorio($_SESSION["dir_turma"]."doc/"); 
						
						//Verifica Diretório de arquivos HTML da Turma
						$_SESSION["dir_html"] = verificaDiretorio($_SESSION["dir_turma"]."html/");
						
						//Verifica Diretório de arquivos PDF da Turma
						$_SESSION["dir_pdf"] = verificaDiretorio($_SESSION["dir_turma"]."pdf/");
						
						//Verifica Diretório de arquivos Power Point da Turma
						$_SESSION["dir_ppt"] = verificaDiretorio($_SESSION["dir_turma"]."ppt/");
						
						//Verifica Diretório de Atividades da Turma
						$_SESSION["dir_atividades"] = verificaDiretorio($_SESSION["dir_turma"]."atividades/");
						
						//Verifica Diretório de Perfil do Usuário em questão
						$_SESSION["dir_perfil"] = verificaDiretorio(_FILE_DIR_PERFIL);
						
						//Verifica Diretório de Perfil do Usuário em questão
						$_SESSION["dir_perfil_usuario"] = verificaDiretorio(_FILE_DIR_PERFIL.$_SESSION["cod_usuario"]."/");
						
						//Define a Cota de Arquivos da Turma
						$_SESSION["QUOTA"] = $cota_arquivos;
						
						//Define tamanho máximo para upload no Sistema
						$_SESSION["UPLOAD_MAXIMO"] = $upload_maximo;
						
						//Carregar Configurações do Usuário/Turma
						$configuracao = new config();
						$configuracao->carregar($_SESSION["cod_usuario"], $_SESSION["cod_turma"]);
						
						if ($configuracao->linhas > 0)
						{
							$_SESSION["cod_config"] = $configuracao->getCodigo();
							$turma_qtd_lst = $configuracao->getQtdLstTurma();
							if (!empty($turma_qtd_lst))
								$_SESSION["turma_qtd_lst"] = $configuracao->getQtdLstTurma();
							
							$turma_cat_lst = $configuracao->getCatLstTurma();
							if (!empty($turma_cat_lst))
								$_SESSION["turma_cat_lst"] = $configuracao->getCatLstTurma();
							
							$turma_ordem = $configuracao->getOrdenacaoTurma();
							if (!empty($turma_ordem))
								$_SESSION["turma_ordem"] = $configuracao->getOrdenacaoTurma();
							
							$edital_qtd_lst = $configuracao->getQtdLstEdital();
							if (!empty($edital_qtd_lst))
								$_SESSION["edital_qtd_lst"] = $configuracao->getQtdLstEdital();
								
							$edital_ordem = $configuracao->getOrdenacaoEdital();
							if (!empty($edital_ordem))
								$_SESSION["edital_ordem"] = $configuracao->getOrdenacaoEdital();
							
							$agenda_qtd_lst = $configuracao->getQtdLstAgenda();
							if (!empty($agenda_qtd_lst))
								$_SESSION["agenda_qtd_lst"] = $configuracao->getQtdLstAgenda();
							
							$agenda_ordem = $configuracao->getOrdenacaoAgenda();
							if (!empty($agenda_ordem))
								$_SESSION["agenda_ordem"] = $configuracao->getOrdenacaoAgenda();
							
							$recado_qtd_lst = $configuracao->getQtdLstRecado();
							if (!empty($recado_qtd_lst))
								$_SESSION["recado_qtd_lst"] = $configuracao->getQtdLstRecado();
							
							$recado_ordem = $configuracao->getOrdenacaoRecado();
							if (!empty($recado_ordem))
								$_SESSION["recado_ordem"] = $configuracao->getOrdenacaoRecado();
							
							$conteudo_qtd_lst = $configuracao->getQtdLstConteudo();
							if (!empty($conteudo_qtd_lst))
								$_SESSION["conteudo_qtd_lst"] = $configuracao->getQtdLstConteudo();
							
							$conteudo_ordem = $configuracao->getOrdenacaoConteudo();
							if (!empty($conteudo_ordem))
								$_SESSION["conteudo_ordem"] = $configuracao->getOrdenacaoConteudo();
							
							$atividade_qtd_lst = $configuracao->getQtdLstAtividade();
							if (!empty($atividade_qtd_lst))
								$_SESSION["atividade_qtd_lst"] = $configuracao->getQtdLstAtividade();
								
							$atividade_ordem = $configuracao->getOrdenacaoAtividade();
							if (!empty($atividade_ordem))
								$_SESSION["atividade_ordem"] = $configuracao->getOrdenacaoAtividade();
							
							$forum_qtd_lst = $configuracao->getQtdLstForum();
							if (!empty($forum_qtd_lst))
								$_SESSION["forum_qtd_lst"] = $configuracao->getQtdLstForum();
							
							$forum_ordem = $configuracao->getOrdenacaoForum();
							if (!empty($forum_ordem))
								$_SESSION["forum_ordem"] = $configuracao->getOrdenacaoForum();
							
							$bate_papo_qtd_lst = $configuracao->getQtdLstBatePapo();
							if (!empty($bate_papo_qtd_lst))
								$_SESSION["bate_papo_qtd_lst"] = $configuracao->getQtdLstBatePapo();
							
							$bate_papo_ordem = $configuracao->getOrdenacaoBatePapo();
							if (!empty($bate_papo_ordem))
								$_SESSION["bate_papo_ordem"] = $configuracao->getOrdenacaoBatePapo();
						}
						
						$visitas = ++$total_visitas;
						$data_visita = date("Y-m-d");
						$hora_visita = date("H:i:s");
						$usuario->atualizaVisitaTurma($_SESSION["cod_usuario"], $cod_turma, $visitas, $data_visita, $hora_visita);
						
						logSistema($cod_usuario, $cod_turma, "Acessou a Tela Inicial", session_id(), $data_log, $hora_log);
						
						header("Location: ".$diretorio."index.php");
						exit;
					}
					else
					{
						header("Location: index.php");
						exit;
					}
		}
	}
	else
	{
		header("Location: index.php");
		exit;
	}
}
else
{
	header("Location: index.php");
	exit;
}
?>