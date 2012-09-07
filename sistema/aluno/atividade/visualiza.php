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

include("../../../config/session.lib.aluno.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/atividade.php");
include("../../../classes/atividade_arquivo.php");
include("../../../classes/atividade_usuario.php");
include("../../../classes/curso.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "atividades";

if ($_GET["cod_atividade"])
	$cod_atividade = $_GET["cod_atividade"];
else
	$cod_atividade = $_POST["cod_atividade"];

$atividade = new atividade();
$atividade->carregar($cod_atividade);

$nome_atividade = $atividade->getAtividade();
$descricao_atividade = $atividade->getDescricao();
	
$data_atividade = formataData($atividade->getDataAtividade(), "/");
$hora_atividade = $atividade->getHoraAtividade();
$data_entrega_comparacao = $atividade->getDataEntrega();
$data_entrega = formataData($atividade->getDataEntrega(), "/");
$hora_entrega = $atividade->getHoraEntrega();
$hora_atividade = substr($hora_atividade, 0, 5);
$hora_entrega = substr($hora_entrega, 0 , 5);

$valor = $atividade->getValor();

$anexo = new atividade_arquivo();
$anexo->colecao($cod_atividade);
$total_anexos = $anexo->linhas;

if ($_POST["pagina"])
	$pagina = $_POST["pagina"];
else
	$pagina = 1;

if ($_POST["quantidade"])
	$quantidade = $_POST["quantidade"];
else
	$quantidade = 5;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	$ordem = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	function voltar()
	{
		document.visualizar_atividade.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.visualizar_atividade.submit();
	}
</script>

<body topmargin="0" leftmargin="0" <?php echo $onLoad; ?>>
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
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"><img src="../../../imagens/cantoq1.gif" width="10" height="10" border="0"></td>
		<td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="3" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			  <td bgcolor="#ffcc80"><img src="../../../imagens/icones/avaliacao/titulo_atividades_propostas.gif" width="250" height="52"></td>
			</tr>
		  </table>
		</td>
		<td height="10" background="../../../imagens/cantoq8.gif" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoq7.gif"><img src="../../../imagens/cantoq2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"></td>
		<td height="42" bgcolor="#ffecce" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_laranja">Voltar</a></td>
		<td width="10" background="../../../imagens/cantoq7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../../imagens/cantoq5.gif"></td>
		<td colspan="2" bgcolor="#ffecce">
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
			  <td width="100%" bgcolor="#ffecce">
			    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="1" background="../../../imagens/traco11.gif"><img height="1" src="../../../imagens/traco11.gif" border="0"></td>
				  </tr>
				  <tr>
				    <td height="10"></td>
				  </tr>
			    </table>
				<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td valign="top">
					  <form name="visualizar_atividade" action="controle.php" method="post" enctype="multipart/form-data">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFE3B9">
							<?php 
								if (isset($_SESSION["mensagem_atividade"]))
								{
							?>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<tr>
							  <td align="center" class="vermelho_simples" colspan="3"><?php echo $_SESSION["mensagem_atividade"]; ?></td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<?php
									unset($_SESSION["mensagem_atividade"]);
								}
							?>
							  <tr>
								<td colspan="3" class="preto">Dados da Atividade</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" width="140" align="right">Atividade:</td>
								<td width="10">&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $nome_atividade; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Descricao:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo nl2br($descricao_atividade); ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Valor:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $valor; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Data de Cadastro:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $data_atividade." às ".$hora_atividade; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Data de Entrega Limite:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $data_entrega." até às ".$hora_entrega; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Arquivos Anexos:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" valign="top" align="left">
								<?php
									if ($total_anexos  > 0)
									{
										echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
										
										for ($i = 0; $i < $total_anexos; $i++)
										{
											$cod_arquivo = $anexo->data["cod_arquivo"];
											$arquivo = new atividade_arquivo();
											$arquivo->carregar($cod_arquivo);
											$nome_arquivo = $arquivo->getNome();
											$descricao_arquivo = $arquivo->getDescricao();
											
											echo "  <tr>";
											echo "    <td>";
											echo "      <a onClick=\"JavaScript: window.location.href = 'download.php?cod_atividade=".$cod_atividade."&arquivo=".$nome_arquivo."'\" onMouseOver=\"JavaScript: window.status = 'Abrir Arquivo ".$nome_arquivo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Abrir Arquivo\" style=\"cursor:pointer\" class=\"link_laranja\">".$nome_arquivo."</a>";
											echo "    </td>";
											echo "  </tr>";
											echo "  <tr>";
											echo "    <td class=\"preto_simples\">";
											echo "      ".$descricao_arquivo;
											echo "    </td>";
											echo "  </tr>";
											
											if (($i + 1) < $total_anexos)
											{
												echo "  <tr>";
												echo "    <td>";
												echo "      &nbsp;";
												echo "    </td>";
												echo "  </tr>";
											}
											
											$anexo->proximo();
										}
										
										echo "</table>";
									}
									else
										echo "Nenhum arquivo em anexo";
								?>
								</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <?php
									//Verifica se o Usuário já realizou a Atividade
									$atividade_usuario = new atividade_usuario();
									$atividade_usuario->carregar($cod_atividade, $cod_usuario);
									$entregou = $atividade_usuario->linhas;
									
									if ($entregou > 0)
									{	
										$data_entrega_usuario = formataData($atividade_usuario->getDataEntrega(), "/");
										$hora_entrega_usuario = $atividade_usuario->getHoraEntrega();
										$hora_entrega_usuario = substr($hora_entrega_usuario, 0, 5);
										$comentario = $atividade_usuario->getComentario();
										$nome_arquivo = $atividade_usuario->getAnexo();
										$link_arquivo_entregue = "<a onClick=\"JavaScript: window.location.href = 'download.php?cod_atividade=".$cod_atividade."&cod_usuario=".$cod_usuario."&arquivo=".$nome_arquivo."'\" onMouseOver=\"JavaScript: window.status = 'Abrir Arquivo ".$nome_arquivo."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Abrir Arquivo\" style=\"cursor:pointer\" class=\"link_laranja\">".$nome_arquivo."</a>";
										$nota = $atividade_usuario->getNota();
										
										$situacao = $atividade_usuario->getSituacao();
										switch($situacao)
										{
											case "A":
												$situacao = "Aguardando Correção";
											break;
											
											case "C":
												$situacao = "Corrigido";
											break;
											
											case "R":
												$situacao = "Refazer";
											break;
										}
							  ?>
							  <tr>
								<td colspan="3" class="preto">Dados do Trabalho Entregue</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Data de Entrega:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $data_entrega_usuario." às ".$hora_entrega_usuario; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <?php 
								if ($nota != "")
								{
							  ?>
							  <tr>
								<td class="preto" align="right">Nota:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $nota; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <?php
								}
							  ?>
							  <tr>
								<td class="preto" align="right">Situa&ccedil;&atilde;o:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $situacao; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Comentário:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $comentario; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right">Arquivo:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><?php echo $link_arquivo_entregue; ?></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td colspan="3">
								  <table align="center" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_esquerdo1.gif" width="20" height="34"></td>
									  <td height="34" bgcolor="#FFECCE"><a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_direito1.gif" width="20" height="34"></td>
									</tr>
								  </table>
								</td>
							  </tr>
							  <?php
									}
									else
									{
							  ?>
							  <tr>
								<td colspan="3" class="preto" align="left">&nbsp;&nbsp;Encaminhar Trabalho</td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <?php			
										$hoje = date("Y-m-d");
										$agora = date("H:i:s");
										
										if ($hoje < $data_entrega_comparacao)
											$valida = "sim";
										else
											if ($hoje == $data_entrega_comparacao)
											{
												if ($agora >= $hora_entrega)
													$valida = "nao";
												else
													$valida = "sim";
											}
											else
												if ($hoje > $data_entrega)
													$valida = "nao";
										
										if ($valida == "sim")
										{
											$acao_atividade_usuario = "responder";
							  ?>
							  <tr>
								<td class="preto" align="right">Arquivo:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" align="left"><input type="file" name="arquivo_atividade_usuario"></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td class="preto" align="right" valign="top">Descrição do Arquivo:</td>
								<td>&nbsp;</td>
								<td class="laranja_simples" valign="top" align="left"><textarea name="descricao_arquivo" cols="45" rows="10"></textarea></td>
							  </tr>
							  <tr>
								<td colspan="3" height="15"></td>
							  </tr>
							  <tr>
								<td colspan="3">					
								  <input type="hidden" name="acao_atividade_usuario" value="<?php echo $acao_atividade_usuario; ?>">			
								  <input type="hidden" name="cod_atividade" value="<?php echo $cod_atividade; ?>">
								  <input type="hidden" name="cod_aluno" value="<?php echo $cod_atividade; ?>">
								  <input type="hidden" name="acao" value="editar">
								  <input type="hidden" name="acao_voltar" value="visualiza">
								  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">  
								  <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
								  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
								  <table align="center" border="0" cellspacing="0" cellpadding="0">
									<tr>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_esquerdo1.gif" width="20" height="34"></td>
									  <td height="34" bgcolor="#FFECCE"><a onClick="JavaScript: document.visualizar_atividade.submit();" onMouseOver="JavaScript: window.status = 'Editar Atividade';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Gravar" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
									  <td height="34"><img src="../../../imagens/icones/avaliacao/lado_direito1.gif" width="20" height="34"></td>
									</tr>
								  </table>
								</td>
							  </tr>
							  <?php
										}
										else
										{
							  ?>
							  <tr>
								<td class="vermelho" colspan="3" align="left">&nbsp;&nbsp;A Data de Entrega da Atividade Expirou.</td>
							  </tr>
							  <?php
										}
									}
							  ?>			
							  <tr>
							    <td colspan="3" height="10"></td>
							  </tr>  
							</table>
						  </td>
						</tr>
					  </table>
					  </form>
					</td>
				  </tr>
				</table>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="10"></td>
				  </tr>
				  <tr>
					<td height="1" background="../../../imagens/traco11.gif"><img height="1" src="../../../imagens/traco11.gif" border="0"></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../../imagens/cantoq7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantoq4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../../imagens/cantoq6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantoq3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>