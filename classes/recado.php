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

class recado extends consulta
{
	//Campos
	var $codigo;
	var $cod_autor;
	var $destinatario;
	var $assunto;
	var $mensagem;
	var $data_recado;
	var $hora;
	var $pasta;
	
	//Construtor
	function recado()
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
	
	function getCodigoAutor()
	{
		return $this->cod_autor;
	}
	
	function setCodigoAutor($cod_autor)
	{
	  	$this->cod_autor = $cod_autor;
	}
	
	function getDestinatario()
	{
	  	return $this->destinatario;
	}
	
	function setDestinatario($destinatario)
	{
	  	$this->destinatario = $destinatario;
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
	
	function getDataRecado()
	{
	  	return $this->data_recado;
	}
	
	function setDataRecado($data_recado)
	{
	 	$this->data_recado = $data_recado;
	}
	
	function getHora()
	{
	  	return $this->hora;
	}
	
	function setHora($hora)
	{
	  	$this->hora = $hora;
	}
		
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   cod_recado, ".
			   "   cod_autor, ".
			   "   assunto, ".
			   "   destinatario, ".
			   "   mensagem, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   recado ".
			   " WHERE ".
			   "   recado.cod_recado = ".$codigo;
			 
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_recado"];
		$this->cod_autor = $this->data["cod_autor"];
		$this->destinatario = $this->data["destinatario"];
		$this->assunto = $this->data["assunto"];
		$this->mensagem = $this->data["mensagem"];
		$this->data_recado = $this->data["data"];
		$this->hora = $this->data["hora"];
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_recado, ".
			   "   cod_autor, ".
			   "   destinatario, ".
			   "   assunto, ".
			   "   mensagem, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   recado ".
			   " WHERE ".
			   "   cod_autor = ".$this->cod_autor.
			   " AND ".
			   "   assunto = '".$this->assunto."' ".
			   " AND ".
			   "   data = '".$this->data_recado."' ".
			   " AND ".
			   "   hora = '".$this->hora."' ";
			 
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_recado"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->destinatario = $this->data["destinatario"];
		$this->nome_usuario = $this->data["nome_usuario"];
		$this->assunto = $this->data["assunto"];
		$this->mensagem = $this->data["mensagem"];
		$this->data_recado = $this->data["data"];
		$this->hora = $this->data["hora"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO recado (".
			   "   cod_autor, ".
			   "   assunto, ".
			   "   destinatario, ".
			   "   mensagem, ".
			   "   data, ".
			   "   hora ".
			   " ) VALUES (".
			   $this->cod_autor.", '".
			   $this->assunto."', '".
			   $this->destinatario."', '".
			   $this->mensagem."', '".
			   $this->data_recado."', '".
			   $this->hora."' ) ";

		$this->insere($sql);
	}
	
	function recadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao)
	{
		$sql = " INSERT INTO recado_usuario (".
			   "   cod_recado, ".
			   "   cod_usuario,".
			   "   cod_turma, ".
			   "   pasta, ".
			   "   situacao ".
			   " ) VALUES (".
			   $cod_recado.", ".
			   $cod_usuario.", ".
			   $cod_turma.", '".
			   $pasta."', '".
			   $situacao."' ) ";
			   
		$this->insere($sql);
	}
	
	function alterarPastaRecado($cod_recado, $cod_usuario, $cod_turma, $pasta, $origem)
	{
		$sql = " UPDATE ".
			   "   recado_usuario ".
			   " SET ".
			   "   pasta = '".$pasta."' ".        
			   " WHERE ".
			   "   cod_recado = ".$cod_recado.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   pasta = '".$origem."' ";
		
		$this->insere($sql);
	}
	
	function alterarSituacaoRecado($cod_recado, $cod_usuario, $cod_turma, $pasta, $situacao)
	{
		$sql = " UPDATE ".
			   "   recado_usuario ".
			   " SET ".
			   "   situacao = '".$situacao."' ".        
			   " WHERE ".
			   "   cod_recado = ".$cod_recado.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   pasta = '".$pasta."' ";
		  
		$this->insere($sql);
	}
	
	function alterar($cod_recado)
	{
		$sql = " UPDATE ".
			   "   recado ".
			   " SET ".
			   "   cod_autor = ".$this->cod_usuario.", ".
			   "   assunto = '".$this->assunto."', ".
			   "   mensagem = '".$this->mensagem."', ".
			   "   data = '".$this->data_recado."', ".
			   "   hora = '".$this->hora."', ".        
			   " WHERE ".
			   "   cod_recado = ".$cod_recado;
		
		$this->insere($sql);
	}
	
	function excluir($cod_recado)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   recado ".
			   " WHERE ".
			   "   cod_recado = ".$cod_recado;
		
		$this->insere($sql);
	}
	
	function excluirRecadoDestinatario($cod_recado, $cod_usuario, $cod_turma, $pasta)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   recado_usuario ".
			   " WHERE ".
			   "   cod_recado = ".$cod_recado.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   pasta = '".$pasta."' ";

		$this->insere($sql);
	}	
		
	function colecaoRecado($cod_usuario, $cod_turma, $pasta)
	{
		$sql = " SELECT ".
			   "   recado_usuario.cod_recado, ".
			   "   recado_usuario.cod_usuario, ".
			   "   recado_usuario.cod_turma, ".
			   "   recado_usuario.pasta, ".
			   "   recado_usuario.situacao ".
			   " FROM ".
			   "   recado_usuario, ".
			   "   recado ".
			   " WHERE ".
			   "   recado.cod_recado = recado_usuario.cod_recado ".
			   " AND ".
			   "   recado_usuario.cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   recado_usuario.pasta = '".$pasta."' ";
			   
		if ($cod_turma != "")
		{
			$sql.= " AND ".
			       "   recado_usuario.cod_turma = ".$cod_turma;
		}
			$sql.= " ORDER BY recado.data DESC, recado.hora DESC";
			   		
		$this->executar($sql);
	}
	
	function colecaoRecadoNaoLido($cod_usuario, $cod_turma, $pasta)
	{
		$sql = " SELECT ".
			   "   recado_usuario.cod_recado, ".
			   "   recado_usuario.cod_usuario, ".
			   "   recado_usuario.cod_turma, ".
			   "   recado_usuario.pasta, ".
			   "   recado_usuario.situacao ".
			   " FROM ".
			   "   recado_usuario, ".
			   "   recado ".
			   " WHERE ".
			   "   recado.cod_recado = recado_usuario.cod_recado ".
			   " AND ".
			   "   recado_usuario.cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   recado_usuario.pasta = '".$pasta."' ".
			   " AND ".
			   "   recado_usuario.cod_turma = ".$cod_turma.
			   " AND ".
			   "   recado_usuario.situacao = 'N' ".			   
			   " ORDER BY ".
			   "   recado.data DESC, recado.hora DESC";
		
		$this->executar($sql);
	}
	
	function paginacao($cod_usuario, $cod_turma, $pasta, $limite, $inicio, $ordem)
	{
		$sql = " SELECT ".
			   "   usuario.nome, ".
			   "   recado.cod_autor, ".
			   "   recado.data, ".
			   "   recado.hora, ".
			   "   recado.assunto, ".
			   "   recado_usuario.cod_recado, ".
			   "   recado_usuario.cod_usuario, ".
			   "   recado_usuario.cod_turma, ".
			   "   recado_usuario.pasta, ".
			   "   recado_usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   recado_usuario, ".
			   "   recado ".
			   " WHERE ".
			   "   recado.cod_recado = recado_usuario.cod_recado ".
			   " AND ".
			   "   recado_usuario.cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   usuario.cod_usuario = recado.cod_autor".
			   " AND ".
			   "   recado_usuario.pasta = '".$pasta."' ";
			   
		if ($cod_turma != "")
		{
			$sql.= " AND ".
			       "   recado_usuario.cod_turma = ".$cod_turma;
		}
		
		if ($ordem == 1)
			$sql.= " ORDER BY recado.data DESC, recado.hora DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY recado.data ASC, recado.hora ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY recado_usuario.situacao ASC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY recado_usuario.situacao DESC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY recado.assunto DESC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY recado.assunto ASC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY usuario.nome ASC";
								else
									if ($ordem == 8)
										$sql.= " ORDER BY usuario.nome DESC";
						
			
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicio;
		
		$this->executar($sql);
	}
	
	function colecaoDestinatarios($cod_recado, $cod_turma, $pasta)
	{
		$sql = " SELECT ".
			   "   recado_usuario.cod_recado, ".
			   "   recado_usuario.cod_usuario, ".
			   "   recado_usuario.cod_turma ".
			   " FROM ".
			   "   recado_usuario, ".
			   "   recado ".
			   " WHERE ".
			   "   recado.cod_recado = recado_usuario.cod_recado ".
			   " AND ".
			   "   recado_usuario.cod_recado = ".$cod_recado;
			   
		if ($cod_turma != "")
		{
			$sql.= " AND ".
				   "   recado_usuario.cod_turma = ".$cod_turma;
		}
			$sql.= " AND ".
			   	   "   pasta = '".$pasta."' ";
			   
		$this->executar($sql);
	}
	
	function qtdeMsgsPasta($cod_usuario, $cod_turma, $pasta)
	{
		$sql = " SELECT ".
			   "   pasta as situacao, ".
			   "   count(pasta) as qtde ".
			   " FROM ".
			   "   recado_usuario ".
			   " WHERE ".
			   "   pasta = '".$pasta."' ".
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " GROUP BY ".
			   "   pasta ".
			   " UNION ".
			   " SELECT ".
			   "   situacao, ".
			   "   count(situacao) as qtde ".
			   " FROM ".
			   "   recado_usuario ".
			   " WHERE ".
			   "   situacao = 'N' ".
			   " AND ".
			   "   pasta = '".$pasta."' ".
			   " AND ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " GROUP BY ".
			   "  situacao ";
		 
		$this->executar($sql);
	}
	
	function verificaDependencia($cod_recado)
	{
		$sql = " SELECT ".
			   "   cod_recado, ".
			   "   cod_usuario ".
			   " FROM ".
			   "   recado_usuario ".
			   " WHERE ".
			   "   cod_recado = ".$cod_recado;

		$this->executar($sql);
	}
}
?>