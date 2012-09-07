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

include("../../../config/session.lib.aluno.php");

include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/usuario_bate_papo.php");
include("../../../classes/usuario.php");
include("../../../classes/perfil.php");

?>
<HTML>
<HEAD>
<title>Bate Papo - Lista de Usuários</title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</HEAD>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<BODY topmargin="0" leftmargin="0">
<table width="98%" cellpadding="0" cellspacing="0" class="tabelaMenu">
  <tr>
    <td>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="campos" align="left">Usuários</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<?php
			$cod_turma = $_SESSION["cod_sala"];
			
			$usuarios_bate_papo = new usuario_bate_papo();
			$usuarios_bate_papo->colecao($cod_turma);
			
			$total_usuarios = $usuarios_bate_papo->linhas;
			for ($i = 0; $i < $total_usuarios; $i++)
			{
				$cod_usuario = $usuarios_bate_papo->data["cod_usuario"];
				$situacao = $usuarios_bate_papo->data["situacao"];
				if ($situacao == "A")
				{
					$usuario = new usuario();
					$usuario->carregar($cod_usuario);
					
					$perfil = new perfil();
					$perfil->carregar($cod_usuario);
					$nome_usuario = $perfil->getApelido();
					
					if (empty($nome_usuario))
						$nome_usuario = $usuario->getNome();
						
					echo "<tr>";
					echo "  <td align=\"left\"><a href=\"#\" onClick=\"visualizarPerfil(".$cod_usuario.", '../perfil/')\">".$nome_usuario."</a></td>";
					echo "</tr>";
				}
				
				$usuarios_bate_papo->proximo();	
			}	
		?>
      </table>
    </td>
  </tr>
</table>
</BODY>
</HTML> 