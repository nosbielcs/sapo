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

class mensagem_forum extends consulta
{
	//Campos
	var $cod_mensagem;
	var $cod_forum;
	var $cod_usuario;
	var $cod_editor;
	var $assunto;
	var $nome_usuario;
	var $mensagem;
	var $data_mensagem;
	var $hora;
	var $data_edicao;
	var $hora_edicao;
	var $situacao;
	
	//Construtor
	function mensagem()
	{
	   	$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
	  return $this->cod_mensagem;
	}
	
	function setCodigo($codigo)
	{
	  $this->cod_mensagem = $codigo;
	}
	
	function getCodigoForum()
	{
	  return $this->cod_forum;
	}
	
	function setCodigoForum($codigo)
	{
	  $this->cod_forum = $codigo;
	}
	
	function getCodigoUsuario()
	{
	  return $this->cod_usuario;
	}

	function setCodigoUsuario($cod_usuario)
	{
	  $this->cod_usuario = $cod_usuario;
	}
	
	function setCodigoEditor($cod_editor)
	{
		$this->cod_editor = $cod_editor;
	}
	
	function getCodigoEditor()
	{
	  	return $this->cod_editor;
	}
	
	function setNomeUsuario($nome_usuario)
	{
	  $this->nome_usuario = $nome_usuario;
	}
	
	function getNomeUsuario()
	{
	  return $this->nome_usuario;
	}
	
	function setAssunto($assunto)
	{
		$this->assunto = $assunto;
	}
	
	function getAssunto()
	{
		return $this->assunto;
	}
	
	function getMensagem()
	{
	  return $this->mensagem;
	}
	
	function setMensagem($mensagem)
	{
	  $this->mensagem = $mensagem;
	}
	
	function getDataMensagem()
	{
	  return $this->data_mensagem;
	}
	
	function setDataMensagem($data_mensagem)
	{
	  $this->data_mensagem = $data_mensagem;
	}
	
	function getHora()
	{
	  return $this->hora;
	}
	
	function setHora($hora)
	{
	  $this->hora = $hora;
	}
	
	function getDataEdicao()
	{
	  	return $this->data_edicao;
	}
	
	function setDataEdicao($data_edicao)
	{
	  	$this->data_edicao = $data_edicao;
	}
	
	function getHoraEdicao()
	{
	  	return $this->hora_edicao;
	}
	
	function setHoraEdicao($hora_edicao)
	{
	  	$this->hora_edicao = $hora_edicao;
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
			   "   mensagem_forum.cod_mensagem, ".
			   "   mensagem_forum.cod_forum, ".
			   "   mensagem_forum.cod_usuario, ".
			   "   mensagem_forum.cod_editor, ".
			   "   mensagem_forum.assunto, ".
			   "   mensagem_forum.mensagem, ".
			   "   mensagem_forum.data, ".
			   "   mensagem_forum.hora, ".
			   "   mensagem_forum.data_edicao, ".
			   "   mensagem_forum.hora_edicao, ".
			   "   mensagem_forum.situacao, ".
			   "   usuario.nome ".
			   " FROM ".
			   "   mensagem_forum, ".
			   "   usuario ".
			   " WHERE ".
			   "   mensagem_forum.cod_mensagem = ".$codigo.
			   " AND ".
			   "   mensagem_forum.cod_usuario = usuario.cod_usuario ";
		
		$this->executar($sql);
		
		$this->cod_mensagem = $this->data["cod_mensagem"];
		$this->cod_forum = $this->data["cod_forum"];
		$this->cod_editor = $this->data["cod_editor"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->assunto = $this->data["assunto"];
		$this->nome_usuario = $this->data["nome"];
		$this->mensagem = $this->data["mensagem"];
		$this->data_mensagem = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->data_edicao = $this->data["data_edicao"];
		$this->hora_edicao = $this->data["hora_edicao"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO mensagem_forum (".
			   "   cod_forum, ". 
			   "   cod_usuario, ".
			   "   assunto, ".
			   "   mensagem, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_forum.", ".
			   $this->cod_usuario.", '".
			   $this->assunto."', '".
			   $this->mensagem."', '".
			   $this->data_mensagem."', '".
			   $this->hora."', '".
			   $this->situacao."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_mensagem)
	{
		$sql = " UPDATE ".
			   "   mensagem_forum ".
			   " SET ".
			   "   cod_editor = ".$this->cod_editor.", ".
			   "   assunto = '".$this->assunto."', ".
			   "   mensagem = '".$this->mensagem."', ".
			   "   data_edicao = '".$this->data_edicao."', ".
			   "   hora_edicao = '".$this->hora_edicao."' ".       
			   " WHERE ".
			   "   cod_mensagem = ".$cod_mensagem;  
		
		$this->insere($sql);
	}
	
	function excluir($codigo)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   mensagem_forum ".
			   " WHERE ".
			   "   cod_mensagem = ".$codigo;

		$this->insere($sql);
	}
	
	function excluirMensagensForum($cod_forum)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   mensagem_forum ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_forum)
	{
		$sql = " SELECT ".
			   "   cod_mensagem, ".
			   "   cod_forum ".
			   " FROM ".
			   "   mensagem_forum ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " ORDER BY ".
			   "   data ASC, hora ASC ";

		$this->executar($sql);
	}
	
	function totalMsgsUsuario($usuario)
	{
		$sql = " SELECT ".
			   "   sum(total) as total ".
			   " FROM ( ".
			   "   SELECT ".
			   "     count(*) as total ".
			   "   FROM ".
			   "     forum ".
			   "   WHERE ".
			   "     cod_usuario = ".$usuario.
			   "   UNION ".
			   "   SELECT ".
			   "     count(*) as total ".
			   "   FROM ".
			   "     mensagem_forum ".
			   "   WHERE ".
			   "     cod_usuario = ".$usuario.
			   " ) as consulta ";
		
		$this->executar($sql);
	}
	
	function verificaAcesso($cod_forum, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_mensagem, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   mensagem_usuario ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function acessoMensagem($cod_mensagem, $cod_usuario)
	{
		$sql = " INSERT INTO mensagem_usuario (".
			   "   cod_mensagem, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_mensagem.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
}
?>