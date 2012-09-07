<?php
session_start();

include("../../classes/usuario_online.php");
include("../../funcoes/funcoes.php");

$usuarios_online = array();
$usuarios_online = usuariosOnline($_SESSION["cod_turma"]);

$total_usuarios_online = count($usuarios_online);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Listagem</title>
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">
</head>

<body bgcolor="#FFDED2">
  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FFDED2">
    <tr>
	  <td height="10"></td>
	</tr>
    <tr>
	  <td valign="top">&nbsp;&nbsp;
	    <?php
			for ($i = 0; $i < $total_usuarios_online; $i++)
			{
				$nome = $usuarios_online[$i]["nome"];
				$acesso = $usuarios_online[$i]["acesso"];
				
				switch($acesso)
				{
					case "A":
						$cor = "vermelho";
					break;
					
					case "T":
						$cor = "vermelho";
					break;
					
					case "L":
						$cor = "preto";
					break;
					
					case "S":
						$cor = "verde";
					break;
				}
				
				if (($i + 1) == $total_usuarios_online)
					echo "<font class=\"".$cor."\">".$nome.".</font>";
				else
					echo "<font class=\"".$cor."\">".$nome.",</font> ";				
			}
			?>
	  </td>
	</tr>
	<tr>
	  <td height="10"></td>
	</tr>
  </table>
  </body>
</html>
