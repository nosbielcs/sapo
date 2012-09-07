<?php
/*
=====================================================================
#  PROJETO: Sa²po 2.0 Beta                                          #
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

$recados = new recado();
$pasta = "E";
	
$recados->colecaoRecadoNaoLido($cod_usuario, $cod_turma, $pasta);
$total = $recados->linhas;

if ($total > 4)
	$total = 4;

?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" id="tabela_recados">
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoC10.gif"><img src="../../imagens/cantoC1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#E2ECF5"><img src="../../imagens/cantoC9.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../imagens/cantoC8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../imagens/cantoC7.gif"><img src="../../imagens/cantoC2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoC10.gif"></td>
	<td height="24" bgcolor="#E2ECF5" width="100%" align="right"><a onClick="JavaScript: abas('ultimosRecados');" style="cursor: pointer"><img id="imagem_recados" name="minimizar" title="Minimizar Últimos Recados" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../imagens/cantoC7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../imagens/cantoC5.gif"></td>
	<td height="100%" colspan="2" valign="top" bgcolor="#E2ECF5">
	  <div id="ultimosRecados" style="height:100%">
	  <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="2">
		<form name="recadosInicial" method="post">
		<?php
		if ($total > 0)
		{
			for ($j = 0; $j < $total; $j++)
			{
				$cod_recado = $recados->data["cod_recado"];
				$recado = new recado();
				$recado->carregar($cod_recado);
				
				$data = formataData($recado->getDataRecado(), "/");
				$data = substr($data, 0, 5);
				$hora = $recado->getHora();
				$cod_autor = $recado->getCodigoAutor();
				$assunto = $recado->getAssunto();
				
				$usuario = new usuario();
				$usuario->carregar($cod_autor);
				$nome_autor = $usuario->getNome();
		?>
				<tr>
					<td class="azul"><?php echo "<font class=\"preto\">".$data."</font>&nbsp;-&nbsp;"; ?><a onClick="JavaScript: visualizarPerfil('<?php echo $cod_autor; ?>');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome_autor; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul"><?php echo $nome_autor; ?></a></td>
				</tr>
				<tr>
					<td class="azul"><?php echo "<font class=\"preto\">Assunto:</font>&nbsp;"; ?><a onClick="JavaScript: lerRecadoInicial(<?php echo $cod_recado; ?>, 'E', 'N', '1', '10', '1');" onMouseOver="JavaScript: window.status = 'Ler Recado <?php echo $assunto; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $assunto; ?>" style="cursor: pointer" class="link_azul"><?php echo reduzTexto($assunto, 30); ?></a></td>
				</tr>
		<?php
				if (($j + 1) < $total)
				{
		?>
				<tr>
					<td>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="1" background="../../imagens/traco4.gif"><img height="1" src="../../imagens/traco4.gif" border="0"></td>
							</tr>
						</table>
					</td>
				</tr>
		<?php
				}
				$recados->proximo();
			}
		?>
				<tr>
					<td height="15"></td>
				</tr>
				<tr>
					<td height="100%" valign="bottom" align="right"><input type="hidden" name="cod_recado"><input type="hidden" name="pasta"><input type="hidden" name="situacao"><a onClick="JavaScript: window.location.href = '../geral/recados/index.php';" class="link_azul" onMouseOver="JavaScript: window.status = 'Ver todos Recados';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">ver todos recados</a></td>
				</tr>
		<?php
		}
		else
		{
		?>
			<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td class="azul" align="center">Nenhum recado novo na sua Caixa de Entrada.</td>
			</tr>
		<?php
		}
		?>
		</form>
	  </table>
	  </div>
	</td>
	<td width="10" align="right" background="../../imagens/cantoC7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../imagens/cantoC5.gif"><img src="../../imagens/cantoC4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../imagens/cantoC6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../imagens/cantoC7.gif"><img src="../../imagens/cantoC3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>