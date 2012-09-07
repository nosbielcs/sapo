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

$solicitacoes = new suporte();
$situacao = "P";
	
$solicitacoes->colecao($cod_inst, $situacao);
$total = $solicitacoes->linhas;

if ($total > 4)
	$total = 4;

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoC10.gif"><img src="../../imagens/cantoC1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#E2ECF5"><img src="../../imagens/cantoC9.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../imagens/cantoC8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../imagens/cantoC7.gif"><img src="../../imagens/cantoC2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoC10.gif"></td>
	<td height="24" bgcolor="#E2ECF5" width="100%" align="right"><a onClick="JavaScript: abas('ultimosRecados');" style="cursor: pointer"><img id="imagem_solicitacoes" name="minimizar" title="Minimizar Últimos Recados" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../imagens/cantoC7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../imagens/cantoC5.gif"></td>
	<td colspan="2" bgcolor="#E2ECF5">
	  <div id="ultimosRecados">
	  <table width="100%" border="0" cellpadding="1" cellspacing="2">
		<form name="solicitacoesInicial" method="post">
		<?php
		if ($total > 0)
		{
			for ($j = 0; $j < $total; $j++)
			{
				$cod_suporte = $solicitacoes->data["cod_suporte"];
				$suporte = new sac();
				$suporte->carregar($cod_suporte);
				
				$data_suporte = formataData($suporte->getDataSuporte(), "/");
				$data_suporte = substr($data_suporte, 0, 5);
				$hora = $suporte->getHora();
				$assunto = $sac->getAssunto();
				$cod_inst = $sac->getCodigoInstituicao();
				$instituicao = new instituicao();
				$instituicao->carregar($cod_inst);
				$nome_instituicao = $instituicao->getNome();
		?>
				<tr>
					<td class="azul"><?php echo "<font class=\"preto\">".$data_suporte."</font>&nbsp;-&nbsp;"; ?><?php echo reduzTexto($nome_instituicao, 15); ?></td>
				</tr>
				<tr>
					<td class="azul"><?php echo "<font class=\"preto\">Assunto:</font>&nbsp;"; ?><a onClick="JavaScript: verificarSolicitacao(<?php echo $cod_sac; ?>);" onMouseOver="JavaScript: window.status = 'Verificar Solicitação <?php echo $assunto; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_azul"><?php echo reduzTexto($assunto, 30); ?></a></td>
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
				$solicitacoes->proximo();
			}
		?>
				<tr>
					<td height="15"></td>
				</tr>
				<tr>
					<td align="right"><input type="hidden" name="cod_sac"><input type="hidden" name="pasta"><input type="hidden" name="situacao"><a onClick="JavaScript: window.location.href = '../geral/solicitacoes/index.php';" class="link_azul" onMouseOver="JavaScript: window.status = 'Ver todos Recados';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">ver todos solicitacoes</a></td>
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
				<td class="azul" align="center">Nenhuma Solicitação pendente no momento.</td>
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