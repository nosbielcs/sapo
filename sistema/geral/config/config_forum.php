<?php
/*
=====================================================================
#  PROJETO: Sa�po 2.0 Beta                                          #
#  FUNCA��O ECUM�NICA DE PROTE��O AO EXCEPCIONAL                    #
#                                                                   #
#  Programa��o                                                      #
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
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoD9.gif"><img src="../../../imagens/cantos1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#CCCCCC" align="left"><img src="../../../imagens/icones/configuracoes/forum.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../../imagens/cantos8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantos2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantos10.gif"></td>
	<td height="24" bgcolor="#E8E8E8" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar �ltimas no F�rum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantos7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantos5.gif"></td>
	<td colspan="2" bgcolor="#E8E8E8">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td height="5"></td>
		</tr>
	    <tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="preto" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="forum_qtd_lst">
						  <option value="" <?php if (empty($forum_qtd_lst)) echo "selected"; ?>>Padr�o do Sistema</option>
						  <option value="5" <?php if ($forum_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($forum_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($forum_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($forum_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($forum_qtd_lst == "T") echo "selected"; ?>>Todos</option>
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
			    <td class="preto" width="120" align="right">Ordena��o:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="preto_simples">
					    <select name="forum_ordem">
						  <option value="" <?php if (empty($forum_ordem)) echo "selected"; ?>>Padr�o do Sistema</option>
						  <option value="6" <?php if ($forum_ordem == 6) echo "selected"; ?>>Crescente por T�pico</option>
						  <option value="5" <?php if ($forum_ordem == 5) echo "selected"; ?>>Decrescente por T�pico</option>
						  <option value="8" <?php if ($forum_ordem == 8) echo "selected"; ?>>Crescente por Total de Respostas</option>
						  <option value="7" <?php if ($forum_ordem == 7) echo "selected"; ?>>Decrescente por Total de Respostas</option>
						  <option value="4" <?php if ($forum_ordem == 4) echo "selected"; ?>>Crescente por Autor</option>
						  <option value="3" <?php if ($forum_ordem == 3) echo "selected"; ?>>Decrescente por Autor</option>
						  <option value="10" <?php if ($forum_ordem == 10) echo "selected"; ?>>Crescente por Exibi��es</option>
						  <option value="9" <?php if ($forum_ordem == 9) echo "selected"; ?>>Decrescente por Exibi��es</option>
						  <option value="2" <?php if ($forum_ordem == 2) echo "selected"; ?>>Crescente por Data</option>
						  <option value="1" <?php if ($forum_ordem == 1) echo "selected"; ?>>Decrescente por Data</option>
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
	<td width="10" align="right" background="../../../imagens/cantos7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoD5.gif"><img src="../../../imagens/cantos4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantos6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoD7.gif"><img src="../../../imagens/cantos3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>