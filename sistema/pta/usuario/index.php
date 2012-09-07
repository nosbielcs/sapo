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
include("../../../classes/usuario.php");
include("../../../funcoes/funcoes.php");

$modulo = "usuarios";
$nome_curso = $_SESSION["nome_curso"];
$cod_inst = $_SESSION["cod_instituicao"];
$cod_curso = $_SESSION["cod_curso"];

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

if ($_POST["qtd_listagem"])
{
	$limite = $_POST["qtd_listagem"];
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
{
	$ordem = $_GET["ordem"];
}
else
{
	$ordem = 1;
}

if ($_POST["tipo_usuario"])
	$tipo_usuario = $_POST["tipo_usuario"];
else
	if ($_GET["tipo_usuario"])
		$tipo_usuario = $_GET["tipo_usuario"];
	else
		$tipo_usuario = "I";
		
if ($_POST["acesso_curso"])
	$acesso_curso = $_POST["acesso_curso"];
else
	if ($_GET["acesso_curso"])
		$acesso_curso = $_GET["acesso_curso"];
	else
		$acesso_curso = "L";

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "index.php?ordem=".$ordem;
$link_inscritos = false;

$vetor_usuarios = array();

//Seleciona Inscritos da Base INSCRITOS
$conexao = mysql_connect("localhost", "inscricao", "F3!nScp3");
$db = mysql_select_db("inscricao", $conexao);
$sql = "SELECT cod_cur FROM cursos WHERE descricao = '".$nome_curso."'";
$resultado = mysql_query($sql, $conexao);
$linhas = mysql_num_rows($resultado);

if ($linhas > 0)
{
	$link_inscritos = true;
	$cod_curso_inscricao = mysql_result($resultado, 0, "cod_cur");
	
	$sql_inscritos = "SELECT cod_inscr, nome, cpf, data_nasc, email, sexo FROM inscritos WHERE cod_cur = ".$cod_curso_inscricao." AND pagamento = 'S' and situacao != 'D' ORDER BY nome";
	$resultado_inscritos = mysql_query($sql_inscritos, $conexao);
	$inscritos = mysql_fetch_array($resultado_inscritos);
	$total_usuarios = mysql_num_rows($resultado_inscritos);
	mysql_close($conexao);
		
	for ($i = 0; $i < $total_usuarios; $i++)
	{
		mysql_data_seek($resultado_inscritos, $i);
		$linha = mysql_fetch_assoc($resultado_inscritos);
		$cod_usuario = $linha["cod_inscr"];
		$nome = $linha["nome"];
		$cpf = $linha["cpf"];
		$data_nasc = $linha["data_nasc"];
		$email = $linha["email"];
		
		$acesso = "";
		
		$vetor_usuarios[] = array("codigo_curso" => $cod_curso_inscricao, "cod_usuario" => $cod_usuario, "nome" => $nome, "cpf" => $cpf, "data_nasc" => $data_nasc, "inscrito" => true, "sapo" => false, "curso" => false, "acesso" => $acesso);
	}
	
	$total_usuarios = count($vetor_usuarios);
}
else
	$tipo_usuario = "U";

$acessou = "";
$lista_usuarios_sapo = new usuario();
$lista_usuarios_sapo->colecaoUsuarioCurso($cod_curso, $acesso_curso, $acessou);
$total_usuarios_sapo = $lista_usuarios_sapo->linhas;

$curso_turmas = new curso();
$curso_turmas->colecaoTurmas($cod_curso);
$total_turmas = $curso_turmas->linhas;

for ($i = 0; $i < $total_usuarios_sapo; $i++)
{
	$cpf_usuario_sapo = $lista_usuarios_sapo->data["cpf"];
	$cod_usuario_sapo = $lista_usuarios_sapo->data["cod_usuario"];
	$nome = $lista_usuarios_sapo->data["nome"];
	$encontrou = false;
	
	$total_usuarios = count($vetor_usuarios);
	
	for ($j = 0; $j < $total_usuarios; $j++)
	{
		$cpf = $vetor_usuarios[$j]["cpf"];
		$acesso = "";
				
		if (($cpf == $cpf_usuario_sapo) and (!$encontrou))
		{
			for ($x = 0; $x < $total_turmas; $x++)
			{
				$cod_turma = $curso_turmas->data["cod_turma"];
				
				$usuario_turma = new usuario();
				$usuario_turma->verificaAcessoTurma($cod_usuario_sapo, $cod_turma);
				
				$acesso.= $usuario_turma->data["acesso"].";";
				
				$curso_turmas->proximo();
			}
			
			$curso_turmas->primeiro();
			
			$vetor_usuarios[$j]["cod_usuario"] = $cod_usuario_sapo;
			$vetor_usuarios[$j]["sapo"] = true;
			$vetor_usuarios[$j]["curso"] = true;
			$vetor_usuarios[$j]["acesso"] = $acesso;
			$encontrou = true;
		}
	}

	if (!$encontrou)
	{
		for ($x = 0; $x < $total_turmas; $x++)
		{
			$cod_turma = $curso_turmas->data["cod_turma"];
			
			$usuario_turma = new usuario();
			$usuario_turma->verificaAcessoTurma($cod_usuario_sapo, $cod_turma);
			
			$acesso.= $usuario_turma->data["acesso"].";";
			
			$curso_turmas->proximo();
		}
			
		$curso_turmas->primeiro();

		$vetor_usuarios[] = array("cod_usuario" => $cod_usuario_sapo, "nome" => $nome, "cpf" => "", "data_nasc" => "", "inscrito" => false, "sapo" => true, "curso" => true, "acesso" => $acesso);
	}

	$lista_usuarios_sapo->proximo();
}

$total_usuarios = count($vetor_usuarios);
//
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
					  <?php
					  	if ($link_inscritos)
						{
					  ?>
					  <td><a onClick="JavaScript: importarUsuario('inscritos');" style="cursor: pointer" class="link_verde">Importar Inscritos</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <?php
					  	}
					  ?>
					  <td class="preto"><a onClick="JavaScript: importarUsuario('sapo');" style="cursor: pointer" class="link_verde">Importar Usuário</a></td>
					  <td>&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: novoUsuario();" style="cursor: pointer" class="link_verde">Novo Usuário</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'informativo.php';" style="cursor: pointer" class="link_verde">Informativo</a></td>
					</tr>
				  </table>
				</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
				    <?php
						if (isset($_SESSION["mensagem_usuario_pta"]))
						{
					?>
				    <tr>
					  <td class="vermelho_simples" align="center"><?php echo $_SESSION["mensagem_usuario_pta"]; ?></td>
					</tr>
					<?php
							unset($_SESSION["mensagem_usuario_pta"]);
						}
					?>
					<tr>
					  <td align="right">
					  <form name="paginacao_usuario" action="<?php echo $url_ordenacao; ?>" method="post">
					  <table cellpadding="0" cellspacing="0">
						<tr>
						  <td class="campos" align="right">Listagem</td>
						  <td width="10"></td>
						  <td width="50">
							<select name="qtd_listagem" id="qtdListagem" onChange="JavaScript: paginacaoUsuariosCurso('<?php echo $url_ordenacao; ?>', 'paginacao_usuario');">
							  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
							  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
							  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
							  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
							  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
							</select>
						  </td>
						  <td width="10"></td>
						  <?php
					  		if ($link_inscritos)
							{
					      ?>
						  <td class="campos">Usuário:</td>
						  <td width="10"></td>
						  <td>
						    <select name="tipo_usuario" id="tipoUsuario" onChange="JavaScript: paginacaoUsuariosCurso('<?php echo $url_ordenacao; ?>', 'paginacao_usuario');">
							  <option value="I" <?php if ($tipo_usuario == "I") echo "selected"; ?>>Inscritos</option>
							  <option value="U" <?php if ($tipo_usuario == "U") echo "selected"; ?>>Usuários</option>
							  <option value="T" <?php if ($tipo_usuario == "T") echo "selected"; ?>>Todos</option>
							</select>
						  </td>
						  <?php
						  	}
							
						  	if (($tipo_usuario == "U") or (!$link_inscritos))
							{
						  ?>
						  <td width="10"></td>
						  <td class="campos">Acesso:</td>
						  <td width="10"></td>
						  <td>
						    <select name="acesso_curso" id="tipoAcesso" onChange="JavaScript: paginacaoUsuariosCurso('<?php echo $url_ordenacao; ?>', 'paginacao_usuario');">
							  <option value="L" <?php if ($acesso_curso == "L") echo "selected"; ?>>Aluno</option>
							  <option value="T" <?php if ($acesso_curso == "T") echo "selected"; ?>>Tutor</option>
							  <option value="S" <?php if ($acesso_curso == "S") echo "selected"; ?>>Suporte Técnico</option>
							  <option value="P" <?php if ($acesso_curso == "P") echo "selected"; ?>>Supervisor</option>
							  <option value="Q" <?php if ($acesso_curso == "Q") echo "selected"; ?>>Todos</option>
							</select>
						  </td>
						  <?php
						  	}
						  ?>
						</tr>
					  </table>
					  </form>
					  </td>
					</tr>
				  <?php
					if ($total_usuarios > 0)
					{
				  ?>
					<tr>
					  <td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<form name="tela_usuario_pta" method="post">
						  <?php /* 
						  <tr> 
							<td width="30" align="center"><input type="checkbox" name="todos_usuario" onClick="marcaTodosUsuario('tela_usuario_pta');"></td>
							<td width="10">&nbsp;</td>
							<td colspan="3" class="preto">Marcar/Desmarcar Todos</td>
						  </tr>
						  */ ?>
						  <tr> 
							<?php /* <td width="30" align="center">&nbsp;</td>
							<td width="10">&nbsp;</td> */ ?>
							<td class="verde" width="70%">Nome&nbsp;&nbsp;<?php 
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
						    <td align="center" width="5%" class="verde">Inscrito</td>
							<td align="center" width="5%" class="verde">SA²pO</td>
							<td align="center" width="5%" class="verde">Curso</td>
						  <?php
						  	if ($tipo_usuario == "U")
							{
						  ?>
						  	<td align="center" width="15%" class="verde">Acesso</td>
						  <?php
						  	}
						  ?>
						  </tr>
						  <tr> 
							<td colspan="5" height="10"></td>
						  </tr>
						  <?php
							$cor_fundo = "#99FF99";
							$total_usuarios = count($vetor_usuarios);
							$select = "<select name=\"usuariosImportar\" multiple size=\"8\">";
							$total = 0;
							
							for ($i = 0; $i < $total_usuarios; $i++)
							{
								$cod_usuario = $vetor_usuarios[$i]["cod_usuario"];
								$nome = $vetor_usuarios[$i]["nome"];
								$cpf = $vetor_usuarios[$i]["cpf"];
								$data_nasc = $vetor_usuarios[$i]["data_nasc"];
								$email = $vetor_usuarios[$i]["email"];
								$inscrito = $vetor_usuarios[$i]["inscrito"];
								$usuario_sapo = $vetor_usuarios[$i]["sapo"];
								$usuario_curso = $vetor_usuarios[$i]["curso"];
								
								$select.= "<option value=\"".$cod_usuario."\">".$nome."</option>";
															
								if ($inscrito)
								{
									$sistema_inscricao = "ok.gif";
									$pertence = "inscricao";
									$tipo_encontrado = "I";
								}
								else
									$sistema_inscricao = "erro.gif";
							
								if ($usuario_sapo)
								{
									$usuario_sapo = "ok.gif";
									$pertence = "sapo";
									$tipo_encontrado = "U";
								}
								else
									$usuario_sapo = "erro.gif";
									
								if ($usuario_curso)
								{
									$usuario_curso = "ok.gif";
									$pertence = "sapo";
									$tipo_encontrado = "U";
								}
								else
									$usuario_curso = "erro.gif";
									
								if ($cor_fundo == "#99FF99")
									$cor_fundo = "#D5FFD5";
								else
									$cor_fundo = "#99FF99";
								
								if (($tipo_usuario == $tipo_encontrado) or ($tipo_usuario == "T"))
								{
									$total++;
						  ?>
						  <tr bgcolor="<?php echo $cor_fundo; ?>">
						    <td colspan="5" height="2"></td>
						  </tr>
						  <tr bgcolor="<?php echo $cor_fundo; ?>"> 
							<?php /*<td align="center"> echo "<input type='checkbox' name='".$cod_usuario."' value='".$cod_usuario."' onClick=\"atualizaCodigosUsuario();\">";</td>
							<td>&nbsp;</td> */ ?>
							<td><a OnClick="JavaScript: visualizaUsuario(<?php echo $cod_usuario; ?>, '<?php echo $pertence; ?>')" style="cursor: pointer" class="link_verde"><?php echo $nome; ?></a></td>
							<td align="center"><img src="../../../imagens/outros/<?php echo $sistema_inscricao; ?>" border="0" width="12" height="12"></td>
							<td align="center"><img src="../../../imagens/outros/<?php echo $usuario_sapo; ?>" border="0" width="12" height="12"></td>
							<td align="center"><img src="../../../imagens/outros/<?php echo $usuario_curso; ?>" border="0" width="12" height="12"></td>
						  <?php
						  	if ($tipo_usuario == "U")
							{
								$acesso_usuario = explode(";", $vetor_usuarios[$i]["acesso"]);
								$total_acessos = count($acesso_usuario);
								
								for ($y = 0; $y < $total_acessos; $y++)
								{
									if ($acesso_usuario[$y] != "")
									{
										if ($acesso_usuario[$y] == "L")
											$acesso = "Aluno ";
										else
											if ($acesso_usuario[$y] == "T")
												$acesso = "Tutor ";
											else
												if ($acesso_usuario[$y] == "S")
													$acesso = "Suporte Técnico ";
												else
													if ($acesso_usuario[$y] == "P")
														$acesso = "Supervisor ";
									}
								}
						  ?>
						  	<td align="center" class="verde"><?php echo trim($acesso); ?></td>
						  <?php
						  	}
						  ?>
						  </tr>
						  <tr bgcolor="<?php echo $cor_fundo; ?>">
						    <td colspan="5" height="2"></td>
						  </tr>
						  <?php
						  		}
							}
							
							$select.= "</select>";
						  ?>
						  <tr> 
							<td colspan="5" height="10"></td>
						  </tr>
						  <tr> 
							<td colspan="5">
							  <table width="100%" align="center">
								<tr>
								  <td><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $quantidade, $url_ordenacao, true); ?></td>
								  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $total."/"; ?></font><font class="preto"><?php echo $total; ?></font></td>
								</tr>
							  </table>
							</td>
						  </tr>
						  <tr> 
							<td colspan="5" height="10"></td>
						  </tr>
						  <tr> 
							<td colspan="5"><input type="hidden" name="codigos_usuarios" value=""><input type="hidden" name="acao_usuario" value=""><input type="hidden" name="cod_usuario_pta" value=""><input type="hidden" name="acao_voltar" value="index"><input type="hidden" name="modulo" value=""><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"></td>
						  </tr>
						  <tr> 
							<td colspan="5"> 
							  <table width="100%" cellpadding="0" cellspacing="0">
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
					  <td class="verde_simples" align="center"><form name="tela_usuario_pta" method="post"><input type="hidden" name="acao_usuario" value="">Nenhum Usuário Encontrado.</form></td>
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