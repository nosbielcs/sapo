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
include("../../../classes/sala_bate_papo.php");
include("../../../classes/mensagem_bate_papo.php");
include("../../../funcoes/funcoes.php");

if ($_GET["sala_bate_papo"])
{
	$cod_sala = $_GET["sala_bate_papo"];
	$sala_bate_papo = new sala_bate_papo();
	$sala_bate_papo->carregar($cod_sala);
	
	$nome_sala = $sala_bate_papo->getNome();
	$descricao_sala = $sala_bate_papo->getDescricao();
	$data_bate_papo = formataData($sala_bate_papo->getDataBatePapo(), "/");
	$hora_bate_papo = $sala_bate_papo->getHoraBatePapo();
	//onLoad="redimensionar(this, 340, 180);"
}
?>
<html>
<head>
<title>Exportar Encontro Sala Bate Papo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<body>
<table width="99%" cellpadding="0" cellspacing="0" border="0" align="center" class="tabelaMenu">
  <tr>
    <td>
	  <table width="100%" cellpadding="0" cellspacing="0"> 
	    <tr>
		  <td class="conteudoTextoBold">Exportar Dados da Sala de Bate Papo - <?php echo $nome_sala; ?></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td class="conteudoTextoBold">Opções:</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><a href="exportar_bate_papo.php?sala_bate_papo=<?php echo $cod_sala; ?>&acao=visualizar">Visualizar Bate Papo</a></td>
		</tr>
		<tr>
		  <td><a href="exportar_bate_papo.php?sala_bate_papo=<?php echo $cod_sala; ?>&acao=texto">Exportar Bate Papo em Arquivo Texto. (Arquivo TXT)</a></td>
		</tr>
		<tr>
		  <td><a href="exportar_bate_papo.php?sala_bate_papo=<?php echo $cod_sala; ?>&acao=pdf">Exportar Bate Papo em Arquivo PDF. (Arquivo PDF)</a></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td>
			<?php
				if ($_GET["acao"])
				{
					$acao = $_GET["acao"];
					switch($acao)
					{
						case "visualizar":
							$mensagens_bate_papo = new mensagem_bate_papo();
							$mensagens_bate_papo->colecao($cod_sala);
							$total = $mensagens_bate_papo->linhas;
							
							echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"tabelaMenu\">";
							echo "<tr>";
							echo "<td>";
							echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">";
							echo "<tr>";
							echo "<td><a href=\"exportar_bate_papo.php?sala_bate_papo=".$cod_sala."\">Voltar</a></td>";
							echo "</tr>";
							
							for ($i; $i < $total; $i++)
							{
								$cod_mensagem = $mensagens_bate_papo->data["cod_mensagem"];
								
								$mensagem = new mensagem_bate_papo();
								$mensagem->carregar($cod_mensagem, $cod_sala);
								
								$destino = $mensagem->getCodigoDestinatario();
								$origem = $mensagem->getCodigoUsuario();
								$cor_mensagem = $mensagem->getCorMensagem();
								$mensagem_enviada = $mensagem->getMensagem();
								$reservado = $mensagem->getReservado();
								$modo_mensagem = $mensagem->getModoMensagem();
								$data_mensagem = formataData($mensagem->getDataMensagem(), "/");
								$hora_mensagem = $mensagem->getHoraMensagem();
								
								$mensagens_bate_papo->proximo();
								$usuario = new usuario();
								$usuario->carregar($origem);
								$nome_origem = $usuario->getNome();
								
								if ($destino == 0)
									$nome_destino = "Todos";
								else
								{
									$usuario->carregar($destino);
									$nome_destino = $usuario->getNome();
								}
								
								
								echo "<tr>";
								echo "  <td  class=\"conteudoTexto\"><font color=\"".$cor_mensagem."\"><b>".$nome_origem."</b> às ".$hora_mensagem." ".$modo_mensagem." ".$nome_destino.": ".$mensagem_enviada."</font></td>";
								echo "</tr>";
								echo "<tr>";
								echo "  <td>&nbsp;</td>";
								echo "</tr>";
							}
							
							echo "</td>";
							echo "</tr>";
							echo "</table>";
						break;
						
						case "texto":
							$mensagens_bate_papo = new mensagem_bate_papo();
							$mensagens_bate_papo->colecao($cod_sala);
							$total = $mensagens_bate_papo->linhas;
							
							$nome_arquivo = "bate_papo_".date("dmY")."_".date("His").".txt";
							$ponteiro = fopen($nome_arquivo, "ab");
							$titulo = "------------------------------------------------------------------------------\n";
							$titulo.= "DOCUMENTO GERADO ".date("d/m/Y")." ÀS ".date("H:i:s")."\n";
							$titulo.= "CURSO: ".$_SESSION["nome_curso"]."\n";
							$titulo.= "TURMA: ".$_SESSION["nome_turma"]."\n";
							$titulo.= "SALA DE BATE PAPO: ".$nome_sala."\n";
							$titulo.= "RESPONSÁVEL PELA GERAÇÃO: ".$_SESSION["nome_usuario"]."\n";
							$titulo.= "------------------------------------------------------------------------------\n\n";
							
							fwrite($ponteiro, $titulo);							
							for ($i; $i < $total; $i++)
							{
								$cod_mensagem = $mensagens_bate_papo->data["cod_mensagem"];
								
								$mensagem = new mensagem_bate_papo();
								$mensagem->carregar($cod_mensagem, $cod_sala);
								
								$destino = $mensagem->getCodigoDestinatario();
								$origem = $mensagem->getCodigoUsuario();
								$cor_mensagem = $mensagem->getCorMensagem();
								$mensagem_enviada = $mensagem->getMensagem();
								$reservado = $mensagem->getReservado();
								$modo_mensagem = $mensagem->getModoMensagem();
								$data_mensagem = formataData($mensagem->getDataMensagem(), "/");
								$hora_mensagem = $mensagem->getHoraMensagem();
								
								$mensagens_bate_papo->proximo();
								$usuario = new usuario();
								$usuario->carregar($origem);
								$nome_origem = $usuario->getNome();
								
								if ($destino == 0)
									$nome_destino = "Todos";
								else
								{
									$usuario->carregar($destino);
									$nome_destino = $usuario->getNome();
								}
								
								$linha_bate_papo = $nome_origem." às ".$hora_mensagem." ".$modo_mensagem." ".$nome_destino.": ".$mensagem_enviada."\n\n";
								fwrite($ponteiro, $linha_bate_papo);
							}
							
							$rodape = "------------------------------------------------------------------------------\n";
							$rodape.= "Sa²po - Sistema de Apoia à Aprendizagem Online\n";
							$rodape.= "------------------------------------------------------------------------------";
							
							fwrite($ponteiro, $rodape);
							fclose($ponteiro);
						break;
					}
			?>
		  </td>
		</tr>
		<?php
			}
		?>
	  </table>
	</td>
  </tr>
  <?php
  	if ($_GET["acao"])
	{
  ?>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <?php
  	}
  ?>
</table>
</body>
</html>