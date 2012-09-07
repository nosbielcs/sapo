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

include("../../../config/session.lib.pta.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$cod_curso = $_SESSION["cod_curso"];
$modulo = "turmas";

$curso_turmas = new curso();
$curso_turmas->colecaoTurmas($cod_curso);
$total_turmas = $curso_turmas->linhas;

if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
}

if ($_GET["qtd_listagem"])
{
	$limite = $_GET["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
}
else
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
	}
	else
	{
		$limite = 10;
		$url_ordenacao.= "&qtd=".$limite;
	}

if ($_GET["ordem"])
	$ordem = $_GET["ordem"];
else
	$ordem = 1;

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$curso_turmas->paginacaoTurma($cod_curso, $limite, $inicio, $ordem);
$total_turmas = $curso_turmas->linhas;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO Administra&ccedil;&atilde;o</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes_turma_pta.js"></script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: carregaMenu();">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" rowspan="4" background="../../../imagens/cantoA7.gif" valign="top"><img src="../../../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
    <td width="240" height="10" background="../../../imagens/cantoA11.gif" bgcolor="#FCFFEE"></td>
    <td width="10" height="10" bgcolor="#FCFFEE" background="../../../imagens/cantoA11.gif"></td>
    <td height="10" background="../../../imagens/cantoA11.gif"></td>
    <td width="10" rowspan="2" valign="top" background="../../../imagens/cantoA10.gif"><img src="../../../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td width="240" height="110" bgcolor="#FCFFEE">            
      <table width="240" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left"><img src="../../../imagens/logos/sapo.gif" width="230" height="89" onClick="JavaScript: abas('menu_esquerdo');"></td>
        </tr>
      </table>
    </td>
    <td width="10" valign="middle" bgcolor="#FCFFEE"><img src="../../../imagens/traco1.gif" width="2" height="99"></td>
    <td width="100%" bgcolor="#FCFFEE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
		    <table width="100%" height="110" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><iframe width="100%" height="110" frameborder="0" scrolling="no" src="../../geral/calendario.php"></iframe></td>
              </tr>
            </table>       
          </td>
          <td width="10" align="center"><img src="../../../imagens/traco1.gif" width="2" height="99" border="0"></td>
          <td width="120" align="center"><img src="../../../imagens/logos/fepe.gif" width="109" height="97"></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../../imagens/cantoA7.gif" height="10" width="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../../imagens/cantoA10.gif" height="10"><img src="../../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" valign="top" id="td_linha_menu_esquerdo">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../../imagens/cantoA7.gif" valign="top">&nbsp;</td>
		    <?php include("../../geral/ferramentas_admin.php"); ?>
		  <td width="10" valign="top" background="../../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
                <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="3" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                      <td><img src="../../../imagens/icones/perfil/titulo_dados_pessoais.gif" width="250" height="52"></td>
                    </tr>
                  </table>
				</td>
                <td height="10" background="../../../imagens/cantoL8.gif"></td>
                <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
              </tr>
              <tr>
                <td width="10" height="42" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
                <td height="42" bgcolor="#D5FFD5" width="100%" align="right"><a onClick="JavaScript: novaTurma();" style="cursor: pointer" class="link_verde"></a>&nbsp;</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				  <?php
					if ($total_turmas > 0)
					{
				  ?>
					<tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td align="right">
					    <table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <form name="paginacao_turma" action="<?php echo $url_ordenacao; ?>" method="post">
						  <tr>
						    <td class="campos" align="right">Listagem</td>
						    <td width="10"></td>
						    <td width="50">
							<select name="qtd_listagem" onChange="JavaScript: paginacaoTurma('<?php echo $url_ordenacao; ?>', 'paginacao_turma');">
							  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
							  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
							  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
							  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
							  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
							</select>
						    </td>
						  </tr>
						  </form>
					    </table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<form name="turma_curso" method="post">
						  <tr>
							<td class="verde">Turma&nbsp;&nbsp;<?php 
							if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordenacao.= "&ordem=2";
										echo "<a OnClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" style=\"cursor: pointer\" title=\"Ordem Crescente por Nome\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Decrescente por Nome\"></a>";
									break;
									
									case 2: 
										$url_ordenacao.= "&ordem=1";
										echo "<a OnClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" style=\"cursor: pointer\" title=\"Ordem Decrescente por Nome\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\" alt=\"Ordem Crescente por Nome\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordenacao.= "&ordem=2";
								echo "<a OnClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" style=\"cursor: pointer\" title=\"Ordem Crescente por Nome\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Decrescente por Nome\"></a>";
							}
						  ?></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="10"></td>
						  </tr>
						  <?php
							$cor_fundo = "";
							$cod_turma_atual = $curso_turmas->data["cod_turma"];
							
							for ($i = 0; $i < $total_turmas; $i++)
							{
								$cod_turma = $curso_turmas->data["cod_turma"];
								$turma = new turma();
								$turma->carregar($cod_turma);
								$nome_turma = $turma->getDescricao();
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>">
							<td><a OnClick="JavaScript: visualizaTurma(<?php echo $cod_turma; ?>)" style="cursor: pointer" class="link_verde"><?php echo $nome_turma; ?></a></td>
						  </tr>
						  <?php
								$curso_turmas->proximo();
							}
						  ?>
						  <tr> 
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td colspan="3">
							  <table width="100%" align="center">
								<tr>
								  <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total_turmas, $url, true); ?></td>
								  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $total_turmas; ?></font></td>
								</tr>
							  </table>
							</td>
						  </tr>
						  <tr> 
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td colspan="3"><input type="hidden" name="codigos_turmas" value=""><input type="hidden" name="acao_turma" value=""><input type="hidden" name="cod_turma" value=""><input type="hidden" name="acao_voltar" value="index"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"></td>
						  </tr>
						</form>
					  </table>
					  </td>
					</tr>
				  <?php
					}
					else
					{
				  ?>
				    <tr>
					  <td class="verde_simples" align="center">Nenhuma Turma Encontrada.</td>
					</tr>
				  <?php
				  	}
				  ?>
				  </table>
				</td>
                <td width="10" align="right" background="../../../imagens/cantoL7.gif">&nbsp;</td>
              </tr>
              <tr>
                <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoL5.gif"><img src="../../../imagens/cantoL4.gif" width="10" height="10" border="0"></td>
                <td height="10" background="../../../imagens/cantoL6.gif" colspan="2"></td>
                <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL3.gif" width="10" height="10" border="0"></td>
              </tr>
            </table>
	      </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>