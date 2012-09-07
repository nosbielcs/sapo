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
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantor9.gif"><img src="../../../imagens/cantor1.gif" width="10" height="10" border="0"></td>
	<td height="34" rowspan="2" valign="top" bgcolor="#FFC66F" align="left"><img src="../../../imagens/icones/configuracoes/turma.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../../imagens/cantor8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoC7.gif"><img src="../../../imagens/cantor2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../../imagens/cantor10.gif"></td>
	<td height="24" bgcolor="#FFDFAE" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar �ltimas no F�rum" src="../../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../../imagens/cantor7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../../imagens/cantor5.gif"></td>
	<td colspan="2" bgcolor="#FFDFAE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td height="5"></td>
		</tr>
		<tr>
		  <td valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="laranja" width="120" align="right">Categoria de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="laranja_simples">
					    <select name="turma_cat_lst">
						  <option value="" <?php if (empty($forum_qtd_lst)) echo "selected"; ?>>Padr�o do Sistema</option>
						  <option value="L" <?php if ($turma_cat_lst == "L") echo "selected"; ?>>Alunos</option>
						  <option value="S" <?php if ($turma_cat_lst == "S") echo "selected"; ?>>Suporte T�cnico</option>
						  <option value="T" <?php if ($turma_cat_lst == "T") echo "selected"; ?>>Tutor</option>
						  <option value="Q" <?php if ($turma_cat_lst == "Q") echo "selected"; ?>>Todos</option>
						</select>
					  </td>
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
		  <td valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="laranja" width="120" align="right">Quantidade de Itens:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td>
					    <select name="turma_qtd_lst">
						  <option value="" <?php if (empty($turma_qtd_lst)) echo "selected"; ?>>Padr�o do Sistema</option>
						  <option value="5" <?php if ($turma_qtd_lst == 5) echo "selected"; ?>>5</option>
						  <option value="10" <?php if ($turma_qtd_lst == 10) echo "selected"; ?>>10</option>
						  <option value="15" <?php if ($turma_qtd_lst == 15) echo "selected"; ?>>15</option>
						  <option value="20" <?php if ($turma_qtd_lst == 20) echo "selected"; ?>>20</option>
						  <option value="T" <?php if ($turma_qtd_lst == "T") echo "selected"; ?>>Todos</option>
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
		  <td valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td class="laranja" width="120" align="right">Ordena��o:</td>
			    <td width="10"></td>
			    <td>
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td class="laranja_simples">
					    <select name="turma_ordem">
						  <option value="" <?php if (empty($turma_ordem)) echo "selected"; ?>>Padr�o do Sistema</option>
						  <option value="1" <?php if ($turma_ordem == 1) echo "selected"; ?>>Crescente por Nome</option>
						  <option value="2" <?php if ($turma_ordem == 2) echo "selected"; ?>>Decrescente por Nome</option>
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
	<td width="10" align="right" background="../../../imagens/cantor7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantor5.gif"><img src="../../../imagens/cantor4.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../../imagens/cantor6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantor7.gif"><img src="../../../imagens/cantor3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>