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
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoD9.gif"><img src="../../../imagens/cantot1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#99CC66" align="left"><img src="../../../imagens/icones/configuracoes/batepapo.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../../imagens/cantot8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantot2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantot10.gif"></td>
	<td height="24" bgcolor="#CFE7B8" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar Últimas no Fórum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantot7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantot5.gif"></td>
	<td colspan="2" bgcolor="#CFE7B8">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td height="5"></td>
		</tr>
	    <tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="verde" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="bate_papo_qtd_lst">
						  <option value="" <?php if (empty($bate_papo_qtd_lst)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="5" <?php if ($bate_papo_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($bate_papo_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($bate_papo_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($bate_papo_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($bate_papo_qtd_lst == "T") echo "selected"; ?>>Todos</option>
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
			    <td class="verde" width="120" align="right">Ordenação:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="verde_simples">
					    <select name="bate_papo_ordem">
						  <option value="" <?php if (empty($bate_papo_ordem)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="2" <?php if ($bate_papo_ordem == 2) echo "selected"; ?>>Crescente por Data</option>
						  <option value="1" <?php if ($bate_papo_ordem == 1) echo "selected"; ?>>Decrescente por Data</option>
						  <option value="4" <?php if ($bate_papo_ordem == 4) echo "selected"; ?>>Crescente por Sala</option>
						  <option value="3" <?php if ($bate_papo_ordem == 3) echo "selected"; ?>>Decrescente por Sala</option>
						  <option value="6" <?php if ($bate_papo_ordem == 6) echo "selected"; ?>>Crescente por Vagas</option>
						  <option value="5" <?php if ($bate_papo_ordem == 5) echo "selected"; ?>>Decrescente por Vagas</option>
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
	<td width="10" align="right" background="../../../imagens/cantot7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoD5.gif"><img src="../../../imagens/cantot4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantot6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoD7.gif"><img src="../../../imagens/cantot3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>