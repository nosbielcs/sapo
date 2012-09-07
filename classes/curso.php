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

class curso extends consulta
{
	//Campos
	var $cod_curso;
	var $cod_inst;
	var $nome;
	var $descricao;
	var $vagas;
	var $data_inicio;
	var $data_inicio;
	var $qtde_horas;
	var $situacao;
	var $imagem;
	
	//Construtor
	function curso()
	{
	   $this->consulta(); //Heranca
	}
	
	function getCodigo()
	{
	  	return $this->cod_curso;
	}
	
	function setCodigo($cod_curso)
	{
	  	$this->cod_curso = $cod_curso;
	}
	
	function setCodigoInstituicao($cod_inst)
	{
	  	$this->cod_inst = $cod_inst;
	}
	
	function getCodigoInstituicao()
	{
	  	return $this->cod_inst;
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
	
	function getSituacao()
	{
		return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
		$this->situacao = $situacao;
	}
	
	function getImagem()
	{
	  	return $this->imagem;
	}
	
	function setImagem($imagem)
	{
		$this->imagem = $imagem;
	} 
	
	function carregar($cod_curso)
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   situacao, ".
			   "   imagem ".
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   cod_curso = ".$cod_curso;
		
		$this->executar($sql);
		
		$this->cod_curso = $this->data["cod_curso"];
		$this->cod_inst = $this->data["cod_inst"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->vagas = $this->data["vagas"];
		$this->data_inicio = $this->data["data_inicio"];
		$this->data_fim = $this->data["data_fim"];
		$this->qtde_horas = $this->data["qtde_horas"];
		$this->situacao = $this->data["situacao"];
		$this->imagem = $this->data["imagem"];
	}
		
	function inserir()
	{
		$sql = " INSERT INTO curso (".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao,".
			   "   vagas, ".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   situacao ".
			   " ) VALUES (".
			   $this->cod_inst.", '".
			   $this->nome."', '".
			   $this->descricao."', '".
			   $this->vagas."', '".
			   $this->data_inicio."', '".
			   $this->data_fim."', ".
			   $this->qtde_horas.", '".
			   $this->situacao."' ) ";
		
		$this->insere($sql);
	}
	
	function alterar($cod_curso)
	{
		$sql = " UPDATE ".
			   "   curso ".
			   " SET ".
			   "   nome = '".$this->nome."', ".
			   "   descricao = '".$this->descricao."', ".
			   "   vagas = '".$this->vagas."', ".
			   "   data_inicio = '".$this->data_inicio."', ".
			   "   data_fim = '".$this->data_fim."', ".
			   "   qtde_horas = ".$this->qtde_horas.", ".
			   "   situacao = '".$this->situacao."' ".         
			   " WHERE ".
			   "   cod_curso = ".$cod_curso;

		$this->insere($sql);
	}
	
	function excluir($cod_curso)
	{
		$sql = " UPDATE ".
			   "   curso ".
			   " set ".
			   "   situacao = 'I' ".
			   " WHERE ".
			   "   cod_curso = ".$cod_curso;
		
		$this->insere($sql);
	}	
		
	function colecao()
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   situacao ".
			   " FROM ".
			   "   curso ";
		
		$this->executar($sql);
	}
	
	function colecaoCursoAtivo()
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst ".
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   situacao = 'A'";
		
		$this->executar($sql);
	}
	
	function colecaoCursoInstituicao($cod_inst)
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst ".
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst.
			   " ORDER BY ".
			   "   nome ";
		
		$this->executar($sql);
	}
	
	function colecaoCursoAtivoInstituicao($cod_inst)
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst ".
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   cod_inst = ".$cod_inst.
			   " AND ".
			   "   situacao = 'A' ".
			   " ORDER BY ".
			   "   nome ";
		
		$this->executar($sql);
	}
	
	function colecaoTurmas($cod_curso)
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_turma ".
			   " FROM ".
			   "   turma ".
			   " WHERE ".
			   "   cod_curso = ".$cod_curso;

		$this->executar($sql);
	}
	
	function paginacao($cod_instituicao, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_inst, ".
			   "   cod_curso, ".
			   "   nome ". 
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   cod_inst = ".$cod_instituicao;
		
		if ($ordem == 1)
			$sql.= " ORDER BY nome DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY nome ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function paginacaoTurma($cod_curso, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_turma, ".
			   "   descricao ".
			   " FROM ".
			   "   turma ".
			   " WHERE ".
			   "   cod_curso = ".$cod_curso;
		
		if ($ordem == 1)
			$sql.= " ORDER BY descricao DESC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY nome ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_curso, ".
			   "   cod_inst, ".
			   "   nome, ".
			   "   descricao, ".
			   "   vagas, ".
			   "   data_inicio, ".
			   "   data_fim, ".
			   "   qtde_horas, ".
			   "   situacao, ".
			   "   imagem ".
			   " FROM ".
			   "   curso ".
			   " WHERE ".
			   "   cod_inst = '".$this->cod_inst."' ".
			   " AND ".
			   "   nome = '".$this->nome."' ".
			   " AND ".
			   "   descricao = '".$this->descricao."' ".
			   " AND ".
			   "   vagas = ".$this->vagas.
			   " AND ".
			   "   data_inicio = '".$this->data_inicio."' ".
			   " AND ".
			   "   data_fim = '".$this->data_fim."' ".
			   " AND ".
			   "   qtde_horas = ".$this->qtde_horas.
			   " AND ".
			   "   situacao = '".$this->situacao."' ".
			   " AND ".
			   "   imagem = '".$this->imagem."' ";
		
		$this->executar($sql);
		
		$this->cod_curso = $this->data["cod_curso"];
		$this->cod_inst = $this->data["cod_inst"];
		$this->nome = $this->data["nome"];
		$this->descricao = $this->data["descricao"];
		$this->vagas = $this->data["vagas"];
		$this->data_inicio = $this->data["data_inicio"];
		$this->data_fim = $this->data["data_fim"];
		$this->qtde_horas = $this->data["qtde_horas"];
		$this->situacao = $this->data["situacao"];
		$this->imagem = $this->data["imagem"];
	}
	
	function vagasOcupadas($cod_curso)
	{
		$sql = " SELECT COUNT(*) as total ".
			   " FROM ". 
			   "   usuario, ".
			   "   curso, ".
			   "   turma, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   curso.cod_curso = ".$cod_curso.
			   " AND ".
			   "   curso.cod_curso = turma.cod_curso ".
			   " AND ".
			   "   usuario_turma.cod_turma = turma.cod_turma ".
			   " AND ".
			   "   usuario_turma.cod_usuario = usuario.cod_usuario ".
			   " AND ".
			   "   usuario_turma.acesso = 'L' ".
			   " AND ".
			   "   usuario_turma.situacao = 'A'";
		
		$this->executar($sql);
		
		$vagas = $this->data["total"];
		
		return $vagas;
	}
}
?>