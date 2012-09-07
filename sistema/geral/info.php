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

if (($modulo == "inicial") or ($modulo == "minha_turma") or ($modulo == "perfil_usuario"))
{
	$script = "../../funcoes/participantes.js";
	$script2 = "../../funcoes/jquery-1.1.3.1.pack.js";
	include("../../config/session.lib.php");
}
else
{
	$script = "../../../funcoes/participantes.js";
	$script2 = "../../../funcoes/jquery-1.1.3.1.pack.js";
	include("../../../config/session.lib.php");
}

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];

$curso = new curso();
$curso->carregar($cod_curso);
$data_inicio = formataData($curso->getDataInicio(), "/");
$data_fim = formataData($curso->getDataFim(), "/");
$data_atual = date("d/m/Y");
$nome_curso = $curso->getNome();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sa²po</title>

<script type="text/javascript" src="<? echo $script; ?>"></script>

<script type="text/javascript" src="<? echo $script2; ?>"></script>

</head>

<body <?php if ($modulo != "conteudo") {?> onLoad="JavaScript: defineLayer();" <?php } ?>>
	<table width="100%" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="10" height="10" valign="top" background="<?php echo $dir_imagens; ?>cantoE5.gif"><img src="<?php echo $dir_imagens; ?>cantoE1.gif" width="10" height="10" border="0"></td>
		<td height="10" background="<?php echo $dir_imagens; ?>cantoE8.gif"><img src="<?php echo $dir_imagens; ?>cantoE9.gif" width="134" height="10" border="0"></td>
		<td width="10" height="10" valign="top" background="<?php echo $dir_imagens; ?>cantoE7.gif"><img src="<?php echo $dir_imagens; ?>cantoE4.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" background="<?php echo $dir_imagens; ?>cantoE5.gif"></td>
		<td valign="top" bgcolor="#FFDED2">
		  <table width="100%"  border="0" align="right" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="134" bgcolor="#FFBBA1" align="left"><img src="<?php echo $dir_imagens; ?>cantoE10.gif" width="134" height="22"></td>
				<td width="100%">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
					<tr>
					  <td width="60%">
						<div id="total_online">
						  <table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
							  <td width="80%" class="preto_simples">
							  <?php 
								$usuarios_online = usuariosOnline($cod_turma);
								
								$total_usuarios_online = count($usuarios_online);
								echo "<font class=\"vermelho\">".$total_usuarios_online."</font>&nbsp;usuário(s) está(ão) conectado(s) neste momento. ";
							?>
							  <div id="layer1" style="position:absolute; visibility:hidden; z-index:30;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
								  <tr>
									<td width="10" height="10" valign="top" background="<?php echo $dir_imagens; ?>cantoE5.gif"><img src="<?php echo $dir_imagens; ?>cantoE1.gif" width="10" height="10" border="0"></td>
									<td height="10" background="<?php echo $dir_imagens; ?>cantoE8.gif"><div align="left"><img src="<?php echo $dir_imagens; ?>cantoE9.gif" width="134" height="10" border="0"></div></td>
									<td width="10" height="10" valign="top" background="<?php echo $dir_imagens; ?>cantoE7.gif"><img src="<?php echo $dir_imagens; ?>cantoE4.gif" width="10" height="10" border="0"></td>
								  </tr>
								  <tr>
									<td width="10" background="<?php echo $dir_imagens; ?>cantoE5.gif"></td>
									<td valign="top" bgcolor="#FFDED2">
									  <table width="100%"  border="0" align="right" cellpadding="0" cellspacing="0">
										<tr>
										  <td width="134" bgcolor="#FFBBA1"><div align="left"></div></td>
										  <td width="100%">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
											  <tr>
											    <td id="titleBar" style="cursor: move" class="preto" width="100%"><ilayer width="100%" onSelectStart="JavaScript: return false;"><layer width="100%">&nbsp;&nbsp;Usuários Conectados</layer></ilayer></td>
												<td align="center" class="preto"><a onClick="JavaScript: ToggleFloatingLayer('layer1',0); return false;" style="cursor: pointer; text-decoration: none;">[X]</a></td>
											</tr>
											<tr>
											  <td>
												<iframe width="100%" frameborder="0" src="<?php echo $link_listagem; ?>"></iframe>
											  </td>
											</tr>
											<tr>
											  <td><span class="preto">Legenda:</span>&nbsp;<span class="vermelho">Tutor,</span>&nbsp;<span class="verde">Suporte T&eacute;cnico,</span>&nbsp;<span class="preto">Aluno.</span></td>
											</tr>
										   </table>
										 </td>
										</tr>
									  </table>
									</td>
									<td width="10" background="<?php echo $dir_imagens; ?>cantoE7.gif"></td>
								  </tr>
								  <tr>
									<td width="10" height="10" valign="bottom"><img src="<?php echo $dir_imagens; ?>cantoE2.gif" width="10" height="10" border="0"></td>
									<td height="10" background="<?php echo $dir_imagens; ?>cantoE6.gif"><img src="<?php echo $dir_imagens; ?>cantoE11.gif" width="134" height="10" border="0"></td>
									<td width="10" height="10" valign="bottom" background="<?php echo $dir_imagens; ?>cantoE7.gif"><img src="<?php echo $dir_imagens; ?>cantoE3.gif" width="10" height="10" border="0"></td>
								  </tr>
								</table>
							  </div>
							</td>
							<td width="20%" align="right"><a onClick="JavaScript: ToggleFloatingLayer('layer1',1)" onMouseOver="JavaScript: window.status = 'Saiba quem esta Conectado';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_vermelho">saiba quem</a></td>
						  </tr>
						</table>
					  </div>
					  <div id="listagem_online" style="display: none">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						  <tr>
							<td width="80%" class="preto_simples">Usuários Conectados</td>
							<td width="20%" align="right"><a onClick="JavaScript: abas('listagem_online');" onMouseOver="JavaScript: window.status = 'Fechar listagem';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_vermelho">fechar&nbsp;<img src="<?php echo $dir_imagens; ?>outros/nodeclose.jpg" border="0"></a></td>
						  </tr>
						  <tr>
							<td height="10"></td>
						  </tr>
						  <tr>
							<td></td>
							</tr>
							<tr>
							  <td height="10"></td>
							</tr>
							<tr>
							  <td><?php echo "<font class=\"preto_simples\">Legenda:</font>&nbsp;<font class=\"vermelho\">Tutor</font>, <font class=\"verde\">Suporte Técnico</font>, <font class=\"preto\">Aluno</font>."; ?></td>
							</tr>
						  </table>
						</div>
					  </td>
					  <td width="1"><img src="<?php echo $dir_imagens; ?>traco3.gif" width="1" height="27"></td>
					  <td width="20%" class="preto_simples">Andamento do Curso:&nbsp;<font class="vermelho">
						<?php
							$total_dias = calcularDiasEntreDuasDatas($data_inicio, $data_fim);
							$dias_hoje = calcularDiasEntreDuasDatas($data_inicio, $data_atual);
							
							$porcentagem = ($dias_hoje * 100) / ($total_dias);
							$porcentagem = round($porcentagem);
							
							$ano_inicio = substr($data_inicio, 6, 4);
							$mes_inicio = substr($data_inicio, 3, 2);
							$dia_inicio = substr($data_inicio, 0, 2);
							
							$ano_fim = substr($data_fim, 6, 4);
							$mes_fim = substr($data_fim, 3, 2);
							$dia_fim = substr($data_fim, 0, 2);
							
							$data_inicio = mktime(0, 0, 0, $mes_inicio, $dia_inicio, $ano_inicio);
							$data_fim = mktime(0, 0, 0, $mes_fim, $dia_fim, $ano_fim);
							
							$hoje = date("d/m/Y");
							
							$ano_hoje = substr($hoje, 6, 4);
							$mes_hoje = substr($hoje, 3, 2);
							$dia_hoje = substr($hoje, 0, 2);
							
							$data_hoje = mktime(0, 0, 0, $mes_hoje, $dia_hoje, $ano_hoje);
							
							if ($data_hoje < $data_inicio)
							{
								echo "Aguardando início";
							}
							else
								if ($data_hoje >= $data_inicio)
								{
									if ($porcentagem > 100)
										$porcentagem = 100;
									
									echo $porcentagem."%";
								}
						?>
					  </font>
					  </td>
					  <td width="1"><img src="<?php echo $dir_imagens; ?>traco3.gif" width="1" height="27"></td>
					  <td width="20%" class="preto_simples">Tutor:&nbsp;<font class="vermelho">
						<?php
							$tutores = new turma();
							$cod_turma = $_SESSION["cod_turma"];
							$tutores->colecaoTutores($cod_turma);
							
							if ($tutores->linhas > 0)
							{							
								$tutor = new usuario();
								$cod_tutor = $tutores->data["cod_usuario"];
								$tutor->carregar($cod_tutor);
								$nome_tutor = $tutor->getNome();
								echo $nome_tutor;
							}
							else
								echo "Alerta! Nenhum Tutor Vinculado!";
						?>
					  </font>
					  </td>
					</tr>
				  </table>
				</td>
			</tr>
		  </table>
		</td>
		<td width="10" background="<?php echo $dir_imagens; ?>cantoE7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" valign="bottom"><img src="<?php echo $dir_imagens; ?>cantoE2.gif" width="10" height="10" border="0"></td>
		<td height="10" background="<?php echo $dir_imagens; ?>cantoE6.gif"><img src="<?php echo $dir_imagens; ?>cantoE11.gif" width="134" height="10" border="0"></td>
		<td width="10" height="10" valign="bottom" background="<?php echo $dir_imagens; ?>cantoE7.gif"><img src="<?php echo $dir_imagens; ?>cantoE3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
</body>
</html>