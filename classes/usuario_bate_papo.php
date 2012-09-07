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

class usuario_bate_papo extends consulta
{
	//Campos
	var $cod_sala;
	var $cod_usuario;
	var $data_usuario;
	var $hora_usuario;
	var $situacao;
	
	//Construtor
	function usuario_bate_papo()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigoSala()
	{
		return $this->cod_sala;
	}
	
	function setCodigoSala($cod_sala)
	{
	 	$this->cod_sala = $cod_sala;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getDataUsuario()
	{
	  	return $this->data_usuario;
	}
	
	function setDataUsuario($data_usuario)
	{
	  	$this->data_usuario = $data_usuario;
	}
	
	function getHoraUsuario()
	{
	  	return $this->hora_usuario;
	}
	
	function setHoraUsuario($hora_usuario)
	{
	  	$this->hora_usuario = $hora_usuario;
	}
	
	function getSituacao()
	{
	  	return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
	  	$this->situacao = $situacao;
	}	
		
	function carregar($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario_bate_papo ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->data_usuario = $this->data["data"];
		$this->hora_usuario = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO usuario_bate_papo (".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_sala.", ".
			   $this->cod_usuario.", '".
			   $this->data_usuario."', '".
			   $this->hora_usuario."', '".
			   $this->situacao."' ) ";
		
		$this->insere($sql);
	}

	function excluir($cod_usuario, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   usuario_bate_papo ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}
	
	function alterar($cod_usuario, $cod_sala, $data, $hora, $situacao)
	{
		$sql = " UPDATE ".
			   "   usuario_bate_papo ".
			   " SET ".
			   "   situacao = '".$situacao."' ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   data = '".$data."' ".
			   " AND ".
			   "   hora = '".$hora."' ";
		
		$this->insere($sql);
	}	
		
	function colecao($cod_sala)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario_bate_papo ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala;
		
		$this->executar($sql);
	}
	
	function verificarSituacao($cod_usuario, $cod_sala, $data_usuario, $hora_usuario)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario_bate_papo ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   data = '".$data_usuario."' ".
			   " AND ".
			   "   hora = '".$hora_usuario."' ";
		
		$this->executar($sql);
		
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->data_usuario = $this->data["data"];
		$this->hora_usuario = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function verificarUsuarioSalaBatePapo($cod_usuario, $cod_sala, $situacao)
	{
		$sql = " SELECT ".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario_bate_papo ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   situacao = '".$situacao."' ";

		$this->executar($sql);
		
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->data_usuario = $this->data["data"];
		$this->hora_usuario = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function alterarSatuts($cod_usuario, $cod_sala, $situacao)
	{
		$sql = " UPDATE ".
			   "   usuario_bate_papo ".
			   " SET ".
			   "   situacao = '".$situacao."' ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   situacao = 'A' ";

		$this->insere($sql);
	}
}
?>