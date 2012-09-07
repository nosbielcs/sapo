// JavaScript Document - Administração - Funções Cursos
function novoCurso()
{
	document.curso_instituicao.acao_curso.value = "novo";
	document.curso_instituicao.action = "formulario.php";
	document.curso_instituicao.submit();
}

function editarCurso(cod_curso)
{
	document.curso_instituicao.acao_curso.value = "editar";
	document.curso_instituicao.cod_curso.value = cod_curso;
	document.curso_instituicao.action = "formulario.php";
	document.curso_instituicao.submit();
}

function visualizaCurso(cod_curso)
{
	document.curso_instituicao.cod_curso.value = cod_curso;
	document.curso_instituicao.action = "visualiza.php";
	document.curso_instituicao.submit();
}

function gravarDados()
{
	if (trim(document.curso_instituicao.nome.value) == "")
	{
		window.alert("Campo Nome em Branco!");
		document.curso_instituicao.nome.focus();
	}
	else
		if (trim(document.curso_instituicao.descricao.value) == "")
		{
			window.alert("Campo Descrição em Branco!");
			document.curso_instituicao.descricao.focus();
		}
		else
			if (trim(document.curso_instituicao.vagas.value) == "")
			{
				window.alert("Campo Vagas em Branco!");
				document.curso_instituicao.vagas.focus();
			}
			else
			{
				dataInicio = document.curso_instituicao.dia_inicio.value + "/" + document.curso_instituicao.mes_inicio.value + "/" + document.curso_instituicao.ano_inicio.value;
				dataFim = document.curso_instituicao.dia_fim.value + "/" + document.curso_instituicao.mes_fim.value + "/" + document.curso_instituicao.ano_fim.value;
				opcao = document.curso_instituicao.opcao.value;
					
				if (comparaDatas(dataInicio, dataFim, opcao))
					document.curso_instituicao.dia_inicio.focus();
				else
				{
					if (trim(document.curso_instituicao.qtde_horas.value) == "")
					{
						window.alert("Campo Quantidade de Horas em Branco!");
						document.curso_instituicao.qtde_horas.focus();
					}
					else
					{
						if (document.curso_instituicao.situacao_curso.selectedIndex == 0)
						{
							window.alert("Selecione uma Situação!");
							document.curso_instituicao.situacao_curso.focus();							
						}
						else
						{
							document.curso_instituicao.action = "controle.php";
							document.curso_instituicao.submit();
						}
					}
				}
			}
}

function atualizarCursosIntituicao(cod_inst, cod_curso)
{
	document.forms[0].action = "contato.php?insituicao=" + cod_inst + "&curso=" + cod_curso;
	document.forms[0].submit();
}

function paginacaoCurso(url)
{
	var index = document.paginacao_curso.qtd_listagem.selectedIndex;
	var conteudo = document.paginacao_curso.qtd_listagem.options[index].value;
	window.parent.location = url + "&qtd=" + conteudo;
}

function marcaTodosCurso(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_curso.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosCurso();
}

function atualizaCodigosCurso() 
{
	var codigosLocal;
	codigosLocal = '';
	
	destinoInstituicao( 'curso_instituicao' );
	codigosLocal += codigosCurso;

	parent.window.document.curso_instituicao.codigos_cursos.value = codigosLocal;
}

var codigosCurso;
function destinoInstituicao(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigosCurso = "";
		return;
	}

	var contaChecked = 0;

	codigosCurso = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			codigosCurso += checkBox.name + ";";
		}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todos_curso.checked = true;
	else
		formulario.todos_curso.checked = false;
}