<?php
/*
=====================================================================
#  PROJETO: Sapo                                                    #
#  FUNCA�O ECUM�ICA DE PROTE�O AO EXCEPCIONAL                       #
#                                                                   #
#  Programa�o                                                       #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

class inscrito_curso extends consulta
{
	//Campos
	var $codigo;
	var $cod_curso;
	var $nome;
	var $cpf;
	var $sexo;
	var $endereco;
	var $cidade;
	var $bairro;
	var $uf;
	var $data_nasc;
	var $cep;
	var $telefone;
	var $celular;
	var $email;
	var $perfil;
	var $instituicao;
	var $area;
	var $curso;
	var $data_usuario;
	var $hora;
	
	//construtor
	function inscrito_curso()
	{
	   $this->consulta(); //heranca
	}
	
	function getCodigo()
	{
		return $this->codigo;
	}
	
	function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}
	
	function getCodigoCurso()
	{
		return $this->cod_curso;
	}
	
	function setCodigoCurso($cod_curso)
	{
		$this->cod_curso = $cod_curso;
	}
	
	function getNome()
	{
		return $this->nome;
	}
	
	function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	function getCPF()
	{
		return $this->cpf;
	}
	
	function setCPF($cpf)
	{
		$this->cpf = $cpf;
	}
	
	function getSexo()
	{
		return $this->sexo;
	}
	
	function setSexo($sexo)
	{
		$this->sexo = $sexo;
	}
	
	function getEndereco()
	{
		return $this->endereco;
	}
	
	function setEndereco($endereco)
	{
		$this->endereco = $endereco;
	}
	
	function getCidade()
	{
		return $this->cidade;
	}
	
	function setCidade($cidade)
	{
		$this->cidade = $cidade;
	}
	
	function getBairro()
	{
		return $this->bairro;
	}
	
	function setBairro($bairro)
	{
		$this->bairro = $bairro;
	}
	
	function getUF()
	{
		return $this->uf;
	}
	
	function setUF($uf)
	{
		$this->uf = $uf;
	}
	
	function setDataNasc($data_nasc)
	{
	  	$this->data_nasc = $data_nasc;
	}
	
	function getDataNasc()
	{
	  	return $this->data_nasc;
	}
	
	function setCEP($cep)
	{
	  	$this->cep = $cep;
	}
	
	function getCEP()
	{
	  	return $this->cep;
	}
	
	function setTelefone($telefone)
	{
	  	$this->telefone = $telefone;
	}
	
	function getTelefone()
	{
	  	return $this->telefone;
	}
	
	function setCelular($celular)
	{
	  	$this->celular = $celular;
	}
	
	function getCelular()
	{
	  	return $this->celular;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function setEmail($email)
	{
		$this->email = $email;
	}
	
	function getPerfil()
	{
		return $this->perfil;
	}
	
	function setPerfil($perfil)
	{
		$this->perfil = $perfil;
	}
	
	function setInstituicao($instituicao)
	{
	  	$this->instituicao = $instituicao;
	}
	
	function getInstituicao()
	{
	  	return $this->instituicao;
	}
	
	function getArea()
	{
		return $this->area;
	}
	
	function setArea($area)
	{
		$this->area = $area;
	}
	
	function getCurso()
	{
		return $this->curso;
	}
	
	function setCurso($curso)
	{
		$this->curso = $curso;
	}
	
	function getDataUser()
	{
		return $this->data_usuario;
	}
	
	function setDataUser($data_usuario)
	{
		$this->data_usuario = $data_usuario;
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
			   "   cod_inscr, ".
			   "   cod_cur, ".
			   "   nome, ".
			   "   cpf, ".
			   "   sexo, ".
			   "   endereco, ".
			   "   cidade, ".
			   "   bairro, ".
			   "   uf, ".
			   "   data_nasc, ". 
			   "   cep, ".
			   "   telefone, ".
			   "   celular, ".
			   "   email, ".
			   "   perfil, ".
			   "   instituicao, ".
			   "   area, ".
			   "   curso ".
			   " FROM ".
			   "   inscritos ".
			   " WHERE ".
			   "   cod_inscr = ".$codigo;
		
		$this->executar($sql);
		
		$this->codigo = $this->data["cod_inscr"];
		$this->cod_curso = $this->data["cod_cur"];
		$this->nome = $this->data["nome"];
		$this->cpf = $this->data["cpf"];
		$this->sexo = $this->data["sexo"];
		$this->endereco = $this->data["endereco"];
		$this->cidade = $this->data["cidade"];
		$this->bairro = $this->data["bairro"];
		$this->uf = $this->data["uf"];
		$this->data_nasc = $this->data["data_nasc"];
		$this->cep = $this->data["cep"];
		$this->telefone = $this->data["telefone"];
		$this->celular = $this->data["celular"];
		$this->email = $this->data["email"];
		$this->perfil = $this->data["perfil"];
		$this->instituicao = $this->data["instituicao"];
		$this->area = $this->data["area"];
		$this->curso = $this->data["curso"];
	}
	
	function colecao($cod_curso)
	{
		$sql = " SELECT ".
			   "   cod_inscr,".
			   "   cod_cur ".
			   " FROM ".
			   "   inscritos ".
			   " WHERE ".
			   "   cod_cur = ".$cod_curso.
			   " ORDER BY ".
			   "   nome ASC ";
		
		$this->executar($sql);
	}
}
?>