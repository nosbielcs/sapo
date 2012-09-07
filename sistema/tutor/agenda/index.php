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
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/evento.php");
include("../../../classes/perfil.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "agenda";

$eventos = new evento();
$eventos->colecao($cod_turma);
$total_eventos = $eventos->linhas;

if ($_GET["pag"])
{
	$pagina = $_GET["pag"];
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_paginacao = "index.php?pag=".$pagina;
}
else
{
	$pagina = 1;
	$url_ordenacao = "index.php?pag=".$pagina;
	$url_paginacao = "index.php?pag=".$pagina;
}
	
if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
	$url_ordenacao.= "&qtd=".$limite;
}
else
{
	if ($_GET["qtd"])
	{
		$limite = $_GET["qtd"];
		$url_ordenacao.= "&qtd=".$limite;
	}
	else
	{
		if (isset($_SESSION["agenda_qtd_lst"]))
			$limite = $_SESSION["agenda_qtd_lst"];
		else
			$limite = 5;
		$url_ordenacao.= "&qtd=".$limite;
	}
}

if ($_GET["ordem"])
{
	$ordem = $_GET["ordem"];
}
else
{
	if (isset($_SESSION["agenda_ordem"]))
		$ordem = $_SESSION["agenda_ordem"];
	else
		$ordem = 1;
}

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;

$eventos->paginacao($cod_turma, $limite, $inicio, $ordem);
$qtd_listagem = $eventos->linhas;

if ($_GET["ordem"])
{
	switch($ordem) 
	{
		case 1:
			$url_ordenacao.= "&ordem=2";
			$url_paginacao = "index.php?pag=".$pagina;
			$link_ordenacao = "<a onClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
		break;
		
		case 2:
			$url_ordenacao.= "&ordem=1";
			$url_paginacao = "index.php?pag=".$pagina;
			$link_ordenacao = "<a onClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" title=\"Ordem Decrescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
		break;
	}
}
else
{
	$url_ordenacao.= "&ordem=2";
	$url_paginacao = "index.php?pag=".$pagina;
	$link_ordenacao = "<a onClick=\"JavaScript: window.location.href = '".$url_ordenacao."'\" title=\"Ordem Crescente por Data\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Data';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>
<script language="JavaScript" src="../../../funcoes/funcoes_agenda.js"></script>

<body topmargin="0" leftmargin="0">
<?php include("../../geral/topo.php"); ?>
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
		  <?php include("../../geral/ferramentas.php"); ?>
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
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoo10.gif"><img src="../../../imagens/cantoo1.gif" width="10" height="10" border="0"></td>
            <td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="3" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                  <td bgcolor="#C5C8DA"><img src="../../../imagens/icones/agenda/titulo_calendario_eventos.gif" width="250" height="52"></td>
                </tr>
              </table>
		    </td>
            <td height="10" background="../../../imagens/cantoo8.gif" width="436" valign="top"></td>
            <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoo7.gif"><img src="../../../imagens/cantoo2.gif" width="10" height="10" border="0"></td>
          </tr>
          <tr>
            <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoo10.gif"></td>
            <td height="42" bgcolor="#D7D9E5" width="100%" align="right"><a onClick="JavaScript: novoEvento('<?php echo $pagina; ?>', '<?php echo $limite; ?>', '<?php echo $ordem; ?>');" onMouseOver="JavaScript: window.status = 'Novo Evento';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_purpura">Novo Evento</a></td>
            <td width="10" background="../../../imagens/cantoo7.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../../../imagens/cantoo5.gif"></td>
            <td colspan="2" bgcolor="#D7D9E5">
			  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                <tr>
                  <td width="100%" bgcolor="#D7D9E5">
				    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					  <form name="visualizaEvento" method="post">
                      <tr>
                        <td height="1" background="../../../imagens/traco9.gif"></td>
                      </tr>
					  <tr>
					    <td height="10">
						  <input type="hidden" name="cod_evento" value="">
						  <input type="hidden" name="acao" value="">
						  <input type="hidden" name="ordem" value="">
						  <input type="hidden" name="pagina" value="">
						  <input type="hidden" name="quantidade" value="">
						</td>
					  </tr>
					  </form>
					  <form action="../../geral/perfil_usuario.php" method="post" name="perfil_participante">
					    <input type="hidden" name="cod_participante">
					    <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
						<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
						<input type="hidden" name="acao_voltar" value="agenda">
					  </form>
                    </table>
				   <?php
						if ($qtd_listagem > 0)
						{
				   ?>
                    <table width="95%" align="center">
                      <tr>
                        <td valign="top">
						  <table width="100%">
							<tr>
							  <td colspan="4" class="menuTitulo" align="left"></td>
  							</tr>
							<tr>
							  <td width="100%">&nbsp;</td>
							  <td width="100">
							    <table border="0" cellpadding="0" cellspacing="0" width="100%">
								  <form name="paginacao_evento" action="index.php" method="post">
								<tr>
								  <td class="preto" align="right">Listagem</td>
								  <td width="10">&nbsp;</td>
								  <td width="50">
									<select name="qtd_listagem" onChange="JavaScript: paginacao('<?php echo $url_paginacao; ?>', 'paginacao_evento');">
									  <option value="1" <?php if ($limite == 1) echo "selected"; ?>>1</option>
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
							<td>
							  <table border="0" cellpadding="0" cellspacing="0" width="100%">
							    <tr>	      
								  <td class="preto" width="60">Ordenação</td>
								  <td width="5">&nbsp;</td>
								  <td><?php echo $link_ordenacao; ?></td>
								</tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </td>
					 </tr>
					  <?php 
						if (isset($_SESSION["mensagem_evento"]))
						{
					 ?>
					 <tr>
					   <td align="center" class="vermelho_simples" colspan="4"><?php echo $_SESSION["mensagem_evento"]; ?></td>
					 </tr>
					 <?php
					 		$mensagem = true;
							unset($_SESSION["mensagem_evento"]);
						}
					 ?>
				   </table>
				   <table width="95%" align="center">
				   <?php								
							for ($i = 0; $i < $qtd_listagem; $i++)
							{
								$cod_evento = $eventos->data["cod_evento"];
								$evento = new evento();
								$evento->carregar($cod_evento);
								
								$cod_evento = $evento->getCodigo();
								$cod_autor = $evento->getCodigoUsuario();
								$assunto = $evento->getAssunto();
								$descricao = $evento->getDescricao();
								$hora = $evento->getHora();
								$data_evento = $evento->getDataEvento();
								$tipo = $evento->getTipo();
								$situacao = $evento->getSituacao();
								
								$autor = new usuario();
								$autor->carregar($cod_autor);
								$nome_usuario = $autor->getNome();
				   ?>
				   <tr>
				     <td>
					   <table width="100%" align="center" bgcolor="#C5C8DA">
					     <tr>
						   <td valign="top">
						     <table width="100%" border="0">
							   <tr>
							     <td class="preto" align="right" width="70">Evento:</td>
								 <td width="10">&nbsp;</td>
								 <td class="purpura"><?php echo $assunto; ?></td>
							   </tr>
							   <tr>
								 <td class="preto" align="right" valign="top" width="70">Descrição:</td>
								 <td width="10">&nbsp;</td>
								 <td class="purpura_simples"><?php echo $descricao; ?></td>
							   </tr>
							 </table>
							 <table width="100%" cellpadding="0" cellspacing="0">
							   <tr>
							     <td height="10"></td>
							   </tr>
							 </table>
							 <table border="0" width="100%">
							   <tr>
							     <td class="preto" align="right" width="70">Autor:</td>
							     <td width="10">&nbsp;</td>
							     <td><a onClick="JavaScript: visualizarPerfil(<?php echo $cod_autor; ?>, '../perfil/');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome_usuario; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_purpura"><?php echo $nome_usuario; ?></a></td>
							     <td class="preto" align="right">Data / Hora:</td>
							     <td width="10">&nbsp;</td>
							     <td class="purpura_simples">
							     <?php 
									if ((substr($hora, 0, 2) >= "00") && (substr($hora, 0, 2) <= "12"))
									{ 
										$hora = substr($hora, 0, 5);
										echo formataData($data_evento, "/")." ".$hora." am";
									}
									else
									{
										$hora = substr($hora, 0, 5);
										echo formataData($data_evento, "/")." ".$hora." pm";
									}
							     ?>
							     </td>
							   </tr>
							   <tr>
							     <td class="preto" align="right" width="70">Situação:</td>
							     <td width="10">&nbsp;</td>
							     <td class="purpura_simples"><?php if ($situacao == "A") echo "Evento Ativo"; else echo "Evento Inativo"; ?></td>
							     <td class="preto" align="right">Status:</td>
							     <td width="10">&nbsp;</td>
							     <td class="purpura_simples">
								   <?php 
									if ($data_evento < date("Y-m-d"))
										echo "Realizado";
									else
									{
										if (($data_evento == date("Y-m-d")) && ($hora < date("H:i")))
											echo "Realizado";
										else
											if (($data_evento == date("Y-m-d")) && ($hora > date("H:i")))
												echo "Não Realizado";
											else
												if ($data_evento > date("Y-m-d"))
													echo "Não Realizado";	
									}
								   ?>
							     </td>
							   </tr>
						     </table>
							 <table align="center" border="0" cellspacing="0" cellpadding="0">
							   <tr>
							     <td colspan="3" height="5"></td>
							   </tr>
							   <tr>
								 <td height="34"><div align="right"><img src="../../../imagens/icones/geral/tipo1/lado_esquerda.gif" width="20" height="34"></div></td>
								 <td height="34" bgcolor="#D7D9E5"><a onClick="JavaScript: editarEvento(<?php echo $pagina; ?>, <?php echo $limite; ?>, <?php echo $ordem; ?>, <?php echo $cod_evento; ?>);" onMouseOver="JavaScript: window.status = 'Editar Evento';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Editar</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" alt="Editar" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: excluirEvento(<?php echo $pagina; ?>, <?php echo $limite; ?>, <?php echo $ordem; ?>, <?php echo $cod_evento; ?>, '<?php echo $assunto; ?>');" onMouseOver="JavaScript: window.status = 'Excluir Evento';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Excluir</span><img src="../../../imagens/icones/geral/tipo1/excluir.gif" alt="Excluir" width="30" height="30" border="0" align="middle"></a></td>
								 <td height="34"><div align="left"><img src="../../../imagens/icones/geral/tipo1/lado_direita.gif" width="20" height="34"></div></td>
							   </tr>
							   <tr>
							     <td colspan="3" height="5"></td>
							   </tr>
							 </table>
						   </td>
						 </tr>
					   </table>
					 </td>
				   </tr>
				   <?php
								if (($i + 1) < $qtd_listagem)
								{
				   ?>
				   <tr>
					 <td height="15"></td>
				   </tr>
				   <?php
				   				}
								
								$eventos->proximo();
							}
				 ?>
                 </table>
				 <table width="95%" align="center">
					<tr>
					  <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total_eventos, $url, true); ?></td>
					  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $total_eventos; ?></font></td>
					</tr>
				  </table>
				  <?php
				  		}
						else
							if (!$mensagem)
							{
				  ?>
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
				      <td align="center" class="vermelho_simples">Nenhum Evento Cadastrado.</td>
				    </tr>
				  </table>
				  <?php
				   			}
				  ?>
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td height="1" background="../../../imagens/traco9.gif"></td>
					</tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../../imagens/cantoo7.gif">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantoo4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../../imagens/cantoo6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantoo3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
