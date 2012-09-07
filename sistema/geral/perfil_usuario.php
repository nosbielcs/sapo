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

include("../../config/session.lib.php");		
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/curso.php");
include("../../classes/log.php");
include("../../classes/perfil.php");
include("../../classes/turma.php");
include("../../classes/usuario.php");
include("../../classes/usuario_online.php");
include("../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$tipo_acesso = $_SESSION["tipo_acesso"];
$modulo = "perfil_usuario";

$cod_participante = $_POST["cod_participante"];


//Dados Perfil -> Objeto Usuário
$usuario = new usuario();
$usuario->verificaAcessoTurma($cod_participante, $cod_turma);

$usuario_acesso = $usuario->data["acesso"];
$usuario->carregar($cod_participante);

$nome = $usuario->getNome();
$data_nascimento = formataData($usuario->getDataNascimento(), "/");
$sexo = $usuario->getSexo();
$login = $usuario->getLogin();
$cpf = $usuario->getCPF();
$email = $usuario->getEmail();
//

//Dados Perfil -> Objeto Perfil
$perfil = new perfil();
$perfil->carregar($cod_participante);

$cod_perfil = $perfil->getCodigo();

if ($cod_perfil != "")
{
	//Dados Pessoais
	$descricao = $perfil->getDescricaoPessoal();
	$interesse = $perfil->getInteresse();
	$foto_participante = $perfil->getFoto();
	$miniatura_participante = $perfil->getMiniatura();
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
	$dir_perfil_participante = "../../arquivos/perfil/".$cod_participante."/";
	
	if (($foto_participante != _SEM_FOTO) or ($foto_participante != ""))
	{
		//Diretório dos Arquivos
		if ($miniatura_participante != "")
		{
			$arquivo_participante = $dir_perfil_participante."/".$miniatura_participante;
			$foto_g_participante = $dir_perfil_participante."/".$foto_participante;
			
			if ((file_exists($arquivo_participante)) and (file_exists($foto_g_participante)))
			{	
				$dimensoes = dimensoesImagem($foto_g_participante, 40);
				$dimensoes = explode(".", $dimensoes);
				$largura_participante = $dimensoes[0];
				$altura_participante = $dimensoes[1];
				$link_participante = "JavaScript: janela('Foto','".$foto_g_participante."' ,100 ,100 ,".$largura_participante." ,".$altura_participante." ,0 ,0 ,0 ,1 ,1);";
			}
			else
			{
				$arquivo_participante = "../../imagens/"._SEM_FOTO;
				$link_participante = "";
			}
		}
	}
	else
		$arquivo_participante = "../../imagens/".$foto_participante;
}
else
	$arquivo_participante = "../../imagens/"._SEM_FOTO;

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
	
if ($_POST["tipo_usuario"])
	$tipo_usuario = $_POST["tipo_usuario"];
else
	$tipo_usuario = "L";

$acao_voltar = $_POST["acao_voltar"];

if (empty($acao_voltar))
	$acao_voltar = "minha_turma";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	function voltar()
	{
		<?
		if ($acao_voltar == 'inicial')
		{
		?>
			document.enviar_recado.action = "../<? echo $tipo_acesso; ?>/index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<?
		}
		else
			if ($acao_voltar == 'recados')
			{
		?>
				document.enviar_recado.action = "<? echo $acao_voltar; ?>/index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		<?
			}
			else
				if ($acao_voltar == 'minha_turma')   
		   		{
		?>
					document.enviar_recado.action = "minha_turma.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>&tipo_usuario=<? echo $tipo_usuario; ?>";
		<?
		   		}
				else
				{
		?>
					document.enviar_recado.action = "../<? echo $tipo_acesso; ?>/<? echo $acao_voltar; ?>/index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		<?
				}
		?>
		document.enviar_recado.submit();
	}
	
	function visualizaLog(id)
	{
		var conjunto = document.getElementById(id);
		
		if (conjunto.style.display == 'none')
		{
			conjunto.style.display = '';
		}
		else
		{
			conjunto.style.display = 'none';
		}
	}
	
	function enviarRecado()
	{
		document.enviar_recado.submit();
	}
</script>

<body topmargin="0" leftmargin="0">
<?php include("topo.php"); ?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../imagens/cantoA7.gif" height="10" width="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../imagens/cantoA10.gif" height="10"><img src="../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" valign="top" id="td_linha_menu_esquerdo">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../imagens/cantoA7.gif" valign="top">&nbsp;</td>
			<?php include("ferramentas.php"); ?>
		  <td width="10" valign="top" background="../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../imagens/cantor10.gif"><img src="../../imagens/cantor1.gif" width="10" height="10" border="0"></td>
		<td width="301" height="52" rowspan="2" bgcolor="#FFC66F"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="3" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			  <td><img src="../../imagens/icones/turma/titulo_colegas_tuma.gif" width="250" height="52"></td>
			</tr>
		</table></td>
		<td height="10" background="../../imagens/cantor8.gif" width="436" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../imagens/cantor7.gif"><img src="../../imagens/cantor2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../imagens/cantor10.gif"></td>
		<td height="42" bgcolor="#FFDFAE" width="100%"></td>
		<td width="10" background="../../imagens/cantor7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../imagens/cantor5.gif"></td>
		<td colspan="2" bgcolor="">
		  <table width="100%" border="0" cellpadding="1" cellspacing="2" bgcolor="#FFDFAE">
			<tr>
			  <td width="100%" bgcolor="#FFDFAE">
			    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				  <tr>
				    <td height="10"></td>
				  </tr>
				</table>
				<table width="95%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td width="140" align="right" valign="top" class="preto">Imagem de Exibição:</td>
				  <td width="10">&nbsp;</td>
				  <td align="left"><a onClick="<?php echo $link_participante; ?>" onMouseOver="JavaScript: window.status = 'Visualizar Foto';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><img src="<?php echo $arquivo_participante; ?>" border="0"></a></td>
				</tr>
				<tr>
				  <td colspan="3" height="15"></td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto">Nome Completo:</td>
				  <td>&nbsp;</td>
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
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
				  <td class="laranja_simples"><?php 
				  	if ($cidade != "")
						echo $cidade." / ".$uf;
					else
						echo "<i>Não Informado / Não Informado</i>"
				?></td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto" valign="top">Descri&ccedil;&atilde;o Pessoal:</td>
				  <td>&nbsp;</td>
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
				  <?php 
					if ($site_pessoal != "") 
						echo "<a href=\"".$site_pessoal."\" target=\"_blank\" class=\"link_laranja\">".$site_pessoal."</a>";
					else
						echo "<i>Não informado</i>";
				  ?>
				  </td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto">Apelido no Chat:</td>
				  <td width="10">&nbsp;</td>
				  <td class="laranja_simples">
				  <?php 
					if ($apelido != "") 
						echo $apelido;
					else
						echo "<i>Não informado</i>";
				  ?>
				  </td>
				</tr>
				<tr>
				  <td colspan="3" height="10"></td>
				</tr>
			    </table>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				</table>
				<table width="95%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="3" height="10"></td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto">Profiss&atilde;o:</td>
				  <td width="10">&nbsp;</td>
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
				  <?php
					if ($empresa == "") 
						echo "<i>Não informado</i>";
					else
						echo $empresa; ?></td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto">Cargo / Fun&ccedil;&atilde;o:</td>
				  <td width="10">&nbsp;</td>
				  <td class="laranja_simples">
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
				  <td class="laranja_simples">
				  <?php 
					if ($site_profissional != "") 
						echo "<a href=\"".$site_profissional."\" target=\"_blank\" class=\"link_laranja\">".$site_profissional."</a>"; 
					else
						echo "<i>Não Informado</i>";
				  ?>
				  </td>
				</tr>
				<tr>
				  <td width="140" align="right" class="preto" valign="top">Detalhes:</td>
				  <td width="10">&nbsp;</td>
				  <td class="laranja_simples">
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
			  </table>
				<?php
					if ($tipo_acesso == "tutor")
					{
						$log_usuario = new log_sistema();
						$log_usuario->colecao($cod_participante, $cod_turma);
						$total_logs = $log_usuario->linhas;
						
				?>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				</table>
				<table width="95%" cellpadding="0" cellspacing="0" align="center">
				  <tr>
					<td colspan="3" height="15"></td>
				  </tr>
				  <tr>
					<td colspan="3">
					  <table width="100%" cellpadding="0" cellspacing="0"  align="center">
						<tr>
						  <td colspan="3" class="preto">Últimos Acessos</td>
						</tr>
						<tr>
						  <td colspan="3" height="10"></td>
						</tr>
				<?php
						for ($x = 0; $x < $total_logs; $x++)
						{
							$data_log = $log_usuario->data["data"];
							
							$log_especifico = new log_sistema();
							$log_especifico->colecaoDataEspecifica($cod_participante, $cod_turma, $data_log);
							$total_especifico = $log_especifico->linhas;
							
							$data_especifica = $log_usuario->data["data"];
				?>
						<tr>
						  <td width="140" class="preto" align="right" valign="top"><?php echo formataData($data_especifica, "/"); ?></td>
						  <td width="10"></td>
						  <td>
						  	<table width="100%" cellpadding="0" cellspacing="0">
							  <tr>
							    <td width="10" align="left" valign="top"><a onClick="JavaScript: visualizaLog('<?php echo $data_especifica; ?>'); " style="cursor: pointer"><img id="imagem_logs" name="minimizar" title="Minimizar Logs" src="../../imagens/outros/nodeclose.jpg" border="0"></a></td>
								<td width="5"></td>
								<td>
								  <div id="<?php echo $data_especifica; ?>" style="display: none">
								    <table width="100%" cellpadding="0" cellspacing="0">
									  <tr>
									    <td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  				      </tr>
				<?php
							for ($i = 0; $i < $total_especifico; $i++)
							{
								$hora_especifica = $log_especifico->data["hora"];
								$acao_log = $log_especifico->data["acao"];
				?>
								      <tr>
									    <td class="preto_simples"><?php echo "<b>".$hora_especifica."</b> - ".$acao_log; ?></td>
									  </tr>
				<?php
								$log_especifico->proximo();
							}
				?>
									  <tr>
									    <td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  				      </tr>
									</table>
								  </div>
							    </td>
							  </tr>
							</table>
						  </td>
						</tr>
						<tr>
						  <td height="10" colspan="3"></td>
						</tr>
				<?php
							$log_usuario->proximo();
						}
				?>
					  </table>
					</td>
				  </tr>
				</table>
				<?php
					}
				?>
				<table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td>
					  <table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td height="34"><div align="right"><img src="../../imagens/icones/turma/lado_esquerda.gif" width="20" height="34"></div></td>
						  <td height="34" bgcolor="#FFC66F"><?php if (($usuario_acesso != "C") and ($tipo_acesso != "coordenador")) {?><a onclick="JavaScript: enviarRecado();" onMouseOver="JavaScript: window.status = 'Enivar Recado para <?php echo $nome; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Enviar Recado</span><img src="../../imagens/icones/geral/tipo1/responder.gif" alt="Enivar Recado para <?php echo $nome; ?>" width="30" height="30" border="0" align="middle"></a> &nbsp; <?php } ?><a onclick="JavaScript: voltar();" class="dcontexto"><span>Voltar</span><img src="../../imagens/icones/geral/tipo1/voltar.gif" alt="Voltar" width="30" height="30" border="0" align="middle"></a></td>
						  <td height="34"><div align="left"><img src="../../imagens/icones/turma/lado_direita.gif" width="20" height="34"></div></td>
						</tr>
					  </table>
				    </td>
				  </tr>
				  <tr>
				    <td colspan="3" height="15">
				      <form name="enviar_recado" method="post" action="recados/formulario.php">
				        <input type="hidden" name="codigosDestinos" value="<?php echo $cod_participante.";"; ?>">
					    <input type="hidden" name="cod_participante" value="<?php echo $cod_participante; ?>">
					    <input type="hidden" name="situacao" value="">
					    <input type="hidden" name="acao" value="novo">
					    <input type="hidden" name="acao_voltar" value="perfil_usuario">
					    <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
					    <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
					    <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
				      </form>
				    </td>
				  </tr>
				</table>
				<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
				    <td height="10"></td>
				  </tr>
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../imagens/cantor7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../imagens/cantor5.gif"><img src="../../imagens/cantor4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../imagens/cantor6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../imagens/cantor7.gif"><img src="../../imagens/cantor3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("info.php"); ?>
</body>
</html>
