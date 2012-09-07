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
include("../../../classes/usuario.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$modulo = "usuarios";

if ($_POST["acao_usuario"])
{		
	$acao_usuario = $_POST["acao_usuario"];
	
	$acao_voltar = $_POST["acao_voltar"];
	
	if (empty($acao_voltar))
		$acao_voltar = "index";

	switch($acao_usuario)
	{
		case "novo":
			$titulo = "Novo Curso";
			$dia_nascimento = date("d");
			$mes_nascimento = date("m");
			$ano_nascimento = date("Y");
		break;
				
		case "editar":
			$cod_usuario_instituicao = $_POST["cod_usuario_instituicao"];
			
			if (!empty($cod_usuario))
			{
				$titulo = "Editar Usuário";
				$usuario_instituicao = new usuario();
				$usuario_instituicao->carregar($cod_usuario_instituicao);
				$nome_usuario_instituicao = $usuario_instituicao->getNome();
				$data_nascimento = $usuario_instituicao->getDataNascimento();
				$data_nascimento = formataData($data_nascimento, "/");
				$dia_nascimento = substr($data_nascimento, 0, 2);
				$mes_nascimento = substr($data_nascimento, 3, 2);
				$ano_nascimento = substr($data_nascimento, 6, 4);
				$login_usuario_instituicao = $usuario_instituicao->getLogin();
				$sexo_usuario_instituicao = $usuario_instituicao->getSexo();
				$situacao_usuario_instituicao = $usuario_instituicao->getSituacao();
				$cpf_usuario_instituicao = $usuario_instituicao->getCpf();
				$email_usuario_instituicao = $usuario_instituicao->getEmail();
			}
		break;
	}
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
<script language="JavaScript" src="../../../funcoes/funcoes_usuario.js"></script>

<script type="text/javascript">
	var vetorAbas = new Array();
	vetorAbas[0] = new selecionarAba('dados_instituicao');
	vetorAbas[3] = new selecionarAba( 'formulario_instituicao');
</script>

<script type="text/javascript">
	function voltar()
	{
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.tela_usuario_instituicao.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.tela_usuario_instituicao.action = "visualiza.php";
		<?
		   }
		?>
		document.tela_usuario_instituicao.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: atualizaDiasdoMes('<?php echo $dia_nascimento; ?>', '<?php echo $mes_nascimento; ?>', '<?php echo $ano_nascimento; ?>', 'tela_usuario_instituicao', 'dia_nascimento');">
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
                <td height="42" bgcolor="#D5FFD5" width="100%">
				  <table align="right" cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: window.location.href = 'index.php'" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="link_verde">Voltar</a></td>
					</tr>
				  </table>
				</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                    <tr>
                      <td width="100%" bgcolor="#D5FFD5">
					    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="1" background="../../../imagens/traco2.gif"></td>
                          </tr>
						  <tr>
						    <td height="10"></td>
						  </tr>
                        </table>
						<?php
						?>
						<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
						  <tr>	
							<td valign="top">
							<form name="tela_usuario_instituicao" action="controle.php" method="post">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr> 
								  <td colspan="3" align="left" class="verde"><?php echo $titulo; ?></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right">Nome:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left"><input type="text" name="nome_usuario_instituicao" size="45" maxlength="80" value="<?php echo $nome_usuario_instituicao; ?>" tabindex="1" onBlur="JavaScript: verificaInput('imagem_nome', this, 0);">&nbsp;&nbsp;<img id="imagem_nome" src="../../../imagens/outros/spacer.gif" border="0" height="12" width="12"></td>
								</tr>
								<tr>
								  <td colspan="3" height="15"></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right" valign="top">CPF:</td>
								  <td width="10">&nbsp;</td>
								  <td class="verde_simples" align="left"><input type="text" name="cpf_usuario_instituicao" maxlength="11" value="<?php echo $cpf_usuario_instituicao; ?>" tabindex="2" onKeyPress="JavaScript: return soNumeros(event);"  onBlur="JavaScript: verificaInput('imagem_cpf', this, 1);">&nbsp;&nbsp;<i>Somente Números</i>&nbsp;&nbsp;<img id="imagem_cpf" src="../../../imagens/outros/spacer.gif" border="0" height="12" width="12"></td>
								</tr>
								<tr>
								  <td colspan="3" height="15"></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right">Email:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left"><input type="text" name="email_usuario_instituicao" size="45" maxlength="80" value="<?php echo $email_usuario_instituicao; ?>" tabindex="3" onBlur="JavaScript: verificaInput('imagem_email', this, 2);">&nbsp;&nbsp;<img id="imagem_email" src="../../../imagens/outros/spacer.gif" border="0" height="12" width="12"></td>
								</tr>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right">Sexo:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left">
									<select name="sexo_usuario_instituicao" tabindex="4">
									  <option value="F" <?php if ($sexo_usuario_instituicao == "F") echo "selected"; ?>>Feminino</option>
									  <option value="M" <?php if ($sexo_usuario_instituicao == "M") echo "selected"; ?>>Masculino</option>
									</select>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right">Data de Nascimento:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left">
								    <select name="dia_nascimento" tabindex="5"></select> 
								    <select name="mes_nascimento" tabindex="6" onChange="JavaScript: atualizaDiasdoMes(document.tela_usuario_instituicao.dia_nascimento.value, document.tela_usuario_instituicao.mes_nascimento.value, document.tela_usuario_instituicao.ano_nascimento.value, 'tela_usuario_instituicao', 'dia_nascimento');">
									  <option value="1" <?php if ($mes_nascimento == "01") echo "selected"; ?>>Janeiro</option>
									  <option value="2" <?php if ($mes_nascimento == "02") echo "selected"; ?>>Fevereiro</option>
									  <option value="3" <?php if ($mes_nascimento == "03") echo "selected"; ?>>Mar&ccedil;o</option>
									  <option value="4" <?php if ($mes_nascimento == "04") echo "selected"; ?>>Abril</option>
									  <option value="5" <?php if ($mes_nascimento == "05") echo "selected"; ?>>Maio</option>
									  <option value="6" <?php if ($mes_nascimento == "06") echo "selected"; ?>>Junho</option>
									  <option value="7" <?php if ($mes_nascimento == "07") echo "selected"; ?>>Julho</option>
									  <option value="8" <?php if ($mes_nascimento == "08") echo "selected"; ?>>Agosto</option>
									  <option value="9" <?php if ($mes_nascimento == "09") echo "selected"; ?>>Setembro</option>
									  <option value="10" <?php if ($mes_nascimento == "10") echo "selected"; ?>>Outubro</option>
									  <option value="11" <?php if ($mes_nascimento == "11") echo "selected"; ?>>Novembro</option>
									  <option value="12" <?php if ($mes_nascimento == "12") echo "selected"; ?>>Dezembro</option>
								    </select>
								    <select name="ano_nascimento" tabindex="7" onChange="JavaScript: atualizaDiasdoMes(document.tela_usuario_instituicao.dia_nascimento.value, document.tela_usuario_instituicao.mes_nascimento.value, document.tela_usuario_instituicao.ano_nascimento.value, 'tela_usuario_instituicao', 'dia_nascimento');">
									  <?php
											$ano_usuario = date("Y");
											for ($i = ($ano_usuario - 90); $i < $ano_usuario + 1; $i++)
											{
												if ($ano_nascimento == $i)
													echo "<option value=\"$i\" selected>".$i."</option>";
												else
													echo "<option value=\"$i\">".$i."</option>";
											}
									  ?>
								    </select>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<tr> 
								  <td width="120" class="verde" align="right">Situação:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left">
									  <select name="usuario_instituicao_situacao" tabindex="9">
										<option value="A" <?php if ($situacao_usuario == "A") echo "selected"; ?>>Ativo</option>
										<option value="I" <?php if ($situacao_usuario == "I") echo "selected"; ?>>Inativo</option>
									  </select>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<?php
									if($acao_usuario == "novo")
									{
								?>
								<tr> 
								  <td width="120" class="verde" align="right">Login / Senha</td>
								  <td width="10">&nbsp;</td>
								  <td align="left">
									  <select name="usuario_instituicao_login_senha" onChange="JavaScript: usuarioLoginSenha(this.value, '<?php echo $login_usuario; ?>', '<?php echo $senha_usuario; ?>', 'login_senha_usuario');" tabindex="10" onBlur="JavaScript: verificaInput('imagem_login_senha', this, 3);">
										<option value="">Selecione uma Opção</option>
										<option value="cadastrar" <?php if ($opcao_login_senha == "cadastrar") echo "selected"; ?>>Cadastrar manualmente Login e Senha</option>
										<option value="cadastrar_login" <?php if ($opcao_login_senha == "cadastrar_login") echo "selected"; ?>>Cadastrar manualmente Login e gerar automaticamente a Senha</option>
									  </select>&nbsp;&nbsp;<img id="imagem_login_senha" src="../../../imagens/outros/spacer.gif" border="0" height="12" width="12">
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<tr>
								  <td colspan="3" id="login_senha_usuario"></td>
								</tr>
								<?php
									}
									else
										if ($acao_usuario == "editar")
										{
								?>
								<tr> 
								  <td width="120" class="verde" align="right">Senha</td>
								  <td width="10">&nbsp;</td>
								  <td align="left">
									  <select name="usuario_instituicao_login_senha" tabindex="9">
										<option value="">Selecione uma Opção</option>
										<option value="gerar_nova" <?php if ($opcao_login_senha == "gerar_nova") echo "selected"; ?>>Gerar e Enviar Senha</option>
										<option value="enviar_senha" <?php if ($opcao_login_senha == "enviar_senha") echo "selected"; ?>>Enviar Senha Atual</option>
									  </select>
									  <input type="hidden" name="login_usuario_instituicao" value="<?php echo $login_usuario_instituicao; ?>">
								  </td>
								</tr>
								<?php
										}
								?>
								<tr> 
								  <td colspan="3" height="15"></td>
								</tr>
								<tr>
								  <td colspan="2"><input type="hidden" name="acao_usuario" value="<?php echo $acao_usuario; ?>"><input type="hidden" name="cod_usuario_instituicao" value="<?php echo $cod_usuario_instituicao; ?>"></td>
								<td>
								  <table border="0" align="center" cellpadding="0" cellspacing="0">
						  			<tr>
						    		  <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
						    		  <td bgcolor="#99FF99"><a onClick="JavaScript: cadastrarUsuario();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
						    		  <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
						  		    </tr>
					    		  </table>
								</td>
								</tr>
								<tr>
								  <td colspan="3" height="15"></td>
								</tr>
							  </table>
							  </form>
							</td>
						  </tr>
						</table>
						<?php
						?>
						<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					      <tr>
					        <td height="10"></td>
					      </tr>
                          <tr>
                            <td background="../../../imagens/traco2.gif" height="1"></td>
                          </tr>
                       </table>
			         </td>
                   </tr>
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