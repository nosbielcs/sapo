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

class log_sistema extends consulta
{
	//Campos
	var $cod_log;
	var $cod_usuario;
	var $cod_turma;
	var $acao;
	var $id_session;
	var $data_log;
	var $hora_log;
	
	//Construtor
	function log_sistema()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_log;
	}
	
	function setCodigo($cod_log)
	{
		$this->cod_log = $cod_log;
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
	
	function getAcao()
	{
		return $this->acao;
	}
	
	function setAcao($acao)
	{
	 	$this->acao = $acao;
	}
	
	function getSessionID()
	{
	  	return $this->id_session;
	}
	
	function setSessionID($id_session)
	{
	  	$this->id_session = $id_session;
	}
	
	function getDataLog()
	{
	  	return $this->data_log;
	}
	
	function setDataLog($data_log)
	{
	  	$this->data_log = $data_log;
	}
	
	function getHoraLog()
	{
	  	return $this->hora_log;
	}
	
	function setHoraLog($hora_log)
	{
	  	$this->hora_log = $hora_log;
	}	
	
	function carregar($cod_log)
	{
		$sql = " SELECT ".
		       "   cod_log, ".
		       "   cod_usuario, ".
			   "   cod_turma, ".
			   "   acao, ".
			   "   id_session, ".
			   "   data_log, ".
			   "   hora_log ".
			   " FROM ".
			   "   log ".
			   " WHERE ".
			   "   cod_log = ".$cod_log;
		
		$this->executar($sql);
		
		$this->cod_log = $this->data["cod_log"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->acao = $this->data["acao"];
		$this->id_session = $this->data["id_session"];
		$this->data_log = $this->data["data_log"];
		$this->hora_log = $this->data["hora_log"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO log (".
			   "   cod_usuario, ".
			   "   cod_turma, ".
			   "   acao,".
			   "   id_session, ".
			   "   data, ".
			   "   hora ".
			   " ) VALUES (".
			   $this->cod_usuario.", ".
			   $this->cod_turma.", '".
			   $this->acao."', '".
			   $this->id_session."', '".
			   $this->data_log."', '".
			   $this->hora_log."' ) ";
		
		$this->insere($sql);
	}
	
	function excluir($cod_log, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   log ".
			   " WHERE ".
			   "   cod_log = ".$cod_log;
		
		$this->insere($sql);
	}
		
	function colecao($cod_usuario, $cod_turma)
	{
		$sql = " SELECT ".
			   "   DISTINCT(data) ".
			   " FROM ".
			   "   log ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ".
			   "   data DESC, hora DESC ";

		$this->executar($sql);
	}
	
	function colecaoDataEspecifica($cod_usuario, $cod_turma, $data_log)
	{
		$sql = " SELECT ".
			   "   cod_log, ".
			   "   cod_usuario, ".
			   "   acao, ".
			   "   id_session, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   log ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   data = '".$data_log."'".
			   " ORDER BY ".
			   "   data DESC, hora DESC ";
		
		$this->executar($sql);
	}
	
	function colecaoAcessoEspecifico($cod_usuario, $cod_turma, $comando)
	{
		$sql = " SELECT ".
			   "   cod_log, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   log ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   comando = '".$comando."' ".
			   " ORDER BY ".
			   "   data DESC, hora DESC ";
		
		$this->executar($sql);
	}
	
	function paginacao($cod_turma, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   log.cod_log, ".
			   "   log.cod_turma, ".	
			   "   log.cod_usuario, ". 
			   "   log.log, ".
			   "   log.descricao, ".
			   "   log.valor, ".
			   "   log.data_log, ".
			   "   log.hora_log, ".
			   "   log.data_log, ".
			   "   log.hora_log ".
			   " FROM ". 
			   "   log ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
			   
		if ($ordem == 1)
			$sql.= " ORDER BY log.data_log DESC, log.hora_log DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY log.data_log ASC, log.hora_log ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY log.data_log DESC, log.hora_log DESC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY log.data_log ASC, log.hora_log ASC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY log.descricao DESC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY log.descricao ASC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY log.valor DESC";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY log.valor ASC";
		
		if ($ordem != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
}
?>