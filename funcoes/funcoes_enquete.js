// JavaScript Document - Enquete
function novaEnquete()
{
	document.enquete.acao.value = "novo";
	document.enquete.action = "formulario.php";
	document.enquete.submit();
}

function cadastrarEnquete()
{
	var opcoes = contaInput('text', 'cad_enquete');
	
	if (trim(document.cad_enquete.descricao.value) == "")
	{
		window.alert("Campo Enquete em Branco. Favor preênche-lo.");
		document.cad_enquete.descricao.focus();
	}
	else
		if (opcoes < 1)
		{
			window.alert("Enquete sem Opções. Favor adicioná-las.");
		}
		else
			{
				for (i = 1; i < (opcoes + 1); i++)
				{
					var opcao = document.getElementById("opcao_" + i);
					if (trim(opcao.value) == "")
					{
						window.alert("Opção " + i + " em Branco. Favor preênche-la.");
						opcao.focus();
					}				
					else
					{
						document.cad_enquete.action = "controle.php";
						document.cad_enquete.submit();
					}
				}
			}
}

function adicionaOpcaoEnquete(contador, idTr)
{
	var contador = contador + 1;
	var formulario = document.getElementById(idTr);
	var table = document.createElement("table");
	var tbody = document.createElement("tbody");
	
	var tr_linha = document.createElement("tr");
	var td_linha = document.createElement("td");
	
	var tr = document.createElement("tr");
	var td_titulo = document.createElement("td");
	var td_espaco = document.createElement("td");
	var td_input = document.createElement("td");
	var input = document.createElement("input");
	var link_input = document.createElement("a");
	
	//Define Link de Remoçãoo
    link_input.innerHTML = "Remover Item";
	link_input.setAttribute("id", "link_" + contador);
	link_input.setAttribute("onClick", "JavaScript: removeOpcaoEnquete(" + contador + ", '" + idTr + "' )");
	link_input.setAttribute("onMouseOver", "JavaScript: window.status = 'Remover Item'");
	link_input.setAttribute("onMouseOut", "JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online'");
	link_input.setAttribute("style", "cursor:pointer");
	link_input.setAttribute("class", "link_magenta");
	
	//Define Linha
	td_linha.setAttribute("colspan", "3");
	td_linha.setAttribute("height", "15");
	tr_linha.appendChild(td_linha);
	
	//Define propriedades do Input
	input.setAttribute("type", "text");
	input.setAttribute("id", "opcao_" + contador);
	input.setAttribute("name", "opcao_" + contador);
	input.setAttribute("size", "50");
	
	//Define Atributos da Tabela, Tbody, TR
	table.setAttribute("id", "table_" + contador);
	table.setAttribute("width", "100%");
	table.setAttribute("border", "0");
	table.setAttribute("cellpadding", "0");
	table.setAttribute("cellspacing", "0");
	tbody.setAttribute("id", "tbody_" + contador);

	//Define Atributos dos TD´s
	td_titulo.setAttribute("width", "140");
	td_titulo.setAttribute("align", "right");
	td_titulo.setAttribute("id", "td_titulo_" + contador);
	td_espaco.setAttribute("width", "10");
	td_input.setAttribute("align", "left");
	
	//Acrescenta valor ao TD e vincula ao TR respectivo
	td_titulo.innerHTML = "<font class=\"preto\">Opção " + contador + "</font>";
	//td_input.innerHTML = input_file;
	td_input.appendChild(input);
	td_input.appendChild(link_input);
	//td_input.innerHTML = td_input.innerHTML + " " + link_input;
	tr.appendChild(td_titulo);
	tr.appendChild(td_espaco);
	tr.appendChild(td_input);
	
	//Vincula elemntos TBODY com TABLE e TABLE com TR e no fim com o FORMULARIO
	tbody.appendChild(tr);
	tbody.appendChild(tr_linha);
	table.appendChild(tbody);
	formulario.appendChild(table);
	
	document.cad_enquete.total_opcoes.value = contaInput('text', 'cad_enquete');
}

function removeOpcaoEnquete(id, idTr)
{
	var total = contaInput('text', 'cad_enquete');
	var formulario = document.getElementById(idTr);
	var table = document.getElementById("table_" + id);
	formulario.removeChild(table);
	document.cad_enquete.total_opcoes.value = contaInput('text', 'cad_enquete');
	atualizaOpcoesEnquete(id, "Opção ", total, idTr);
}

function atualizaOpcoesEnquete(id, texto, opcoes, idTr)
{
	for (i = 1; i < (opcoes + 1); i++) 
	{
		var tbody = document.getElementById("tbody_" + i);
		var table = document.getElementById("table_" + i);
		var td = document.getElementById("td_titulo_" + i);
		var input = document.getElementById("opcao_" + i);
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
			input.setAttribute("name", "opcao_" + numero);
			input.setAttribute("id", "opcao_" + numero);
			link_input.setAttribute("onClick", "JavaScript: removeOpcaoEnquete(" + numero + ", '" + idTr + "')");
			link_input.setAttribute("id", "link_" + numero);
		}
	}
}

function visualizaData(atributo)
{
	var div = document.getElementById("dataLimite");
	
	if (atributo == 0)
		div.style.display = "";
	else
		div.style.display = "none";
}