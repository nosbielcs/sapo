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

class forum extends consulta
{
	//Campos
	var $cod_forum;
	var $cod_turma;
	var $cod_usuario;
	var $cod_editor;
	var $nome_usuario;
	var $assunto;
	var $mensagem;
	var $data_forum;
	var $hora;
	var $data_edicao;
	var $hora_edicao;
	var $situacao;
	var $visualizacoes;
	var $respostas;
	
	//Construtor
	function forum()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_forum;
	}
	
	function setCodigo($codigo)
	{
		$this->cod_forum = $codigo;
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
	
	function setCodigoEditor($cod_editor)
	{
		$this->cod_editor = $cod_editor;
	}
	
	function getCodigoEditor()
	{
	  	return $this->cod_editor;
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
	
	function getDataForum()
	{
	  	return $this->data_forum;
	}
	
	function setDataForum($data_forum)
	{
	  	$this->data_forum = $data_forum;
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
	
	function getVisualizacoes()
	{
	  	return $this->visualizacoes;
	}
	
	function setVisualizacoes($visualizacoes)
	{
	  	$this->visualizacoes = $visualizacoes;
	}
	
	function getRespostas()
	{
	  	return $this->respostas;
	}
	
	function setRespostas($respostas)
	{
	  	$this->respostas = $respostas;
	} 
	
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   forum.cod_forum, ".
			   "   forum.cod_turma, ".
			   "   forum.cod_usuario, ".
			   "   forum.cod_editor, ".
			   "   forum.assunto, ".
			   "   forum.mensagem, ".
			   "   forum.data, ".
			   "   forum.hora, ".
			   "   forum.data_edicao, ".
			   "   forum.hora_edicao, ".
			   "   forum.situacao, ".
			   "   forum.visualizacoes, ".
			   "   forum.respostas, ".
			   "   usuario.nome ".
			   " FROM ".
			   "   forum, ".
			   "   usuario ".
			   " WHERE ".
			   "   forum.cod_forum = ".$codigo.
			   " AND ".
			   "   forum.cod_usuario = usuario.cod_usuario ";
		
		$this->executar($sql);
		
		$this->cod_forum = $this->data["cod_forum"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_editor = $this->data["cod_editor"];
		$this->nome_usuario = $this->data["nome"];
		$this->assunto = $this->data["assunto"];
		$this->mensagem = $this->data["mensagem"];
		$this->data_forum = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->data_edicao = $this->data["data_edicao"];
		$this->hora_edicao = $this->data["hora_edicao"];
		$this->situacao = $this->data["situacao"];
		$this->visualizacoes = $this->data["visualizacoes"];
		$this->respostas = $this->data["respostas"];
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_forum ".
			   " FROM ".
			   "   forum ".
			   " WHERE ".
			   "   cod_usuario = ".$this->cod_usuario." ".
			   " AND ".
			   "   assunto = '".$this->assunto."' ".
			   " AND ".
			   "   mensagem = '".$this->mensagem."' ".
			   " AND ".
			   "   data = '".$this->data_forum."' ".
			   " AND ".
			   "   hora = '".$this->hora."' ".
			   " AND ".
			   "   situacao = '".$this->situacao."' ";

		$this->executar($sql);
		
		return $this->data["cod_forum"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO forum (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   assunto,".
			   "   mensagem, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao, ".
			   "   visualizacoes ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", '".
			   $this->assunto."', '".
			   $this->mensagem."', '".
			   $this->data_forum."', '".
			   $this->hora."', '".
			   $this->situacao."',  ".
			   $this->visualizacoes." ) ";
			 
		$this->insere($sql);
	}
	
	function alterar($cod_forum, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   forum ".
			   " SET ".
			   "   cod_editor = ".$this->cod_editor.", ".
			   "   assunto = '".$this->assunto."', ".
			   "   mensagem = '".$this->mensagem."', ".
			   "   data_edicao = '".$this->data_edicao."', ".
			   "   hora_edicao = '".$this->hora_edicao."' ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function atualizaVisualizacoes($cod_forum, $cod_turma, $visualizacoes)
	{
		$sql = " UPDATE ".
			   "   forum ".
			   " SET ".
			   "   visualizacoes = ".$visualizacoes." ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function atualizaRespostas($cod_forum, $cod_turma, $respostas)
	{
		$sql = " UPDATE ".
			   "   forum ".
			   " SET ".
			   "   respostas = ".$respostas." ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_forum, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   forum ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_turma)
	{
		$sql = " SELECT ".
			   "   cod_forum, ".
			   "   cod_turma ".
			   " FROM ".
			   "   forum ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ".
			   "   data DESC, hora DESC ";

		$this->executar($sql);
	}
	
	function colecaoMensagens($cod_forum)
	{
	  $sql = " SELECT ".
			 "	 forum.cod_forum, ".
			 "   mensagem_forum.cod_mensagem, ".
			 "   mensagem_forum.cod_usuario, ".
			 "   mensagem_forum.data, ".
			 "   mensagem_forum.hora, ".
			 "   usuario.nome ".
			 " FROM ".
			 "   forum, ".
			 "   mensagem_forum, ".
			 "   usuario ".
			 " WHERE ".
			 "   forum.cod_forum = mensagem_forum.cod_forum ".
			 " AND ".
			 "   forum.cod_forum = ".$cod_forum.
			 " AND ".
			 "   mensagem_forum.cod_usuario = usuario.cod_usuario ".
			 " ORDER BY ".
			 "   mensagem_forum.cod_mensagem DESC ";
      
	  $this->executar($sql);
	}
	
	function paginacao($cod_forum, $limite, $inicial)
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
			   "      forum.cod_forum as codigo, ".
			   "      forum.assunto, ".
			   "      forum.mensagem, ".
			   "      forum.data, ".
			   "      forum.hora, ".
			   "      forum.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  forum, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  forum.cod_forum = ".$cod_forum.
			   "	AND ". 
			   "	  forum.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  mensagem_forum.cod_mensagem as codigo, ".
			   "      mensagem_forum.assunto, ".
			   "	  mensagem_forum.mensagem, ".
			   "	  mensagem_forum.data, ".
			   "	  mensagem_forum.hora, ".
			   "	  mensagem_forum.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  mensagem_forum, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  mensagem_forum.cod_forum = ".$cod_forum.
			   "	AND ".
		 	   "	  mensagem_forum.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ".
			   " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}

	function paginacaoForum($cod_turma, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   forum.cod_forum, ".
			   "   forum.cod_turma, ".
			   "   forum.cod_usuario, ".
			   "   forum.cod_editor, ".
			   "   forum.assunto, ".
			   "   forum.mensagem, ".
			   "   forum.data, ".
			   "   forum.hora, ".
			   "   forum.data_edicao, ".
			   "   forum.hora_edicao, ".
			   "   forum.situacao, ".
			   "   forum.visualizacoes, ".
			   "   forum.respostas, ".
			   "   usuario.nome ".
			   " FROM ".
			   "   forum, ".
			   "   usuario ".
			   " WHERE ".
			   "   forum.cod_turma = ".$cod_turma.
			   " AND ".
			   "   forum.cod_usuario = usuario.cod_usuario ";
			   
		if ($ordem == 1)
			$sql.= " ORDER BY forum.data DESC, forum.hora DESC ";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY forum.data ASC, forum.hora ASC ";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY usuario.nome DESC ";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY usuario.nome ASC ";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY forum.assunto DESC ";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY forum.assunto ASC ";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY forum.respostas DESC ";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY forum.respostas ASC ";
									else
										if ($ordem == 9)
											$sql.= " ORDER BY forum.visualizacoes DESC ";
										else
											if ($ordem == 10)
												$sql.= " ORDER BY forum.visualizacoes ASC ";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}

	function totalMensagens($cod_forum)
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
			   "      forum.cod_forum as codigo, ".
			   "      forum.assunto, ".
			   "      forum.mensagem, ".
			   "      forum.data, ".
			   "      forum.hora, ".
			   "      forum.situacao, ".
			   "      usuario.nome ".
			   "	FROM ".
			   "	  forum, ".
			   "	  usuario ".
			   "	WHERE ".
			   "	  forum.cod_forum = ".$cod_forum.
			   "	AND ". 
			   "	  forum.cod_usuario = usuario.cod_usuario ".
			   "	UNION ". 
		 	   "	SELECT ".
			   "	  mensagem_forum.cod_mensagem as codigo, ".
			   "      mensagem_forum.assunto, ".
			   "	  mensagem_forum.mensagem, ".
			   "	  mensagem_forum.data, ".
			   "	  mensagem_forum.hora, ".
			   "	  mensagem_forum.situacao, ".
			   "	  usuario.nome ".
			   "	FROM ".
			   "	  mensagem_forum, ".
			   "	  usuario ".
			   "	WHERE ".
		  	   "	  mensagem_forum.cod_forum = ".$cod_forum.
			   "	AND ".
		 	   "	  mensagem_forum.cod_usuario = usuario.cod_usuario ".
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
			   "   cod_forum, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   forum_usuario ".
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
	
	function acessoForum($cod_forum, $cod_usuario)
	{
		$sql = " INSERT INTO forum_usuario (".
			   "   cod_forum, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_forum.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
	
	function excluiAcessoForum($cod_forum)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   forum_usuario ".
			   " WHERE ".
			   "   cod_forum = ".$cod_forum;
		
		$this->insere($sql);
	}
}
?>