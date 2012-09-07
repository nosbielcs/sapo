<?php
/*
=====================================================================
#  PROJETO: Sa²po                                                   #
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
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_inst = $_SESSION["cod_instituicao"];
$modulo = "turmas";

$cursos_instituicao = new curso();
$cursos_instituicao->colecaoCursoInstituicao($cod_inst);
$total_cursos = $cursos_instituicao->linhas;

if ($total_cursos > 0)
{	
	if ($_POST["acao_turma"])
	{		
		$acao_turma = $_POST["acao_turma"];
		$acao_voltar = $_POST["acao_voltar"];
		
		if (empty($acao_voltar))
			$acao_voltar = "index";
	
		switch($acao_turma)
		{
			case "novo":
				$titulo = "Nova Turma";
				$dia_inicio = date("d");
				$mes_inicio = date("m");
				$ano_inicio = date("Y");
				$dia_fim = date("d");
				$mes_fim = date("m");
				$ano_fim = date("Y");
			break;
					
			case "editar":
				$cod_turma = $_POST["cod_turma"];
				
				if (!empty($cod_turma))
				{
					$titulo = "Editar Turma";
					$turma = new turma();
					$turma->carregar($cod_turma);
					$cod_turma = $turma->getCodigoTurma();
					$cod_curso = $turma->getCodigoCurso();
					$descricao = $turma->getDescricao();
					$vagas = $turma->getVagas();
					$data_inicio = formataData($turma->getDataInicio(), "/");
					$dia_inicio = substr($data_inicio, 0, 2);
					$mes_inicio = substr($data_inicio, 3, 2);
					$ano_inicio = substr($data_inicio, 6, 4);
					$data_fim = formataData($turma->getDataFim(), "/");
					$dia_fim = substr($data_fim, 0, 2);
					$mes_fim = substr($data_fim, 3, 2);
					$ano_fim = substr($data_fim, 6, 4);
					$qtde_horas = $turma->getQtdeHoras();
					$cota = $turma->getCotaArquivos();
					$upload = $turma->getUploadMaximo();
					$situacao = $turma->getSituacao();
				}
			break;
		}
	}
	
	$input_select = "<select name=\"curso_instituicao\" onChange=\"JavaScript: formularioTurma(this.value);\">";
	$input_select.= "<option value=\"\">Selecione o Curso</option>";
	
	for ($i = 0; $i < $total_cursos; $i++)
	{
		$cod_curso_instituicao = $cursos_instituicao->data["cod_curso"];
		$curso = new curso();
		$curso->carregar($cod_curso_instituicao);
		
		$nome_curso = $curso->getNome();
		
		if ($cod_curso == $cod_curso_instituicao)
			$input_select.= "<option value=\"".$cod_curso_instituicao."\" selected>".$nome_curso."</option>";
		else
			$input_select.= "<option value=\"".$cod_curso_instituicao."\">".$nome_curso."</option>";
			
		$cursos_instituicao->proximo();
	}
	
	$input_select.= "</select>";
}

if ($_POST["pagina"])
	$pagina = $_POST["pagina"];
else
	$pagina = 1;

if ($_POST["quantidade"])
	$quantidade = $_POST["quantidade"];
else
	$quantidade = 5;

if ($_POST["ordem"])
	$ordem = $_POST["ordem"];
else
	$ordem = 1;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>
<script language="JavaScript" src="../../../funcoes/funcoes_turma.js"></script>

<script type="text/javascript">
	var vetorAbas = new Array();
	vetorAbas[0] = new selecionarAba('dados_instituicao');
	vetorAbas[3] = new selecionarAba( 'formulario_instituicao');
</script>

<script type="text/javascript">
	function voltar()
	{
		<? if ($acao_voltar == 'index')
		   {
		?>
				document.turma_instituicao.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.turma_instituicao.action = "visualiza.php";
		<?
		   }
		?>
		document.turma_instituicao.submit();
	}
</script>

<body topmargin="0" leftmargin="0" <?php /*onLoad="JavaScript: atualizaDiasdoMes('<?php echo $dia_inicio; ?>', '<?php echo $mes_inicio; ?>', '<?php echo $ano_inicio; ?>', 'turma_instituicao', 'dia_inicio'); atualizaDiasdoMes('<?php echo $dia_fim; ?>', '<?php echo $mes_fim; ?>', '<?php echo $ano_fim; ?>', 'turma_instituicao', 'dia_fim');"*/?>>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" rowspan="4" background="../../../imagens/cantoA7.gif" valign="top"><img src="../../../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
    <td width="240" height="10" background="../../../imagens/cantoA11.gif" bgcolor="#FCFFEE"></td>
    <td width="10" height="10" bgcolor="#FCFFEE" background="../../../imagens/cantoA11.gif"></td>
    <td height="10" background="../../../imagens/cantoA11.gif"></td>
    <td width="10" rowspan="2" valign="top" background="../../../imagens/cantoA10.gif"><img src="../../../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td width="240" height="110" bgcolor="#FCFFEE">            
      <table width="240" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left"><img src="../../../imagens/logos/sapo.gif" width="230" height="89" onClick="JavaScript: abas('menu_esquerdo');"></td>
        </tr>
      </table>
    </td>
    <td width="10" valign="middle" bgcolor="#FCFFEE"><img src="../../../imagens/traco1.gif" width="2" height="99"></td>
    <td width="100%" bgcolor="#FCFFEE">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
		    <table width="100%" height="110" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><iframe width="100%" height="110" frameborder="0" scrolling="no" src="../../geral/calendario.php"></iframe></td>
              </tr>
            </table>       
          </td>
          <td width="10" align="center"><img src="../../../imagens/traco1.gif" width="2" height="99" border="0"></td>
          <td width="130" align="center"><img src="../../../imagens/logos/fepe.gif" width="109" height="97"></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../../imagens/cantoA7.gif" height="10" width="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../../imagens/cantoA10.gif" height="10"><img src="../../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" valign="top" id="td_linha_menu_esquerdo">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../../imagens/cantoA7.gif" valign="top">&nbsp;</td>
		    <?php include("../../geral/ferramentas_admin.php"); ?>
		  <td width="10" valign="top" background="../../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantoL10.gif"><img src="../../../imagens/cantoL1.gif" width="10" height="10" border="0"></td>
                <td width="301" height="52" rowspan="2" bgcolor="#99FF99">
				  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="3" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                      <td><img src="../../../imagens/icones/perfil/titulo_dados_pessoais.gif" width="250" height="52"></td>
                    </tr>
                  </table>
				</td>
                <td height="10" background="../../../imagens/cantoL8.gif"></td>
                <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL2.gif" width="10" height="10" border="0"></td>
              </tr>
              <tr>
                <td width="10" height="42" align="left" valign="top" background="../../../imagens/cantoL10.gif"></td>
                <td height="42" bgcolor="#D5FFD5" width="100%">
				  <table align="right" cellpadding="0" cellspacing="0">
				    <tr>
					  <td><a onClick="JavaScript: window.location.href = 'index.php'" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="Voltar" style="cursor:pointer" class="link_verde">Voltar</a></td>
					</tr>
				  </table>
				</td>
                <td width="10" height="10" background="../../../imagens/cantoL7.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../../../imagens/cantoL5.gif">&nbsp;</td>
                <td colspan="2" bgcolor="#D5FFD5">
				  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                    <tr>
                      <td width="100%" bgcolor="#D5FFD5">
					    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="1" background="../../../imagens/traco2.gif"></td>
                          </tr>
						  <tr>
						    <td height="10"></td>
						  </tr>
                        </table>
						<?php
						if ($total_cursos > 0)
						{
						?>
						<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
						  <form action="controle.php" name="turma_instituicao" method="post">
						  <tr>	
							<td valign="top">
							  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
								<tr> 
								  <td colspan="3" align="left" class="verde"><?php echo $titulo; ?></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Curso:</td>
								  <td width="10">&nbsp;</td>
								  <td><?php echo $input_select; ?></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
							  </table>
							  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
							    <div id="formulario_turma">
								<tr> 
								  <td width="130" class="preto" align="right">Nome:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="descricao" size="60" maxlength="80" value="<?php echo $descricao; ?>" tabindex="1"></td>
								</tr>
								<tr>
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Vagas:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="vagas" size="6" maxlength="4" value="<?php echo $vagas; ?>" tabindex="3"></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<!--
								<?php /*
								<tr> 
								  <td width="130" class="preto" align="right">Data Início:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <select name="dia_inicio" ></select> 
								    <select name="mes_inicio" onChange="JavaScript: atualizaDiasdoMes(document.turma_instituicao.dia_inicio.value, document.turma_instituicao.mes_inicio.value, document.turma_instituicao.ano_inicio.value, 'turma_instituicao', 'dia_inicio');">
									  <option value="1" <?php if ($mes_inicio == "01") echo "selected"; ?>>Janeiro</option>
									  <option value="2" <?php if ($mes_inicio == "02") echo "selected"; ?>>Fevereiro</option>
									  <option value="3" <?php if ($mes_inicio == "03") echo "selected"; ?>>Mar&ccedil;o</option>
									  <option value="4" <?php if ($mes_inicio == "04") echo "selected"; ?>>Abril</option>
									  <option value="5" <?php if ($mes_inicio == "05") echo "selected"; ?>>Maio</option>
									  <option value="6" <?php if ($mes_inicio == "06") echo "selected"; ?>>Junho</option>
									  <option value="7" <?php if ($mes_inicio == "07") echo "selected"; ?>>Julho</option>
									  <option value="8" <?php if ($mes_inicio == "08") echo "selected"; ?>>Agosto</option>
									  <option value="9" <?php if ($mes_inicio == "09") echo "selected"; ?>>Setembro</option>
									  <option value="10" <?php if ($mes_inicio == "10") echo "selected"; ?>>Outubro</option>
									  <option value="11" <?php if ($mes_inicio == "11") echo "selected"; ?>>Novembro</option>
									  <option value="12" <?php if ($mes_inicio == "12") echo "selected"; ?>>Dezembro</option>
								    </select>
								    <select name="ano_inicio" onChange="JavaScript: atualizaDiasdoMes(document.turma_instituicao.dia_inicio.value, document.turma_instituicao.mes_inicio.value, document.turma_instituicao.ano_inicio.value, 'turma_instituicao', 'dia_inicio');">
									  <option value="<?php echo date("Y") - 3; ?>" <?php if ($ano_inicio == date("Y") - 3) echo "selected"; ?>><?php echo date(Y)-3; ?></option>
									  <option value="<?php echo date("Y") - 2; ?>" <?php if ($ano_inicio == date("Y") - 2) echo "selected"; ?>><?php echo date(Y)-2; ?></option>
									  <option value="<?php echo date("Y") - 1; ?>" <?php if ($ano_inicio == date("Y") - 1) echo "selected"; ?>><?php echo date(Y)-1; ?></option>
									  <option value="<?php echo date("Y"); ?>" <?php if ($ano_inicio == date("Y")) echo "selected"; ?>><?php echo date(Y); ?></option>
									  <option value="<?php echo date("Y") + 1; ?>" <?php if ($ano_inicio == date("Y") + 1) echo "selected"; ?>><?php echo date(Y)+1; ?></option>
									  <option value="<?php echo date("Y") + 2; ?>" <?php if ($ano_inicio == date("Y") + 2) echo "selected"; ?>><?php echo date(Y)+2; ?></option>
									  <option value="<?php echo date("Y") + 3; ?>" <?php if ($ano_inicio == date("Y") + 3) echo "selected"; ?>><?php echo date(Y)+3; ?></option>
								    </select>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Data Fim:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <select name="dia_fim"></select> 
								    <select name="mes_fim" onChange="JavaScript: atualizaDiasdoMes(document.turma_instituicao.dia_fim.value, document.turma_instituicao.mes_fim.value, document.turma_instituicao.ano_fim.value, 'turma_instituicao', 'dia_fim');">
									  <option value="1" <?php if ($mes_fim == "01") echo "selected"; ?>>Janeiro</option>
									  <option value="2" <?php if ($mes_fim == "02") echo "selected"; ?>>Fevereiro</option>
									  <option value="3" <?php if ($mes_fim == "03") echo "selected"; ?>>Mar&ccedil;o</option>
									  <option value="4" <?php if ($mes_fim == "04") echo "selected"; ?>>Abril</option>
									  <option value="5" <?php if ($mes_fim == "05") echo "selected"; ?>>Maio</option>
									  <option value="6" <?php if ($mes_fim == "06") echo "selected"; ?>>Junho</option>
									  <option value="7" <?php if ($mes_fim == "07") echo "selected"; ?>>Julho</option>
									  <option value="8" <?php if ($mes_fim == "08") echo "selected"; ?>>Agosto</option>
									  <option value="9" <?php if ($mes_fim == "09") echo "selected"; ?>>Setembro</option>
									  <option value="10" <?php if ($mes_fim == "10") echo "selected"; ?>>Outubro</option>
									  <option value="11" <?php if ($mes_fim == "11") echo "selected"; ?>>Novembro</option>
									  <option value="12" <?php if ($mes_fim == "12") echo "selected"; ?>>Dezembro</option>
								    </select>
								    <select name="ano_fim" onChange="JavaScript: atualizaDiasdoMes(document.turma_instituicao.dia_fim.value, document.turma_instituicao.mes_fim.value, document.turma_instituicao.ano_fim.value, 'turma_instituicao', 'dia_fim');">
									  <option value="<?php echo date("Y") - 3; ?>" <?php if ($ano_fim == date("Y") - 3) echo "selected"; ?>><?php echo date(Y)-3; ?></option>
									  <option value="<?php echo date("Y") - 2; ?>" <?php if ($ano_fim == date("Y") - 2) echo "selected"; ?>><?php echo date(Y)-2; ?></option>
									  <option value="<?php echo date("Y") - 1; ?>" <?php if ($ano_fim == date("Y") - 1) echo "selected"; ?>><?php echo date(Y)-1; ?></option>
									  <option value="<?php echo date("Y"); ?>" <?php if ($ano_fim == date("Y")) echo "selected"; ?>><?php echo date(Y); ?></option>
									  <option value="<?php echo date("Y") + 1; ?>" <?php if ($ano_fim == date("Y") + 1) echo "selected"; ?>><?php echo date(Y)+1; ?></option>
									  <option value="<?php echo date("Y") + 2; ?>" <?php if ($ano_fim == date("Y") + 2) echo "selected"; ?>><?php echo date(Y)+2; ?></option>
									  <option value="<?php echo date("Y") + 3; ?>" <?php if ($ano_fim == date("Y") + 3) echo "selected"; ?>><?php echo date(Y)+3; ?></option>
								    </select>
								  </td>
								</tr>
								*/?>
								-->
								<tr> 
								  <td width="130" class="preto" align="right">Data Início:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <table cellpadding="0" cellspacing="0">
									  <tr>
									    <td><input type="text" name="dia_inicio" readonly="yes" size="3" value="<?php echo $dia_inicio; ?>"></td>
										<td width="5" class="preto_simples">/</td>
										<td><input type="text" name="mes_inicio" readonly="yes" size="3" value="<?php echo $mes_inicio; ?>"></td>
										<td width="5" class="preto_simples">/</td>
										<td><input type="text" name="ano_inicio" readonly="yes" size="5" value="<?php echo $ano_inicio; ?>"></td>
									  </tr>
									</table>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Data Fim:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <table cellpadding="0" cellspacing="0">
									  <tr>
									    <td><input type="text" name="dia_fim" readonly="yes" size="3" value="<?php echo $dia_fim; ?>"></td>
										<td width="5" class="preto_simples">/</td>
										<td><input type="text" name="mes_fim" readonly="yes" size="3" value="<?php echo $mes_fim; ?>"></td>
										<td width="5" class="preto_simples">/</td>
										<td><input type="text" name="ano_fim" readonly="yes" size="5" value="<?php echo $ano_fim; ?>"></td>
									  </tr>
									</table>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Quantidade de Horas:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="qtde_horas" size="6" maxlength="4" value="<?php echo $qtde_horas; ?>" tabindex="6"></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Cota:</td>
								  <td width="10">&nbsp;</td>
								  <td><select name="cota">
								  		<option value="10485760" <?php if ($cota == 10485760) echo "selected"; ?>>10 MegaBytes</option>
										<option value="20971520" <?php if ($cota == 20971520) echo "selected"; ?>>20 MegaBytes</option>
										<option value="31457280" <?php if ($cota == 31457280) echo "selected"; ?>>30 MegaBytes</option>
										<option value="41943040" <?php if ($cota == 41943040) echo "selected"; ?>>40 MegaBytes</option>
										<option value="52428800" <?php if ($cota == 52428800) echo "selected"; ?>>50 MegaBytes</option>
								      </select></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Tamanho do Upload:</td>
								  <td width="10">&nbsp;</td>
								  <td><select name="upload">
								  		<option value="2097152" <?php if ($upload == 2097152) echo "selected"; ?>>2 MegaBytes</option>
										<option value="4194304" <?php if ($upload == 4194304) echo "selected"; ?>>4 MegaBytes</option>
										<option value="6291456" <?php if ($upload == 6291456) echo "selected"; ?>>6 MegaBytes</option>
										<option value="8388608" <?php if ($upload == 8388608) echo "selected"; ?>>8 MegaBytes</option>
										<option value="10485760" <?php if ($upload == 10485760) echo "selected"; ?>>10 MegaBytes</option>
								      </select></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="130" class="preto" align="right">Situacao:</td>
								  <td width="10">&nbsp;</td>
								  <td>
									<select name="situacao_turma">
									  <option value="" selected>Seleciona a Situação</option>
									  <option value="A" <?php if ($situacao == "A") echo "selected"; ?>>Ativo</option>
									  <option value="I" <?php if ($situacao == "I") echo "selected"; ?>>Inativo</option>
									</select>
								  </td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr>
								  <td colspan="2"><input type="hidden" name="acao_turma" value="<?php echo $acao_turma; ?>"><input type="hidden" name="cod_turma" value="<?php echo $cod_turma; ?>"><input type="hidden" name="acao_voltar" value="index"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"><input type="hidden" name="opcao" value="0"></td>
								<td>
								  <table border="0" align="center" cellpadding="0" cellspacing="0">
						  			<tr>
						    		  <td height="34"><img src="../../../imagens/icones/perfil/lado_esquerda1.gif" width="20" height="34"></td>
						    		  <td bgcolor="#99FF99"><a onClick="JavaScript: gravarDados();" onMouseOver="JavaScript: window.status = 'Gravar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Cancelar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Cancelar</span><img src="../../../imagens/icones/geral/tipo1/cancelar_04.gif" width="30" height="30" border="0" align="middle"></a></td>
						    		  <td height="34"><img src="../../../imagens/icones/perfil/lado_direita1.gif" width="20" height="34"></td>
						  		    </tr>
					    		  </table>
								</td>
								</tr>
								<tr>
								  <td colspan="3" height="10"></td>
								</tr>								
								</div>
							  </table>
							</td>
						  </tr>
						  </form>
						</table>
						<?php
						}
						?>
					    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					      <tr>
					        <td height="10"></td>
					      </tr>
                          <tr>
                            <td background="../../../imagens/traco2.gif" height="1"></td>
                          </tr>
                       </table>
			         </td>
                   </tr>
                 </table>
		       </td>
               <td width="10" align="right" background="../../../imagens/cantoL7.gif">&nbsp;</td>
             </tr>
             <tr>
               <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantoL5.gif"><img src="../../../imagens/cantoL4.gif" width="10" height="10" border="0"></td>
               <td height="10" background="../../../imagens/cantoL6.gif" colspan="2"></td>
               <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantoL7.gif"><img src="../../../imagens/cantoL3.gif" width="10" height="10" border="0"></td>
             </tr>
           </table>
	     </td>
       </tr>
     </table>
   </td>
 </tr>
</table>
</body>
</html>