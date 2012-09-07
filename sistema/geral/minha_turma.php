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

include("../../config/session.lib.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/curso.php");
include("../../classes/turma.php");
include("../../classes/perfil.php");
include("../../classes/usuario.php");
include("../../classes/usuario_online.php");
include("../../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];
$cod_curso = $_SESSION["cod_curso"];
$nome_usuario = $_SESSION["nome_usuario"];
$nome_curso = $_SESSION["nome_curso"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$tipo_acesso = $_SESSION["tipo_acesso"];
$modulo = "minha_turma";
$url_ordena = "";

if ($_GET["tipo_usuario"])
	$tipo_usuario = $_GET["tipo_usuario"];
else
	if ($_POST["tipo_usuario"])
		$tipo_usuario = $_POST["tipo_usuario"];
	else
	{
		if (isset($_SESSION["turma_cat_lst"]))
			$tipo_usuario = $_SESSION["turma_cat_lst"];
		else
			$tipo_usuario = "L";
	}

if ($_GET["pag"])
	$pagina = $_GET["pag"];
else
	if ($_POST["pag"])
		$pagina = $_POST["pag"];
	else
		$pagina = 1;
	

if ($_GET["qtd"])
	$limite = $_GET["qtd"];
else
	if ($_POST["qtd"])
		$limite = $_POST["qtd"];
	else
	{
		if (isset($_SESSION["turma_qtd_lst"]))
			$limite = $_SESSION["turma_qtd_lst"];
		else
			$limite = 10;
	}

if ($_GET["ordem"]) 
	$ordem = $_GET["ordem"];
else
	if ($_POST["ordem"])
		$ordem = $_POST["ordem"];
	else
	{
		if (isset($_SESSION["turma_ordem"]))
			$ordem = $_SESSION["turma_ordem"];
		else		
			$ordem = 1;
	}

if ($_GET["acessou"])
	$acessou = $_GET["acessou"];
else
	if ($_POST["acessou"])
		$acessou = $_POST["acessou"];
	else
		$acessou = "";
	
$url_ordena = "minha_turma.php?pag=".$pagina."&ordem=".$ordem."&qtd=".$limite."&acessou=".$acessou."&tipo_usuario=".$tipo_usuario;

$participantes = new usuario();
$participantes->colecaoUsuarioTurma($cod_turma, $tipo_usuario, $acessou);
$total_participantes = $participantes->linhas;

$inicio = $pagina - 1;
$inicio = $inicio * $limite;
$url = "minha_turma.php?ordem=".$ordem."&tipo_usuario=".$tipo_usuario."&acessou=".$acessou;

$participantes->paginacao($cod_turma, $tipo_usuario, $limite, $inicio, $ordem, $acessou);
$qtd_listagem = $participantes->linhas;
//Fim Código		
		
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SA&sup2;pO</title>
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

</head>

<script language="JavaScript" src="../../funcoes/funcoes.js"></script>

<body topmargin="0" leftmargin="0">
<?php include("topo.php"); ?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10"><img src="../../imagens/cantoA7.gif" height="10" width="10" border="0"></td>
    <td width="230" height="10" bgcolor="#FCFFEE"></td>
    <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
    <td width="100%" height="10" background="../../imagens/cantoA12.gif" valign="bottom"></td>
    <td width="10" valign="bottom" background="../../imagens/cantoA10.gif" height="10"><img src="../../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
    <td height="100%" colspan="3" valign="top" id="td_linha_menu_esquerdo">
	  <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FCFFEE" style="overflow:auto">
	    <tr>
		  <td width="10" background="../../imagens/cantoA7.gif" valign="top">&nbsp;</td>
		    <?php include("ferramentas.php"); ?>
		  <td width="10" valign="top" background="../../imagens/cantoA8.gif">&nbsp;</td>
		</tr>
		<tr>
          <td width="10" background="../../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" background="../../imagens/cantoA9.gif"></td>
          <td width="10" background="../../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
	  </table>
	</td>
	<td colspan="2" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../imagens/cantor10.gif"><img src="../../imagens/cantor1.gif" width="10" height="10" border="0"></td>
		<td width="301" height="52" rowspan="2" bgcolor="#FFC66F"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="3" bgcolor="#FFFFFF"></td>
			</tr>
			<tr>
			  <td><img src="../../imagens/icones/turma/titulo_colegas_tuma.gif" width="250" height="52"></td>
			</tr>
		</table></td>
		<td height="10" background="../../imagens/cantor8.gif" width="436" valign="top"></td>
		<td width="10" height="10" align="right" valign="top" background="../../imagens/cantor7.gif"><img src="../../imagens/cantor2.gif" width="10" height="10" border="0"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="top" background="../../imagens/cantor10.gif"></td>
		<td height="42" bgcolor="#FFDFAE" width="100%"></td>
		<td width="10" background="../../imagens/cantor7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" background="../../imagens/cantor5.gif"></td>
		<td colspan="2" bgcolor=""><table width="100%" border="0" cellpadding="1" cellspacing="2" bgcolor="#FFDFAE">
			<tr>
			  <td width="100%" bgcolor="#FFDFAE">
				<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				  <tr>
					<td height="10"></td>
				  </tr>
				</table>
				<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td>
					  <table width="100%" cellpadding="0" cellspacing="0">
						<tr> 
						  <td colspan="9" class="laranja"><a name="topo"></a><?php if ($tipo_usuario == "L") echo "Alunos"; else if ($tipo_usuario == "T") echo "Totures"; else if ($tipo_usuario == "S") echo "Suporte"; ?></td>
						</tr>
						<tr>
						<td colspan="9" align="right">
						  <table width="100%" border="0" cellpadding="0" cellspacing="0">
							<form name="ordena_minha_turma" action="minha_turma.php" method="post">
							<tr>
							  <td align="right" class="campos">Listagem</td>
							  <td width="10">&nbsp;</td>
							  <td width="50">
								<select name="qtd" onChange="JavaScript: document.ordena_minha_turma.submit();">
								  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
								  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
								  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
								  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
								  <option value="T" <?php if ($limite == "T") echo "selected"; ?>>Todos</option>
								</select>
							  </td>
							  <td width="10">&nbsp;</td>
							  <td width="70" class="preto" align="right">Categoria</td>
							  <td width="10">&nbsp;</td>
							  <td width="50">
								<select name="tipo_usuario" onChange="JavaScript: document.ordena_minha_turma.submit();">
								  <option value="L" <?php if ($tipo_usuario == "L") echo "selected"; ?>>Aluno</option>
								  <option value="T" <?php if ($tipo_usuario == "T") echo "selected"; ?>>Tutor</option>
								  <option value="S" <?php if ($tipo_usuario == "S") echo "selected"; ?>>Suporte</option>
								  <?php
								  	if ($tipo_acesso != "aluno")
									{
								  ?>
								  <option value="P" <?php if ($tipo_usuario == "P") echo "selected"; ?>>Supervisor</option>
								  <?php
									}
								  ?>
								  <option value="Q" <?php if ($tipo_usuario == "Q") echo "selected"; ?>>Todos</option>
								</select>
							  </td>
							  <?php
								if ($tipo_acesso != "aluno")
								{
							  ?>
							  <td width="10">&nbsp;</td>
							  <td width="70" class="preto" align="right">Acessou?</td>
							  <td width="10">&nbsp;</td>
							  <td width="50">
								<select name="acessou" onChange="JavaScript: document.ordena_minha_turma.submit();">
								  <option value="" selected></option>
								  <option value="S" <?php if ($acessou == "S") echo "selected"; ?>>Sim</option>
								  <option value="N" <?php if ($acessou == "N") echo "selected"; ?>>Não</option>
								</select>
							  </td>
							  <?php
								}
							  ?>
							</tr>
							</form>
						  </table>
						</td>
					  </tr>
					<?php			
					if ($total_participantes > 0)
					{
					?>
					  <tr>
					    <td colspan="9" height="15"></td>
					  </tr>
					  	<tr class="laranja_linha_3"> 
						  <td width="10">&nbsp;</td>
						  <td align="left" class="preto">Foto</td>
						  <td width="10">&nbsp;</td>
						  <td align="left" class="preto">Nome&nbsp;&nbsp;
						  <?php 
							if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=2";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=1";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Decrescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=2";
								echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
							}
						  ?>
						  </td>
						  <td width="10">&nbsp;</td>
						  <td align="center" class="preto">Último Acesso</td>
						  <td width="10">&nbsp;</td>
						  <td align="center" class="preto">Cidade / Estado</td>
						  <?php
						  	if ($tipo_acesso != "aluno")
							{
						  ?>
						  <td align="center" class="preto">Acessos&nbsp;&nbsp;
						  <?php 
							if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Decrescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 2: 
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 3:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 4:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
									
									case 5:
										$url_ordena.= "&ordem=6";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Decrescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
									break;
									
									case 6:
										$url_ordena.= "&ordem=5";
										echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Crescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Crescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar.gif\" border=\"0\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordena.= "&ordem=5";
								echo "<a onClick=\"JavaScript: window.location.href='".$url_ordena."'\" title=\"Ordem Decrescente por Total de Acessos\" onMouseOver=\"JavaScript: window.status = 'Ordem Decrescente por Total de Acessos';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\"><img src=\"../../imagens/outros/seta_ordenar_1.gif\" border=\"0\"></a>";
							}
						  ?>
						  </td>
						  <?php
						  	}
						  ?>
						</tr>
					<?php
						$cor_fundo = "laranja_linha_3";
						$total = 0;
						
						$procura_coord = new usuario();
						$procura_coord->colecaoUsuarioTurma($cod_turma, "C", "");
						$total_coord = $procura_coord->linhas;
						
						if (($tipo_acesso == "aluno") and ($total_coord > 0))
							$total_listagem = $total_participantes - 1;
						else
							$total_listagem = $total_participantes;
						
						for ($i = 0; $i < $qtd_listagem; $i++)
						{
							$cod_participante = $participantes->data["cod_usuario"];
							$acesso_usuario = $participantes->data["acesso"];
							$total_visitas = $participantes->data["visitas"];
							$usuario = new usuario();
							$usuario->carregar($cod_participante);
						
							$nome = $usuario->getNome();
							$usuario->verificaAcesso($cod_participante, $cod_turma, $acesso_usuario);
							
							if (($acesso_usuario != "C") and ($tipo_acesso == "aluno"))
							{
								$total++;
							}
							else
							 	if ($tipo_acesso != "aluno")
								{
									$total++;
								}
								
							$data_acesso = $usuario->data["data_visita"];
							$hora_acesso = $usuario->data["hora_visita"];
							
							if (($data_acesso == "0000-00-00") or (empty($data_acesso)))
							{
								$data_acesso = "-";
								$hora_acesso = "";
							}
							else
							{
								$data_acesso = formataData($data_acesso, "/");
								$hora_acesso = substr($hora_acesso, 0, 5);
							}
							
							$perfil = new perfil();
							$perfil->carregar($cod_participante);
							$cod_perfil = $perfil->getCodigo();
							
							if (!empty($cod_perfil))
							{
								$foto_participante = $perfil->getFoto();
								$miniatura_participante = $perfil->getMiniatura();
								$cidade_participante = $perfil->getCidade();
								$uf_participante = $perfil->getUF();
								
								if (empty($cidade_participante))
									$cidade_participante = "Não Informado";
								
								if (empty($uf_participante))
									$uf_participante = "Não Informado";
								else
									$uf_participante = ufExtenso($uf_participante);
								$dir_perfil_participante = $cod_participante;
								
								if (($foto_participante != _SEM_FOTO) and (!empty($foto_participante)))
								{
									//Diretório dos Arquivos
									if (!empty($miniatura_participante))
									{
										$total_caracteres = strlen($miniatura_participante);
										$miniatura_participante_ = "";
					
										for($x = 0; $x < $total_caracteres; $x++)
											$miniatura_participante_.= substituiCaracter($miniatura_participante[$x], "link");
										
										$arquivo_participante_ = "../../arquivos/perfil/".$dir_perfil_participante."/".$miniatura_participante;
										$arquivo_participante = "../../arquivos/perfil/".$dir_perfil_participante."/".$miniatura_participante_;
										$foto_g_participante = "../../arquivos/perfil/".$dir_perfil_participante."/".$foto_participante;
										
										if ((file_exists($arquivo_participante_)) and (file_exists($foto_g_participante)))
										{	
											$dimensoes = dimensoesImagem($foto_g_participante, 40);
											$dimensoes = explode(".", $dimensoes);
											$largura_participante = $dimensoes[0];
											$altura_participante = $dimensoes[1];
											$link_participante = "JavaScript: janela('Foto','".$foto_g_participante."' ,100 ,100 ,".$largura_participante." ,".$altura_participante." ,0 ,0 ,0 ,1 ,1);";
										}
										else
										{
											$arquivo_participante = "../../imagens/"._SEM_FOTO;
											$link_participante = "";
										}
									}
								}
								else
									$arquivo_participante = "../../imagens/"._SEM_FOTO;
							}
							else
							{
								$arquivo_participante = "../../imagens/"._SEM_FOTO;
								$link_participante = "";
								$cidade_participante = "Não Informado";
								$uf_participante = "Não Informado";
							}
							
							/*$busca = $oUsers->searchIT("", $cod_usuario, 1);
							if (count($busca) > 0)
								$logado = "OnLine";
							else
								$logado = "OffLine";*/
													
							if (($tipo_acesso == "aluno") and ($acesso_usuario != "C"))
							{
								if ($cor_fundo == "laranja_linha_3")
									$cor_fundo = "laranja_linha_4";
								else
									$cor_fundo = "laranja_linha_3";
					?>
						<tr class="<?php echo $cor_fundo; ?>">
						  <td colspan="9" height="10"></td>
						</tr>
						<tr class="<?php echo $cor_fundo; ?>"> 
						  <td width="10">&nbsp;</td>
						  <td width="70" align="center"><a onClick="<?php echo $link_participante; ?>" onMouseOver="JavaScript: window.status = 'Visualizar Foto';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><img src="<?php echo $arquivo_participante; ?>" width="64" height="57" border="0"></a></td>
						  <td width="10">&nbsp;</td>
						  <td class="preto" align="left"><a onClick="JavaScript: visualizarPerfil(<?php echo $cod_participante; ?>);" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_laranja"><?php echo $nome; ?></a></td>
						  <td width="10">&nbsp;</td>
						  <td class="laranja_simples" align="center"><?php echo $data_acesso." ".$hora_acesso; ?></td>
						  <td width="10">&nbsp;</td>
						  <td class="laranja_simples" align="center"><?php echo $cidade_participante." / ". $uf_participante; ?></td>
						  <?php
						  	if ($tipo_acesso != "aluno")
							{
						  ?>
						  <td class="laranja_simples" align="center"><?php echo $total_visitas; ?></td>
						  <?php
						  	}
						  ?>
						</tr>
				   <?php	
				   			}
							else
							{
								if ($cor_fundo == "laranja_linha_3")
									$cor_fundo = "laranja_linha_4";
								else
									$cor_fundo = "laranja_linha_3";
					?>
						<tr class="<?php echo $cor_fundo; ?>">
						  <td colspan="9" height="10"></td>
						</tr>
						<tr class="<?php echo $cor_fundo; ?>"> 
						  <td width="10">&nbsp;</td>
						  <td width="70" align="center"><a onClick="<?php echo $link_participante; ?>" onMouseOver="JavaScript: window.status = 'Visualizar Foto';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><img src="<?php echo $arquivo_participante; ?>" width="64" height="57" border="0"></a></td>
						  <td width="10">&nbsp;</td>
						  <td class="preto" align="left"><a onClick="JavaScript: visualizarPerfil(<?php echo $cod_participante; ?>);" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_laranja"><?php echo $nome; ?></a></td>
						  <td width="10">&nbsp;</td>
						  <td class="laranja_simples" align="center"><?php echo $data_acesso." ".$hora_acesso; ?></td>
						  <td width="10">&nbsp;</td>
						  <td class="laranja_simples" align="center"><?php echo $cidade_participante." / ". $uf_participante; ?></td>
						  <?php
						  	if ($tipo_acesso != "aluno")
							{
						  ?>
						  <td class="laranja_simples" align="center"><?php echo $total_visitas; ?></td>
						  <?php
						  	}
						  ?>
						</tr>
				   <?php	
							}
							
				   			if (($i + 1) <= $total_participantes)
							{
							
					?>
						<tr class="<?php echo $cor_fundo; ?>">
						  <td colspan="9" height="10"></td>
						</tr>
					<?php
							}
							
							$participantes->proximo();
						}
					?>
				  <tr>
				    <td colspan="9" height="10"></td>
				  </tr>
				  <tr>
				    <td colspan="9" align="right"><a href="#topo"  onMouseOver="JavaScript: window.status = 'Voltar ao Topo deste página';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_laranja">Voltar ao Topo desta página</a></td>
				  </tr>
				  <tr>
					<td colspan="9">
					  <table width="100%" cellpadding="0" cellspacing="0">
					  	<tr>
						  <td colspan="3" height="10"></td>
						</tr>
						<tr>
						  <td colspan="2"><?php if ($limite == "T") { ?><font class="preto">Página&nbsp;&nbsp;&nbsp;</font><font class="vermelho">1</font><?php } else echo paginacao($pagina, $inicio, $limite, $total_participantes, $url, true, "link_azul"); ?></td>
						  <td align="right"><font class="preto">Total&nbsp;&nbsp;&nbsp;</font><font class="vermelho"><?php echo $total."/"; ?></font><font class="preto"><?php echo $total_listagem; ?></font></td>
						</tr>
					  </table>
					</td>
				  </tr>
				  <?php
					}
					else
					{
				  ?>	
				  <tr>
					<td class="laranja" colspan="9">Nenhum Usuário "<?php if ($tipo_usuario == "L") echo "Alunos"; else if ($tipo_usuario == "T") echo "Totures"; else if ($tipo_usuario == "S") echo "Suporte"; ?>" encontrado nesta Turma</td>
				  </tr>
				  <?php
				  	}
				  ?>
				  <tr>
					<td height="15" colspan="9">
					  <form name="perfil_participante" method="post" action="perfil_usuario.php">
					    <input type="hidden" name="cod_participante">
						<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
						<input type="hidden" name="ordem" value="<?php echo $ordem; ?>">
						<input type="hidden" name="quantidade" value="<?php echo $limite; ?>">
						<input type="hidden" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>">
						<input type="hidden" name="acao_voltar" value="minha_turma">
 				      </form>
					</td>
				  </tr>
				  </table>
					</td>
				  </tr>
				</table>
				<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="10"></td>
				  </tr>
				  <tr>
					<td height="1" background="../../imagens/traco12.gif"><img src="../../imagens/traco12.gif" border="0" height="1"></td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td width="10" align="right" background="../../imagens/cantor7.gif"></td>
	  </tr>
	  <tr>
		<td width="10" height="10" align="left" valign="bottom" background="../../imagens/cantor5.gif"><img src="../../imagens/cantor4.gif" width="10" height="10" border="0"></td>
		<td height="10" background="../../imagens/cantor6.gif" colspan="2"></td>
		<td width="10" height="10" align="right" valign="bottom" background="../../imagens/cantor7.gif"><img src="../../imagens/cantor3.gif" width="10" height="10" border="0"></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<?php include("info.php"); ?>
</body>
</html>
