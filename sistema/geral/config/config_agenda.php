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
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoD9.gif"><img src="../../../imagens/cantoo1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#C5C8DA" align="left"><img src="../../../imagens/icones/configuracoes/agenda.gif" width="174" height="34"></td>
	<td height="10" background="../../../imagens/cantoo8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantoo2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoo10.gif"></td>
	<td height="24" bgcolor="#D7D9E5" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar Últimas no Fórum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantoo7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantoo5.gif"></td>
	<td colspan="2" bgcolor="#D7D9E5">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td height="5"></td>
		</tr>
	    <tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="purpura" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="agenda_qtd_lst">
						  <option value="" <?php if (empty($agenda_qtd_lst)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="5" <?php if ($agenda_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($agenda_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($agenda_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($agenda_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($agenda_qtd_lst == "T") echo "selected"; ?>>Todos</option>
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
			    <td class="purpura" width="120" align="right">Ordenação:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="purpura_simples">
					    <select name="agenda_ordem">
						  <option value="" <?php if (empty($agenda_ordem)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="2" <?php if ($agenda_ordem == 2) echo "selected"; ?>>Crescente por Data</option>
						  <option value="1" <?php if ($agenda_ordem == 1) echo "selected"; ?>>Decrescente por Data</option>
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
	<td width="10" align="right" background="../../../imagens/cantoo7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoD5.gif"><img src="../../../imagens/cantoo4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantoo6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoD7.gif"><img src="../../../imagens/cantoo3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>