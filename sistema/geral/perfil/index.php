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
include("../../../classes/perfil.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "perfil";
	
//Dados Perfil -> Objeto Usuário
$usuario = new usuario();
$usuario->carregar($cod_usuario);

$nome = $usuario->getNome();
$data_nascimento = formataData($usuario->getDataNascimento(), "/");
$dia_nascimento = substr($data_nascimento, 0, 2);
$mes_nascimento = substr($data_nascimento, 3, 2);
$ano_nascimento = substr($data_nascimento, 6, 4);
$sexo = $usuario->getSexo();
$login = $usuario->getLogin();
$cpf = $usuario->getCPF();
$email = $usuario->getEmail();
//

//Dados Perfil -> Objeto Perfil
$perfil = new perfil();
$perfil->carregar($cod_usuario);

$cod_perfil = $perfil->getCodigo();

if ($cod_perfil != "")
{
	//Dados Pessoais
	$descricao = $perfil->getDescricaoPessoal();
	$interesse = $perfil->getInteresse();
	$foto = $perfil->getFoto();
	$miniatura= $perfil->getMiniatura();
	$cidade = $perfil->getCidade();
	$uf = $perfil->getUF();
	$uf = ufExtenso($uf);
	$site_pessoal = $perfil->getSitePessoal();
	$apelido = $perfil->getApelido();
	
	//Dados Profissionais
	$empresa = $perfil->getEmpresa();
	$cargo = $perfil->getCargo();
	$detalhes = $perfil->getDetalhes();
	$profissao = $perfil->getProfissao();
	$site_profissional = $perfil->getSiteProfissional();
	$diretorio = $_SESSION["dir_perfil_usuario"];
	
	if ($foto != _SEM_FOTO)
	{
		//Diretório dos Arquivos
		//Miniatura da Imagem
		if (($miniatura != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $miniatura)) and (file_exists($diretorio.$miniatura)))
		{
			$total_caracteres = strlen($miniatura);
							
			for($x = 0; $x < $total_caracteres; $x++)
				$miniatura_.= substituiCaracter($miniatura[$x], "link");
				
			$arquivo_ = "../../../arquivos/perfil/".$cod_usuario."/".$miniatura;
			$arquivo = "../../../arquivos/perfil/".$cod_usuario."/".$miniatura_;
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
			$foto_g = "../../../arquivos/perfil/".$cod_usuario."/".$foto;
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
		
}
else
{
	$arquivo = "../../../imagens/"._SEM_FOTO;
	$link = "";
}

$onLoad =  "onLoad=\"JavaScript: atualizaDiasdoMes('".$dia_nascimento."', '".$mes_nascimento."', '".$ano_nascimento."', 'perfil_dados_pessoais', 'dia'); defineLayer();";

if (isset($_SESSION["aba_perfil"]))
	$onLoad.= " alternarAbas('".$_SESSION["aba_perfil"]."');";

$onLoad.= "\"";
		
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
	vetorAbas[0] = new selecionarAba('dados_pessoais');
	vetorAbas[1] = new selecionarAba('dados_profissionais');
	vetorAbas[2] = new selecionarAba('dados_cadastrais');
	vetorAbas[3] = new selecionarAba('formulario_dados_pessoais');
	vetorAbas[4] = new selecionarAba('formulario_dados_profissionais');
	vetorAbas[5] = new selecionarAba('formulario_dados_cadastrais');
</script>

<body topmargin="0" leftmargin="0" <?php echo $onLoad; ?>>
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
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
		  <div id="dados_pessoais">
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
					  <td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
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
						  <td width="140" align="right" valign="top" class="preto">Imagem de Exibição:</td>
						  <td width="10">&nbsp;</td>
						  <td align="left"><a onClick="<?php echo $link; ?>" style="cursor: pointer"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Nome Completo:</td>
						  <td>&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if ($nome == "")
								echo "<i>Não informado</i>";
							else 
								echo $nome; 
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Sexo:</td>
						  <td>&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if ($sexo == "M") 
								echo "Masculino"; 
							else 
								if ($sexo == "F") 
									echo "Feminino"; 
								else 
									if ($sexo == "")
										echo "<i>Não informado</i>";
							else 
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Data de Nascimento:</td>
						  <td>&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if ($data_nascimento == "")
								echo "<i>Não informado</i>";
							else 
								echo $data_nascimento; 
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Cidade / Estado:</td>
						  <td >&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
						  	if (empty($cidade))
								echo "<i>Não Informado</i> / ";
							else
								echo $cidade." / ";
								
							if (empty($uf))
								echo "<i>Não Informado</i>";
							else
								echo $uf;
							?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto" valign="top">Descri&ccedil;&atilde;o Pessoal:</td>
						  <td>&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if (trim($descricao) == "")
								echo "<i>Não informado</i>";
							else
								echo nl2br(trim($descricao)); 
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto" valign="top">Interesses:</td>
						  <td>&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if (trim($interesse) == "")
								echo "<i>Não informado</i>";
							else
								echo nl2br(trim($interesse));
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Site Pessoal:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples">
						  <?php 
							if ($site_pessoal != "") 
								echo "<a href=\"".$site_pessoal."\" target=\"_blank\" class=\"link_verde\">".$site_pessoal."</a>";
							else
								echo "<i>Não informado</i>";
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Apelido no Chat:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples"><?php if (empty($apelido)) echo "<i>Não Informado</i>"; else echo $apelido; ?></td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td colspan="3" align="center">
						    <table border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
							    <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
							    <td bgcolor="#99FF99"><a onClick="JavaScript: alternarAbas('formulario_dados_pessoais');" onMouseOver="JavaScript: window.status = 'Editar Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar Dados Pessoais</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a></td>
							    <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
							  </tr>
						    </table>
						  </td>
						</tr>
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
	</div>
	<div id="dados_profissionais" style="display: none">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
				<td><img src="../../../imagens/icones/perfil/titulo_dados_profissionais.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantoL8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
		  <td height="42" bgcolor="#D5FFD5" width="100%">
		    <table align="right" cellpadding="0" cellspacing="0">
			  <tr>
			    <td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
			    <td class="preto">&nbsp;|&nbsp;</td>
			    <td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
			    <td class="preto">&nbsp;|&nbsp;</td>
			    <td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" background="../../../imagens/cantoL7.gif"></td>
		</tr>
		<tr>
		  <td width="10" background="../../../imagens/cantoL5.gif"></td>
		  <td colspan="2" bgcolor="#D5FFD5">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
			  <tr>
				<td width="100%" bgcolor="#D5FFD5"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="1" background="../../../imagens/traco2.gif"></td>
					</tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
			      <table width="100%" cellpadding="0" cellspacing="0">
				    <tr>
					  <td colspan="3" class="vermelho_simples" align="center">
					  <?php 
						if ($_SESSION["aba_perfil"] == "dados_profissionais") 
						{
							echo "Dados Atualizados com Sucesso!";
							unset($_SESSION["aba_perfil"]);
						}
					  ?>
					  </td>
				    </tr>
					<tr>
					  <td width="140" align="right" class="preto">Profiss&atilde;o:</td>
					  <td width="10">&nbsp;</td>
					  <td class="verde_simples">
					  <?php 
						if ($profissao == "") 
							echo "<i>Não informado</i>";
						else
							echo $profissao;
					  ?>
					  </td>
					</tr>
					<tr>
					  <td width="140" align="right" class="preto">Institui&ccedil;&atilde;o / Empresa:</td>
					  <td width="10">&nbsp;</td>
					  <td class="verde_simples">
					  <?php
						if ($empresa == "") 
							echo "<i>Não informado</i>";
						else
							echo $empresa; ?></td>
					</tr>
					<tr>
					  <td width="140" align="right" class="preto">Cargo / Fun&ccedil;&atilde;o:</td>
					  <td width="10">&nbsp;</td>
					  <td class="verde_simples">
					  <?php
						if ($cargo == "") 
							echo "<i>Não informado</i>";
						else
							echo $cargo;
					  ?>
					  </td>
					</tr>
					<tr>
					  <td width="140" align="right" class="preto">Site:</td>
					  <td width="10">&nbsp;</td>
					  <td class="verde_simples">
					  <?php 
						if ($site_profissional != "") 
							echo "<a href=\"".$site_profissional."\" target=\"_blank\" class=\"link_verde\">".$site_profissional."</a>"; 
						else
							echo "<i>Não Informado</i>";
					  ?>
					  </td>
					</tr>
					<tr>
					  <td width="140" align="right" class="preto" valign="top">Detalhes:</td>
					  <td width="10">&nbsp;</td>
					  <td class="verde_simples">
					  <?php
						if ($detalhes == "") 
							echo "<i>Não informado</i>";
						else
							echo $detalhes;
					  ?>
					  </td>
					</tr>
					<tr>
					  <td colspan="3" height="15"></td>
					</tr>
					<tr>
					  <td colspan="3" align="center">
					    <table border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
						    <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
							<td bgcolor="#99FF99"><a onClick="JavaScript: alternarAbas('formulario_dados_profissionais');" onMouseOver="JavaScript: window.status = 'Editar Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar Dados Profissionais</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a></td>
							<td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
					      </tr>
						</table>
					  </td>
					</tr>
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
	  </div>
	  <div id="dados_cadastrais" style="display: none">
	    <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
              <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
			    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="3" bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr>
                    <td><img src="../../../imagens/icones/perfil/titulo_dados_cadastrais.gif" width="250" height="52"></td>
                  </tr>
                </table>
			  </td>
              <td height="10" background="../../../imagens/cantoL8.gif" width="436" valign="top"></td>
              <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
            </tr>
            <tr>
              <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
              <td height="42" bgcolor="#D5FFD5" width="100%">
			    <table align="right" cellpadding="0" cellspacing="0">
				  <tr>
					<td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
					<td class="preto">&nbsp;|&nbsp;</td>
					<td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
					<td class="preto">&nbsp;|&nbsp;</td>
					<td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
				  </tr>
				</table>
			  </td>
              <td width="10" background="../../../imagens/cantoL7.gif"></td>
            </tr>
            <tr>
              <td width="10" background="../../../imagens/cantoL5.gif"></td>
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
                      <table width="100%" cellpadding="0" cellspacing="0">
					    <tr>
						  <td colspan="3" class="vermelho_simples" align="center">
						  <?php 
							if ($_SESSION["aba_perfil"] == "dados_cadastrais") 
							{
								echo "Dados Atualizados com Sucesso!";
								unset($_SESSION["aba_perfil"]);
							}
						  ?>
						  </td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Usuário / Login:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples"><?php echo $login; ?></td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Email:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples"><?php echo $email; ?></td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">CPF:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples"><?php echo $cpf; ?></td>
						</tr>
						<tr>
						  <td width="140" align="right" class="preto">Senha:</td>
						  <td width="10">&nbsp;</td>
						  <td class="verde_simples">Disponível apenas para Alteração mediante senha de acesso atual</td>
						</tr>
						<tr>
						  <td colspan="3" height="15"></td>
						</tr>
						<tr>
						  <td colspan="3" align="center">
						    <table border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
							    <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
							    <td bgcolor="#99FF99"><a onClick="JavaScript: alternarAbas('formulario_dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Editar Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Editar Dados Cadastrais</span><img src="../../../imagens/icones/geral/tipo1/editar.gif" width="30" height="30" border="0" align="middle"></a></td>
							    <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
							  </tr>
						    </table>
						  </td>
						</tr>
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
	  </div>
	  <?php
		$cod_usuario = $_SESSION["cod_usuario"];
		$perfil = new perfil();
		$perfil->carregar($cod_usuario);
		$cod_perfil = $perfil->getCodigo();
		
		if (!empty($cod_perfil))
		{			
			$usuario = new usuario();
			$usuario->dadosPessoaisPerfil($cod_usuario);
			
			$nome = $usuario->getNome();
			$data_nascimento = formataData($usuario->getDataNascimento(), "/");
			$dia_nascimento = substr($data_nascimento, 0, 2);
			$mes_nascimento = substr($data_nascimento, 3, 2);
			$ano_nascimento = substr($data_nascimento, 6, 4);
			$sexo = $usuario->getSexo();
			
			$perfil->carregarDadosPessoais($cod_perfil); 
			$descricao = $perfil->getDescricaoPessoal();
			$interesse = $perfil->getInteresse();
			$foto = $perfil->getFoto();
			$miniatura = $perfil->getMiniatura();
			$cidade = $perfil->getCidade();
			$uf = $perfil->getUF();	
			$site_pessoal = $perfil->getSitePessoal();
		}
	  ?>
	  <div id="formulario_dados_pessoais" style="display: none">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<form name="perfil_dados_pessoais" action="controle.php" method="post" enctype="multipart/form-data">
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
					  <td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
					  <td class="preto">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
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
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr> 
							<td width="140" align="right" valign="top" class="preto">Imagem de Exibição:</td>
							<td width="5"><input type="hidden" name="imagemAtualPerfil" value="<?php echo $foto; ?>"><input type="hidden" name="imagemMiniaturaAtualPerfil" value="<?php echo $miniatura; ?>"></td>
							<td align="left"><a onClick="<?php echo $link; ?>" style="cursor: pointer"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right"><input type="radio" name="semImagemPerfil" <?php if ($semImagem == "true") echo "checked"; ?> value="true" tabindex="1"></td>
							<td width="10">&nbsp;</td>
							<td align="left" class="verde_simples">Sem Imagem de Exibição</td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Alterar Imagem:</td>
							<td width="10">&nbsp;</td>
							<td align="left"><input type="file" name="imagemNovaPerfil" value="<?php echo $imagem_nova; ?>" tabindex="2"></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr>
							<td colspan="3" class="vermelho_simples" align="center">Atenção! Ao inserir foto no perfil verifique a extensão do Arquivo. Extensões permitidas: JPG, JPEG, PNG.</td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td colspan="3"><input type="hidden" name="miniaturaPerfil" value="<?php echo $miniatura; ?>"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Nome Completo:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples"><input type="text" name="nomePerfil" value="<?php echo $nome; ?>" size="40" maxlength="80" tabindex="3"></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Sexo:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples">
							  <select name="sexoPerfil" tabindex="4">
								 <option value="M" <?php if ($sexo == "M") echo "selected"?>>Masculino</option>
								 <option value="F" <?php if ($sexo == "F") echo "selected"?>>Feminino</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Data de Nascimento:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples">
							<select name="dia"></select> 
							  <select name="mes" onChange="JavaScript: atualizaDiasdoMes(document.perfil_dados_pessoais.dia.value, document.perfil_dados_pessoais.mes.value, document.perfil_dados_pessoais.ano.value, 'perfil_dados_pessoais', 'dia');">
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
							  <select name="ano" id="ano" onChange="JavaScript: atualizaDiasdoMes(document.perfil_dados_pessoais.dia.value, document.perfil_dados_pessoais.mes.value, document.perfil_dados_pessoais.ano.value, 'perfil_dados_pessoais', 'dia');" tabindex="7">
							<?php
								$ano_atual = date("Y");
								for ($i = ($ano_atual - 100); $i < $ano_atual + 1; $i++)
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
							<td width="140" align="right" class="preto">Cidade:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples"><input type="text" name="cidadePerfil" value="<?php echo $cidade; ?>" size="40" maxlength="80" tabindex="8"></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Estado:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples">
							  <select name="ufPerfil" tabindex="9">
								<option value="AC" <?php if ($uf == "AC") echo "selected"; ?>>Acre</option>
								<option value="AL" <?php if ($uf == "AL") echo "selected"; ?>>Alagoas</option>
								<option value="AM" <?php if ($uf == "AM") echo "selected"; ?>>Amazônia</option>
								<option value="AP" <?php if ($uf == "AP") echo "selected"; ?>>Amapá</option>
								<option value="BA" <?php if ($uf == "BA") echo "selected"; ?>>Bahia</option>
								<option value="CE" <?php if ($uf == "CE") echo "selected"; ?>>Ceará</option>
								<option value="DF" <?php if ($uf == "DF") echo "selected"; ?>>Distrito Federal</option>
								<option value="ES" <?php if ($uf == "ES") echo "selected"; ?>>Espírito Santo</option>
								<option value="GO" <?php if ($uf == "GO") echo "selected"; ?>>Goiás</option>
								<option value="MA" <?php if ($uf == "MA") echo "selected"; ?>>Maranhão</option>
								<option value="MG" <?php if ($uf == "MG") echo "selected"; ?>>Minas Gerais</option>
								<option value="MT" <?php if ($uf == "MT") echo "selected"; ?>>Mato Grosso</option>
								<option value="MS" <?php if ($uf == "MS") echo "selected"; ?>>Mato Grosso do Sul</option>;
								<option value="PA" <?php if ($uf == "PA") echo "selected"; ?>>Pará</option>
								<option value="PB" <?php if ($uf == "PB") echo "selected"; ?>>Paraíba</option>
								<option value="PE" <?php if ($uf == "PE") echo "selected"; ?>>Pernambuco</option>
								<option value="PR" <?php if ($uf == "PR") echo "selected"; ?>>Paraná</option>
								<option value="PI" <?php if ($uf == "PI") echo "selected"; ?>>Piauí</option>
								<option value="RJ" <?php if ($uf == "RJ") echo "selected"; ?>>Rio de Janeiro</option>
								<option value="RN" <?php if ($uf == "RN") echo "selected"; ?>>Rio Grande do Norte</option>
								<option value="RO" <?php if ($uf == "RO") echo "selected"; ?>>Rondônia</option>
								<option value="RR" <?php if ($uf == "RR") echo "selected"; ?>>Roraima</option>
								<option value="RS" <?php if ($uf == "RS") echo "selected"; ?>>Rio Grande do Sul</option>
								<option value="SC" <?php if ($uf == "SC") echo "selected"; ?>>Santa Catarina</option>
								<option value="SP" <?php if ($uf == "SP") echo "selected"; ?>>São Paulo</option>
								<option value="SE" <?php if ($uf == "SE") echo "selected"; ?>>Sergie</option>
								<option value="TO" <?php if ($uf == "TO") echo "selected"; ?>>Tocantins</option>
							  </select>
							</td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto" valign="top">Descri&ccedil;&atilde;o Pessoal:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples"><textarea name="descrPessoalPerfil" cols="40" rows="12" tabindex="10"><?php echo $descricao; ?></textarea></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto" valign="top">Interesses:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples"><textarea name="interessesPerfil" cols="40" rows="12" tabindex="11"><?php echo $interesse; ?></textarea></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Site Pessoal:</td>
							<td width="10">&nbsp;</td>
							<td class="verde_simples"><input type="text" name="sitePessoalPerfil" value="<?php echo $site_pessoal; ?>" size="40" maxlength="80" tabindex="12"></td>
						  </tr>
						  <tr>
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td width="140" align="right" class="preto">Apelido no Bate Papo:</td>
							<td width="10">&nbsp;</td>
							<td width="140" class="verde_simples"><input type="text" name="apelidoChat" value="<?php if ($_SESSION["aba_perfil"] == "formulario_dados_cadastrais") { echo $_SESSION["apelido"]; unset($_SESSION["apelido"]); } else echo $apelido; ?>" size="25" maxlength="12" tabindex="21"></td>
							<td width="10">&nbsp;</td>
							<td class="conteudoTexto">&nbsp;</td>
						  </tr>
						<tr> 
						  <td colspan="3" height="15"><input type="hidden" name="acao_perfil" value="dados_pessoais"></td>
						</tr>
					  </table>
					  <table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
						  <td bgcolor="#99FF99"><a onClick="JavaScript: document.perfil_dados_pessoais.submit();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
						  <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
					    </tr>
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
		</form>
      </table>	
	</div>
	<?php
		if (!empty($cod_perfil))
		{
			$perfil->carregarDadosProfissionais($cod_perfil);
			$site_prof = $perfil->getSiteProfissional();
			$empresa = $perfil->getEmpresa();
			$cargo = $perfil->getCargo();
			$detalhes = $perfil->getDetalhes();
			$profissao = $perfil->getProfissao();
		}
	?>
	<div id="formulario_dados_profissionais" style="display: none">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <form name="perfil_dados_profissionais" method="post" action="controle.php">
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
				<td><img src="../../../imagens/icones/perfil/titulo_dados_profissionais.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantoL8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
		</tr>
		<tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
		  <td height="42" bgcolor="#D5FFD5" width="100%">
		    <table align="right" cellpadding="0" cellspacing="0">
			  <tr>
				<td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
				<td class="preto">&nbsp;|&nbsp;</td>
				<td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
				<td class="preto">&nbsp;|&nbsp;</td>
				<td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" background="../../../imagens/cantoL7.gif"></td>
		</tr>
		<tr>
		  <td width="10" background="../../../imagens/cantoL5.gif"></td>
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
			      <table width="100%" border="0" cellpadding="0" cellspacing="0">
				   <tr> 
					<td width="140" align="right" class="preto">Profiss&atilde;o:</td>
					<td width="10">&nbsp;</td>
					<td class="verde_simples"><input type="text" name="profissaoPerfil" value="<?php echo $profissao; ?>" size="40" maxlength="80" tabindex="13"></td>
				  </tr>
				  <tr> 
					<td width="140" align="right" class="preto">Institui&ccedil;&atilde;o / Empresa:</td>
					<td width="10">&nbsp;</td>
					<td class="verde_simples"><input type="text" name="empresaPerfil" value="<?php echo $empresa; ?>" size="40" maxlength="80" tabindex="14"></td>
				  </tr>
				  <tr> 
					<td width="140" align="right" class="preto">Cargo / Fun&ccedil;&atilde;o:</td>
					<td width="10">&nbsp;</td>
					<td class="verde_simples"><input type="text" name="cargoPerifl" value="<?php echo $cargo; ?>" size="40" maxlength="80" tabindex="15"></td>
				  </tr>
				  <tr> 
					<td width="140" align="right" class="preto" valign="top">Site:</td>
					<td width="10">&nbsp;</td>
					<td class="verde_simples"><input type="text" name="siteProfissionalPerfil" value="<?php echo $site_prof; ?>" size="40" maxlength="80" tabindex="16"></td>
				  </tr>
				  <tr> 
					<td colspan="3" height="15"></td>
				  </tr>
				  <tr> 
					<td width="140" align="right" valign="top" class="preto">Detalhes:</td>
					<td width="10">&nbsp;</td>
					<td class="verde_simples"><textarea name="detalhesPerfil" cols="40" rows="12" tabindex="17"><?php echo $detalhes; ?></textarea></td>
				  </tr>
				  <tr> 
					<td colspan="3" height="15"><input type="hidden" name="acao_perfil" value="dados_profissionais"></td>
				  </tr>
				  </table> 
				  <table border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
					  <td bgcolor="#99FF99"><a onClick="JavaScript: document.perfil_dados_profissionais.submit();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
					  <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
					</tr>
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
		</form>
	  </table>
	</div>
	  <?php
	  	$usuario->dadosCadastraisPerfil($cod_usuario);
		$login = $usuario->getLogin();
		$email = $usuario->getEmail();
		$cpf = $usuario->getCPF();
	  ?>
	  <div id="formulario_dados_cadastrais" style="display: none">
	    <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <form name="perfil_dados_cadastrais" method="post" action="controle.php">
            <tr>
              <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
              <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
			    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="3" bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr>
                    <td><img src="../../../imagens/icones/perfil/titulo_dados_cadastrais.gif" width="250" height="52"></td>
                  </tr>
                </table>
			  </td>
              <td height="10" background="../../../imagens/cantoL8.gif" width="436" valign="top"></td>
              <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
            </tr>
            <tr>
              <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
              <td height="42" bgcolor="#D5FFD5" width="100%">
			    <table align="right" cellpadding="0" cellspacing="0">
				  <tr>
					<td><a onClick="JavaScript: alternarAbas('dados_pessoais');" onMouseOver="JavaScript: window.status = 'Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Pessoais" style="cursor:pointer" class="link_verde">Dados Pessoais</a></td>
					<td class="preto">&nbsp;|&nbsp;</td>
					<td><a onClick="JavaScript: alternarAbas('dados_profissionais');" onMouseOver="JavaScript: window.status = 'Dados Profissionais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Profissionais" style="cursor:pointer" class="link_verde">Dados Profissionais</a></td>
					<td class="preto">&nbsp;|&nbsp;</td>
					<td><a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Dados Cadastrais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Dados Cadastrais" style="cursor:pointer" class="link_verde">Dados Cadastrais</a></td>
				  </tr>
				</table>
			  </td>
              <td width="10" background="../../../imagens/cantoL7.gif"></td>
            </tr>
            <tr>
              <td width="10" background="../../../imagens/cantoL5.gif"></td>
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
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr> 
						<td width="140" align="right" class="preto">Usuário / Login:</td>
						<td width="10">&nbsp;</td>
						<td width="140" class="verde_simples"><input type="text" name="loginPerfil" value="<?php echo $login; ?>" readonly="true" size="25" maxlength="30" tabindex="18"></td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples">O Login não pode ser modificado</td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">Email:</td>
						<td width="10">&nbsp;</td>
						<td width="140" class="verde_simples"><input type="text" name="emailPerfil" value="<?php if ($_SESSION["aba_perfil"] == "formulario_dados_cadastrais") { echo $_SESSION["email"]; unset($_SESSION["email"]); } else echo $email; ?>" size="25" maxlength="50" tabindex="19"></td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples"><?php if ($_SESSION["erro_email"] == 1) echo "Email Inválido! Favor verificar o Email informado."; ?></td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">CPF:</td>
						<td width="10">&nbsp;</td>
						<td width="140" class="verde_simples"><input type="text" name="cpfPerfil" value="<?php if ($_SESSION["aba_perfil"] == "formulario_dados_cadastrais") { echo $_SESSION["cpf"]; unset($_SESSION["cpf"]); } else echo $cpf; ?>" size="25" maxlength="11" tabindex="20"></td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples"><?php if ($_SESSION["erro_cpf"] == 1) echo "CPF Inválido! Favor verificar o CPF informado."; ?></td>
					  </tr>
					  <tr>
						<td colspan="5">&nbsp;</td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">Altera&ccedil;&atilde;o de Senha</td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples" colspan="3">&nbsp;</td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">Senha Atual:</td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples" colspan="3"><input type="password" name="senhaInformada" size="20" maxlength="15" tabindex="21"><?php if (isset($_SESSION["erro_senha_atual"])) { echo "&nbsp;&nbsp;Senha Atual Incorreta!"; unset($_SESSION["erro_senha_atual"]); }?></td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">Nova Senha:</td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples" colspan="3"><input type="password" name="senhaNova" size="20" maxlength="15"  tabindex="22"><?php if (isset($_SESSION["erro_senha_nova"])) { echo "&nbsp;&nbsp;Nova Senha e Cofirmação de Senha não conferem."; unset($_SESSION["erro_senha_nova"]); } ?></td>
					  </tr>
					  <tr> 
						<td width="140" align="right" class="preto">Confirmar Senha:</td>
						<td width="10">&nbsp;</td>
						<td class="verde_simples" colspan="3"><input type="password" name="confirmaSenha" size="20" maxlength="15" tabindex="23"></td>
					  </tr>
					  <tr>
					    <td colspan="3" height="15"><input type="hidden" name="acao_perfil" value="dados_cadastrais"></td>
					  </tr>
					  </table>
					  <table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
						  <td bgcolor="#99FF99"><a onClick="JavaScript: document.perfil_dados_cadastrais.submit();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: alternarAbas('dados_cadastrais');" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
						  <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
						</tr>
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
			</form>
          </table>
	  </div>
	</td>
  </tr>
</table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>