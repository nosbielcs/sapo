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
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoD9.gif"><img src="../../../imagens/cantop1.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#E8BBD1" align="left"><img src="../../../imagens/icones/configuracoes/conteudo.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../../imagens/cantop8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantop2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"></td>
	<td height="24" bgcolor="#F5E2EC" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar Últimas no Fórum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantop7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantop5.gif"></td>
	<td colspan="2" bgcolor="#EFEFEF">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5E2EC">
	    <tr>
		  <td height="5"></td>
		</tr>
	    <tr>
		  <td width="50%" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="magenta" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="conteudo_qtd_lst">
						  <option value="" <?php if (empty($conteudo_qtd_lst)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="5" <?php if ($conteudo_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($conteudo_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($conteudo_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($conteudo_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($conteudo_qtd_lst == "T") echo "selected"; ?>>Todos</option>
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
			    <td class="magenta" width="120" align="right">Ordenação:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="magenta_simples">
					    <select name="conteudo_ordem">
						  <option value="" <?php if (empty($conteudo_ordem)) echo "selected"; ?>>Padrão do Sistema</option>
						  <option value="4" <?php if ($conteudo_ordem == 4) echo "selected"; ?>>Crescente por Conteúdo</option>
						  <option value="3" <?php if ($conteudo_ordem == 3) echo "selected"; ?>>Decrescente por Conteúdo</option>
						  <option value="2" <?php if ($conteudo_ordem == 2) echo "selected"; ?>>Crescente por Data</option>
						  <option value="1" <?php if ($conteudo_ordem == 1) echo "selected"; ?>>Decrescente por Data</option>
						  <option value="6" <?php if ($conteudo_ordem == 6) echo "selected"; ?>>Crescente por Tamanho</option>
						  <option value="5" <?php if ($conteudo_ordem == 5) echo "selected"; ?>>Decrescente por Tamanho</option>
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
	<td width="10" align="right" background="../../../imagens/cantop7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoD5.gif"><img src="../../../imagens/cantop4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantop6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoD7.gif"><img src="../../../imagens/cantop3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>