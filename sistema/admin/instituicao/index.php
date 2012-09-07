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

include("../../../config/session.lib.admin.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/instituicao.php");
include("../../../funcoes/funcoes.php");

$modulo = "instituicao";
$cod_inst = $_SESSION["cod_instituicao"];

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
$uf = $instituicao->getUF();
$uf = ufExtenso($uf);
$imagem = $instituicao->getImagem();

$diretorio = $_SESSION["dir_imagens_instituicao"];

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
<title>SA&sup2;pO Administra&ccedil;&atilde;o - Institui&ccedil;&otilde;es</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes_instituicao.js"></script>

<body topmargin="0" leftmargin="0">
<form name="visualiza_instituicao" method="post">
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
                <td height="42" bgcolor="#D5FFD5" width="100%"></td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td colspan="3" class="vermelho_simples" align="center">
					  <?php 
						if (isset($_SESSION["mensagem_instituicao"]))
						{
							echo $_SESSION["mensagem_instituicao"];
							unset($_SESSION["mensagem_instituicao"]);
					  	}
					  ?>
					  </td>
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
					  <td width="80" class="campos" align="right">Nome:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $nome; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right" valign="top">Descrição:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo nl2br($descricao); ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">Site:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo "<a href=\"".$site."\" target=\"_blank\" class=\"link_verde\">".$site."</a>"; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">Email:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $email; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">Cidade:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $cidade; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">Estado:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $uf; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
				 	  <td width="80" class="campos" align="right">Endereço:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $endereco; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">CEP:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $cep; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"></td>
					</tr>
				    <tr>
					  <td width="80" class="campos" align="right">Telefone:</td>
					  <td width="10">&nbsp;</td>
					  <td colspan="3" class="verde_simples" align="left"><?php echo $telefone; ?></td>
				    </tr>
					<tr>
					  <td colspan="3" height="10"><input type="hidden" name="cod_instituicao" value="<?php echo $cod_inst; ?>"><input type="hidden" name="acao_instituicao" value=""></td>
					</tr>
					<tr>
					  <td colspan="3">
					    <table border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
							<td bgcolor="#99FF99"><a onClick="JavaScript: editarInstituicao(<?php echo $cod_inst; ?>);" onMouseOver="JavaScript: window.status = 'Editar Dados da Instituição';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar Dados da Instituição</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a></td>
							<td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
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
</form>
</body>
</html>