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
include("../../../classes/colabora.php");

if (!isset($_SESSION["cod_turma"]))
	header("Location: ../index.php");
else
{
	$num_colabora = new colabora();
	$num_colabora->colecao($_SESSION["cod_turma"]);
	
	$total_colabora = $num_colabora->linhas;	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Sa&sup2;po - Colabora</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>
<body leftmargin="0" topmargin="0">
<table width="99%" border="0" cellspacing="0" cellpadding="0" class="tabelaMenu">
  <form name="tela_colabora" action="colabora.php" method="post" target="_parent">
    <?php
  	if ($total_colabora == 0)
	{
  ?>
    <tr> 
      <td colspan="6" class="conteudoTextoBold"><img src="../../imagens/colabora/titulo_temas_abertos.gif" width="250" height="52"></td>
    </tr>
    <tr> 
      <td colspan="6" class="conteudoTextoBold">Nenhuma Colaboração Cadastrada para esta 
        Turma.</td>
    </tr>
    <tr>
      
    <?php
  	}
	else
	{
  ?>
      <td colspan="6" class="conteudoTextoBold"><img src="../../imagens/colabora/titulo_temas_abertos.gif" width="250" height="52"></td>
    </tr>
    <tr> 
      <td width="40" align="center"><input type="checkbox" name="todos" onClick="marcaTodoscolabora('tela_colabora');"></td>
      <td class="conteudoTextoBold">Tema</td>
      <td class="conteudoTextoBold" align="center">Respostas</td>
      <td class="conteudoTextoBold" align="center">Autor</td>
      <td class="conteudoTextoBold" align="center">Exibições</td>
      <td class="conteudoTextoBold" align="center">Último Autor</td>
    </tr>
    <tr> 
      <td colspan="6">&nbsp;</td>
    </tr>
    <?php
		for ($i=0; $i < $total_colabora; $i++)
		{
			$cod_colabora = $num_colabora->data["cod_colabora"];
			$colabora = new colabora();
			$colabora->carregar($cod_colabora);
			$cod_usuario = $colabora->getCodigoUsuario();
			$autor = $colabora->getNomeUsuario();
			$autor_c = $autor;
			$autor = reduzTexto($autor, 15);
			$topico = $colabora->gettema();
			$topico_c = $topico;
			$topico = reduzTexto($topico, 35);
			$data_colabora = $colabora->data["data"];
			$hora_colabora = $colabora->data["hora"];
			$exibicoes = $colabora->getVisualizacoes();
			
			$num_msgs = new colabora();
			$num_msgs->colecaoMensagens($cod_colabora);
			$total_msgs = $num_msgs->linhas;
			
			if ($total_msgs > 0)
			{
				$data_msg = $num_msgs->data["data"];
				$hora_msg = $num_msgs->data["hora"];
				$autor_msg = $num_msgs->data["nome"];
				$autor_msg_c = $autor_msg;
				$cod_usuario_msg = $num_msgs->data["cod_usuario"];
				$autor_msg = reduzTexto($autor_msg, 15);
				$ultima_msg = formataData($data_msg, "/")." ".$hora_msg." <a href=\"#\" onClick=\"visualizarPerfil(".$cod_usuario_msg.", '../perfil/')\" title=\"".$autor_msg_c."\">".$autor_msg."</a>";
			}
			else
				$ultima_msg = formataData($data_colabora, "/")." ".$hora_colabora." <a href=\"#\" onClick=\"visualizarPerfil(".$cod_usuario.", '../perfil/')\" title=\"".$autor_c."\">".$autor."</a>";
  ?>
    <tr> 
      <td align="center"> <?php echo "<input type='checkbox' name='".$cod_colabora."' value='".$cod_colabora."' onClick=\"atualizaCodigoscolabora();\">"; ?> 
      </td>
      <td><a href="#" OnClick="vercolabora(<?php echo $cod_colabora; ?>)" title="<?php echo $topico_c; ?>"><?php echo $topico; ?></a></td>
      <td align="center" class="conteudoTexto"><?php echo $total_msgs; ?></td>
      <td align="center" class="conteudoTexto"><a href="#" onClick="visualizarPerfil(<?php echo $cod_usuario; ?>, '../perfil/')"><?php echo $autor; ?></a></td>
      <td align="center" class="conteudoTexto"><?php echo $exibicoes; ?></td>
      <td align="center" class="conteudoTexto"><?php echo $ultima_msg; ?></td>
    </tr>
    <?php

			$num_colabora->proximo();
		}
	
  ?>
    <tr> 
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="6"><input type="hidden" name="codigoscolabora" value=""> <input type="hidden" name="acao_colabora" value=""></td>
    </tr>
    <tr> 
      <td colspan="6"> <table width="100%" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="right">&nbsp;</td>
            <td width="10">&nbsp;</td>
            <td width="50" align="right"><input type="button" name="edita" value="Editar" onClick="JavaScript: editarcolabora();"></td>
            <td width="10">&nbsp;</td>
            <td width="50"><input type="button" name="exclui" value="Excluir" onClick="JavaScript: excluircolabora();"></td>
            <td width="20">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </form>
  <?php
  	}
  ?>
</table>
</body>
</html>
