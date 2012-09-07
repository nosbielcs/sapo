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
include("../../../classes/conteudo.php");
include("../../../classes/conteudo_usuario.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "conteudo";

$cod_conteudo = $_POST["cod_conteudo"];

$conteudo = new conteudo();
$conteudo->carregar($cod_conteudo);

$descricao = $conteudo->getDescricao();

$pagina = $_POST["pagina"];
$quantidade = $_POST["quantidade"];
$ordem = $_POST["ordem"];
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
		document.permissao_usuario.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.permissao_usuario.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: atualizaCodigosPermissao(); defineLayer();">
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
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"><img src="../../../imagens/cantop1.gif" width="10" height="10" border="0"></td>
          <td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="3" bgcolor="#FFFFFF"></td>
              </tr>
              <tr>
                <td bgcolor="#E8BBD1"><img src="../../../imagens/icones/conteudo/titulo_materiais_disponiveis.gif" width="250" height="52"></td>
              </tr>
            </table>
		  </td>
          <td height="10" background="../../../imagens/cantop8.gif" width="436" valign="top"></td>
          <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantop7.gif"><img src="../../../imagens/cantop2.gif" width="10" height="10" border="0"></td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"></td>
          <td height="42" bgcolor="#F5E2EC" width="100%" align="right"><a onClick="JavaScript: voltar();" class="link_magenta" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer">Voltar</a></td>
          <td width="10" background="../../../imagens/cantop7.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../../../imagens/cantop5.gif"></td>
          <td colspan="2" bgcolor="#F5E2EC">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
              <tr>
                <td width="100%" bgcolor="#F5E2EC">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="1" background="../../../imagens/traco10.gif"><img src="../../../imagens/traco10.gif" border="0"></td>
                    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
                  </table>
				<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
				  <tr>
					<td valign="top" align="center">
					  <form name="permissao_usuario" action="controle.php" method="post">
					  <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr> 
						  <td class="magenta" align="left">Permiss&otilde;es do Conte&uacute;do &quot;<?php echo $descricao; ?>&quot;</td>
						</tr>
						<tr> 
						  <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr> 
							  <td valign="top">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
								  <tr> 
									<td height="15"></td>
								  </tr>
								  <tr>
									<td> 
									  <table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr> 
										  <td colspan="3" class="preto" align="left">Participantes</td>
										</tr>
										<tr> 
										  <td colspan="3" height="15"></td>
										</tr>
										<?php
											//Alunos
											$alunos = new usuario();
											$alunos->colecaoUsuarioTurma($_SESSION["cod_turma"], "L", "");
											$total_alunos = $alunos->linhas;
											
											$cor_fundo = "magenta_linha_1";
											if ($total_alunos > 0)
											{
										  ?>
										<tr> 
										  <td> 
											<table width="100%" cellpadding="0" cellspacing="0">
											  <tr bgcolor="#E8BBD1"> 
												<td width="20"><input type="checkbox" name="todos_permissao" onClick="marcaTodosPermissao('permissao_usuario');"></td>
												<td width="10">&nbsp;</td>
											    <td class="magenta" align="left">Marcar / Desmarcar Todos</td>
											  </tr>
											  <tr> 
												<td colspan="3" class="preto" align="left">Alunos</td>
											  </tr>
											  <?php	
												for ($i = 0; $i < $total_alunos; $i++)
												{
													$cod_usuario = $alunos->data["cod_usuario"];
													$acesso_usuario = $alunos->data["acesso"];
													$conteudo_usuario = new conteudo_usuario();
													$conteudo_usuario->carregar($cod_conteudo, $cod_usuario);
													$acesso_conteudo = $conteudo_usuario->getAcesso();
													
													$usuario = new usuario();
													$usuario->carregar($cod_usuario);
												
													$nome = $usuario->getNome();
													
													if ($cor_fundo == "magenta_linha_1")
														$cor_fundo = "magenta_linha_2";
													else
														$cor_fundo = "magenta_linha_1";
											  ?>
											  <tr>
											    <td colspan="3" height="1" class="<?php echo $cor_fundo; ?>"></td>
											  </tr>
											  <tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>"> 
												<td width="20"> 
											  <?php								
													if ($acesso_conteudo == "P")
														echo "<input type='checkbox' name='".$cod_usuario."' value='".$cod_usuario."' id='".$cor_fundo."' checked=\"true\" onClick=\"JavaScript: atualizaCodigosPermissao();\">"; 
													else
														echo "<input type='checkbox' name='".$cod_usuario."' value='".$cod_usuario."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaCodigosPermissao();\">";
											  ?>
												</td>
												<td width="10">&nbsp;</td>
												<td align="left" class="preto_simples"><?php echo $nome; ?></td>
											  </tr>
											  <tr>
								                <td colspan="3" height="1" class="<?php echo $cor_fundo; ?>"></td>
								              </tr>
											  <?php	
													$alunos->proximo();
												}
											  ?>
											  </table>
											</td>
										  </tr>
										  <?php
											}
											else
											{
										  ?>
										  <tr> 
											<td colspan="3" class="magenta">Esta Turma n&atilde;o possui Alunos cadastrados.</td>
										  </tr>
										  <?php
											}
										  ?>
										</table>
									  </td>
									</tr>
									<tr> 
									  <td height="15"><input type="hidden" name="codigos_permissao" value="<?php echo $codigos_permissao; ?>"><input type="hidden" name="acao" value="conteudo_permissoes"><input type="hidden" name="cod_conteudo" value="<?php echo $cod_conteudo; ?>"></td>
									</tr>
									<tr> 
									  <td>
										<table align="center" border="0" cellspacing="0" cellpadding="0">
										  <tr>
							    			<td height="34"><img src="../../../imagens/icones/conteudo/lado_esquerda1.gif" width="20" height="34"></td>
							    			<td height="34" bgcolor="#E8BBD1"><a onClick="JavaScript: document.permissao_usuario.submit();" onMouseOver="JavaScript: window.status = 'Gravar Permissões';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" width="30" height="30" border="0" align="middle"></a></td>
							    			<td height="34"><img src="../../../imagens/icones/conteudo/lado_direita1.gif" width="20" height="34"></td>
							  			  </tr>
						    			</table>
									  </td>
									</tr>
								  </table>
								</td>
							  </tr>
							</table></td>
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
                      <td height="1" background="../../../imagens/traco10.gif"><img src="../../../imagens/traco10.gif" border="0"></td>
                    </tr>
                  </table>
				</td>
              </tr>
            </table>
	      </td>
          <td width="10" align="right" background="../../../imagens/cantop7.gif">&nbsp;</td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantop4.gif" width="10" height="10" border="0"></td>
          <td height="10" background="../../../imagens/cantop6.gif" colspan="2"></td>
          <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantop3.gif" width="10" height="10" border="0"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
