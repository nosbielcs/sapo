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

session_start();

include("../../config/session.lib.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/evento.php");
include("../../classes/usuario.php");

$dia = $_GET["dia"];
$mes = $_GET["mes"];
$ano = $_GET["ano"];
$nome_mes = $_GET["nome_mes"];
$data_eventos = "$ano-$mes-$dia";
$cod_turma = $_SESSION["cod_turma"];

$eventos = "$dia de $nome_mes de $ano<br><br>"; 
$colecao_eventos = new evento();
$colecao_eventos->colecaoEventos($cod_turma, $data_eventos);

$total_colecao_eventos = $colecao_eventos->linhas;

if ($total_colecao_eventos > 0)
{
	for ($i = 0; $i < $total_colecao_eventos; $i++)
	{
		$evento_atual = new evento();

		$evento_atual->carregar($colecao_eventos->data["cod_evento"]);
		$cod_usuario = $evento_atual->getCodigoUsuario();
		$assunto = $evento_atual->getAssunto();
		$descricao = $evento_atual->getDescricao();
		$hora = substr($evento_atual->getHora(), 0, 5);
		$codigo = $evento_atual->getCodigo();
		$data_evento = $evento_atual->getDataEvento();
		$situacao = $evento_atual->getSituacao();
		
		$autor = new usuario();
		$autor->carregar($cod_usuario);
		$nome_usuario = $autor->getNome();
		
		$eventos.= "<font class=\"calendar_bold\">Assunto:</font> ".$assunto."<br>";
		$eventos.= "<font class=\"calendar_bold\">Descrição:</font> ".nl2br($descricao)."<br>";
		$eventos.= "";
		if ((substr($hora, 0, 2) >= "00") && (substr($hora, 0, 2) <= "12")) 
			$eventos.= "<font class=\"calendar_bold\">Hora:</font> ".$hora." am<br>"; 
		else
			$eventos.= "<font class=\"calendar_bold\">Hora:</font> ".$hora." pm<br>";
		
		if ($situacao == "A")
			$eventos.= "<font class=\"calendar_bold\">Situação:</font> Evento Ativo<br>";
		else
			if ($situacao == "I")
			  $eventos.= "<font class=\"calendar_bold\">Situação:</font> Evento Inativo<br>";
		
		if (($i + 1) < $total_colecao_eventos)
			$pula_linha = "<br><br>";
		else
			$pula_linha = "";
			
		if ($data_evento < date("Y-m-d"))
			$eventos.= "<font class=\"calendar_bold\">Status:</font> Realizado".$pula_linha;
		else
		{
			if (($data_evento == date("Y-m-d")) && ($hora < date("H:i")))
				$eventos.= "<font class=\"calendar_bold\">Status:</font> Realizado".$pula_linha;
			else
				if (($data_evento == date("Y-m-d")) && ($hora > date("H:i")))
					$eventos.= "<font class=\"calendar_bold\">Status:</font> Não Realizado".$pula_linha;
				else
					if ($data_evento > date("Y-m-d"))
						$eventos.= "<font class=\"calendar_bold\">Status:</font> Não Realizado".$pula_linha;	
		}
		
		if (($i + 1) > $total_colecao_eventos)
		{
			$eventos.= "<br><br>";
		}
		
		$colecao_eventos->proximo();
	}
	
}
else
{
	$eventos = "$dia de $nome_mes de $ano<br><br>Nenhum evento cadastrado.";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sa²Po</title>
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript" src="../../funcoes/funcoes.js"></script>

<body leftmargin="0" topmargin="0" bgcolor="#FCFFEE">
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE">
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td width="5"></td>
    <td class="calendar"><?php echo $eventos; ?></td>
  </tr>
</table>
</body>
</html>