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

include("../../../config/session.lib.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/recado.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "recados";

$ordem = $_POST["ordem"];
$pagina = $_POST["pagina"];
$quantidade = $_POST["quantidade"];
$tipo_acesso = $_SESSION["tipo_acesso"];

if ($_POST["pasta"])
{
	$pasta = $_POST["pasta"];
	$pasta_url = $pasta;
	
	switch($pasta)
	{
		case "E":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_caixa_de_entrada.gif\">";
		break;
		
		case "S":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_caixa_de_saida.gif\">";
		break;
		
		case "L":
			$titulo = "<img src=\"../../../imagens/icones/recados/titulo_lixeira.gif\">";
		break;		
	}
}

if ($_POST["cod_recado"])
{
	$cod_recado = $_POST["cod_recado"];
	$cod_turma = $_SESSION["cod_turma"];
	$pasta = $_POST["pasta"];
	$codigo_usuario = $_SESSION["cod_usuario"];
	$situacao = $_POST["situacao"];
	
	$recado = new recado();
	$recado->carregar($cod_recado);
	
	$cod_autor = $recado->getCodigoAutor();
	$assunto = $recado->getAssunto();
	$codigos = $recado->getDestinatario();
	$mensagem = $recado->getMensagem();
	$data_recado = $recado->getDataRecado();
	$hora = $recado->getHora();
	$hora = substr($hora, 0, 5);
	$atualizaSituacao = false;
		
	if ($situacao == "N")
	{
		$situacao = "L";
		$recado->alterarSituacaoRecado($cod_recado, $codigo_usuario, $cod_turma, $pasta, $situacao);
	}
	
	$usuario = new usuario();
	$usuario->carregar($cod_autor);
	$nome_autor = $usuario->getNome();
	
	$destinatarios = explode(";", $codigos);
	$total_destinatario = sizeof($destinatarios);

	if ($total_destinatario > 5)
	{
		$nomes_destinatarios_reduzido = "<a onClick=\"JavaScript: alternarAbas('destinatariosTotal');\" style=\"cursor: pointer\"><img title=\"Visualizar todos Desinatários\" src=\"../../../imagens/outros/node.jpg\" border=\"0\"></a>&nbsp;";
		$nomes_destinatarios = "<a onClick=\"JavaScript: alternarAbas('destinatariosReduzido');\" style=\"cursor: pointer\"><img title=\"Minimizar Desinatários\" src=\"../../../imagens/outros/nodeclose.jpg\" border=\"0\"></a>&nbsp;";
	}
		
	$contador = 0;
	for ($i = 0; $i < $total_destinatario; $i++)
	{
		$cod_usuario = $destinatarios[$i];
		if ($cod_usuario != "")
		{
			$usuario->carregar($cod_usuario);
			$nome = $usuario->getNome();
			$usuario->verificaAcessoTurma($cod_usuario, $cod_turma);
			
			if (($tipo_acesso == "aluno") and ($acesso == "C"))
			{
				
			}
			else
			{
				if ($i < 5)
					$nomes_destinatarios_reduzido.= $nome.";";

				$nomes_destinatarios.= $nome.";";
			}
			
			$recado->proximo();
		}
	}
	
	if ($total_destinatario > 5)
		$nomes_destinatarios_reduzido.= "&nbsp;<a onClick=\"window.alert('Clique no + para verificar todos os Destinatários');\" onMouseOver=\"JavaScript: window.status = 'Clique no + para Verificar todos os Destinatários';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\" class=\"link_azul\" title=\"Clique no + para Verificar todos os Destinatários\">veja mais</font>";
}

//Início Código de Contagem de Mensagens por Pasta
$pastas = new recado();
$cod_usuario = $_SESSION["cod_usuario"];

for ($i = 0; $i < 3; $i++)
{
	if ($i == 0)
		$pasta = "E";
	else
		if ($i == 1)
			$pasta = "S";
		else
			if ($i == 2)
				$pasta = "L";

	$pastas->qtdeMsgsPasta($cod_usuario, $cod_turma, $pasta);
	$total = $pastas->linhas;

	for ($j = 0; $j < $total; $j++)
	{
		$situacao = $pastas->data["situacao"];
		if ($pasta == $situacao)
		{
			if ($i == 0)
				$total_msgs_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$total_msgs_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$total_msgs_lixeira = $pastas->data["qtde"];
		}
		else
		{
			if ($i == 0)
				$msgs_nlidas_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$msgs_nlidas_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = $pastas->data["qtde"];
		}
	
		$pastas->proximo();
	}
	
	if ($total == 1)
	{
		if ($i == 0)
				$msgs_nlidas_entrada = 0;
			else
				if ($i == 1)
					$msgs_nlidas_saida = 0;
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = 0;
	}
	else
		if ($total == 0)
		{
			if ($i == 0)
			{
				$total_msgs_entrada = 0;
				$msgs_nlidas_entrada = 0;
			}
			else
			{
				if ($i == 1)
				{
					$total_msgs_saida = 0;
					$msgs_nlidas_saida = 0;
				}
				else
					if ($i == 2)
					{
						$total_msgs_lixeira = 0;
						$msgs_nlidas_lixeira = 0;
					}
			}
		}
}
//Fim Código de Contagem de Mensagens por Pasta
?>
<html>
<head>
<title>Sa&sup2;po - Recado</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script type="text/javascript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	function voltar()
	{
		document.visualizaRecado.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&pasta=<? echo $pasta; ?>&ordem=<? echo $ordem; ?>";
		document.visualizaRecado.submit();
	}
	
	var vetorAbas = new Array();
	vetorAbas[0] = new selecionarAba('destinatariosReduzido');
	vetorAbas[1] = new selecionarAba('destinatariosTotal');
</script>

<body leftmargin="0" topmargin="0">
<?php include("../topo.php"); ?>
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
		  <?php include("../ferramentas.php"); ?>
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
		    <div id="pastas_recados">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"><img src="../../../imagens/cantom1.gif" width="10" height="10" border="0"></td>
				<td width="301" height="52" rowspan="2" bgcolor="#C5D8EB">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="3" bgcolor="#FFFFFF"></td>
					</tr>
					<tr>
					  <td><?php echo $titulo; ?></td>
					</tr>
				  </table>
				</td>
				<td height="10" background="../../../imagens/cantom8.gif" valign="top"></td>
				<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom2.gif" width="10" height="10" border="0"></td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"></td>
				<td height="42" bgcolor="#E2ECF5" width="100%">
				  <table align="right" cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=E';" onMouseOver="JavaScript: window.status = 'Caixa de Entrada';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Entrada">Caixa de Entrada (<?php echo $total_msgs_entrada."/".$msgs_nlidas_entrada; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=S';" onMouseOver="JavaScript: window.status = 'Caixa de Saída';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Saída">Caixa de Saída (<?php echo $total_msgs_saida."/".$msgs_nlidas_saida; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=L';" onMouseOver="JavaScript: window.status = 'Lixeira';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Lixeira">Lixeira (<?php echo $total_msgs_lixeira."/".$msgs_nlidas_lixeira; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: novoRecado('<?php echo $pasta; ?>', '<?php echo $pagina; ?>', '<?php echo $limite; ?>', '<?php echo $ordem; ?>', 'visualizaRecado');" onMouseOver="JavaScript: window.status = 'Novo Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Novo Recado">Novo Recado</a></td>
					</tr>
				  </table>
				</td>
				<td width="10" background="../../../imagens/cantom7.gif"></td>
			  </tr>
			  <tr>
				<td width="10" background="../../../imagens/cantom5.gif"></td>
				<td colspan="2" bgcolor="#E2ECF5">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
					<tr>
					  <td bgcolor="#E2ECF5">
						<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						  <tr>
                            <td height="10"></td>
                          </tr>
						</table>
						<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
						  <tr>	
							<td align="left" valign="top">
							<form action="formulario.php" name="visualizaRecado" method="post">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
								  <tr>
								    <td colspan="3" class="azul">Recado</td>
								  </tr>
								  <tr>
								    <td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td width="80" class="azul" align="right">Data / Hora:</td>
									<td width="10"></td>
									<td class="preto_simples"><?php echo formataData($data_recado, "/")." às ".$hora; ?></td>
								  </tr>
								  <tr> 
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td width="80" class="azul" align="right">Autor:</td>
									<td width="10"></td>
									<td class="preto_simples"><?php echo $nome_autor; ?></td>
								  </tr>
								  <tr>
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td width="80" class="azul" align="right" valign="top">Destinat&aacute;rio:</td>
									<td width="10"></td>
									<td class="preto_simples"><div id="destinatariosReduzido"><?php echo nl2br($nomes_destinatarios_reduzido); ?></div><div id="destinatariosTotal" style="display: none"><?php echo nl2br($nomes_destinatarios); ?></div></td>
								  </tr>
								  <tr>
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td width="80" class="azul" align="right">Assunto:</td>
									<td width="10"></td>
									<td class="preto_simples"><?php echo nl2br($assunto); ?></td>
								  </tr>
								  <tr>
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td width="80" class="azul" align="right" valign="top">Mensagem:</td>
									<td width="10"></td>
									<td class="preto_simples"><?php echo nl2br(substituiSmilies($mensagem, $smilies, "../../../imagens/icones/smilies/")); ?></td>
								  </tr>
								  <tr>
									<td colspan="3" height="15"></td>
								  </tr>
								  <tr> 
									<td colspan="3" height="15">
									  <input type="hidden" name="acao" value="<?php echo $acao; ?>">
									  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
									  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
									  <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
									  <input type="hidden" name="pasta" value="<?php echo $pasta; ?>">
									  <input type="hidden" name="situacao" value="<?php echo $situacao; ?>">
									  <input type="hidden" name="codigosDestinos" value="<?php echo $codigos; ?>">
									  <input type="hidden" name="cod_recado" value="<?php echo $cod_recado; ?>">
									</td>
								  </tr>
								  <tr>
									<td colspan="3">
								      <table border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td height="34"><img src="../../../imagens/icones/recados/lado_esquerda1.gif" width="20" height="34"></td>
                                          <td height="34" bgcolor="#C5D8EB"><a onClick="JavaScript: encaminharRecado();" onMouseOver="JavaScript: window.status = 'Encaminhar Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Encaminhar Recado</span><img src="../../../imagens/icones/geral/tipo1/encaminhar.gif" alt="Encaminhar Recado" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: responderRecado();" onMouseOver="JavaScript: window.status = 'Responder Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Responder Recado</span><img src="../../../imagens/icones/geral/tipo1/responder.gif" alt="Responder Recado" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: responderRecadoATodos();" onMouseOver="JavaScript: window.status = 'Responder Recado a Todos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Responder Recado a Todos</span><img src="../../../imagens/icones/geral/tipo1/responder_todos.gif" alt="Responder Recado a Todos" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" alt="Voltar" width="30" height="30" border="0" align="middle"></a></td>
                                          <td height="34"><img src="../../../imagens/icones/recados/lado_direita1.gif" width="20" height="34"></td>
                                        </tr>
                                      </table>
									</td>
								  </tr>
							  </table>
							  </form>
							</td>
						  </tr>
						</table>
						<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
						    <td height="10"></td>
						  </tr>
						  <tr>
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				</td>
				<td width="10" align="right" background="../../../imagens/cantom7.gif">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantom4.gif" width="10" height="10" border="0"></td>
				<td height="10" background="../../../imagens/cantom6.gif" colspan="2"><img src="../../../imagens/cantom6.gif" height="10"></td>
				<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom3.gif" width="10" height="10" border="0"></td>
			  </tr>
			</table>
		  </div>
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
<?php include("../info.php"); ?>
</body>
</html>