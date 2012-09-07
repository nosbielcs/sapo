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

include("../../../config/session.lib.super.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/perfil.php");
include("../../../classes/forum.php");
include("../../../classes/mensagem_forum.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$modulo = "forum";

$cod_usuario_acesso = $cod_usuario;
$acao_voltar = $_POST["acao_voltar"];

if ($acao_voltar == "")
	$acao_voltar = "index";

if ($_GET["cod_forum"])
{
	$cod_forum = $_GET["cod_forum"];
	$pagina = $_GET["pag"];
}
else
	$cod_forum = $_POST["cod_forum"];
	
if ($_POST["pagina"])
	$pagina = $_POST["pagina"];

$forum = new forum();
$forum->carregar($cod_forum);

$acesso_forum = $forum->verificaAcesso($cod_forum, $cod_usuario_acesso);
if ($acesso_forum == "false")
	$forum->acessoForum($cod_forum, $cod_usuario_acesso);

$assunto = $forum->getAssunto();
$autor = $forum->getNomeUsuario();
$cod_autor = $forum->getCodigoUsuario();
$mensagem_forum = nl2br($forum->getMensagem());
$data_forum = formataData($forum->getDataForum(), "/");
$hora_forum = $forum->getHora();
$hora_forum = substr($hora_forum, 0, 5);
$visualizacoes = $forum->getVisualizacoes() + 1;
$forum->totalMsgsUsuario($cod_autor);
$total_msgs = $forum->data["total"];

$cod_editor = $forum->getCodigoEditor();
$data_edicao = formataData($forum->getDataEdicao(), "/");
$hora_edicao = $forum->getHoraEdicao();

$usuario = new usuario();
$usuario->verificaAcessoTurma($cod_autor, $cod_turma);
$acesso = $usuario->data["acesso"];

if ($acesso == "T")
	$categoria = "Tutor";
else
	if ($acesso == "L")
		$categoria = "Aluno";
	else
		if ($acesso == "S")
			$categoria = "Suporte Técnico";

if ($cod_editor != 0)
{
	$usuario = new usuario();
	$usuario->carregar($cod_editor);
	$nome_usuario = $usuario->getNome();
	$mensagem_forum.= "<br><br><i>Este post foi Editado por <b>".$nome_usuario."</b>: ".$data_edicao.", ".$hora_edicao."</i>";
}

//Atualiza Total de Visualizações
$forum->atualizaVisualizacoes($cod_forum, $cod_turma, $visualizacoes);

if (!isset($pagina))
{
	$pagina = 1;	
}

if ($_POST["pagina"])
	$pag = $_POST["pagina"];
else
	$pag = 1;

if ($_POST["quantidade"])
	$quantidade = $_POST["quantidade"];
else
	$quantidade = 5;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	$ordem = 1;

?>
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
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.tela_forum.action = "index.php?pag=<? echo $pag; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		       if ($acao_voltar == 'inicial')
		   	   {
		?>
					document.tela_forum.action = "../index.php";
		<?
		       }
		?>
		document.tela_forum.submit();
	}
</script>

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
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"><img src="../../../imagens/cantos1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
				<td valign="baseline" bgcolor="#CCCCCC"><img src="../../../imagens/icones/forum/titulo_discussao_ativa.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantos8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantos7.gif"><img src="../../../imagens/cantos2.gif" width="10" height="10" border="0"></td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"></td>
		  <td height="42" align="right" bgcolor="#E8E8E8" width="100%"></td>
		  <td width="10" background="../../../imagens/cantos7.gif"></td>
		</tr>
		<tr>
		  <td width="10" background="../../../imagens/cantos5.gif"></td>
		  <td colspan="2">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2" bgcolor="#E8E8E8">
			  <form action="controle.php" name="tela_forum" method="post">
			  <tr>
				<td width="100%">
				  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="1" background="../../../imagens/traco13.gif"><img src="../../../imagens/traco13.gif" border="0"></td>
					</tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#E8E8E8">
				  <tr>
					<td valign="top" align="center">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td>
						  <table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#CCCCCC">
							  <td width="180">
							    <table width="100%" border="0" cellpadding="0" cellspacing="0">
								  <tr>
								    <td width="5"></td>
								    <td class="cinza" align="left">Autor</td>
								  </tr>
								</table>
							  </td>
							  <td width="100%">
							    <table width="100%" border="0" cellpadding="0" cellspacing="0">
								  <tr>
								    <td width="5"></td>
								    <td class="cinza" align="left">Mensagem</td>
								  </tr>
								</table>
							  </td>
							</tr>
							<tr>
							  <td colspan="2" height="10"></td>
							</tr>
							<?php 
								if ($pagina == 1)
								{
									$perfil = new perfil();
									$perfil->carregar($cod_autor);
									$foto = $perfil->getFoto();
									$miniatura = $perfil->getMiniatura();
									$diretorio = $_SESSION["dir_perfil"].$cod_autor."/";
						
									if ($foto != _SEM_FOTO)
									{
										//Diretório dos Arquivos
										//Miniatura da Imagem
										if (($miniatura != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $miniatura)) and (file_exists($diretorio.$miniatura)))
										{
											$arquivo = "../../../arquivos/perfil/".$cod_autor."/".$miniatura;
											$img_miniatura = true;
										}
										else
										{
											$img_miniatura = false;
											//echo "miniatura false";	
										}
										
										//Foto no tamanho Original	
										if (($foto != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto)) and (file_exists($diretorio.$foto)))
										{
											$foto_g = "../../../arquivos/perfil/".$cod_autor."/".$foto;
											$img_foto = true;
										}
										else
										{
											$img_foto = false;
											//echo "foto false";
										}
											
										if ($img_foto === true)
										{
											if ($img_miniatura === true)
											{
												$dimensoes = dimensoesImagem($foto_g, 40);
												$dimensoes = explode(".", $dimensoes);
												$largura = $dimensoes[0];
												$altura = $dimensoes[1];
												$link = "janela('Foto','".$foto_g."' ,100 ,100 ,".$largura." ,".$altura." ,0 ,0 ,0 ,1 ,1);";
											}
											else
												$link = "";
										}
										else
											{
												$arquivo = "../../../imagens/"._SEM_FOTO;
												$link = "";
											}
									}
									else
										{
											$arquivo = "../../../imagens/"._SEM_FOTO;
											$link = "";
										}
							?>
							<tr>
							  <td colspan="2">
							    <a name="topo"></a>
							    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="cinza_borda">
								  <tr>
								    <td width="180" valign="top">
									  <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
									    <tr>
										  <td width="5">&nbsp;</td>
										  <td class="cinza" align="left"><?php echo $autor; ?></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="10"></td>
									    </tr>
									    <tr>
										  <td width="5">&nbsp;</td>
										  <td align="left"><a onClick="JavaScript: <?php echo $link; ?>"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="15"></td>
									    </tr>
									    <tr>
										  <td width="5">&nbsp;</td>
										  <td class="cinza" align="left">Mensagens: <font class="cinza_simples"><?php echo $total_msgs; ?></font></td>
									    </tr>
									    <tr>
										  <td width="5">&nbsp;</td>
										  <td class="cinza" align="left">Categoria: <font class="cinza_simples"><?php echo $categoria; ?></font></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="15"></td>
									    </tr>
									  </table>
								    </td>
								    <td valign="top">
									  <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
									    <tr>
										  <td width="5"></td>
										  <td align="left" colspan="2"><font class="cinza_simples"><?php echo $data_forum." ".$hora_forum; ?></font>&nbsp;<font class="cinza">Assunto:</font>&nbsp;<font class="cinza_simples"><?php echo nl2br($assunto); ?></font></td>
									      <td width="5"></td>
										</tr>
									    <tr>
										  <td colspan="3"><hr></td>
										  <td width="5"></td>
									    </tr>
									    <tr>
										  <td width="5"></td>
										  <td colspan="2" class="cinza_simples" align="left"><?php echo citarMsgForum($mensagem_forum, $smilies); ?></td>
										  <td width="5"></td>
									    </tr>
									  </table>
								    </td>
							      </tr>
								</table>
							  </td>
							</tr>
								<?php
									}
									//Total de Linhas do Fórum + Mensagens do Fórum
									$total_msgs = new forum();
									$total_msgs->totalMensagens($cod_forum);	
									$total = $total_msgs->linhas;
									//
									
									$qtd_listagem = 10; //Quantidade de Resultados por página
									$linhas = $total; //Número de Linhas 
									
									$inicial = $pagina - 1; //Página Inicial
									$inicial = $inicial * $qtd_listagem; //Página Inicial
					
									$dados = $forum->paginacao($cod_forum, $qtd_listagem, $inicial); //Dados que serão exibidos
									$qtde_exibir = $forum->linhas;
									$url = "visualiza.php?cod_forum=".$cod_forum; //URL
									$paginas = paginacao($pagina, $inicial, $qtd_listagem, $linhas, $url, true); //Função Paginação
									
									for ($i = 0; $i < $qtde_exibir; $i++)
									{
										if ((($pagina == 1) and ($i > 0)) or ($pagina > 1))
										{
											$forum_mensagem = new mensagem_forum();
											
											$cod_mensagem = $forum->data["codigo"];
											$forum_mensagem = new mensagem_forum();
											
											$forum_mensagem->carregar($cod_mensagem);
											$assunto_mensagem = $forum_mensagem->getAssunto();
											$mensagem_resp = nl2br($forum_mensagem->getMensagem());
											$cod_autor = $forum_mensagem->getCodigoUsuario();
											$autor_mensagem = $forum_mensagem->getNomeUsuario();
											$data_mensagem = formataData($forum_mensagem->getDataMensagem(), "/");						
											 
											$hora_mensagem = $forum_mensagem->getHora();
											$hora_mensagem = substr($hora_mensagem, 0, 5);
											$forum_mensagem->totalMsgsUsuario($cod_autor);
											$total_msgs = $forum_mensagem->data["total"];
											
											$cod_editor = $forum_mensagem->getCodigoEditor();
											$data_edicao = formataData($forum_mensagem->getDataEdicao(), "/");
											$hora_edicao = $forum_mensagem->getHoraEdicao();
											
											$usuario = new usuario();
											$usuario->verificaAcessoTurma($cod_autor, $cod_turma);
											$acesso = $usuario->data["acesso"];
					
											if ($acesso == "T")
												$categoria = "Tutor";
											else
												if ($acesso == "L")
													$categoria = "Aluno";
												else
													if ($acesso == "S")
														$categoria = "Suporte Técnico";
											
											if ($cod_editor != 0)
											{
												$usuario = new usuario();
												$usuario->carregar($cod_editor);
												$nome_usuario = $usuario->getNome();
												$mensagem_resp.= "<br><br><i>Este post foi Editado por <b>".$nome_usuario."</b>: ".$data_edicao.", ".$hora_edicao."</i>";
											}
											
											$perfil = new perfil();
											$perfil->carregar($cod_autor);
											$foto = $perfil->getFoto();
											$miniatura = $perfil->getMiniatura();
											
											$diretorio = $_SESSION["dir_perfil"].$cod_autor."/";
							
											if ($foto != _SEM_FOTO)
											{
												//Diretório dos Arquivos
												//Miniatura da Imagem
												if (($miniatura != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $miniatura)) and (file_exists($diretorio.$miniatura)))
												{
													$arquivo = "../../../arquivos/perfil/".$cod_autor."/".$miniatura;
													$img_miniatura = true;
												}
												else
												{
													$img_miniatura = false;
													//echo "miniatura false";	
												}
												
												//Foto no tamanho Original	
												if (($foto != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto)) and (file_exists($diretorio.$foto)))
												{
													$foto_g = "../../../arquivos/perfil/".$cod_autor."/".$foto;
													$img_foto = true;
												}
												else
												{
													$img_foto = false;
													//echo "foto false";
												}
													
												if ($img_foto === true)
												{
													if ($img_miniatura === true)
													{
														$dimensoes = dimensoesImagem($foto_g, 40);
														$dimensoes = explode(".", $dimensoes);
														$largura = $dimensoes[0];
														$altura = $dimensoes[1];
														$link = "janela('Foto','".$foto_g."' ,100 ,100 ,".$largura." ,".$altura." ,0 ,0 ,0 ,1 ,1);";
													}
													else
														$link = "";
												}
												else
													{
														$arquivo = "../../../imagens/"._SEM_FOTO;
														$link = "";
													}
											}
											else
												{
													$arquivo = "../../../imagens/"._SEM_FOTO;
													$link = "";
												}
												
								?>
							<tr>
							  <td colspan="2" height="10"></td>
							</tr>
							<tr>
							  <td colspan="2">
							    <table width="100%" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC" class="cinza_borda">
								  <tr>
								    <td width="180" align="center" valign="top">
									  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
									    <tr>
										  <td width="5"></td>
										  <td class="cinza" align="left"><?php echo $autor_mensagem; ?></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="10"></td>
									    </tr>
									    <tr>
										  <td width="5"></td>
										  <td align="left"><a onClick="JavaScript: <?php echo $link; ?>"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="15"></td>
									    </tr>
									    <tr>
										  <td width="5"></td>
										  <td class="cinza" align="left">Mensagens: <font class="cinza_simples"><?php echo $total_msgs; ?></font></td>
									    </tr>
									    <tr>
										  <td width="5"></td>
										  <td class="cinza" align="left">Categoria: <font class="cinza_simples"><?php echo $categoria; ?></font></td>
									    </tr>
									    <tr>
										  <td colspan="2" height="15"></td>
									    </tr>
									  </table>
								    </td>
								    <td valign="top">
									  <table width="100%" align="left" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
									    <tr>
										  <td width="5"></td>
										  <td align="left" colspan="2"><font class="cinza_simples"><?php echo $data_mensagem." ".$hora_mensagem; ?></font>&nbsp;<font class="cinza">Assunto:</font>&nbsp;<font class="cinza_simples"><?php echo $assunto_mensagem; ?></font></td>
										  <td width="5"></td>
									    </tr>
									    <tr>
										  <td colspan="3"><hr></td>
										  <td width="5"></td>
									    </tr>
									    <tr>
										  <td width="5"></td>
										  <td colspan="2" class="cinza_simples" align="left"><?php echo citarMsgForum($mensagem_resp, $smilies); ?></td>
										  <td width="5"></td>
									    </tr>
									  </table>
								    </td>
								  </tr>
							    </table>
							  </td>
							</tr>
							<?php
									}
									$forum->proximo();
								}
							?>
						  </table>
						  </td>
						</tr>
						<tr>
						  <td align="right" colspan="4"><a onClick="JavaScript: window.location.href = '#topo'" onMouseOver="JavaScript: window.status = 'Voltar ao Topo desta Página';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_cinza">Voltar ao Topo desta Página</a></td>
						</tr>
						<tr>
						  <td align="left" colspan="4"><?php echo $paginas; ?></td>
						</tr>
						<tr>
						  <td height="10" colspan="4">
						    <input type="hidden" name="acao" value="">
							<input type="hidden" name="acao_voltar" value="visualiza">
							<input type="hidden" name="cod_forum" value="<?php echo $cod_forum; ?>">
							<input type="hidden" name="listagem" value="<?php echo $qtd_listagem; ?>">
							<input type="hidden" name="cod_mensagem" value="">
							<input type="hidden" name="citacao" value="">
							<input type="hidden" name="tipo" value="">
							<input type="hidden" name="pagina" value="<?php echo $pag; ?>">
							<input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
							<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						  </td>
						</tr>
						<tr>
						  <td colspan="4">
						    <table cellpadding="0" cellspacing="0" align="center">
							  <tr>
						        <td height="34"><img src="../../../imagens/icones/forum/lado_esquerda.gif" width="20" height="34"></td>
						        <td height="34" bgcolor="#CCCCCC"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
						        <td height="34"><img src="../../../imagens/icones/forum/lado_direita.gif" width="20" height="34"></td>
						      </tr>
							</table>
						  </td>
						</tr>
					  </table>
					</td>
				  </tr>
				  </table>
				  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td background="../../../imagens/traco13.gif"></td>
					</tr>
				  </table>
				</td>
			  </tr>
			  </form>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantos7.gif">&nbsp;</td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantos4.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantos6.gif" colspan="2"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantos3.gif" width="10" height="10" border="0"></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
