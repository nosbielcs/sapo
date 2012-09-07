
function treeview(_parent)
{
	this.id = _parent;

	this.add = function(_texto, _link, _target, _nodePai, _idNode)
	{

		noh = document.createElement("DIV");
		noh.id = _idNode;
		noh.className = 'node';
		if (_nodePai == null)
		{
			document.getElementById(this.id).appendChild(noh);
		}else
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
				linkN.href = "javascript:openNode('" + nodePai.id + "');";
				nodePai.insertBefore(linkN, nodePaiLk);
			}
		}

		nohText = document.createElement("A");
		var idLink = this.id + '_divLinks' + _idNode;
		nohText.id = idLink;
		nohText.innerHTML = _texto;
		nohText.href = _link;
		nohText.target = _target;
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

		if (document.getElementById(linkNId) == undefined){
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



var filaRequisicoes = new Array();
var indice = 0;
var xmlHttp;

if (window.XMLHttpRequest){
	try{
		xmlHttp = new XMLHttpRequest();
	}catch(e){
		xmlHttp = false;
	}
}else if(window.ActiveXObject){
	try{
		xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			xmlHttp = ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlHttp = false;
		}
	}
}

if(!xmlHttp){
	alert('Erro na criação do XMLHttpRequest!\n\nEle é necessário para o carregamento dos nós do treeview\nvia Ajax, experimente atualiza o seu navegador e teste novamente.\n\nAinda não conhece o Firefox?\nEntre já! www.getfirefox.com');
}

function ajaxLoadNodes(url, nodePai){
	if (!xmlHttp) {
		alert('Impossível a execução, XMLHttpRequest não criado.');
		return false;
	}

	filaRequisicoes[filaRequisicoes.length] = new Array(url,nodePai);
	if (filaRequisicoes.length == (indice+1)) ajaxCharge();
}

function ajaxCharge(){
	url = filaRequisicoes[indice][0];

	xmlHttp.open("GET", url, true);
	xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4){
				trv.excluiLoader(filaRequisicoes[indice][1]);

				var retorno = unescape(xmlHttp.responseText.replace(/\+/g," "));
				if (retorno.substring(retorno.length-2) != "ok"){
					alert("Ocorreu um erro no carregamento dos nós do treeview via Ajax,\nverifique se a página no servidor está correta.");
				}else{
					eval(retorno.substring(0,retorno.length-2));
				}

				indice++;
				if (filaRequisicoes.length > indice) setTimeout("ajaxCharge();",20);
			}
	}
	xmlHttp.send(null);
}

function carregaNodes(_node, _parameters, _linkNid){
	ln = document.getElementById(_linkNid);
	ln.href = "javascript:openNode('" + _node + "');";

	openNode(_node);
	ajaxLoadNodes('index2.php' + _parameters + '&pai=' + _node, _node);
}
