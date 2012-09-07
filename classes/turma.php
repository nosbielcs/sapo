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

class turma extends consulta
{
	//Campos
	var $cod_turma;
	var $cod_curso;
	var $descricao;
	var $vagas;
	var $data_inicio;
	var $data_fim;
	var $qtde_horas;
	var $cota;
	var $upload;
	var $situacao;
	
	//construtor
	function turma()
	{
	   $this->consulta(); //heranca
	}
	
	function getCodigoTurma()
	{
	  	return $this->cod_turma;
	}
	
	function setCodigoTurma($cod_turma)
	{
	  	$this->cod_turma = $cod_turma;
	}
	
	function getCodigoCurso()
	{
	  	return $this->cod_curso;
	}
	
	function setCodigoCurso($cod_curso)
	{
	  	$this->cod_curso = $cod_curso;
	}
	
	function getDescricao()
	{
	  return $this->descricao;
	}
	
	function setDescricao($descricao)
	{
	  	$this->descricao = $descricao;
	}
	
	function getVagas()
	{
	  	return $this->vagas;
	}
	
	function setVagas($vagas)
	{
	  	$this->vagas = $vagas;
	}
	
	function getDataInicio()
	{
	  	return $this->data_inicio;
	}
	
	function setDataInicio($data_inicio)
	{
	  	$this->data_inicio = $data_inicio;
	}
	
	function getDataFim()
	{
	  	return $this->data_fim;
	}
	
	function setDataFim($data_fim)
	{
	  	$this->data_fim = $data_fim;
	}
	
	function getQtdeHoras()
	{
	  	return $this->qtde_horas;
	}
	
	function setQtdeHoras($qtde_horas)
	{
	  	$this->qtde_horas = $qtde_horas;
	}
	
	function getCotaArquivos()
	{
	  	return $this->cota;
	}
	
	function setCotaArquivos($cota)
	{
		$this->cota = $cota;
	}
	
	function getUploadMaximo()
	{
	  	return $this->upload;
	}
	
	function setUploadMaximo($upload)
	{
		$this->upload = $upload;
	}
	
	function getSituacao()
	{
	  	return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
		$this->situacao = $situacao;
	}
	
	function carregar($cod)
	{
		$sql = " SELECT ".
			   "   cod_turma, ".
			   "   cod_curso, ".
			   "   descricao, ".
			   "   vagas,".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   cota, ".
			   "   upload, ".
			   "   situacao ".
			   " FROM ".
			   "   turma ".
			   " WHERE ".
			   "   cod_turma = ".$cod;
		
		$this->executar($sql);
		
		$this->cod_turma = $this->data["cod_turma"];
		$this->cod_curso = $this->data["cod_curso"];
		$this->descricao = $this->data["descricao"];
		$this->vagas = $this->data["vagas"];
		$this->data_inicio = $this->data["data_inicio"];
		$this->data_fim = $this->data["data_fim"];
		$this->qtde_horas = $this->data["qtde_horas"];
		$this->cota = $this->data["cota"];
		$this->upload = $this->data["upload"];
		$this->situacao = $this->data["situacao"];
	}
	
	function inserir()
	{
		$sql = " INSERT INTO turma (".
			   "   cod_curso, ".
			   "   descricao, ".
			   "   vagas,".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   cota, ".
			   "   upload, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_curso.", '".
			   $this->descricao."', ".
			   $this->vagas.", '".
			   $this->data_inicio."', '".
			   $this->data_fim."', ".
			   $this->qtde_horas.", ".
			   $this->cota.", ".
			   $this->upload.", '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterar($cod_turma)
	{
		$sql = " UPDATE ".
			   "   turma ".
			   " SET ".
			   "   cod_curso = ".$this->cod_curso.", ".
			   "   descricao = '".$this->descricao."', ".
			   "   vagas = ".$this->vagas.", ".
			   "   data_inicio = '".$this->data_inicio."', ".
			   "   data_fim = '".$this->data_fim."', ".  
			   "   qtde_horas = ".$this->qtde_horas.", ".
			   "   cota = ".$this->cota.", ".
			   "   cota = ".$this->upload.", ".
			   "   situacao = '".$this->situacao."' ".         
			   " WHERE ".
			   "   cod_turma = ".$cod_turma;  

		$this->insere($sql);
	}
	
	function excluir($cod_turma)
	{
	  $sql = " DELETE ".
	         " FROM ".
			 "   turma ".
			 " WHERE ".
			 "   cod_turma = ".$cod_turma;
	
	  $this->executar($sql);  
	}
	
	function colecao()
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   descricao, ".
			   "   vagas,".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   cota, ".
			   "   upload, ".
			   "   situacao ".
			   " FROM ".
			   "   turma ";
		
		$this->executar($sql);
	}
	
	function colecaoUsuarios($cod_turma)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma;
		
		$this->executar($sql);
	}
	
	function colecaoAlunos($cod_turma)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.data, ".
			   "   usuario.hora, ".
			   "   usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
			   "	usuario_turma.acesso = 'L' ";
		
		$this->executar($sql);
	}
	
	function colecaoTutores($cod_turma)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.data, ".
			   "   usuario.hora, ".
			   "   usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
			   "	usuario_turma.acesso = 'T' ";
		
		$this->executar($sql);
	}
	
	function colecaoCoordenadores($cod_turma)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.data, ".
			   "   usuario.hora, ".
			   "   usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
			   "	usuario_turma.acesso = 'C' ";
		
		$this->executar($sql);
	}
	
	function colecaoSuporteOnline($cod_turma)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.data, ".
			   "   usuario.hora, ".
			   "   usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
			   "	usuario_turma.acesso = 'S' ";
		
		$this->executar($sql);
	}
	
	function paginacao($cod_turma, $ordem, $limite, $inicio, $tipo_usuario)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.data, ".
			   "   usuario.hora, ".
			   "   usuario.situacao ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma.
			   " AND ".
			   "	usuario_turma.acesso = '".$tipo_usuario."' ";
			   
	   if ($ordem == 1)
			$sql.= " ORDER BY usuario.nome ASC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY usuario.nome DESC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY usuario.data ASC, usuario.hora ASC ";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY usuario.data DESC, usuario.hora DESC ";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY usuario.situacao ASC ";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY usuario.situacao DESC ";
								
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicio;
		
		$this->executar($sql);
	}
	
	function desvinculaUsuarioTurma($cod_usuario, $cod_turma)
	{
		$sql = " DELETE ".
	           " FROM ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
		echo $sql;exit;
		$this->executar($sql);		
	}
}
?>