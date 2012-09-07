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

class atividade_arquivo extends consulta
{
	//Campos
	var $cod_arquivo;
	var $cod_atividade;
	var $nome;
	var $descricao;
	var $tipo;
	var $tamanho;
	
	//Construtor
	function atividade_arquivo()
	{
		$this->consulta(); //Heranca
	}
	
	function setCodigoArquivo($cod_arquivo)
	{
		$this->cod_arquivo = $cod_arquivo;
	}
	
	function getCodigoArquivo()
	{
		return $this->cod_arquivo;
	}
	
	function setCodigoAtividade($cod_atividade)
	{
	 	$this->cod_atividade = $cod_atividade;
	}
	
	function getCodigoAtividade()
	{
		return $this->cod_atividade;
	}
	
	function setNome($nome)
	{
	  	$this->nome = $nome;
	}
	
	function getNome()
	{
	  	return $this->nome;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setTipo($tipo)
	{
	  	$this->tipo = $tipo;
	}
	
	function getTipo()
	{
	  	return $this->tipo;
	}
	
	function setTamanho($tamanho)
	{
	  	$this->tamanho = $tamanho;
	}
	
	function getTamanho()
	{
	  	return $this->tamanho;
	}
	
	function carregar($cod_arquivo)
	{
		$sql = " SELECT ".
		       "   cod_arquivo, ".
			   "   cod_atividade, ".
			   "   nome, ".
			   "   descricao, ".
			   "   tipo, ".
			   "   tamanho ".
			   " FROM ".
			   "   atividade_arquivo ".
			   " WHERE ".
			   "   cod_arquivo = ".$cod_arquivo;
		
		$this->executar($sql);
		
		$this->cod_arquivo = $this->data["cod_arquivo"];
		$this->cod_atividade = $this->data["cod_atividade"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->tipo = $this->data["tipo"];
		$this->tamanho = $this->data["tamanho"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO atividade_arquivo (".
			   "   cod_atividade, ".
			   "   nome, ".
			   "   descricao,".
			   "   tipo, ".
			   "   tamanho ".
			   " ) VALUES (".
			   $this->cod_atividade.", '".
			   $this->nome."', '".
			   $this->descricao."', '".
			   $this->tipo."', '".
			   $this->tamanho."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_arquivo)
	{
		$sql = " UPDATE ".
			   "   atividade_arquivo ".
			   " SET ".
			   "   cod_atividade = ".$this->cod_atividade.", ".
			   "   nome = '".$this->nome."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   tipo = '".$this->tipo."', ".
			   "   tamanho = '".$this->tamanho."' ".
			   " WHERE ".
			   "   cod_arquivo = ".$cod_arquivo;
		
		$this->insere($sql);
	}
	
	function excluir($cod_arquivo)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   atividade_arquivo ".
			   " WHERE ".
			   "   cod_arquivo = ".$cod_arquivo;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_atividade)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_arquivo ".
			   " FROM ".
			   "   atividade_arquivo ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade;
		
		$this->executar($sql);
	}
	
	function paginacao($cod_atividade, $limite, $inicial)
	{
		$sql = " SELECT ".
			   "  codigo, ".
			   "  atividade, ".	
			   "  descricao, ". 
			   "  data, ".
			   "  hora, ".
			   "  situacao, ".
			   "  nome ".
			   " FROM ". 
			   "  ( ".
			   "    SELECT ".
			   "      atividade.cod_atividade as codigo, ".
			   "      atividade.atividade, ".
			   "      atividade.descricao, ".
			   "      atividade.data, ".
			   "      atividade.hora, ".
			   "      atividade.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  atividade, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  atividade.cod_atividade = ".$cod_atividade.
			   "	AND ". 
			   "	  atividade.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  descricao.cod_descricao as codigo, ".
			   "      descricao.atividade, ".
			   "	  descricao.descricao, ".
			   "	  descricao.data, ".
			   "	  descricao.hora, ".
			   "	  descricao.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  descricao, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  descricao.cod_atividade = ".$cod_atividade.
			   "	AND ".
		 	   "	  descricao.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ".
			   " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
}
?>