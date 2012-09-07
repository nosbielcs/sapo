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

class config extends consulta
{
	//Campos
	var $cod_config;
	var $cod_usuario;
	var $cod_turma;
	var $turma_lst_qtd;
	var $turma_lst_cat;
	var $turma_ordem;
	var $edital_lst_qtd;
	var $edital_ordem;
	var $agenda_lst_qtd;
	var $agenda_ordem;
	var $recado_lst_qtd;
	var $recado_ordem;
	var $conteudo_lst_cat;
	var $conteudo_ordem;
	var $atividade_lst_qtd;
	var $atividade_ordem;
	var $forum_lst_qtd;
	var $forum_ordem;
	var $bate_papo_lst_qtd;
	var $bate_papo_ordem;
	
	//Construtor
	function config()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_config;
	}
	
	function setCodigo($cod_config)
	{
		$this->cod_config = $cod_config;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getCodigoTurma()
	{
		return $this->cod_turma;
	}
	
	function setCodigoTurma($cod_turma)
	{
	 	$this->cod_turma = $cod_turma;
	}
	
	function getQtdLstTurma()
	{
	  	return $this->turma_lst_qtd;
	}
	
	function setQtdLstTurma($turma_lst_qtd)
	{
		$this->turma_lst_qtd = $turma_lst_qtd;
	}
	
	function getCatLstTurma()
	{
	  	return $this->turma_lst_cat;
	}
	
	function setCatLstTurma($turma_lst_cat)
	{
	  	$this->turma_lst_cat = $turma_lst_cat;
	}
	
	function getOrdenacaoTurma()
	{
	  	return $this->turma_ordem;
	}
	
	function setOrdenacaoTurma($turma_ordem)
	{
	  	$this->turma_ordem = $turma_ordem;
	}
	
	function getQtdLstEdital()
	{
	  	return $this->edital_lst_qtd;
	}
	
	function setQtdLstEdital($edital_lst_qtd)
	{
	  	$this->edital_lst_qtd = $edital_lst_qtd;
	}
	
	function getOrdenacaoEdital()
	{
	  	return $this->edital_ordem;
	}
	
	function setOrdenacaoEdital($edital_ordem)
	{
	  	$this->edital_ordem = $edital_ordem;
	}
	
	function getQtdLstAgenda()
	{
	  	return $this->agenda_lst_qtd;
	}
	
	function setQtdLstAgenda($agenda_lst_qtd)
	{
	  	$this->agenda_lst_qtd = $agenda_lst_qtd;
	}
	
	function getOrdenacaoAgenda()
	{
	  	return $this->agenda_ordem;
	}
	
	function setOrdenacaoAgenda($agenda_ordem)
	{
	  	$this->agenda_ordem = $agenda_ordem;
	}
	
	function getQtdLstRecado()
	{
	  	return $this->recado_lst_qtd;
	}
	
	function setQtdLstRecado($recado_lst_qtd)
	{
	  	$this->recado_lst_qtd = $recado_lst_qtd;
	}
	
	function getOrdenacaoRecado()
	{
	  	return $this->recado_ordem;
	}
	
	function setOrdenacaoRecado($recado_ordem)
	{
	  	$this->recado_ordem = $recado_ordem;
	}
	
	function getQtdLstConteudo()
	{
	  	return $this->conteudo_lst_qtd;
	}
	
	function setQtdLstConteudo($conteudo_lst_qtd)
	{
	  	$this->conteudo_lst_qtd = $conteudo_lst_qtd;
	}
	
	function getOrdenacaoConteudo()
	{
	  	return $this->conteudo_ordem;
	}
	
	function setOrdenacaoConteudo($conteudo_ordem)
	{
	  	$this->conteudo_ordem = $conteudo_ordem;
	}
	
	function getQtdLstAtividade()
	{
	  	return $this->atividade_lst_qtd;
	}
	
	function setQtdLstAtividade($atividade_lst_qtd)
	{
	  	$this->atividade_lst_qtd = $atividade_lst_qtd;
	}
	
	function getOrdenacaoAtividade()
	{
	  	return $this->atividade_ordem;
	}
	
	function setOrdenacaoAtividade($atividade_ordem)
	{
	  	$this->atividade_ordem = $atividade_ordem;
	}
	
	function getQtdLstForum()
	{
	  	return $this->forum_lst_qtd;
	}
	
	function setQtdLstForum($forum_lst_qtd)
	{
	  	$this->forum_lst_qtd = $forum_lst_qtd;
	}
	
	function getOrdenacaoForum()
	{
	  	return $this->forum_ordem;
	}
	
	function setOrdenacaoForum($forum_ordem)
	{
	  	$this->forum_ordem = $forum_ordem;
	}
	
	function getQtdLstBatePapo()
	{
	  	return $this->bate_papo_lst_qtd;
	}
	
	function setQtdLstBatePapo($bate_papo_lst_qtd)
	{
	  	$this->bate_papo_lst_qtd = $bate_papo_lst_qtd;
	}
	
	function getOrdenacaoBatePapo()
	{
	  	return $this->bate_papo_ordem;
	}
	
	function setOrdenacaoBatePapo($bate_papo_ordem)
	{
	  	$this->bate_papo_ordem = $bate_papo_ordem;
	}
		
	function carregar($cod_usuario, $cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_config, ".
			   "   cod_usuario, ".
			   "   cod_turma, ".
			   "   turma_lst_qtd, ".
			   "   turma_lst_cat, ".
			   "   turma_ordem, ".
			   "   edital_lst_qtd, ".
			   "   edital_ordem, ".
			   "   agenda_lst_qtd, ".
			   "   agenda_ordem, ".
			   "   recado_lst_qtd, ".
			   "   recado_ordem, ".
			   "   conteudo_lst_qtd, ".
			   "   conteudo_ordem, ".
			   "   atividade_lst_qtd, ".
			   "   atividade_ordem, ".
			   "   forum_lst_qtd, ".
			   "   forum_ordem, ".
			   "   bate_papo_lst_qtd, ".
			   "   bate_papo_ordem ".
			   " FROM ".
			   "   usuario_turma_config ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma;

		$this->executar($sql);
		
		$this->cod_config = $this->data["cod_config"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->turma_lst_qtd = $this->data["turma_lst_qtd"];
		$this->turma_lst_cat = $this->data["turma_lst_cat"];
		$this->turma_ordem = $this->data["turma_ordem"];
		$this->edital_lst_qtd = $this->data["edital_lst_qtd"];
		$this->edital_ordem = $this->data["edital_ordem"];
		$this->agenda_lst_qtd = $this->data["agenda_lst_qtd"];
		$this->agenda_ordem = $this->data["agenda_ordem"];
		$this->recado_lst_qtd = $this->data["recado_lst_qtd"];
		$this->recado_ordem = $this->data["recado_ordem"];
		$this->conteudo_lst_qtd = $this->data["conteudo_lst_qtd"];
		$this->conteudo_ordem = $this->data["conteudo_ordem"];
		$this->atividade_lst_qtd = $this->data["atividade_lst_qtd"];
		$this->atividade_ordem = $this->data["atividade_ordem"];
		$this->forum_lst_qtd = $this->data["forum_lst_qtd"];
		$this->forum_ordem = $this->data["forum_ordem"];
		$this->bate_papo_lst_qtd = $this->data["bate_papo_lst_qtd"];
		$this->bate_papo_ordem = $this->data["bate_papo_ordem"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO usuario_turma_config (".
			   "   cod_usuario, ".
			   "   cod_turma, ".
			   "   turma_lst_qtd, ".
			   "   turma_lst_cat,".
			   "   turma_ordem, ".
			   "   edital_lst_qtd, ".
			   "   edital_ordem, ".
			   "   agenda_lst_qtd, ".
			   "   agenda_ordem, ".
			   "   recado_lst_qtd, ".
			   "   recado_ordem, ".
			   "   conteudo_lst_qtd,".
			   "   conteudo_ordem, ".
			   "   atividade_lst_qtd, ".
			   "   atividade_ordem, ".
			   "   forum_lst_qtd, ".
			   "   forum_ordem, ".
			   "   bate_papo_lst_qtd, ".
			   "   bate_papo_ordem ".
			   " ) VALUES (".
			   $this->cod_usuario.", ".
			   $this->cod_turma.", '".
			   $this->turma_lst_qtd."', '".
			   $this->turma_lst_cat."', '".
			   $this->turma_ordem."', '".
			   $this->edital_lst_qtd."', '".
			   $this->edital_ordem."', '".
			   $this->agenda_lst_qtd."', '".
			   $this->agenda_ordem."', '".
			   $this->recado_lst_qtd."', '".
			   $this->recado_ordem."', '".
			   $this->conteudo_lst_qtd."', '".
			   $this->conteudo_ordem."', '".
			   $this->atividade_lst_qtd."', '".
			   $this->atividade_ordem."', '".
			   $this->forum_lst_qtd."', '".
			   $this->forum_ordem."', '".
			   $this->bate_papo_lst_qtd."', '".
			   $this->bate_papo_ordem."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_config)
	{
		$sql = " UPDATE ".
			   "   usuario_turma_config ".
			   " SET ".
			   "   turma_lst_qtd = '".$this->turma_lst_qtd."', ".
			   "   turma_lst_cat = '".$this->turma_lst_cat."', ".
			   "   turma_ordem = '".$this->turma_ordem."', ".
			   "   edital_lst_qtd = '".$this->edital_lst_qtd."', ".
			   "   edital_ordem = '".$this->edital_ordem."', ".
			   "   agenda_lst_qtd = '".$this->agenda_lst_qtd."', ".
			   "   agenda_ordem = '".$this->agenda_ordem."', ".
			   "   recado_lst_qtd = '".$this->recado_lst_qtd."', ".
			   "   recado_ordem = '".$this->recado_ordem."', ".			   
			   "   conteudo_lst_qtd = '".$this->conteudo_lst_qtd."', ".
			   "   conteudo_ordem = '".$this->conteudo_ordem."', ".
			   "   atividade_lst_qtd = '".$this->atividade_lst_qtd."', ".
			   "   atividade_ordem = '".$this->atividade_ordem."', ".
			   "   forum_lst_qtd = '".$this->forum_lst_qtd."', ".
			   "   forum_ordem = '".$this->forum_ordem."', ".
			   "   bate_papo_lst_qtd = '".$this->bate_papo_lst_qtd."', ".
			   "   bate_papo_ordem = '".$this->bate_papo_ordem."' ".
			   " WHERE ".
			   "   cod_config = ".$cod_config;

		$this->insere($sql);
	}
	
	function excluir($cod_config, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   usuario_turma_config ".
			   " WHERE ".
			   "   cod_config = ".$cod_config;
		
		$this->insere($sql);
	}
}
?>