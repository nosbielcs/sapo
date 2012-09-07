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

$cod_curso = $_SESSION["cod_curso"];
$cod_turma = $_SESSION["cod_turma"];
$curso = new curso();
$curso->carregar($cod_curso);
$horas_curso = $curso->getQtdeHoras();
$total_visitas = $_SESSION["total_visitas"];
$data_visita = formataData($_SESSION["data_visita"], "/");
$hora_visita = substr($_SESSION["hora_visita"], 0, 5);

/*$log_usuario = new log_sistema();
$log_usuario->colecao($cod_usuario, $cod_turma);
$total_acessos = $log_usuario->linhas;

if ($total_acessos > 0)
{
	$comando = "Acessou o Ambiente Interno";
	$log_usuario->colecaoAcessoEspecifico($cod_usuario, $cod_turma, $comando);
	$total = $log_usuario->linhas;
	
	if ($total == 1)
	{
		$acessou = false;
	}
	else
	{
		for ($i = 0; $i < $total; $i++)
		{
			if ($i == 1)
			{			
				$data_acesso = formataData($log_usuario->data["data"], "/");
				$hora_acesso = $log_usuario->data["hora"];
				$hora_acesso = substr($hora_acesso, 0, 5);
			}
			
			$log_usuario->proximo();
		}
		
		if ($data_acesso == "")
			$acessou = false;
		else
			$acessou = true;
	}
}
else
	$acessou = false;*/

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
	  <td height="100%" colspan="2" valign="top" bgcolor="#FFFFCC">
	    <div id="boasVindas" style="height:100%">
	    <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="2">
		  <tr>
		    <td height="10"></td>
		  </tr>
		  <tr>
			<td width="100%">
			  <table width="100%" height="100%" cellpadding="0" cellspacing="0">
			    <tr>
				  <td class="preto_simples">Olá <font class="preto"><?php echo $nome_usuario; ?></font>, bem vindo ao SA²pO.</td>
				</tr>
				<tr>
				  <td height="10"></td>
				</tr>
				<tr>
				  <td class="preto_simples">Você está matriculado(a) no Curso "<font class="preto"><?php echo $_SESSION["nome_curso"]; ?></font>", turma "<font class="preto"><?php echo $_SESSION["nome_turma"]; ?></font>". Este curso tem duração de <font class="preto"><?php echo $horas_curso; ?></font> horas.</td>
				</tr>
				<tr>
				  <td height="10"></td>
				</tr>
				<tr>
				  <td class="preto_simples"><?php if ($total_visitas > 1) { ?>Seu último acesso nesta Turma foi <font class="preto"><?php echo $data_visita; ?></font> às <font class="preto"><?php echo $hora_visita; ?></font>, num total de <font class="preto"><?php echo $total_visitas; ?></font> acessos.<?php } else { ?>Este é seu primeiro acesso nesta Turma.<?php } ?></td>
				</tr>
				<tr>
				  <td height="10"></td>
				</tr>
				<tr>
				  <td class="preto_simples">Aproveite os recursos oferecidos pelo sistema e bom curso!</td>
				</tr>
			  </table>
			</td>
		  </tr>
		  <tr>
			<td height="100%" valign="bottom" align="right"><a onClick="window.location.href = '../manual/download.php'" target="_blank" class="link_preto" style="cursor:pointer">ver manual de ajuda</a></td>
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