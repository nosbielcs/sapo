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

class conteudo_usuario extends consulta
{
	//Campos
	var $cod_conteudo;
	var $cod_turma;
	var $cod_usuario;
	var $acesso;
	var $total_acesso;
	var $data_acesso;
	var $hora_acesso;
	
	//Construtor
	function conteudo_usuario()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigoConteudo()
	{
		return $this->cod_conteudo;
	}
	
	function setCodigoConteudo($cod_conteudo)
	{
		$this->cod_conteudo = $cod_conteudo;
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
	
	function getAcesso()
	{
	  	return $this->acesso;
	}
	
	function setAcesso($acesso)
	{
	  	$this->acesso = $acesso;
	}
	
	function getTotalAcesso()
	{
	  	return $this->total_acesso;
	}
	
	function setTotalAcesso($total_acesso)
	{
	  	$this->total_acesso = $total_acesso;
	}
	
	function getDataAcesso()
	{
	  	return $this->data_acesso;
	}
	
	function setDataAcesso($data_acesso)
	{
	  	$this->data_acesso = $data_acesso;
	}
	
	function getHoraAcesso()
	{
	  	return $this->hora_acesso;
	}
	
	function setHoraAcesso($hora_acesso)
	{
	  	$this->hora_acesso = $hora_acesso;
	}
	
	function carregar($cod_conteudo, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   acesso, ".
			   "   total_acesso, ".
			   "   data_acesso, ".
			   "   hora_acesso ".
			   " FROM ".
			   "   conteudo_usuario ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->cod_conteudo = $this->data["cod_conteudo"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->acesso = $this->data["acesso"];
		$this->total_acesso = $this->data["total_acesso"];
		$this->data_acesso = $this->data["data_acesso"];
		$this->hora_acesso = $this->data["hora_acesso"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO conteudo_usuario (".
			   "   cod_conteudo, ".
			   "   cod_usuario, ".
			   "   cod_turma,".
			   "   acesso ".
			   " ) VALUES (".
			   $this->cod_conteudo.", ".
			   $this->cod_usuario.", ".
			   $this->cod_turma.", '".
			   $this->acesso."' ) ";
			 
		$this->insere($sql);
	}
	
	function alterarAcesso($cod_conteudo, $cod_usuario, $acesso)
	{
		$sql = " UPDATE ".
			   "   conteudo_usuario ".
			   " SET ".
			   "   acesso = '".$acesso."' ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
		
		$this->insere($sql);
	}
	
	function alterarTotalAcesso($cod_conteudo, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   conteudo_usuario ".
			   " SET ".
			   "   total_acesso = '".$this->total_acesso."' ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
		
		$this->insere($sql);
	}
	
	function alterarDataHoraAcesso($cod_conteudo, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   conteudo_usuario ".
			   " SET ".
			   "   data_acesso = '".$this->data_acesso."' ".
			   "   hora_acesso = '".$this->hora_acesso."' ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_conteudo, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   conteudo_usuario ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_conteudo, $cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   conteudo_usuario ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->executar($sql);
	}
	
	function paginacao($cod_conteudo, $limite, $inicial)
	{
		$sql = " SELECT ".
			   "  codigo, ".
			   "  assunto, ".	
			   "  mensagem, ". 
			   "  data, ".
			   "  hora, ".
			   "  situacao, ".
			   "  nome ".
			   " FROM ". 
			   "  ( ".
			   "    SELECT ".
			   "      conteudo.cod_conteudo as codigo, ".
			   "      conteudo.assunto, ".
			   "      conteudo.mensagem, ".
			   "      conteudo.data, ".
			   "      conteudo.hora, ".
			   "      conteudo.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  conteudo, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  conteudo.cod_conteudo = ".$cod_conteudo.
			   "	AND ". 
			   "	  conteudo.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  mensagem.cod_mensagem as codigo, ".
			   "      mensagem.assunto, ".
			   "	  mensagem.mensagem, ".
			   "	  mensagem.data, ".
			   "	  mensagem.hora, ".
			   "	  mensagem.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  mensagem, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  mensagem.cod_conteudo = ".$cod_conteudo.
			   "	AND ".
		 	   "	  mensagem.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ".
			   " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
}
?>