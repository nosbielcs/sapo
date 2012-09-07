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
include("../../../classes/usuario.php");
include("../../../funcoes/funcoes.php");

$modulo = "usuarios";
$nome_curso = $_SESSION["nome_curso"];
$cod_inst = $_SESSION["cod_instituicao"];
$cod_curso = $_SESSION["cod_curso"];

if ($_POST["acao_usuario"])
{	
	$acesso_usuario = $_POST["tipo_acesso"];
	$acao_usuario = $_POST["acao_usuario"];
	$curso_turma = new curso();
	$curso_turma->colecaoTurmas($cod_curso);
	$total_turmas = $curso_turma->linhas;
	
	if ($total_turmas > 0)
	{
		$select_turmas = "<select name=\"curso_turmas\">";
			
		for ($i = 0; $i < $total_turmas; $i++)
		{
			$cod_turma = $curso_turma->data["cod_turma"];
			$turma = new turma();
			$turma->carregar($cod_turma);
			$descricao_turma = $turma->getDescricao();
			$select_turmas.= "<option value=\"".$cod_turma."\">".$descricao_turma."</option>";
			
			$curso_turma->proximo();
		}
		
		$select_turmas.= "</select>";
		
		if ($acao_usuario == "inscritos")
		{
			$acao_usuario = $_POST["acao_usuario"];
			//Seleciona Inscritos da Base INSCRITOS
			$conexao = mysql_connect("localhost", "inscricao", "F3!nScp3");
			$db = mysql_select_db("inscricao", $conexao);
			$sql = "SELECT cod_cur FROM cursos WHERE descricao = '".$nome_curso."'";
			$resultado = mysql_query($sql, $conexao);
			$cod_curso_inscricao = mysql_result($resultado, 0, "cod_cur");
			
			$sql_inscritos = "SELECT cod_inscr, nome, cpf, data_nasc, email, sexo FROM inscritos WHERE cod_cur = ".$cod_curso_inscricao." AND pagamento = 'S' ORDER BY nome";
			$resultado_inscritos = mysql_query($sql_inscritos, $conexao);
			$inscritos = mysql_fetch_array($resultado_inscritos);
			$total_inscritos = mysql_num_rows($resultado_inscritos);
			mysql_close($conexao);
			
			$lista_usuarios_sapo = new usuario();
			$lista_usuarios_sapo->colecaoUsuarioCurso($cod_curso, "Q", "");
			$total_usuarios_sapo = $lista_usuarios_sapo->linhas;
			
			$select = "<select name=\"usuariosImportar\" multiple size=\"8\">";
					
			for ($i = 0; $i < $total_inscritos; $i++)
			{
				mysql_data_seek($resultado_inscritos, $i);
				$linha = mysql_fetch_assoc($resultado_inscritos);
				$cod_usuario = $linha["cod_inscr"];
				$nome = $linha["nome"];
				$cpf = $linha["cpf"];
				$data_nasc = $linha["data_nasc"];
				$email = $linha["email"];
				$encontrou = false;
				
				if ($total_usuarios_sapo > 0)
				{
					for ($j = 0; $j < $total_usuarios_sapo; $j++)
					{
						$cpf_usuario_sapo = $lista_usuarios_sapo->data["cpf"];
						
						if (($cpf_usuario_sapo == $cpf) and (!$encontrou))
							$encontrou = true;
					
						$lista_usuarios_sapo->proximo();
					}
					
					$lista_usuarios_sapo->primeiro();
				}
				
				if (!$encontrou)
				{
					$select.= "<option value=\"".$cpf."\">".$nome."</option>";
					$vetor_usuarios[] = array("cod_usuario" => $cod_usuario, "nome" => $nome, "cpf" => $cpf, "data_nasc" => $data_nasc, "inscrito" => true, "sapo" => false, "curso" => false);
				}
			}
			
			$select.= "</select>";
			$total_inscritos = count($vetor_usuarios);
		}
		else
			if ($acao_usuario == "sapo")
			{
			
			}
	
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO Administra&ccedil;&atilde;o</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script language="JavaScript" src="../../../funcoes/funcoes_usuario_pta.js"></script>

<script type="text/javascript">
	function voltar()
	{
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.tela_usuario_pta.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.tela_usuario_pta.action = "visualiza.php";
		<?
		   }
		?>
		document.tela_usuario_pta.submit();
	}
</script>

<body topmargin="0" leftmargin="0">
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
                <td height="42" bgcolor="#D5FFD5" width="100%" align="right">
				  <table cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: importarUsuario('inscritos');" style="cursor: pointer" class="link_verde">Importar Inscritos</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: importarUsuario('sapo');" style="cursor: pointer" class="link_verde">Importar Usuário</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: novoUsuario();" style="cursor: pointer" class="link_verde">Novo Usuário</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'informativo.php';" style="cursor: pointer" class="link_verde">Informativo</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: voltar();" style="cursor: pointer" class="link_verde">Voltar</a>&nbsp;</td>
					</tr>
				  </table>
				</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				<form name="tela_usuario_pta" method="post" action="controle.php">
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				    <tr>
					  <td height="10"><input type="hidden" name="codigo_curso_inscrito" value="<?php echo $cod_curso_inscricao; ?>"><input type="hidden" name="codigos_usuarios" value=""><input type="hidden" name="acao_usuario" value=""><input type="hidden" name="acao_voltar" value="index"><input type="hidden" name="modulo" value=""><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"></td>
					</tr>
				  <?php
				  	if ($total_turmas > 0)
					{
						if (($total_inscritos > 0) or ($acao_usuario == "sapo"))
						{
							if ($acao_usuario == "inscritos")
							{
				  ?>
					<tr>
					  <td>
						  <table width="100%" cellpadding="0" cellspacing="0">
						    <tr>
							  <td colspan="3" align="center">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
								    <td width="80" class="verde" align="right">Turma:</td>
									<td width="10"></td>
									<td align="left"><?php echo $select_turmas; ?></td>
								  </tr>
								  <tr>
								    <td colspan="3" height="10"></td>
								  </tr>
								  <tr>
								    <td width="80" class="verde" align="right">Acesso:</td>
									<td width="10"></td>
									<td align="left"><select name="tipo_acesso">
									  <option value="L" <?php if ($acesso_usuario == "L") echo "selected"; ?>>Aluno</option>
									  <option value="T" <?php if ($acesso_usuario == "T") echo "selected"; ?>>Tutor</option>
									  <option value="S" <?php if ($acesso_usuario == "S") echo "selected"; ?>>Suporte Técnico</option>
									  <option value="P" <?php if ($acesso_usuario == "P") echo "selected"; ?>>Supervisor do Sistema</option>
									</select></td>
								  </tr>
								</table>
							  </td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
						    <tr>
							  <td class="verde" align="center">Importar Inscritos</td>
							  <td></td>
							  <td class="verde" align="center">Exportar para o SA²pO</td>
						    </tr>
						    <tr>
							  <td colspan="3" height="10"></td>
						    </tr>
						    <tr>
							  <td valign="top" width="48%">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
								    <td class="verde" align="center"><input type="checkbox" name="todosImportar" onClick="JavaScript: selecionaSelectMultiplo(document.tela_usuario_pta.usuariosImportar, this.checked);">&nbsp;Marcar/Desmarcar Todos</td>
								  </tr>
								  <tr>
								    <td height="10"></td>
								  </tr>
								  <tr>
								    <td align="center"><?php echo $select; ?></td>
								  </tr>
								  <tr>
								    <td height="10"></td>
								  </tr>
								  <tr>
								    <td align="center"><input type="button" onClick="JavaScript: primeiroSegundo('usuariosImportar', 'usuariosExportar', 'tela_usuario_pta'); document.tela_usuario_pta.todosImportar.checked = false;" value=" >> "></td>
								  </tr>
							    </table>
							  </td>
							  <td width="2%"></td>
							  <td width="48%">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
								    <td class="verde" align="center"><input type="checkbox" name="todosExportar" onClick="JavaScript: selecionaSelectMultiplo(document.tela_usuario_pta.usuariosExportar, this.checked);">&nbsp;Marcar/Desmarcar Todos</td>
								  </tr>
								  <tr>
								    <td height="10"></td>
								  </tr>
								  <tr>
								    <td align="center"><select multiple name="usuariosExportar" size="8"></select></td>
								  </tr>
								  <tr>
								    <td height="10"></td>
								  </tr>
								  <tr>
								    <td align="center"><input type="button" onClick="segundoPrimeiro('usuariosExportar', 'usuariosImportar', 'tela_usuario_pta');  document.tela_usuario_pta.todosExportar.checked = false;" value=" << " ></td>
								  </tr>
							    </table>
							  </td>
						    </tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<tr>
							  <td colspan="3" class="verde_simples" align="center"><input type="checkbox" name="enviar_email">Enviar Email com Login e Senha</td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<tr>
							  <td colspan="3">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
								    <td align="center"><input type="button" name="envia" value="Exportar Usuários" onClick="JavaScript: selecionaSelectMultiplo(document.tela_usuario_pta.usuariosExportar, true); exportarUsuario('<?php echo $acao_usuario; ?>', document.tela_usuario_pta.usuariosExportar);"></td>
								  </tr>
								</table>
							  </td>
							</tr>
						</table>
					  </td>
				    </tr>
				  <?php
				  			}
							else
								if ($acao_usuario == "sapo")
								{
				  ?>
				    <tr>
					  <td>
						  <table width="100%" cellpadding="0" cellspacing="0">
						  	<tr>
							  <td colspan="3" align="left">
							    <table cellpadding="0" cellspacing="0">
								  <tr>
								    <td width="80" class="verde" align="right">Turma:</td>
									<td width="10"></td>
									<td align="left"><?php echo $select_turmas; ?></td>
								  </tr>
								  <tr>
								    <td colspan="3" height="10"></td>
								  </tr>
								  <tr>
								    <td width="80" class="verde" align="right">Acesso:</td>
									<td width="10"></td>
									<td align="left"><select name="tipo_acesso">
									  <option value="L" <?php if ($acesso_usuario == "L") echo "selected"; ?>>Aluno</option>
									  <option value="T" <?php if ($acesso_usuario == "T") echo "selected"; ?>>Tutor</option>
									  <option value="S" <?php if ($acesso_usuario == "S") echo "selected"; ?>>Suporte Técnico</option>
									  <option value="P" <?php if ($acesso_usuario == "P") echo "selected"; ?>>Supervisor do Sistema</option>
									</select></td>
								  </tr>
								</table>
							  </td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
						    <tr>
							  <td width="80" class="verde" align="right">Nome:</td>
							  <td width="10"></td>
							  <td align="left"><input type="text" name="nome_usuario" size="50"></td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<tr>
							  <td width="80" class="verde" align="right">CPF:</td>
							  <td width="10"></td>
							  <td align="left"><input type="text" name="cpf_usuario" maxlength="11"></td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>
							<tr>
							  <td width="80" class="verde" align="right">E-mail:</td>
							  <td width="10"></td>
							  <td align="left"><input type="text" name="email_usuario" size="50"></td>
							</tr>
						    <tr>
							  <td colspan="3" height="10"></td>
							</tr><?php /*
							<tr>
							  <td colspan="3" class="verde_simples" align="center"><input type="checkbox" name="enviar_email">Enviar Email com Login e Senha</td>
							</tr>
							<tr>
							  <td colspan="3" height="10"></td>
							</tr>*/?>
							<tr>
							  <td colspan="3" align="center"><input type="button" name="pesquisa" value="Pesquisar" onClick="JavaScript: importarUsuario('sapo');"></td>
							</tr>
				  <?php
								if (($_POST["nome_usuario"]) or ($_POST["cpf_usuario"]) or ($_POST["email_usuario"]))
								{
									$pesquisa_usuario = new usuario();
									
									if ($_POST["nome_usuario"])
										$pesquisa_usuario->pesquisaUsuarioNome($_POST["nome_usuario"]);
									else
										if ($_POST["cpf_usuario"])
											$pesquisa_usuario->pesquisaUsuarioCPF($_POST["cpf_usuario"]);
										else
											if ($_POST["cpf_usuario"])
												$pesquisa_usuario->pesquisaUsuarioEmail($_POST["email_usuario"]);
												
									$total = $pesquisa_usuario->linhas;						
									
									if ($total > 0)
									{
				  
				  ?>
							<tr>
							  <td colspan="3">
								<table width="100%" cellpadding="0" cellspacing="0">	
								  <tr>
								    <td colspan="4" class="verde">Resultados da Pesquisa</td>
								  </tr>
								  <tr>
								    <td colspan="4" height="10"></td>
								  </tr>
								  <tr> 
									<td width="30" align="center"><input type="checkbox" name="todos_usuario" onClick="JavaScript: marcaTodosUsuario('tela_usuario_pta');"></td>
									<td width="10">&nbsp;</td>
									<td colspan="2" class="preto">Marcar/Desmarcar Todos</td>
								  </tr>
								  <tr>
								    <td colspan="4" height="10"></td>
								  </tr>
								  <tr>
								    <td width="30"></td>
									<td width="10"></td>
									<td class="verde">Nome</td>
									<td width="120" class="verde">E-mail:</td>
								  </tr>
				  <?php		  
				  						$cor_fundo = "#99FF99";
										
										for ($i = 0; $i < $total; $i++)
										{
											$cod_usuario = $pesquisa_usuario->data["cod_usuario"];
											$usuario = new usuario();
											$usuario->carregar($cod_usuario);
											
											$nome_usuario = $usuario->getNome();
											$email_usuario = $usuario->getEmail();
											
											if ($cor_fundo == "#99FF99")
												$cor_fundo = "#D5FFD5";
											else
												$cor_fundo = "#99FF99";
											
				  ?>
				  				  <tr bgcolor="<?php echo $cor_fundo; ?>">
						            <td colspan="4" height="2"></td>
						 		  </tr>
								  <tr bgcolor="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
								    <td width="30" align="center"><input type="checkbox" name="<?php echo $cod_usuario; ?>" value="<?php echo $cod_usuario; ?>" onClick="JavaScript: atualizaCodigosUsuario();"></td>
								    <td width="10"></td>
								    <td align="left" class="verde"><?php echo $nome_usuario; ?></td>
									<td class="verde"><?php echo $email_usuario; ?></td>
								  </tr>
								  <tr bgcolor="<?php echo $cor_fundo; ?>">
						            <td colspan="4" height="2"></td>
						 		  </tr>
							
				  <?php
				  							$pesquisa_usuario->proximo();
				  						}
				  ?>
				                </table>
						      </td>
						    </tr>
							<tr>
							  <td colspan="3">
							    <table width="100%" cellpadding="0" cellspacing="0">
								  <tr>
								    <td align="center"><input type="button" name="envia" value="Exportar Usuários" onClick="JavaScript: exportarUsuarioSapo('<?php echo $acao_usuario; ?>');"></td>
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
							  <td colspan="3" height="10" class="verde_simples" align="center">Nenhum Usuário Encontrado.</td>
							</tr>
				   <?php
									}
								}
				   ?>
						</table>
					  </td>
				    </tr>
				  <?php
							}
						}
						else
						{
				  ?>
				    <tr>
					  <td class="verde_simples" align="center">Nenhum Inscrito Encontrado.</td>
					</tr>
				  <?php
				  		}
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
				</form>
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
<?php
	}
	else
	{
		header("Location: index.php");
		exit;
	}
}
else
{
	header("Location: index.php");
	exit;
}
?>