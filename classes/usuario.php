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

class usuario extends consulta
{
	//Campos
	var $cod_usuario;
	var $nome;
	var $cpf;
	var $login;
	var $senha;
	var $email;
	var $data_nascimento;
	var $sexo;
	var $data_usuario;
	var $hora_usuario;
	var $situacao;
	
	//construtor
	function usuario()
	{
	   $this->consulta(); //heranca
	}
	
	function getCodigo()
	{
		return $this->cod_usuario;
	}
	
	function setCodigo($cod_usuario)
	{
		$this->cod_usuario = $cod_usuario;
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
	
	function getLogin()
	{
		return $this->login;
	}
	
	function setLogin($login)
	{
		$this->login = $login;
	}
	
	function getSenha()
	{
		return $this->senha;
	}
	
	function setSenha($senha)
	{
		$this->senha = $senha;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function setEmail($email)
	{
		$this->email = $email;
	}
	
	function setDataNascimento($data_nascimento)
	{
	  	$this->data_nascimento = $data_nascimento;
	}
	
	function getDataNascimento()
	{
	  	return $this->data_nascimento;
	}
	
	function setSexo($sexo)
	{
	  	$this->sexo = $sexo;
	}
	
	function getSexo()
	{
	  	return $this->sexo;
	}
	
	function getDataUsuario()
	{
		return $this->data_usuario;
	}
	
	function setDataUsuario($data_usuario)
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
	
	function getSituacao()
	{
		return $this->situacao;
	}
	
	function setSituacao($situacao)
	{
		$this->situacao = $situacao;
	}
	
	function carregar($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   nome, ".
			   "   cpf, ".
			   "   email, ".
			   "   data_nasc, ".
			   "   sexo, ". 
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->login = $this->data["login"];
		$this->cpf = $this->data["cpf"];
		$this->senha = $this->data["senha"];
		$this->nome = $this->data["nome"];
		$this->email = $this->data["email"];
		$this->data_nascimento = $this->data["data_nasc"];
		$this->sexo = $this->data["sexo"];
		$this->data_usuario = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function inserir()
	{
		$sql = " INSERT INTO usuario (".
			   "   login, ".
			   "   senha,".
			   "   nome, ".
			   "   cpf, ".
			   "   email, ".
			   "   data_nasc, ".
			   "   sexo, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " ) VALUES ('".
			   $this->login."', ".
			   " encode('".$this->senha."', '"._KEY_USER."'), '".
			   $this->nome."', '".
			   $this->cpf."', '".
			   $this->email."', '".
			   $this->data_nascimento."', '".
			   $this->sexo."', '".
			   $this->data_usuario."', '".
			   $this->hora."', '".
			   $this->situacao."' ) ";

		$this->insere($sql);
	}
	
	function alterar($cod_usuario)
	{
		$sql = " UPDATE ".
			   "   usuario ".
			   " SET ".
			   "   nome = '".$this->nome."', ".
			   "   senha = encode('".$this->senha."', '"._KEY_USER."'), ".
			   "   login = '".$this->login."', ".
			   "   cpf = '".$this->cpf."', ".
			   "   email = '".$this->email."', ".
			   "   data_nasc = '".$this->data_nascimento."', ".
			   "   sexo = '".$this->sexo."' ".    
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;  

		$this->insere($sql);
	}
	
	function excluir($cod_usuario)
	{
		$sql = " UPDATE ".
			   "   usuario ".
			   " set ".
			   "   situacao = 'I' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->insere($sql);  
	}
	
	function atualizaSituacaoTurma($cod_usuario, $cod_turma, $situacao)
	{
		$sql = " UPDATE ".
			   "   usuario_turma ".
			   " set ".
			   "   situacao = '".$situacao."' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma;
			   
		$this->insere($sql);  
	}
	
	function atualizaSituacaoInstituicao($cod_usuario, $cod_instituicao, $situacao)
	{
		$sql = " UPDATE ".
			   "   usuario_instituicao ".
			   " set ".
			   "   situacao = '".$situacao."' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_inst = ".$cod_instituicao;
			   
		$this->insere($sql);  
	}
	
	function efetuarLogin($login, $senha)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   nome, ".
			   "   cpf, ".
			   "   email, ".
			   "   data_nasc, ".
			   "   sexo, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   login = '".$login."' ".
			   " AND ".
			   "   senha = encode('".$senha."', '"._KEY_USER."') ";
			 
		$this->executar($sql);
		
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->login = $this->data["login"];
		$this->cpf = $this->data["cpf"];
		$this->senha = $this->data["senha"];
		$this->nome = $this->data["nome"];
		$this->email = $this->data["email"];
		$this->data_nascimento = $this->data["data_nasc"];
		$this->sexo = $this->data["sexo"];
		$this->data_usuario = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function verificarUsuario($cpf)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   nome, ".
			   "   email, ".
			   "   data_nasc, ".
			   "   sexo, ".
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cpf = '".$cpf."'";
			 
		$this->executar($sql);
		
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->login = $this->data["login"];
		$this->cpf = $this->data["cpf"];
		$this->senha = $this->data["senha"];
		$this->nome = $this->data["nome"];
		$this->email = $this->data["email"];
		$this->data_nascimento = $this->data["data_nasc"];
		$this->sexo = $this->data["sexo"];
		$this->data_usuario = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function pesquisaUsuarioNome($nome)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   nome ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   nome like '%".$nome."%'";
			 
		$this->executar($sql);
	}
	
	function pesquisaUsuarioCPF($cpf)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   nome ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cpf like '%".$cpf."%'";
			 
		$this->executar($sql);
	}
	
	function pesquisaUsuarioEmail($email)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   nome ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   email like '%".$email."%'";
			 
		$this->executar($sql);
	}
	
	function verificaLogin($login)
	{
		$sql = " SELECT ".
			   "   login ".
			   " FROM ".
			   "   usuario, ".
			   "   decode(senha, '"._KEY_USER."') as senha ".
			   " WHERE ".
			   "   login = '".$login."'";
			 
		$this->executar($sql);
		
		$this->login = $this->data["login"];
		$this->senha = $this->data["senha"];
	}
	
	function recuperarLoginSenha($email)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   nome, ".
			   "   email ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   email = '".$email."'";
		
		$this->executar($sql);
		
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->login = $this->data["login"];
		$this->senha = $this->data["senha"];
		$this->nome = $this->data["nome"];
		$this->email = $this->data["email"];
	}
	
	function colecao()
	{
		$sql = " SELECT ".
			   "   cod_usuario,".
			   "   nome, ".
			   "   email, ".
			   "   login, ".
			   "   senha".
			   " FROM ".
			   "   usuario ";
		
		$this->executar($sql);
	}
	
	function paginacaoUsuarioTurma($cod_turma, $tipo_acesso, $acessou, $situacao = "A", $limite, $inicial)
	{		
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario_turma.acesso, ".
			   "   usuario_turma.cod_turma ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma;
			 
		if ($tipo_acesso != "Q")
		{
			$sql.= " AND ".
			       "   usuario_turma.acesso = '".$tipo_acesso."' ";
		}
		else
			if ($tipo_acesso != "Q")
			{
				" AND ".
				"   usuario_turma.acesso != 'C' ";
			}
		
		if (!empty($acessou))
		{
			if ($acessou == "S")
			{
				$sql.= " AND ".
			    	   "   usuario_turma.visitas > 0 ";
			}
			else
				if ($acessou == "N")
				{
					$sql.= " AND ".
						   "   usuario_turma.visitas = 0 ";
				}
		}
		
		$sql.= " AND ".
			   "   usuario_turma.situacao = '".$situacao."' ".
			   " ORDER BY ".
			   "   usuario.nome ";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;
		
		$this->executar($sql);
	}
	
	function colecaoUsuarioTurma($cod_turma, $tipo_acesso, $acessou, $situacao = "A")
	{		
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario_turma.acesso, ".
			   "   usuario_turma.cod_turma ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma;
			 
		if ($tipo_acesso != "Q")
		{
			$sql.= " AND ".
			       "   usuario_turma.acesso = '".$tipo_acesso."' ";
		}
		else
			if ($tipo_acesso != "Q")
			{
				" AND ".
				"   usuario_turma.acesso != 'C' ";
			}
		
		if (!empty($acessou))
		{
			if ($acessou == "S")
			{
				$sql.= " AND ".
			    	   "   usuario_turma.visitas > 0 ";
			}
			else
				if ($acessou == "N")
				{
					$sql.= " AND ".
						   "   usuario_turma.visitas = 0 ";
				}
		}
		
		$sql.= " AND ".
			   "   usuario_turma.situacao = '".$situacao."' ".
			   " ORDER BY ".
			   "   usuario.nome ";
		
		$this->executar($sql);
	}
	
	function paginacaoUsuarioCurso($cod_curso, $tipo_acesso, $acessou, $situacao = "A", $limite, $inicial)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.cpf, ".			   
			   "   usuario_turma.acesso, ".
			   "   turma.cod_curso, ".
			   "   usuario_turma.cod_turma  ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma, ".
			   "   turma ".
			   " WHERE ".
			   "   turma.cod_curso = ".$cod_curso.
			   " AND ".
			   "   turma.cod_turma = usuario_turma.cod_turma ".
			   " AND ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ";
			 
		if ($tipo_acesso != "Q")
		{
			$sql.= " AND ".
			       "   usuario_turma.acesso = '".$tipo_acesso."' ";
		}
		
		if (!empty($acessou))
		{
			if ($acessou == "S")
			{
				$sql.= " AND ".
			    	   "   usuario_turma.visitas > 0 ";
			}
			else
				if ($acessou == "N")
				{
					$sql.= " AND ".
						   "   usuario_turma.visitas = 0 ";
				}
		}
		
		$sql.= " AND ".
			   "  usuario_turma.situacao = '".$situacao."' ".
			   " ORDER BY ".
			   "   usuario_turma.acesso ASC, usuario.nome ASC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;

		$this->executar($sql);
	}
	
	function colecaoUsuarioCurso($cod_curso, $tipo_acesso, $acessou, $situacao = "A")
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario.nome, ".
			   "   usuario.cpf, ".			   
			   "   usuario_turma.acesso, ".
			   "   turma.cod_curso, ".
			   "   turma.cod_turma ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma, ".
			   "   turma ".
			   " WHERE ".
			   "   turma.cod_curso = ".$cod_curso.
			   " AND ".
			   "   turma.cod_turma = usuario_turma.cod_turma ".
			   " AND ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ";
			 
		if ($tipo_acesso != "Q")
		{
			$sql.= " AND ".
			       "   usuario_turma.acesso = '".$tipo_acesso."' ";
		}
		
		if (!empty($acessou))
		{
			if ($acessou == "S")
			{
				$sql.= " AND ".
			    	   "   usuario_turma.visitas > 0 ";
			}
			else
				if ($acessou == "N")
				{
					$sql.= " AND ".
						   "   usuario_turma.visitas = 0 ";
				}
		}
		
		$sql.= " AND ".
			   "  usuario_turma.situacao = '".$situacao."' ".
			   " ORDER BY ".
			   "   usuario_turma.acesso ASC, usuario.nome ASC";
		
		$this->executar($sql);
	}
	
	function colecaoUsuarioInstituicao($cod_inst, $acesso)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario_instituicao.acesso ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_instituicao ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_instituicao.cod_usuario ".
			   " AND ".
			   "   usuario_instituicao.cod_inst = ".$cod_inst.
			   " AND ".
			   "   usuario_instituicao.acesso = '".$acesso."' ".
			   " AND ".
			   "   usuario_instituicao.situacao = 'A' ".
			   " ORDER BY ".
			   "   usuario.nome ";

		$this->executar($sql);
	}
	
	function turmas($cod_usuario, $situacao_turma)
	{
		$sql = " SELECT ".
			   "   turma.cod_curso, ".	
			   "   usuario_turma.cod_usuario,".
			   "   usuario_turma.cod_turma, ".
			   "   usuario_turma.acesso ".
			   " FROM ".
			   "   turma, ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   usuario_turma.cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   turma.cod_turma = usuario_turma.cod_turma ";
			   
	    if ($situacao_turma == "A")
		{
			$sql.= " AND ".
			       "   turma.situacao = 'A' ";
		}
		else
			if ($situacao_turma == "I")
			{
				$sql.= " AND ".
					   "   turma.situacao = 'I' ";
			}

		$this->executar($sql);
	}
	
	function instituicoes($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_usuario,".
			   "   cod_inst, ".
			   "   acesso ".
			   " FROM ".
			   "   usuario_instituicao ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;

		$this->executar($sql);
	}
	
	function verificaAcesso($cod_usuario, $cod_turma, $acesso)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   cod_turma, ".
			   "   acesso, ".
			   "   visitas, ".
			   "   data_visita, ".
			   "   hora_visita ".
			   " FROM ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma.
			   " AND ".
			   "   acesso = '".$acesso."'";

	  	$this->executar($sql);  	
	}
	
	function verificaTipoAcessoInsituticao($cod_usuario)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   cod_inst, ".
			   "   acesso ".
			   " FROM ".
			   "   usuario_instituicao ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;

	  	$this->executar($sql);  	
	}
	
	function verificaAcessoInstituicao($cod_usuario, $cod_inst, $acesso)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   cod_inst, ".
			   "   acesso, ".
			   "   visitas, ".
			   "   data_visita, ".
			   "   hora_visita ".
			   " FROM ".
			   "   usuario_instituicao ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_inst = ".$cod_inst.
			   " AND ".
			   "   acesso = '".$acesso."'";
	
	  	$this->executar($sql);  	
	}
		
	function atualizaVisitaTurma($cod_usuario, $cod_turma, $visitas, $data_visita, $hora_visita)
	{
		$sql = " UPDATE ".
			   "   usuario_turma ".
			   " SET ".
			   "   visitas = ".$visitas.", ".
			   "   data_visita = '".$data_visita."', ".
			   "   hora_visita = '".$hora_visita."' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$cod_turma;

	  	$this->insere($sql);  	
	}
	
	function atualizaVisitaInstituicao($cod_usuario, $cod_inst, $visitas, $data_visita, $hora_visita)
	{
		$sql = " UPDATE ".
			   "   usuario_instituicao ".
			   " SET ".
			   "   visitas = ".$visitas.", ".
			   "   data_visita = '".$data_visita."', ".
			   "   hora_visita = '".$hora_visita."' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_inst = ".$cod_inst;

	  	$this->insere($sql);  	
	}
	
	function verificaAcessoTurma($cod_usuario, $turma)
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   cod_turma, ".
			   "   acesso, ".
			   "   visitas, ".
			   "   data_visita, ".
			   "   hora_visita, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario_turma ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario.
			   " AND ".
			   "   cod_turma = ".$turma;

	  	$this->executar($sql);  	
	}
	
	function AtualizaPerfil()
	{
		$sql = " UPDATE ".
			   "   usuario ".
			   " SET ".
			   "   nome = '".$this->nome."' ,".
			   "   senha = encode('".$this->senha."', '"._KEY_USER."'), ".
			   "   login = '".$this->login."' ,".
			   "   cpf = '".$this->cpf."', ".
			   "   email = '".$this->email."', ".
			   "   data_nasc = '".$this->data_nascimento."', ".
			   "   sexo = '".$this->sexo."' ".     
			   " WHERE ".
			   "   cod_usuario = ".$this->cod_usuario;  
		
	    $this->insere($sql); 
	}
	
	function dadosPessoaisPerfil($cod_usuario)
	{
		$sql = " SELECT ".
			   "   nome, ".
			   "   data_nasc, ".
			   "   sexo ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->nome = $this->data["nome"];
		$this->data_nascimento = $this->data["data_nasc"];
		$this->sexo = $this->data["sexo"];
	}
	
	function alterarDadosPessoais($cod_usuario)
	{
		$sql = " UPDATE ".
			   "   usuario ".
			   " SET ".
			   "   nome = '".$this->nome."', ".
			   "   data_nasc = '".$this->data_nascimento."', ".
			   "   sexo = '".$this->sexo."' ".    
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;  

		$this->insere($sql);
	}
	
	function dadosCadastraisPerfil($cod_usuario)
	{
		$sql = " SELECT ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   cpf, ".
			   "   email ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;
		
		$this->executar($sql);
		
		$this->login = $this->data["login"];
		$this->cpf = $this->data["cpf"];
		$this->senha = $this->data["senha"];
		$this->email = $this->data["email"];
	}
	
	function alterarDadosCadastrais($cod_usuario)
	{
		$sql = " UPDATE ".
			   "   usuario ".
			   " SET ".
			   "   senha = encode('".$this->senha."', '"._KEY_USER."'), ".
			   "   login = '".$this->login."', ".
			   "   cpf = '".$this->cpf."', ".
			   "   email = '".$this->email."' ".
			   " WHERE ".
			   "   cod_usuario = ".$cod_usuario;  

		$this->insere($sql);
	}
	
	function vinculaUsuarioTurma($cod_turma, $cod_usuario, $acesso, $situacao)
	{
		$sql = " INSERT INTO usuario_turma (".
			   "   cod_turma, ".
			   "   cod_usuario,".
			   "   acesso, ".
			   "   situacao ".
			   " ) VALUES (".
			   $cod_turma.", ".
			   $cod_usuario.", '".
			   $acesso."', '".
			   $situacao."' ) ";

		$this->insere($sql);
	}
	
	function vinculaUsuarioInstituicao($cod_instituicao, $cod_usuario, $acesso, $situacao)
	{
		$sql = " INSERT INTO usuario_instituicao (".
			   "   cod_inst, ".
			   "   cod_usuario,".
			   "   acesso, ".
			   "   situacao ".
			   " ) VALUES (".
			   $cod_instituicao.", ".
			   $cod_usuario.", '".
			   $acesso."', '".
			   $situacao."' ) ";
		
		$this->insere($sql);
	}
	
	function verificaDisponibilidadeLogin($login)
	{
		$sql = " SELECT ".
			   "   login ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   login = '".$login."'";
			 
		$this->executar($sql);
		
		if ($this->linhas > 0)
			$retorno = true;
		else
			$retorno = false;
		
		return $retorno;
	}
	
	function verificaDisponibilidadeEmail($email)
	{
		$sql = " SELECT ".
			   "   email ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   email = '".$email."' ";
		
	  	$this->executar($sql);  
	}
	
	function verificaDisponibilidadeCPF($cpf)
	{
		$sql = " SELECT ".
			   "   cpf ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cpf = '".$cpf."' ";
		
	  	$this->executar($sql);  
	}
	
	function recuperaCodigo()
	{
		$sql = " SELECT ".
			   "   cod_usuario, ".
			   "   login, ".
			   "   decode(senha, '"._KEY_USER."') as senha,".
			   "   nome, ".
			   "   cpf, ".
			   "   email, ".
			   "   data_nasc, ".
			   "   sexo, ". 
			   "   data, ".
			   "   hora, ".
			   "   situacao ".
			   " FROM ".
			   "   usuario ".
			   " WHERE ".
			   "   cpf = '".$this->cpf."' ".
			   " AND ".
			   "   email = '".$this->email."' ".
			   " AND ".
			   "   data_nasc = '".$this->data_nascimento."' ".
			   " AND ".
			   "   data = '".$this->data_usuario."' ".
			   " AND ".
			   "   hora = '".$this->hora."' ";

		$this->executar($sql);
		
		$this->cod_usuario = $this->data["cod_usuario"];
		$this->login = $this->data["login"];
		$this->cpf = $this->data["cpf"];
		$this->senha = $this->data["senha"];
		$this->nome = $this->data["nome"];
		$this->email = $this->data["email"];
		$this->data_nascimento = $this->data["data_nasc"];
		$this->sexo = $this->data["sexo"];
		$this->data_usuario = $this->data["data"];
		$this->hora = $this->data["hora"];
		$this->situacao = $this->data["situacao"];
	}
	
	function paginacao($cod_turma, $tipo_acesso, $limite, $inicial, $ordem, $acessou)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario_turma.acesso, ".
			   "   usuario_turma.visitas, ".
			   "   perfil.cidade, ".
			   "   perfil.uf ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_turma, ".
			   "   perfil ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_turma.cod_usuario ".
			   " AND ".
			   "   usuario_turma.cod_turma = ".$cod_turma;

		if ($tipo_acesso != "Q")
		{
			$sql.= " AND ".
			       "   usuario_turma.acesso = '".$tipo_acesso."' ";
		}
		
		if (!empty($acessou))
		{
			if ($acessou == "S")
			{
				$sql.= " AND ".
			    	   "   usuario_turma.visitas > 0 ";
			}
			else
				if ($acessou == "N")
				{
					$sql.= " AND ".
						   "   usuario_turma.visitas = 0 ";
				}
		}
		
		$sql.= " AND ".
		       "    usuario_turma.situacao = 'A' ".
			   " GROUP BY ".
			   "   usuario.cod_usuario ";
		
		if ($ordem == 1)
			$sql.= " ORDER BY usuario.nome ASC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY usuario.nome DESC";
			else
				if ($ordem == 3)
					$sql.= " ORDER BY perfil.cidade ASC, perfil.uf ASC";
				else
					if ($ordem == 4)
						$sql.= " ORDER BY perfil.uf DESC, perfil.uf DESC";
					else
						if ($ordem == 5)
							$sql.= " ORDER BY usuario_turma.visitas ASC";
						else
							if ($ordem == 6)
								$sql.= " ORDER BY usuario_turma.visitas DESC";
						
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;

		$this->executar($sql);
	}
	
	function paginacaoInstituicao($cod_inst, $tipo_acesso, $limite, $inicial, $ordem)
	{
		$sql = " SELECT ".
			   "   usuario.cod_usuario, ".
			   "   usuario_instituicao.acesso ".
			   " FROM ".
			   "   usuario, ".
			   "   usuario_instituicao ".
			   " WHERE ".
			   "   usuario.cod_usuario = usuario_instituicao.cod_usuario ".
			   " AND ".
			   "   usuario_instituicao.cod_inst = ".$cod_inst.
			   " AND ".
			   "   usuario_instituicao.acesso = '".$tipo_acesso."' ".
			   " AND ".
		       "   usuario_instituicao.situacao = 'A' ".
			   " GROUP BY ".
			   "   usuario.cod_usuario ";
		
		if ($ordem == 1)
			$sql.= " ORDER BY usuario.nome ASC";
		else
			if ($ordem == 2)
				$sql.= " ORDER BY usuario.nome DESC";
		
		if ($limite != "T")
			$sql.= " LIMIT ".$limite." OFFSET ".$inicial;

		$this->executar($sql);
	}
}
?>