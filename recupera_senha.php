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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" src="funcoes/funcoes.js"></script>

</head>

<title>SA²pO</title>
	
<body topmargin="0" leftmargin="0" bottommargin="0" rightmargin="0" onload="document.login_sistema.login.focus()">

<table align="center" bgcolor="#f1f3f3" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  <tr>
    <td align="center" valign="middle">   
	<table align="center" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td align="center" valign="middle">
		<map name="MapMap"><area shape="rect" coords="14,18,150,148" href="http://www.fepe.org.br" target="_blank"></map>
		<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="15" height="407" width="760">
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
							  <td height="20" bgcolor="#cccccc" valign="middle" class="preto">&nbsp;&nbsp;&nbsp;Esqueceu sua Senha?</td>
							</tr>
							<tr>
							  <td>
								<table border="0" cellpadding="0" cellspacing="8" width="100%">
								  <form action="envia_senha.php" method="post" name="recupera_senha" target="_parent">
								  <tr>
									<td align="left" valign="top" class="login_simples">Informe seu email cadastrado no Sa&sup2;pO no campo abaixo e clique em enviar. Em alguns minutos voc&ecirc; receber&aacute; sua senha no e-mail indicado. </td>
								  </tr>
								  <tr>
									<td align="left">
									  <table width="100%" cellpadding="0" cellspacing="0">
										<tr>
										  <td class="login_simples">email:</td>
										</tr>
										<tr>
										  <td><input type="text" class="post" name="email" size="25" maxlength="40" OnKeyPress="JavaScript: return trocarCampo(event);"></td>
										</tr>
									  </table>
									</td>
								  </tr>
								  <tr>
									<td height="15" align="left" class="login_simples"><font color="#FF0000">
										<?php 
											if ($_GET["erro_email"] == 1) 
											{ 
												echo "Campo email em Branco.";
											} 
											else 
												if ($_GET["erro_email"] == 2)
												{
													echo "O enedereço de email informado \"".$_GET["email"]."\" parece ser inválido.";
												}
												else
													if ($_GET["erro_email"] == 3)
													{
														echo "Endereço de email (".$_GET["email"].") não foi encontrado em nosso Sistema.";
													}
													else
														if ($_GET["erro_email"] == "enviado")
														{
															echo "Os dados para acesso ao Sa²pO foram enviados para o email informado.";
														}
										?>
									</font></td>
								  </tr>
								  <tr>
									<td>
									  <table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
										  <td width="50%" align="center" valign="middle"><a onClick="JavaScript: window.location.href = 'index.php'" style="cursor: pointer" class="link_login">acessar o Sa²pO</a></td>
										  <td width="50%" align="right"><img src="imagens/login/botao_enviar.gif" border="0" onClick="JavaScript: document.recupera_senha.submit();" style="cursor: pointer"></td>
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