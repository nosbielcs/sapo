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
include("../../../classes/recado.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

//Início Código de Contagem de Mensagens por Pasta
$pastas = new recado();
$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$tipo_acesso = $_SESSION["tipo_acesso"];
$modulo = "recados";
	

for ($i = 0; $i < 3; $i++)
{
	if ($i == 0)
		$pasta = "E";
	else
		if ($i == 1)
			$pasta = "S";
		else
			if ($i == 2)
				$pasta = "L";
		
	$pastas->qtdeMsgsPasta($cod_usuario, $cod_turma, $pasta);
	$total = $pastas->linhas;

	for ($j = 0; $j < $total; $j++)
	{
		$situacao = $pastas->data["situacao"];
		if ($pasta == $situacao)
		{
			if ($i == 0)
				$total_msgs_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$total_msgs_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$total_msgs_lixeira = $pastas->data["qtde"];
		}
		else
		{
			if ($i == 0)
				$msgs_nlidas_entrada = $pastas->data["qtde"];
			else
				if ($i == 1)
					$msgs_nlidas_saida = $pastas->data["qtde"];
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = $pastas->data["qtde"];
		}
	
		$pastas->proximo();
	}
	
	if ($total == 1)
	{
		if ($i == 0)
				$msgs_nlidas_entrada = 0;
			else
				if ($i == 1)
					$msgs_nlidas_saida = 0;
				else
					if ($i == 2)
						$msgs_nlidas_lixeira = 0;
	}
	else
		if ($total == 0)
		{
			if ($i == 0)
			{
				$total_msgs_entrada = 0;
				$msgs_nlidas_entrada = 0;
			}
			else
			{
				if ($i == 1)
				{
					$total_msgs_saida = 0;
					$msgs_nlidas_saida = 0;
				}
				else
					if ($i == 2)
					{
						$total_msgs_lixeira = 0;
						$msgs_nlidas_lixeira = 0;
					}
			}
		}
}
//Fim Código de Contagem de Mensagens por Pasta

$pagina = $_POST["pagina"];
$quantidade = $_POST["quantidade"];
$ordem = $_POST["ordem"];
$pasta = $_POST["pasta"];

if ($_POST["cod_recado"])
	$cod_recado = $_POST["cod_recado"];
		
if ($cod_recado)
{
	$recado = new recado();
	$recado->carregar($cod_recado);	
}

if ($_POST["acao"])
	$acao = $_POST["acao"];
		
if ($acao)
{
	switch($acao)
	{
		case "novo":
			$imagem_titulo = "<img src=\"../../../imagens/icones/recados/titulo_nova_mensagem.gif\" border=\"0\">";
			$focus = "document.recado.assuntoRecado.focus();";
			$botao = "OnClick=\"JavaScript: voltar()\"";
			
			if ($_POST["codigosDestinos"])
			{	
				$codigos = $_POST["codigosDestinos"];
				$cod_participante = $_POST["cod_participante"];	
			}
		break;
		
		case "encaminhar":
			$imagem_titulo = "<img src=\"../../../imagens/icones/recados/titulo_encaminhar_mensagem.gif\" border=\"0\">";
			$assunto = "Enc: ".$recado->getAssunto();
			$cod_autor_recado = $recado->getCodigoAutor();
			$data_recado = $recado->getDataRecado();
			$hora_recado = $recado->getHora();
			$autor = new usuario();
			$autor->carregar($cod_autor_recado);
			$nome_autor = $autor->getNome();
			$cod_destintarios = $recado->getDestinatario();
			$cod_destintarios = explode(";", $cod_destintarios);
			$total_destinos = count($cod_destintarios);
			for ($i = 0; $i < $total_destinos; $i++)
			{
				if ($cod_destintarios[$i] != "")
				{
					$cod_destino = $cod_destintarios[$i];
					$destinatario = new usuario();
					$destinatario->carregar($cod_destino);
					$nome_destinatario = $destinatario->getNome();
					$destinos.= $nome_destinatario.";";
				}
			}
			
			$mensagem = "De: ".$nome_autor."\n";
			$mensagem.= "Para: ".$destinos."\n";
			$mensagem.= "Assunto: ".$recado->getAssunto()."\n";
			$mensagem.= "Enviado: ".formataData($data_recado, "/")." às ".$hora_recado."\n\n";
			$mensagem.= $recado->getMensagem();
			$mensagem = formatarRecado($mensagem, "encaminhar");
			$focus = "document.recado.mensagemRecado.focus();";
			$botao = "OnClick=\"JavaScript: voltarRecado();\"";
		break;
		
		case "responder":
			$imagem_titulo = "<img src=\"../../../imagens/icones/recados/titulo_responder.gif\" border=\"0\">";
			$cod_autor = $recado->getCodigoAutor();
			$assunto = "Re: ".$recado->getAssunto();
			$data_recado = $recado->getDataRecado();
			$hora_recado = $recado->getHora();
			$autor = new usuario();
			$autor->carregar($cod_autor);
			$nome_autor = $autor->getNome();
			$cod_destintarios = $recado->getDestinatario();
			$cod_destintarios = explode(";", $cod_destintarios);
			$total_destinos = count($cod_destintarios);
			for ($i = 0; $i < $total_destinos; $i++)
			{
				if ($cod_destintarios[$i] != "")
				{
					$cod_destino = $cod_destintarios[$i];
					$destinatario = new usuario();
					$destinatario->carregar($cod_destino);
					$nome_destinatario = $destinatario->getNome();
					$destinos.= $nome_destinatario.";";
				}
			}
			
			$mensagem = "De: ".$nome_autor."\n";
			$mensagem.= "Para: ".$destinos."\n";
			$mensagem.= "Assunto: ".$recado->getAssunto()."\n";
			$mensagem.= "Enviado: ".formataData($data_recado, "/")." às ".$hora_recado."\n\n";
			$mensagem.= $recado->getMensagem();
			$mensagem = formatarRecado($mensagem, "responder");
			$focus = "document.recado.mensagemRecado.focus();";
			$botao = "OnClick=\"JavaScript: voltarRecado();\"";
		break;
		
		case "responderTodos":
			$imagem_titulo = "<img src=\"../../../imagens/icones/recados/titulo_responder_todos.gif\" border=\"0\">";
			$cod_autor = $recado->getCodigoAutor();
			$assunto = "Re: ".$recado->getAssunto();
			$data_recado = $recado->getDataRecado();
			$hora_recado = $recado->getHora();
			$autor = new usuario();
			$autor->carregar($cod_autor);
			$nome_autor = $autor->getNome();
			$cod_destintarios = $recado->getDestinatario();
			$cod_destintarios = explode(";", $cod_destintarios);
			$total_destinos = count($cod_destintarios);
			for ($i = 0; $i < $total_destinos; $i++)
			{
				if ($cod_destintarios[$i] != "")
				{
					$cod_destino = $cod_destintarios[$i];
					$destinatario = new usuario();
					$destinatario->carregar($cod_destino);
					$nome_destinatario = $destinatario->getNome();
					$destinos.= $nome_destinatario.";";
				}
			}
			
			$mensagem = "De: ".$nome_autor."\n";
			$mensagem.= "Para: ".$destinos."\n";
			$mensagem.= "Assunto: ".$recado->getAssunto()."\n";
			$mensagem.= "Enviado: ".formataData($data_recado, "/")." às ".$hora_recado."\n\n";
			$mensagem.= $recado->getMensagem();
			$mensagem = formatarRecado($mensagem, "responder");
			$codigos = $recado->getDestinatario().";".$cod_autor.";";
			$focus = "document.recado.mensagemRecado.focus();";
			$botao = "OnClick=\"JavaScript: voltarRecado();\" ";
		break;
	}
}		
else
	$imagem_titulo = "<img src=\"../../../imagens/icones/recados/titulo_nova_mensagem.gif\" border=\"0\">";
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
		<?  if ($_POST["acao_voltar"])
			{
		?>
			document.recado.action = "../perfil_usuario.php";
		<?
			}
			else
			{
		?>
		document.recado.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&pasta=<? echo $pasta; ?>&ordem=<? echo $ordem; ?>";
		<?
			}
		?>
		document.recado.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="atualizaDestinoNovoRecado(); defineLayer();<?php echo $focus; ?>">
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
		    <div id="pastas_recados">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"><img src="../../../imagens/cantom1.gif" width="10" height="10" border="0"></td>
				<td width="301" height="52" rowspan="2" bgcolor="#C5D8EB">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="3" bgcolor="#FFFFFF"></td>
					</tr>
					<tr>
					  <td><?php echo $imagem_titulo; ?></td>
					</tr>
				  </table>
				</td>
				<td height="10" background="../../../imagens/cantom8.gif" valign="top"></td>
				<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom2.gif" width="10" height="10" border="0"></td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantom10.gif"></td>
				<td height="42" bgcolor="#E2ECF5" width="100%">
				  <table align="right" cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=E';" onMouseOver="JavaScript: window.status = 'Caixa de Entrada';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Entrada">Caixa de Entrada (<?php echo $total_msgs_entrada."/".$msgs_nlidas_entrada; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=S';" onMouseOver="JavaScript: window.status = 'Caixa de Saída';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Caixa de Saída">Caixa de Saída (<?php echo $total_msgs_saida."/".$msgs_nlidas_saida; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: window.location.href = 'index.php?pag=<?php echo $pagina; ?>&qtd=<?php echo $quantidade; ?>&ordem=<?php echo $ordem; ?>&pasta=L';" onMouseOver="JavaScript: window.status = 'Lixeira';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Lixeira">Lixeira (<?php echo $total_msgs_lixeira."/".$msgs_nlidas_lixeira; ?>)</a></td>
					  <td class="azul">&nbsp;|&nbsp;</td>
					  <td><a onClick="JavaScript: novoRecado('<?php echo $pasta; ?>', '<?php echo $pagina; ?>', '<?php echo $limite; ?>', '<?php echo $ordem; ?>', 'recado');" onMouseOver="JavaScript: window.status = 'Novo Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul" title="Novo Recado">Novo Recado</a></td>
					</tr>
				  </table>
				</td>
				<td width="10" background="../../../imagens/cantom7.gif"></td>
			  </tr>
			  <tr>
				<td width="10" background="../../../imagens/cantom5.gif"></td>
				<td colspan="2" bgcolor="#E2ECF5">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
					<tr>
					  <td width="100%" bgcolor="#E2ECF5">
						<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						  <tr>
						    <td height="10"></td>
						  </tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>	
							<td valign="top">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
								  <td width="20" valign="top" align="center"><img id="barra" name="barra_off" src="../../../imagens/outros/barra_off.gif" style="cursor: pointer" title="Minimizar Participantes" onClick="JavaScript: abas('destinatarios_recado');"></td>
								  <td valign="top">
								    <div id="destinatarios_recado">
									<table width="99%" border="0" cellpadding="0" cellspacing="0">
									  <tr>
										<td colspan="3" class="azul">Participantes</td>  
									  </tr>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <?php
										//Alunos
										$tutores = new usuario();
										$tutores->colecaoUsuarioTurma($_SESSION["cod_turma"], "T", "");
										$total_tutores = $tutores->linhas;
								
										if ($total_tutores > 0)
										{
									  ?>
									  <tr>
										<td>
										  <form name="tutores">
										  <table width="100%" cellpadding="0" cellspacing="0">
											<tr>
											  <td width="20"><input type="checkbox" name="todos" onClick="marcaTodosNovoRecado('tutores');"></td>
											  <td width="10">&nbsp;</td>
											  <td class="azul">Marcar/Desmarcar Todos</td>
											</tr>
											<tr>
											  <td colspan="3" class="preto">Tutores</td>
											</tr>
										<?php
											$cor_fundo = "azul_linha_1";
											for ($i = 0; $i < $total_tutores; $i++)
											{
												$cod_usuario = $tutores->data["cod_usuario"];
												$acesso_usuario = $tutores->data["acesso"];
												$usuario = new usuario();
												$usuario->carregar($cod_usuario);
												
												$nome = $usuario->getNome();
												
												if ($cor_fundo == "azul_linha_1")
													$cor_fundo = "azul_linha_2";
												else
													$cor_fundo = "azul_linha_1";
										?>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
											<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
											  <td width="20">
												<?php 
													if ($codigos)
													{
														$achou = false;
														$destinatarios = explode(";", $codigos);
														$total = sizeof($destinatarios);
														
														for ($j = 0; $j < $total; $j++)
														{
															if ($destinatarios[$j] != "")
															{
																$cod_destinatario = $destinatarios[$j];
														
																if ($cod_usuario == $cod_destinatario)
																	$achou = true;
																else
																	if ($achou != true)
																		$achou = false; 		
															}		
														}
														
														if ($achou == true)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">";
													}
													else
													{
														if ($cod_usuario == $cod_autor)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 	
													}
												?>
											  </td>
											  <td width="10">&nbsp;</td>
											  <td align="left" class="azul_simples"><?php echo $nome; ?></td>
											</tr>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
									  <?php	
												$tutores->proximo();
											}
									  ?> 
										  </table>
										  </form>
										</td>
									  </tr>
									  <tr>
									    <td colspan="3" height="10"></td>
									  </tr>
									  <?php
										}
										else
										{
									  ?>
									  <tr>
									    <td colspan="3" height="10"></td>
									  </tr>
									  <?php
									  ?>
									  <tr>
										<td colspan="3" class="preto">Tutores</td>
									  </tr>
									  <tr>
										<td colspan="3" class="azul_simples">Não exitem Tutores nesta Turma</td>
									  </tr>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <?php 
										}
										
									 	if ($tipo_acesso != "aluno")
									 	{
											//supervisores
											$supervisores = new usuario();
											$supervisores->colecaoUsuarioTurma($_SESSION["cod_turma"], "P", "");
											$total_supervisores = $supervisores->linhas;
									
											if ($total_supervisores > 0)
											{
									  ?>
									  <tr>
										<td>
										  <form name="coordenador">
										  <table width="100%" cellpadding="0" cellspacing="0">
											<tr>
											  <td width="20"><input type="checkbox" name="todos" onClick="marcaTodosNovoRecado('coordenador');"></td>
											  <td width="10">&nbsp;</td>
											  <td class="azul">Marcar/Desmarcar Todos</td>
											</tr>
											<tr>
											  <td colspan="3" class="preto">Supervisor do Sistema </td>
											</tr>
										<?php
												$cor_fundo = "azul_linha_1";
												for ($i = 0; $i < $total_supervisores; $i++)
												{
													$cod_usuario = $supervisores->data["cod_usuario"];
													$acesso_usuario = $supervisores->data["acesso"];
													$usuario = new usuario();
													$usuario->carregar($cod_usuario);
													
													$nome = $usuario->getNome();
													
													if ($cor_fundo == "azul_linha_1")
														$cor_fundo = "azul_linha_2";
													else
														$cor_fundo = "azul_linha_1";
										?>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
											<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
											  <td width="20">
												<?php 
													if ($codigos)
													{
														$achou = false;
														$destinatarios = explode(";", $codigos);
														$total = sizeof($destinatarios);
														
														for ($j = 0; $j < $total; $j++)
														{
															if ($destinatarios[$j] != "")
															{
																$cod_destinatario = $destinatarios[$j];
														
																if ($cod_usuario == $cod_destinatario)
																	$achou = true;
																else
																	if ($achou != true)
																		$achou = false; 		
															}		
														}
														
														if ($achou == true)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">";
													}
													else
													{
														if ($cod_usuario == $cod_autor)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 	
													}
												?>
											  </td>
											  <td width="10">&nbsp;</td>
											  <td align="left" class="azul_simples"><?php echo $nome; ?></td>
											</tr>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
									  <?php	
													$supervisores->proximo();
												}
									  ?> 
										  </table>
										  </form>
										</td>
									  </tr>
									  <?php
										}
										else
										{
									  ?>
									  <tr>
									    <td colspan="3" height="10"></td>
									  </tr>
									  <?php
									  ?>
									  <tr>
										<td colspan="3" class="preto">supervisores</td>
									  </tr>
									  <tr>
										<td colspan="3" class="azul_simples">Não exitem supervisores nesta Turma</td>
									  </tr>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <?php 
											}
										}
										
										if ($_SESSION["tipo_acesso"] != "supervisor")
										{
											//Alunos
											$alunos = new usuario();
											$alunos->colecaoUsuarioTurma($_SESSION["cod_turma"], "L", "");
											$total_alunos = $alunos->linhas;
								
											if ($total_alunos > 0)
											{
									  ?>
									  <tr>
										<td>
										  <form name="alunos">
										  <table width="100%" cellpadding="0" cellspacing="0">
											<tr>
											  <td width="20"><input type="checkbox" name="todos" onClick="marcaTodosNovoRecado('alunos');"></td>
											  <td width="10">&nbsp;</td>
											  <td class="azul">Marcar/Desmarcar Todos</td>
											</tr>
											<tr>
											  <td colspan="3" class="preto">Alunos</td>
											</tr>
										<?php
												$cor_fundo = "azul_linha_1";
												for ($i = 0; $i < $total_alunos; $i++)
												{
													$cod_usuario = $alunos->data["cod_usuario"];
													$acesso_usuario = $alunos->data["acesso"];
													$usuario = new usuario();
													$usuario->carregar($cod_usuario);
												
													$nome = $usuario->getNome();
													
													if ($cor_fundo == "azul_linha_1")
														$cor_fundo = "azul_linha_2";
													else
														$cor_fundo = "azul_linha_1";
										?>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
											<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
											  <td width="20">
											  <?php 
													if ($codigos)
													{
														$achou = false;
														$destinatarios = explode(";", $codigos);
														$total = sizeof($destinatarios);
														for ($j = 0; $j < $total; $j++)
														{
															if ($destinatarios[$j] != "")
															{
																$cod_destinatario = $destinatarios[$j];
														
																if ($cod_usuario == $cod_destinatario)
																	$achou = true;
																else
																	if ($achou != true)
																		$achou = false; 		
															}
														}
														
														if ($achou == true)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">";
													}
													else
													{
														if ($cod_usuario == $cod_autor)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 	
													}
											  ?>
											  </td>
											  <td width="10">&nbsp;</td>
											  <td align="left" class="azul_simples"><?php echo $nome; ?></td>
											</tr>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
										<?php	
													$alunos->proximo();
												}
										?> 
										  </table>
										  </form>
										</td>
									  </tr>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <?php
											}
											else
											{
									  ?>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <tr>
									    <td colspan="3" class="preto">Alunos</td>
									  </tr>
									  <tr>
										<td colspan="3" class="azul_simples">Não exitem Alunos nesta Turma</td>
									  </tr>
									  <tr>
										<td colspan="3" height="10"></td>
									  </tr>
									  <?php 
											}
										}
										//Suporte OnLine
										$suporte = new usuario();
										$suporte->colecaoUsuarioTurma($_SESSION["cod_turma"], "S", "");
										$total_suporte = $suporte->linhas;
								
										if ($total_suporte > 0)
										{
									  ?>
										<td>
										  <form name="suporte">
										  <table width="100%" cellpadding="0" cellspacing="0">
											<tr>
											  <td width="20"><input type="checkbox" name="todos" onClick="marcaTodosNovoRecado('suporte');"></td>
											  <td width="10">&nbsp;</td>
											  <td class="azul">Marcar/Desmarcar Todos</td>
											</tr>
											<tr>
											  <td colspan="3" class="preto">Suporte</td>
											</tr>
										<?php
											$cor_fundo = "azul_linha_1";
											for ($i = 0; $i < $total_suporte; $i++)
											{
												$cod_usuario = $suporte->data["cod_usuario"];
												$acesso_usuario = $suporte->data["acesso"];
												$usuario = new usuario();
												$usuario->carregar($cod_usuario);
											
												$nome = $usuario->getNome();
												
												if ($cor_fundo == "azul_linha_1")
													$cor_fundo = "azul_linha_2";
												else
													$cor_fundo = "azul_linha_1";
										?>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
											<tr class="<?php echo $cor_fundo; ?>" id="<?php echo $cod_usuario; ?>">
											  <td width="20">
											  <?php 
													if ($codigos)
													{
														$achou = false;
														$destinatarios = explode(";", $codigos);
														$total = sizeof($destinatarios);
														for ($j = 0; $j < $total; $j++)
														{
															if ($destinatarios[$j] != "")
															{
																$cod_destinatario = $destinatarios[$j];
														
																if ($cod_usuario == $cod_destinatario)
																	$achou = true;
																else
																	if ($achou != true)
																		$achou = false; 		
															}
														}
														
														if ($achou == true)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">";
													}
													else
													{
														if ($cod_usuario == $cod_autor)
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' checked='true' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 
														else
															echo "<input type='checkbox' name='".$cod_usuario."' value='".$nome."' id='".$cor_fundo."' onClick=\"JavaScript: atualizaDestinoNovoRecado();\">"; 	
													}
											  ?>
											  </td>
											  <td width="10">&nbsp;</td>
											  <td align="left" class="azul_simples"><?php echo $nome; ?></td>
											</tr>
											<tr>
											  <td height="1" class="<?php echo $cor_fundo; ?>"></td>
											</tr>
										<?php	
												$suporte->proximo();
											}
										?> 
										  </table>
										  </form>
										</td>
									  </tr>
									  <?php
										}
										else
										{
									  ?>	
									  <tr>
									    <td colspan="3" class="preto">Suporte Técnico</td>
									  </tr>
									  <tr>
										<td colspan="3" class="azul_simples">Não existe Suporte Técnico para esta Turma</td>
									  </tr>	  
									  <?php
										}
									  ?>
									</table>
									</div>
								  </td>
								  <td width="5"></td>
								  <td valign="top">
								    <div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									  <tr> 
										<td>
										<form action="controle.php" name="recado" method="post">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
										  <tr> 
											<td colspan="3" align="left" class="azul"><?php echo $titulo; ?></td>
										  </tr>
										  <tr> 
											<td colspan="3" height="15"></td>
										  </tr>
										  <tr>
										    <td width="100" class="preto" align="right" colspan="">Destino:</td>
										    <td width="10">&nbsp;</td>
										    <td><input type="text" name="destinoRecado" size="45" maxlength="80" value="<?php echo $destino; ?>" readonly="true"></td>
										  </tr>
										  <tr>
											<td colspan="3" height="15"></td>
										  </tr>
										  <tr>
											<td width="100" class="preto" align="right">Assunto:</td>
											<td width="10">&nbsp;</td>
											<td colspan="2"><input type="text" name="assuntoRecado" size="45" maxlength="80" value="<?php echo $assunto; ?>"></td>  
										  </tr>
										  <tr>
											<td colspan="3" height="15"></td>
										  </tr>
										  <tr>
										    <td></td>
											<td></td>
											<td><textarea cols="40" rows="10" name="mensagemRecado"><?php echo $mensagem; ?></textarea></td>
										  </tr>
										  <tr>
											<td colspan="3" height="10">
											  <input type="hidden" name="codigosDestinos" value="">
											  <input type="hidden" name="acao" value="<?php echo $acao; ?>">
											  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
									  		  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
									  		  <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
									  		  <input type="hidden" name="pasta" value="<?php echo $pasta; ?>">
											  <input type="hidden" name="cod_recado" value="<?php echo $cod_recado; ?>">
											  <input type="hidden" name="cod_participante" value="<?php echo $cod_participante; ?>">
											</td>
										  </tr>
										  <tr>
										    <td colspan="3">
											  <table width="100%" cellpadding="0" cellspacing="0" align="left">
											    <td width="10"></td>
												<td>
											  	<?php 
													$tabela_smilies = montaTabelaSmilies($smilies, "../../../imagens/icones/smilies/", "recado", "recados", "horizontal", "#E2ECF5"); 
													echo $tabela_smilies; 
											  	?>
										    	</td>
											  </table>
											</td>
										  </tr>
										  <tr>
											<td colspan="4">
											  <table align="center" cellpadding="0" cellspacing="0" border="0">
												<tr>
												  <td height="34"><img src="../../../imagens/icones/recados/lado_esquerda1.gif" width="20" height="34"></td>
												  <td height="34" bgcolor="#C5D8EB"><a onClick="JavaScript: cadastrarRecado();" onMouseOver="JavaScript: window.status = 'Enviar Recado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Enviar Recado</span><img src="../../../imagens/icones/geral/tipo1/enviar.gif" alt="Enviar Recado" width="30" height="30" border="0" align="middle"></a> &nbsp; <a  <?php echo $botao; ?> onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" alt="Cancelar" width="30" height="30" border="0" align="middle"></a></td>
												  <td height="34"><img src="../../../imagens/icones/recados/lado_direita1.gif" width="20" height="34"></td>
											    </tr>
											  </table>
											</td>
										  </tr>
										</table>
										</form>
										</td>
									  </tr>
									</table>
									</div>
								  </td>
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
							<td height="1" background="../../../imagens/traco7.gif"></td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				</td>
				<td width="10" align="right" background="../../../imagens/cantom7.gif">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantom4.gif" width="10" height="10" border="0"></td>
				<td height="10" background="../../../imagens/cantom6.gif" colspan="2"><img src="../../../imagens/cantom6.gif" height="10"></td>
				<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantom3.gif" width="10" height="10" border="0"></td>
			  </tr>
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