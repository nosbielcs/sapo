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

if ($_GET["curso_cod_turma"])
	$curso_cod_turma = $_GET["curso_cod_turma"];
else
	$curso_cod_turma = $_POST["curso_cod_turma"];

$curso_turma = new curso();
$curso_turma->colecaoTurmas($cod_curso);
$total_turmas = $curso_turma->linhas;

if ($total_turmas > 0)
{
	$select_turmas = "<select name=\"curso_cod_turma\" onChange=\"document.tela_usuario_pta.submit();\">";
	$select_turmas.= "<option value=\"\" selected>Selecione uma Turma</option>";
		
	for ($i = 0; $i < $total_turmas; $i++)
	{
		$cod_turma = $curso_turma->data["cod_turma"];
		$turma = new turma();
		$turma->carregar($cod_turma);
		$descricao_turma = $turma->getDescricao();
		
		if ($cod_turma == $curso_cod_turma)
			$select_turmas.= "<option value=\"".$cod_turma."\" selected>".$descricao_turma."</option>";
		else
			$select_turmas.= "<option value=\"".$cod_turma."\">".$descricao_turma."</option>";
		
		$curso_turma->proximo();
	}
	
	if ($total_turmas > 1)
	{
		if ($curso_cod_turma == "Q")
			$select_turmas.= "<option value=\"Q\" selected>Todas as Turmas</option>";
		else
			$select_turmas.= "<option value=\"Q\">Todas as Turmas</option>";
	}

	$select_turmas.= "</select>";
	
	if ($_GET["tipo_usuario"])
		$tipo_usuario = $_GET["tipo_usuario"];
	else
		if ($_POST["tipo_usuario"])
			$tipo_usuario = $_POST["tipo_usuario"];
		else
			$tipo_usuario = "Q";
	
	if ($_GET["acessou"])
		$acessou = $_GET["acessou"];
	else	
		if ($_POST["acessou"])
			$acessou = $_POST["acessou"];
		else
			$acessou = "";
			
	if ($_GET["situacao"])
		$situacao = $_GET["situacao"];
	else
		if ($_POST["situacao"])
			$situacao = $_POST["situacao"];
		else
			$situacao = "A";
	
	if ($_GET["qtd"])
		$limite = $_GET["qtd"];
	else
		if ($_POST["qtd_listagem"])
			$limite = $_POST["qtd_listagem"];
		else
			$limite = "T";
	
	if ($_GET["pag"])
		$pagina = $_GET["pag"];
	else
		if ($_POST["pagina"])
			$pagina = $_POST["pagina"];
		else
			$pagina = 1;
	
	if ($_GET["ordem"])
		$ordem = $_GET["ordem"];
	else
		if ($_POST["ordem"])
			$ordem = $_POST["ordem"];
		else
			$ordem = 1;
	
	$inicio = $pagina - 1;
	$inicio = $inicio * $limite;

	$url = "informativo.php?curso_cod_turma=".$curso_cod_turma."&tipo_usuario=".$tipo_usuario."&acessou=".$acessou."&situacao=".$situacao;
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
				<form name="tela_usuario_pta" method="post" action="informativo.php">
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				    <tr>
					  <td height="10">
					    <input type="hidden" name="codigos_usuarios" value="">
						<input type="hidden" name="acao_usuario" value="informativo">
						<input type="hidden" name="acao_voltar" value="index">
						<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
					   </td>
					</tr>
				    <tr>
					  <td>
						<table width="100%" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="120" class="verde" align="right">Turma:</td>
							<td width="10">&nbsp;</td>
							<td align="left"><?php echo $select_turmas; ?></td>
						  </tr>
						</table>
					<?php
					if (!empty($curso_cod_turma))
					{
						$cod_turma = $curso_cod_turma;
						$total_usuario = new usuario();
				  		$lista_usuarios_sapo = new usuario();
						
						if ($curso_cod_turma == "Q")
						{
							$lista_usuarios_sapo->paginacaoUsuarioCurso($cod_curso, $tipo_usuario, $acessou, $situacao, $limite, $inicio);
							$total_usuario->colecaoUsuarioCurso($cod_curso, $tipo_usuario, $acessou, $situacao);
						}
						else
						{
							$lista_usuarios_sapo->paginacaoUsuarioTurma($cod_turma, $tipo_usuario, $acessou, $situacao, $limite, $inicio);
							$total_usuario->colecaoUsuarioTurma($cod_turma, $tipo_usuario, $acessou, $situacao);
						}
							
						$total_usuarios_sapo = $lista_usuarios_sapo->linhas;
						$quantidade = $total_usuario->linhas;
						
						$vetor_usuarios_sapo = array();
						
						for ($i = 0; $i < $total_usuarios_sapo; $i++)
						{
							$cod_usuario = $lista_usuarios_sapo->data["cod_usuario"];
							$usuario_tipo_acesso = $lista_usuarios_sapo->data["acesso"];
							$usuario_cod_turma = $lista_usuarios_sapo->data["cod_turma"];
							$total_linhas_vetor = count($vetor_usuarios_sapo);
							$encontrou = false;
							
							for ($j = 0; $j < $total_linhas_vetor; $j++)
							{
								$cod_usuario_selecionado = $vetor_usuarios_sapo[$j]["cod_usuario"];
								
								if (($cod_usuario_selecionado == $cod_usuario) and (!$encontrou))
									$encontrou = true;
							}
							
							if (!$encontrou)
								$vetor_usuarios_sapo[] = array("cod_usuario" => $cod_usuario, "acesso" => $usuario_tipo_acesso, "cod_turma" => $usuario_cod_turma);
								
							$lista_usuarios_sapo->proximo();
						}
						
						$total_usuarios_sapo = count($vetor_usuarios_sapo);
						
				  		if ($total_usuarios_sapo > 0)
				  	?> 
						<table width="100%" cellpadding="0" cellspacing="0">
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr>
							<td width="120" class="verde" align="right">Usuário:</td>
							<td width="10"></td>
							<td>
							  <select name="tipo_usuario" id="tipoAcesso" onChange="JavaScript: document.tela_usuario_pta.submit();">
								<option value="L" <?php if ($tipo_usuario == "L") echo "selected"; ?>>Aluno</option>
								<option value="T" <?php if ($tipo_usuario == "T") echo "selected"; ?>>Tutor</option>
								<option value="S" <?php if ($tipo_usuario == "S") echo "selected"; ?>>Suporte Técnico</option>
								<option value="P" <?php if ($tipo_usuario == "P") echo "selected"; ?>>Supervisor do Sistema</option>
								<option value="Q" <?php if ($tipo_usuario == "Q") echo "selected"; ?>>Todos</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr>
							<td width="120" class="verde" align="right">Situação</td>
							<td width="10"></td>
							<td>
							  <select name="situacao" id="" onChange="JavaScript: document.tela_usuario_pta.submit();">
							    <option value="" selected></option>
								<option value="A" <?php if ($situacao == "A") echo "selected"; ?>>Ativo</option>
								<option value="I" <?php if ($situacao == "I") echo "selected"; ?>>Inativo</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr>
							<td width="120" class="verde" align="right">Acessou?</td>
							<td width="10"></td>
							<td>
							  <select name="acessou" id="" onChange="JavaScript: document.tela_usuario_pta.submit();">
							    <option value="" selected></option>
								<option value="S" <?php if ($acessou == "S") echo "selected"; ?>>Sim</option>
								<option value="N" <?php if ($acessou == "N") echo "selected"; ?>>Não</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr>
							<td width="120" class="verde" align="right">Tipo de Informativo:</td>
							<td width="10"></td>
							<td>
							  <select name="tipo_informativo" id="tipoAcesso">
								<option value="I">Início de Curso</option>
								<option value="F">Fim de Curso</option>
								<option value="U">Envio de Usuário e Senha</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						  <tr>
							<td width="120" class="verde" align="right">Listagem:</td>
							<td width="10"></td>
							<td>
							  <select name="qtd_listagem" onChange="JavaScript: document.tela_usuario_pta.submit();">
							    <option value="1" <?php if ($limite == 1) echo "selected"; ?>>5</option>
								<option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
								<option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
								<option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
								<option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
								<option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="10"></td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" cellpadding="0" cellspacing="0">	
						  <tr>
							<td colspan="6" class="verde">Listagem</td>
						  </tr>
						  <tr>
							<td colspan="6" height="10"></td>
						  </tr>
						  <tr> 
							<td width="30" align="center"><input type="checkbox" name="todos_usuario" onClick="JavaScript: marcaTodosUsuario('tela_usuario_pta');"></td>
							<td width="10">&nbsp;</td>
							<td colspan="4" class="preto">Marcar/Desmarcar Todos</td>
						  </tr>
						  <tr>
							<td colspan="6" height="10"></td>
						  </tr>
						  <tr>
							<td width="30"></td>
							<td width="10"></td>
							<td class="campos">Nome</td>
							<td width="120" class="campos">E-mail:</td>
						  <?php
						  	if ($tipo_usuario == "Q")
							{
						  ?>
							<td width="100" class="campos" align="center">Acesso</td>
						  <?php
						  	}
						  ?>
						    <td class="campos" align="center" width="60">Remover</td>
						  </tr>
						  <tr>
						    <td colspan="6" height="10"></td>
						  </tr>
				  		  <?php		 
						  			$cor_fundo = "#99FF99";
									 
									for ($i = 0; $i < $total_usuarios_sapo; $i++)
									{
										$cod_usuario = $vetor_usuarios_sapo[$i]["cod_usuario"];
										$usuario_tipo_acesso = $vetor_usuarios_sapo[$i]["acesso"];
										$usuario_cod_turma = $vetor_usuarios_sapo[$i]["cod_turma"];
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
						    <td colspan="6" height="2"></td>
						  </tr>
						  <tr bgcolor="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
							<td width="30" align="center"><input type="checkbox" name="<?php echo $cod_usuario; ?>" value="<?php echo $cod_usuario; ?>" onClick="JavaScript: atualizaCodigosUsuario();" id="<?php echo $cor_fundo; ?>"></td>
							<td width="10"></td>
							<td align="left" class="verde"><?php echo $nome_usuario; ?></td>
							<td class="verde"><?php echo $email_usuario; ?></td>
						  <?php
										if ($tipo_usuario == "Q")
										{
											if ($usuario_tipo_acesso != "")
											{
												if ($usuario_tipo_acesso == "L")
													$usuario_tipo_acesso = "Aluno ";
												else
													if ($usuario_tipo_acesso == "T")
														$usuario_tipo_acesso = "Tutor ";
													else
														if ($usuario_tipo_acesso == "S")
															$usuario_tipo_acesso = "Suporte Técnico ";
														else
															if ($usuario_tipo_acesso == "P")
																$usuario_tipo_acesso = "Supervisor do Sistema ";
											}
										}
						 
						  	if ($tipo_usuario == "Q")
							{
						  ?>
							<td width="80" class="verde" align="center"><?php echo $usuario_tipo_acesso; ?></td>
						  <?php
						  	}
						  ?>
							<td align="center"><a onClick="JavaScript: desvinculaUsuarioTurma(<?php echo $cod_usuario; ?>, <?php echo $usuario_cod_turma; ?>);" style="cursor: pointer" class="link_vermelho">X</a></td>
						  </tr>
						  <tr bgcolor="<?php echo $cor_fundo; ?>">
						    <td colspan="6" height="2"></td>
						  </tr>
				  		  <?php
				  						//$lista_usuarios_sapo->proximo();
				  					}
				  		  ?>
						  <tr>
						    <td colspan="6" height="10"></td>
						  </tr>
						  <tr> 
						    <td colspan="6">
						      <table width="100%" cellpadding="0" cellspacing="0">
							    <tr>
							      <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $quantidade, $url, true); ?></td>
								  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $i."/"; ?></font><font class="preto"><?php echo $quantidade; ?></font></td>
							    </tr>
							  </table>
						    </td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td align="center"><input type="button" name="envia" value="Enviar" onClick="JavaScript: exportarUsuarioSapo('informativo');"></td>
					</tr>
				  <?php
				  		}
					}
					else
					{
				  ?>
				  	<tr>
					  <td class="verde_simples" align="center">Nenhum Usuário Encontrado.</td>
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