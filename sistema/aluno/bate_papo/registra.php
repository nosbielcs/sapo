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

include("../../../config/session.lib.aluno.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/mensagem_bate_papo.php");
include("../../../classes/turma.php");
include("../../../classes/sala_bate_papo.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_bate_papo.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$modulo = "bate_papo";

if ($_GET["cod_sala_bate_papo"])
	$cod_sala_bate_papo = $_GET["cod_sala_bate_papo"];
else
	if ($_POST["cod_sala_bate_papo"])
		$cod_sala_bate_papo = $_POST["cod_sala_bate_papo"];
		
if ($cod_sala_bate_papo)
{
	$_SESSION["cod_sala"] = $cod_sala_bate_papo; 
	$_SESSION["data_entrada"] = date("Y-m-d");
	$_SESSION["hora_entrada"] = date("H:i:s");
	$_SESSION["rolagem"] = "S";
	$cod_turma = $_SESSION["cod_turma"];
	$cod_usuario = $_SESSION["cod_usuario"];
	$cod_sala = $_SESSION["cod_sala"];
	$data_entrada = $_SESSION["data_entrada"];
	$hora_entrada = $_SESSION["hora_entrada"];
	$horas = date("H");
	$minutos = date("i");
	$segundos = date("s");
	
	if ($segundos == "00")
	{
		$segundos = "58";
		if ($minutos == "00")
		{
			$horas = $horas - 1;
			$minutos = "59";
		}
		else
			if (($minutos > "00") and ($minutos < "10"))
				$minutos = "0".($minutos - 1);
			else
				$minutos = $minutos - 1;
	}
	else
		if (($segundos > "00") and ($segundos < "10"))
		{
			if ($segundos == "01")
			{
				$segundos = "59";
			
				if ($minutos == "00")
				{
					$horas = $horas - 1;
					$minutos = "59";
				}
				else
					$minutos = $minutos - 1;
			}
			else
				$segundos = "0".($segundos - 2);
		}
		else
			$segundos = $segundos - 2;

	$_SESSION["data_comparacao"] = $_SESSION["data_entrada"];
	$_SESSION["hora_comparacao"] = $horas.":".$minutos.":".$segundos;
	
	if ($_POST["cor_mensagem"])
		$_SESSION["cor_mensagem"] = $_POST["cor_mensagem"];
	else
		$_SESSION["cor_mensagem"] = "preto_simples";
		
	$cor_mensagem = $_SESSION["cor_mensagem"];
		
	if ($_GET["acao"])
		$acao = $_GET["acao"];
	else
		if ($_POST["acao"])
			$acao = $_POST["acao"];
			
	if ($acao)
	{
		$verifica_usuario = new usuario_bate_papo();
		$situacao = "A";
		$verifica_usuario->verificarUsuarioSalaBatePapo($cod_usuario, $cod_sala, $situacao);
		$achou = $verifica_usuario->linhas;
		
		$usuario_bate_papo = new usuario_bate_papo();
		
		for ($i = 0; $i < $achou; $i++)
		{
			$cod_usuario = $verifica_usuario->data["cod_usuario"];
			$cod_sala = $verifica_usuario->data["cod_sala"];
			$situacao = "I";
			
			$usuario_bate_papo->alterarSatuts($cod_usuario, $cod_sala, $situacao);
			$verifica_usuario->proximo();
		}
		
		if ($acao == "finalizar")
		{
			header("Location: index.php");
			exit;
		}
	}
	
	$verifica_usuario = new usuario_bate_papo();
	$situacao = "A";
	$verifica_usuario->verificarUsuarioSalaBatePapo($cod_usuario, $cod_sala, $situacao);
	$achou = $verifica_usuario->linhas;
	
	if ($achou == 0)
	{
		$usuario_bate_papo = new usuario_bate_papo();
		$usuario_bate_papo->setCodigoSala($cod_sala);
		$usuario_bate_papo->setCodigoUsuario($cod_usuario);
		$usuario_bate_papo->setDataUsuario($data_entrada);
		$usuario_bate_papo->setHoraUsuario($hora_entrada);
		$usuario_bate_papo->setSituacao($situacao);
		$usuario_bate_papo->inserir();
		
		$modo_mensagem = "";
		$mensagem = "Entrou na Sala de Bate Papo";
		$reservado = "N";
		
		$mensagem_bate_papo = new mensagem_bate_papo();
		$mensagem_bate_papo->setCodigoSala($cod_sala);
		$mensagem_bate_papo->setCodigoUsuario($cod_usuario);
		$mensagem_bate_papo->setCodigoDestinatario(0);
		$mensagem_bate_papo->setCorMensagem($cor_mensagem);
		$mensagem_bate_papo->setModoMensagem($modo_mensagem);
		$mensagem_bate_papo->setMensagem($mensagem);
		$mensagem_bate_papo->setDataMensagem($data_entrada);
		$mensagem_bate_papo->setHoraMensagem($hora_entrada);
		$mensagem_bate_papo->setReservado($reservado);
		$mensagem_bate_papo->inserir();
			
		header("Location: sala_bate_papo.php");
		exit;
	}
	else
	{
?>
<html>
<head>
<title>Edital</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script language="JavaScript">
	function AtualizaUsuarioBatePapo()
	{
		if (document.usuario_conectado.bate_papo_usuario[0].checked)
		{
			document.usuario_conectado.action = "registra.php?cod_sala_bate_papo=<? echo $_POST['cod_sala_bate_papo']; ?>&acao=finalizar";
			document.usuario_conectado.submit();
		}
		else
			if (document.usuario_conectado.bate_papo_usuario[1].checked)
			{
				document.usuario_conectado.action = "registra.php?cod_sala_bate_papo=<? echo $_POST['cod_sala_bate_papo']; ?>&acao=final_entrar";
				document.usuario_conectado.submit();
			}
			else
				window.alert("Selecione uma das opções Acima.");
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
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"><img src="../../../imagens/cantot1.gif" width="10" height="10" border="0"></td>
		  <td width="301" height="52" rowspan="2" bgcolor="#99CC66">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td height="3" bgcolor="#FFFFFF"></td>
			  </tr>
			  <tr>
			    <td bgcolor="#99CC66"><img src="../../../imagens/icones/bate_papo/titulo_bate_papo.gif" width="250" height="52"></td>
			  </tr>
		    </table>
		  </td>
		  <td height="10" background="../../../imagens/cantot8.gif" width="436" valign="top"></td>
		  <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantot7.gif"><img src="../../../imagens/cantot2.gif" width="10" height="10" border="0"></td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"></td>
		  <td height="42" align="right" bgcolor="#CFE7B8" width="100%"><a onClick="JavaScript: novaSalaBatePapo();" onMouseOver="JavaScript: window.status = 'Nova Sala de Bate Papo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_verde">Nova Sala de Bate Papo</a></td>
		  <td width="10" background="../../../imagens/cantot7.gif"></td>
	    </tr>
	    <tr>
		  <td width="10" background="../../../imagens/cantot5.gif"></td>
		  <td colspan="2" bgcolor="#CFE7B8">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
			  <tr>
			    <td width="100%" bgcolor="#CFE7B8">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
				    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
				  </table>
				  <table width="95%" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td valign="middle"> 
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
					  <form name="usuario_conectado" method="post" target="_self" action="registra.php?sala_bate_papo=<?php echo $_POST["sala_bate_papo"]; ?>">
					  <tr>
						<td class="preto">Atenção!</td>
					  </tr>
					  <tr>
						<td height="15"></td>
					  </tr>
					  <tr>
						<td class="preto_simples" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;Seu Usuário já 
						  se encontra nessa sala de Bate Papo, isso pode ter ocorrido devido a saída 
						  inesperada do Sistema ou a finalização incorreta do Sistema por parte do 
						  seu Usuário, ou seja, finalizando a Tela do Sa²po antes da Tela do Bate 
						  Papo.
						</td>
					  </tr>
					  <tr>
					    <td height="10"></td>
					  </tr>
					  <tr>
						<td class="preto_simples" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;Nossa 
						  Equipe Técnica recomenda que para previnir esses inconvenientes em qualquer 
						  Sistema sempre que houver algum tipo de mecanismo "Sair", "Deslogar" solicitar 
						  a Finalização do sistema através desses mecanimos, os quais são desenvolvidos 
						  para a finalização correta do Sistema.</td>
					  </tr>
					  <tr>
						<td height="15"></td>
					  </tr>
					  <tr>
						<td class="preto_simples"><b>Equipe Sa²po</b> - <b>S</b>istema de <b>A</b>poio à <b>Ap</b>rendizagem <b>O</b>nLine</td>
					  </tr>
					  <tr>
						<td height="15"></td>
					  </tr>
					  <tr>
						<td class="preto_simples">Como você deseja proceder?</td>
					  </tr>
					  <tr>
						<td height="15"></td>
					  </tr>
					  <tr>
						<td class="preto_simples"><input type="radio" name="bate_papo_usuario" value="finalizar">Apenas Finalizar meu usuário nesta Sala de Bate Papo</td>
					  </tr>
					  <tr>
						<td class="preto_simples"><input type="radio" name="bate_papo_usuario" value="final_entrar">Finalizar meu usuário nesta Sala de Bate Papo e entrar novamente</td>
					  </tr>
					  <tr>
						<td height="15"></td>
					  </tr>
					  <tr>
						<td>
						  <table width="100%" cellpadding="0" cellspacing="0">
							<tr>
							  <td width="100">&nbsp;</td>
							  <td width="50"><input type="button" name="envia" value="Enviar" onClick="JavaScript: AtualizaUsuarioBatePapo();"></td>
							  <td width="10">&nbsp;</td>
							  <td align="left"><input type="button" name="fecha" value="Fechar" onClick="JavaScript: self.close();"></td>
							</tr>
						  </table>
						</td>
					  </tr>
					  </form>
					</table>
					</td>
				  </tr>
				</table>
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				    <tr>
					  <td height="10"></td>
					</tr>
					<tr>
					  <td height="1" background="../../../imagens/traco14.gif"><img src="../../../imagens/traco14.gif" border="0"></td>
					</tr>
				  </table>
				</td>
			  </tr>
		    </table>
		  </td>
		  <td width="10" align="right" background="../../../imagens/cantot7.gif">&nbsp;</td>
	    </tr>
	    <tr>
		  <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantot4.gif" width="10" height="10" border="0"></td>
		  <td height="10" background="../../../imagens/cantot6.gif" colspan="2"></td>
		  <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantot3.gif" width="10" height="10" border="0"></td>
	    </tr>
	  </table>
	</td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
<?php
	}
}
?>