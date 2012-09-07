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

class cursoTurma extends consulta
{
	//Campos
	var $codigo_curso;
	var $codigo_turma;
	
	//Construtor
	function curso()
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
	
	function carregar($cod_curso)
	{
	  $sql = " SELECT ".
			 "   cod_curso, ".
			 "   nome, ".
			 "   descricao, ".
			 "   vagas, ".
			 "   data_inicio, ".
			 "   data_fim, ".
			 "   qtde_horas, ".
			 "   situacao ".
			 " FROM ".
			 "   curso ".
			 " WHERE ".
			 "   cod_curso = ".$cod_curso;
	  
	  $this->executar($sql);
	
	  $this->codigo = $this->data["cod_curso"];
	  $this->nome = $this->data["nome"];
	  $this->descricao = $this->data["descricao"];
	  $this->vagas = $this->data["vagas"];
	  $this->data_inicio = $this->data["data_inicio"];
	  $this->data_fim = $this->data["data_fim"];
	  $this->qtde_horas = $this->data["qtde_horas"];
	  $this->situacao = $this->data["situacao"];
	}
		
	function inserir()
	{
	  $sql = " INSERT INTO curso (".
			 "   nome, ".
			 "   descricao,".
			 "   vagas, ".
			 "   data_inicio, ".
			 "   data_fim, ".
			 "   qtde_horas, ".
			 "   situacao ".
			 " ) VALUES (".
			 $this->nome.", '".
			 $this->descricao."', '".
			 $this->vagas."', '".
			 $this->data_inicio."', '".
			 $this->data_fim."', '".
			 $this->qtde_horas."', '".
			 $this->situacao."' ) ";
			 
	   $this->insere($sql);
	}
	
	function alterar($cod_edital)
	{
	  $sql = " UPDATE ".
			 "   curso ".
			 " SET ".
			 "   nome = ".$this->autor.", ".
			 "   descricao = '".$this->descricao."', ".
			 "   vagas = '".$this->vagas."', ".
			 "   data_inicio = '".$this->data_inicio."', ".
			 "   data_fim = '".$this->data_fim."', ".
			 "   qtde_horas = '".$this->qtde_horas."', ".
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
		
	function colecao($cod_turma)
	{
	  $sql = " SELECT ".
			 "   cod_curso, ".
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
}
?>