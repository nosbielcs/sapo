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
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$modulo = "cursos";
$cod_inst = $_SESSION["cod_instituicao"];

if ($_POST["acao_curso"])
{		
	$acao_curso = $_POST["acao_curso"];
	
	$acao_voltar = $_POST["acao_voltar"];
	
	if (empty($acao_voltar))
		$acao_voltar = "index";

	switch($acao_curso)
	{
		case "novo":
			$titulo = "Novo Curso";
			$dia_inicio = date("d");
			$mes_inicio = date("m");
			$ano_inicio = date("Y");
			$dia_fim = date("d");
			$mes_fim = date("m");
			$ano_fim = date("Y");
		break;
				
		case "editar":
			$cod_curso = $_POST["cod_curso"];
			
			if (!empty($cod_curso))
			{
				$titulo = "Editar Curso";
				$curso = new curso();
				$curso->carregar($cod_curso);
				$cod_curso = $curso->getCodigo();
				$cod_instituicao = $curso->getCodigoInstituicao();
				$nome = $curso->getNome();
				$descricao = $curso->getDescricao();
				$vagas = $curso->getVagas();
				$data_inicio = formataData($curso->getDataInicio(), "/");
				$dia_inicio = substr($data_inicio, 0, 2);
				$mes_inicio = substr($data_inicio, 3, 2);
				$ano_inicio = substr($data_inicio, 6, 4);
				$data_fim = formataData($curso->getDataFim(), "/");
				$dia_fim = substr($data_fim, 0, 2);
				$mes_fim = substr($data_fim, 3, 2);
				$ano_fim = substr($data_fim, 6, 4);
				$qtde_horas = $curso->getQtdeHoras();
				$situacao = $curso->getSituacao();
				$imagem = $curso->getImagem();

				$diretorio = $_SESSION["dir_cursos_instituicao"].$cod_curso."/imagens/";
				
				if ($imagem != _SEM_FOTO)
				{
					if (($imagem != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $imagem)) and (file_exists($diretorio.$imagem)))
						$arquivo = "../../../arquivos/".$_SESSION["cod_instituicao"]."/cursos/".$cod_curso."/imagens/".$imagem;
					else
						$arquivo = "../../../imagens/"._SEM_FOTO;
				}
				else
					$arquivo = "../../../imagens/"._SEM_FOTO;
			}
		break;
	}
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
<script language="JavaScript" src="../../../funcoes/funcoes_curso.js"></script>

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
				document.curso_instituicao.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
   		<? }
		   else
		   {
		?>
				document.curso_instituicao.action = "visualiza.php";
		<?
		   }
		?>
		document.curso_instituicao.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="JavaScript: atualizaDiasdoMes('<?php echo $dia_inicio; ?>', '<?php echo $mes_inicio; ?>', '<?php echo $ano_inicio; ?>', 'curso_instituicao', 'dia_inicio'); atualizaDiasdoMes('<?php echo $dia_fim; ?>', '<?php echo $mes_fim; ?>', '<?php echo $ano_fim; ?>', 'curso_instituicao', 'dia_fim');">
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
          <td width="120" align="center"><img src="../../../imagens/logos/fepe.gif" width="109" height="97"></td>
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
						<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
						  <tr>	
							<td valign="top">
							  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
								<form action="controle.php" name="curso_instituicao" method="post">
								<tr> 
								  <td colspan="3" align="left" class="verde"><?php echo $titulo; ?></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr>
								  <td width="140" align="right" valign="top" class="preto">Imagem de Exibição:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left"><a onClick="<?php echo $link; ?>" style="cursor: pointer"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
							    </tr>
							    <tr>
								  <td colspan="3" height="10"></td>
							    </tr>
							    <tr>
								  <td width="140" align="right" valign="top" class="preto">Alterar Imagem:</td>
								  <td width="10">&nbsp;</td>
								  <td align="left"><input type="file" name="imagem_nova_curso" value="" tabindex="1"></td>
							    </tr>
							    <tr> 
								  <td colspan="3"  height="10"><input type="hidden" name="imagem_atual_curso" value="<?php echo $imagem; ?>"></td>
							    </tr>
								<tr> 
								  <td width="140" class="preto" align="right">Nome:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="nome" size="45" maxlength="80" value="<?php echo $nome; ?>" tabindex="1"></td>
								</tr>
								<tr>
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="140" class="preto" align="right" valign="top">Descri&ccedil;&atilde;o:</td>
								  <td width="10">&nbsp;</td>
								  <td><textarea cols="50" rows="10" name="descricao" tabindex="2"><?php echo $descricao; ?></textarea></td>
								</tr>
								<tr>
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="140" class="preto" align="right">Vagas:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="vagas" size="6" maxlength="4" value="<?php echo $vagas; ?>" tabindex="3"></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="140" class="preto" align="right">Data Início:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <select name="dia_inicio"></select> 
								    <select name="mes_inicio" onChange="JavaScript: atualizaDiasdoMes(document.curso_instituicao.dia_inicio.value, document.curso_instituicao.mes_inicio.value, document.curso_instituicao.ano_inicio.value, 'curso_instituicao', 'dia_inicio');">
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
								    <select name="ano_inicio" onChange="JavaScript: atualizaDiasdoMes(document.curso_instituicao.dia_inicio.value, document.curso_instituicao.mes_inicio.value, document.curso_instituicao.ano_inicio.value, 'curso_instituicao', 'dia_inicio');">
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
								  <td width="140" class="preto" align="right">Data Fim:</td>
								  <td width="10">&nbsp;</td>
								  <td>
								    <select name="dia_fim"></select> 
								    <select name="mes_fim" onChange="JavaScript: atualizaDiasdoMes(document.curso_instituicao.dia_fim.value, document.curso_instituicao.mes_fim.value, document.curso_instituicao.ano_fim.value, 'curso_instituicao', 'dia_fim');">
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
								    <select name="ano_fim" onChange="JavaScript: atualizaDiasdoMes(document.curso_instituicao.dia_fim.value, document.curso_instituicao.mes_fim.value, document.curso_instituicao.ano_fim.value, 'curso_instituicao', 'dia_fim');">
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
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="140" class="preto" align="right">Quantidade de Horas:</td>
								  <td width="10">&nbsp;</td>
								  <td><input type="text" name="qtde_horas" size="6" maxlength="4" value="<?php echo $qtde_horas; ?>" tabindex="6"></td>
								</tr>
								<tr> 
								  <td colspan="3" height="10"></td>
								</tr>
								<tr> 
								  <td width="140" class="preto" align="right">Situacao:</td>
								  <td width="10">&nbsp;</td>
								  <td>
									<select name="situacao_curso">
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
								  <td colspan="2"><input type="hidden" name="acao_curso" value="<?php echo $acao_curso; ?>"><input type="hidden" name="cod_curso" value="<?php echo $cod_curso; ?>"><input type="hidden" name="acao_voltar" value="index"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="pagina" value="<?php echo $pag; ?>"><input type="hidden" name="opcao" value="0"></td>
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
								</form>
							  </table>
							</td>
						  </tr>
						</table>
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