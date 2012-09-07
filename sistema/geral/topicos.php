<?php
/*
=====================================================================
#  PROJETO: Sa²po 2.0 Beta                                          #
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
		
$forums = new forum();
$forums->colecao($cod_turma);
$total_forum = $forums->linhas;

?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" id="tabela_topicos">
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoD9.gif"><img src="../../imagens/cantoD2.gif" width="10" height="10" border="0"></td>
	<td width="174" height="34" rowspan="2" valign="top" bgcolor="#CCCCCC" align="left"><img src="../../imagens/cantoD10.gif" width="174" height="34" border="0"></td>
	<td height="10" background="../../imagens/cantoD8.gif" width="100%" valign="top"></td>
	<td width="10" height="10" align="right" valign="top" background="../../imagens/cantoC7.gif"><img src="../../imagens/cantoD3.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="top" background="../../imagens/cantoD9.gif"></td>
	<td height="24" bgcolor="#EFEFEF" width="100%" align="right"><a onClick="JavaScript: abas('ultimosTopicos');" style="cursor: pointer"><img id="imagem_topicos" name="minimizar" title="Minimizar Últimas no Fórum" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	<td width="10" background="../../imagens/cantoD7.gif"></td>
  </tr>
  <tr>
	<td width="10" background="../../imagens/cantoD5.gif"></td>
	<td height="100%" colspan="2" valign="top" bgcolor="#EFEFEF">
	  <div id="ultimosTopicos" style="height:100%;">
	  <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="2">
		<form name="tela_forum" method="post">
		<?php
		if ($total_forum > 0)
		{	
			if (!is_array($lista_forum))
				$lista_forum = array();
			
			for ($i = 0; $i < $total_forum; $i++)
			{
				$cod_forum = $forums->data["cod_forum"];
				$forum = new forum();
				$acesso = $forum->verificaAcesso($cod_forum, $cod_usuario);
				
				if ($acesso == "false")
					$lista_forum[] = array("cod_forum" => $cod_forum);
				
				$forums->proximo();
			}			
			
			$forum_sem_acesso = sizeof($lista_forum);
			
			if ($forum_sem_acesso > 4)
				$forum_sem_acesso = 4;
			
			if ($forum_sem_acesso > 0)
			{
				for ($j = 0; $j < $forum_sem_acesso; $j++)
				{
					$pagina_forum = 0;
					
					$cod_forum = $lista_forum[$j]["cod_forum"];
					$forum = new forum();
					$forum->carregar($cod_forum);
					$cod_autor = $forum->getCodigoUsuario();
					$data = formataData($forum->getDataForum(), "/");
					$data = substr($data, 0, 5);
					$hora = $forum->getHora();
					
					$mensagem_forum = new mensagem_forum();
					$mensagem_forum->colecao($cod_forum);
					
					$linhas = $mensagem_forum->linhas;
										
					for ($i = 0; $i < $linhas; $i++)
					{
						if (($i + 1) == $linhas)
						{
							$cod_mensagem = $mensagem_forum->data["cod_mensagem"];
							$mensagem = new mensagem_forum();
							$mensagem->carregar($cod_mensagem);
					
							$data = formataData($mensagem->getDataMensagem(), "/");
							$data = substr($data, 0, 5);
							$hora = $mensagem->getHora();
							$cod_autor = $mensagem->getCodigoUsuario();
							
							$forum->totalMensagens($cod_forum);
							$linhas = $forum->linhas;
							
							if ($linhas != 0)
							{
								$total_paginas = ceil($linhas / 10);
								$pagina_forum = $total_paginas;
							}
						}
						
						$mensagem_forum->proximo();
					}
					
					$assunto = $forum->getAssunto();
					
					$usuario = new usuario();
					$usuario->carregar($cod_autor);
					$nome_autor = $usuario->getNome();
					
					if ($pagina_forum == 0)
						$pagina_forum = 1;
		?>
				<tr>
					<td class="preto_simples"><?php echo "<font class=\"preto\">".$data."</font>&nbsp;-&nbsp;"; ?><a onClick="JavaScript: visualizarPerfil('<?php echo $cod_autor; ?>');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome_autor; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_cinza"><?php echo $nome_autor; ?></a></td>
				</tr>
				<tr>
					<td class="preto_simples"><?php echo "<font class=\"preto\">Assunto:</font>&nbsp;"; ?><a onClick="JavaScript: lerForum(<?php echo $cod_forum; ?>, <?php echo $pagina_forum; ?>, 'inicial');" onMouseOver="JavaScript: window.status = 'Ler Tópico <?php echo $assunto; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $assunto; ?>" style="cursor: pointer" class="link_cinza"><?php echo reduzTexto($assunto, 30); ?></a></td>
				</tr>
		<?php
					if (($j + 1) < $forum_sem_acesso)
					{
		?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="1" background="../../imagens/traco5.gif"><img src="../../imagens/traco5.gif" border="0"></td>
							</tr>
						</table>
					</td>
				</tr>
		<?php
					}
				
					$forums->proximo();
				}
		?>
				<tr>
					<td height="100%" valign="bottom" align="right"><input type="hidden" name="cod_forum"><input type="hidden" name="pag"><a onClick="JavaScript: window.location.href = 'forum/index.php'" class="link_cinza" onMouseOver="JavaScript: window.status = 'Ver Todos os Tópicos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">ver todos os tópicos</a></td>
				</tr>
		<?php
			}
			else
			{
		?>
			<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td class="preto" align="center">Nenhum tópico novo no Fórum.</td>
			</tr>
		<?php
			}
		}
		else
		{
		?>
			<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td class="preto" align="center">Nenhum tópico novo no Fórum.</td>
			</tr>
		<?php
		}
		?>
		</form>
	  </table>
	  </div>
	</td>
	<td width="10" align="right" background="../../imagens/cantoD7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom" background="../../imagens/cantoD5.gif"><img src="../../imagens/cantoD1.gif" width="10" height="10" border="0"></td>
	<td height="10" background="../../imagens/cantoD6.gif" colspan="2"></td>
	<td width="10" height="10" align="right" valign="bottom" background="../../imagens/cantoD7.gif"><img src="../../imagens/cantoD4.gif" width="10" height="10" border="0"></td>
  </tr>
</table>
