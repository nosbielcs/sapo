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
include("../../../classes/usuario.php");
include("../../../classes/curso.php");
include("../../../classes/turma.php");
include("../../../classes/recado.php");
include("../../../funcoes/funcoes.php");

//Código do Usuário
$cod_usuario = $_SESSION["cod_usuario"];
//Instancia Objeto usuario
$tutor = new usuario();
//Carrega informações do Usuário
$tutor->carregar($cod_usuario);
//Função que carrega o nome do Usuário
$nomeTutor = $tutor->getNome();

//echo "Seja Bem Vindo ".$nomeTutor." ao espaço do Tutor do Sistema de Educação a Distância SA²PO<br>";
//Carrega o Total de Turmas do Usuário
$tutor->turmas($cod_usuario);
$qtde_turmas = $tutor->linhas;

$cod_turma = $_SESSION["cod_turma"];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>::SA²pO::</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</HEAD>

<script language="JavaScript" src="../../funcoes/funcoes.js"></script>

<BODY leftMargin"="0 topMargin="0" onLoad="relogio();">
<TABLE cellSpacing="0" cellPadding="0" width="100%" background="../../imagens/bg_top.gif" border="0">
  <TBODY>
    <TR> 
      <TD width="0%"><img src="../../imagens/logo_sapo.gif" width="130" height="43"></TD>
      <TD align=right width="0%"><a href="../perfil/index.php"><img src="../../imagens/ico_top_perfil.gif" width="62" height="43" border="0"></a><a href="../edital/index.php"><img src="../../imagens/ico_top_edital.gif" width="62" height="43" border="0"></a><a href="../agenda/index.php"><img src="../../imagens/ico_top_agenda.gif" width="62" height="43" border="0"></a><a href="index.php"><img src="../../imagens/ico_top_recados.gif" width="62" height="43" border="0"></a><a href=""><img src="../../imagens/ico_top_conteudo.gif" width="62" height="43" border="0"></a><a href="../atividade/index.php"><img src="../../imagens/ico_top_avaliacao.gif" width="62" height="43" border="0"></a><a href=""><img src="../../imagens/ico_top_batepapo.gif" width="62" height="43" border="0"></a><a href="../forum/index.php"><img src="../../imagens/ico_top_forum.gif" width="62" height="43" border="0"></a>
        <!--<a href=""><img src="../../imagens/ico_top_colabora.gif" width="62" height="43" border="0" alt="PERFIL"></a>-->
        <a href="../../../login/logout.php"><img src="../../imagens/ico_top_sair.gif" width="62" height="43" border="0" alt="SAIR"></a></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE cellSpacing="0" cellPadding="0" width="100%" bgColor="#3eb1d5" border="0">
  <TBODY>
    <TR><form name="escolhe_turma" action="../../redireciona_usuario.php" target="_parent" method="post"> 
      <TD width="20%"><a href="../../index.php"><IMG height="20" alt="Página principal" src="../../imagens/back_home.gif" width="126" border="0"></a></TD>
        <TD width="20%"> <input name="mostraHora" type="text" readonly="true" size="6" class="relogio"> 
        </TD>
        <TD noWrap width="5%"></TD>
        <TD vAlign=top noWrap width="5%"></TD>
        <TD width="50%" align="right"> <font class="pazul"><strong>Cursos</strong></font> 
          <?php
			echo "<select name='cod_turma' onChange=\"document.escolhe_turma.submit();\">";
									
			for ($i=0; $i<$qtde_turmas; $i++)
			{	
				$turma = new turma();
				$turma->carregar($tutor->data['cod_turma']);
				
				$acesso = $usuario->data["acesso"];
				if ($acesso != "A")
				{
					if ($_SESSION["cod_turma"] == $turma->data["cod_turma"])
						echo "<option value='".$turma->data['cod_turma']."|".$tutor->data["acesso"]."' selected>".$turma->data['descricao']."</option>";
					else
						echo "<option value='".$turma->data['cod_turma']."|".$tutor->data["acesso"]."'>".$turma->data['descricao']."</option>";
				}
				
				$tutor->proximo();
			}
			
			echo "</select>";				
		?>
        </TD>
      </form>
    </TR>
    <TR> 
      <TD bgColor=#000000 colSpan="5"></TD>
    </TR>
  </TBODY>
</TABLE>
</BODY>
</HTML>
