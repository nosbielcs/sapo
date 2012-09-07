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

include("../../../config/session.lib.php");
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoD9.gif"><img src="../../../imagens/cantoq1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#FFCC80" align="left"><img src="../../../imagens/icones/configuracoes/atividades.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../../imagens/cantoq8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantoq2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoq10.gif"></td>
	<td height="24" bgcolor="#FFECCE" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar Últimas no Fórum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantoq7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantoq5.gif"></td>
	<td colspan="2" bgcolor="#FFECCE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td height="5"></td>
		</tr>
	    <tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="laranja" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="atividade_qtd_lst">
						  <option value="" <?php if (empty($atividade_qtd_lst)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="5" <?php if ($atividade_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($atividade_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($atividade_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($atividade_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($atividade_qtd_lst == "T") echo "selected"; ?>>Todos</option>
						</select>
					  </td>
				    </tr>
				  </table>
			    </td>
			  </tr>			
		    </table>
		  </td>
		</tr>
		<tr>
		  <td height="10"></td>
		</tr>
		<tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="laranja" width="120" align="right">Ordenação:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="laranja_simples">
					    <select name="atividade_ordem">
						  <option value="" <?php if (empty($atividade_ordem)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="2" <?php if ($atividade_ordem == 2) echo "selected"; ?>>Crescente por Data</option>
						  <option value="1" <?php if ($atividade_ordem == 1) echo "selected"; ?>>Decrescente por Data</option>
						  <option value="6" <?php if ($atividade_ordem == 6) echo "selected"; ?>>Crescente por Atividade</option>
						  <option value="5" <?php if ($atividade_ordem == 5) echo "selected"; ?>>Decrescente por Atividade</option>
						  <option value="4" <?php if ($atividade_ordem == 4) echo "selected"; ?>>Crescente por Data de Entrega</option>
						  <option value="3" <?php if ($atividade_ordem == 3) echo "selected"; ?>>Decrescente por Data de Entrega</option>
						  <option value="8" <?php if ($atividade_ordem == 8) echo "selected"; ?>>Crescente por Valor</option>
						  <option value="7" <?php if ($atividade_ordem == 7) echo "selected"; ?>>Decrescente por Valor</option>
						</select>
					  </td>
				  </table>
			    </td>
			  </tr>
			</table>
		  </td>
		</tr>
		<tr>
		  <td height="5"></td>
		</tr>
	  </table>
	</td>
	<td width="10" align="right" background="../../../imagens/cantoq7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoD5.gif"><img src="../../../imagens/cantoq4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantoq6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoD7.gif"><img src="../../../imagens/cantoq3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>