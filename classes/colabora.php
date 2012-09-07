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

class colabora extends consulta
{
	//Campos
	var $cod_colabora;
	var $cod_turma;
	var $cod_usuario;
	var $nome_usuario;
	var $tema;
	var $mensagem;
	var $data;
	var $hora;
	var $situacao;
	var $visualizacoes;
	
	//Construtor
	function colabora()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_colabora;
	}
	
	function setCodigo($codigo)
	{
		$this->cod_colabora = $codigo;
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
	
	function getNomeUsuario()
	{
	  	return $this->nome_usuario;
	}
	
	function setNomeUsuario($nome_usuario)
	{
	  	$this->nome_usuario = $nome_usuario;
	}
	
	function gettema()
	{
	  	return $this->tema;
	}
	
	function settema($tema)
	{
	  	$this->tema = $tema;
	}
	
	function getMensagem()
	{
	  	return $this->mensagem;
	}
	
	function setMensagem($mensagem)
	{
	  	$this->mensagem = $mensagem;
	}
	
	function getData()
	{
	  	return $this->data;
	}
	
	function setData($data)
	{
	  	$this->data = $data;
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
	
	function getVisualizacoes()
	{
	  	return $this->visualizacoes;
	}
	
	function setVisualizacoes($visualizacoes)
	{
	  	$this->visualizacoes = $visualizacoes;
	} 
	
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   colabora.cod_colabora, ".
			   "   colabora.cod_turma, ".
			   "   colabora.cod_usuario, ".
			   "   colabora.tema, ".
			   "   colabora.mensagem, ".
			   "   colabora.data, ".
			   "   colabora.hora, ".
			   "   colabora.situacao, ".
			   "   colabora.visualizacoes, ".
			   "   usuario.nome ".
			   " FROM ".
			   "   colabora, ".
			   "   usuario ".
			   " WHERE ".
			   "   colabora.cod_colabora = ".$codigo.
			   " AND ".
			   "   colabora.cod_usuario = usuario.cod_usuario ";
		
		$this->executar($sql);
		
		$this->cod_colabora = $this->data["cod_colabora"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->nome_usuario = $this->data["nome"];
		$this->tema = $this->data["tema"];
		$this->mensagem = $this->data["mensagem"];
		$this->data = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
		$this->visualizacoes = $this->data["visualizacoes"];
	}
	
	function recuperaCodigo()
	{
	  $sql = " SELECT ".
			 "   cod_colabora, ".
			 "   cod_usuario, ".
			 "   tema, ".
			 "   mensagem, ".
			 "   data, ".
			 "   hora, ".
			 "   situacao,  ".
			 "   visualizacoes ".
			 " FROM ".
			 "   colabora ".
			 " WHERE ".
			 "   cod_usuario = ".$this->cod_usuario." ".
			 " AND ".
			 "   tema = '".$this->tema."' ".
			 " AND ".
			 "   mensagem = '".$this->mensagem."' ".
			 " AND ".
			 "   data = '".$this->data_colabora."' ".
			 " AND ".
			 "   hora = '".$this->hora."' ".
			 " AND ".
			 "   situacao = '".$this->situacao."' ";
      
	  $this->executar($sql);
	
	  $this->codigo = $this->data["cod_colabora"];
	  $this->cod_usuario = $this->data["cod_usuario"];
	  $this->tema = $this->data["tema"];
	  $this->mensagem = $this->data["mensagem"];
	  $this->data_colabora = $this->data["data"];
	  $this->hora = $this->data["hora"];
	  $this->situacao = $this->data["situacao"];
	  $this->visualizacoes = $this->data["visualizacoes"];
	}
		
	function inserir()
	{
	  $sql = " INSERT INTO colabora (".
	         "   cod_turma, ".
			 "   cod_usuario, ".
			 "   tema,".
			 "   mensagem, ".
			 "   data, ".
			 "   hora, ".
			 "   situacao, ".
			 "   visualizacoes ".
			 " ) VALUES (".
			 $this->cod_turma.", ".
			 $this->cod_usuario.", '".
			 $this->tema."', '".
			 $this->mensagem."', '".
			 $this->data_colabora."', '".
			 $this->hora."', '".
			 $this->situacao."',  ".
			 $this->visualizacoes." ) ";
			 
	   $this->insere($sql);
	}
	
	/*function ligacolaboraTurma($cod_colabora, $cod_turma)
	{
	  $sql = " INSERT INTO colabora_turma (".
			 "   cod_colabora, ".
			 "   cod_turma ".
			 " ) VALUES (".
			 $cod_colabora.", ".
			 $cod_turma." ) ";
	   		 
	   $this->insere($sql);
	}*/
	
	function alterar($cod_colabora, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   colabora ".
			   " SET ".
			   "   cod_usuario = ".$this->cod_usuario.", ".
			   "   tema = '".$this->tema."', ".
			   "   mensagem = '".$this->mensagem."' ".
			   " WHERE ".
			   "   cod_colabora = ".$cod_colabora.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function atualizaVisualizacoes($cod_colabora, $cod_turma, $visualizacoes)
	{
		$sql = " UPDATE ".
			   "   colabora ".
			   " SET ".
			   "   visualizacoes = ".$visualizacoes." ".
			   " WHERE ".
			   "   cod_colabora = ".$cod_colabora.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_colabora, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   colabora ".
			   " WHERE ".
			   "   cod_colabora = ".$cod_colabora.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "	 cod_colabora, ".
			   "   cod_turma ".
			   " FROM ".
			   "   colabora ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ".
			   "   data, hora DESC ";
		
		$this->executar($sql);
	}
	
	function colecaoMensagens($cod_colabora)
	{
	  $sql = " SELECT ".
			 "	 colabora.cod_colabora, ".
			 "   mensagem.cod_mensagem, ".
			 "   mensagem.cod_usuario, ".
			 "   mensagem.data, ".
			 "   mensagem.hora, ".
			 "   usuario.nome ".
			 " FROM ".
			 "   colabora, ".
			 "   mensagem, ".
			 "   usuario ".
			 " WHERE ".
			 "   colabora.cod_colabora = mensagem.cod_colabora ".
			 " AND ".
			 "   colabora.cod_colabora = ".$cod_colabora.
			 " AND ".
			 "   mensagem.cod_usuario = usuario.cod_usuario ".
			 " ORDER BY ".
			 "   mensagem.cod_mensagem DESC ";
      
	  $this->executar($sql);
	}
	
	function paginacao($cod_colabora, $limite, $inicial)
	{
		$sql = " SELECT ".
			   "  codigo, ".
			   "  tema, ".	
			   "  mensagem, ". 
			   "  data, ".
			   "  hora, ".
			   "  situacao, ".
			   "  nome ".
			   " FROM ". 
			   "  ( ".
			   "    SELECT ".
			   "      colabora.cod_colabora as codigo, ".
			   "      colabora.tema, ".
			   "      colabora.mensagem, ".
			   "      colabora.data, ".
			   "      colabora.hora, ".
			   "      colabora.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  colabora, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  colabora.cod_colabora = ".$cod_colabora.
			   "	AND ". 
			   "	  colabora.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  mensagem.cod_mensagem as codigo, ".
			   "      mensagem.tema, ".
			   "	  mensagem.mensagem, ".
			   "	  mensagem.data, ".
			   "	  mensagem.hora, ".
			   "	  mensagem.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  mensagem, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  mensagem.cod_colabora = ".$cod_colabora.
			   "	AND ".
		 	   "	  mensagem.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ".
			   " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}

	function totalMensagens($cod_colabora)
	{		
		$sql = " SELECT ".
			   "  codigo, ".
			   "  tema, ".	
			   "  mensagem, ". 
			   "  data, ".
			   "  hora, ".
			   "  situacao, ".
			   "  nome ".
			   " FROM ". 
			   "  ( ".
			   "    SELECT ".
			   "      colabora.cod_colabora as codigo, ".
			   "      colabora.tema, ".
			   "      colabora.mensagem, ".
			   "      colabora.data, ".
			   "      colabora.hora, ".
			   "      colabora.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  colabora, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  colabora.cod_colabora = ".$cod_colabora.
			   "	AND ". 
			   "	  colabora.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  mensagem.cod_mensagem as codigo, ".
			   "      mensagem.tema, ".
			   "	  mensagem.mensagem, ".
			   "	  mensagem.data, ".
			   "	  mensagem.hora, ".
			   "	  mensagem.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  mensagem, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  mensagem.cod_colabora = ".$cod_colabora.
			   "	AND ".
		 	   "	  mensagem.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ";
		
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
			   "     colabora ".
			   "   WHERE ".
			   "     cod_usuario = ".$usuario.
			   "   UNION ".
			   "   SELECT ".
			   "     count(*) as total ".
			   "   FROM ".
			   "     mensagem ".
			   "   WHERE ".
			   "     cod_usuario = ".$usuario.
			   " ) as consulta ";
		   
		$this->executar($sql);
	}
}
?>