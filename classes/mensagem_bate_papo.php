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

class mensagem_bate_papo extends consulta
{
	//Campos
	var $cod_sala;
	var $cod_mensagem;
	var $cod_usuario;
	var $cod_destinatario;
	var $mensagem;
	var $cor_mensagem;
	var $modo_mensagem;
	var $reservado;
	var $data_mensagem;
	var $hora_mensagem;
	
	//Construtor
	function mensagem_bate_papo()
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
	
	function getCodigoMensagem()
	{
		return $this->cod_mensagem;
	}
	
	function setCodigoMensagem($cod_mensagem)
	{
	 	$this->cod_mensagem = $cod_mensagem;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getCodigoDestinatario()
	{
	  	return $this->cod_destinatario;
	}
	
	function setCodigoDestinatario($cod_destinatario)
	{
		$this->cod_destinatario = $cod_destinatario;
	}
	
	function getCorMensagem()
	{
	  	return $this->cor_mensagem;
	}
	
	function setCorMensagem($cor_mensagem)
	{
	  	$this->cor_mensagem = $cor_mensagem;
	}
	
	function getMensagem()
	{
	  	return $this->mensagem;
	}
	
	function setMensagem($mensagem)
	{
	  	$this->mensagem = $mensagem;
	}
	
	function getReservado()
	{
	  	return $this->reservado;
	}
	
	function setReservado($reservado)
	{
	  	$this->reservado = $reservado;
	}
	
	function getModoMensagem()
	{
	  	return $this->modo_mensagem;
	}
	
	function setModoMensagem($modo_mensagem)
	{
	  	$this->modo_mensagem = $modo_mensagem;
	}
	
	function getDataMensagem()
	{
	  	return $this->data_mensagem;
	}
	
	function setDataMensagem($data_mensagem)
	{
	  	$this->data_mensagem = $data_mensagem;
	}
	
	function getHoraMensagem()
	{
	  	return $this->hora_mensagem;
	}
	
	function setHoraMensagem($hora_mensagem)
	{
	  	$this->hora_mensagem = $hora_mensagem;
	}	
		
	function carregar($cod_mensagem, $cod_sala)
	{
		$sql = " SELECT ".
			   "   cod_mensagem, ".
			   "   cod_mensagem, ".
			   "   cod_usuario, ".
			   "   cod_destinatario, ".
			   "   mensagem, ".
			   "   cor_mensagem, ".
			   "   modo_mensagem, ".
			   "   reservado, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   mensagem_bate_papo ".
			   " WHERE ".
			   "   cod_mensagem = ".$cod_mensagem.
			   " AND ".
			   "   cod_sala = ".$cod_sala;
		
		$this->executar($sql);
		
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_destinatario = $this->data["cod_destinatario"];
		$this->mensagem = $this->data["mensagem"];
		$this->cor_mensagem = $this->data["cor_mensagem"];
		$this->modo_mensagem = $this->data["modo_mensagem"];
		$this->reservado = $this->data["reservado"];
		$this->data_mensagem = $this->data["data"];
		$this->hora_mensagem = $this->data["hora"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO mensagem_bate_papo (".
			   "   cod_sala, ".
			   "   cod_usuario, ".
			   "   cod_destinatario, ".
			   "   mensagem,".
			   "   cor_mensagem, ".
			   "   modo_mensagem,".
			   "   reservado,".
			   "   data, ".
			   "   hora ".
			   " ) VALUES (".
			   $this->cod_sala.", ".
			   $this->cod_usuario.", ".
			   $this->cod_destinatario.", '".
			   $this->mensagem."', '".
			   $this->cor_mensagem."', '".
			   $this->modo_mensagem."', '".
			   $this->reservado."', '".
			   $this->data_mensagem."', '".
			   $this->hora_mensagem."' ) ";
		
		$this->insere($sql);
	}

	function excluir($cod_mensagem, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   mensagem_bate_papo ".
			   " WHERE ".
			   "   cod_mensagem = ".$cod_mensagem.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}
	
	function excluirColecao($cod_sala)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   mensagem_bate_papo ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala;
		
		$this->insere($sql);
	}
		
	function colecao($cod_sala)
	{
		$sql = " SELECT ".
			   "   cod_mensagem, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   mensagem_bate_papo ".
			   " WHERE ".
			   "   cod_sala = ".$cod_sala.
			   " ORDER BY ".
			   "   data ASC, hora ASC ";
		
		$this->executar($sql);
	}
}
?>