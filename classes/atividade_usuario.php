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

class atividade_usuario extends consulta
{
	//Campos
	var $cod_atividade;
	var $cod_usuario;
	var $nota;
	var $comentario;
	var $anexo;
	var $data_entrega;
	var $hora_entrega;
	var $data_correcao;
	var $hora_correcao;
	var $situacao;
	
	//Construtor
	function atividade_usuario()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigoAtividade()
	{
		return $this->cod_atividade;
	}
	
	function setCodigoAtividade($cod_atividade)
	{
		$this->cod_atividade = $cod_atividade;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}
	
	function setCodigoUsuario($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
	}
	
	function getNota()
	{
	  	return $this->nota;
	}
	
	function setNota($nota)
	{
	  	$this->nota = $nota;
	}
	
	function getComentario()
	{
	  	return $this->comentario;
	}
	
	function setComentario($comentario)
	{
	  	$this->comentario = $comentario;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function getAnexo()
	{
	  	return $this->anexo;
	}
	
	function setAnexo($anexo)
	{
	  	$this->anexo = $anexo;
	}
	
	function getDataEntrega()
	{
	  	return $this->data_entrega;
	}
	
	function setDataEntrega($data_entrega)
	{
	  	$this->data_entrega = $data_entrega;
	}
	
	function getHoraEntrega()
	{
	  	return $this->hora_entrega;
	}
	
	function setHoraEntrega($hora_entrega)
	{
	  	$this->hora_entrega = $hora_entrega;
	}	
	
	function getDataCorrecao()
	{
	  	return $this->data_correcao;
	}
	
	function setDataCorrecao($data_correcao)
	{
	  	$this->data_correcao = $data_correcao;
	}
	
	function getHoraCorrecao()
	{
	  	return $this->hora_correcao;
	}
	
	function setHoraCorrecao($hora_correcao)
	{
	  	$this->hora_correcao = $hora_correcao;
	}
	
	function getSituacao()
	{
	  	return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
	  	$this->situacao = $situacao;
	}
	
	function carregar($cod_atividade, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_usuario, ".
			   "   nota, ".
			   "   comentario, ".
			   "   descricao, ".
			   "   anexo, ".
			   "   data_entrega, ".
			   "   hora_entrega, ".
			   "   data_correcao, ".
			   "   hora_correcao, ".
			   "   situacao ".
			   " FROM ".
			   "   atividade_usuario ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->cod_atividade = $this->data["cod_atividade"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->nota = $this->data["nota"];
		$this->comentario = $this->data["comentario"];
		$this->descricao = $this->data["descricao"];
		$this->anexo = $this->data["anexo"];
		$this->data_entrega = $this->data["data_entrega"];
		$this->hora_entrega = $this->data["hora_entrega"];
		$this->data_correcao = $this->data["data_correcao"];
		$this->hora_correcao = $this->data["hora_correcao"];
		$this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO atividade_usuario (".
			   "   cod_atividade, ".
			   "   cod_usuario, ".
			   "   nota,".
			   "   comentario, ".
			   "   descricao, ".
			   "   anexo, ".
			   "   data_entrega, ".
			   "   hora_entrega, ".
			   "   data_correcao, ".
			   "   hora_correcao, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_atividade.", ".
			   $this->cod_usuario.", '".
			   $this->nota."', '".
			   $this->comentario."', '".
			   $this->descricao."', '".
			   $this->anexo."', '".
			   $this->data_entrega."', '".
			   $this->hora_entrega."', '".
			   $this->data_correcao."', '".
			   $this->hora_correcao."', '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterarAnexo($cod_atividade, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   atividade_usuario ".
			   " SET ".
			   "   anexo = '".$this->anexo."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   data_entrega = '".$this->data_entrega."', ".
			   "   hora_entrega = '".$this->hora_entrega."' ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  

		$this->insere($sql);
	}
	
	function alterarComentario($cod_atividade, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   atividade_usuario ".
			   " SET ".
			   "   comentario = '".$this->comentario."' ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
		
		$this->insere($sql);
	}
	
	function alterarNota($cod_atividade, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   atividade_usuario ".
			   " SET ".
			   "   nota = '".$this->nota."', ".
			   "   data_correcao = '".$this->data_correcao."', ".
			   "   hora_correcao = '".$this->hora_correcao."', ".
			   "   situacao = '".$this->situacao."' ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
		
		$this->insere($sql);
	}
	
	function excluir($cod_atividade, $cod_usuario)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   atividade_usuario ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->insere($sql);
	}	
		
	function colecao($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   atividade_usuario ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
	}
	
	function colecaoAtividade($cod_atividade)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   atividade_usuario ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade;
		
		$this->executar($sql);
	}
	
	function paginacaoAtividadesEntregues($cod_turma, $cod_atividade, $limite, $inicio, $ordem, $filtro)
	{
		$sql = " SELECT ".
 			   "   usuario.cod_usuario, ".
 			   "   usuario.nome, ".
 			   "   atividade_usuario.cod_atividade, ".
			   "   atividade_usuario.anexo, ".
   			   "   atividade_usuario.descricao, ".
 			   "   atividade_usuario.comentario, ".
 			   "   atividade_usuario.nota, ".
 			   "   atividade_usuario.data_entrega, ".
 			   "   atividade_usuario.hora_entrega, ".
 			   "   atividade_usuario.data_correcao, ".
 			   "   atividade_usuario.hora_correcao, ".
 			   "   atividade_usuario.situacao ".
			   " FROM ".
 			   "   usuario, ".
 			   "   usuario_turma ".
			   " LEFT JOIN ".
 			   "   atividade_usuario ".
			   " ON ".
			   "   atividade_usuario.cod_usuario = usuario.cod_usuario ".
			   " AND ".
			   "   atividade_usuario.cod_atividade = ".$cod_atividade.
			   " WHERE ".
 			   "   usuario_turma.cod_usuario = usuario.cod_usuario ".
			   " AND ".
  			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
 			   "   usuario_turma.acesso = 'L' ";
		
		if ($filtro == "E")
		{
			$sql.= " AND atividade_usuario.situacao != ''";
	
		}
		else
			if ($filtro == "N")
			{
				$sql.= " AND atividade_usuario.situacao IS NULL";
			}
			else
				if ($filtro == "C")
				{
					$sql.= " AND atividade_usuario.situacao = 'C'";
				}
				else
					if ($filtro == "A")
					{
						$sql.= " AND atividade_usuario.situacao = 'A'";
					}
					else
						if ($filtro == "R")
						{
							$sql.= " AND atividade_usuario.situacao = 'R'";
						}
		
		$sql.= " GROUP BY ".
 			   "   usuario.cod_usuario ";

		if ($ordem == 1)
			$sql.= " ORDER BY usuario.nome ASC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY usuario.nome DESC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY CAST(atividade_usuario.nota AS BINARY) ASC, usuario.nome ASC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY CAST(atividade_usuario.nota  AS BINARY) DESC, usuario.nome ASC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY atividade_usuario.data_entrega ASC, atividade_usuario.hora_entrega ASC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY atividade_usuario.data_entrega DESC, atividade_usuario.hora_entrega DESC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY atividade_usuario.data_correcao ASC, atividade_usuario.hora_correcao ASC";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY atividade_usuario.data_correcao DESC, atividade_usuario.hora_correcao DESC";
								
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicio;

		$this->executar($sql);
	}
	
	function paginacao($cod_atividade, $limite, $inicial)
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
			   "      atividade.cod_atividade as codigo, ".
			   "      atividade.assunto, ".
			   "      atividade.mensagem, ".
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
		  	   "	  mensagem.cod_atividade = ".$cod_atividade.
			   "	AND ".
		 	   "	  mensagem.cod_usuario = usuario.cod_usuario ".
			   "	) as consulta".
			   " ORDER BY ".
			   "   data, hora ASC ".
			   " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function verificaAcesso($cod_atividade, $cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   atividades_usuario ".
			   " WHERE ".
			   "   cod_atividade = ".$cod_atividade.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		if ($this->linhas == 0)
			$retorno = "false";
		else
			$retorno = "true";
			
		return $retorno;
	}
	
	function acessoAtividade($cod_atividade, $cod_usuario)
	{
		$sql = " INSERT INTO atividades_usuario (".
			   "   cod_atividade, ".
			   "   cod_usuario ".
			   " ) VALUES (".
			   $cod_atividade.", ".
			   $cod_usuario." ) ";
			 
		$this->insere($sql);
	}
}
?>