//Agenda de Eventos
function novoEvento(pagina, quantidade, ordem)
{
	document.visualizaEvento.pagina.value = pagina;
	document.visualizaEvento.quantidade.value = quantidade;
	document.visualizaEvento.ordem.value = ordem;
	document.visualizaEvento.acao.value = "novo";
	document.visualizaEvento.action = "formulario.php";
	document.visualizaEvento.submit();
}

function editarEvento(pagina, quantidade, ordem, cod_evento)
{
	document.visualizaEvento.pagina.value = pagina;
	document.visualizaEvento.quantidade.value = quantidade;
	document.visualizaEvento.ordem.value = ordem;
	document.visualizaEvento.cod_evento.value = cod_evento;
	document.visualizaEvento.acao.value = "editar";
	document.visualizaEvento.action = "formulario.php";
	document.visualizaEvento.submit();
}

function excluirEvento(pagina, quantidade, ordem, cod_evento, assunto)
{
	if (window.confirm("Você tem certeza que deseja remover o Evento \"" + assunto + "\"?"))
	{
		document.visualizaEvento.pagina.value = pagina;
		document.visualizaEvento.quantidade.value = quantidade;
		document.visualizaEvento.ordem.value = ordem;
		document.visualizaEvento.cod_evento.value = cod_evento;
		document.visualizaEvento.acao.value = "excluir";
		document.visualizaEvento.action = "controle.php";
		document.visualizaEvento.submit();
	}
}
//