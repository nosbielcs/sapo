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

$cod_instituicao = $_SESSION["cod_instituicao"];
$cursos_instituicao = new curso();
$cursos_instituicao->colecaoCursoAtivoInstituicao($cod_instituicao);
$cursos_ativos = $cursos_instituicao->linhas;

if ($cursos_ativos > 1)
	$mensagem = "Esta Instituição possuí <font class=\"preto\">".$cursos_ativos."</font> cursos ativos.";
else
	if ($cursos_ativos == 1)
		$mensagem = "Esta Instituição possuí <font class=\"preto\">".$cursos_ativos."</font> curso ativo.";
	else
		if ($cursos_ativos == 0)
			$mensagem = "Esta Instituição não possuí cursos ativos.";
?>
  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" id="tabela_boas_vindas">
	<tr>
	  <td width="10" height="10" align="left" valign="top" background="../../imagens/cantou9.gif"><img src="../../imagens/cantou1.gif" width="10" height="10" border="0"></td>
	  <td width="174" height="34" rowspan="2" valign="top" align="left"><img src="../../imagens/cantou9.gif" width="174" height="34" border="0"></td>
	  <td height="10" background="../../imagens/cantou8.gif" width="100%" valign="top"></td>
	  <td width="10" height="10" align="right" valign="top" background="../../imagens/cantou7.gif"><img src="../../imagens/cantou2.gif" width="10" height="10" border="0"></td>
	</tr>
	<tr>
	  <td width="10" height="10" align="left" valign="top" background="../../imagens/cantou10.gif"></td>
	  <td height="24" bgcolor="#FFFFCC" width="100%" align="right"><a onClick="JavaScript: abas('boasVindas');" style="cursor: pointer"><img id="imagem_boas_vindas" name="minimizar" title="Minimizar Dados Pessoais" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	  <td width="10" background="../../imagens/cantou7.gif"></td>
	</tr>
	<tr>
	  <td width="10" background="../../imagens/cantou5.gif"></td>
	  <td colspan="2" bgcolor="#FFFFCC">
	    <div id="boasVindas">
	    <table width="100%" border="0" cellpadding="1" cellspacing="2">
		  <tr>
			<td width="100%" valign="top">
			  <table width="100%" cellpadding="0" cellspacing="0">
			    <tr>
				  <td class="preto_simples">Olá <font class="preto"><?php echo $nome_usuario; ?></font>, bem vindo ao SA²pO Administração.</td>
				</tr>
				<tr>
				  <td height="15"></td>
				</tr>
				<tr>
				  <td class="preto_simples">No momento você está acessando a Instituição "<font class="preto"><?php echo $_SESSION["nome_instituicao"]; ?></font>".</td>
				</tr>
				<tr>
				  <td height="15"></td>
				</tr>
				<tr>
				  <td class="preto_simples"><?php echo $mensagem; ?></td>
				</tr>
			  </table>
			</td>
		  </tr>
		  <tr>
			<td><div align="right" class="link_preto">ver manual de ajuda</div></td>
		  </tr>
	    </table>
		</div>
	  </td>
	  <td width="10" align="right" background="../../imagens/cantou7.gif">&nbsp;</td>
	</tr>
	<tr>
	  <td width="10" height="10" align="left" valign="bottom" background="../../imagens/cantou5.gif"><img src="../../imagens/cantou4.gif" width="10" height="10" border="0"></td>
	  <td height="10" background="../../imagens/cantou6.gif" colspan="2"></td>
	  <td width="10" height="10" align="right" valign="bottom" background="../../imagens/cantou7.gif"><img src="../../imagens/cantou3.gif" width="10" height="10" border="0"></td>
	</tr>
  </table>