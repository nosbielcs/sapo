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

switch($modulo)
{
	case "inicial":
		$dir_imagens = "../../imagens/";
		$dir_imagem_instituicao = "../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../config/session.lib.php");
		$calendario = "../geral/calendario.php";
	break;
	
	case "perfil":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../calendario.php";
	break;
	
	case "config":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../calendario.php";
	break;
	
	case "minha_turma":
		$dir_imagens = "../../imagens/";
		$dir_imagem_instituicao = "../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../config/session.lib.php");
		$calendario = "calendario.php";
	break;
	
	case "perfil_usuario":
		$dir_imagens = "../../imagens/";
		$dir_imagem_instituicao = "../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../config/session.lib.php");
		$calendario = "calendario.php";
	break;
	
	case "recados":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../calendario.php";
	break;
	
	case "edital":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "agenda":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "conteudo":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "atividades":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "forum":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "bate_papo":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
	
	case "enquete":
		$dir_imagens = "../../../imagens/";
		$dir_imagem_instituicao = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$_SESSION["imagem_instituicao"];
		include("../../../config/session.lib.php");
		$calendario = "../../geral/calendario.php";
	break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agenda de Eventos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript" src="../../funcoes/funcoes.js"></script>

<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" rowspan="4" background="<?php echo $dir_imagens; ?>cantoA7.gif" valign="top"><img src="<?php echo $dir_imagens; ?>cantoA1.gif" width="10" height="10" border="0"></td>
    <td width="240" height="10" nowrap background="<?php echo $dir_imagens; ?>cantoA11.gif" bgcolor="#FCFFEE"></td>
    <td width="10" height="10" bgcolor="#FCFFEE" background="<?php echo $dir_imagens; ?>cantoA11.gif"></td>
    <td height="10" background="<?php echo $dir_imagens; ?>cantoA11.gif"></td>
    <td width="10" rowspan="2" valign="top" background="<?php echo $dir_imagens; ?>cantoA10.gif"><img src="<?php echo $dir_imagens; ?>cantoA2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td width="240" height="110" bgcolor="#FCFFEE">            
      <table width="240" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left"><img src="<?php echo $dir_imagens; ?>logos/sapo.gif" width="230" height="89" onClick="JavaScript: abas('menu_esquerdo');"></td>
        </tr>
      </table>
    </td>
    <td width="10" valign="middle" bgcolor="#FCFFEE"><img src="<?php echo $dir_imagens; ?>traco1.gif" width="2" height="99"></td>
    <td width="100%" bgcolor="#FCFFEE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
		    <table width="100%" height="110" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><iframe width="100%" height="110" frameborder="0" scrolling="no" src="<?php echo $calendario; ?>"></iframe></td>
              </tr>
            </table>      
          </td>
          <td width="10" align="center"><img src="<?php echo $dir_imagens; ?>traco1.gif" width="2" height="99" border="0"></td>
          <td width="120" align="center"><img src="<?php echo $dir_imagem_instituicao; ?>" width="100" height="100"></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</body>
</html>