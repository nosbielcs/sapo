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

include("../config/session.lib.php");
include("../config/config.bd.php");
include("../classes/classe_bd.php");
include("../classes/curso.php");
include("../classes/instituicao.php");
include("../classes/log.php");
include("../classes/turma.php");
include("../classes/usuario.php");
include("../funcoes/funcoes.php");

$cod_usuario = $_SESSION["cod_usuario"];
$turmas_usuario = new usuario();

$turmas_usuario->verificaTipoAcessoInsituticao($cod_usuario);
$tipo_acesso = $turmas_usuario->data["acesso"];

$data_log = date("Y-m-d");
$hora_log = date("H:i:s");

logSistema($cod_usuario, 0, "Acessou a Tela de Instituições e Cursos", session_id(), $data_log, $hora_log);

switch ($tipo_acesso)
{
	case "A":
		$tipo_acesso = "admin";
	break;
	
	case "I":
		$tipo_acesso = "pta";
	break;
	
	case "P":
		$tipo_acesso = "supervisor";
	break;
}

if ($tipo_acesso == "admin")
{
	$instituicoes = new instituicao();
	$instituicoes->colecao();
	$total = $instituicoes->linhas;
	
	for ($i = 0; $i < $total; $i++)
	{
		$cod_inst = $instituicoes->data["cod_inst"];
		$vetor_instituicoes[] = array("cod_instituicao" => $cod_inst);
		$instituicoes->proximo();
	}
}
else
	if ($tipo_acesso == "pta")
	{
		$instituicoes_usuario = new usuario();
		$instituicoes_usuario->instituicoes($cod_usuario);
		$vetor_instituicoes = array();
		$vetor_cursos_instituicao = array();
		
		$total_instituicoes_usuario = $instituicoes_usuario->linhas;
		
		if ($total_instituicoes_usuario > 0)
		{
			for ($i = 0; $i < $total_instituicoes_usuario; $i++)
			{
				$cod_inst = $instituicoes_usuario->data["cod_inst"];
			
				$cursos_instituicao = new curso();
				$cursos_instituicao->colecaoCursoInstituicao($cod_inst);
				$total_cursos = $cursos_instituicao->linhas;
				$vetor_instituicoes[] = array("cod_instituicao" => $cod_inst);
				
				for ($j = 0; $j < $total_cursos; $j++)
				{
					$cod_curso = $cursos_instituicao->data["cod_curso"];
	
					$curso = new curso();
					$curso->carregar($cod_curso);
						
					$total_vetor_instituicoes = count($vetor_instituicoes);
					$vetor_cursos_instituicao[] = array("cod_curso" => $cod_curso);
					
					$cursos_instituicao->proximo();
				}
				
				$instituicoes_usuario->proximo();
			}
		}
	}
	else
	{
		if ($_GET["situacao_turma"])
			$situacao_turma = $_GET["situacao_turma"];
		else
			$situacao_turma = "";
			
		$turmas_usuario->turmas($cod_usuario, $situacao_turma);
		$vetor_instituicoes = array();
		$vetor_turmas_usuario = array();
		
		if (empty($situacao_turma))
			$situacao_turma = "I";
		
		$total_turmas_usuario = $turmas_usuario->linhas;
		$turma_situacao_encontrado = false;
		
		if ($total_turmas_usuario > 0)
		{
			for ($i = 0; $i < $total_turmas_usuario; $i++)
			{
				$cod_turma = $turmas_usuario->data["cod_turma"];
				
				if ($cod_turma > 0)
				{
					$turma = new turma();
					$turma->carregar($cod_turma);
					
					$cod_curso = $turma->getCodigoCurso();
					$curso = new curso();
					$curso->carregar($cod_curso);
					$cod_inst = $curso->getCodigoInstituicao();
					$turma_situacao = $turma->getSituacao();
					
					if (($turma_situacao == $situacao_turma) and (!$turma_situacao_encontrado))
						$turma_situacao_encontrado = true;
					
					$total_vetor_instituicoes = count($vetor_instituicoes);
					
					$vetor_turmas_usuario[] = array("cod_instituicao" => $cod_inst, "cod_curso" => $cod_curso, "cod_turma" => $cod_turma);
					
					if ($total_vetor_instituicoes > 0)
					{
						$existe = "false";
										
						for ($j = 0; $j < $total_vetor_instituicoes; $j++)
						{
							$cod_selecionado = $vetor_instituicoes[$j]["cod_instituicao"];
							$codigo_comparacao = $cod_inst;
							
							if (($cod_selecionado == $codigo_comparacao))
								$existe = "true"; 
						}
						
						if ($existe == "false")
							$vetor_instituicoes[] = array("cod_instituicao" => $cod_inst);
					}
					else
						$vetor_instituicoes[] = array("cod_instituicao" => $cod_inst);
				}
				
				$turmas_usuario->proximo();
			}
		}
	}
?>
<html>
<head>
<title>SA²pO</title>
<link href="../config/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;">

<script type="text/javascript" src="../funcoes/funcoes.js"></script>
<script type="text/javascript" src="../funcoes/funcoes_instituicao.js"></script>

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td width="10" rowspan="4" background="../imagens/cantoA7.gif" valign="top"><img src="../imagens/cantoA1.gif" width="10" height="10" border="0"></td>
	  <td width="240" height="10" nowrap background="../imagens/cantoA11.gif" bgcolor="#FCFFEE"></td>
	  <td width="10" height="10" bgcolor="#FCFFEE" background="../imagens/cantoA11.gif"></td>
	  <td height="10" background="../imagens/cantoA11.gif"></td>
	  <td width="10" rowspan="2" valign="top" background="../imagens/cantoA10.gif"><img src="../imagens/cantoA2.gif" width="10" height="10" border="0"></td>
	</tr>
	<tr>
	  <td width="240" bgcolor="#FCFFEE">            
		<table width="230" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="100%"><img src="../imagens/logos/sapo.gif" width="230" height="89"></td>
		  </tr>
		</table>
	  </td>
	  <td width="10" valign="bottom" bgcolor="#FCFFEE"><img src="../imagens/traco1.gif" width="2" height="99"></td>
	  <td width="100%" bgcolor="#FCFFEE">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center"><a onMouseOver="JavaScript: window.status = '10° Curso Capacitando para Triagem Neonatal';" onMouseOut="JavaScript: window.status = 'SA°pO - Sistema de Apoio a Aprendizagem Online';" onClick="JavaScript: bannerCurso();" target="_blank" style="cursor:pointer" title="Clique aqui e Saiba Mais!"><img src="http://www.fepe.org.br/assessoria/banner_10CTTN.gif" width="420" height="54" title="Clique aqui e Saiba Mais!"></a></td>
			<td width="10" align="center"><img src="../imagens/traco1.gif" width="2" height="99" border="0"></td>
			<td width="120" align="center"><a onClick="JavaScript: window.location.href = '../login/logout.php'" onMouseOver="JavaScript: window.status = 'Sair';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer" class="imagem"><img src="../imagens/icones/sair.gif" width="70" height="60" border="0"></a></td>
		  </tr>
		</table>
	  </td>
	</tr>
  </table>
  <?php
  	if ($tipo_acesso == "admin")
	{
		$num_inst = new instituicao();
		$num_inst->colecao();
			
		$quantidade = $num_inst->linhas;
		
		//Paginação e Listagem
		if ($_GET["pag"])
		{
			$pagina = $_GET["pag"];
			$url_ordenacao = "index.php?pag=".$pagina;
		}
		else
		{
			$pagina = 1;
			$url_ordenacao = "index.php?pag=".$pagina;
		}
		
		if ($_POST["qtd_listagem"])
		{
			$limite = $_POST["qtd_listagem"];
			$url_ordenacao.= "&qtd=".$limite;
		}
		else
			if ($_GET["qtd"])
			{
				$limite = $_GET["qtd"];
				$url_ordenacao.= "&qtd=".$limite;
			}
			else
			{
				$limite = 10;
				$url_ordenacao.= "&qtd=".$limite;
			}
		
		if ($_GET["ordem"])
		{
			$ordem = $_GET["ordem"];
			$url_ordenacao.= "&ordem=".$ordem;
		}
		else
		{
			$ordem = 1;
			$url_ordenacao.= "&ordem=".$ordem;	
		}
		
		$inicio = $pagina - 1;
		$inicio = $inicio * $limite;
		$url = "index.php?ordem=".$ordem;
		
		$num_inst->paginacaoInstituicao($limite, $inicio, $ordem);
		$total_inst = $num_inst->linhas;
  ?>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10" background="../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
      <td height="10" background="../imagens/cantoA9.gif"><img src="../imagens/cantoA9.gif" width="10" height="10"></td>
      <td width="10" background="../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
    </tr>
  </table>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
	  <td height="5"></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
	  <td width="3"></td>
	  <td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="1" align="left" valign="top" background="../imagens/cantoi_.gif"><img src="../imagens/cantoi_.gif" width="1"></td>
			<td width="156" height="30" rowspan="2" valign="top" bgcolor="#AEAEFF"><img src="../imagens/cantoi.gif" width="156" height="30"></td>
			<td height="1" background="../imagens/cantoi_.gif" width="100%" valign="top"></td>
			<td width="1" align="right" valign="top" background="../imagens/cantoi_.gif"></td>
		  </tr>
		  <tr>
			<td width="1" height="1" align="left" valign="top" background="../imagens/cantoi_.gif"></td>
			<td height="24" bgcolor="#6AFFB0" width="100%" align="right"><a class="link_verde" onClick="JavaScript: novaInstituicao();" onMouseOver="JavaScript: window.status = 'Acessar Instituição';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Nova Instituição</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td width="1" background="../imagens/cantoi_.gif"><img src="../imagens/cantoi_.gif" width="1"></td>
		  </tr>
		</table>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="1" background="../imagens/cantoi3.gif" align="left"><img src="../imagens/cantoi3.gif" width="1"></td>
			<td bgcolor="#6AFFB0">
				<?php
					if ($quantidade > 0)
					{
				?>
				  <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="right">
					  <form name="paginacao_inst" action="<?php echo $url_ordenacao; ?>" method="post">
					    <table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td class="campos" align="right">Listagem</td>
						  <td width="10">&nbsp;</td>
						  <td width="50">
							<select name="qtd_listagem" onChange="JavaScript: paginacao('<?php echo $url_ordenacao; ?>', 'paginacao_inst');">
							  <option value="5" <?php if ($limite == 5) echo "selected"; ?>>5</option>
							  <option value="10" <?php if ($limite == 10) echo "selected"; ?>>10</option>
							  <option value="15" <?php if ($limite == 15) echo "selected"; ?>>15</option>
							  <option value="20" <?php if ($limite == 20) echo "selected"; ?>>20</option>
							</select>
						  </td>
						</tr>
					  </table>
					  </form>
					  </td>
					</tr>
					<tr>
					  <td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<form name="redireciona_usuario" method="post" target="_parent">
						  <tr> 
							<td width="25" align="center"><input type="checkbox" name="todos_inst" onClick="marcaTodosInstituicao('tela_inst');"></td>
							<td width="10">&nbsp;</td>
							<td class="verde">Marcar/Desmarcar Todos</td>
						  </tr>
						  <tr bgcolor="#00CC66"> 
							<td width="25" align="center">&nbsp;</td>
							<td width="10">&nbsp;</td>
							<td>
							  <table width="100%" cellpadding="0" cellspacing="0">
								<tr>
								  <td class="preto" width="60%">Instituição&nbsp;&nbsp;
						  <?php 
							if ($_GET["ordem"])
							{ 
								$ordem = $_GET["ordem"];
								
								switch($ordem) 
								{
									case 1:
										$url_ordenacao.= "&ordem=2";
										echo "<a href=\"".$url_ordenacao."\"><img src=\"../imagens/outros/seta_ordenar_1.gif\" border=\"0\" alt=\"Ordem Decrescente por Nome\"></a>";
									break;
									
									case 2: 
										$url_ordenacao.= "&ordem=1";
										echo "<a href=\"".$url_ordenacao."\"><img src=\"../imagens/outros/seta_ordenar.gif\" border=\"0\" alt=\"Ordem Crescente por Nome\"></a>";
									break;
								}
							} 
							else
							{
								$url_ordenacao.= "&ordem=1";
								echo "<a href=\"".$url_ordenacao."\"><img src=\"../imagens/outros/seta_ordenar_1.gif\" border=\"0\" alt=\"Ordem Decrescente por Nome\"></a>";
							}
						  ?>
								</td>
								<td width="20%" class="preto" align="center">Total de Cursos</td>
								<td width="20%" class="preto" align="center">Solicitações Pendentes</td>
							  </tr>
							</table>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <?php
							$cor_fundo = "verde_linha_3";
							
							for ($i = 0; $i < $total_inst; $i++)
							{
								$acesso = "A";
								$cod_inst = $num_inst->data["cod_inst"];
								$instituicao = new instituicao();
								$instituicao->carregar($cod_inst);
								$nome = $instituicao->getNome();
								$total_curso = $num_inst->data["total_curso"];
								$total_solicitacao = $num_inst->data["total_solicitacao"];
												
								if ($cor_fundo == "verde_linha_3")
									$cor_fundo = "verde_linha_4";
								else
									$cor_fundo = "verde_linha_3";
								
								$link_acessar = "<a class=\"link_verde\" onClick=\"JavaScript: redirecionaUsuario(".$cod_inst.", '".$acesso."', ".$cod_inst.")\" onMouseOver=\"JavaScript: window.status = 'Acessar Instituição ".$nome."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">".$nome."</a>";
						  ?>
						  <tr class="<?php echo $cor_fundo; ?>"> 
							<td align="center"><?php echo "<input type='checkbox' name='".$cod_inst."' value='".$cod_inst."' onClick=\"atualizaCodigosInstituicao();\">"; ?></td>
							<td>&nbsp;</td>
							<td>
							  <table width="100%" cellpadding="0" cellspacing="0">
								<tr>
								  <td width="60%"><?php echo $link_acessar; ?></td>
								  <td width="20%" class="preto_simples" align="center"><?php echo $total_curso; ?></td>
								  <td width="20%" class="preto_simples" align="center"><?php echo $total_solicitacao; ?></td>
								</tr>
							  </table>
							</td>
						  </tr>
						  <?php
								$num_inst->proximo();
							}
						  ?>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td colspan="3"><?php echo paginacao($pagina, $inicio, $limite, $quantidade, $url, true); ?></td>
						  </tr>
						  <tr> 
							<td colspan="3" height="15"></td>
						  </tr>
						  <tr> 
							<td colspan="3"><input type="hidden" name="cod_inst" value=""><input type="hidden" name="pagina" value="<?php echo $pagina; ?>"><input type="hidden" name="quantidade" value="<?php echo $limite; ?>"><input type="hidden" name="ordem" value="<?php echo $ordem; ?>"><input type="hidden" name="cod_turma"><input type="hidden" name="acesso"><input type="hidden" name="acao_instituicao"></td>
						  </tr>
						  <tr> 
							<td colspan="3">
							  <table width="100%" cellpadding="0" cellspacing="0">
								<tr> 
								  <td align="right"><input type="hidden" name="acao"><input type="hidden" name="usuario" value="<?php echo $_SESSION["cod_usuario"]; ?>"></td>
								  <td width="10">&nbsp;</td>
								  <td width="50" align="right"><input type="button" name="edita" value="Editar" onClick="JavaScript: editarInstituicao('');"></td>
								  <td width="10">&nbsp;</td>
								  <td width="50"><input type="button" name="exclui" value="Excluir" onClick="JavaScript: excluirInstituicao('');"></td>
								  <td width="20">&nbsp;</td>
								</tr>
							  </table>
							</td>
						  </tr>
						</form>
					  </table>
					  </td>
					</tr>
				  </table>
				<?php
					}
					else
					{
				?>  
				  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td align="center" class="vermelho_simples">Nenhuma Instituição Cadastrada.</td>
					</tr>
				  </table>
				<?php
					}
				?>
			</td>
			<td width="1" background="../imagens/cantoi3.gif" align="right"><img src="../imagens/cantoi3.gif" width="1"></td>
		  </tr>
		  <tr>
			<td height="1" background="../imagens/cantoi3.gif" colspan="3"><img src="../imagens/cantoi3.gif" height="1"></td>
		  </tr>
	    </table>
	  </td>
	  <td width="3"></td>
	<tr>
  </table>
  <?php
  	}
	else
		if ($tipo_acesso == "pta")
		{
   ?>
   <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10" valign="top"><img src="../imagens/cantoA7.gif" width="10" height="10" border="0"></td>
      <td width="230" height="10" bgcolor="#FCFFEE"></td>
      <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
      <td width="100%" height="10" background="../imagens/cantoA12.gif" valign="bottom"></td>
      <td width="10" valign="bottom" background="../imagens/cantoA10.gif" height="10"><img src="../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
    </tr>
	<tr>
	  <td height="100%" colspan="3" id="td_linha_login_instituicao" valign="top">
	    <table width="100%" height="100%" cellpadding="0" cellspacing="0" style="overflow:auto">
          <tr>
            <td width="10" background="../imagens/cantoA7.gif" valign="top">&nbsp;</td>
            <td valign="top" bgcolor="#FCFFEE">
			  <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr background="../imagens/cantoi2.jpg">
                  <td width="100%" colspan="3" align="center"><img src="../imagens/cantoi1.gif" width="230" height="30"></td>
                </tr>
                <tr>
                  <td width="1" background="../imagens/cantoi3.gif" align="left"><img src="../imagens/cantoi3.gif" width="1"></td>
                  <td background="../imagens/cantoi2.jpg" width="228">
				    <table width="100%"  border="0" cellspacing="3" cellpadding="2">
                    <?php
						$total_instituicoes = count($vetor_instituicoes);
						
						for ($i = 0; $i < $total_instituicoes; $i++)
						{
							$cod_inst = $vetor_instituicoes[$i]["cod_instituicao"];
							$instituicao = new instituicao();
							$instituicao->carregar($cod_inst);
							
							$nome_instituicao = $instituicao->getNome();
							$cidade_instituicao = $instituicao->getCidade();
							$estado_instituicao = $instituicao->getUF();
							$imagem_instituicao = $instituicao->getImagem();
							
							$cursos_instituicao = new curso();
							$cursos_instituicao->colecaoCursoAtivoInstituicao($cod_inst);
							$cursos_ativos = $cursos_instituicao->linhas;
							
							$diretorio_instituicao = "../arquivos/".$cod_inst."/imagens/".$imagem_instituicao;
					?>
                      <tr valign="top">
                        <td width="33%" align="center" valign="middle"><img src="<?php echo $diretorio_instituicao; ?>" width="64" height="64"></td>
                        <td width="67%" valign="middle">
					      <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><a onClick="window.location.href = 'index.php?cod_inst=<?php echo $cod_inst; ?>'" class="link_verde" onMouseOver="JavaScript: window.status = '<?php echo $nome_instituicao ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><?php echo $nome_instituicao; ?></a></td>
                            </tr>
                          </table>
					    </td>
                      </tr>
                    <?php
						}
						
						if ($total_instituicoes > 1)
						{
					?>
					  <tr>
					    <td colspan="3" align="right"><a onClick="window.location.href = 'index.php'" class="link_verde" onMouseOver="JavaScript: window.status = 'Todos Meus Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Todos Meus Cursos</a></td>
					  </tr>
					<?php
						}
					?>
                    </table>
				  </td>
                  <td width="1" background="../imagens/cantoi3.gif" align="right"><img src="../imagens/cantoi3.gif" width="1"></td>
                </tr>
                <tr>
                  <td height="1" background="../imagens/cantoi3.gif" colspan="3"><img src="../imagens/cantoi3.gif" height="1"></td>
                </tr>
              </table>
			</td>


          <td width="10" valign="top" background="../imagens/cantoA8.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" nowrap background="../imagens/cantoA9.gif"></td>
          <td width="10" background="../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
      </table>
	  </td>
	   <td colspan="2" align="left" valign="top">
		 <table width="100%" cellpadding="0" cellspacing="0">
		   <td colspan="2" valign="top">
		     <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			   <tr>
				<td width="100%" align="left" valign="top">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td width="10" height="10" align="left" valign="top" background="../imagens/cantoJ10.gif"><img src="../imagens/cantoJ1.gif" width="10" height="10" border="0"></td>
					  <td width="174" height="34" rowspan="2" valign="top" bgcolor="#AEAEFF"><img src="../imagens/cantoJ9.gif" width="174" height="34" border="0" onClick="JavaScript: abas('cursos_destaque');"></td>
					  <td height="10" background="../imagens/cantoJ8.gif" width="100%" valign="top"></td>
					  <td width="10" height="10" align="right" valign="top" background="../imagens/cantoJ7.gif"><img src="../imagens/cantoJ2.gif" width="10" height="10" border="0"></td>
				    </tr>
				    <tr>
					  <td width="10" height="10" align="left" valign="top" background="../imagens/cantoJ10.gif"></td>
					  <td height="24" bgcolor="#FFE1E1" width="100%"></td>
					  <td width="10" background="../imagens/cantoJ7.gif"></td>
				    </tr>
				    <tr>
					  <td width="10" background="../imagens/cantoJ5.gif"></td>
					  <td colspan="2" bgcolor="#FFE1E1">
					  <div id="cursos_destaque">
					    <table width="100%"  border="0" cellspacing="3" cellpadding="2">
					    <form name="redireciona_usuario" method="post">
						<?php
							$cod_inst = "";
							
							if ($_GET["cod_inst"])
								$cod_inst = $_GET["cod_inst"];
							else
								if ($_SESSION["cod_inst"])
									$cod_inst = $_SESSION["cod_inst"];
								
							$total_cursos_instituicao = count($vetor_cursos_instituicao);
						?>
						  <tr>
							<td width="20%"><input type="hidden" name="cod_turma"><input type="hidden" name="acesso"><input type="hidden" name="cod_inst"></td>
							<td width="60%" class="vermelho">Curso</td>
						  </tr>
						<?php
								for ($i = 0; $i < $total_cursos_instituicao; $i++)
								{
									$cod_curso = $vetor_cursos_instituicao[$i]["cod_curso"];
									$curso = new curso();
									$curso->carregar($cod_curso);
									
									$nome_curso = $curso->getNome();
									$cod_instituicao = $curso->getCodigoInstituicao();
									$qtde_horas = $curso->getQtdeHoras();
									$imagem_curso = $curso->getImagem();
									$instituicao = new instituicao();
									$instituicao->carregar($cod_instituicao);
									$nome_instituicao = $instituicao->getNome();
									
									$diretorio_curso = "../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/imagens/".$imagem_curso;
									
									if (!file_exists($diretorio_curso))
										$diretorio_curso = "../imagens/"._SEM_FOTO;

									$link_instituicao = $nome_instituicao;
									$link_curso = $nome_curso;
									$link_turma = "<a class=\"link_vermelho\" onClick=\"JavaScript:  redirecionaUsuario(".$cod_curso.", 'I', ".$cod_instituicao.")\" onMouseOver=\"JavaScript: window.status = '".$descricao_turma."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">".$descricao_turma."</a>";
									$link_acessar = "<a class=\"link_vermelho\" onClick=\"JavaScript: redirecionaUsuario(".$cod_curso.", 'I', ".$cod_instituicao.")\" onMouseOver=\"JavaScript: window.status = 'Acessar esta Turma';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">acessar</a>";
								
									if (!empty($cod_inst))
									{
										if ($cod_inst == $cod_instituicao)
										{
						?>
						  <tr valign="top" bgcolor="#FFD7D7">
						    <td width="20%" valign="middle" align="center"><img src="<?php echo $diretorio_curso; ?>" width="64" height="64"></td>
						    <td width="60%" valign="middle">
							  <table width="100%" cellpadding="0" cellspacing="0">
							    <tr>
								  <td class="vermelho"><img src="../imagens/seta_vermelha.gif" width="10" height="10">&nbsp;<?php echo $link_instituicao; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_curso; ?></td>
							    </tr>
							    <tr>
								  <td align="right"><?php echo $link_acessar; ?></td>
							    </tr>
							  </table>
						     </td>
						   </tr>
						<?php
										}
									}
									else
									{
						?>
						  <tr valign="top" bgcolor="#FFD7D7">
						    <td width="20%" valign="middle" align="center"><img src="<?php echo $diretorio_curso; ?>" width="64" height="64"></td>
						    <td width="60%" valign="middle">
							  <table width="100%" cellpadding="0" cellspacing="0">
							    <tr>
								  <td class="vermelho"><img src="../imagens/seta_vermelha.gif" width="10" height="10">&nbsp;<?php echo $link_instituicao; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_curso; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_turma; ?></td>
							    </tr>
							    <tr>
								  <td align="right"><?php echo $link_acessar; ?></td>
							    </tr>
							  </table>
						     </td>
						   </tr>
						<?php
									}
								}
						?>
					      </form>
					    </table>
					    </div>
					  </td>
					  <td width="10" align="right" background="../imagens/cantoJ7.gif"></td>
					</tr>
					<tr>
					  <td width="10" height="10" align="left" valign="bottom" background="../imagens/cantoJ5.gif"><img src="../imagens/cantoJ4.gif" width="10" height="10" border="0"></td>
					  <td height="10" background="../imagens/cantoJ6.gif" colspan="2"></td>
					  <td width="10" height="10" align="right" valign="bottom" background="../imagens/cantoJ7.gif"><img src="../imagens/cantoJ3.gif" width="10" height="10" border="0"></td>
					</tr>
				  </table>
		         </td>
		       </tr>
		     </table>
			</td>
		  </tr>
		</table>
	  </td>
	</tr>
  </table>
  <?php
		}
		else
		{
  ?>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10" valign="top"><img src="../imagens/cantoA7.gif" width="10" height="10" border="0"></td>
      <td width="230" height="10" bgcolor="#FCFFEE"></td>
      <td width="10" valign="bottom" height="10" bgcolor="#FCFFEE"><img src="../imagens/cantoA6.gif" width="10" height="10" border="0"></td>
      <td width="100%" height="10" background="../imagens/cantoA12.gif" valign="bottom"></td>
      <td width="10" valign="bottom" background="../imagens/cantoA10.gif" height="10"><img src="../imagens/cantoA4.gif" width="10" height="10" border="0"></td>
    </tr>
	<tr>
	  <td height="100%" colspan="3" id="td_linha_login_instituicao" valign="top">
	    <table width="100%" height="100%" cellpadding="0" cellspacing="0" style="overflow:auto">
          <tr>
            <td width="10" background="../imagens/cantoA7.gif" valign="top">&nbsp;</td>
            <td valign="top" bgcolor="#FCFFEE">
			  <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr background="../imagens/cantoi2.jpg">
                  <td width="100%" colspan="3" align="center"><img src="../imagens/cantoi1.gif" width="230" height="30"></td>
                </tr>
                <tr>
                  <td width="1" background="../imagens/cantoi3.gif" align="left"><img src="../imagens/cantoi3.gif" width="1"></td>
                  <td background="../imagens/cantoi2.jpg" width="228">
				    <table width="100%"  border="0" cellspacing="3" cellpadding="2">
                    <?php
						$total_instituicoes = count($vetor_instituicoes);
						
						for ($i = 0; $i < $total_instituicoes; $i++)
						{
							$cod_inst = $vetor_instituicoes[$i]["cod_instituicao"];
							$instituicao = new instituicao();
							$instituicao->carregar($cod_inst);
							
							$nome_instituicao = $instituicao->getNome();
							$cidade_instituicao = $instituicao->getCidade();
							$estado_instituicao = $instituicao->getUF();
							$imagem_instituicao = $instituicao->getImagem();
							
							$cursos_instituicao = new curso();
							$cursos_instituicao->colecaoCursoAtivoInstituicao($cod_inst);
							$cursos_ativos = $cursos_instituicao->linhas;
							
							$diretorio_instituicao = "../arquivos/".$cod_inst."/imagens/".$imagem_instituicao;
					?>
                      <tr valign="top">
                        <td width="33%" align="center" valign="middle"><img src="<?php echo $diretorio_instituicao; ?>" width="64" height="64"></td>
                        <td width="67%" valign="middle">
					      <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><a onClick="window.location.href = 'index.php?cod_inst=<?php echo $cod_inst; ?>'" class="link_verde" onMouseOver="JavaScript: window.status = '<?php echo $nome_instituicao ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer"><?php echo $nome_instituicao; ?></a></td>
                            </tr>
                          </table>
					    </td>
                      </tr>
                    <?php
						}
						
						if ($total_instituicoes > 1)
						{
					?>
					  <tr>
					    <td colspan="3" align="right"><a onClick="window.location.href = 'index.php'" class="link_verde" onMouseOver="JavaScript: window.status = 'Todos Meus Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Todos Meus Cursos</a></td>
					  </tr>
					<?php
						}
					?>
                    </table>
				  </td>
                  <td width="1" background="../imagens/cantoi3.gif" align="right"><img src="../imagens/cantoi3.gif" width="1"></td>
                </tr>
                <tr>
                  <td height="1" background="../imagens/cantoi3.gif" colspan="3"><img src="../imagens/cantoi3.gif" height="1"></td>
                </tr>
              </table>
			</td>

          <td width="10" valign="top" background="../imagens/cantoA8.gif"></td>
        </tr>
        <tr>
          <td width="10" background="../imagens/cantoA7.gif" valign="bottom" height="10"><img src="../imagens/cantoA3.gif" width="10" height="10" border="0"></td>
          <td width="230" height="10" nowrap background="../imagens/cantoA9.gif"></td>
          <td width="10" background="../imagens/cantoA8.gif" valign="bottom" height="10"><img src="../imagens/cantoA5.gif" width="10" height="10" border="0"></td>
        </tr>
      </table>
	  </td>
	   <td colspan="2" align="left" valign="top">
		 <table width="100%" cellpadding="0" cellspacing="0">
		   <td colspan="2" valign="top">
		     <table width="100%"  border="0" cellspacing="0" cellpadding="0">
			   <tr>
				<td width="100%" align="left" valign="top">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				    <tr>
					  <td width="10" height="10" align="left" valign="top" background="../imagens/cantoJ10.gif"><img src="../imagens/cantoJ1.gif" width="10" height="10" border="0"></td>
					  <td width="174" height="34" rowspan="2" valign="top" bgcolor="#AEAEFF"><img src="../imagens/cantoJ9.gif" width="174" height="34" border="0" onClick="JavaScript: abas('cursos_destaque');"></td>
					  <td height="10" background="../imagens/cantoJ8.gif" width="100%" valign="top"></td>
					  <td width="10" height="10" align="right" valign="top" background="../imagens/cantoJ7.gif"><img src="../imagens/cantoJ2.gif" width="10" height="10" border="0"></td>
				    </tr>
				    <tr>
					  <td width="10" height="10" align="left" valign="top" background="../imagens/cantoJ10.gif"></td>
					  <td height="24" bgcolor="#FFE1E1" width="100%" align="right"><?php if ($turma_situacao_encontrado) { ?><a onClick="window.location.href = 'index.php?cod_inst=<?php  echo $cod_inst; ?>&situacao_turma=A'" class="link_vermelho" onMouseOver="JavaScript: window.status = 'Cursos Ativos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Em Andamento</a>&nbsp;|&nbsp;<a onClick="window.location.href = 'index.php?cod_inst=<?php echo $cod_inst; ?>&situacao_turma=I'" class="link_vermelho" onMouseOver="JavaScript: window.status = 'Cursos Ativos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Concluídos</a>&nbsp;|&nbsp;<a onClick="window.location.href = 'index.php?cod_inst=<?php echo $cod_inst; ?>'" class="link_vermelho" onMouseOver="JavaScript: window.status = 'Todos Cursos';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor: pointer">Todos</a><?php } ?></td>
					  <td width="10" background="../imagens/cantoJ7.gif"></td>
				    </tr>
				    <tr>
					  <td width="10" background="../imagens/cantoJ5.gif"></td>
					  <td colspan="2" bgcolor="#FFE1E1">
					  <div id="cursos_destaque">
					    <table width="100%"  border="0" cellspacing="3" cellpadding="2">
					    <form name="redireciona_usuario" method="post">
						<?php
							$cod_inst = "";
							
							if ($_GET["cod_inst"])
								$cod_inst = $_GET["cod_inst"];
							else
								if ($_SESSION["cod_inst"])
									$cod_inst = $_SESSION["cod_inst"];
								
							$total_turmas_usuario = count($vetor_turmas_usuario);
						?>
						  <tr>
							<td width="20%"><input type="hidden" name="cod_turma"><input type="hidden" name="acesso"><input type="hidden" name="cod_inst"></td>
							<td width="60%" class="vermelho">Curso</td>
							<td width="20%" class="vermelho">Acesso</td>
						  </tr>
						<?php
								for ($i = 0; $i < $total_turmas_usuario; $i++)
								{
									$cod_instituicao = $vetor_turmas_usuario[$i]["cod_instituicao"];
									$cod_curso = $vetor_turmas_usuario[$i]["cod_curso"];
									$curso = new curso();
									$curso->carregar($cod_curso);
									
									$nome_curso = $curso->getNome();
									$cod_instituicao = $curso->getCodigoInstituicao();
									$qtde_horas = $curso->getQtdeHoras();
									$imagem_curso = $curso->getImagem();
									$instituicao = new instituicao();
									$instituicao->carregar($cod_instituicao);
									$nome_instituicao = $instituicao->getNome();
									
									$diretorio_curso = "../arquivos/".$cod_instituicao."/cursos/".$cod_curso."/imagens/".$imagem_curso;
									
									if (!file_exists($diretorio_curso))
										$diretorio_curso = "../imagens/"._SEM_FOTO;
								
									$turmas_curso = new curso();
									$turmas_curso->colecaoTurmas($cod_curso);
									$total_turmas = $turmas_curso->linhas;
									$cod_turma = $vetor_turmas_usuario[$i]["cod_turma"];
									
									$usuario_turma = new usuario();
									$usuario_turma->verificaAcessoTurma($cod_usuario, $cod_turma);
									$acesso = $usuario_turma->data["acesso"];
									$situacao_usuario_turma = $usuario_turma->data["situacao"];
									
									$turma = new turma();
									$turma->carregar($cod_turma);
									$descricao_turma = $turma->getDescricao();
									$data_final = formataData($turma->getDataFim(), "/");
									$situacao_turma_atual = $turma->getSituacao();
									
									if ($acesso == "")
										$tipo_acesso = "Visitante";
									else
										if ($acesso == "T")
											$tipo_acesso = "Tutor";
										else
											if ($acesso == "L")
												$tipo_acesso = "Aluno";
											else
												if ($acesso == "S")
													$tipo_acesso = "Suporte Técnico";
												else
													if ($acesso == "P")
														$tipo_acesso = "Supervisor do Sistema";

									$link_instituicao = $nome_instituicao;
									$link_curso = $nome_curso;
									
									if (($situacao_turma_atual == "A") and ($situacao_usuario_turma == "A"))
									{
										$link_turma = "<a class=\"link_vermelho\" onClick=\"JavaScript:  redirecionaUsuario(".$cod_turma.", '".$acesso."', ".$cod_instituicao.");\" onMouseOver=\"JavaScript: window.status = '".$descricao_turma."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">".$descricao_turma."</a>";
										$link_acessar = "<a class=\"link_vermelho\" onClick=\"JavaScript: redirecionaUsuario(".$cod_turma.", '".$acesso."', ".$cod_instituicao.");\" onMouseOver=\"JavaScript: window.status = 'Acessar esta Turma';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">acessar</a>";
									}
									else
										if ($situacao_turma_atual == "I")
										{
											$link_turma = "<a class=\"link_vermelho\" onClick=\"JavaScript:  cursoConcluido('".$data_final."', '".$nome_curso."');\" onMouseOver=\"JavaScript: window.status = '".$descricao_turma."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">".$descricao_turma."</a>";
											$link_acessar = "<a class=\"link_vermelho\" onClick=\"JavaScript: cursoConcluido('".$data_final."', '".$nome_curso."');\" onMouseOver=\"JavaScript: window.status = 'Acessar esta Turma';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">acessar</a>";
										}
										else
											if ($situacao_usuario_turma == "I")
											{
												$link_turma = "<a class=\"link_vermelho\" onClick=\"JavaScript:  acessoBloqueado('".$nome_curso."');\" onMouseOver=\"JavaScript: window.status = '".$descricao_turma."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">".$descricao_turma."</a>";
												$link_acessar = "<a class=\"link_vermelho\" onClick=\"JavaScript: acessoBloqueado('".$nome_curso."');\" onMouseOver=\"JavaScript: window.status = 'Acessar esta Turma';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor: pointer\">acessar</a>";
											}
								
									if (!empty($cod_inst))
									{
										if ($cod_inst == $cod_instituicao)
										{
						?>
						  <tr valign="top" bgcolor="#FFD7D7">
						    <td width="20%" valign="middle" align="center"><img src="<?php echo $diretorio_curso; ?>" width="64" height="64"></td>
						    <td width="60%" valign="middle">
							  <table width="100%" cellpadding="0" cellspacing="0">
							    <tr>
								  <td class="vermelho"><img src="../imagens/seta_vermelha.gif" width="10" height="10">&nbsp;<?php echo $link_instituicao; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_curso; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_turma; ?></td>
							    </tr>
							    <tr>
								  <td align="right"><?php echo $link_acessar; ?></td>
							    </tr>
							  </table>
						     </td>
						     <td width="20%" class="vermelho"><?php echo $tipo_acesso; ?></td>
						   </tr>
						<?php
										}
									}
									else
									{
						?>
						  <tr valign="top" bgcolor="#FFD7D7">
						    <td width="20%" valign="middle" align="center"><img src="<?php echo $diretorio_curso; ?>" width="64" height="64"></td>
						    <td width="60%" valign="middle">
							  <table width="100%" cellpadding="0" cellspacing="0">
							    <tr>
								  <td class="vermelho"><img src="../imagens/seta_vermelha.gif" width="10" height="10">&nbsp;<?php echo $link_instituicao; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_curso; ?></td>
							    </tr>
							    <tr>
								  <td class="vermelho_simples">&nbsp;<?php echo $link_turma; ?></td>
							    </tr>
							    <tr>
								  <td align="right"><?php echo $link_acessar; ?></td>
							    </tr>
							  </table>
						     </td>
						     <td width="20%" class="vermelho"><?php echo $tipo_acesso; ?></td>
						   </tr>
						<?php
									}
								}
						?>
					      </form>
					    </table>
					    </div>
					  </td>
					  <td width="10" align="right" background="../imagens/cantoJ7.gif"></td>
					</tr>
					<tr>
					  <td width="10" height="10" align="left" valign="bottom" background="../imagens/cantoJ5.gif"><img src="../imagens/cantoJ4.gif" width="10" height="10" border="0"></td>
					  <td height="10" background="../imagens/cantoJ6.gif" colspan="2"></td>
					  <td width="10" height="10" align="right" valign="bottom" background="../imagens/cantoJ7.gif"><img src="../imagens/cantoJ3.gif" width="10" height="10" border="0"></td>
					</tr>
				  </table>
		         </td>
		       </tr>
		     </table>
			</td>
		  </tr>
		</table>
	  </td>
	</tr>
  </table>
  <?php
  	}
  ?> 
</body>
</html>