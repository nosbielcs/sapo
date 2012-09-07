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

include("../../../config/session.lib.coord.php");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0">
<form name="pastaRecados" action="" target="_parent" method="post">
  <ul id="menubv">
  	<li><a href="#" title="Listar Temas"><img src="../../imagens/colabora/listar.gif" width="20" height="20" border="0" align="baseline"> 
      Listar Temas</a></li>
    <li><a href="#" title="Adicionar Tema"><img src="../../imagens/colabora/adicionar.gif" width="20" height="20" border="0" align="baseline"> 
      Adicionar Tema</a></li>
    <li><a href="#" title="Lixeira"><img src="../../imagens/colabora/excluir.gif" width="20" height="20" border="0" align="baseline"> 
      Excluir Tema</a></li>
    <li><a href="#" title="Ver Colaboradores"><img src="../../imagens/colabora/colaboradores.gif" width="20" height="20" border="0" align="baseline"> 
      Ver Colaboradores</a></li>
  </ul>
</form>
</body>
</html>
