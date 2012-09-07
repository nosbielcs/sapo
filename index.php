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

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="author" content="SA²pO">
<meta name="copyright" content="Copyright © 2005-2006 Fundação Ecumênica de Proteção ao Excepcional. Todos os direitos reservados.">
<meta name="keywords" content="SA²pO">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<title>SA²pO</title>
<link href="config/estilo.css" rel="stylesheet" type="text/css">
<link type="image/x-icon" rel="SHORTCUT ICON" href="http://www.fepe2005.net/site/images/icones/fepe_16.ico">

</head>

<script type="text/javascript" src="funcoes/funcoes.js"></script>

<title>SA²pO</title>
	
<body onload="document.login_sistema.login.focus()">

<table align="center" bgcolor="#f1f3f3" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  <tr>
    <td align="center" valign="middle">   
	  <table height="405" width="760" align="center" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td>
		<map name="MapMap"><area shape="rect" coords="14,18,150,148" href="http://www.fepe.org.br" target="_blank"></map>
		<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="15" height="405" width="760">
		  <tr>
			<td height="395">
			  <table border="0" cellpadding="0" cellspacing="0" width="744">
				<tr>
				  <td colspan="2"><img src="imagens/login/logo.jpg" usemap="#MapMap" href="http://www.sp.senac.br/" border="0" height="204" hspace="1" width="746"></td>
				</tr>
				<tr>
				  <td valign="top" width="482"><img src="imagens/login/mensagem.jpg" usemap="#Map" href="http://www.nead.fepe.org.br/" border="0" height="197" hspace="1" width="482">
					<map name="Map">
					  <area shape="RECT" target="_blank" coords="201,172,455,191" href="http://www.nead.fepe.org.br">
					</map>
				  </td>
				  <td height="192" valign="top" width="266">
				  <!-- Formulário de login vai aqui. -->
					<table>
					  <tr>
						<td>
							<table bgcolor="#f0f0f0" border="0" cellpadding="0" cellspacing="0">
							<tr>
							  <td class="preto" bgcolor="#cccccc" height="20" valign="midle">&nbsp;&nbsp;&nbsp;Sala de aula virtual</td>
							</tr>
							<tr>
							  <td>
								<table border="0" cellpadding="0" cellspacing="6" width="100%">
								  <form action="login/login.php" method="post" name="login_sistema" target="_parent">
								  <tr>
									<td align="left" valign="top" class="login_simples">Digite seu usuário e senha abaixo e clique no botão de login.
									</td>
								  </tr>
								  <tr>
									<td align="left">
									  <table width="100%" cellpadding="0" cellspacing="0">
										<tr>
										  <td class="login_simples">usuário:</td>
										</tr>
										<tr>
										  <td><input tabindex="1" type="text" name="login" size="25" maxlength="40" OnKeyPress="JavaScript: return trocarCampo(event);"></td>
										</tr>
									  </table>
									</td>
								  </tr>
								  <tr>
									<td align="left">
									  <table width="100%" cellpadding="0" cellspacing="0">
										<tr>
										  <td class="login_simples">senha:</td>
										</tr>
										<tr>
										  <td><input tabindex="2" type="password" name="senha" size="25" maxlength="15" OnKeyPress="JavaScript: return validaLogin(event);"></td>
										</tr>
									  </table>
									</td>
								  </tr>
								  <tr>
									<td align="center" height="15" class="vermelho_simples"><?php if (isset($_SESSION["erro_login"])) echo "Login e/ou Senha inválido(s)"; ?></td>
								  </tr>
								  <tr>
									<td>
									  <table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
										  <td align="left" valign="top"><a onClick="JavaScript: window.location.href = 'recupera_senha.php'" style="cursor: pointer" class="link_login">Esqueceu a sua senha?</a></td>
										  <td align="right"><img src="imagens/login/botao_login.gif" onClick="JavaScript: efetuarLogin();" style="cursor: pointer" border="0"></td>
										</tr>
									  </table>
									</td>
								  </tr>
								  </form>
								</table>
							  </td>
							</tr>
						  </table>
						</td>
					  </tr>
					</table>
				  <!-- Formulário de login termina aqui. -->
				  </td>
				</tr>
			</table>
		  </td>
		</tr>
		</table>
		</td>
	  </tr>
	  <tr>
		<td height="10"></td>
	  </tr>
	  <tr>
		<td align="center" class="login_simples">Área de acesso exclusiva aos alunos, professores e colaboradores da FEPE - Curitiba | PR.</td>
	  </tr>
	  <tr>
		<td align="center" class="login_simples">© 2006&nbsp;-&nbsp;Núcleo de Educação a Distância&nbsp;|&nbsp;Funda&ccedil;&atilde;o Ecum&ecirc;nica de Prote&ccedil;&atilde;o ao Excepcional&nbsp;-&nbsp;Todos os direitos Reservados</td>
	  </tr>
	  </table>
    </td>
  </tr>
</table>

</body>
</html>
<?php
	session_unset();
	session_destroy();
?>