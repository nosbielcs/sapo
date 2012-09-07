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

class conteudo extends consulta
{
	//Campos
	var $cod_conteudo;
	var $cod_turma;
	var $cod_usuario;
	var $cod_hierarquia;
	var $nome;
	var $descricao;
	var $tamanho;
	var $tipo;
	var $protegido;
	var $principal;
	var $data_conteudo;
	var $hora_conteudo;
	
	//Construtor
	function conteudo()
	{
		$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
		return $this->cod_conteudo;
	}
	
	function setCodigo($codigo)
	{
		$this->cod_conteudo = $codigo;
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
	
	function getCodigoHierarquia()
	{
	  	return $this->cod_hierarquia;
	}
	
	function setCodigoHierarquia($cod_hierarquia)
	{
		$this->cod_hierarquia = $cod_hierarquia;
	}
	
	function getNome()
	{
	  	return $this->nome;
	}
	
	function setNome($nome)
	{
	  	$this->nome = $nome;
	}
	
	function getDescricao()
	{
	  	return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function setTamanho($tamanho)
	{
	  	$this->tamanho = $tamanho;
	}
	
	function getTamanho()
	{
	  	return $this->tamanho;
	}
	
	function getTipo()
	{
	  	return $this->tipo;
	}
	
	function setTipo($tipo)
	{
	  	$this->tipo = $tipo;
	}
	
	function getProtegido()
	{
	  	return $this->protegido;
	}
	
	function setProtegido($protegido)
	{
	  	$this->protegido = $protegido;
	}
	
	function getPrincipal()
	{
	  	return $this->principal;
	}
	
	function setPrincipal($principal)
	{
	  	$this->principal = $principal;
	}
	
	function getDataConteudo()
	{
	  	return $this->data_conteudo;
	}
	
	function setDataConteudo($data_conteudo)
	{
	  	$this->data_conteudo = $data_conteudo;
	}
	
	function getHoraConteudo()
	{
	  	return $this->hora_conteudo;
	}
	
	function setHoraConteudo($hora_conteudo)
	{
	  	$this->hora_conteudo = $hora_conteudo;
	}	
		
	function carregar($codigo)
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   cod_hierarquia, ".
			   "   nome, ".
			   "   descricao, ".
			   "   tamanho, ".
			   "   tipo, ".
			   "   protegido, ".
			   "   principal, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   conteudo ".
			   " WHERE ".
			   "   cod_conteudo = ".$codigo;
		
		$this->executar($sql);
		
		$this->cod_conteudo = $this->data["cod_conteudo"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_hierarquia = $this->data["cod_hierarquia"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->tamanho = $this->data["tamanho"];
		$this->tipo = $this->data["tipo"];
		$this->protegido = $this->data["protegido"];
		$this->principal = $this->data["principal"];
		$this->data_conteudo = $this->data["data"];
		$this->hora_conteudo = $this->data["hora"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO conteudo (".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   cod_hierarquia, ".
			   "   nome,".
			   "   descricao, ".
			   "   tamanho, ".
			   "   tipo, ".
			   "   protegido, ".
			   "   principal, ".
			   "   data, ".
			   "   hora ".
			   " ) VALUES (".
			   $this->cod_turma.", ".
			   $this->cod_usuario.", ".
			   $this->cod_hierarquia.", '".
			   $this->nome."', '".
			   $this->descricao."', ".
			   $this->tamanho.", '".
			   $this->tipo."', '".
			   $this->protegido."', '".
			   $this->principal."', '".
			   $this->data_conteudo."', '".
			   $this->hora_conteudo."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_conteudo, $cod_turma)
	{
		$sql = " UPDATE ".
			   "   conteudo ".
			   " SET ".
			   "   cod_usuario = ".$this->cod_usuario.", ".
			   "   cod_hierarquia = ".$this->cod_hierarquia.", ".
			   "   descricao = '".$this->descricao."', ".
			   "   tipo = '".$this->tipo."', ".
			   "   protegido = '".$this->protegido."', ".
			   "   principal = '".$this->principal."' ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_turma = ".$cod_turma;  

		$this->insere($sql);
	}
	
	function excluir($cod_conteudo, $cod_turma)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   conteudo ".
			   " WHERE ".
			   "   cod_conteudo = ".$cod_conteudo.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		
		$this->insere($sql);
	}	
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   cod_hierarquia, ".
			   "   nome, ".
			   "   descricao, ".
			   "   tipo, ".
			   "   protegido, ".
			   "   principal, ".
			   "   tamanho, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   conteudo ".
			   " WHERE ".
			   "   cod_turma = ".$this->cod_turma.
			   " AND ".
			   "   cod_usuario = ".$this->cod_usuario.
			   " AND ".
			   "   cod_hierarquia = ".$this->cod_hierarquia.
			   " AND ".
			   "   nome = '".$this->nome."' ".
			   " AND ".
			   "   descricao = '".$this->descricao."' ".
			   " AND ".
			   "   tipo = '".$this->tipo."' ".
			   " AND ".
			   "   protegido = '".$this->protegido."' ".
			   " AND ".
			   "   principal = '".$this->principal."' ".
			   " AND ".
			   "   tamanho = ".$this->tamanho." ".
			    " AND ".
			   "   data = '".$this->data_conteudo."' ".
			   " AND ".
			   "   hora = '".$this->hora_conteudo."' ";
		
		$this->executar($sql);
		
		$this->cod_conteudo = $this->data["cod_conteudo"];
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->cod_hierarquia = $this->data["cod_hierarquia"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->tipo = $this->data["tipo"];
		$this->protegido = $this->data["protegido"];
		$this->principal = $this->data["principal"];
		$this->tamanho = $this->data["tamanho"];
		$this->data_conteudo = $this->data["data_conteudo"];
		$this->hora_conteudo = $this->data["hora_conteudo"];
	}
		
	function colecao($cod_turma, $principal)
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_turma ".
			   " FROM ".
			   "   conteudo ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " ORDER BY ";
			   
		if (!empty($principal))
		{
			$sql.= " AND ".
				   " principal = '".$principal."'";
		}
		
		$sql.= "   tipo DESC, data DESC, hora DESC ";

		$this->executar($sql);
	}
	
	function paginacao($cod_turma, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_conteudo, ".
			   "   cod_turma, ".
			   "   cod_usuario, ".
			   "   cod_hierarquia, ".
			   "   nome, ".	
			   "   descricao, ". 
			   "   tamanho, ".
			   "   tipo, ".
			   "   protegido, ".
			   "   principal, ".
			   "   data, ".
			   "   hora ".
			   " FROM ".
			   "   conteudo ".
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;
		
		if ($ordem == 1)
			$sql.= " ORDER BY data DESC, hora DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY data ASC, hora ASC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY descricao DESC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY descricao ASC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY tamanho DESC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY tamanho ASC";
							else
								if ($ordem == 7)
									$sql.= " ORDER BY cod_conteudo ASC, cod_hierarquia ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function arvoreConteudos($cod_turma, $opcao = 1, $cod_hierarquia = 0, $espaco = '', $excluir = '', $arvore_conteudos = '') 
    {
		if (!is_array($arvore_conteudos)) 
			$arvore_conteudos = array();

        $sql = " SELECT ". 
               "   cod_conteudo, ".
	           "   cod_turma, ".
			   "   cod_hierarquia, ".
			   "   nome, ". 
			   "   descricao, ".
			   "   tipo ".
	           " FROM ". 
	           "   conteudo ".
	           " WHERE ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
	           "   cod_hierarquia = ".$cod_hierarquia.
	           " ORDER BY ".
	           "   cod_conteudo ASC, cod_hierarquia ASC ";

		$qry = mysql_query($sql);
		while ($resultado = mysql_fetch_array($qry))
		{
			$cod_conteudo = $resultado["cod_conteudo"];
			
			if ($opcao == 1)
			{
				$arvore_conteudos[] = array("cod_conteudo" => $resultado["cod_conteudo"], "cod_hierarquia" => $resultado["cod_hierarquia"], "descricao" => $resultado["descricao"], "tipo" => $resultado["tipo"]);
            	$arvore_conteudos = $this->arvoreConteudos($cod_turma, $opcao, $resultado["cod_conteudo"], $espaco, $excluir, $arvore_conteudos);
			}
			else
			{
				$arvore_conteudos[] = array("cod_conteudo" => $resultado["cod_conteudo"], "cod_hierarquia" => $resultado["cod_hierarquia"], "descricao" => $espaco.$resultado["descricao"], "tipo" => $resultado["tipo"]);
            	$arvore_conteudos = $this->arvoreConteudos($cod_turma, $opcao, $resultado["cod_conteudo"], "&nbsp;&nbsp;&nbsp;", $excluir, $arvore_conteudos);
			}
		}
		
      	return $arvore_conteudos;
    }
}
?>