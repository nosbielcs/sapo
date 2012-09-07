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

class suporte extends consulta
{
	//Campos
	var $cod_suporte;
	var $cod_inst;
	var $assunto;
	var $descricao;
	var $depto;
	var $prioridade;
	var $feedback;
	var $data_suporte;
	var $hora;
	var $situacao;
	
	//Construtor
	function suporte()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_suporte;
	}
	
	function setCodigo($cod_suporte)
	{
		$this->cod_suporte = $cod_suporte;
	}
	
	function getCodigoInstituicao()
	{
		return $this->cod_inst;
	}
	
	function setCodigoInstituicao($cod_inst)
	{
	 	$this->cod_inst = $cod_inst;
	}
	
	function getAssunto()
	{
	  	return $this->assunto;
	}
	
	function setAssunto($assunto)
	{
	  	$this->assunto = $assunto;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function getDepartamento()
	{
	  	return $this->depto;
	}
	
	function setDepartamento($depto)
	{
	  	$this->depto = $depto;
	}
	
	function getPrioridade()
	{
	  	return $this->prioridade;
	}
	
	function setPrioridade($prioridade)
	{
	  	$this->prioridade = $prioridade;
	}
	
	function getFeedback()
	{
	  	return $this->feedback;
	}
	
	function setFeedback($feedback)
	{
	  	$this->feedback = $feedback;
	}
	
	function getDataSAC()
	{
	  	return $this->data_suporte;
	}
	
	function setDataSAC($data_suporte)
	{
	  	$this->data_suporte = $data_suporte;
	}
	
	function getHoraSAC()
	{
	  	return $this->hora;
	}
	
	function setHoraSAC($hora)
	{
	  	$this->hora = $hora;
	}
	
	function getSituacao()
	{
	  	return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
	  	$this->situacao = $situacao;
	}
	
	function carregar($cod_suporte)
	{
		$sql = " SELECT ".
			   "   cod_suporte, ".
			   "   cod_inst, ".
			   "   assunto, ".
			   "   descricao, ".
			   "   depto, ".
			   "   prioridade, ".
			   "   feedback, ".
			   "   data_suporte, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   suporte ".
			   " WHERE ".
			   "   cod_suporte = ".$cod_suporte;
		
		$this->executar($sql);
		
		$this->cod_suporte = $this->data["cod_suporte"];
		$this->cod_inst = $this->data["cod_inst"];
		$this->assunto = $this->data["assunto"];
		$this->descricao = $this->data["descricao"];
		$this->depto = $this->data["depto"];
		$this->prioridade = $this->data["prioridade"];
		$this->feedback = $this->data["feedback"];
		$this->data_suporte = $this->data["data_suporte"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO suporte (".
			   "   cod_inst, ".
			   "   assunto,".
			   "   descricao, ".
			   "   depto, ".
			   "   prioridade, ".
			   "   feedback, ".
			   "   data_suporte, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_inst.", '".
			   $this->assunto."', '".
			   $this->descricao."', '".
			   $this->depto."', '".
			   $this->prioridade."', '".
			   $this->feedback."', '".
			   $this->data_suporte."', '".
			   $this->hora."', '".
			   $this->situacao."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_suporte)
	{
		$sql = " UPDATE ".
			   "   suporte ".
			   " SET ".
			   "   assunto = '".$this->assunto."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   depto = '".$this->depto."', ".
			   "   prioridade = '".$this->prioridade."', ".
			   "   situacao = '".$this->situacao."', ".
			   "   feedback = '".$this->feedback."' ".
			   " WHERE ".
			   "   cod_suporte = ".$cod_suporte;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_suporte)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   suporte ".
			   " WHERE ".
			   "   cod_suporte = ".$cod_suporte.
			   " AND ".
			   "   cod_inst = ".$cod_inst;
		
		$this->insere($sql);
	}
		
	function colecao($cod_inst, $situacao)
	{
		$sql = " SELECT ".
			   "   cod_suporte, ".
			   "   cod_inst ".
			   " FROM ".
			   "   suporte ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst.
			   " AND ".
			   "   situacao = '".$situacao."' ".
			   " ORDER BY ".
			   "   cod_suporte ASC ";
		
		$this->executar($sql);
	}
	
	function paginacao($cod_inst, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_suporte, ".
			   "   cod_inst ".
			   " FROM ". 
			   "   suporte ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst;
			   
		if ($ordem == 1)
			$sql.= " ORDER BY data ASC, hora ASC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY data DESC, hora DESC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY assunto ASC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY assunto DESC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY prioridade ASC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY prioridade DESC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY situacao ASC";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY situacao DESC";
		
		if ($limite != 0)
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
}
?>