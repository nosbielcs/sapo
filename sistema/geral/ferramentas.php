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

if (($modulo == "inicial") or ($modulo == "minha_turma") or ($modulo == "perfil_usuario"))
	include("../../config/session.lib.php");
else
	include("../../../config/session.lib.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$nome_turma = $_SESSION["nome_turma"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$tipo_acesso = $_SESSION["tipo_acesso"];

if ($_SESSION["acesso"] == "L")
	$acesso = "Aluno";
else
	if ($_SESSION["acesso"] == "T")
		$acesso = "Tutor";
	else
		if ($_SESSION["acesso"] == "S")
			$acesso = "Suporte Técnico";
		else
			if ($_SESSION["acesso"] == "P")
				$acesso = "Supervisor do Sistema";

switch($modulo)
{
	case "inicial":
		$dir_imagens = "../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', 'index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../geral/minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', 'edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', 'agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', 'conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', 'atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', 'forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', 'bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../geral/index.php');\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../login/logout.php'\"";
		$link_listagem = "../geral/listagem.php";
	break;
	
	case "perfil":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', 'index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../../".$tipo_acesso."/bate_papo/index.php');\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../listagem.php";
	break;
	
	case "config":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../perfil/index.php')\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../../".$tipo_acesso."/bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../../".$tipo_acesso."/enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: window.location.href = 'index.php'\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../listagem.php";
	break;
	
	case "minha_turma":
		$dir_imagens = "../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', 'minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', 'perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', 'recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividade', '../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../".$tipo_acesso."/bate_papo/index.php')\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../".$tipo_acesso."/enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', 'config/index.php')\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "listagem.php";
	break;
	
	case "perfil_usuario":
		$dir_imagens = "../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: window.location.href = 'minha_turma.php'\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', 'perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', 'recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividade', '../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../".$tipo_acesso."/bate_papo/index.php')\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../".$tipo_acesso."/enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', 'config/index.php')\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "listagem.php";
	break;
	
	case "recados":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../perfil/index.php')\"";
		$link_recados = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../../".$tipo_acesso."/bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../../".$tipo_acesso."/enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../listagem.php";
	break;
	
	case "edital":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../../geral/listagem.php";
	break;
	
	case "agenda":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php')\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', 'index.php')\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../../geral/listagem.php";
	break;
	
	case "conteudo":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php')\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', 'index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$link_listagem = "../../geral/listagem.php";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
	break;
	
	case "atividades":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php')\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../../geral/listagem.php";
	break;
	
	case "forum":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', 'index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../../geral/listagem.php";
	break;
	
	case "bate_papo":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../../geral/minha_turma.php')\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../../geral/perfil/index.php');\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../../geral/recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', 'index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../enquete/index.php'\""; 
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: registraLog('Acessou o Módulo Configurações', '../../geral/config/index.php');\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../../geral/listagem.php";
	break;
	//
	case "enquete":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: registraLog('Acessou a Tela Inicial', '../../".$tipo_acesso."/index.php');\"";
		$link_minha_turma = "onClick=\"JavaScript: registraLog('Acessou o Módulo Minha Turma', '../minha_turma.php');\"";
		$link_perfil = "onClick=\"JavaScript: registraLog('Acessou o Módulo Perfil', '../perfil/index.php')\"";
		$link_recados = "onClick=\"JavaScript: registraLog('Acessou o Módulo Recados', '../recados/index.php');\"";
		$link_edital = "onClick=\"JavaScript: registraLog('Acessou o Módulo Edital', '../../".$tipo_acesso."/edital/index.php');\"";
		$link_agenda = "onClick=\"JavaScript: registraLog('Acessou o Módulo Agenda', '../../".$tipo_acesso."/agenda/index.php');\"";
		$link_conteudo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Conteúdo', '../../".$tipo_acesso."/conteudo/index.php');\"";
		$link_atividades = "onClick=\"JavaScript: registraLog('Acessou o Módulo Atividades', '../../".$tipo_acesso."/atividade/index.php');\"";
		$link_forum = "onClick=\"JavaScript: registraLog('Acessou o Módulo Fórum', '../../".$tipo_acesso."/forum/index.php');\"";
		$link_bate_papo = "onClick=\"JavaScript: registraLog('Acessou o Módulo Bate Papo', '../../".$tipo_acesso."/bate_papo/index.php');\"";
		$link_enquete = "onClick=\"JavaScript: window.location.href = '../../".$tipo_acesso."/enquete/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
		$config = "<a onClick=\"JavaScript: window.location.href = 'index.php'\" onMouseOver=\"JavaScript: window.status = 'Configurações';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_vermelho\">Configurações</a>";
		$link_listagem = "../listagem.php";
	break;
	//
}
?>
  <td id="td_menu_esquerdo" width="230" valign="top">
	<div id="menu_esquerdo">	  
	<table width="230" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="1" colspan="3" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
	  </tr>
	  <tr>
		<td width="155"><img src="<?php echo $dir_imagens; ?>cantof1.gif" width="155" height="30" border="0"></td>
		<td width="74" background="<?php echo $dir_imagens; ?>cantof5.gif" align="right"><a onClick="JavaScript: abaFerramentaParticipantes('ferramentas', '<?php echo $dir_imagens; ?>');" style="cursor: pointer"><img id="imagem_ferramentas" name="minimizar" title="Minimizar Ferramentas" src="<?php echo $dir_imagens; ?>outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
		<td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" width="1"></td>
	  </tr>
	  <tr>
		<td colspan="3">
				<table width="228" border="0" cellpadding="0" cellspacing="0">
				  <tr>
				    <td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
				    <td width="228" background="<?php echo $dir_imagens; ?>cantof2.gif">
					  <div id="ferramentas">
					  <table width="228" border="0" cellspacing="0" cellpadding="0">
					    <tr>
						  <td width="76" height="60" align="center"><a <?php echo $link_inicial; ?> onMouseOver="JavaScript: window.status = 'Página Inicial';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/inicial.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_perfil; ?> onMouseOver="JavaScript: window.status = 'Perfil';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/perfil.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_minha_turma; ?> onMouseOver="JavaScript: window.status = 'Minha Turma';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/turma.gif" width="70" height="60" border="0"></a></td>
					    </tr>
					    <tr>
						  <td width="76" height="60" align="center"><a <?php echo $link_edital; ?> onMouseOver="JavaScript: window.status = 'Edital';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/edital.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_agenda; ?> onMouseOver="JavaScript: window.status = 'Agenda';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/agenda.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_recados; ?> onMouseOver="JavaScript: window.status = 'Recados';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/recados.gif" width="70" height="60" border="0"></a></td>
					    </tr>
					    <tr>
						  <td width="76" height="60" align="center"><a <?php echo $link_conteudo; ?> onMouseOver="JavaScript: window.status = 'Conteúdo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/conteudo.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_atividades; ?> onMouseOver="JavaScript: window.status = 'Atividades';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/atividades.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_forum; ?> onMouseOver="JavaScript: window.status = 'Fórum';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';"  style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/forum.gif" width="70" height="60" border="0"></a></td>
					    </tr>
					    <tr>
						  <td width="76" height="60" align="center"><a <?php echo $link_bate_papo; ?> onMouseOver="JavaScript: window.status = 'Bate Papo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/batepapo.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_cursos; ?> onMouseOver="JavaScript: window.status = 'Meus Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/cursos.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_sair; ?> onMouseOver="JavaScript: window.status = 'Sair';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/sair.gif" width="70" height="60" border="0"></a></td>
					    </tr>
						<?php
							if ($tipo_acesso == "tutor")
							{
						?>
						<!--<tr>
						  <td width="76" height="60" align="center"><a <?php echo $link_enquete; ?> onMouseOver="JavaScript: window.status = 'Enquete';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/batepapo.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_cursos; ?> onMouseOver="JavaScript: window.status = 'Meus Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/cursos.gif" width="70" height="60" border="0"></a></td>
						  <td width="76" height="60" align="center"><a <?php echo $link_sair; ?> onMouseOver="JavaScript: window.status = 'Sair';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/sair.gif" width="70" height="60" border="0"></a></td>
					    </tr>-->
						<?php
							}
						?>
					  </table> 
					  </div> 
				    </td>
				    <td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" width="1"></td>
				  </tr>
				  <tr>
				    <td height="1" colspan="3" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
				  </tr>
		    <tr>
			  <td colspan="2" height="15"></td>
		    </tr>
		    <?php
		  	  if ($modulo == "inicial")
			  {
		    ?>
		    <tr>
			  <td colspan="2"><?php include("../geral/participantes.php"); ?></td>
		    </tr>
		    <?php
		  	  }
		    ?>
			<tr>
			  <td colspan="2">
			  <?php
				if ($modulo != "inicial")
				{
			  ?>
			  <table cellpadding="0" cellspacing="0" align="center">
				<tr>
				  <td height="15" colspan="3"></td>
				</tr>
				<tr>
				  <td class="preto" width="50" align="right" valign="top">Usuário:</td>
				  <td width="5"></td>
				  <td class="vermelho"><?php echo $nome_usuario; ?></td>
				</tr>
				<tr>
				  <td class="preto" align="right" valign="top">Acesso:</td>
				  <td width="5"></td>
				  <td class="vermelho"><?php  echo $acesso; ?></td>
				</tr>
				<tr>
				  <td class="preto" width="50" align="right" valign="top">Curso:</td>
				  <td width="5"></td>
				  <td class="vermelho"><?php echo $nome_turma; ?></td>
				</tr>
				<tr>
				  <td height="15" colspan="3"></td>
				</tr>
				<tr>
				  <td class="preto" width="50" align="right" valign="top"></td>
				  <td width="5"></td>
				  <td><?php echo $config; ?></td>
				</tr>
			  </table>
			  <?php
				}
			  ?>
			  </td>
			</tr>
		  </table>
		</td>
	  </tr>
	</table>
	</div>
	<div id="menu_esquerdo_escondido" style="display: none">
	<table width="40" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="20">	           
		  <table width="100%" height="100" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td><img src="<?php echo $dir_imagens; ?>login_instituicao.gif" width="34" height="200" onClick="JavaScript: abas('menu_esquerdo_escondido');"></td>
			</tr>
		  </table>
		</td>
	  </tr>
	</table>
	</div>
  </td>