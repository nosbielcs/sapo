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

class atividade extends consulta
{
	//Campos
	var $cod_atividade;
	var $cod_turma;
	var $cod_usuario;
	var $atividade;
	var $descricao;
	var $valor;
	var $data_atividade;
	var $hora_atividade;
	var $data_entrega;
	var $hora_entrega;
	
	//Construtor
	function atividade()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_atividade;
	}
	
	function setCodigo($codigo)
	{
		$this->cod_atividade = $codigo;
	}
	
	function getCodigoTurma()
	{
		return $this->cod_turma;
	}
	
	function setCodigoTurma($codigo)
	{
	 	$this->cod_turma = $codigo;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getAtividade()
	{
	  	return $this->atividade;
	}
	
	function setAtividade($atividade)
	{
	  	$this->atividade = $atividade;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function setValor($valor)
	{
	  	$this->valor = $valor;
	}
	
	function getValor()
	{
	  	return $this->valor;
	}
	
	function getAnexo()
	{
	  	return $this->anexo;
	}
	
	function getDataAtividade()
	{
	  	return $this->data_atividade;
	}
	
	function setDataAtividade($data_atividade)
	{
	  	$this->data_atividade = $data_atividade;
	}
	
	function getHoraAtividade()
	{
	  	return $this->hora_atividade;
	}
	
	function setHoraAtividade($hora_atividade)
	{
	  	$this->hora_atividade = $hora_atividade;
	}	
	
	function getDataEntrega()
	{
	  	return $this->data_entrega;
	}
	
	function setDataEntrega($data_entrega)
	{
	  	$this->data_entrega = $data_entrega;
	}
	
	function getHoraEntrega()
	{
	  	return $this->hora_entrega;
	}
	
	function setHoraEntrega($hora_entrega)
	{
	  	$this->hora_entrega = $hora_entrega;
	}
	
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   atividade, ".
			   "   descricao, ".
			   "   valor, ".
			   "   data_atividade, ".
			   "   hora_atividade, ".
			   "   data_entrega, ".
			   "   hora_entrega ".
			   " FROM ".
			   "   atividade ".
			   " WHERE ".
			   "   cod_atividade = ".$codigo;
		
		$this->executar($sql);
		
		$this->cod_atividade = $this->data["cod_atividade"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->atividade = $this->data["atividade"];
		$this->descricao = $this->data["descricao"];
		$this->valor = $this->data["valor"];
		$this->data_atividade = $this->data["data_atividade"];
		$this->hora_atividade = $this->data["hora_atividade"];
		$this->data_entrega = $this->data["data_entrega"];
		$this->hora_entrega = $this->data["hora_entrega"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO atividade (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   atividade,".
			   "   descricao, ".
			   "   valor, ".
			   "   data_atividade, ".
			   "   hora_atividade, ".
			   "   data_entrega, ".
			   "   hora_entrega ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->atividade."', '".
			   $this->descricao."', ".
			   $this->valor.", '".
			   $this->data_atividade."', '".
			   $this->hora_atividade."', '".
			   $this->data_entrega."', '".
			   $this->hora_entrega."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_atividade, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   atividade ".
			   " SET ".
			   "   cod_usuario = ".$this->cod_usuario.", ".
			   "   atividade = '".$this->atividade."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   valor = ".$this->valor.", ".
			   "   data_entrega = '".$this->data_entrega."', ".
			   "   hora_entrega = '".$this->hora_entrega."' ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function alterarDataHora($cod_atividade, $cod_turma, $data_entrega, $hora_entrega)
	{
		$sql = " UPDATE ".
			   "   atividade ".
			   " SET ".
			   "   data_entrega = '".$data_entrega."', ".
			   "   hora_entrega = '".$hora_entrega."' ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_atividade, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   atividade ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}
	
	function excluirVinculoAtividadeEvento($cod_atividade, $cod_evento)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   atividade_evento ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_evento = ".$cod_evento;

		$this->insere($sql);
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   atividade, ".
			   "   descricao, ".
			   "   valor, ".
			   "   data_atividade, ".
			   "   hora_atividade, ".
			   "   data_entrega, ".
			   "   hora_entrega ".
			   " FROM ".
			   "   atividade ".
			   " WHERE ".
			   "   cod_turma = ".$this->cod_turma.
			   " AND ".
			   "   cod_usuario = ".$this->cod_usuario.
			   " AND ".
			   "   atividade = '".$this->atividade."' ".
			   " AND ".
			   "   valor = ".$this->valor." ".
			   " AND ".
			   "   data_atividade = '".$this->data_atividade."' ".
			   " AND ".
			   "   hora_atividade = '".$this->hora_atividade."' ".
			   " AND ".
			   "   data_entrega = '".$this->data_entrega."' ".
			   " AND ".
			   "   hora_entrega = '".$this->hora_entrega."' ";
		
		$this->executar($sql);
		
		$this->cod_atividade = $this->data["cod_atividade"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->atividade = $this->data["atividade"];
		$this->descricao = $this->data["descricao"];
		$this->valor = $this->data["valor"];
		$this->data_atividade = $this->data["data_atividade"];
		$this->hora_atividade = $this->data["hora_atividade"];
		$this->data_entrega = $this->data["data_entrega"];
		$this->hora_entrega = $this->data["hora_entrega"];
	}
		
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_turma ".
			   " FROM ".
			   "   atividade ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ".
			   "   data_atividade, hora_atividade DESC ";
		
		$this->executar($sql);
	}
	
	function paginacao($cod_turma, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   atividade.cod_atividade, ".
			   "   atividade.cod_turma, ".	
			   "   atividade.cod_usuario, ". 
			   "   atividade.atividade, ".
			   "   atividade.descricao, ".
			   "   atividade.valor, ".
			   "   atividade.data_atividade, ".
			   "   atividade.hora_atividade, ".
			   "   atividade.data_entrega, ".
			   "   atividade.hora_entrega ".
			   " FROM ". 
			   "   atividade ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
			   
		if ($ordem == 1)
			$sql.= " ORDER BY atividade.data_atividade DESC, atividade.hora_atividade DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY atividade.data_atividade ASC, atividade.hora_atividade ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY atividade.data_entrega DESC, atividade.hora_entrega DESC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY atividade.data_entrega ASC, atividade.hora_entrega ASC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY atividade.descricao DESC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY atividade.descricao ASC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY atividade.valor DESC";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY atividade.valor ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
		function verificaAcesso($cod_atividade, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   atividades_usuario ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function acessoAtividade($cod_atividade, $cod_usuario)
	{
		$sql = " INSERT INTO atividades_usuario (".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_atividade.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
	
	function ligaAtividadeEvento($cod_atividade, $cod_evento)
	{
	  $sql = " INSERT INTO atividade_evento (".
			 "   cod_atividade, ".
			 "   cod_evento ".
			 " ) VALUES (".
			 $cod_atividade.", ".
			 $cod_evento." ) ";
	   		 
	   $this->insere($sql);
	}
	
	function recuperaCodigoEvento($cod_atividade)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_evento ".
			   " FROM ".
			   "   atividade_evento ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade;
		 
		$this->executar($sql);
		
		return $this->data["cod_evento"];
	}
}
?>