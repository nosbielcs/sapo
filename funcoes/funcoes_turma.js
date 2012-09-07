// JavaScript Document - Administração - Funções Turma
function novaTurma()
{
	document.turma_instituicao.acao_turma.value = "novo";
	document.turma_instituicao.action = "formulario.php";
	document.turma_instituicao.submit();
}

function editarTurma(cod_turma)
{
	document.turma_instituicao.acao_turma.value = "editar";
	document.turma_instituicao.cod_turma.value = cod_turma;
	document.turma_instituicao.action = "formulario.php";
	document.turma_instituicao.submit();
}

function visualizaTurma(cod_turma)
{
	document.turma_instituicao.cod_turma.value = cod_turma;
	document.turma_instituicao.action = "visualiza.php";
	document.turma_instituicao.submit();
}

function gravarDados()
{
	if (trim(document.turma_instituicao.descricao.value) == "")
	{
		window.alert("Campo Nome em Branco!");
		document.turma_instituicao.nome.focus();
	}
	else
		if (trim(document.turma_instituicao.descricao.value) == "")
		{
			window.alert("Campo Descrição em Branco!");
			document.turma_instituicao.descricao.focus();
		}
		else
			if (trim(document.turma_instituicao.vagas.value) == "")
			{
				window.alert("Campo Vagas em Branco!");
				document.turma_instituicao.vagas.focus();
			}
			else
			{
				dataInicio = document.turma_instituicao.dia_inicio.value + "/" + document.turma_instituicao.mes_inicio.value + "/" + document.turma_instituicao.ano_inicio.value;
				dataFim = document.turma_instituicao.dia_fim.value + "/" + document.turma_instituicao.mes_fim.value + "/" + document.turma_instituicao.ano_fim.value;
				opcao = document.turma_instituicao.opcao.value;
					
				if (comparaDatas(dataInicio, dataFim, opcao))
					document.turma_instituicao.dia_inicio.focus();
				else
				{
					if (trim(document.turma_instituicao.qtde_horas.value) == "")
					{
						window.alert("Campo Quantidade de Horas em Branco!");
						document.turma_instituicao.qtde_horas.focus();
					}
					else
					{
						if (document.turma_instituicao.situacao_turma.selectedIndex == 0)
						{
							window.alert("Selecione uma Situação!");
							document.turma_instituicao.situacao_turma.focus();							
						}
						else
						{
							document.turma_instituicao.action = "controle.php";
							document.turma_instituicao.submit();
						}
					}
				}
			}
}

function paginacaoTurma(url)
{
	var indexListagem = document.paginacao_turma.qtd_listagem.selectedIndex;
	var conteudo = document.paginacao_turma.qtd_listagem.options[indexListagem].value;
	var indexCurso = document.paginacao_turma.curso_instituicao.selectedIndex;
	var curso = document.paginacao_turma.curso_instituicao.options[indexCurso].value;
	window.parent.location = url + "&qtd=" + conteudo + "&curso_instituicao=" + curso;
}

function marcaTodosTurma(nomeForm) 
{
	var formulario = eval("document." + nomeForm);

	var check = formulario.todos_turma.checked;
	for (i = 1; i < formulario.elements.length; i++) 
	{
		if ( formulario.elements[i].type == "checkbox" )
		{
			formulario.elements[i].checked = check;
		}
	}
	atualizaCodigosTurma();
}

function atualizaCodigosTurma() 
{
	var codigosLocal;
	codigosLocal = '';
	
	destinoInstituicao( 'turma_instituicao' );
	codigosLocal += codigosTurma;

	parent.window.document.turma_instituicao.codigos_turmas.value = codigosLocal;
}

var codigosTurma;
function destinoInstituicao(nomeForm) {
	var i = 0;
	var conta = 0;
	var formulario = eval("document." + nomeForm);
	if ( formulario.elements.length == 0 ) 
	{
		codigosTurma = "";
		return;
	}

	var contaChecked = 0;

	codigosTurma = "";

	for (i = 1; i < formulario.elements.length; i++)
	{
		var checkBox = formulario.elements[i];
		if ( checkBox.checked ) 
		{
			contaChecked++;
			codigosTurma += checkBox.name + ";";
		}
		
		if (formulario.elements[i].type == "checkbox")
		{
			conta++;	
		}
	}
	
	if (contaChecked == conta)
		formulario.todos_turma.checked = true;
	else
		formulario.todos_turma.checked = false;
}

//Funções TreeView
function treeview(_parent)
{
	this.id = _parent;
	
	this.add = function(_texto, _nodePai, _idNode)
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
		//nohText.href = _link;
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
			linkN.href = "JavaScript: openNode('" + nodePai.id + "');";
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