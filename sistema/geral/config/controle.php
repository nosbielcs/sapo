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
include("../../../classes/configuracao.php");
include("../../../classes/usuario.php");

//Registra Variáveis que vieram do Formulário
$acao_config = $_POST["acao_config"];
$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];

if (!empty($acao_config))
{
	$turma_qtd_lst = $_POST["turma_qtd_lst"];
	$turma_cat_lst = $_POST["turma_cat_lst"];
	$turma_ordem = $_POST["turma_ordem"];
	$edital_qtd_lst = $_POST["edital_qtd_lst"];
	$edital_ordem = $_POST["edital_ordem"];
	$agenda_qtd_lst = $_POST["agenda_qtd_lst"];
	$agenda_ordem = $_POST["agenda_ordem"];
	$recado_qtd_lst = $_POST["recado_qtd_lst"];
	$recado_ordem = $_POST["recado_ordem"];
	$conteudo_qtd_lst = $_POST["conteudo_qtd_lst"];
	$conteudo_ordem = $_POST["conteudo_ordem"];
	$atividade_qtd_lst = $_POST["atividade_qtd_lst"];
	$atividade_ordem = $_POST["atividade_ordem"];
	$forum_qtd_lst = $_POST["forum_qtd_lst"];
	$forum_ordem = $_POST["forum_ordem"];
	$bate_papo_qtd_lst = $_POST["bate_papo_qtd_lst"];
	$bate_papo_ordem = $_POST["bate_papo_ordem"];
	
	$configuracao = new config();
	$configuracao->carregar($cod_usuario, $cod_turma);
	$cod_config = $configuracao->getCodigo();
	$configuracao->setQtdLstTurma($turma_qtd_lst);
	$configuracao->setCatLstTurma($turma_cat_lst);
	$configuracao->setOrdenacaoTurma($turma_ordem);
	$configuracao->setQtdLstEdital($edital_qtd_lst);
	$configuracao->setOrdenacaoEdital($edital_ordem);
	$configuracao->setQtdLstAgenda($agenda_qtd_lst);
	$configuracao->setOrdenacaoAgenda($agenda_ordem);
	$configuracao->setQtdLstRecado($recado_qtd_lst);
	$configuracao->setOrdenacaoRecado($recado_ordem);
	$configuracao->setQtdLstConteudo($conteudo_qtd_lst);
	$configuracao->setOrdenacaoConteudo($conteudo_ordem);
	$configuracao->setQtdLstAtividade($atividade_qtd_lst);
	$configuracao->setOrdenacaoAtividade($atividade_ordem);
	$configuracao->setQtdLstForum($forum_qtd_lst);
	$configuracao->setOrdenacaoForum($forum_ordem);
	$configuracao->setQtdLstBatePapo($bate_papo_qtd_lst);
	$configuracao->setOrdenacaoBatePapo($bate_papo_ordem);

	if (!empty($cod_config))
		$configuracao->alterar($cod_config);
	else
	{
		$configuracao->setCodigoUsuario($cod_usuario);
		$configuracao->setCodigoturma($cod_turma);
		$configuracao->inserir();
	}
	
	$_SESSION["mensagem_config"] = "Alterações realizadas com Sucesso!";
	if (!empty($turma_qtd_lst))
		$_SESSION["turma_qtd_lst"] = $turma_qtd_lst;
	else
		if (isset($_SESSION["turma_qtd_lst"]))
			unset($_SESSION["turma_qtd_lst"]);
	
	if (!empty($turma_cat_lst))
		$_SESSION["turma_cat_lst"] = $turma_cat_lst;
	else
		if (isset($_SESSION["turma_cat_lst"]))
			unset($_SESSION["turma_cat_lst"]);
	
	if (!empty($turma_ordem))
		$_SESSION["turma_ordem"] = $turma_ordem;
	else
		if (isset($_SESSION["turma_ordem"]))
			unset($_SESSION["turma_ordem"]);
		
	if (!empty($edital_qtd_lst))
		$_SESSION["edital_qtd_lst"] = $edital_qtd_lst;
	else
		if (isset($_SESSION["edital_qtd_lst"]))
			unset($_SESSION["edital_qtd_lst"]);
		
	if (!empty($edital_ordem))
		$_SESSION["edital_ordem"] = $edital_ordem;
	else
		if (isset($_SESSION["edital_ordem"]))
			unset($_SESSION["edital_ordem"]);
	
	if (!empty($agenda_qtd_lst))
		$_SESSION["agenda_qtd_lst"] = $agenda_qtd_lst;
	else
		if (isset($_SESSION["agenda_qtd_lst"]))
			unset($_SESSION["agenda_qtd_lst"]);
	
	if (!empty($agenda_ordem))
		$_SESSION["agenda_ordem"] = $agenda_ordem;
	else
		if (isset($_SESSION["agenda_ordem"]))
			unset($_SESSION["agenda_ordem"]);
	
	if (!empty($recado_qtd_lst))
		$_SESSION["recado_qtd_lst"] = $recado_qtd_lst;
	else
		if (isset($_SESSION["recado_qtd_lst"]))
			unset($_SESSION["recado_qtd_lst"]);
	
	if (!empty($recado_ordem))
		$_SESSION["recado_ordem"] = $recado_ordem;
	else
		if (isset($_SESSION["recado_ordem"]))
			unset($_SESSION["recado_ordem"]);
	
	if (!empty($conteudo_qtd_lst))
		$_SESSION["conteudo_qtd_lst"] = $conteudo_qtd_lst;
	else
		if (isset($_SESSION["conteudo_qtd_lst"]))
			unset($_SESSION["conteudo_qtd_lst"]);
	
	if (!empty($conteudo_ordem))
		$_SESSION["conteudo_ordem"] = $conteudo_ordem;
	else
		if (isset($_SESSION["conteudo_ordem"]))
			unset($_SESSION["conteudo_ordem"]);
		
	if (!empty($atividade_qtd_lst))
		$_SESSION["atividade_qtd_lst"] = $atividade_qtd_lst;
	else
		if (isset($_SESSION["atividade_qtd_lst"]))
			unset($_SESSION["atividade_qtd_lst"]);
	
	if (!empty($atividade_ordem))
		$_SESSION["atividade_ordem"] = $atividade_ordem;
	else
		if (isset($_SESSION["atividade_ordem"]))
			unset($_SESSION["atividade_ordem"]);
	
	if (!empty($forum_qtd_lst))
		$_SESSION["forum_qtd_lst"] = $forum_qtd_lst;
	else
		if (isset($_SESSION["forum_qtd_lst"]))
			unset($_SESSION["forum_qtd_lst"]);
	
	if (!empty($forum_ordem))
		$_SESSION["forum_ordem"] = $forum_ordem;
	else
		if (isset($_SESSION["forum_ordem"]))
			unset($_SESSION["forum_ordem"]);
	
	if (!empty($bate_papo_qtd_lst))
		$_SESSION["bate_papo_qtd_lst"] = $bate_papo_qtd_lst;
	else
		if (isset($_SESSION["bate_papo_qtd_lst"]))
			unset($_SESSION["bate_papo_qtd_lst"]);
	
	if (!empty($bate_papo_ordem))
		$_SESSION["bate_papo_ordem"] = $bate_papo_ordem;
	else
		if (isset($_SESSION["bate_papo_ordem"]))
			unset($_SESSION["bate_papo_ordem"]);
}

header("Location: index.php");
exit;
?>