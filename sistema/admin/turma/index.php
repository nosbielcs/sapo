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

session_start();

include("../../../config/session.lib.admin.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$modulo = "turmas";

$cursos_instituicao = new curso();
$cursos_instituicao->colecaoCursoInstituicao($cod_inst);
$total_cursos = $cursos_instituicao->linhas;

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
	
if ($_GET["curso_instituicao"])
{
	$cod_curso_selecionado = $_GET["curso_instituicao"];
	$url_ordenacao.= "&curso_instituicao=".$cod_curso_selecionado;
}
else
{
	$cod_curso_selecionado = "T";
	$url_ordenacao.= "&curso_instituicao=".$cod_curso_selecionado;
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

if ($total_cursos > 0)
{		
	$input_cursos = "<select name=\"curso_instituicao\" onChange=\"JavaScript: paginacaoTurma('".$url_ordenacao."', 'paginacao_turma');\">";
	
	if ($cod_curso_selecionado == "T")
		$input_cursos.= "<option value=\"T\" selected>Todos</option>";
	else
		$input_cursos.= "<option value=\"T\">Todos</option>";
	for ($x = 0; $x < $total_cursos; $x++)
	{
		$cod_curso = $cursos_instituicao->data["cod_curso"];
		$curso = new curso();
		$curso->carregar($cod_curso);
		$descricao = $curso->getNome();
		
		if ($cod_curso == $cod_curso_selecionado)
			$input_cursos.= "<option value=\"".$cod_curso."\" selected>".$descricao."</option>";
		else
			$input_cursos.= "<option value=\"".$cod_curso."\">".$descricao."</option>";
			
		$cursos_instituicao->proximo();
	}
	
	$input_cursos.= "</select>";
}

if ($cod_curso_selecionado == "T")
{
	$cursos_instituicao->paginacao($cod_inst, $limite, $inicio, $ordem);
	$total_cursos = $cursos_instituicao->linhas;
}
else
{
	$cursos_instituicao->carregar($cod_curso_selecionado);
	$total_cursos = $cursos_instituicao->linhas;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO Administra&ccedil;&atilde;o</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes_turma.js"></script>

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
                <td height="42" bgcolor="#D5FFD5" width="100%" align="right"><a onClick="JavaScript: novaTurma();" style="cursor: pointer" class="link_verde">Nova Turma</a>&nbsp;</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				  <?php
					if ($total_cursos > 0)
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
						    <td class="campos" align="right">Curso</td>
						    <td width="10"></td>
						    <td width="50"><?php echo $input_cursos; ?></td>
						    <td width="10"></td>
						    <td width="80" class="campos" align="right">Listagem</td>
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
						<form name="turma_instituicao" method="post">
						  <tr> 
							<td width="30" align="center"><input type="checkbox" name="todos_turma" onClick="marcaTodosTurma('turma_curso');"></td>
							<td width="10">&nbsp;</td>
							<td class="preto">Marcar/Desmarcar Todos</td>
						  </tr>
						  <tr> 
							<td width="30" align="center">&nbsp;</td>
							<td width="10">&nbsp;</td>
							<td class="verde">Curso&nbsp;&nbsp;<?php 
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
							$cod_curso_atual = $cursos_instituicao->data["cod_curso"];
							
							for ($i = 0; $i < $total_cursos; $i++)
							{
								$cod_curso = $cursos_instituicao->data["cod_curso"];
								$curso = new curso();
								$curso->carregar($cod_curso);
								$nome_curso = $curso->getNome();
									
								$turmas_curso = new curso();
								$turmas_curso->colecaoTurmas($cod_curso);
								$total_turmas = $turmas_curso->linhas;
								$total_curso_turma+= $total_turmas;
								
								if (($cod_curso_atual != $cod_curso) and ($i > 0))
								{
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>">
						    <td colspan="3" height="10"></td>
						  </tr>
						  <?php								
								}
								
								if ($total_turmas > 0)
								{			
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>">
						    <td></td>
							<td></td>
						    <td class="verde"><?php echo $nome_curso; ?></td>
						  </tr>
						  <?php
									for ($j = 0; $j < $total_turmas; $j++)
									{
										$cod_turma = $turmas_curso->data["cod_turma"];
										$turma = new turma();
										$turma->carregar($cod_turma);
										$nome_turma = $turma->getDescricao();
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>"> 
							<td align="center"><?php echo "<input type='checkbox' name='".$cod_turma."' value='".$cod_turma."' onClick=\"JavaScript: atualizaCodigosInstituicao();\">"; ?></td>
							<td>&nbsp;</td>
							<td><a OnClick="JavaScript: visualizaTurma(<?php echo $cod_turma; ?>)" style="cursor: pointer" class="link_verde"><?php echo $nome_turma; ?></a></td>
						  </tr>
						  <?php
										$turmas_curso->proximo();
									}
									
									if ($cor_fundo == "")
										$cor_fundo = "";
									else
										$cor_fundo = "";
								}
								else
								{
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>">
						    <td></td>
							<td></td>
						    <td class="verde"><?php echo $nome_curso; ?></td>
						  </tr>
						  <tr>
						    <td></td>
							<td></td>
						    <td class="preto_simples">Nenhuma Turma Encontrada</td>
						  </tr>
						  <?php
						  		}
								
								$cursos_instituicao->proximo();
							}
						  ?>
						  <tr> 
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr> 
							<td colspan="3">
							  <table width="100%" align="center">
								<tr>
								  <td><?php if ($limite == "T") { ?><font class="preto">P�gina&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total_curso_turma, $url, true); ?></td>
								  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $total_curso_turma."/"; ?></font><font class="preto"><?php echo $total_curso_turma; ?></font></td>
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
						  <tr> 
							<td colspan="3"> <table width="100%" cellpadding="0" cellspacing="0">
								<tr> 
								  <td align="right">&nbsp;</td>
								  <td width="10">&nbsp;</td>
								  <td width="50" align="right"><input type="button" name="edita" value="Editar" onClick="JavaScript: editarInstituicao('');"></td>
								  <td width="10">&nbsp;</td>
								  <td width="50"><input type="button" name="exclui" value="Excluir" onClick="JavaScript: excluirInstituicao('');"></td>
								  <td width="20">&nbsp;</td>
								</tr>
							  </table>
							</td>
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
					  <td class="verde_simples" align="center">Nenhum Curso Encontrado.</td>
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