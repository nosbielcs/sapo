// JavaScript Document - Funções Instituição
function visualizaInstituicao(cod_inst)
{
	document.tela_inst.cod_inst.value = cod_inst;
	document.tela_inst.action = "formulario.php";
	document.tela_inst.submit();
}

function pesquisarCursosIntituicao(cod_inst)
{
	document.forms[0].action = "contato.php?insituicao=" + cod_inst;
	document.forms[0].submit();
}

function marcaTodosInstituicao(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_inst.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosInstituicao();
}

function atualizaCodigosInstituicao() 
{
	var codigosLocal;
	codigosLocal = '';
	
	destinoInstituicao( 'tela_inst' );
	codigosLocal += codigosInstituicao;

	parent.window.document.tela_inst.codigos_inst.value = codigosLocal;
}

var codigosInstituicao;
function destinoInstituicao(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigosInstituicao = "";
		return;
	}

	var contaChecked = 0;

	codigosInstituicao = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			codigosInstituicao += checkBox.name + ";";
		}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todos_inst.checked = true;
	else
		formulario.todos_inst.checked = false;
}

function editarInstituicao(cod_instituicao)
{
	if (cod_instituicao != "")
	{
		document.forms[0].acao_instituicao.value = "editar";
		document.forms[0].cod_instituicao.value = cod_instituicao;
		document.forms[0].action = "formulario.php";
		document.forms[0].submit();
	}
	else
		if (verificaCheckBox('redireciona_usuario') == true)
		{
			if (verificaQtdeCheckBox('redireciona_usuario') > 1)
			{
				window.alert("Atenção!!! A ação editar só permite 1(uma) Instituição selecionada.");
			}
			else
				{
					var cod_instituicao = document.tela_inst.codigos_inst.value;
					janela('EditarInstituicao','formulario.php?acao_instituicao=editar_instituicao&cod_instituicao=' + cod_instituicao ,100 ,100 ,650 ,410 ,0 , 0 , 0, 1, 1);
				}
		}
		else
			window.alert("Nenhuma Instituição selecionada. Para prosseguir selecione a Instituição para edição.");
}

function novaInstituicao()
{
	document.redireciona_usuario.acao_instituicao.value = "novo";
	document.redireciona_usuario.action = "admin/instituicao/formulario.php";
	document.redireciona_usuario.submit();
}

function cadastraInstituicao()
{
	if ((document.forms[0].nome.value.length == 0) || (document.forms[0].nome.value.length == ""))
	{
		window.alert("Campo Nome em Branco.");
		document.forms[0].nome.focus();
	}
	else
		if ((document.forms[0].descricao.value.length == 0) || (document.forms[0].descricao.value.length == ""))
		{
			window.alert("Campo Descrição em Branco.");
			document.forms[0].descricao.focus();
		}
		else
			if ((document.forms[0].email.value.length == 0) || (document.forms[0].email.value.length == ""))
			{
				window.alert("Campo Descrição em Branco.");
				document.forms[0].email.focus();
			}
			else
			{
				document.forms[0].action = "controle.php";
				document.forms[0].submit();
			}
}
//