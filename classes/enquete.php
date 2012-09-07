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

class enquete extends consulta
{
	//Campos
	var $cod_enquete;
	var $cod_turma;
	var $cod_usuario;
	var $descricao;
	var $data_enquete;
	var $hora_enquete;
	var $situacao;
	
	//Construtor
	function enquete()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_enquete;
	}
	
	function setCodigo($cod_enquete)
	{
		$this->cod_enquete = $cod_enquete;
	}
	
	function getCodigoTurma()
	{
		return $this->cod_turma;
	}
	
	function setCodigoTurma($cod_turma)
	{
		$this->cod_turma = $cod_turma;
	}
	
	function getCodigoUsuario()
	{
		return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getDescricao()
	{
		return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}
	
	function getDataEnquete()
	{
		return $this->data_enquete;
	}
	
	function setTurma($cod_turma)
	{
		$this->cod_turma = $cod_turma;
	}
	
	function getTurma()
	{
		return $this->cod_turma;
	}
	
	function setDataEnquete($data_enquete)
	{
		$this->data_enquete = $data_enquete;
	}
	
	function getHoraEnquete()
	{
		return $this->hora_enquete;
	}
	
	function setHoraEnquete($hora_enquete)
	{
		$this->hora_enquete = $hora_enquete;
	}
	
	function getDataFim()
	{
		return $this->data_fim;
	}
	
	function setDataFim($data_fim)
	{
		$this->data_fim = $data_fim;
	}
	
	function getHoraFim()
	{
		return $this->hora_fim;
	}
	
	function setHoraFim($hora_fim)
	{
		$this->hora_fim = $hora_fim;
	}
	
	function getSituacao()
	{
		return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
		$this->situacao = $situacao;
	}  
	
	function carregar($cod_enquete)
	{
		$sql = " SELECT ".
			   "   cod_enquete, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   descricao, ".
			   "   data, ".
			   "   hora, ".
			   "   data_fim, ".
			   "   hora_fim, ".
			   "   situacao ".
			   " FROM ".
			   "   enquete ".
			   " WHERE ".
			   "   cod_enquete = ".$cod_enquete;
			 
		$this->executar($sql);
		
		$this->cod_enquete = $this->data["cod_enquete"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->descricao = $this->data["descricao"];
		$this->data_enquete = $this->data["data"];
		$this->hora_enquete = $this->data["hora"];
		$this->data_fim = $this->data["data_fim"];
		$this->hora_fim = $this->data["hora_fim"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO enquete (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   descricao,".
			   "   data, ".
			   "   hora, ".
			   "   data_fim, ".
			   "   hora_fim, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->descricao."', '".
			   $this->data_enquete."', '".
			   $this->hora_enquete."', '".
			   $this->data_fim."', '".
			   $this->hora_fim."', '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterar($cod_enquete)
	{
		$sql = " UPDATE ".
			   "   enquete ".
			   " SET ".
			   "   descricao = '".$this->descricao."', ".
			   "   data = '".$this->data_enquete."', ".
			   "   hora = '".$this->hora_enquete."', ".
			   "   data_fim = '".$this->data_fim."', ".
			   "   hora_fim = '".$this->hora_fim."', ".
			   "   situacao = '".$this->situacao."' ".         
			   " WHERE ".
			   "   cod_enquete = ".$cod_enquete;
		
		$this->insere($sql);
	}
	
	function excluir($cod_enquete)
	{
		$sql = " DELETE ".
		       " FROM ".
		       "   enquete ".
		       " WHERE ".
		       "   cod_enquete = ".$cod_enquete;

		$this->insere($sql);
	}
	
	function inserirOpcao($cod_enquete, $descricao, $votos = 0)
	{
		$sql = " INSERT INTO enquete_opcao (".
			   "   cod_enquete, ".
			   "   descricao,".
			   "   voto".
			   " ) VALUES (".
			   $cod_enquete.", '".
			   $descricao."', ".
			   $votos.")";

		$this->insere($sql);
	}
	
	function votarEnquete($cod_enquete, $cod_opcao, $votos)
	{
		$sql = " UPDATE ".
			   "   enquete_opcao ".
			   " SET ".
			   "   voto = ".$votos.", ".       
			   " WHERE ".
			   "   cod_enquete = ".$cod_enquete.
			   " AND ".
			   "   cod_opcao = ".$cod_opcao;
			 
		$this->insere($sql);
	}
	
	function usuarioEnquete($cod_enquete, $cod_opcao, $cod_usuario)
	{
		$sql = " INSERT INTO enquete_usuario (".
			   "   cod_enquete, ".
			   "   cod_opcao, ".
			   "   cod_usuario ".			  
			   " ) VALUES (".
			   $cod_enquete.", ".
			   $cod_opcao.", ".
			   $cod_usuario.")";
		
		$this->insere($sql);
	}
		
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_enquete, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   descricao, ".
			   "   data, ".
			   "   hora, ".
			   "   data_fim, ".
			   "   hora_fim, ".
			   "   situacao ".
			   " FROM ".
			   "   enquete ".
			   " WHERE ".
			   "   cod_turma = ".$this->cod_turma.
			   " AND ".
			   "   cod_usuario = ".$this->cod_usuario.
			   " AND ".
			   "   descricao = '".$this->descricao."'".
			   " AND ".
			   "   data = '".$this->data_enquete."'".
			   " AND ".
			   "   hora = '".$this->hora_enquete."'".
			   " AND ".
			   "   data_fim = '".$this->data_fim."'".
			   " AND ".
			   "   hora_fim = '".$this->hora_fim."'".
			   " AND ".
			   "   situacao = '".$this->situacao."'";

		$this->executar($sql);
		
		$this->cod_enquete = $this->data["cod_enquete"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->descricao = $this->data["descricao"];
		$this->data_enquete = $this->data["data"];
		$this->hora_enquete = $this->data["hora"];
		$this->data_fim = $this->data["data_fim"];
		$this->hora_fim = $this->data["hora_fim"];
		$this->situacao = $this->data["situacao"];
	}
	
	function verificaVoto($cod_enquete, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_enquete, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   enquete_usuario ".
			   " WHERE ".
			   "   cod_enquete = ".$cod_enquete.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "   enquete.cod_enquete, ".
			   "   enquete.cod_turma, ".
			   "   enquete.descricao, ".
			   "   enquete.data, ".
			   "   enquete.hora, ".
			   "   enquete.data_fim, ".
			   "   enquete.hora_fim, ".
			   "   enquete.situacao, ".
			   "   (SELECT SUM(enquete_opcao.voto) FROM enquete_opcao WHERE enquete.cod_enquete = enquete_opcao.cod_enquete) as votos ".
			   " FROM ".
			   "   enquete, ".
			   "   enquete_opcao ".
			   " WHERE ".
			   "   enquete.cod_turma = ".$cod_turma.
			   " AND ".
			   "   enquete_opcao.cod_enquete = enquete.cod_enquete ".
			   " GROUP BY ".
			   "   enquete.cod_enquete ".
			   " ORDER BY ".
			   "   enquete.data DESC, enquete.hora DESC ";

		$this->executar($sql);
	}

	function paginacao($cod_turma, $limite, $inicio, $ordem)
	{
		$sql = " SELECT ".
			   "   enquete.cod_enquete, ".
			   "   enquete.cod_turma, ".
			   "   enquete.descricao, ".
			   "   enquete.data, ".
			   "   enquete.hora, ".
			   "   enquete.data_fim, ".
			   "   enquete.hora_fim, ".
			   "   enquete.situacao, ".
			   "   (SELECT SUM(enquete_opcao.voto) FROM enquete_opcao WHERE enquete.cod_enquete = enquete_opcao.cod_enquete) as votos ".
			   " FROM ".
			   "   enquete, ".
			   "   enquete_opcao ".
			   " WHERE ".
			   "   enquete.cod_turma = ".$cod_turma.
			   " AND ".
			   "   enquete_opcao.cod_enquete = enquete.cod_enquete ".
			   " GROUP BY ".
			   "   enquete.cod_enquete ".
			   
		if ($ordem == 1)
			$sql.= " ORDER BY enquete.data DESC, enquete.hora DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY enquete.data ASC, enquete.hora ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY enquete.descricao DESC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY enquete.descricao ASC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY votos DESC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY votos ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicio;

		$this->executar($sql);
	}
}
?>