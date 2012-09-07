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

class perfil extends consulta
{
	//Campos
	var $cod_perfil;
	var $cod_usuario;
	var $apelido;
	var $descr_pessoal;
	var $interesse;
	var $empresa;
	var $cargo;
	var $detalhes;
	var $profissao;
	var $cidade;
	var $uf;
	var $site_pes;
	var $site_prof;
	var $foto;
	var $miniatura;
	
	//Construtor
	function perfil()
	{
	   	$this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
	  	return $this->cod_perfil;
	}
	
	function setCodigo($codigo)
	{
	  	$this->cod_perfil = $codigo;
	}
	
	function getCodigoUsuario()
	{
	  	return $this->cod_usuario;
	}

	function setCodigoUsuario($cod_usuario)
	{
	  	$this->cod_usuario = $cod_usuario;
	}
	
	function getApelido()
	{
		return $this->apelido;
	}
	
	function setApelido($apelido)
	{
		$this->apelido = $apelido;
	}
	
	function getDescricaoPessoal()
	{
	  	return $this->descr_pessoal;
	}
	
	function setDescricaoPessoal($descricao)
	{
	  	$this->descr_pessoal = $descricao;
	}
	
	function getInteresse()
	{
	  	return $this->interesse;
	}
	
	function setInteresse($interesse)
	{
	  	$this->interesse = $interesse;
	}

	function getEmpresa()
	{
	  	return $this->empresa;
	}
	
	function setEmpresa($empresa)
	{
	  	$this->empresa = $empresa;
	}
	
	function getCargo()
	{
	  	return $this->cargo;
	}
	
	function setCargo($cargo)
	{
	  	$this->cargo = $cargo;
	}
	
	function getDetalhes()
	{
	  	return $this->detalhes;
	}
	
	function setDetalhes($detalhes)
	{
	  	$this->detalhes = $detalhes;
	}

	function getProfissao()
	{
	  	return $this->profissao;
	}
	
	function setProfissao($profissao)
	{
	  	$this->profissao = $profissao;
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
	
	function getSitePessoal()
	{
	  	return $this->site_pes;
	}
	
	function setSitePessoal($site_pes)
	{
	  	$this->site_pes = $site_pes;
	}
	
	function getSiteProfissional()
	{
	  	return $this->site_prof;
	}
	
	function setSiteProfissional($site_prof)
	{
	  	$this->site_prof = $site_prof;
	}
	
	function getNomeFoto()
	{
	  	return $this->nome_foto;
	}
	
	function setNomeFoto($nome_foto)
	{
	  	$this->nome_foto = $nome_foto;
	}
	
	function getFoto()
	{
	  	return $this->foto;
	}
	
	function setFoto($foto)
	{
	  	$this->foto = $foto;
	}
	
	function getMiniatura()
	{
	  	return $this->miniatura;
	}
	
	function setMiniatura($miniatura)
	{
	  	$this->miniatura = $miniatura;
	}	
	
	function carregar($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_perfil, ".
			   "   cod_usuario, ".
			   "   apelido, ".
			   "   descr_pessoal, ".
			   "   interesse, ".
			   "   empresa, ".
			   "   cargo, ".
			   "   detalhes, ".
			   "   profissao, ".
			   "   cidade, ".
			   "   uf, ".
			   "   site_pes, ".
			   "   site_prof, ".
			   "   foto, ".
			   "   miniatura ".
			   " FROM ".
			   "   perfil ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->cod_perfil = $this->data["cod_perfil"];
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->apelido = $this->data["apelido"];
		$this->descr_pessoal = $this->data["descr_pessoal"];
		$this->interesse = $this->data["interesse"];
		$this->empresa = $this->data["empresa"];
		$this->cargo = $this->data["cargo"];
		$this->detalhes = $this->data["detalhes"];
		$this->profissao = $this->data["profissao"];
		$this->cidade = $this->data["cidade"];
		$this->uf = $this->data["uf"];
		$this->site_pes = $this->data["site_pes"];
		$this->site_prof = $this->data["site_prof"];
		$this->foto = $this->data["foto"];
		$this->miniatura = $this->data["miniatura"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO perfil (".
			   "   cod_usuario, ".
			   "   descr_pessoal, ".
			   "   apelido, ".
			   "   interesse, ".
			   "   empresa, ".
			   "   cargo, ".
			   "   detalhes, ".
			   "   profissao, ".
			   "   cidade, ".
			   "   uf, ".
			   "   site_pes, ".
			   "   site_prof, ".
			   "   foto, ".
			   "   miniatura ".
			   " ) VALUES (".
			   $this->cod_usuario.", '".
			   $this->descr_pessoal."', '".
			   $this->apelido."', '".
			   $this->interesse."', '".
			   $this->empresa."', '".
			   $this->cargo."', '".
			   $this->detalhes."', '".
			   $this->profissao."', '".
			   $this->cidade."', '".
			   $this->uf."', '".
			   $this->site_pes."', '".
			   $this->site_prof."', '".
			   $this->foto."', '".
			   $this->miniatura."' )";
		
		$this->insere($sql);
	}
	
	function alterar($cod_perfil, $cod_usuario)
	{
		$sql = " UPDATE ".
			   "   perfil ".
			   " SET ".
			   "   apelido = '".$this->apelido."', ".
			   "   descr_pessoal = '".$this->descr_pessoal."', ".
			   "   interesse = '".$this->interesse."', ".
			   "   empresa = '".$this->empresa."', ".
			   "   cargo = '".$this->cargo."', ".
			   "   detalhes = '".$this->detalhes."', ".
			   "   profissao = '".$this->profissao."', ".
			   "   cidade = '".$this->cidade."', ".
			   "   uf = '".$this->uf."', ".
			   "   site_pes = '".$this->site_pes."', ".         
			   "   site_prof = '".$this->site_prof."', ".
			   "   foto = '".$this->foto."', ".
			   "   miniatura = '".$this->miniatura."' ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil.
			   " AND ".
			   "   cod_usuario = ".$cod_usuario;  
					   
		$this->insere($sql);
	}
	
	function excluir($cod_perfil)
	{
		$sql = " UPDATE ".
			   "   perfil ".
			   " set ".
			   "   situacao = 'I' ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil;
		
		$this->insere($sql);
	}
	
	function carregarDadosPessoais($cod_perfil)
	{
		$sql = " SELECT ".
		       "   apelido, ".
			   "   descr_pessoal, ".
			   "   interesse, ".
			   "   cidade, ".
			   "   uf, ".
			   "   site_pes, ".
			   "   foto, ".
			   "   miniatura ".
			   " FROM ".
			   "   perfil ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil;
		
		$this->executar($sql);
		
		$this->apelido = $this->data["apelido"];
		$this->descr_pessoal = $this->data["descr_pessoal"];
		$this->interesse = $this->data["interesse"];
		$this->cidade = $this->data["cidade"];
		$this->uf = $this->data["uf"];
		$this->site_pes = $this->data["site_pes"];
		$this->foto = $this->data["foto"];
		$this->miniatura = $this->data["miniatura"];
	}
	
	function alterarDadosPessoais($cod_perfil)
	{
		$sql = " UPDATE ".
			   "   perfil ".
			   " SET ".
			   "   apelido = '".$this->apelido."', ".
			   "   descr_pessoal = '".$this->descr_pessoal."', ".
			   "   interesse = '".$this->interesse."', ".
			   "   cidade = '".$this->cidade."', ".
			   "   uf = '".$this->uf."', ".
			   "   site_pes = '".$this->site_pes."', ".
			   "   foto = '".$this->foto."', ".
			   "   miniatura = '".$this->miniatura."' ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil;  
  
		$this->insere($sql);
	}
	
	function carregarDadosProfissionais($cod_perfil)
	{
		$sql = " SELECT ".
			   "   empresa, ".
			   "   cargo, ".
			   "   detalhes, ".
			   "   profissao, ".
			   "   site_prof ".
			   " FROM ".
			   "   perfil ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil;
		
		$this->executar($sql);
		
		$this->empresa = $this->data["empresa"];
		$this->cargo = $this->data["cargo"];
		$this->detalhes = $this->data["detalhes"];
		$this->profissao = $this->data["profissao"];
		$this->site_prof = $this->data["site_prof"];
	}
	
	function alterarDadosProfissionais($cod_perfil)
	{
		$sql = " UPDATE ".
			   "   perfil ".
			   " SET ".
			   "   empresa = '".$this->empresa."', ".
			   "   cargo = '".$this->cargo."', ".
			   "   detalhes = '".$this->detalhes."', ".
			   "   profissao = '".$this->profissao."', ".       
			   "   site_prof = '".$this->site_prof."' ".
			   " WHERE ".
			   "   cod_perfil = ".$cod_perfil;  
					   
		$this->insere($sql);
	}
}
?>