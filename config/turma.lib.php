<?php
/*
=====================================================================
#  PROJETO: Sa�po                                                   #
#  FUNCA��O ECUM�NICA DE PROTE��O AO EXCEPCIONAL                    #
#                                                                   #
#  Programa��o                                                      #
#	        - Jackson Brutkowski Vieira da Costa                    #
#  Design                                                           #
#           - Cleibson Aparecido de Almeida                         #
=====================================================================
*/

	if (($_POST["turmas_usuario"] == "") and (!isset($_SESSION["cod_turma"])))
		header("Location: ../index.php?erro=1");
	else
		if (!isset($_SESSION["cod_turma"]))
			$_SESSION["cod_turma"] = $_POST["turmas_usuario"];
?>