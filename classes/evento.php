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

class evento extends consulta
{
	//Campos
	var $codigo;
	var $cod_turma;
	var $cod_usuario;
	var $nome_usuario;
	var $assunto;
	var $descricao;
	var $data_evento;
	var $hora;
	var $tipo;
	var $situacao;
	
	//Construtor
	function evento()
	{
	   $this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->codigo;
	}
	
	function setCodigoTurma($cod_turma)
	{
		$this->cod_turma = $cod_turma;
	}
	
	function getCodigoTurma()
	{
		return $this->cod_turma;
	}
	
	function setCodigo($cod)
	{
		$this->codigo = $cod;
	}
	
	function getCodigoUsuario()
	{
		return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
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
	
	function getDataEvento()
	{
		return $this->data_evento;
	}
	
	function setDataEvento($data_evento)
	{
		$this->data_evento = $data_evento;
	}
	
	function getHora()
	{
		return $this->hora;
	}
	
	function setHora($hora)
	{
		$this->hora = $hora;
	}
	
	function getTipo()
	{
		return $this->tipo;
	}
	
	function setTipo($tipo)
	{
		$this->tipo = $tipo;
	}
	
	function getSituacao()
	{
		return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
		$this->situacao = $situacao;
	}  
	
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   cod_evento, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto, ".
			   "   descricao, ".
			   "   data, ".
			   "   hora, ".
			   "   tipo, ".
			   "   situacao ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   cod_evento = ".$codigo;
		
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_evento"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->assunto = $this->data["assunto"];
		$this->descricao = $this->data["descricao"];
		$this->data_evento = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->tipo = $this->data["tipo"];
		$this->situacao = $this->data["situacao"];
	}

	function inserir()
	{
		$sql = " INSERT INTO evento (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto,".
			   "   descricao, ".
			   "   data, ".
			   "   hora, ".
			   "   tipo, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->assunto."', '".
			   $this->descricao."', '".
			   $this->data_evento."', '".
			   $this->hora."', '".
			   $this->tipo."', '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterar($cod_evento)
	{
	  $sql = " UPDATE ".
			 "   evento ".
			 " SET ".
			 "   cod_usuario = ".$this->cod_usuario.", ".
			 "   assunto = '".$this->assunto."', ".
			 "   descricao = '".$this->descricao."', ".
			 "   data = '".$this->data_evento."', ".
			 "   hora = '".$this->hora."', ".
			 "   tipo = '".$this->tipo."', ".
			 "   situacao = '".$this->situacao."' ".         
			 " WHERE ".
			 "   cod_evento = ".$cod_evento;  

	  $this->insere($sql);
	}
	
	function alterarDataHora($cod_evento, $data_evento, $hora_evento)
	{
	  $sql = " UPDATE ".
			 "   evento ".
			 " SET ".
			 "   data = '".$data_evento."', ".
			 "   hora = '".$hora_evento."' ".         
			 " WHERE ".
			 "   cod_evento = ".$cod_evento;  

	  $this->insere($sql);
	}
	
	function excluir($cod_evento, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   cod_evento = ".$cod_evento;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_evento, ".
			   "   cod_turma ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
		 
		$this->executar($sql);
	}
	
	function colecaoEventos($cod_turma, $data_especifica)
	{
		$sql = " SELECT ".
		       "   cod_evento, ".
			   "   data ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   data = '".$data_especifica."'".
			   " AND ".
			   "   cod_turma = ".$cod_turma;
	   
		$this->executar($sql);
	}
	
	function verificaAcesso($cod_evento, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_evento, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   evento_usuario ".
			   " WHERE ".
			   "   cod_evento = ".$cod_evento.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function acessoEvento($cod_evento, $cod_usuario)
	{
		$sql = " INSERT INTO evento_usuario (".
			   "   cod_evento, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_evento.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
	
	function paginacao($cod_turma, $limite, $inicio, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_evento, ".
			   "   cod_turma, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
			   
		if ($ordem == 1)
			$sql.= " ORDER BY data DESC, hora DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY data ASC, hora ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicio;
		$this->executar($sql);
	}
	
	function recuperaCodigoAtividade($cod_evento)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_evento ".
			   " FROM ".
			   "   atividade_evento ".
			   " WHERE ".
			   "   cod_evento = ".$cod_evento;
	  	
		$this->executar($sql);
		
		return $this->data["cod_atividade"];
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_evento, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto, ".
			   "   descricao, ".
			   "   data, ".
			   "   hora, ".
			   "   tipo, ".
			   "   situacao ".
			   " FROM ".
			   "   evento ".
			   " WHERE ".
			   "   cod_turma = ".$this->cod_turma.
			   " AND ".
			   "   cod_usuario = ".$this->cod_usuario.
			   " AND ".
			   "   assunto = '".$this->assunto."' ".
			   " AND ".
			   "   descricao = '".$this->descricao."' ".
			   " AND ".
			   "   data = '".$this->data_evento."' ".
			   " AND ".
			   "   hora = '".$this->hora."' ".
			   " AND ".
			   "   tipo = '".$this->tipo."' ";
		
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_evento"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->assunto = $this->data["assunto"];
		$this->descricao = $this->data["descricao"];
		$this->data_evento = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->tipo = $this->data["tipo"];
		$this->situacao = $this->data["situacao"];
		
		return $this->data["cod_evento"];
	}
}
?>