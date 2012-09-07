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

$participantes = new usuario();
$participantes->colecaoUsuarioTurma($cod_turma, "Q", "");
$total = $participantes->linhas;
$codigos = array();
$codigos_escolhidos = array();

for ($i = 0; $i < $total; $i++)
{
	$cod_participante = $participantes->data["cod_usuario"];
	
	if ($participantes->data["acesso"] != "P")
	{
		$codigos[] = array("cod_participante" => $cod_participante);
		$codigos_escolhidos[] = array("cod_participante" => $cod_participante);
	}
	
	$participantes->proximo();
}

$total = sizeof($codigos);
$escolhidos = 0;

if ($total >= 3)
{
	$codigos_escolhidos = array();
	while($escolhidos < 3)
	{
		$numero = rand(0, ($total - 1));
		$cod_participante = $codigos[$numero]["cod_participante"];
		$total_escolhidos = sizeof($codigos_escolhidos);
		
		if (($total_escolhidos > 0) and ($total_escolhidos < 3))
		{
			$existe = "false";
			
			for ($j = 0; $j < $total_escolhidos; $j++)
			{
				$codigo_selecionado = $codigos_escolhidos[$j]["cod_participante"];
				$codigo_comparacao = $cod_participante;
				
				if (($codigo_selecionado == $codigo_comparacao))
					$existe = "true"; 
			}
			
			if ($existe == "false")
			{
				$codigos_escolhidos[] = array("cod_participante" => $cod_participante);
				$escolhidos++;
			}
		}
		else
			if ($total_escolhidos < 3)
			{
				$codigos_escolhidos[] = array("cod_participante" => $cod_participante);
				$escolhidos++;
			}
	}
	
	$total_escolhidos = sizeof($codigos_escolhidos);
}

?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
	  <td height="1" colspan="3" background="../../imagens/cantog3.gif"><img src="../../imagens/cantog3.gif" height="1"></td>
	</tr>
	<tr>
	  <td width="156"><img src="../../imagens/cantog1.gif" width="156" height="30"></td>
	  <td width="74" background="../../imagens/cantog4.gif" align="right"><a onClick="JavaScript: abaFerramentaParticipantes('sua_turma', '../../imagens/');" style="cursor: pointer"><img id="imagem_sua_turma" name="minimizar" title="Minimizar Sua Turma" src="../../imagens/outros/nodeclose.jpg" border="0"></a>&nbsp;</td>
	  <td width="1" background="../../imagens/cantog3.gif"><img src="../../imagens/cantog3.gif" width="1"></td>
	</tr>
	<tr>
	  <td colspan="3">
		<table width="100%" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="1" background="../../imagens/cantog3.gif"><img src="../../imagens/cantog3.gif" width="1"></td>
			<td width="228" background="../../imagens/cantog2.jpg">
			  <div id="sua_turma">
			  <table width="100%" border="0" cellspacing="3" cellpadding="2">
			  <form action="../geral/perfil_usuario.php" method="post" name="perfil_participante">
				<?php
				if ($total_escolhidos > 0)
				{
					for ($x = 0; $x < $total_escolhidos; $x++)
					{
						$cidade_participante = "";
						$uf_participante = "";
						$link_participante = "";
						$arquivo_participante = "#";
						$cod_participante = $codigos_escolhidos[$x]["cod_participante"];
						$perfil = new perfil();
						$perfil->carregar($cod_participante);
						$cod_perfil = $perfil->getCodigo();
						
						$usuario = new usuario();
						$usuario->carregar($cod_participante);
						
						//Dados Pessoais
						$nome_participante = $usuario->getNome();
						$data_nascimento_participante = $usuario->getDataNascimento();
						
						$dia_nascimento = substr($data_nascimento_participante, 8, 2);
						$mes_nascimento = substr($data_nascimento_participante, 5, 2);
						$ano_nascimento = substr($data_nascimento_participante, 0, 4);
						
						if (checkdate($mes_nascimento, $dia_nascimento, $ano_nascimento)) 
						{
							$dia_atual = date("d");
							$mes_atual = date("m");
							$ano_atual = date("Y");
							
							$idade_participante = $ano_atual - $ano_nascimento;
							if ($mes_nascimento > $mes_atual)
							{
								$idade_participante--;
							}
							
							if (($mes_nascimento == $mes_atual) and ($dia_atual < $dia_nascimento))
							{
								$idade_participante--;
							}
						}
						else
							$idade_participante = "Não Informado";
						
						if (!empty($cod_perfil))
						{
							$foto_participante = $perfil->getFoto();
							$miniatura_participante = $perfil->getMiniatura();
							$cidade_participante = $perfil->getCidade();
							$uf_participante = $perfil->getUF();
							$uf_participante = ufExtenso($uf_participante);
							$dir_perfil_participante = $cod_participante;
							
							if (($foto_participante != _SEM_FOTO) and (!empty($foto_participante)))
							{		
								//Diretório dos Arquivos
								if (!empty($miniatura_participante))
								{
									$total_caracteres = strlen($miniatura_participante);
									$miniatura_participante_ = "";
				
									for($y = 0; $y < $total_caracteres; $y++)
										$miniatura_participante_.= substituiCaracter($miniatura_participante[$y], "link");
									
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
						}
				?>
					<tr valign="top">
						<td width="33%"><a onClick="<?php echo $link_participante; ?>" onMouseOver="JavaScript: window.status = 'Visualizar Foto do Usuário <?php echo $nome_participante; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><img src="<?php echo $arquivo_participante; ?>" width="64" height="57" border="0"></a></td>
						<td width="67%">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td class="laranja"><a onClick="JavaScript: visualizarPerfil('<?php echo $cod_participante; ?>');" onMouseOver="JavaScript: window.status = 'Visualizar Perfil do Usuário <?php echo $nome_participante; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_laranja"><?php echo $nome_participante; ?></a></td>
								</tr>
								<tr>
									<td class="preto_simples"><?php echo $idade_participante; ?></td>
								</tr>
								<tr>
									<td class="preto_simples"><?php if (($cidade_participante == "") or ($uf_participante == "")) echo "Não Informado"; else echo $cidade_participante." / ".$uf_participante; ?></td>
								</tr>
							</table>
						</td>
					</tr>
				<?php
					}
				?>
					<tr>
					  <td colspan="2" height="15"><input type="hidden" name="cod_participante"><input type="hidden" name="acao_voltar" value="inicial"></td>
					</tr>
					<tr>
					  <td colspan="2" align="right"><a onClick="window.location.href = '../geral/minha_turma.php'" onMouseOver="JavaScript: window.status = 'Ver Minha Turma';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="link_laranja">ver minha turma</a></td>
					</tr>
				<?php
				}
				else
				{
				?>
				
				<?php
				}
				
				?>
			  </form>
			</table>
			</div>
			</td>
			<td width="1" background="../../imagens/cantog3.gif"><img src="../../imagens/cantog3.gif" width="1" border="0"></td>
		  </tr>
		</table>
	  </td>
	</tr>
	<tr>
	  <td colspan="3" height="1" background="../../imagens/cantog3.gif"><img src="../../imagens/cantog3.gif" height="1" border="0"></td>
	</tr>
  </table>