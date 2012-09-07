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

class edital extends consulta
{
	//Campos
	var $codigo;
	var $cod_turma;
	var $cod_usuario;
	var $assunto;
	var $mensagem;
	var $data_edital;
	var $hora;
	var $situacao;
	
	//Construtor
	function edital()
	{
	   $this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
	  return $this->codigo;
	}
	
	function setCodigo($codigo)
	{
	  $this->codigo = $codigo;
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
	
	function getAssunto()
	{
	  return $this->assunto;
	}
	
	function setAssunto($assunto)
	{
	  $this->assunto = $assunto;
	}
	
	function getMensagem()
	{
	  return $this->mensagem;
	}
	
	function setMensagem($mensagem)
	{
	  $this->mensagem = $mensagem;
	}
	
	function getDataEdital()
	{
	  return $this->data_edital;
	}
	
	function setDataEdital($data_edital)
	{
	  $this->data_edital = $data_edital;
	}
	
	function getHora()
	{
	  return $this->hora;
	}
	
	function setHora($hora)
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
	
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   cod_edital, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto, ".
			   "   mensagem, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   edital ".
			   " WHERE ".
			   "   cod_edital = ".$codigo;
			 
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_edital"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->assunto = $this->data["assunto"];
		$this->mensagem = $this->data["mensagem"];
		$this->data_edital = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO edital (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto,".
			   "   mensagem, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->assunto."', '".
			   $this->mensagem."', '".
			   $this->data_edital."', '".
			   $this->hora."', '".
			   $this->situacao."' ) ";
			 
		$this->insere($sql);
	}
	
	function alterar($cod_edital)
	{
		$sql = " UPDATE ".
			   "   edital ".
			   " SET ".
			   "   cod_usuario = ".$this->cod_usuario.", ".
			   "   assunto = '".$this->assunto."', ".
			   "   mensagem = '".$this->mensagem."', ".
			   "   data= '".$this->data_edital."', ".
			   "   hora= '".$this->hora."', ".
			   "   situacao = '".$this->situacao."' ".         
			   " WHERE ".
			   "   cod_edital = ".$cod_edital;
		
		$this->insere($sql);
	}
	
	function excluir($codigo)
	{
		$sql = " DELETE ".
		       " FROM ".
		       "   edital ".
		       " WHERE ".
		       "   cod_edital = ".$codigo;

		$this->insere($sql);
	}
		
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_edital, ".
			   "   cod_turma, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   edital ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ".
			   "   data DESC, hora DESC ";
			 
		$this->executar($sql);
	}

	function paginacao($cod_turma, $limite, $inicio, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_edital, ".
			   "   cod_turma, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   edital ".
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
	
	function verificaAcesso($cod_edital, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_edital, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   edital_usuario ".
			   " WHERE ".
			   "   cod_edital = ".$cod_edital.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function acessoEdital($cod_edital, $cod_usuario)
	{
		$sql = " INSERT INTO edital_usuario (".
			   "   cod_edital, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_edital.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
}
?>