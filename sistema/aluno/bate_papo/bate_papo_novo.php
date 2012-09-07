<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body topmargin="0" leftmargin="0">
	<div align="center" style="padding:5px; width:100%; height:100%;">
		<div align="left" style="padding:5px; width:95%; height:70%; overflow:scroll; background-color:#F8F8F8; color:#999999" id="mensagens"></div>
		<div id="form_mensagem" style="padding:5px; width:98%; height:30%;">
		<table width="99%" cellpadding="0" cellspacing="0" border="0">
		  <tr>
			<td>&nbsp;</td>
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
								$nome_usuario = $usuario->getNome();
								if (($_SESSION["destinatario"] == $cod_usuario) and ($_SESSION["cod_usuario"] != $cod_usuario))
									echo "<option value=\"".$cod_usuario."\" selected>".$nome_usuario."</option>";
								else
									if ($_SESSION["cod_usuario"] != $cod_usuario)
										echo "<option value=\"".$cod_usuario."\">".$nome_usuario."</option>";
							}
							
							$usuarios_bate_papo->proximo();	
						}	
					?>
					</select>
				  </td>
				  <td width="5">&nbsp;</td>
				  <td width="140"><input type="text" size="40" name="mensagem_bate_papo" value=""></td>
				  <td width="5">&nbsp;</td>
				  <td width="50"><input type="button" name="envia" value="Enviar" onClick="JavaScript: document.insere_mensagem_bate_papo.submit();"></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="9">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="9">
					<table width="100%" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="5">&nbsp;</td>
						<td width="90" class="conteudoTextoBold"><input type="checkbox" name="bate_papo_reservado" value="reservado" <?php if ($_SESSION["reservado"] == "S") echo "checked"; ?>>Reservado</td>
						<td width="10">&nbsp;</td>
						<td width="80" class="conteudoTextoBold"><input type="checkbox" name="bate_papo_rolagem" value="rolagem" <?php if ($_SESSION["rolagem"] == "S") echo "checked"; ?>>Rolagem</td>
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
		</div>
	</div>
</body>
</html>
