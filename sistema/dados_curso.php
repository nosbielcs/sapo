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

include("../config/session.lib.php");
include("../config/config.bd.php");
include("../classes/classe_bd.php");
include("../classes/curso.php");
include("../classes/instituicao.php");
include("../funcoes/funcoes.php");

$cod_curso = $_GET["cod_curso"];

if (isset($cod_curso))
{
	$curso = new curso();
	$curso->carregar($cod_curso);
	$nome = $curso->getNome();
	$descricao = $curso->getDescricao();
	$vagas = $curso->getVagas();
	$data_inicio = $curso->getDataInicio();
	$qtde_horas = $curso->getQtdeHoras();
	$data_fim = $curso->getDataFim();
	$data_inicio = formataData($data_inicio, "/");
	$data_fim = formataData($data_fim, "/");
	$cod_inst = $curso->getCodigoInstituicao();
	
	$instituicao = new instituicao();
	$instituicao->carregar($cod_inst);
	$nome_instituicao = $instituicao->getNome();
}
?>
<html>
<head>
<title>Informações Sobre o Curso - <?php echo $nome; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0">
<table width="99%" border="0" cellpadding="0" cellspacing="0" class="tabelaMenu">
  <tr>
    <td>
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php				
	  	if (isset($cod_curso))
		{
	  ?>
		<tr>
		  <td class="conteudoTextoBold">Informa&ccedil;&otilde;es Sobre o Curso</td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td>
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr> 
                <td width="90" class="campos" align="right">Instituição:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $nome_instituicao; ?></td>
              </tr>
              <tr> 
                <td width="90" class="campos" align="right">Curso:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $nome; ?></td>
              </tr>
              <tr> 
                <td width="90" class="campos" align="right" valign="top">Descrição:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo nl2br($descricao); ?></td>
              </tr>
              <tr> 
                <td width="90" class="campos" align="right">Vagas:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $vagas; ?></td>
              </tr>
			  <tr> 
                <td width="90" class="campos" align="right">Total de Horas:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $qtde_horas; ?></td>
              </tr>
              <tr> 
                <td width="90" class="campos" align="right">Data de In&iacute;cio:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $data_inicio; ?></td>
              </tr>
              <tr> 
                <td width="90" class="campos" align="right">Data de Fim:</td>
                <td width="10">&nbsp;</td>
                <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $data_fim; ?></td>
              </tr>
            </table>
		  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
	    <tr>
	      <td align="center"><input type="button" name="fecha" value="Fechar" onClick="JavaScript: self.close();"></td>
	    </tr>
	  <?php
		}
	  ?>
	  </table>
    </td>
  </tr>
</table>
</body>
</html>