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

class bd
{
	var $banco;
	var $id;
	
	function bd()
	{
		$this->banco = _DB_TYPE_;
	}
	
	function conecta()
	{
		$this->id = mysql_connect(_DB_HOST_, _DB_USER_, _DB_PASS_);
		
		if($this->id)
		{
			 mysql_select_db(_DB_NAME_, $this->id);
		}
	}
	
	function desconecta()
	{
		mysql_close($this->id);
	}
}
	
class consulta
{
	var $resultado;
	var $registro;
	var $linhas;
	var $data;
	var $conexao;
	
	function consulta()
	{
		$this->conexao = new bd();
		$this->conexao->conecta();
	}
	
	function insere($sql)
	{
		return mysql_query($sql);
	}
	
	function executar($sql)
	{
		if ($sql == "")
		{
			$this->resultado = 0;
			$this->registro = 0;
			$this->linhas = -1;
		}
		else
		{
			$this->resultado = mysql_query($sql);
			$this->linhas = mysql_num_rows($this->resultado);
		}
		 
		$this->registro = 0; 
		if ($this->linhas > 0)
		{
			$this->dados();
		}
	}
	
	function primeiro()
	{
		$this->registro = 0;
		$this->dados();
	}
	
	function proximo()
	{
		$this->registro = ($this->registro < ($this->linhas - 1)) ? ++$this->registro : ($this->linhas - 1);
		$this->dados();
	}
	
	function anterior()
	{
		$this->registro = ($this->registro > 0) ? --$this->registro : 0;
		$this->dados();
	}
	
	function ultimo()
	{  
		$this->navegar($this->linhas);
		$this->registro = $this->linhas;
	}
	
	function navegar($registro)
	{
		if ($registro >= 1 and $registro < $this->linhas)
		{
			$this->registro = $registro;
			$this->dados();
		}
	}
	  
	function dados()
	{
		mysql_data_seek($this->resultado, $this->registro);
		$this->data = mysql_fetch_array($this->resultado);
	}
}
?>