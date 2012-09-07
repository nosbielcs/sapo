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

$dia_evento = $_GET["dia"];
$mes_evento = $_GET["mes"];
$ano_evento = $_GET["ano"];

$dias = date("t", mktime(0, 0, 0, $mes_evento, 1, $ano_evento));
$vetor_dias_mes = array();

for ($i = 1; $i < $dias + 1; $i++)
{
	if (($i >= 1) and ($i <= 9))
	{
		
		if ($dia_evento == $i)
			echo "0$i|sim";
		else
			echo "0$i|nao";
	}
	else
		if ($i >=10)
		{
			if ($dia_evento == $i)
				echo "$i|sim";
			else
				echo "$i|nao";
		}
	
	if (($i + 1) <= $dias)
		echo ";";
}
?>