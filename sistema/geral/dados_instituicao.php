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

$perfil = new perfil();
$perfil->carregar($cod_usuario);

$cod_perfil = $perfil->getCodigo();

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="10" height="10" rowspan="2" valign="top" background="../../imagens/cantoB10.gif"><img src="../../imagens/cantoB1.gif" width="10" height="10" border="0"></td>
	<td height="34" rowspan="2" valign="top" bgcolor="#D5FFD5" align="left"><img src="../../imagens/cantoB9.gif" height="34" border="0"></td>
	<td height="10" width="100%" background="../../imagens/cantoB8.gif" valign="top"></td>
	<td width="10" height="10" valign="top" background="../../imagens/cantoB7.gif" rowspan="2"><img src="../../imagens/cantoB2.gif" width="10" height="10" border="0"></td>
  </tr>
  <tr>
	<td height="24" bgcolor="#D5FFD5" align="right"><a onClick="JavaScript: abas('dadosPessoaisTelaInicial');" style="cursor: pointer"><img id="imagem_dados_pessoais" name="minimizar" title="Minimizar Dados Pessoais" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
  </tr>
  <tr>
	<td width="10" background="../../imagens/cantoB5.gif"></td>
	<td colspan="2" bgcolor="#D5FFD5">
	  <div id="dadosPessoaisTelaInicial">
	  <?php
		if (empty($cod_perfil))
		{
		?>
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
				<td height="15"></td>
			</tr>
			<tr>
				<td class="verde">Foi constatado que seu Usuário não possui um Perfil cadastrado, para cadastrar seu perfil por favor clique <a href="perfil/index.php?acao=perfil" title="Cadastrar Perfil">aqui.</a></td>
			</tr>
		  </table>
		<?php
		}		
		else
		{
			$profissao = $perfil->getProfissao();
			$interesse = $perfil->getInteresse();
			$foto = $perfil->getFoto();
			$miniatura = $perfil->getMiniatura();
			$cidade = $perfil->getCidade();
			$uf = $perfil->getUF();
			$uf = ufExtenso($uf);
			$dir_perfil = $cod_usuario;
			
			if ($foto != _SEM_FOTO)
			{		
				//Diretório dos Arquivos
				if ($miniatura != "")
				{
					$arquivo = "../../arquivos/perfil/".$dir_perfil."/".$miniatura;
					$foto_g = "../../arquivos/perfil/".$dir_perfil."/".$foto;
					if ((file_exists($arquivo)) and (file_exists($foto_g)))
					{	
						$dimensoes = dimensoesImagem($foto_g, 40);
						$dimensoes = explode(".", $dimensoes);
						$largura = $dimensoes[0];
						$altura = $dimensoes[1];
						$link = "janela('Foto','".$foto_g."' ,100 ,100 ,".$largura." ,".$altura." ,0 ,0 ,0 ,1 ,1);";
					}
					else
						$arquivo = "../../imagens/"._SEM_FOTO;
				}
			}
			else
				$arquivo = "../../imagens/".$foto;
		?>
		  <table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
			     <td width="80" align="center"><a onClick="<?php echo $link; ?>" style="cursor: pointer"><img src="<?php echo $arquivo; ?>" width="64" height="64" border="0"></a></td>
				<td valign="top">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td align="right" class="verde" width="70">Nome:</td>
							<td width="5">&nbsp;</td>
							<td align="left" class="preto_simples"><?php echo $nome; ?></td>
						</tr>
						<tr>
							<td align="right" class="verde" width="70">Aniversário:</td>
							<td width="5">&nbsp;</td>
							<td align="left" class="preto_simples"><?php echo $data_nascimento; ?></td>
						</tr>
						<tr>
                          <td colspan="3" background="../../imagens/traco2.gif"><img src="../../imagens/traco2.gif" height="1" border="0"></td>
                        </tr>
						<tr>
							<td align="right" class="verde" width="70">Localiza&ccedil;&atilde;o:</td>
							<td width="5">&nbsp;</td>
							<td align="left" class="preto_simples"><?php echo $cidade." / ".$uf; ?></td>
						</tr>
						<tr>
							<td align="right" class="verde" width="70">Profiss&atilde;o:</td>
							<td width="5">&nbsp;</td>
							<td align="left" class="preto_simples"><?php if (empty($profissao)) echo "<i>Não Informado</i>"; else echo $profissao; ?></td>
						</tr>
							<td align="right" class="verde" valign="top" width="70">Interesses:</td>
							<td width="5">&nbsp;</td>
							<td align="left" class="preto_simples"><?php if (empty($interesses)) echo "<i>Não Informado</i>"; else echo $interesse; ?></td>
						</tr>
						<tr>
                          <td colspan="3" background="../../imagens/traco2.gif"><img src="../../imagens/traco2.gif" height="1" border="0"></td>
                        </tr>
					</table>
				</td>
			</tr>
			<tr>
			  <td colspan="2" height="10"></td>
			</tr>
			<tr>
			  <td colspan="2" align="right" valign="top"><a onClick="JavaScript: window.location.href = '../geral/perfil/index.php';" class="link_verde" onMouseOver="JavaScript: window.status = 'Editar Dados Pessoais';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">editar dados pessoais</a></td>
			</tr>
		</table>
		<?php
		}
		?>
	  </div>
	</td>
	<td width="10" align="right" background="../../imagens/cantoB7.gif">&nbsp;</td>
  </tr>
  <tr>
	<td width="10" height="10" align="left" valign="bottom"><img src="../../imagens/cantoB4.gif" width="10" height="10" border="0"></td>
	<td height="10" colspan="2" background="../../imagens/cantoB6.gif"></td>
	<td width="10" height="10" valign="bottom"><img src="../../imagens/cantoB3.gif" width="10" height="10" border="0"></td>
  </tr>
</table>