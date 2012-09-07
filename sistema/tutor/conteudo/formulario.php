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

include("../../../config/session.lib.tutor.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/curso.php");
include("../../../classes/conteudo.php");
include("../../../classes/conteudo_usuario.php");
include("../../../classes/turma.php");
include("../../../classes/usuario.php");
include("../../../classes/usuario_online.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$modulo = "conteudo";

$acao = $_POST["acao"];
$cod_conteudo = $_POST["cod_conteudo"];
$cod_curso = $_SESSION["cod_curso"];
$cod_turma = $_SESSION["cod_turma"];
$pagina = $_POST["pagina"];
$quantidade = $_POST["quantidade"];
$ordem = $_POST["ordem"];

$tamanho = strlen($cod_conteudo);
$onLoad = "JavaScript: defineLayer();";

if ($_POST["acao"])
{
	$acao = $_POST["acao"];
	
	switch($acao)
	{
		case "novo":
			$titulo = "Novo Conteúdo";					
			$nome_conteudo = $_POST["nome_conteudo"];
			$descricao_conteudo = $_POST["descricao_conteudo"];
			$tipo_conteudo = $_POST["tipo_conteudo"];
			
			$conteudos = new conteudo();
			$dados = $conteudos->arvoreConteudos($cod_turma, 2);
			$inputHierarquia = inputSelectHierarquia("hierarquia_conteudo", $dados, 0, '', '');
			$funcao = "JavaScript: tipoConteudo('novo', '', '', '', '', '".$inputHierarquia."');";
		break;
		
		case "editar":
			if ($cod_conteudo[$tamanho - 1] == ";")
				$cod_conteudo = trim(str_replace(";", "", $cod_conteudo));
				
			$titulo = "Editar Conteúdo";
			$conteudo = new conteudo();
			$conteudo->carregar($cod_conteudo);
			
			$nome_conteudo = $conteudo->getNome();
			$descricao_conteudo = $conteudo->getDescricao();
			$tipo_conteudo = $conteudo->getTipo();
			$conteudo_principal = $conteudo->getPrincipal();	
			$conteudo_protegido = $conteudo->getProtegido();
			
			switch($tipo_conteudo)
			{
				case "html":
					$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/html/".$nome_conteudo."/";
				break;
				
				case "doc":
					$nome_diretorio = str_replace(".doc","", $nome_conteudo);
					$nome_diretorio = str_replace(" ", "_", $nome_diretorio)."/";
					$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/doc/".$nome_diretorio."/".$nome_conteudo;
				break;
				
				case "powerpoint":
					$nome_diretorio = str_replace(".ppt","", $nome_conteudo);
					//$nome_diretorio = str_replace(".pps","", $nome_conteudo);
					$nome_diretorio = str_replace(" ", "_", $nome_diretorio);
					$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/ppt/".$nome_diretorio."/".$nome_conteudo;
				break;
				
				case "pdf":
					$nome_diretorio = str_replace(".pdf","", $nome_conteudo);
					$nome_diretorio = str_replace(" ", "_", $nome_diretorio);
					$diretorio_conteudo = "../../../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/".$cod_turma."/pdf/".$nome_diretorio."/".$nome_conteudo;
				break;
			}
						
			$conteudos = new conteudo();
			$dados = $conteudos->arvoreConteudos($cod_turma, 2);
			$inputHierarquia = inputSelectHierarquia("hierarquia_conteudo", $dados, 0, '', $cod_conteudo);
			
			$onLoad.= " tipoConteudo('editar', '".$nome_conteudo."', '".$descricao_conteudo."', '".$tipo_conteudo."', '".$diretorio_conteudo."', '".$inputHierarquia."', '".$conteudo_protegido."', '".$conteudo_principal."');";
			$fixo = "disabled";
			
		break;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	function voltar()
	{
		document.cad_conteudo.action = "index.php?pag=<? echo $pagina; ?>&qtd=<? echo $quantidade; ?>&ordem=<? echo $ordem; ?>";
		document.cad_conteudo.submit();
	}
</script>

<body topmargin="0" leftmargin="0" onLoad="<?php echo $onLoad; ?>">
<?php include("../../geral/topo.php"); ?>
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
		  <?php include("../../geral/ferramentas.php"); ?>
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
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"><img src="../../../imagens/cantop1.gif" width="10" height="10" border="0"></td>
          <td width="301" height="52" rowspan="2" bgcolor="#C5C8DA">
		    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="3" bgcolor="#FFFFFF"></td>
              </tr>
              <tr>
                <td bgcolor="#E8BBD1"><img src="../../../imagens/icones/conteudo/titulo_materiais_disponiveis.gif" width="250" height="52"></td>
              </tr>
            </table>
		  </td>
          <td height="10" background="../../../imagens/cantop8.gif" width="436" valign="top"></td>
          <td width="10" height="10" align="right" valign="top" background="../../../imagens/cantop7.gif"><img src="../../../imagens/cantop2.gif" width="10" height="10" border="0"></td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="top" background="../../../imagens/cantop10.gif"></td>
          <td height="42" bgcolor="#F5E2EC" width="100%" align="right"><a onClick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Visualizar Conteúdos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="link_magenta">Visualizar Conteúdos</a></td>
          <td width="10" background="../../../imagens/cantop7.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../../../imagens/cantop5.gif"></td>
          <td colspan="2" bgcolor="#F5E2EC">
		    <table width="100%" border="0" cellpadding="1" cellspacing="2">
              <tr>
                <td width="100%" bgcolor="#F5E2EC">
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="1" background="../../../imagens/traco10.gif"></td>
                    </tr>
					<tr>
					  <td height="10"></td>
					</tr>
                  </table>
				  <table width="95%" cellpadding="0" cellspacing="0" border="0" align="center">
					<tr>
					  <td>
						<form name="cad_conteudo" action="controle.php" method="post" enctype="multipart/form-data">
						<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#E8BBD1">
						  <tr> 
							<td colspan="3" class="magenta"><?php echo $titulo; ?></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td class="preto" width="140" align="right">Tipo:</td>
							<td width="10">&nbsp;</td>
							<td align="left">
							  <select name="tipo_conteudo" onChange="<?php echo $funcao; ?>" <?php echo $fixo; ?>>
								<option value="" <?php if ($tipo_conteudo == "") echo "selected"; ?>></option>
								<option value="html" <?php if ($tipo_conteudo == "html") echo "selected"; ?>>Contéudo HTML ZIPADO</option>
								<option value="doc" <?php if ($tipo_conteudo == "doc") echo "selected"; ?>>Conteúdo no Formato WORD</option>
								<option value="powerpoint" <?php if ($tipo_conteudo == "powerpoint") echo "selected"; ?>>Conteúdo no Formato PowerPoint</option>
								<option value="pdf" <?php if ($tipo_conteudo == "pdf") echo "selected"; ?>>Conteúdo no Formato PDF</option>
								<option value="site" <?php if ($tipo_conteudo == "site") echo "selected"; ?>>Link para Site</option>
							  </select>
							</td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr>
							<td id="conteudo" colspan="3"></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td colspan="2">
							  <input type="hidden" name="cod_conteudo" value="<?php echo $cod_conteudo; ?>"> 
							  <input type="hidden" name="acao" value="<?php echo $acao; ?>">
							  <input type="hidden" name="tipo_conteudo_" value="<?php echo $tipo_conteudo; ?>">
							  <input type="hidden" name="pagina" value="<?php echo $pagina; ?>"> 
							  <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
							  <input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
							</td>
							<td>
							  <table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td height="34"><img src="../../../imagens/icones/conteudo/lado_esquerda.gif" width="20" height="34"></td>
								  <td height="34" bgcolor="#F5E2EC"><a onClick="JavaScript: cadastrarConteudo();" onMouseOver="JavaScript: window.status = 'Gravar Conteúdo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Gravar</span><img src="../../../imagens/icones/geral/tipo1/gravar_1.gif" alt="" width="30" height="30" border="0" align="middle"></a> &nbsp; <a onclick="JavaScript: voltar();" onMouseOver="JavaScript: window.status = 'Voltar';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer" class="dcontexto"><span>Voltar</span><img src="../../../imagens/icones/geral/tipo1/voltar.gif" alt="Fechar formul&aacute;rio" width="30" height="30" border="0" align="middle"></a></td>
								  <td height="34"><img src="../../../imagens/icones/conteudo/lado_direita.gif" width="20" height="34"></td>
								</tr>
							  </table>
							</td>
						  </tr>
						  <tr>
						    <td colspan="3" height="15"></td>
						  </tr>
						</table>
						</form>
					  </td>
					</tr>
				  </table>
                  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td height="10"></td>
					</tr>
                    <tr>
                      <td height="1" background="../../../imagens/traco10.gif"></td>
                    </tr>
                  </table>
				</td>
              </tr>
            </table>
	      </td>
          <td width="10" align="right" background="../../../imagens/cantop7.gif">&nbsp;</td>
        </tr>
        <tr>
          <td width="10" height="10" align="left" valign="bottom" background="../../../imagens/cantom5.gif"><img src="../../../imagens/cantop4.gif" width="10" height="10" border="0"></td>
          <td height="10" background="../../../imagens/cantop6.gif" colspan="2"></td>
          <td width="10" height="10" align="right" valign="bottom" background="../../../imagens/cantom7.gif"><img src="../../../imagens/cantop3.gif" width="10" height="10" border="0"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php include("../../geral/info.php"); ?>
</body>
</html>
