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

if ($modulo == "inicial")
	include("../../config/session.lib.php");
else
	include("../../../config/session.lib.php");

$cod_usuario = $_SESSION["cod_usuario"];
$nome_usuario = $_SESSION["nome_usuario"];
$cod_instituicao = $_SESSION["cod_instituicao"];
$nome_instituicao = $_SESSION["nome_instituicao"];
$tipo_acesso = $_SESSION["tipo_acesso"];
$acao_instituicao = $_POST["acao_instituicao"];

if ($_SESSION["acesso"] == "A")
	$acesso = "Administrador do SA²pO";
else
	if ($_SESSION["acesso"] == "I")
		$acesso = "Administrador da Instituição";
			
switch($modulo)
{
	case "inicial":
		$dir_imagens = "../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = 'curso/index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = 'turma/index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = '../geral/suporte/index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = 'instituicao/index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = 'usuario/index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../login/logout.php'\"";
	break;
	
	case "instituicao":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../curso/index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = '../turma/index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = '../../../geral/suporte/index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = '../usuario/index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
	break;
	
	case "cursos":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = '../turma/index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = '../../../geral/suporte/index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = '../instituicao/index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = '../usuario/index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
	break;
	
	case "turmas":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../curso/index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = '../../geral/suporte/index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = '../instituicao/index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = '../usuario/index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
	break;
	
	case "usuarios":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = '../index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../curso/index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = '../turma/index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = '../../geral/suporte/index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = '../instituicao/index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
	break;
	
	case "suporte":
		$dir_imagens = "../../../imagens/";
		$link_inicial = "onClick=\"JavaScript: window.location.href = '../../pta/index.php'\"";
		$link_cursos = "onClick=\"JavaScript: window.location.href = '../../pta/curso/index.php'\"";
		$link_turmas = "onClick=\"JavaScript: window.location.href = '../../pta/turma/index.php'\"";
		$link_suporte = "onClick=\"JavaScript: window.location.href = 'index.php'\"";
		$link_inst = "onClick=\"JavaScript: window.location.href = '../../pta/instituicao/index.php'\"";
		$link_usuarios = "onClick=\"JavaScript: window.location.href = '../../pta/usuario/index.php'\"";
		$link_voltar = "onClick=\"JavaScript: window.location.href = '../../index.php'\"";
		$link_sair = "onClick=\"JavaScript: window.location.href = '../../../login/logout.php'\"";
	break;
}
?>
  <td id="td_menu_esquerdo" width="230" valign="top">
	<div id="menu_esquerdo">	  
	<table width="230" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="1" colspan="3" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
	  </tr>
	  <tr>
		<td width="155"><img src="<?php echo $dir_imagens; ?>cantof1.gif" width="155" height="30" border="0"></td>
		<td width="74" background="<?php echo $dir_imagens; ?>cantof5.gif" align="right"><a onClick="JavaScript: abaFerramentaParticipantes('ferramentas', '<?php echo $dir_imagens; ?>');" style="cursor: pointer"><img id="imagem_ferramentas" name="minimizar" title="Minimizar Ferramentas" src="<?php echo $dir_imagens; ?>outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
		<td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" width="1"></td>
	  </tr>
	  <tr>
		<td colspan="3">
			<table width="228" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
				<td width="228" background="<?php echo $dir_imagens; ?>cantof2.gif">
				  <div id="ferramentas">
				  <table width="228" border="0" cellspacing="0" cellpadding="0">
				  	<?php 
						if ($acao_instituicao != "novo")
						{
					?>
					<tr>
					  <td width="76" height="60" align="center"><a <?php echo $link_inicial; ?> onMouseOver="JavaScript: window.status = 'Página Inicial';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/inicial.gif" width="70" height="60" border="0"></a></td>
					  <td width="76" height="60" align="center"><a title="Dados Administrador" <?php echo $link_inst; ?> onMouseOver="JavaScript: window.status = 'Dados Administrador';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/dados_adm.gif" width="70" height="60" border="0"></a></td>
					  <td width="76" height="60" align="center"><a title="Dados Curso" <?php echo $link_cursos; ?> onMouseOver="JavaScript: window.status = 'Dados Curso';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/dados_curso.gif" width="70" height="60" border="0"></a></td>
					</tr>
					<tr>
					  <td width="76" height="60" align="center"><a title="Turmas" <?php echo $link_turmas; ?> onMouseOver="JavaScript: window.status = 'Turmas';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/turma.gif" width="70" height="60" border="0"></a></td>
					  <td width="76" height="60" align="center"><a title="Usuários" <?php echo $link_usuarios; ?> onMouseOver="JavaScript: window.status = 'Usuários';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/usuarios_curso.gif" width="70" height="60" border="0"></a></td>
					  <td width="76" height="60" align="center"><a title="Suporte" <?php echo $link_suporte; ?> onMouseOver="JavaScript: window.status = 'Suporte';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/suporte.gif" width="70" height="60" border="0"></a></td>
					</tr>
					<?php
						}
					?>
					<tr>
				      <td width="76" height="60" align="center"><a title="Voltar Tela de Instituições/Cursos" <?php echo $link_voltar; ?> onMouseOver="JavaScript: window.status = 'Voltar Tela de Instituições/Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/voltar_curso.gif" width="70" height="60" border="0"></a></td>		
					  <td width="76" height="60" align="center"><a <?php echo $link_sair; ?> onMouseOver="JavaScript: window.status = 'Sair';" onMouseOut="JavaScript: window.status = 'SA²pO Admin - Sistema de Apoio à Aprendizagem Online - Móudlo de Administração';" style="cursor: pointer" class="imagem"><img src="<?php echo $dir_imagens; ?>icones/sair.gif" width="70" height="60" border="0"></a></td>
					  <td width="76" height="60" align="center"></td>
					</tr>
				  </table> 
				  </div> 
				</td>
				<td width="1" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" width="1"></td>
			  </tr>
			  <tr>
				<td height="1" colspan="3" background="<?php echo $dir_imagens; ?>cantof3.gif"><img src="<?php echo $dir_imagens; ?>cantof3.gif" height="1"></td>
			  </tr>
		    <tr>
			  <td colspan="2" height="15"></td>
		    </tr>
			<tr>
			  <td colspan="2">
			    <table cellpadding="0" cellspacing="0" align="center">
				  <tr>
				    <td height="15" colspan="3"></td>
				  </tr>				  
				  <tr>
				    <td class="preto" align="right" valign="top">Usuário:</td>
				    <td width="5"></td>
				    <td class="vermelho"><?php echo $nome_usuario; ?></td>
				  </tr>
				  <tr>
				    <td class="preto" align="right" valign="top">Acesso:</td>
				    <td width="5"></td>
				    <td class="vermelho"><?php echo $acesso; ?></td>
				  </tr>
				  <tr>
				    <td class="preto" width="50" align="right" valign="top">Instituição:</td>
				    <td width="5"></td>
				    <td class="vermelho"><?php echo $nome_instituicao ?></td>
				  </tr>
				  <?php
				  	if (isset($_SESSION["nome_curso"]))
					{
						$nome_curso = $_SESSION["nome_curso"];
				  ?>
				  <tr>
				    <td class="preto" width="50" align="right" valign="top">Curso:</td>
				    <td width="5"></td>
				    <td class="vermelho"><?php echo $nome_curso; ?></td>
				  </tr>
				  <?php
				  	}
				  ?>
				  
			    </table>
			  </td>
			</tr>
		  </table>
		</td>
	  </tr>
	</table>
	</div>
	<div id="menu_esquerdo_escondido" style="display: none">
	<table width="40" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="20">	           
		  <table width="100%" height="100" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			  <td><img src="<?php echo $dir_imagens; ?>login_instituicao.gif" width="34" height="200" onClick="JavaScript: abas('menu_esquerdo_escondido');"></td>
			</tr>
		  </table>
		</td>
	  </tr>
	</table>
	</div>
  </td>