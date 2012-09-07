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
include("../../../funcoes/funcoes.php");

?>
<HTML>
<HEAD>
<title>Bate Papo - Envia Mensagem</title>
</HEAD>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<BODY topmargin="0" leftmargin="0" onLoad="JavaScript: document.insere_mensagem_bate_papo.mensagem_bate_papo.focus();">
<table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#99CC66">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td>
      <form action="insere.php" method="post" name="insere_mensagem_bate_papo">
      <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
		  <td width="5">&nbsp;</td>
		  <td width="140">
		    <select name="modo_mensagem">
			  <option value="fala com" <?php if ($_SESSION["modo_mensagem"] == "fala com") echo "selected"; ?>>fala com</option>
			  <option value="recebe apenas de" <?php if ($_SESSION["modo_mensagem"] == "recebe apenas de") echo "selected"; ?>>recebe apenas de</option>
			  <option value="ver recados para mim" <?php if ($_SESSION["modo_mensagem"] == "ver recados para mim") echo "selected"; ?>>ver recados para mim</option>
			  <option value="voltar papo normal" <?php if ($_SESSION["modo_mensagem"] == "voltar papo normal") echo "selected"; ?>>voltar papo normal</option>
			  <option value="ignora" <?php if ($_SESSION["modo_mensagem"] == "ignora") echo "selected"; ?>>ignora</option>
			  <option value="aceita" <?php if ($_SESSION["modo_mensagem"] == "aceita") echo "selected"; ?>>aceita</option>
			  <option value="grita com" <?php if ($_SESSION["modo_mensagem"] == "grita com") echo "selected"; ?>>grita com</option>
			  <option value="murmura para" <?php if ($_SESSION["modo_mensagem"] == "murmura para") echo "selected"; ?>>murmura para</option>
			  <option value="pergunta para" <?php if ($_SESSION["modo_mensagem"] == "pergunta para") echo "selected"; ?>>pergunta para</option>
			  <option value="responde para" <?php if ($_SESSION["modo_mensagem"] == "responde para") echo "selected"; ?>>responde para</option>
			  <option value="sorri para" <?php if ($_SESSION["modo_mensagem"] == "sorri para") echo "selected"; ?>>sorri para</option>
			  <option value="flerta com" <?php if ($_SESSION["modo_mensagem"] == "flerta com") echo "selected"; ?>>flerta com</option>
			  <option value="discorda de" <?php if ($_SESSION["modo_mensagem"] == "discorda de") echo "selected"; ?>>discorda de</option>
			  <option value="concorda com" <?php if ($_SESSION["modo_mensagem"] == "concorda com") echo "selected"; ?>>concorda com</option>
			  <option value="surpreende-se com" <?php if ($_SESSION["modo_mensagem"] == "surpreende-se com") echo "selected"; ?>>surpreende-se com</option>
			</select>
		  </td>
		  <td width="5">&nbsp;</td>
		  <td width="80">
	        <select size="1" name="destinatario">
			<option value="0" selected>Todos</option>
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
						$apelido = $perfil->getApelido();
						
						if (trim($apelido) == "")
							$apelido = $usuario->getNome();
							
						$apelido = reduzTexto($apelido, 15);
							
						if (($_SESSION["destinatario"] == $cod_usuario) and ($_SESSION["cod_usuario"] != $cod_usuario))
							echo "<option value=\"".$cod_usuario."\" selected>".$apelido."</option>";
						else
							if ($_SESSION["cod_usuario"] != $cod_usuario)
								echo "<option value=\"".$cod_usuario."\">".$apelido."</option>";
					}
					
					$usuarios_bate_papo->proximo();	
				}	
			?>
            </select>
          </td>
		  <td width="5">&nbsp;</td>
		  <td width="30"><a onClick="javascript: window.open('smilies.php','','width=100,height=245,scrollbars=yes')" onMouseOver="JavaScript: window.status = 'Smilies Bate Papo';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_verde">Smilies</a></td>
		  <td width="5">&nbsp;</td>
		  <td width="140"><input type="text" size="40" name="mensagem_bate_papo" id="cadastra_mensagem_bate_papo" value=""></td>
		  <td width="5">&nbsp;</td>
		  <td width="50"><input type="submit" name="envia" value="Enviar"></td>
		  <td>&nbsp;</td>
        </tr>
		<tr>
		  <td colspan="11" height="10"></td>
		</tr>
		<tr>
		  <td colspan="11">
		    <table width="100%" cellpadding="0" cellspacing="0">
			  <tr>
			    <td width="5">&nbsp;</td>
				<td width="90" class="preto_simples"><input type="checkbox" name="bate_papo_reservado" value="reservado" <?php if ($_SESSION["reservado"] == "S") echo "checked"; ?>>Reservado</td>
				<td width="10">&nbsp;</td>
		  		<td width="80" class="preto_simples"><input type="checkbox" name="bate_papo_rolagem" value="rolagem" <?php if ($_SESSION["rolagem"] == "S") echo "checked"; ?>>Rolagem</td>
		  		<!--<td width="10">&nbsp;</td>
				<td width="80"><input type="button" name="atualizar" value="Atualizar Usuários"></td>-->
				<td width="10">&nbsp;</td>
				<td><input type="button" name="saiBatePapo" value="Sair" onClick="JavaScript: sairBatePapo();"></td>
			  </tr>
			</table>
		  </td>
		</tr>
      </table>
      </form>
    </td>
  </tr>
</table>
</BODY>
</HTML> 