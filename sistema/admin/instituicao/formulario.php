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
include("../../../classes/instituicao.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$modulo = "instituicao";
$cod_inst = $_SESSION["cod_instituicao"];

$acao_instituicao = $_POST["acao_instituicao"];

switch ($acao_instituicao)
{
	case "editar":
		$instituicao = new instituicao();
		$instituicao->carregar($cod_inst);
		$nome = $instituicao->getNome();
		$descricao = $instituicao->getDescricao();
		$cidade = $instituicao->getCidade();
		$endereco = $instituicao->getEndereco();
		$cep = $instituicao->getCEP();
		$telefone = $instituicao->getTelefone();
		$email = $instituicao->getEmail();
		$site = $instituicao->getSite();
		$uf_sigla = $instituicao->getUF();
		$uf = ufExtenso($uf_sigla);
		$imagem = $instituicao->getImagem();
		
		$diretorio = $_SESSION["dir_imagens_instituicao"];
	break;
}

if ($imagem != _SEM_FOTO)
{
	if (($imagem != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $imagem)) and (file_exists($diretorio.$imagem)))
		$arquivo = "../../../arquivos/".$_SESSION["cod_instituicao"]."/imagens/".$imagem;
	else
		$arquivo = "../../../imagens/"._SEM_FOTO;
}
else
	$arquivo = "../../../imagens/"._SEM_FOTO;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO - Perfil</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	var vetorAbas = new Array();
	vetorAbas[0] = new selecionarAba('dados_instituicao');
	vetorAbas[3] = new selecionarAba( 'formulario_instituicao');
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
                <td valign="top"><?php if ($acao_instituicao != "novo") { ?><iframe width="100%" height="110" frameborder="0" scrolling="no" src="../../geral/calendario.php"></iframe><?php } ?></td>
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
					    <table width="95%" align="center" cellpadding="0" cellspacing="0">
						  <form name="instituicao" method="post" action="controle.php">
						  <tr>
							<td colspan="3" class="vermelho_simples" align="center"></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr>
						    <td width="140" align="right" valign="top" class="preto">Imagem de Exibição:</td>
						    <td width="10">&nbsp;</td>
						    <td align="left"><a onClick="<?php echo $link; ?>" style="cursor: pointer"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
						  </tr>
						  <tr>
						    <td colspan="3" height="10"></td>
						  </tr>
						  <tr>
						    <td width="140" align="right" valign="top" class="preto">Alterar Imagem:</td>
						    <td width="10">&nbsp;</td>
						    <td align="left"><input type="file" name="imagem_nova_instituicao" value="" tabindex="1"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"><input type="hidden" name="imagem_atual_insituicao" value="<?php echo $imagem; ?>"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Nome:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="nome" size="60" maxlength="80" value="<?php echo $nome; ?>" tabindex="2"></td>
						  </tr>
						  <tr>
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right" valign="top">Descri&ccedil;&atilde;o:</td>
						    <td width="10">&nbsp;</td>
						    <td><textarea cols="50" rows="10" name="descricao" tabindex="3"><?php echo nl2br($descricao); ?></textarea></td>
						  </tr>
						  <tr>
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Email:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="email" size="40" maxlength="80" value="<?php echo $email; ?>" tabindex="4"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Site:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="site" size="40" maxlength="80" value="<?php echo $site; ?>" tabindex="5"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Telefone:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="telefone" size="40" maxlength="80" value="<?php echo $telefone; ?>" tabindex="6"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Endere&ccedil;o:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="endereco" size="60" maxlength="80" value="<?php echo $endereco; ?>" tabindex="7"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">CEP:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="cep" size="12" maxlength="9" value="<?php echo $cep; ?>" tabindex="8"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Cidade:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="cidade" size="40" maxlength="80" value="<?php echo $cidade; ?>" tabindex="9"></td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">Estado:</td>
						    <td width="10">&nbsp;</td>
						    <td>
							<select name="uf" tabindex="10">
							  <option value="" selected>Estado</option>
							  <option value="AC" <?php if ($uf_sigla == "AC" ) echo "selected"; ?>>Acre</option>
							  <option value="AL" <?php if ($uf_sigla == "AL" ) echo "selected"; ?>>Alagoas</option>
							  <option value="AM" <?php if ($uf_sigla == "AM" ) echo "selected"; ?>>Amapá</option>
							  <option value="AP" <?php if ($uf_sigla == "AP" ) echo "selected"; ?>>AP</option>
							  <option value="BA" <?php if ($uf_sigla == "BA" ) echo "selected"; ?>>Bahia</option>
							  <option value="CE" <?php if ($uf_sigla == "CE" ) echo "selected"; ?>>Ceará</option>
							  <option value="DF" <?php if ($uf_sigla == "DF" ) echo "selected"; ?>>Distrito Federal</option> 
							  <option value="ES" <?php if ($uf_sigla == "ES" ) echo "selected"; ?>>Espírito Santo</option>
							  <option value="GO" <?php if ($uf_sigla == "GO" ) echo "selected"; ?>>Goiás</option>
							  <option value="MA" <?php if ($uf_sigla == "MA" ) echo "selected"; ?>>Maramnhão</option>
							  <option value="MG" <?php if ($uf_sigla == "MG" ) echo "selected"; ?>>Minas Gerais</option>
							  <option value="MT" <?php if ($uf_sigla == "MT" ) echo "selected"; ?>>Mato Grosso</option>
							  <option value="MS" <?php if ($uf_sigla == "MS" ) echo "selected"; ?>>Mato Grosso do Sul</option>
							  <option value="PA" <?php if ($uf_sigla == "PA" ) echo "selected"; ?>>Pará</option>
							  <option value="PB" <?php if ($uf_sigla == "PB" ) echo "selected"; ?>>Paraíba</option>
							  <option value="PE" <?php if ($uf_sigla == "PE" ) echo "selected"; ?>>Pernambuco</option>
							  <option value="PI" <?php if ($uf_sigla == "PI" ) echo "selected"; ?>>Piauí</option>
							  <option value="PR" <?php if ($uf_sigla == "PR" ) echo "selected"; ?>>Paraná</option>
							  <option value="RJ" <?php if ($uf_sigla == "RJ" ) echo "selected"; ?>>Rio de Janeiro</option>
							  <option value="RN" <?php if ($uf_sigla == "RN" ) echo "selected"; ?>>Rio Grande do Norte</option>
							  <option value="RO" <?php if ($uf_sigla == "RO" ) echo "selected"; ?>>Rondônia</option>
							  <option value="RR" <?php if ($uf_sigla == "RR" ) echo "selected"; ?>>Roraima</option>
							  <option value="RS" <?php if ($uf_sigla == "RS" ) echo "selected"; ?>>Rio Grande do Sul</option>
							  <option value="SC" <?php if ($uf_sigla == "SC" ) echo "selected"; ?>>Santa Catarina</option>
							  <option value="SE" <?php if ($uf_sigla == "SE" ) echo "selected"; ?>>Sergipe</option>
							  <option value="SP" <?php if ($uf_sigla == "SP" ) echo "selected"; ?>>São Paulo</option>
							  <option value="TO" <?php if ($uf_sigla == "TO" ) echo "selected"; ?>>Tocantins</option>
							</select>
						    </td>
						  </tr>
						  <tr> 
						    <td colspan="3"  height="10"></td>
						  </tr>
						  <tr> 
						    <td width="140" class="preto" align="right">País:</td>
						    <td width="10">&nbsp;</td>
						    <td><input type="text" name="pais" size="40" maxlength="80" value="<?php echo $pais; ?>" tabindex="11"></td>
						  </tr>
						  <tr> 
						    <td colspan="3" height="10"><input type="hidden" name="cod_instituicao" value="<?php echo $cod_inst; ?>"><input type="hidden" name="acao_instituicao" value="<?php echo $acao_instituicao; ?>"></td>
						  </tr>
						  <tr>
						    <td colspan="3" align="center">
						      <table border="0" align="center" cellpadding="0" cellspacing="0">
							    <tr>
							      <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
							      <td bgcolor="#99FF99"><a onClick="JavaScript: document.instituicao.submit();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: window.location.href = 'index.php'" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
							      <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
							    </tr>
						      </table>
						    </td>
						  </tr>
						  </form>
					    </table>
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