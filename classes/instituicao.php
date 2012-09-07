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

class instituicao extends consulta
{
	//Campos
	var $cod_inst;
	var $nome;
	var $descricao;
	var $email;
	var $site;
	var $endereco;
	var $cep;
	var $telefone;
	var $cidade;
	var $uf;
	var $pais;
	var $imagem;
	
	//Construtor
	function instituicao()
	{
	   $this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
	  	return $this->cod_inst;
	}
	
	function setCodigo($cod_inst)
	{
	  	$this->cod_inst = $cod_inst;
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
	
	function getEmail()
	{
	  	return $this->email;
	}
	
	function setEmail($email)
	{
	  	$this->email = $email;
	}
	
	function getSite()
	{
	  	return $this->site;
	}
	
	function setSite($site)
	{
	  	$this->site = $site;
	}
	
	function getEndereco()
	{
	  	return $this->endereco;
	}
	
	function setEndereco($endereco)
	{
	  	$this->endereco = $endereco;
	}
	
	function getCEP()
	{
	  	return $this->cep;
	}
	
	function setCEP($cep)
	{
	  	$this->cep = $cep;
	}
	
	function getTelefone()
	{
	  	return $this->telefone;
	}
	
	function setTelefone($telefone)
	{
	  	$this->telefone = $telefone;
	}
	
	function getCidade()
	{
	  	return $this->cidade;
	}
	
	function setCidade($cidade)
	{
	  	$this->cidade = $cidade;
	}
	
	function getUF()
	{
	  	return $this->uf;
	}
	
	function setUF($uf)
	{
		$this->uf = $uf;
	}
	
	function getPais()
	{
	  	return $this->pais;
	}
	
	function setPais($pais)
	{
		$this->pais = $pais;
	}
	
	function getImagem()
	{
	  	return $this->imagem;
	}
	
	function setImagem($imagem)
	{
		$this->imagem = $imagem;
	}
	
	function carregar($cod_inst)
	{
		$sql = " SELECT ".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao, ".
			   "   email, ".
			   "   site, ".
			   "   endereco, ".
			   "   cep, ".
			   "   telefone, ".
			   "   cidade, ".
			   "   uf, ".
			   "   pais, ".
			   "   imagem ".
			   " FROM ".
			   "   instituicao ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst;
		
		$this->executar($sql);
		
		$this->cod_inst = $this->data["cod_inst"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->email = $this->data["email"];
		$this->site = $this->data["site"];
		$this->endereco = $this->data["endereco"];
		$this->cep = $this->data["cep"];
		$this->telefone = $this->data["telefone"];
		$this->cidade = $this->data["cidade"];
		$this->uf = $this->data["uf"];
		$this->pais = $this->data["pais"];
		$this->imagem = $this->data["imagem"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO instituicao (".
			   "   nome, ".
			   "   descricao,".
			   "   email, ".
			   "   site, ".
			   "   endereco, ".
			   "   cep, ".
			   "   telefone, ".
			   "   cidade, ".
			   "   uf, ".
			   "   pais, ".
			   "   imagem ".
			   " ) VALUES ('".
			   $this->nome."', '".
			   $this->descricao."', '".
			   $this->email."', '".
			   $this->site."', '".
			   $this->endereco."', '".
			   $this->cep."', '".
			   $this->telefone."', '".
			   $this->cidade."', '".
			   $this->uf."', '".
			   $this->pais."', '";
			   $this->imagem."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_inst)
	{
		$sql = " UPDATE ".
			   "   instituicao ".
			   " SET ".
			   "   nome = '".$this->nome."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   email = '".$this->email."', ".
			   "   site = '".$this->site."', ".
			   "   endereco = '".$this->endereco."', ".
			   "   cep = '".$this->cep."', ".
			   "   telefone = '".$this->telefone."', ".
			   "   cidade = '".$this->cidade."', ".
			   "   uf = '".$this->uf."', ".
			   "   pais = '".$this->pais."', ". 
			   "   imagem = '".$this->imagem."' ".        
			   " WHERE ".
			   "   cod_inst = ".$cod_inst;
		
		$this->insere($sql);
	}
	
	function excluir($cod_inst)
	{
		$sql = " DELETE ".
			   " FROM ".
			   "   instituicao ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst;
		
		$this->insere($sql);
	}	
		
	function colecao()
	{
		$sql = " SELECT ".
			   "   cod_inst ".
			   " FROM ".
			   "   instituicao ".
			   " ORDER BY ".
			   "   nome ASC";
		
		$this->executar($sql);
	}
	
	function paginacaoInstituicao($limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   instituicao.cod_inst, ".
			   "   instituicao.nome, ".
			   "   ( SELECT ".
			   "       count(*) ".
			   "	 FROM ".
			   "       curso ".
			   "     WHERE curso.cod_inst = instituicao.cod_inst ".
			   "   ) AS total_curso, ".
			   "   ( SELECT ".
			   "        count(*) ".
			   "      FROM ".
			   "        suporte ".
			   "      WHERE suporte.cod_inst = instituicao.cod_inst ".
			   "    ) AS total_solicitacao ".
			   "      FROM ".
			   "        instituicao ";
		
		if ($ordem == 1)
			$sql.= " ORDER BY nome ASC ";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY nome DESC ";
								
		$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function recpueraCodigo()
	{
		$sql = " SELECT ".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao, ".
			   "   email, ".
			   "   site, ".
			   "   endereco, ".
			   "   cep, ".
			   "   telefone, ".
			   "   cidade, ".
			   "   uf, ".
			   "   pais, ".
			   "   imagem ".
			   " FROM ".
			   "   instituicao ".
			   " WHERE ".
			   "   nome = '".$this->nome."' ".
			   " AND ".
			   "   descricao = '".$this->descricao."' ".
			   " AND ".
			   "   email = '".$this->email."' ".
			   " AND ".
			   "   site = '".$this->site."' ".
			   " AND ".
			   "   endereco = '".$this->endereco."' ".
			   " AND ".
			   "   cep = '".$this->cep."' ".
			   " AND ".
			   "   telefone = '".$this->telefone."' ".
			   " AND ".
			   "   cidade = '".$this->cidade."' ".
			   " AND ".
			   "   uf = '".$this->uf."' ".
			   " AND ".
			   "   pais = '".$this->pais."' ".
			   " AND ".
			   "   imagem = '".$this->imagem."' ";
		
		$this->executar($sql);
		
		$this->cod_inst = $this->data["cod_inst"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->email = $this->data["email"];
		$this->site = $this->data["site"];
		$this->endereco = $this->data["endereco"];
		$this->cep = $this->data["cep"];
		$this->telefone = $this->data["telefone"];
		$this->cidade = $this->data["cidade"];
		$this->uf = $this->data["uf"];
		$this->pais = $this->data["pais"];
		$this->imagem = $this->data["imagem"];
	}
}
?>