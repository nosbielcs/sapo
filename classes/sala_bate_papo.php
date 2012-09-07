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

class sala_bate_papo extends consulta
{
	//Campos
	var $cod_sala;
	var $cod_turma;
	var $cod_usuario;
	var $nome;
	var $descricao;
	var $vagas;
	var $data_bate_papo;
	var $hora_bate_papo;
	var $situacao;
	
	//Construtor
	function sala_bate_papo()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_sala;
	}
	
	function setCodigo($codigo)
	{
		$this->cod_sala = $codigo;
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
	
	function getNome()
	{
	  	return $this->nome;
	}
	
	function setNome($nome)
	{
	  	$this->nome = $nome;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function getVagas()
	{
	  	return $this->vagas;
	}
	
	function setVagas($vagas)
	{
	  	$this->vagas = $vagas;
	}
	
	function getDataBatePapo()
	{
	  	return $this->data_bate_papo;
	}
	
	function setDataBatePapo($data_bate_papo)
	{
	  	$this->data_bate_papo = $data_bate_papo;
	}
	
	function getHoraBatePapo()
	{
	  	return $this->hora_bate_papo;
	}
	
	function setHoraBatePapo($hora_bate_papo)
	{
	  	$this->hora_bate_papo = $hora_bate_papo;
	}
	
	function getSituacao()
	{
	  	return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
	  	$this->situacao = $situacao;
	}
		
	function carregar($cod_sala)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   sala_bate_papo ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala;
		
		$this->executar($sql);
		
		$this->cod_sala = $this->data["cod_sala"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->vagas = $this->data["vagas"];
		$this->data_bate_papo = $this->data["data"];
		$this->hora_bate_papo = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO sala_bate_papo (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   nome,".
			   "   descricao, ".
			   "   vagas, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->nome."', '".
			   $this->descricao."', ".
			   $this->vagas.", '".
			   $this->data_bate_papo."', '".
			   $this->hora_bate_papo."', '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterar($cod_sala, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   sala_bate_papo ".
			   " SET ".
			   "   nome = '".$this->nome."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   situacao = '".$this->situacao."', ".
			   "   vagas = ".$this->vagas." ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_sala, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   sala_bate_papo ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}
	
	function encerrar($cod_sala, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   sala_bate_papo ".
			   " SET ".
			   "   situacao = 'F' ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   cod_turma = ".$cod_turma;

		$this->insere($sql);
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   tamanho, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   sala_bate_papo ".
			   " WHERE ".
			   "   cod_turma = ".$this->cod_turma.
			   " AND ".
			   "   cod_usuario = ".$this->cod_usuario.
			   " AND ".
			   "   nome = '".$this->nome."' ".
			   " AND ".
			   "   descricao = '".$this->descricao."' ".
			   " AND ".
			   "   vagas = ".$this->vagas." ".
			    " AND ".
			   "   data = '".$this->data_bate_papo."' ".
			   " AND ".
			   "   hora = '".$this->hora_bate_papo."' ";
		
		$this->executar($sql);
		
		$this->cod_sala = $this->data["cod_sala"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->vagas = $this->data["vagas"];
		$this->data_bate_papo = $this->data["data"];
		$this->hora_bate_papo = $this->data["hora"];
	}
		
	function colecao($cod_turma, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   sala_bate_papo ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
		
		if ($ordem == 1)
			$sql.= " ORDER BY sala_bate_papo.data DESC, sala_bate_papo.hora DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY sala_bate_papo.data ASC, sala_bate_papo.hora ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY sala_bate_papo.nome DESC ";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY sala_bate_papo.nome ASC ";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY sala_bate_papo.vagas DESC ";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY sala_bate_papo.vagas ASC ";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY sala_bate_papo.situacao DESC ";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY sala_bate_papo.situacao ASC ";
						
						
		$this->executar($sql);
	}
}
?>