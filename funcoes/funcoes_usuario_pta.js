// JavaScript Document - Funções Usuário
function novoUsuario()
{
	document.tela_usuario_pta.acao_usuario.value = "novo";
	document.tela_usuario_pta.action = "formulario.php";
	document.tela_usuario_pta.submit();
}

function importarUsuario(acao)
{
	document.tela_usuario_pta.acao_usuario.value = acao;
	document.tela_usuario_pta.action = "importar.php";
	document.tela_usuario_pta.submit();
}

function exportarUsuario(acao, input)
{
	if (input.length > 0)
	{
		input.name = input.name + "[]";
		document.tela_usuario_pta.acao_usuario.value = acao;
		document.tela_usuario_pta.action = "controle.php";
		document.tela_usuario_pta.submit();
	}
	else
	{
		window.alert("Nenhum usuário selecionada para Exportação!");
	}
}

function exportarUsuarioSapo(acao)
{
	document.tela_usuario_pta.acao_usuario.value = acao;
	document.tela_usuario_pta.action = "controle.php";
	document.tela_usuario_pta.submit();
}

function editarUsuario(cod_usuario_pta)
{
	document.tela_usuario_pta.acao_usuario.value = "editar";
	document.tela_usuario_pta.cod_usuario_pta.value = cod_usuario_pta;
	document.tela_usuario_pta.action = "formulario.php";
	document.tela_usuario_pta.submit();
}

function usuarioLoginSenha(acao, login, senha, identificacao)
{	
	var td = document.getElementById(identificacao);
	td.innerHTML = "";
	
	if (acao)
	{		
		var table = document.createElement("table");
		var tbody = document.createElement("tbody");
		
		var tr_linha_1 = document.createElement("tr");
		var td_linha_1 = document.createElement("td");
		
		var tr_linha_2 = document.createElement("tr");
		var td_linha_2 = document.createElement("td");
		
		var tr_login = document.createElement("tr");
		var td_titulo_login = document.createElement("td");
		var td_espaco_login = document.createElement("td");
		var td_input_login = document.createElement("td");
		
		var tr_senha = document.createElement("tr");
		var td_titulo_senha = document.createElement("td");
		var td_espaco_senha = document.createElement("td");
		var td_input_senha = document.createElement("td");
		
		var img_login = document.createElement("img");
		var img_senha = document.createElement("img");
		
		var input_login = document.createElement("input");
		var input_senha = document.createElement("input");
		
		//Define as Imagens
		img_login.setAttribute("id", "imagem_login");
		img_login.setAttribute("src", "../../../imagens/outros/spacer.gif");
		img_login.setAttribute("alt", "");
		img_login.setAttribute("border", "0");
		img_login.setAttribute("width", "12");
		img_login.setAttribute("height", "12");
		
		
		img_senha.setAttribute("id", "imagem_senha");
		img_senha.setAttribute("src", "../../../imagens/outros/spacer.gif");
		img_senha.setAttribute("alt", "");
		img_senha.setAttribute("border", "0");
		img_senha.setAttribute("width", "12");
		img_senha.setAttribute("height", "12");
		
		//Input Login
		input_login.setAttribute("type", "text");
		input_login.setAttribute("name", "login_usuario_instituicao");
		input_login.setAttribute("maxlength", "30");
		input_login.setAttribute("size", "40");
		input_login.setAttribute("tabindex", "11");
		input_login.setAttribute("value", login);
		input_login.setAttribute("onBlur", "JavaScript: verificaDisponibilidadeLogin(this.value, 'tela_usuario_pta', this);");
		
		//Linha 1
		td_linha_1.setAttribute("colspan", "3");
		td_linha_1.setAttribute("height", "15");
		tr_linha_1.appendChild(td_linha_1);
		
		//Linha 2
		td_linha_2.setAttribute("colspan", "3");
		td_linha_2.setAttribute("height", "15");
		tr_linha_2.appendChild(td_linha_2);
		
		//Define Atributos da Tabela, Tbody, TR
		table.setAttribute("width", "100%");
		table.setAttribute("border", "0");
		table.setAttribute("cellpadding", "0");
		table.setAttribute("cellspacing", "0");
		
		//Define Atributos dos TD´s
		td_titulo_login.setAttribute("width", "120");
		td_titulo_login.setAttribute("align", "right");
		td_titulo_login.setAttribute("class", "verde");
		td_espaco_login.setAttribute("width", "10");
		td_input_login.setAttribute("align", "left");
		td_input_login.setAttribute("valign", "middle");
		td_input_login.setAttribute("class", "verde_simples");
		
		td_titulo_senha.setAttribute("width", "120");
		td_titulo_senha.setAttribute("align", "right");
		td_titulo_senha.setAttribute("class", "verde");
		td_espaco_senha.setAttribute("width", "10");
		td_input_senha.setAttribute("align", "left");
		td_input_senha.setAttribute("class", "verde_simples");

		//Acrescenta valor ao TD e vincula ao TR respectivo Login
		td_titulo_login.innerHTML = "Login:";
		td_input_login.appendChild(input_login);
		td_input_login.innerHTML = td_input_login.innerHTML + "&nbsp;&nbsp;<i>Máximo de 30 Caracteres</i>&nbsp;&nbsp;";
		td_input_login.appendChild(img_login);
		tr_login.appendChild(td_titulo_login);
		tr_login.appendChild(td_espaco_login);
		tr_login.appendChild(td_input_login);
		
		td_titulo_senha.innerHTML = "Senha:";
		
		
		if (acao == "cadastrar")
		{
			input_senha.setAttribute("type", "text");
			input_senha.setAttribute("name", "senha_usuario_instituicao");
			input_senha.setAttribute("maxlength", "15");
			input_senha.setAttribute("size", "10");
			input_senha.setAttribute("tabindex", "12");
			input_senha.setAttribute("value", senha);
			input_senha.setAttribute("onBlur", "JavaScript: verificaInput('imagem_senha', this, 0);");
			td_input_senha.appendChild(input_senha);
			td_input_senha.innerHTML = td_input_senha.innerHTML + "&nbsp;&nbsp;<i>Máximo de 15 Caracteres</i>&nbsp;&nbsp;";
			td_input_senha.appendChild(img_senha);
		}
		else
		{
			td_input_senha.innerHTML = "<i>A Senha será gerada pelo Sistema</i>";
		}
		
		//td_input_login.appendChild(input_login);
		tr_senha.appendChild(td_titulo_senha);
		tr_senha.appendChild(td_espaco_senha);
		tr_senha.appendChild(td_input_senha);
		
		//Vincula elemntos TBODY com TABLE e TABLE com TR e no fim com o TD
		tbody.appendChild(tr_login);
		tbody.appendChild(tr_linha_1);
		tbody.appendChild(tr_senha);
		tbody.appendChild(tr_linha_2);
		table.appendChild(tbody);
		td.appendChild(table);
	}
}

function cadastrarUsuario()
{	
	aviso = false;
	
	if (trim(document.tela_usuario_pta.nome_usuario_instituicao.value) == "")
	{
		window.alert("Campo Nome em Branco. Favor preênche-lo.");
		document.tela_usuario_pta.nome_usuario_instituicao.focus();
	}
	else
		if (trim(document.tela_usuario_pta.cpf_usuario_instituicao.value) == "")
		{
			window.alert("Campo CPF em branco. Favor preênche-lo.");
			document.tela_usuario_pta.cpf_usuario_instituicao.focus();
		}
		else
			if (!validaCPF(document.tela_usuario_pta.cpf_usuario_instituicao.value))
			{
				window.alert("O CPF informado parece ser inválido..");
				document.tela_usuario_pta.cpf_usuario_instituicao.focus();
			}
			else
				if (trim(document.tela_usuario_pta.email_usuario_instituicao.value) == "")
				{
					window.alert("Campo E-mail em branco. Favor preênche-lo.");
					document.tela_usuario_pta.email_usuario_instituicao.focus();
				}
				else
					if (!validaEmail(document.tela_usuario_pta.email_usuario_instituicao.value))
					{
						window.alert("O E-mail informado parece ser inválido.");
						document.tela_usuario_pta.email_usuario_instituicao.focus();
					}
					else
						if (document.tela_usuario_pta.usuario_instituicao_login_senha.options[0].selected)
						{
							window.alert("Selecione uma opção para Login/Senha para prosseguir");
							document.tela_usuario_pta.usuario_instituicao_login_senha.focus();
						}
						else
							if (document.tela_usuario_pta.acao_usuario == "novo")
							{
								if (document.tela_usuario_pta.usuario_instituicao_login_senha.options[1].selected)
								{								
									if (trim(document.tela_usuario_pta.login_usuario_instituicao.value) == "")
									{
										window.alert("Campo Login em branco. Favor preênche-lo.");
										document.tela_usuario_pta.login_usuario_instituicao.focus();
									}
									else
										if (!verificaDisponibilidadeLogin(document.tela_usuario_pta.login_usuario_instituicao.value, 'tela_usuario_pta', document.tela_usuario_pta.login_usuario_instituicao))
										{
										}
										else
											if (trim(document.tela_usuario_pta.senha_usuario_instituicao.value) == "")
											{
												window.alert("Campo Senha em branco. Favor preênche-lo.");
												document.tela_usuario_pta.senha_usuario_instituicao.focus();
											}
											else
												{
													document.tela_usuario_pta.action = "controle.php";
													document.tela_usuario_pta.submit();
												}
								}
								else
									if (document.tela_usuario_pta.usuario_instituicao_login_senha.options[2].selected)
									{								
										if (trim(document.tela_usuario_pta.login_usuario_instituicao.value) == "")
										{
											window.alert("Campo Login em branco. Favor preênche-lo.");
											document.tela_usuario_pta.login_usuario_instituicao.focus();
										}
										else
										{
											if (!verificaDisponibilidadeLogin(document.tela_usuario_pta.login_usuario_instituicao.value, 'tela_usuario_pta', document.tela_usuario_pta.login_usuario_instituicao))
											{
											}
											else
											{
												document.tela_usuario_pta.action = "controle.php";
												document.tela_usuario_pta.submit();
											}
										}
									}
							}
							else
							{
								document.tela_usuario_pta.action = "controle.php";
								document.tela_usuario_pta.submit();
							}
}

function visualizaUsuario(cod_usuario_pta, modulo)
{
	document.tela_usuario_pta.cod_usuario_pta.value = cod_usuario_pta;
	document.tela_usuario_pta.modulo.value = modulo;
	document.tela_usuario_pta.action = "visualiza.php";
	document.tela_usuario_pta.submit();
}

function marcaTodosUsuario(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_usuario.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if (formulario.elements[i].type == "checkbox")
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosUsuario();
}

function atualizaCodigosUsuario() 
{
	var codigosLocal;
	codigosLocal = '';
	
	destinoUsuario( 'tela_usuario_pta' );
	codigosLocal += codigosUsuario;

	parent.window.document.tela_usuario_pta.codigos_usuarios.value = codigosLocal;
}

var codigosUsuario;
function destinoUsuario(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigosUsuario = "";
		return;
	}

	var contaChecked = 0;

	codigosUsuario = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		
		if ( checkBox.checked ) 
		{
			cod_linha = checkBox.value;
			if (cod_linha > 0)
			{
				contaChecked++;
				codigosUsuario += checkBox.name + ";";
				tr = document.getElementById(cod_linha);
				tr.className = 'item_selecionado';
			}
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.value;
				if (cod_linha > 0)
				{
					tr = document.getElementById(cod_linha);
					if (tr.className == 'item_selecionado')
						tr.className = checkBox.id;
				}
			}
		
		if ((formulario.elements[i].type == "checkbox") && (formulario.elements[i].name != "todos_usuario"))
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todos_usuario.checked = true;
	else
		formulario.todos_usuario.checked = false;
}

function paginacaoUsuariosCurso(url)
{
	if (document.getElementById("qtdListagem") != null)
	{
		var select1 = document.getElementById("qtdListagem");
		var index1 = select1.selectedIndex;
		var qtd = select1.options[index1].value;
		
		url = url + "&qtd=" + qtd;
	}
		
	if (document.getElementById("tipoUsuario") != null)
	{
		var select2 = document.getElementById("tipoUsuario");
		var index2 = select2.selectedIndex;
		var usuario = select2.options[index2].value;
		
		url = url + "&tipo_usuario=" + usuario;
		
	}
		
	if (document.getElementById("tipoAcesso") != null)
	{
		var select3 = document.getElementById("tipoAcesso");
		var index3 = select3.selectedIndex;
		var acesso = select3.options[index3].value;
		
		url = url + "&acesso_curso=" + acesso;
	}
	
	window.parent.location = url;
}

function desvinculaUsuarioTurma(cod_usuario, cod_turma)
{
	var head = document.getElementsByTagName('head').item(0);
	var eScript = document.createElement('script');
	eScript.setAttribute('src', 'controle.php?acao_usuario=excluir_usuario&cod_usuario=' + cod_usuario + '&cod_turma=' + cod_turma);
	head.appendChild(eScript);
}
//