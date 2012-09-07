/*
=====================================================================
#  PROJETO: Sa²po - Funções JavaScript                              #
#  FUNCAÇÃO ECUMÊNICA DE PROTEÇÃO AO EXCEPCIONAL                    #
#                                                                   #
#  Programação                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

var proibido = ' ';
var janelaSistema;
var janelaInterna;
var navegador = navigator.appName;

if (navigator.appName.indexOf('Microsoft') != -1)
{
 	clientNavigator = "IE";
}
else
	if (navigator.appName.indexOf('Netscape') != -1)
	{
		clientNavigator = "Netscape";
	}
	else
		if (navigator.appName.indexOf('Opera') != -1)
		{
			clientNavigator = "Opera";
		}

function soNumeros(evento)
{
	//Função permite digitação de números
 	if (clientNavigator == "IE")
	{
 		if (evento.keyCode < 48 || evento.keyCode > 57)
		{
 			return false;
 		}
 	}
	else
	{
 		if ((evento.charCode < 48 || evento.charCode > 57) && evento.keyCode == 0)
		{
 			return false;
 		}
 	}
}

function trocarCampo(evento) 
{
	var achou = false;
	var charCode = (navigator.appName == "Netscape") ? evento.which : evento.keyCode;

	if ( proibido.indexOf( String.fromCharCode(charCode) ) != -1 )
		alert("Caractere inválido! Invalid character!");
	else 
	{	
		if (charCode == 13)
			document.login_sistema.senha.focus();
		else
			return true;
	}

	return false;
}

function validaLogin(evento)
{		
	var achou = false;
	var charCode = (navigator.appName == "Netscape") ? evento.which : evento.keyCode;

	if ( proibido.indexOf( String.fromCharCode(charCode) ) != -1 )
		alert("Caracterer inválido!");
	else 
	{
		if (charCode == 13)
			efetuarLogin();
		else
			return true;
	}

	return false;		
}

function efetuarLogin() 
{
	var left = ((window.screen.width - 740) / 2);
	var top = ((window.screen.height - 680) / 2);
	
	janelaSistema = window.open('', 'Sa²pO', 'left=' + left +' ,top=' + top + ', width=' + window.screen.width + ', height=' + window.screen.height + ',toolbar=0 ,menubar=0 ,status=1 ,scrollbars=1 ,resizable=1');
	document.login_sistema.action = '../sapo/login/login.php';
	document.login_sistema.target = 'Sa²pO';
	document.login_sistema.submit();
	document.login_sistema.login.value = '';
	document.login_sistema.senha.value = '';
	document.login_sistema.login.focus();
	janelaSistema.focus();
}

function bannerCurso() 
{
	var left = ((window.screen.width - 740) / 2);
	var top = ((window.screen.height - 680) / 2);
	
	janelaSistema = window.open('../../nead/curso1.php', 'Nead', 'left=' + left +' ,top=' + top + ', width=' + window.screen.width + ', height=' + window.screen.height + ',toolbar=1 ,menubar=1 ,status=1 ,scrollbars=1 ,resizable=1, titlebar=1, location=1');
}

function redirecionaUsuario(cod_turma, acesso, cod_inst)
{
	document.redireciona_usuario.cod_turma.value = cod_turma;
	document.redireciona_usuario.acesso.value = acesso;
	document.redireciona_usuario.cod_inst.value = cod_inst;
	document.redireciona_usuario.action = "redireciona_usuario.php";
	document.redireciona_usuario.submit();
}

function cursoConcluido(data_encerramento, nome_curso)
{
	window.alert("Prezado Usuário do SA²pO,\n\n   o acesso ao Curso '" + nome_curso + "' não está mais disponível, pois o mesmo foi encerrado na data de " + data_encerramento + ".\n\nAtenciosamente, NEAD - FEPE");
}

function acessoBloqueado(nome_curso)
{
	window.alert("Prezado Usuário do SA²pO,\n\n   o acesso ao Curso '" + nome_curso + "' não está disponível para seu usuário, se por algum motivo você não concorda com esta situação favor entrar em contato conosco.\n\nAtenciosamente, NEAD - FEPE");
}

function permissaoNegadaCurso(data_encerramento, nome_curso)
{
	window.alert("Prezado Usuario do SA²pO,\n\você não tem permissão para acessar o Curso '" + nome_curso + "', favor entrar em contato com o NEAD/FEPE para maiores esclarecimentos.\n\nAtenciosamente, NEAD - FEPE");
}

function recuperaSenha()
{
	var left = ((window.screen.width - 740) / 2);
	var top = ((window.screen.height - 680) / 2);
	
	//janela('janelaSistema', '../sapo/recupera_senha.php' ,left ,top ,window.screen.width ,window.screen.height ,0 , 0 , 0, 1, 1);
	janelaSistema = window.open('', 'Sa²pO', 'left=' + left +' ,top=' + top + ', width=' + window.screen.width + ', height=' + window.screen.height + ',toolbar=0 ,menubar=0 ,status=1 ,scrollbars=1 ,resizable=1');
	document.login_sistema.action = '../sapo/recupera_senha.php';
	document.login_sistema.target = 'Sa²pO';
	document.login_sistema.submit();
	document.login_sistema.login.value = '';
	document.login_sistema.senha.value = '';
	document.login_sistema.login.focus();
	janelaSistema.focus();
}

function trim(str)
{
	str=str.replace(/\s+/g," ");
	str=str.replace(/^ /,"");
	str=str.replace(/ $/,"");
	return str;
}
	
/*function validaLoginBeta(evento)
{		
	var achou = false;
	var charCode = (navigator.appName == "Netscape") ? evento.which : evento.keyCode;

	if ( proibido.indexOf( String.fromCharCode(charCode) ) != -1 )
		alert("Caracterer inválido!");
	else 
	{
		if (charCode == 13)
			efetuarLoginBeta();
		else
			return true;
	}

	return false;		
}

function efetuarLoginBeta() 
{	
	document.login_sistema.submit();
}*/

function comparaDatas(data_inicial, data_final, opcao)
{
	var dia_inicial = data_inicial.substr(0,2);
	var mes_inicial = parseInt(data_inicial.substr(3,2)) - 1;
	var ano_inicial = data_inicial.substr(5,4);
	var dia_final = data_final.substr(0,2);
	var mes_final = parseInt(data_final.substr(3,2)) - 1;
	var ano_final = data_final.substr(5,4);
	var dataInicial = new Date(ano_inicial, mes_inicial, dia_inicial);
	var dataFinal = new Date(ano_final, mes_final, dia_final);
	
	if (opcao == 0)
	{
		var dataAtual = new Date();
		if (dataAtual > dataInicial)
		{
			window.alert("A Data Atual não pode ser maior que a Data Inicial!");
			erroData = true;
		}
		else
			if (dataInicial > dataFinal)
			{
				window.alert("A Data Inicial não pode ser maior que a Data Final!");
				erroData = true;
			}
			else
				erroData = false;
	}
	else
	{
		if (dataFinal > dataInicial)
			erroData = true;
		else
			erroData = false;
	}

	return erroData;
}

function validaCPF(cpf) 
{
	cpf = cpf;
	valor = true;
	erro = new String;
	erro = 0;
	
	if (cpf.length < 11)
		erro++;
		//erro += "Sao necessarios 11 digitos para verificacao do CPF! \n\n"; 
	
	var nonNumbers = /\D/;
	if (nonNumbers.test(cpf)) 
		erro++;
		//erro += "A verificacao de CPF suporta apenas numeros! \n\n";	
		
	if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
		erro++;
		//erro += "Numero de CPF invalido!"
	
	var a = [];
	var b = new Number;
	var c = 11;
	
	for (i = 0; i < 11; i++)
	{
		a[i] = cpf.charAt(i);
		if (i < 9) 
			b += (a[i] *  --c);
	}
		
	if ((x = b % 11) < 2)
		a[9] = 0;
		
	else
		a[9] = 11-x
	
	b = 0;
	c = 11;
	
	for (y = 0; y < 10; y++) 
		b += (a[y] *  c--); 
	
	if ((x = b % 11) < 2)
		a[10] = 0;
	else
		a[10] = 11-x;
	
	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]))
		erro++;
		//erro +="Digito verificador com problema!";
	
	/*if (erro.length > 0)
	{
		alert(erro);
		return false;
	}
		
	return true;*/
	if (erro > 0)
		return false;
	else
		return true;
}

function validaEmail(email)
{
	var expRegular = /^[\w!#$%&'*+\/=?^`{|}~-]+(\.[\w!#$%&'*+\/=?^`{|}~-]+)*@(([\w-]+\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
	if(!expRegular.test(email))
 		return false;
	else
		return true;
}

function janela(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
	toolbar_str = toolbar ? 'yes' : 'no';
    menubar_str = menubar ? 'yes' : 'no';
    statusbar_str = statusbar ? 'yes' : 'no';
    scrollbar_str = scrollbar ? 'yes' : 'no';
    resizable_str = resizable ? 'yes' : 'no';
	left = ((window.screen.width - width) / 2);
	top = ((window.screen.height - height) / 2);
	
    janelaInterna = window.open(url, name, 'left=' + left + ', top=' + top + ', width=' + width + ', height=' + height + ', toolbar=' + toolbar_str + ', menubar=' + menubar_str + ', status=' + statusbar_str + ', scrollbars=' + scrollbar_str + ', resizable=' + resizable_str);
}

function redimensionar(tela, width, height)
{
	var left = ((window.screen.width - width) / 2);
	var top = ((window.screen.height - height) / 2);
	
	tela.resizeTo(width, height);
	tela.moveTo(left, top);
}

function redimensionaConteudo(bottom) 
{
	var body = document.body;
	var body_height = 0;
	if (typeof bottom == "undefined") 
	{
		var div = document.createElement("div");
		body.appendChild(div);
		var pos = getAbsolutePos(div);
		body_height = pos.y;
	} 
	else 
	{
		var pos = getAbsolutePos(bottom);
		body_height = pos.y + bottom.offsetHeight;
	}

	if (!document.all) 
	{
		window.sizeToContent();
		window.sizeToContent(); // for reasons beyond understanding,
		// only if we call it twice we get the
		// correct size.
		//window.innerWidth = body.offsetWidth + 5;
		//window.innerHeight = body_height + 2;
	} 
	else
	{
		window.resizeTo(body.offsetWidth + 10, body.offsetHeight + 30);
	}
}

function redimensionaLargura(valor)
{
	var largura = screen.width * valor;
	
	return largura;
}

function redimensionaAltura(valor)
{
	var altura = screen.height * valor;
	
	return altura;
}

function dimensoesTela()
{
	var alturaTela;
	var larguraTela;
	
	if (screen)
	{	
		alturaTela = screen.height;
		larguraTela = screen.width;
	}
	else 
	{
		alturaTela = escape("Não identificado")
		larguraTela = escape("Não identificado")
	}
	
	window.alert("Altura " + alturaTela + " Largura: " + larguraTela);
}

function redimensionaJanela(idJanela)
{
	var conteudo = document.getElementById(idJanela);
	var alturaConteudo = conteudo.offsetHeight;
	var larguraConteudo = conteudo.offsetWidth;
	var alturaJanela = 0;
	var larguraJanela = document.body.clientWidth;
	var redimensiona = false;
	//window.alert(this.innerWidth + " " + this.innerHeight + " " + document.body.clientWidth);
	
	if (alturaConteudo < 450)
	{
		alturaJanela = alturaConteudo;
		redimensiona = true;
	}
	
	if (redimensiona)
	{
		this.resizeTo(larguraJanela + 17, alturaJanela + 65);
	}
}

function relogio()
{
	atual = new Date();
	hora = atual.getHours();
	minuto = atual.getMinutes();
	segundo = atual.getSeconds();
	m = (minuto < 10) ? '0' + minuto : minuto;
	s = (segundo < 10) ? '0' + segundo : segundo;
	text = hora + ':' + m + ':' + s; 
	document.forms[0].elements[0].value = text;
	setTimeout("relogio()",1000);
}

function validaImagem(campo)
{
	if ((campo.indexOf(".gif") == -1) && (campo.indexOf(".jpg") == -1) && (campo.indexOf(".jpeg") == -1) && (campo.indexOf(".png") == -1)) 
	{
		return false;
	}
}

function paginacaoRecados(url)
{
	var index = document.mostra_recados.qtd_listagem.selectedIndex;
	var conteudo = document.mostra_recados.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

function paginacaoMinhaTurma(url)
{
	var index_1 = document.ordena_minha_turma.qtd_listagem.selectedIndex;
	var index_2 = document.ordena_minha_turma.tipo_usuario.selectedIndex;
	var conteudo = document.ordena_minha_turma.qtd_listagem.options[index_1].value;
	var tipo_usuario = document.ordena_minha_turma.tipo_usuario.options[index_2].value;
	window.parent.location = url + "&qtd=" + conteudo + "&tipo_usuario=" + tipo_usuario;
}

function paginacaoEdital()
{
	document.paginacao_edital.submit();
}

function paginacaoConteudo(url)
{
	var index = document.paginacao_forum.qtd_listagem.selectedIndex;
	var conteudo = document.paginacao_forum.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

function paginacaoAtividade(url)
{
	var index = document.paginacao_atividade.qtd_listagem.selectedIndex;
	var conteudo = document.paginacao_atividade.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

function paginacaoForum(url)
{
	var index = document.paginacao_forum.qtd_listagem.selectedIndex;
	var conteudo = document.paginacao_forum.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

function paginacao(url, formulario)
{
	var formulario = eval("document." + formulario);
	var index = formulario.qtd_listagem.selectedIndex;
	var conteudo = formulario.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

//Funções Recados
function marcaTodosNovoRecado(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
			formulario.elements[i].checked = check;
	}
	
	atualizaDestinoNovoRecado();
}

function marcaTodosRecados(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
			formulario.elements[i].checked = check;
	}
	atualizaDestinoRecados();
}

var codigos, nomes;
function destForm(nomeForm) 
{
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	
	if (formulario)
	{
		if ( formulario.elements.length == 0 ) 
		{
			codigos = "";
			nomes = "";
			return;
		}
	
		var contaChecked = 0;
	
		codigos = "";
		nomes = "";

		for (i = 1; i < formulario.elements.length; i++)
		{
			var checkBox = formulario.elements[i];
			if ( checkBox.checked ) 
			{
				contaChecked++;
				codigos += checkBox.name + ";";
				nomes += checkBox.value + ";";
				
				if (nomeForm == "mostra_recados")
					cod_linha = checkBox.value;
				else
					cod_linha = checkBox.name;
					
				tr = document.getElementById(cod_linha);
				tr.className = 'item_selecionado';
			}
			else
				if (formulario.elements[i].type == "checkbox")
				{
					if (nomeForm == "mostra_recados")
						cod_linha = checkBox.value;
					else
						cod_linha = checkBox.name;
						
					tr = document.getElementById(cod_linha);
					if (tr.className == 'item_selecionado')
						tr.className = checkBox.id;
				}
			
			if (formulario.elements[i].type == "checkbox")
				conta++;
		}
		
		if (contaChecked == conta)
			formulario.todos.checked = true;
		else
			formulario.todos.checked = false;
	}
}

function atualizaDestinoNovoRecado() 
{
	var nomesLocal, codigosLocal;
	nomesLocal = '';
	codigosLocal = '';

	var formulario = eval("document." + "tutores");
	
	if (formulario)
	{
		destForm( 'tutores' );
		nomesLocal += nomes;
		codigosLocal += codigos;
	}
	
	formulario = eval("document." + "alunos");
	
	if (formulario)
	{
		destForm( 'alunos' );
		nomesLocal += nomes;
		codigosLocal += codigos;
	}
	
	formulario = eval("document." + "suporte");
	
	if (formulario)
	{
		destForm( 'suporte' );
		nomesLocal += nomes;
		codigosLocal += codigos;
	}
	
	formulario = eval("document." + "coordenador");
	
	if (formulario)
	{
		destForm( 'coordenador' );
		nomesLocal += nomes;
		codigosLocal += codigos;
	}

	parent.window.document.recado.destinoRecado.value = nomesLocal;
	parent.window.document.recado.codigosDestinos.value = codigosLocal;
}

function atualizaDestinoRecados() 
{
	var nomesLocal, codigosLocal;
	nomesLocal = '';
	codigosLocal = '';

	destForm( 'mostraRecados' );
	nomesLocal += nomes;
	codigosLocal += codigos;

	parent.window.document.mostraRecados.destinoRecado.value = nomesLocal;
	parent.window.document.mostraRecados.codigosDestinos.value = codigosLocal;
}

function acaoRecado(pagina, acao)
{
	var texto = pagina + "?acao=" + acao;
	document.forms[0].action = texto;
	document.forms[0].submit();
}

function excluirRecado(acao, origem)
{
	if (verificaCheckBox('mostraRecados') == true)
	{
		var codigos;
		codigos = document.mostraRecados.codigosDestinos.value;
		
		if (acao == "lixeira")
		{
			if (window.confirm("Você tem certeza que deseja remover o(s) Recado(s) selecionado(s) para a Lixeira?"))
			{
				document.mostraRecados.codigosDestinos.value = codigos;
				document.mostraRecados.acao.value = acao;
				document.mostraRecados.action = "controle.php";
				document.mostraRecados.submit();
			}
		}
		else
			if (window.confirm("Você tem certeza que deseja excluir o(s) Recado(s) selecionado(s)?"))
			{
				document.mostraRecados.codigosDestinos.value = codigos;
				document.mostraRecados.acao.value = acao;
				document.mostraRecados.action = "controle.php";
				document.mostraRecados.submit();
			}
	}
	else
		window.alert("Nenhum Recado Selecionado. Para prosseguir selecione pelo menos 1 recado.");
}

function alterarStatusRecado(acao)
{
	if (verificaCheckBox('mostraRecados') == true)
	{
		document.mostraRecados.acao.value = acao;
		document.mostraRecados.action = "controle.php";
		document.mostraRecados.submit();
	}
	else
		window.alert("Nenhum Recado Selecionado. Para prosseguir selecione pelo menos 1 recado.");
}
//

function verificaCheckBox(nomeForm) 
{
	var formulario = eval("document." + nomeForm);
	var verifica = false;
	
	for (i = 1; i < formulario.elements.length; i++)
	{
		var elemento = formulario.elements[i];
		if ( ( elemento.type == "checkbox" ) && ( elemento.checked ) )
			verifica = true;
	}
	
	return verifica;
}

function verificaQtdeCheckBox(nomeForm) 
{
	var formulario = eval("document." + nomeForm);
	var quantidade = 0;
	
	for (i = 1; i < formulario.elements.length; i++)
	{
		var elemento = formulario.elements[i];
		if ( ( elemento.type == "checkbox" ) && ( elemento.checked ) )
			quantidade++;
	}
	
	return quantidade;
}

function lerRecado(cod_recado, pasta, situacao, pagina, quantidade, ordem)
{
	document.mostraRecados.cod_recado.value = cod_recado;
	document.mostraRecados.pasta.value = pasta;
	document.mostraRecados.situacao.value = situacao;
	document.mostraRecados.pagina.value = pagina;
	document.mostraRecados.quantidade.value = quantidade;
	document.mostraRecados.ordem.value = ordem;
	document.mostraRecados.action = "recado.php";
	document.mostraRecados.submit();
}

function lerRecadoInicial(cod_recado, pasta, situacao)
{
	document.recadosInicial.cod_recado.value = cod_recado;
	document.recadosInicial.pasta.value = pasta;
	document.recadosInicial.situacao.value = situacao;
	document.recadosInicial.action = "../geral/recados/recado.php";
	document.recadosInicial.submit();
}

function novoRecado(pasta, pagina, quantidade, ordem, nomeForm)
{
	var formulario = eval("document." + nomeForm);
	formulario.pasta.value = pasta;
	formulario.pagina.value = pagina;
	formulario.quantidade.value = quantidade;
	formulario.ordem.value = ordem;
	formulario.acao.value = "novo";
	formulario.action = "formulario.php";
	formulario.submit();
}

function cadastrarRecado()
{
	if (document.recado.destinoRecado.value.length == 0)
	{
		window.alert("Selecione o destinatário na listagem de Participantes.");
	}
	else
		if (document.recado.assuntoRecado.value.length == 0)
		{
			window.alert("Campo Assunto em branco. Favor preênche-lo.");
			document.recado.assuntoRecado.focus();
		}
		else
			if (document.recado.mensagemRecado.value.length == 0)
			{
				window.alert("Campo Mensagem em branco. Favor preênche-lo.");
				document.recado.mensagemRecado.focus();
			}
			else
			{
				document.recado.action = "controle.php";
				document.recado.submit();
			}
}

function voltarRecado()
{
	document.recado.action = "recado.php";
	document.recado.submit();
}

function encaminharRecado()
{
	/*document.visualizaRecado.pagina.value = pagina;
	document.visualizaRecado.qtd_listagem.value = quantidade;
	document.visualizaRecado.ordenacao.value = ordem;*/
	document.visualizaRecado.acao.value = "encaminhar";
	document.visualizaRecado.action = "formulario.php";
	document.visualizaRecado.submit();
}

function responderRecado()
{
	/*document.visualizaRecado.pagina.value = pagina;
	document.visualizaRecado.qtd_listagem.value = quantidade;
	document.visualizaRecado.ordenacao.value = ordem;*/
	document.visualizaRecado.acao.value = "responder";
	document.visualizaRecado.action = "formulario.php";
	document.visualizaRecado.submit();
}

function responderRecadoATodos(pagina, quantidade, ordem)
{
	/*document.visualizaRecado.pagina.value = pagina;
	document.visualizaRecado.quantidade.value = quantidade;
	document.visualizaRecado.ordem.value = ordem;*/
	document.visualizaRecado.acao.value = "responderTodos";
	document.visualizaRecado.action = "formulario.php";
	document.visualizaRecado.submit();		
}
//

//Funções Arquivos do Fórum
var codigos_forum;
function lerForum(codigo, pagina, tela)
{
	document.tela_forum.cod_forum.value = codigo;
	document.tela_forum.pag.value = pagina;
	
	if (tela == "inicial")
		document.tela_forum.action = "forum/visualiza.php";
	else
		document.tela_forum.action = "visualiza.php";
		
	document.tela_forum.submit();
}

function marcaTodosForum(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_forum.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
			formulario.elements[i].checked = check;
	}
	atualizaCodigosForum();
}

function atualizaCodigosForum() 
{
	var codigosLocal;
	codigosLocal = '';

	destFormForum( 'tela_forum' );
	codigosLocal += codigos_forum;

	parent.window.document.tela_forum.codigosForum.value = codigosLocal;
}

function destFormForum(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigos_forum = "";
		return;
	}

	var contaChecked = 0;

	codigos_forum = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			codigos_forum += checkBox.name + ";";
			cod_linha = checkBox.value;
			tr = document.getElementById(cod_linha);
			tr.className = 'item_selecionado';
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.value;
				tr = document.getElementById(cod_linha);
				if (tr.className == 'item_selecionado')
					tr.className = checkBox.id;
			}
		
		if (formulario.elements[i].type == "checkbox")
			conta++;
	}
	
	if (contaChecked == conta)
		formulario.todos_forum.checked = true;
	else
		formulario.todos_forum.checked = false;
}

function cadastrarForum()
{
	if ((document.forum.assunto.value.length == 0) && (document.forum.acao.value == "novo_forum"))
	{
		window.alert("Campo Assunto em Branco.");
		document.forum.assunto.focus();
	}
	else
		if (document.forum.mensagem.value.length == 0)
		{
			window.alert("Campo Mensagem em Branco.");
			document.forum.mensagem.focus();
		}
		else
			document.forum.submit();
}

function enviaRespostaForum()
{
	if (document.tela_forum.mensagem.value.length == 0)
	{
		window.alert("Campo Mensagem em Branco.");
		document.tela_forum.mensagem.focus();
	}
	else
	{
		document.tela_forum.acao.value = "nova_msg";
		document.tela_forum.submit();
	}
}

function exibirResponderForum(cod_forum, citacao, tipo, acao)
{
	var url;
	
	if (acao == "citar")
	{
		document.tela_forum.citacao.value = citacao;
		document.tela_forum.tipo.value = tipo;
		document.tela_forum.acao.value = acao;
		document.tela_forum.cod_forum.value = cod_forum;
	}
	else
		if (acao == "responder")
		{
			document.tela_forum.cod_forum.value = cod_forum;
			document.tela_forum.acao.value = acao;
		}
	
	document.tela_forum.action = "responder.php";
	document.tela_forum.submit();
}

function novoForum()
{
	document.tela_forum.acao.value = "novo_forum";
	document.tela_forum.action = "formulario.php";
	document.tela_forum.submit();
}

function editarForum(cod_forum)
{
	if (cod_forum != "")
	{
		document.tela_forum.acao.value = "editar_forum";
		document.tela_forum.cod_forum.value = cod_forum;
		document.tela_forum.action = "formulario.php";
		document.tela_forum.submit();
	}
	else
		if (verificaCheckBox('tela_forum') == true)
		{
			if (verificaQtdeCheckBox('tela_forum') > 1)
			{
				window.alert("Atenção!!! A ação editar só permite 1(um) Tópico selecionado.");
			}
			else
				{
					document.tela_forum.action = "formulario.php";
					document.tela_forum.acao.value = "editar_forum";
					document.tela_forum.submit();
					//janela('EditarForum','formulario.php?cod_forum=' + cod_forum + '&acao_forum=editar_forum' ,100 ,100 ,650 ,410 ,0 , 0 , 0, 1, 1);
				}
		}
		else
			window.alert("Nenhum Tópico selecionado. Para prosseguir selecione o Tópico para edição.");
}

function excluirForum(cod_forum)
{
	if (cod_forum != "")
	{
		if (confirm ("Atenção!!!\n\nAo excluir este Tópico todas as mensagens vinculadas a ele serão excluídas!!!\n\nVocê tem certeza que deseja continuar?"))
		{		
			document.tela_forum.cod_forum.value = cod_forum + ";";
			document.tela_forum.acao.value = "excluir_forum";
			document.tela_forum.action = "controle.php";
			document.tela_forum.submit();
		}
	}
	else
	{
		if (verificaCheckBox('tela_forum') == true)
		{
			if (confirm ("Atenção!!!\n\nAo excluir este Tópico todas as mensagens vinculadas a ele serão excluídas!!!\n\nVocê tem certeza que deseja continuar?"))
			{
				
				document.tela_forum.acao.value = "excluir_forum";
				document.tela_forum.action = "controle.php";
				document.tela_forum.submit();
			}
		}
		else
			window.alert("Nenhum Fórum selecionado. Para prosseguir selecione pelo menos 1(um) Fórum.");
	}
}

function editarMsgForum(cod_mensagem, cod_forum, listagem)
{
	document.tela_forum.action = "formulario.php";
	document.tela_forum.cod_forum.value = cod_forum;
	document.tela_forum.cod_mensagem.value = cod_mensagem;
	document.tela_forum.listagem.value = listagem;
	document.tela_forum.acao.value = "editar_msg";
	document.tela_forum.submit();
}

function excluirMsgForum(cod_mensagem)
{
	if (confirm ("Você tem certeza que deseja excluir esta Mensagem?"))
	{
		document.tela_forum.action = "controle.php";
		document.tela_forum.acao.value = "excluir_msg";
		document.tela_forum.cod_mensagem.value = cod_mensagem;
		document.tela_forum.submit();
	}
}

function voltarForum(cod_forum, formulario)
{
	if (formulario == "visualiza")
	{
		document.tela_forum.action = "visualiza.php?cod_forum=" + cod_forum;
		document.tela_forum.submit();
	}
	else
		if (formulario == "formulario")
		{
			document.forum.action = "visualiza.php?cod_forum=" + cod_forum;
			document.forum.submit();
		}
}
//

//Funções Edital
function cadastraEdital()
{
	if (document.edital.assunto.value.length == 0)
	{
		window.alert("Campo Assunto em Branco.");
		document.edital.assunto.focus();
	}
	else
		if (document.edital.mensagem.value.length == 0)
		{
			window.alert("Campo Mensagem em Branco.");
			document.edital.mensagem.focus();
		}
		else
		{
			document.edital.action = "controle.php";
			document.edital.submit();
		}
}

function novoEdital(pagina, quantidade, ordem)
{
	document.visualizaEdital.pagina.value = pagina;
	document.visualizaEdital.quantidade.value = quantidade;
	document.visualizaEdital.ordem.value = ordem;
	document.visualizaEdital.acao.value = "novo";
	document.visualizaEdital.action = "formulario.php";
	document.visualizaEdital.submit();
}

function editarEdital(codigo, pagina, quantidade, ordem)
{
	document.visualizaEdital.cod_edital.value = codigo;
	document.visualizaEdital.pagina.value = pagina;
	document.visualizaEdital.quantidade.value = quantidade;
	document.visualizaEdital.ordem.value = ordem;
	document.visualizaEdital.acao.value = "editar";
	document.visualizaEdital.action = "formulario.php";
	document.visualizaEdital.submit();
}

function excluirEdital(codigo, pagina, quantidade, ordem, assunto)
{
	if (window.confirm("Você tem certeza que deseja remover o Edital \"" + assunto + "\"?"))
	{
		document.visualizaEdital.cod_edital.value = codigo;
		document.visualizaEdital.pagina.value = pagina;
		document.visualizaEdital.quantidade.value = quantidade;
		document.visualizaEdital.ordem.value = ordem;
		document.visualizaEdital.acao.value = "excluir";
		document.visualizaEdital.action = "controle.php";
		document.visualizaEdital.submit();
	}
}

//Funções Perfil	
function alternarAbas(IdAba)
{
	for (i = 0; i < vetorAbas.length; i++)
	{
		aba = document.getElementById(vetorAbas[i].idAba)
		
		if (vetorAbas[i].idAba != IdAba)
			aba.style.display = 'none';
		else
			aba.style.display = '';
	}	
}

function abaFerramentaParticipantes(id, diretorio, imagem, mensagem)
{
	aba = document.getElementById(id);
							
	if (aba.style.display == 'none')
		aba.style.display = '';
	else
		if (aba.style.display == '')
			aba.style.display = 'none';
			
	if (id == 'ferramentas')
	{
		mensagem = " Ferramentas";
		imagem = "imagem_ferramentas";
	}
	else
	{
		mensagem = " Sua Turma";
		imagem = "imagem_sua_turma";
	}

	imagem = document.getElementById(imagem);
							
	if (imagem.getAttribute('name') == 'minimizar')
	{
		diretorio = diretorio  + 'outros/node.jpg';
		imagem.setAttribute('src', diretorio);
		imagem.setAttribute('name', 'maximizar');
		imagem.setAttribute('title', 'Maximizar' + mensagem);
	}
	else
	{
		diretorio = diretorio  + 'outros/nodeclose.jpg';
		imagem.setAttribute('src', diretorio);
		imagem.setAttribute('name', 'minimizar');
		imagem.setAttribute('title', 'Minimizar' + mensagem);
	}
}
function abas(id)
{
	if (id == 'menu_esquerdo')
	{
		var aba_visivel = document.getElementById('menu_esquerdo_escondido');
		var aba_invisivel = document.getElementById(id);
		var td_menu = document.getElementById('td_menu_esquerdo');
		td_menu.setAttribute('width', '50');
		var td_linha = document.getElementById('td_linha_menu_esquerdo');
		td_linha.setAttribute('width', '54');
		td_linha.setAttribute('height', '100%');
		aba_visivel.style.display = '';
		aba_invisivel.style.display = 'none';
	}
	else
		if (id == 'menu_esquerdo_escondido')
		{
			var aba_visivel = document.getElementById('menu_esquerdo');
			var aba_invisivel = document.getElementById(id);
			var td_menu = document.getElementById('td_menu_esquerdo');
			td_menu.setAttribute('width', '230');
			var td_linha = document.getElementById('td_linha_menu_esquerdo');
			td_linha.setAttribute('width', '230');
			td_linha.setAttribute('height', '100%');
			aba_visivel.style.display = '';
			aba_invisivel.style.display = 'none';
		}
		else
			if (id == 'total_online')
			{
				var aba_visivel = document.getElementById('listagem_online');
				var aba_invisivel = document.getElementById(id);
				aba_visivel.style.display = '';
				aba_invisivel.style.display = 'none';
			}
			else
				if (id == 'listagem_online')
				{
					var aba_visivel = document.getElementById('total_online');
					var aba_invisivel = document.getElementById(id);
					aba_visivel.style.display = '';
					aba_invisivel.style.display = 'none';
				}
				else
					if (id == 'conteudoPlataforma')
					{
						var aba_visivel = document.getElementById('carregandoConteudo');
						var aba_invisivel = document.getElementById(id);
						aba_visivel.style.display = '';
						aba_invisivel.style.display = 'none';
					}
					else
					{
						var aba = document.getElementById(id);
							
						if (aba.style.display == 'none')
							aba.style.display = '';
						else
							if (aba.style.display == '')
								aba.style.display = 'none';
								
						if (id == 'destinatarios_recado')
						{
							var imagem = document.getElementById('barra');
							
							if (imagem.getAttribute('name') == 'barra_off')
							{
								imagem.setAttribute('src', '../../../imagens/outros/barra_on.gif');
								imagem.setAttribute('title', 'Maximizar Participantes');
								imagem.setAttribute('name', 'barra_on');
							}
							else
							{
								imagem.setAttribute('src', '../../../imagens/outros/barra_off.gif');
								imagem.setAttribute('title', 'Minimizar Participantes');
								imagem.setAttribute('name', 'barra_off');
							}
						}
						
						if (id == 'ultimosRecados')
						{
							var tabela_recados = document.getElementById('tabela_recados');
							var imagem_recados = document.getElementById('imagem_recados');
							
							if (imagem_recados.getAttribute('name') == 'minimizar')
							{
								imagem_recados.setAttribute('src', '../../imagens/outros/node.jpg');
								imagem_recados.setAttribute('name', 'maximizar');
								imagem_recados.setAttribute('title', 'Maximizar Últimos Recados');
								tabela_recados.setAttribute('height', '');
							}
							else
							{
								imagem_recados.setAttribute('src', '../../imagens/outros/nodeclose.jpg');
								imagem_recados.setAttribute('name', 'minimizar');
								imagem_recados.setAttribute('title', 'Minimizar Últimos Recados');
								tabela_recados.setAttribute('height', '100%');
							}
							
							var tabela_topicos = document.getElementById('tabela_topicos');
							var imagem_topicos = document.getElementById('imagem_topicos');
							
							if (imagem_topicos.getAttribute('name') == 'minimizar')
								tabela_topicos.setAttribute('height', '100%');
						}
						else
							if (id == 'ultimosTopicos')
							{
								var tabela_topicos = document.getElementById('tabela_topicos');
								var imagem_topicos = document.getElementById('imagem_topicos');
							
								if (imagem_topicos.getAttribute('name') == 'minimizar')
								{
									imagem_topicos.setAttribute('src', '../../imagens/outros/node.jpg');
									imagem_topicos.setAttribute('name', 'maximizar');
									imagem_topicos.setAttribute('title', 'Maximizar Últimas no Fórum');
									tabela_topicos.setAttribute('height', '');
								}
								else
								{
									imagem_topicos.setAttribute('src', '../../imagens/outros/nodeclose.jpg');
									imagem_topicos.setAttribute('name', 'minimizar');
									imagem_topicos.setAttribute('title', 'Minimizar Últimas no Fórum');
									tabela_topicos.setAttribute('height', '100%');
								}
								
								var tabela_recados = document.getElementById('tabela_recados');
								var imagem_recados = document.getElementById('imagem_recados');
							
								if (imagem_recados.getAttribute('name') == 'minimizar')
									tabela_recados.setAttribute('height', '100%');
							}
							else
								if (id == 'dadosPessoaisTelaInicial')
								{
									var tabela = document.getElementById('tabela_dados_pessoais');
									var imagem = document.getElementById('imagem_dados_pessoais');
								
									if (imagem.getAttribute('name') == 'minimizar')
									{
										imagem.setAttribute('src', '../../imagens/outros/node.jpg');
										imagem.setAttribute('name', 'maximizar');
										imagem.setAttribute('title', 'Maximizar Dados Pessoais');
										tabela.setAttribute('height', '');
									}
									else
									{
										imagem.setAttribute('src', '../../imagens/outros/nodeclose.jpg');
										imagem.setAttribute('name', 'minimizar');
										imagem.setAttribute('title', 'Minimizar Dados Pessoais');
										tabela.setAttribute('height', '100%');
									}
								}
								else
									if (id == 'boasVindas')
									{
										var tabela = document.getElementById('tabela_boas_vindas');
										var imagem = document.getElementById('imagem_boas_vindas');
									
										if (imagem.getAttribute('name') == 'minimizar')
										{
											imagem.setAttribute('src', '../../imagens/outros/node.jpg');
											imagem.setAttribute('name', 'maximizar');
											imagem.setAttribute('title', 'Maximizar Boas Vindas');
											tabela.setAttribute('height', '');
										}
										else
										{
											imagem.setAttribute('src', '../../imagens/outros/nodeclose.jpg');
											imagem.setAttribute('name', 'minimizar');
											imagem.setAttribute('title', 'Minimizar Boas Vindas');
											tabela.setAttribute('height', '100%');
										}
									}
								
						var td_linha = document.getElementById('td_linha_menu_esquerdo');
						td_linha.setAttribute('height', '100%');
						td_linha.style.overflow = 'auto';
					}
}

function selecionarAba(IdAba)
{
	this.idAba = IdAba;
}

function atualizaDadosPerfil()
{
	document.forms[0].action = "formulario.php?atualiza=true";	
	document.forms[0].submit();
}

function enviaDadosPerfil()
{
	var arq = document.forms[0].imagemNovaPerfil.value;
	arq = arq.toLowerCase();
	if ((validaImagem(arq) == false) && (arq != ""))
	{
		window.alert("Formato do Arquivo inválido");
		document.forms[0].imagemNovaPerfil.focus();
	}
	else
		document.forms[0].submit();
}

function visualizarPerfil(cod_participante)
{
	document.perfil_participante.cod_participante.value = cod_participante;
	document.perfil_participante.submit();
}

function alterarDadosPessoais()
{
	janela('Perfil','formulario.php#DadosPessoais' ,100 ,100 ,700 ,500 ,0 , 0 , 0, 1, 1);	
}

function alterarDadosProfissionais()
{
	janela('Perfil','formulario.php#DadosProfissionais' ,100 ,100 ,700 ,500 ,0 , 0 , 0, 1, 1);	
}

function alterarDadosCadastrais()
{
	janela('Perfil','formulario.php#DadosCadastrais' ,100 ,100 ,700 ,500 ,0 , 0 , 0, 1, 1)
}
//

//Funções Atividades
var cod_atividades;

function marcaTodasAtividades(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todas_atividades.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosAtividade();
}

function atualizaCodigosAtividade() 
{
	var codigosLocal;
	codigosLocal = '';

	destFormAtividade( 'visualizaAtividade' );
	codigosLocal += cod_atividades;

	parent.window.document.visualizaAtividade.codigos_atividades.value = codigosLocal;
}

function destFormAtividade(nomeForm) 
{
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		cod_atividades = "";
		return;
	}

	var contaChecked = 0;

	cod_atividades = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			cod_atividades += checkBox.name + ";";
			cod_linha = checkBox.value;
			tr = document.getElementById(cod_linha);
			tr.className = 'item_selecionado';
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.value;
				tr = document.getElementById(cod_linha);
				if (tr.className == 'item_selecionado')
					tr.className = checkBox.id;
			}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todas_atividades.checked = true;
	else
		formulario.todas_atividades.checked = false;
}

function novaAtividade()
{
	document.visualizaAtividade.acao.value = "novo";
	document.visualizaAtividade.action = "formulario.php";
	document.visualizaAtividade.submit();
}

function visualizarAtividade(cod_atividade)
{
	document.visualizaAtividade.cod_atividade.value = cod_atividade;
	document.visualizaAtividade.action = "visualiza.php";
	document.visualizaAtividade.submit();
}

function corrigirAtividade(cod_atividade, cod_aluno)
{
	document.editar_atividade.cod_aluno.value = cod_aluno;
	document.editar_atividade.cod_atividade.value = cod_atividade;
	document.editar_atividade.action = "corrigir.php";
	document.editar_atividade.submit();
}

function anexarArquivoAtividadeAluno(cod_atividade, cod_aluno)
{
	document.editar_atividade.cod_aluno.value = cod_aluno;
	document.editar_atividade.cod_atividade.value = cod_atividade;
	document.editar_atividade.action = "anexar.php";
	document.editar_atividade.submit();
}

function excluirArquivoAtividadeAluno(cod_atividade, cod_aluno)
{
	if (confirm ("Você tem certeza que deseja excluir este Arquivo?"))
	{
		document.editar_atividade.acao.value = "excluir_anexo_aluno";
		document.editar_atividade.cod_aluno.value = cod_aluno;
		document.editar_atividade.cod_atividade.value = cod_atividade;
		document.editar_atividade.action = "controle.php";
		document.editar_atividade.submit();
	}
}

function cadastrarAtividade()
{
	var erroData = false;
	
	if (document.cad_atividade.acao.value == "novo")
	{	
		var diaEntrega = document.cad_atividade.dia.value;
		var mesEntrega = parseInt(document.cad_atividade.mes.value) - 1;
		var anoEntrega = document.cad_atividade.ano.value;
		var horaEntrega = document.cad_atividade.hora.value;
		var minutosEntrega = document.cad_atividade.minuto.value;
		var segundosEntrega = 0;
		var dataEntrega = new Date(anoEntrega, mesEntrega, diaEntrega, horaEntrega, minutosEntrega, segundosEntrega);
		var dataAtual = new Date();
		var diaAtual = dataAtual.getDate();
		var mesAtual = parseInt(dataAtual.getMonth()) + 1;
		var anoAtual = dataAtual.getFullYear();
		var erroData = false;
	
		if (dataEntrega < dataAtual)
			erroData = true;
		else
			erroData = false;
		
		if (erroData == true)
			window.alert("A data da Atividade não pode ser menor que a data Atual, considerando dia, mês, ano, horas e minutos.\n\nFavor verificar a Data e Hora de Entrega definidos para esta Atividade.");
	}
					
	if (document.cad_atividade.titulo_atividade.value.length == 0)
	{
		window.alert("Campo Atividade em Branco.");
		document.cad_atividade.titulo_atividade.focus();
	}
	else
		if (document.cad_atividade.descricao.value.length == 0)
		{
			window.alert("Campo Descrição em Branco.");
			document.cad_atividade.descricao.focus();
		}
		else
			if (document.cad_atividade.valor.value.length == 0)
			{
				window.alert("Campo Valor em Branco.");
				document.cad_atividade.valor.focus();
			}
			else
				if (erroData == false)
				{
					document.cad_atividade.action = "controle.php";
					document.cad_atividade.submit();
				}
}

function contaInput(tipoInput, nomeForm)
{
	var formulario = eval("document." + nomeForm);
	var tipo = tipoInput;
	var total = 0;

	for (i = 1; i < formulario.elements.length; i++)
	{			
		if (formulario.elements[i].type == tipo)
		{
			total++;	
		}
	}
	
	return total;
}

function adicionaInput(contador, nomeForm, tipoInput)
{
	var contador = contador + 1;
	var formulario = document.getElementById(nomeForm);
	var table = document.createElement("table");
	var tbody = document.createElement("tbody");
	
	var tr_linha = document.createElement("tr");
	var td_linha = document.createElement("td");
	
	var tr = document.createElement("tr");
	var td_titulo = document.createElement("td");
	var td_espaco = document.createElement("td");
	var td_input = document.createElement("td");
	
	var tr_descr = document.createElement("tr");
	var td_descr_titulo = document.createElement("td");
	var td_descr_espaco = document.createElement("td");
	var td_descr_input = document.createElement("td");
	
	var input = document.createElement("input");
	var input_descr = document.createElement("textarea");
	var link_input = document.createElement("a");
	
	//Define Linha
	td_linha.setAttribute("colspan", "3");
	td_linha.setAttribute("height", "15");
	tr_linha.appendChild(td_linha);
	
	//Define Link de Remoçãoo
    link_input.innerHTML = "Remover Item";
	link_input.setAttribute("id", "link_" + contador);
	link_input.setAttribute("onClick", "JavaScript: removeInput(" + contador + ", '" + nomeForm + "', '" + tipoInput + "' )");
	link_input.setAttribute("onMouseOver", "JavaScript: window.status = 'Remover Item'");
	link_input.setAttribute("onMouseOut", "JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online'");
	link_input.setAttribute("style", "cursor:pointer");
	link_input.setAttribute("class", "link_laranja");
	
	//Define propriedades do Input
	input.setAttribute("type", "file");
	input.setAttribute("name", "anexo_" + contador);
	input.setAttribute("id", "anexo_" + contador);
	
	//Define propriedades do Input Descr
	input_descr.setAttribute("name", "descr_anexo_" + contador);
	input_descr.setAttribute("id", "descr_anexo_" + contador);
	input_descr.setAttribute("cols", 45);
	input_descr.setAttribute("cells", 15);
	input_descr.setAttribute("size", "50");
	
	//Define Atributos da Tabela, Tbody, TR
	table.setAttribute("id", "table_" + contador);
	table.setAttribute("width", "100%");
	table.setAttribute("border", "0");
	table.setAttribute("cellpadding", "0");
	table.setAttribute("cellspacing", "0");
	tbody.setAttribute("id", "tbody_" + contador);
	
	//Define Atributos dos TD´s
	td_descr_titulo.setAttribute("width", "100");
	td_descr_titulo.setAttribute("align", "right");
	td_descr_titulo.setAttribute("valign", "top");
	td_descr_espaco.setAttribute("width", "10");
	td_descr_input.setAttribute("align", "left");
	
	td_titulo.setAttribute("id", "td_titulo_" + contador);
	td_titulo.setAttribute("width", "100");
	td_titulo.setAttribute("align", "right");
	td_espaco.setAttribute("width", "10");
	td_input.setAttribute("align", "left");
	
	//Acrescenta valor ao TD e vincula ao TR respectivo
	td_titulo.innerHTML = "<font class=\"preto\">Anexo " + contador + "</font>";
	td_input.appendChild(input);
	td_input.appendChild(link_input);
	tr.appendChild(td_titulo);
	tr.appendChild(td_espaco);
	tr.appendChild(td_input);
	
	td_descr_titulo.innerHTML = "<font class=\"preto\">Descrição</font>";
	td_descr_input.appendChild(input_descr);
	tr_descr.appendChild(td_descr_titulo);
	tr_descr.appendChild(td_descr_espaco);
	tr_descr.appendChild(td_descr_input);
	
	//Vincula elemntos TBODY com TABLE e TABLE com TR e no fim com o FORMULARIO
	tbody.appendChild(tr);
	tbody.appendChild(tr_descr);
	tbody.appendChild(tr_linha);
	table.appendChild(tbody);
	formulario.appendChild(table);
	
	document.forms[0].total_anexo.value = contaInput(tipoInput, 'cad_atividade');
}

function removeInput(id, nomeForm, tipoInput)
{
	var anexos = contaInput(tipoInput, 'cad_atividade');
	var formulario = document.getElementById('files');
	var table = document.getElementById("table_" + id);
	formulario.removeChild(table);
	
	document.forms[0].total_anexo.value = contaInput(tipoInput, 'cad_atividade');
	
	atualizaAnexos(id, "Anexo ", anexos, 'cad_atividade')
}

function atualizaAnexos(id, texto, anexos, nomeForm)
{
	for (i = 1; i < (anexos + 1); i++) 
	{
		var tbody = document.getElementById("tbody_" + i);
		var table = document.getElementById("table_" + i);
		var td = document.getElementById("td_titulo_" + i); 
		var input = document.getElementById("anexo_" + i);
		var input_descr = document.getElementById("descr_anexo_" + i);
		var link_input = document.getElementById("link_" + i);
		
		if (td != null)
		{
			if (i > id)
				numero = i - 1;
			else
				numero = i;
			
			tbody.setAttribute("id", "tbody_" + numero);
			table.setAttribute("id", "table_" + numero);
			td.setAttribute("id", "td_titulo_" + numero);
			td.innerHTML = "<font class=\"preto\">" + texto + numero + "</font>";
			input.setAttribute("name", "anexo_" + numero);
			input.setAttribute("id", "anexo_" + numero);
			input_descr.setAttribute("name", "descr_anexo_" + numero);
			input_descr.setAttribute("id", "descr_anexo_" + numero);
			link_input.setAttribute("onClick", "JavaScript: removeInput(" + numero + ", '" + nomeForm + "')");
			link_input.setAttribute("id", "link_" + numero);
		}
	}
}

function adicionaAnexo(contador, nomeForm, cod_arquivo, nome_arquivo, descr_arquivo)
{
	var formulario = document.getElementById(nomeForm);
	var table = document.createElement("table");
	var tbody = document.createElement("tbody");
	
	var tr = document.createElement("tr");
	var td_input = document.createElement("td");
	var td_titulo = document.createElement("td");
	var td_espaco = document.createElement("td");
	var td_anexo = document.createElement("td");
	
	var tr_descr = document.createElement("tr");
	var td_descr_titulo = document.createElement("td");
	var td_descr_espaco = document.createElement("td");
	var td_descr_input = document.createElement("td");
	
	var input_descr = document.createElement("textarea");
	var link_anexo = document.createElement("a");
	var link_remover = document.createElement("a");
	
	//var anexo = "<a href=\"download.php?arquivo=" + nome_arquivo + "\" class=\"link_laranja\">" + descr_arquivo + "</a>&nbsp;&nbsp;<a onClick=\"JavaScript: removeAnexo('" + contador + "', '" + nomeForm + "', " + cod_arquivo + " )\" class=\"link_laranja\">Remover Anexo</a>";
	//var input_descr = "<input type=\"text\" name=\"descr_anexo_" + contador + "\" width=\"140\" value=\"" + descr_arquivo + "\" />";
	
	//Define Atributos da Tabela, Tbody, TR
	table.setAttribute("id", "table_anexo_" + contador);
	table.setAttribute("width", "100%");
	table.setAttribute("border", "0");
	table.setAttribute("cellpadding", "0");
	table.setAttribute("cellspacing", "0");
	tbody.setAttribute("id", "tbody_anexo_" + contador);
	
	//Define Atributos dos TD´s
	td_descr_titulo.setAttribute("width", "140");
	td_descr_titulo.setAttribute("align", "right");
	td_descr_titulo.setAttribute("valign", "top");
	td_descr_espaco.setAttribute("width", "10");
	td_descr_input.setAttribute("align", "left");
	
	td_titulo.setAttribute("width", "140");
	td_titulo.setAttribute("align", "right");
	td_espaco.setAttribute("width", "10");
	td_input.setAttribute("align", "left");
	
	//Define propriedades do Input Descr
	input_descr.setAttribute("name", "descr_anexo_" + contador);
	input_descr.setAttribute("id", "descr_anexo_" + contador);
	input_descr.setAttribute("cols", 45);
	input_descr.setAttribute("cells", 15);
	input_descr.setAttribute("size", "50");
	input_descr.innerHTML = descr_arquivo;
	
	//Define Link do Arquivo
    link_anexo.innerHTML = descr_arquivo + "&nbsp;&nbsp;";
	link_anexo.setAttribute("onClick", "download.php?arquivo=" + nome_arquivo + "\"");
	link_anexo.setAttribute("onMouseOver", "JavaScript: window.status = 'Abrir Arquivo " + descr_arquivo + "'");
	link_anexo.setAttribute("onMouseOut", "JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online'");
	link_anexo.setAttribute("style", "cursor:pointer");
	link_anexo.setAttribute("class", "link_laranja");
	
	//Define Link de Remoção
    link_remover.innerHTML = "Remover Anexo";
	link_remover.setAttribute("id", "link_" + contador);
	link_remover.setAttribute("onClick", "removeAnexo('" + contador + "', '" + nomeForm + "', " + cod_arquivo + ")");
	link_remover.setAttribute("onMouseOver", "JavaScript: window.status = 'Remover Anexo'");
	link_remover.setAttribute("onMouseOut", "JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online'");
	link_remover.setAttribute("style", "cursor:pointer");
	link_remover.setAttribute("class", "link_laranja");
	
	//Acrescenta valor ao TD e vincula ao TR respectivo
	td_titulo.innerHTML = "<font class=\"preto\">Anexo " + contador + "</font>";
	td_input.appendChild(link_anexo);
	td_input.appendChild(link_remover);
	tr.appendChild(td_titulo);
	tr.appendChild(td_espaco);
	tr.appendChild(td_input);
	
	td_descr_titulo.innerHTML = "<font class=\"preto\">Descrição</font>";
	td_descr_input.appendChild(input_descr);
	tr_descr.appendChild(td_descr_titulo);
	tr_descr.appendChild(td_descr_espaco);
	tr_descr.appendChild(td_descr_input);
	
	//Vincula elemntos TBODY com TABLE e TABLE com TR e no fim com o FORMULARIO
	tbody.appendChild(tr);
	tbody.appendChild(tr_descr);
	table.appendChild(tbody);
	//tbody.appendChild(table);
	formulario.appendChild(table);
}

function removeAnexo(id, nomeForm, cod_arquivo)
{
	var formulario = document.getElementById(nomeForm);
	var table = document.getElementById("table_anexo_" + id);
	formulario.removeChild(table);
	cod_arquivo = cod_arquivo + ";";
	
	document.forms[0].cod_arquivos.value = document.forms[0].cod_arquivos.value + cod_arquivo;
}

function editarAtividade()
{
	if (verificaCheckBox('visualizaAtividade') == true)
	{
		if (verificaQtdeCheckBox('visualizaAtividade') > 1)
		{
			window.alert("Atenção!!! A ação editar só permite 1(uma) Atividade selecionada.");
		}
		else
			{
				document.visualizaAtividade.cod_atividade.value = document.visualizaAtividade.codigos_atividades.value;
				document.visualizaAtividade.acao.value = "editar";
				document.visualizaAtividade.action = "formulario.php";
				document.visualizaAtividade.submit();
			}
	}
	else
		window.alert("Nenhuma Atividade selecionada. Para prosseguir selecione a Atividade para edição.");
}

function excluirAtividade()
{
	if (verificaCheckBox('visualizaAtividade') == true)
	{
		if (confirm ("Atenção!\n\nAo excluir a(s) Atividade(s) todos os arquivos Anexados (Material de Apoio e Atividades Enviadas pelos Alunos) serão excluídos!\n\nVocê tem certeza que deseja continuar?"))
		{
			document.visualizaAtividade.acao.value = "excluir";
			document.visualizaAtividade.action = "controle.php";
			document.visualizaAtividade.submit();
			//var cod_atividade = document.visualizaAtividade.codigos_atividades.value;
			//janela('ExcluirAtividade','excluir.php?codigos_atividades=' + cod_atividade ,100 ,100 ,600 ,200 ,0 , 0 , 0, 1, 1);
		}
	}
	else
		window.alert("Nenhuma Atividade selecionada. Para prosseguir selecione pelo menos 1(uma) Atividade.");
}

function encaminharAtividade()
{
	if (document.forms[0].arquivo_atividade_usuario.value == "")
	{
		window.alert("Para prosseguir você deve anexar o Arquivo de Atividade.");
		document.forms[0].arquivo_atividade_usuario.focus();
	}
	else
		{
			document.forms[0].submit();
		}
}
//

//Funções Conteúdo
var cod_conteudos;

function marcaTodosConteudos(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_conteudos.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosConteudo();
}

function atualizaCodigosConteudo() 
{
	var codigosLocal;
	codigosLocal = '';

	destFormConteudo( 'mostra_conteudo' );
	codigosLocal += cod_conteudos;

	parent.window.document.mostra_conteudo.codigos_conteudos.value = codigosLocal;
}

function destFormConteudo(nomeForm) 
{
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		cod_conteudos = "";
		return;
	}

	var contaChecked = 0;

	cod_conteudos = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			cod_conteudos += checkBox.name + ";";
			
			cod_linha = checkBox.value;
			tr = document.getElementById(cod_linha);
			tr.className = 'item_selecionado';
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.value;
				tr = document.getElementById(cod_linha);
				if (tr.className == 'item_selecionado')
					tr.className = checkBox.id;
			}
		
		if (formulario.elements[i].type == "checkbox")
			conta++;
	}
	
	if (contaChecked == conta)
		formulario.todos_conteudos.checked = true;
	else
		formulario.todos_conteudos.checked = false;
}

function tipoConteudo(acao, conteudo, descricao, tipo, diretorio, inputSelect, protegido, principal)
{
	var formulario = document.getElementById('cad_conteudo');
	var td = document.getElementById("conteudo");
	
	if (acao == "novo")
	{
		if (document.cad_conteudo.tipo_conteudo.selectedIndex == 5)
		{
			input = "<input type=\"text\" name=\"nome_conteudo\" value=\"" + conteudo + "\">";
			conteudo_descricao = "<input type=\"text\" maxlength=\"255\" size=\"50\" name=\"descricao_conteudo\" value=\"" + descricao + "\">";
		}
		else
			if (document.cad_conteudo.tipo_conteudo.selectedIndex != 6)
			{
				input = "<input type=\"file\" accept=\"\" name=\"nome_conteudo\">";
				conteudo_descricao = "<input type=\"text\" maxlength=\"255\" size=\"50\" name=\"descricao_conteudo\">";
			}
	}
	else
		if (acao == "editar")
		{
			if (tipo == "site")
			{
				input = "<input type=\"text\" name=\"nome_conteudo\" value=\"" + conteudo + "\">";
				conteudo_descricao = "<input type=\"text\" maxlength=\"255\" size=\"50\" name=\"descricao_conteudo\" value=\"" + descricao + "\">";
			}
			else
			{
				link_conteudo = "<a OnClick=\"JavaScript: visualizaConteudo('" + diretorio + "');\" style='cursor: pointer' class='link_magenta'>" + conteudo + "</a>";
				input = link_conteudo;
				conteudo_descricao = "<input type=\"text\" maxlength=\"255\" size=\"50\" name=\"descricao_conteudo\" value=\"" + descricao + "\">";
			}
		}
	
	if ((document.cad_conteudo.tipo_conteudo.selectedIndex == 1) || (document.cad_conteudo.tipo_conteudo.selectedIndex == 2) || (document.cad_conteudo.tipo_conteudo.selectedIndex == 3) || (document.cad_conteudo.tipo_conteudo.selectedIndex == 4))
	{
		var conteudo = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">" +
					   "  <tr>" + 
					   "	 <td class=\"preto\" width=\"140\" align=\"right\">Arquivo:</td>" +
					   "	 <td width=\"10\">&nbsp;</td>" +
					   "	 <td align=\"left\">" + input + "</td>" +
					   "  </tr>" +
		               "  <tr> " +
					   "	 <td colspan=\"3\"  height=\"15\"></td>" +
		               "  </tr>" +
		               "  <tr>" +
					   "	 <td class=\"preto\" align=\"right\" valign=\"top\">Descri&ccedil;&atilde;o:</td>" +
					   "	 <td>&nbsp;</td>" +
					   "	 <td align=\"left\">" + conteudo_descricao + "</td>" +
					   "  </tr>" +
					   "  <tr>" + 
					   "	 <td colspan=\"3\"  height=\"15\"></td>" +
					   "  </tr>" +
					   "  <tr>" + 
					   "	 <td class=\"preto\" align=\"right\" valign=\"top\">Hierarquia:</td>" +
					   "	 <td width=\"10\">&nbsp;</td>" +
					   "	 <td class=\"preto\" align=\"left\">" + inputSelect + "</td>" +
					   "  </tr>" +
					   "  <tr>" + 
					   "	 <td colspan=\"3\"  height=\"15\"></td>" +
					   "  </tr>" +
					   "  <tr>" + 
					   "	 <td class=\"preto\" align=\"right\" valign=\"top\">Coteúdo Principal?</td>" +
					   "	 <td width=\"10\">&nbsp;</td>";
					   
					   if (principal == 'S')
					   {
					   		conteudo+= "	 <td class=\"preto\" align=\"left\"><input type=\"radio\" name=\"principal\" value=\"sim\" checked>Sim&nbsp;&nbsp;<input type=\"radio\" name=\"principal\" value=\"nao\">Não";
					   }
					   else
					   {
							conteudo+= "	 <td class=\"preto\" align=\"left\"><input type=\"radio\" name=\"principal\" value=\"sim\">Sim&nbsp;&nbsp;<input type=\"radio\" name=\"principal\" value=\"nao\" checked>Não";
					   }
					   
					   conteudo+=  "  </tr>" +
								   "  <tr>" + 
								   "	 <td colspan=\"3\"  height=\"15\"></td>" +
								   "  </tr>" +
								   "  <tr>" + 
								   "	 <td class=\"preto\" align=\"right\" valign=\"top\">Conteúdo Protegido?</td>" +
								   "	 <td width=\"10\">&nbsp;</td>";
					   
					   if (protegido == 'S')
					   {
					   		conteudo+= "	 <td class=\"preto\" align=\"left\"><input type=\"radio\" name=\"protegido\" value=\"sim\" checked>Sim&nbsp;&nbsp;<input type=\"radio\" name=\"protegido\" value=\"nao\">Não";
					   }
					   else
					   {
							conteudo+= "	 <td class=\"preto\" align=\"left\"><input type=\"radio\" name=\"protegido\" value=\"sim\">Sim&nbsp;&nbsp;<input type=\"radio\" name=\"protegido\" value=\"nao\" checked>Não";
					   }
					   
					   conteudo+=  "  </tr>" +
					   			   "</table>";
					 
		td.innerHTML = conteudo;
	}
	else
		if (document.cad_conteudo.tipo_conteudo.selectedIndex == 5)
		{
			var conteudo = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">" +
						   "  <tr>" + 
						   "     <td class=\"preto\" width=\"140\" align=\"right\">Link do Site:</td>" +
						   "	 <td width=\"10\">&nbsp;</td>" +
						   "	 <td align=\"left\">" + input + "</td>" +
						   "  </tr>" +
						   "  <tr>" + 
						   "	 <td colspan=\"3\"  height=\"15\"></td>" +
						   "  </tr>" +
						   "  <tr>" + 
						   "	 <td class=\"preto\" align=\"right\" valign=\"top\">Descri&ccedil;&atilde;o:</td>" +
						   "	 <td width=\"10\">&nbsp;</td>" +
						   "	 <td align=\"left\">" + conteudo_descricao + "</td>" +
						   "  </tr>" +
						   "  <tr>" + 
					  	   "	 <td colspan=\"3\"  height=\"15\"></td>" +
					       "  </tr>" +
					       "  <tr>" + 
					       "	 <td class=\"preto\" align=\"right\" valign=\"top\">Hierarquia:</td>" +
					       "	 <td width=\"10\">&nbsp;</td>" +
					       "	 <td class=\"preto\" align=\"left\"> " + inputSelect + "</td>" +
					       "  </tr>" +
						   "</table>";
						   
			td.innerHTML = conteudo;
		}
		else
			if (document.cad_conteudo.tipo_conteudo.selectedIndex == 0)
			{
				var conteudo = "&nbsp;";
				
				td.innerHTML = conteudo;
			}
}

function novoConteudo()
{
	document.novo_conteudo.acao.value = "novo";
	document.novo_conteudo.action = "formulario.php";
	document.novo_conteudo.submit();
}

function visualizaConteudo(cod_conteudo, diretorio, tipo_conteudo)
{
	if (tipo_conteudo == "html")
		janela('VisualizaConteudoPlataforma', diretorio, 100 ,100 ,610 ,450 ,0 ,0 ,0, 1, 1);
	else
		janela('VisualizaConteudoPlataforma', "visualiza.php?cod_conteudo=" + cod_conteudo + "&diretorio=" + diretorio, 100 ,100 ,450 ,150 ,0 ,0 ,0, 1, 1);
}

function verificaAcessoConteudo(cod_conteudo, cod_usuario, diretorio_conteudo, tipo_conteudo)
{
	janela('VerificaAcessoConteudo', "verifica_acesso.php?cod_conteudo=" + cod_conteudo + "&cod_usuario=" + cod_usuario + "&diretorio=" + diretorio_conteudo + "&tipo_conteudo=" + tipo_conteudo, 100 ,100 ,280 ,140 ,0 , 0 , 0, 1, 1);
}

function cadastrarConteudo()
{					
	if (document.cad_conteudo.tipo_conteudo.selectedIndex == 0)
	{
		window.alert("Selecione o Tipo do Conteúdo.");
		document.cad_conteudo.tipo_conteudo.focus();
	}
	else
		if (document.cad_conteudo.acao.value == "novo_conteudo")
		{
			if ((document.cad_conteudo.nome_conteudo.value.length == 0) || (document.cad_conteudo.nome_conteudo.value.length == ""))
			{
				window.alert("Campo Contéudo em Branco.");
				document.cad_conteudo.nome_conteudo.focus();
			}
			else
				if ((document.cad_conteudo.descricao_conteudo.value.length == 0) || (document.cad_conteudo.nome_conteudo.value.length == ""))
				{
					window.alert("Campo Descrição em Branco.");
					document.cad_conteudo.descricao_conteudo.focus();
				}
				else
				{
					document.cad_conteudo.action = "controle.php";
					document.cad_conteudo.submit();
				}
		}
		else
			if (document.cad_conteudo.tipo_conteudo.selectedIndex == 5)
			{
				if ((document.cad_conteudo.nome_conteudo.value.length == 0) || (document.cad_conteudo.nome_conteudo.value.length == ""))
				{
					window.alert("Campo Contéudo em Branco.");
					document.cad_conteudo.nome_conteudo.focus();
				}
				else
					if ((document.cad_conteudo.descricao_conteudo.value.length == 0) || (document.cad_conteudo.nome_conteudo.value.length == ""))
					{
						window.alert("Campo Descrição em Branco.");
						document.cad_conteudo.descricao_conteudo.focus();
					}
					else
					{
						document.cad_conteudo.action = "controle.php";
						document.cad_conteudo.submit();
					}
			}
			else
			{
				if ((document.cad_conteudo.descricao_conteudo.value.length == 0))
				{
					window.alert("Campo Descrição em Branco.");
					document.cad_conteudo.descricao_conteudo.focus();
				}
				else
				{
					document.cad_conteudo.action = "controle.php";
					document.cad_conteudo.submit();
				}
			}		
}

function editarConteudo()
{
	if (verificaCheckBox('mostra_conteudo') == true)
	{
		if (verificaQtdeCheckBox('mostra_conteudo') > 1)
		{
			window.alert("Atenção!!! A ação editar só permite 1(um) Conteúdo selecionado.");
		}
		else
			{
				document.mostra_conteudo.cod_conteudo.value = document.mostra_conteudo.codigos_conteudos.value;
				document.mostra_conteudo.acao.value = "editar";
				document.mostra_conteudo.action = "formulario.php";
				document.mostra_conteudo.submit();
			}
	}
	else
		window.alert("Nenhum Conteúdo selecionado. Para prosseguir selecione o Conteúdo para edição.");
}

function excluirConteudo()
{
	if (verificaCheckBox('mostra_conteudo') == true)
	{
		if (window.confirm("Você tem certeza que deseja remover o(s) Conteúdo(s) selecionado(s)?"))
		{
			document.mostra_conteudo.acao.value = "excluir";
			document.mostra_conteudo.action = "controle.php";
			document.mostra_conteudo.submit();
		}
	}
	else
		window.alert("Nenhum Conteúdo selecionado. Para prosseguir selecione pelo menos 1(um) Conteúdo.");
}

function permissaoConteudo(pagina, quantidade, ordem, cod_conteudo)
{
	document.mostra_conteudo.pagina.value = pagina;
	document.mostra_conteudo.quantidade.value = quantidade;
	document.mostra_conteudo.ordem.value = ordem;
	document.mostra_conteudo.cod_conteudo.value = cod_conteudo;
	document.mostra_conteudo.action = "permissao.php";
	document.mostra_conteudo.submit();
}

function marcaTodosPermissao(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_permissao.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosPermissao();
}

function atualizaCodigosPermissao() 
{
	var codigosLocal;
	codigosLocal = '';

	destFormPermissao( 'permissao_usuario' );
	codigosLocal += cod_conteudos;

	parent.window.document.permissao_usuario.codigos_permissao.value = codigosLocal;
}

function destFormPermissao(nomeForm) 
{
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		cod_conteudos = "";
		return;
	}

	var contaChecked = 0;

	cod_conteudos = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		
		if ( checkBox.checked ) 
		{
			contaChecked++;
			cod_conteudos += checkBox.name + ";";
			cod_linha = checkBox.name;
				
			tr = document.getElementById(cod_linha);
			tr.className = 'item_selecionado';
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.name;
					
				tr = document.getElementById(cod_linha);
				if (tr.className == 'item_selecionado')
					tr.className = checkBox.id;
			}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todos_permissao.checked = true;
	else
		formulario.todos_permissao.checked = false;
}
//

//Bate Papo
function marcaTodasSalasBatePapo(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todas_salas_bate_papo.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
			formulario.elements[i].checked = check;
	}
	
	atualizaSalasBatePapo();
}

function atualizaSalasBatePapo() 
{
	var codigosLocal;
	codigosLocal = '';
	
	destinoSalasBatePapo( 'salas_bate_papo' );
	codigosLocal += codigosBatePapo;

	parent.window.document.salas_bate_papo.codigosSalasBatePapo.value = codigosLocal;
}

var codigosBatePapo;
function destinoSalasBatePapo(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigosBatePapo = "";
		return;
	}

	var contaChecked = 0;

	codigosBatePapo = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
				
			codigosBatePapo += checkBox.name + ";";
			cod_linha = checkBox.name;
			if (cod_linha != 'todas_salas_bate_papo')
			{
				tr = document.getElementById(cod_linha);
				tr.className = 'item_selecionado';
			}
		}
		else
			if (formulario.elements[i].type == "checkbox")
			{
				cod_linha = checkBox.name;
				
				if (cod_linha != 'todas_salas_bate_papo')
				{
					tr = document.getElementById(cod_linha);
					if (tr.className == 'item_selecionado')
						tr.className = checkBox.id;
				}
			}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;
		}
	}
	
	if (contaChecked == conta)
		formulario.todas_salas_bate_papo.checked = true;
	else
		formulario.todas_salas_bate_papo.checked = false;
}

function abreSalaBatePapo(cod_sala)
{
	document.salas_bate_papo.cod_sala_bate_papo.value = cod_sala;
	document.salas_bate_papo.action = "registra.php";
	document.salas_bate_papo.submit();
}

function novaSalaBatePapo()
{
	document.salas_bate_papo.acao_bate_papo.value = "novo_bate_papo";
	document.salas_bate_papo.action = "formulario.php";
	document.salas_bate_papo.submit();
}

function salaBatePapoFechada(cod_sala)
{
	janela('SalaBatePapoFechada','aviso_sala_bate_papo.php', 100 ,100 ,380 ,240 ,0 , 0 , 0, 1, 1);
}

function editarSalaBatePapo()
{
	if (verificaCheckBox('salas_bate_papo') == true)
	{
		if (verificaQtdeCheckBox('salas_bate_papo') > 1)
		{
			window.alert("Atenção!!! A ação editar só permite 1(uma) Sala de Bate Papo selecionada.");
		}
		else
			{
				document.salas_bate_papo.cod_sala_bate_papo.value = document.salas_bate_papo.codigosSalasBatePapo.value;
				document.salas_bate_papo.acao_bate_papo.value = "editar_bate_papo";
				document.salas_bate_papo.action = "formulario.php";
				document.salas_bate_papo.submit();
			}
	}
	else
		window.alert("Nenhuma Sala de Bate Papo selecionada. Para prosseguir selecione a Sala de Bate Papo para edição.");
}

function encerrarSalaBatePapo()
{
	if (verificaCheckBox('salas_bate_papo') == true)
	{
		document.salas_bate_papo.acao_bate_papo.value = "encerrar_bate_papo";
		document.salas_bate_papo.action = "controle.php";
		document.salas_bate_papo.submit();
	}
	else
		window.alert("Nenhuma Sala de Bate Papo selecionada. Para prosseguir selecione a(s) Sala(s) de Bate Papo que deverão ser encerrada(s).");
}

function excluirSalaBatePapo()
{
	if (verificaCheckBox('salas_bate_papo') == true)
	{
		if (verificaQtdeCheckBox('salas_bate_papo') > 1)
		{
			window.alert("Atenção!!! A ação excluir só permite 1(uma) Sala de Bate Papo selecionada.");
		}
		else
		{
			/*var conectados = document.getElementById('conectados_' + document.salas_bate_papo.codigosSalasBatePapo.value);
			totalConectados = conectados.getAttribute('value');
			window.alert(totalConectados);
			
			if (totalConectados > 0)
				window.alert("Esta Sala de Bate Papo não está vazia! Exclusão não permitida!");
			else*/
				if (window.confirm("Você tem certeza que deseja remover a(s) Sala(s) de Bate Papo selecionada(s)?"))
				{
					document.salas_bate_papo.cod_sala_bate_papo.value = document.salas_bate_papo.codigosSalasBatePapo.value;
					document.salas_bate_papo.acao_bate_papo.value = "excluir_bate_papo";
					document.salas_bate_papo.action = "controle.php";
					document.salas_bate_papo.submit();
				}
		}
	}
	else
		window.alert("Nenhuma Sala de Bate Papo selecionada. Para prosseguir selecione a Sala de Bate Papo que será excluída.");
}

function cadastrarSalaBatePapo()
{
	if (document.salas_bate_papo.nome_sala.value.length == 0)
	{
		window.alert("Campo Nome da Sala em Bracno.");
		document.salas_bate_papo.nome_sala.focus();
	}
	else
		if (document.salas_bate_papo.descricao_sala.value.length == 0)
		{
			window.alert("Campo Descrição em Bracno.");
			document.salas_bate_papo.descricao_sala.focus();
		}
		else
			if (document.salas_bate_papo.vagas_bate_papo.value.length == 0)
			{
				if (confirm ("Campo Vagas em Branco, nessa situação a Sala de Bate Papo não terá limite de Usuários.\n\nVocê tem certeza que deseja continuar?"))
				{
					document.salas_bate_papo.submit();
				}
			}
			else
			{
				document.salas_bate_papo.submit();
			}
}
/*
function recarregaBatePapo(frame, url, tempo)
{
	setTimeout("urlBatePapo(frame, url)", tempo);
}

function urlBatePapo(frame, url)
{
	window.parent.frames[frame].window.location = url;
}

function recarregaMensagensFormulario(frame_1, url_1, frame_2, url_2)
{		
	window.parent.frames[frame_1].window.location = url_1;
	window.parent.frames[frame_2].window.location = url_2;
}*/

function sairBatePapo()
{
	document.insere_mensagem_bate_papo.action = "sair_bate_papo.php";
	document.insere_mensagem_bate_papo.submit();
}

function mensagensBatePapo()
{
	var campo = window.parent.frames[1].document.getElementById("batePapoMensagens");	
	var http = Ajax();
	
	if ((clientNavigator == "IE") || (clientNavigator == "Opera"))
	{
 		http.open("POST", "exibe.php", true);
 	}
	else
	{
 		http.open("GET", "exibe.php", true);
 	}
	
	http.onreadystatechange = function() 
	{
		if(http.readyState == 4) 
		{
			if(http.status == 200)
			{
				var mensagem = document.createElement("span");
				var responsetext = http.responseText;
				mensagem.innerHTML = responsetext;
				mensagem.valign = "middle";
				campo.appendChild(mensagem);
			}
			else
			{
				<!-- ajax.statusText; -->
			}
			
		}
	}
	
	http.send(null);
	setTimeout("mensagensBatePapo(); verificaRolagemBatePapo();", 3000);
	//setTimeout("atualizaListaUsuarios();", 5000);
}

function pegaAjax()
{
	if (typeof(XMLHttpRequest)!='undefined')
		return new XMLHttpRequest();

    var axO=['Microsoft.XMLHTTP','Msxml2.XMLHTTP','Msxml2.XMLHTTP.6.0','Msxml2.XMLHTTP.4.0','Msxml2.XMLHTTP.3.0'];
	for (var i=0;i<axO.length;i++)
	{
		try
		{
			return new ActiveXObject(axO[i]);
		}
		catch(e)
		{
		}
	}
    
	return null;
}

function atualizaDiasdoMes(dia, mes, ano, nomeForm, campoDia)
{
	var http = pegaAjax();
	var formDiasdoMes = nomeForm;
	var campoDiadoMes = campoDia;
	
	if ((trim(dia) == "") || (trim(mes) == "") || (trim(ano) == ""))
	{
		return false;
	}
	else
	{
		if ((clientNavigator == "IE") || (clientNavigator == "Opera"))
		{
			http.open("POST", "../../geral/calcula.php?dia=" + dia + "&mes=" + mes + "&ano=" + ano, true);
		}
		else
		{
			http.open("GET", "../../geral/calcula.php?dia=" + dia + "&mes=" + mes + "&ano=" + ano, true);
		}
	
		function handleHttpResponse()
		{
			campo_select = eval("document." + formDiasdoMes + "." + campoDiadoMes);
		
			if (http.readyState == 4) 
			{
				campo_select.options.length = 0;
				results = http.responseText.split(";");
				for( i = 0; i < results.length; i++ )
				{
					string = results[i].split( "|" );
					campo_select.options[i] = new Option( string[0], string[0] );
					if (string[1] == "sim")
					  campo_select.options[i].selected = true;
				}
			}
		}
	
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
}

function verificaInput(id, input, opcao)
{
	var imagem = document.getElementById(id);
	
	if (opcao == 0)
	{
		if (trim(input.value) == 0)
			imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
		else
			imagem.setAttribute("src", "../../../imagens/outros/ok.gif");
	}
	else
		if (opcao == 1)
		{
			if (!validaCPF(input.value))
				imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
			else
				imagem.setAttribute("src", "../../../imagens/outros/ok.gif")
		}
		else
			if (opcao == 2)
			{
				if (!validaEmail(input.value))
					imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
				else
					imagem.setAttribute("src", "../../../imagens/outros/ok.gif")
			}
			else
				if (opcao == 3)
				{
					if (input.options[0].selected)
						imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
					else
						imagem.setAttribute("src", "../../../imagens/outros/spacer.gif")
				}
			
}

function formularioTurma(cod_curso)
{
	var http = pegaAjax();
	var total = 0;

	if (cod_curso != "")
	{
		if ((clientNavigator == "IE") || (clientNavigator == "Opera"))
		{
			http.open("POST", "pesquisa.php?cod_curso=" + cod_curso, true);
		}
		else
		{
			http.open("GET", "pesquisa.php?cod_curso=" + cod_curso, true);
		}
	
		function handleHttpResponse()
		{	
			if (http.readyState == 4) 
			{
				results = http.responseText.split("|");
				for(i = 0; i < results.length; i++)
				{
					string = results[i].split( "/" );
					if (total == 0)
					{
						document.turma_instituicao.dia_inicio.value = string[0];
						document.turma_instituicao.mes_inicio.value = string[1];
						document.turma_instituicao.ano_inicio.value = string[2];
					}
					else
					{
						document.turma_instituicao.dia_fim.value = string[0];
						document.turma_instituicao.mes_fim.value = string[1];
						document.turma_instituicao.ano_fim.value = string[2];
					}
					
					total = total + 1;
				}
			}
		}
		
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
}

var aviso = false;
function verificaDisponibilidadeLogin(login, nomeForm, campoLogin)
{
	var http = pegaAjax();
	var imagem = document.getElementById("imagem_login");
	var erro = 0;
	
	if (trim(login) == "")
	{
		imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
		erro = 1;
	}
	else
	{	
		if ((clientNavigator == "IE") || (clientNavigator == "Opera"))
		{
			http.open("POST", "valida.php?login=" + login, true);
		}
		else
		{
			http.open("GET", "valida.php?login=" + login, true);
		}
	
		function handleHttpResponse()
		{
			if (http.readyState == 4) 
			{
				var results = http.responseText;
				if (results == 1)
				{
					if (!aviso)
					{
						imagem.setAttribute("alt", "Login em uso por outro Usuário!");
						window.alert("Login indisponível!");
						campoLogin.focus();
						campoLogin.select();
						aviso = true;
					}
					
					imagem.setAttribute("src", "../../../imagens/outros/erro.gif");
					erro = 1;
				}
				else
				{
					imagem.setAttribute("src", "../../../imagens/outros/ok.gif");
					erro = 0;
					return true;
				}
			}
		}
	
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	if (erro > 0)
		return false;
	else
		return true;
}

function Ajax()
{
	try
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				return new XMLHttpRequest();
			}
			catch(e)
			{
				return false;
			}
		}
	}
}

function enviarMensagemBatePapo()
{
	var campo  =  window.parent.frames[2].document.getElementById("cadastra_mensagem_bate_papo");
	var http = Ajax();
	http.open("POST", "insere.php", true);
	http.send(null); 
	campo.value = ""; 
	campo.focus();
}
	
function getHTTPObject() 
{
	var xmlhttp;
	/*@cc_on
	@if (@_jscript_version >= 5)
	try 
	{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
	{
		try
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e)
		{
			xmlhttp = false;
		}
	}
	@else
		xmlhttp = false;
	@end @*/
		if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
		{
			try
			{
				xmlhttp = new XMLHttpRequest();
			}
			catch (e)
			{
				xmlhttp = false;
			}
		}
		
		return xmlhttp;
}

function verificaRolagemBatePapo()
{
	if (window.parent.frames[2].document.insere_mensagem_bate_papo.bate_papo_rolagem.checked)
	{
		rolagemBatePapo("sim");
	}
	else
	{
		rolagemBatePapo("nao");
	}
}	

function rolagemBatePapo(acao)
{
	if (acao == "sim")
		window.scroll(0, 999999999);
}

/*function atualizaListaUsuarios()
{
	window.parent.frames[4].window.location = "listar_usuarios.php";
	//window.alert("Recarregando usuarios");
}*/

function atualizaUsuariosFormEnvia()
{
	window.parent.frames[2].window.location = "mensagem_bate_papo.php";	
}
//

function adicionaSmilie(codigo, formulario)
{
	document.forms[0].mensagem.value = document.forms[0].mensagem.value + " " + codigo + " ";
	document.forms[0].mensagem.focus();
}

function adicionaSmilieBatePapo(codigo, formulario)
{
	var formulario = eval("window.opener.document." + formulario);
	formulario.mensagem_bate_papo.value = formulario.mensagem_bate_papo.value + " " + codigo + " ";
	formulario.mensagem_bate_papo.focus();
	window.close();
}

function adicionaSmilieRecado(codigo, formulario)
{
	document.recado.mensagemRecado.value = document.recado.mensagemRecado.value + " " + codigo + " ";
	document.recado.mensagemRecado.focus();
}

//Funções Usuarios
function cadastrarUsuario()
{
	if ((document.forms[0].nome_usuario.value.length == 0) || (document.forms[0].nome_usuario.value == ""))
	{
		window.alert("Campo Nome em Branco.");
		document.forms[0].nome_usuario.focus();
	}
	else
		if ((document.forms[0].cpf_usuario.value.length == 0) || (document.forms[0].cpf_usuario.value == ""))
		{
			window.alert("Campo CPF em Branco.");
			document.forms[0].cpf_usuario.focus();
		}
		else
			if (!validaCPF(document.forms[0].cpf_usuario.value))
			{
				window.alert("O CPF informado é inválido.");
				document.forms[0].cpf_usuario.focus();
			}
			else
				if ((document.forms[0].email_usuario.value.length == 0) || (document.forms[0].email_usuario.value == ""))
				{
					window.alert("Campo Email em Branco.");
					document.forms[0].email_usuario.focus();
				}
				else
					if (!validaEmail("usuario_email"))
					{
						window.alert("Email informado inválido.");
						document.forms[0].email_usuario.focus();
					}
					else
					{
						document.forms[0].action = "valida.php";
						document.forms[0].submit();
					}
}

/*
function editarAluno(cod_instituicao)
{
	if (cod_instituicao != "")
	{
		document.forms[0].action = "formulario.php?acao_instituicao=editar_instituicao&cod_instituicao=" + cod_instituicao + ";";
		document.forms[0].submit();
	}
	else
		if (verificaCheckBox('tela_inst') == true)
		{
			if (verificaQtdeCheckBox('tela_inst') > 1)
			{
				window.alert("Atenção!!! A ação editar só permite 1(uma) Instituição selecionada.");
			}
			else
				{
					var cod_instituicao = document.tela_inst.codigos_inst.value;
					janela('EditarAlunos','formulario.php?acao_instituicao=editar_instituicao&cod_instituicao=' + cod_instituicao ,100 ,100 ,650 ,410 ,0 , 0 , 0, 1, 1);
				}
		}
		else
			window.alert("Nenhum Fórum selecionado. Para prosseguir selecione o Fórum para edição.");
}*/
//

//Administração
function redireciona(nomeForm, nomeInput, acao)
{
	var formulario = eval("document." + nomeForm);
	var input = eval("document." + nomeForm + "." + nomeInput);
	var index = input.selectedIndex;
	var conteudo = input.options[index].value;

	if (index == 0)
		formulario.action = "index.php?acao=limpa&select=" + nomeForm;
	else
		formulario.action = "index.php";
	
	formulario.submit();
}

//Funções TreeView
function treeview(_parent)
{
	this.id = _parent;
	
	this.add = function(_texto, _link, _nodePai, _idNode)
	{
		noh = document.createElement("DIV");
		noh.id = _idNode;
		noh.className = 'node';
		if (_nodePai == null)
		{
			document.getElementById(this.id).appendChild(noh);
		}
		else
		{
			nodePai = document.getElementById(_nodePai);
			nodePai.appendChild(noh);

			if ((nodePai.className != "nodeFechado") && (nodePai.className != "nodeAberto"))
			{
				nodePai.className = "nodeFechado";
			}

			nodePaiLk = document.getElementById(this.id + '_divLinks' + _nodePai);
			var linkNId = this.id + '_divLinkNodes' + _nodePai;

			if (document.getElementById(linkNId) == undefined)
			{
				linkN = document.createElement("A");
				linkN.id = linkNId;
				linkN.className = "linkAbreFechaNode";
				linkN.href = "javascript: openNode('" + nodePai.id + "');";
				nodePai.insertBefore(linkN, nodePaiLk);
			}
		}

		nohText = document.createElement("A");
		var idLink = this.id + '_divLinks' + _idNode;
		nohText.id = idLink;
		nohText.innerHTML = _texto;
		nohText.href = _link;
		//nohText.target = _target;
		document.getElementById(noh.id).appendChild(nohText);

		adicionaEvento(document.getElementById(nohText.id), function() { ativaNodeClicado(idLink); }, 'click');

		return noh.id;
	}

	this.addLoader = function(_parametros, _nodePai)
	{

		noh = document.createElement("DIV");
		noh.id = _nodePai + 'Loader';
		noh.className = 'node';


		nodePai = document.getElementById(_nodePai);
		nodePai.appendChild(noh);
		nodePai.className = "nodeFechado";

		nodePaiLk = document.getElementById(this.id + '_divLinks' + _nodePai);
		var linkNId = this.id + '_divLinkNodes' + _nodePai;

		if (document.getElementById(linkNId) == undefined)
		{
			linkN = document.createElement("A");
			linkN.id = linkNId;
			linkN.className = "linkAbreFechaNode";
			linkN.href = "javascript:openNode('" + nodePai.id + "');";
			nodePai.insertBefore(linkN, nodePaiLk);
		}

		return noh.id;
	}

	this.excluiLoader = function(_nodePai)
	{
		lo = document.getElementById(_nodePai + "Loader");
		lo.parentNode.removeChild(lo);
	}
}

function openNode(_node)
{
	_noh = document.getElementById(_node);
	if (_noh.className == "nodeAberto")
	{
		_noh.className = "nodeFechado";
	}else
	{
		_noh.className = "nodeAberto";
	}
}

var nodeAtivo = "";

function ativaNodeClicado(objeto)
{
	if (nodeAtivo != "")
	{
		document.getElementById(nodeAtivo).className = "";
		nodeAtivo = "";
	}

	elem = document.getElementById(objeto);
	elem.className = "nodeAtivo";
	nodeAtivo = elem.id;
}

function adicionaEvento(objeto, funcao, evento)
{
	if (window.addEventListener)
	{
		objeto.addEventListener(evento, funcao, true);
	}
	else 
		if (window.attachEvent)
		{
			objeto.attachEvent('on'+evento,funcao);
		}
}
//

//Funções SELECT MULTIPLE
function primeiroSegundo(primeiro, segundo, formulario) 
{
	var primeiro = eval("document." + formulario + "." + primeiro);
	var segundo = eval("document." + formulario + "." + segundo);
    primeiroTamanho = primeiro.length;
	
    for (i = 0; i < primeiroTamanho; i++)
	{
        if (primeiro.options[i].selected == true )
		{
            segundoTamanho = segundo.length;
            segundo.options[segundoTamanho]= new Option(primeiro.options[i].text, primeiro.options[i].value);
        }
    }

    for (i = (primeiroTamanho -1); i >= 0; i--)
	{
        if (primeiro.options[i].selected == true )
            primeiro.options[i] = null;
    }
}

function segundoPrimeiro(segundo, primeiro, formulario)
{
	var primeiro = eval("document." + formulario + "." + primeiro);
	var segundo = eval("document." + formulario + "." + segundo);
    segundoTamanho = segundo.length;
	
	for (i = 0; i < segundoTamanho; i++)
	{
		if (segundo.options[i].selected == true ) 
		{
			primeiroTamanho = primeiro.length;
			primeiro.options[primeiroTamanho]= new Option(segundo.options[i].text, segundo.options[i].value);
		}
	}
        
	for (i = (segundoTamanho-1); i >= 0; i--)
	{
		if (segundo.options[i].selected == true )
			segundo.options[i] = null;
	}
}

function selecionaSelectMultiplo(input, acao)
{
	for (i = 0; i < input.length; i++)
  		input.options[i].selected = acao;
}

//Funcoes LOG
function registraLog(acao, redireciona)
{
	var http = pegaAjax();
	//window.alert(this.pathname);
	
	if ((clientNavigator == "IE") || (clientNavigator == "Opera"))
	{
		http.open("POST", "../geral/registra_log.php?acao=" + acao, true);
	}
	else
	{
		http.open("GET", "../geral/registra_log.php?acao=" + acao, true);
	}
	
	http.send(null);
	window.location.href = redireciona;
}
//