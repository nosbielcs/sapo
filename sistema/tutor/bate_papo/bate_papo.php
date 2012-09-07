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

include("../../../config/session.lib.tutor.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
 <head>
  <title>Bate Papo</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 </head> 
  <frameset rows="0, *,80" border="0" frameborder="no">
   <frame src="principal.htm" name="vazio" scrolling="no" noresize marginwidth="0" marginheight="0">
   <frame src="exibir.php" name="mensagem_bate_papo" scrolling="auto" noresize frameborder="1">
   <frame src="mensagem_bate_papo.php" name="formulario_bate_papo" scrolling="no" noresize marginwidth="2" marginheight="1">
  </frameset>
<noframes><body>
</body></noframes>
</html>
