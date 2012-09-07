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

// Headers


session_start();

include("../../../config/session.lib.aluno.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/mensagem_bate_papo.php");
include("../../../classes/usuario.php");
include("../../../classes/perfil.php");
include("../../../funcoes/funcoes.php");
include("../../../funcoes/smilies.php");

$cod_sala = $_SESSION["cod_sala"];
$mensagens_bate_papo = new mensagem_bate_papo();
$mensagens_bate_papo->colecao($cod_sala);
$total_mensagens_bate_papo = $mensagens_bate_papo->linhas;

/*for ($j = 0; $j < $total_mensagens_bate_papo; $j++)
{
	$data_comparacao = date("Y-m-d");
	$hora_comparacao = date("H").":".date("i").":".(date("s") - 3);
	$cod_mensangem_bate_papo = $mensagens_bate_papo->data["cod_mensagem"];
	$mensagem_bate_papo = new mensagem_bate_papo();
	$mensagem_bate_papo->carregar($cod_mensangem_bate_papo, $cod_sala);
	$cod_usuario = $mensagem_bate_papo->getCodigoUsuario();
	$mensagem = $mensagem_bate_papo->getMensagem();
	$data_mensagem = $mensagem_bate_papo->getDataMensagem();
	$hora_mensagem = $mensagem_bate_papo->getHoraMensagem();
	$reservado = $mensagem_bate_papo->getReservado();
	
	if (($data_mensagem >= $data_comparacao) and ($hora_mensagem > $hora_comparacao) and ($reservado == "N") and (($mensagem == "Entrou na Sala de Bate Papo") or ($mensagem == "Saiu da Sala de Bate Papo")) and ($cod_usuario != $_SESSION["cod_usuario"]))
	{
		$_SESSION["onLoad"] = "onLoad=\"JavaScript: atualizaListaUsuarios();\"";
	}	
	
	$mensagens_bate_papo->proximo();	
}*/

$data_comparacao = $_SESSION["data_comparacao"];
$hora_comparacao = $_SESSION["hora_comparacao"];

$mensagens_bate_papo->primeiro();
$mensagens_bate_papo = new mensagem_bate_papo();
$mensagens_bate_papo->colecao($cod_sala);
$total_mensagens_bate_papo = $mensagens_bate_papo->linhas;

for ($i = 0; $i < $total_mensagens_bate_papo; $i++)
{
	$cod_mensangem_bate_papo = $mensagens_bate_papo->data["cod_mensagem"];
	$mensagem_bate_papo = new mensagem_bate_papo();
	$mensagem_bate_papo->carregar($cod_mensangem_bate_papo, $cod_sala);
	$data_mensagem = $mensagem_bate_papo->getDataMensagem();
	$data_mensagem_imprime = formataData($mensagem_bate_papo->getDataMensagem(), "/");
	$hora_mensagem = $mensagem_bate_papo->getHoraMensagem();
	$modo_mensagem = $mensagem_bate_papo->getModoMensagem();
	$mensagem = $mensagem_bate_papo->getMensagem();
	$cod_usuario = $mensagem_bate_papo->getCodigoUsuario();
	$cod_destinatario = $mensagem_bate_papo->getCodigoDestinatario();
	$reservado = $mensagem_bate_papo->getReservado();
	$cor_mensagem = $mensagem_bate_papo->getCorMensagem();
	
	$usuario_origem = new usuario();
	$usuario_origem->carregar($cod_usuario);
	
	$perfil = new perfil();
	$perfil->carregar($cod_usuario);
	
	$nome_usuario = $perfil->getApelido();
	if (empty($nome_usuario))
		$nome_usuario = $usuario_origem->getNome();

	/*/Foto Usuário	
	$perfil = new perfil();
	$perfil->carregar($cod_usuario);

	$cod_perfil = $perfil->getCodigo();
	$foto = $perfil->getFoto();
	$miniatura = $perfil->getMiniatura();
	$dir_perfil = $cod_usuario;
	
	if ($foto != "sem_foto.gif")
	{		
		//Diretório dos Arquivos
		if ($miniatura != "")
		{
			$arquivo = "../../../arquivos/perfil/".$dir_perfil."/".$miniatura;
			$foto_g = "../../../arquivos/perfil/".$dir_perfil."/".$foto;
			if ((file_exists($arquivo)) and (file_exists($foto_g)))
			{	
				$dimensoes = dimensoesImagem($foto_g, 40);
				$dimensoes = explode(".", $dimensoes);
				$largura = $dimensoes[0];
				$altura = $dimensoes[1];
			}
			else
				$arquivo = "../../imagens/sem_foto.gif";
		}
	}
	else
		$arquivo = "../../imagens/".$foto;
	/*/
	
	if ($cod_destinatario == 0)
		$nome_destinatario = "Todos";
	else
	{
		$usuario_destino = new usuario();
		$usuario_destino->carregar($cod_destinatario);
		$usuario_origem->carregar($cod_usuario);
		
		$perfil_destino = new perfil();
		$perfil_destino->carregar($cod_destinatario);
		$nome_destinatario = $perfil_destino->getApelido();
		if (empty($nome_destinatario))
			$nome_destinatario = $usuario_destino->getNome();
	}
	
	$mensagem = substituiSmilies($mensagem, $smilies, "../../../imagens/icones/smilies/");
	
	if (($data_mensagem >= $data_comparacao) and ($hora_mensagem > $hora_comparacao) and ($reservado == "N"))
	{
		
		$_SESSION["data_comparacao"] = $data_mensagem;
		$_SESSION["hora_comparacao"] = $hora_mensagem;
		$hora_mensagem = substr($hora_mensagem, 0, 5);
		echo "<div class='$cor_mensagem'>&nbsp;<b>$nome_usuario</b> &agrave;s $hora_mensagem $modo_mensagem <b><i>$nome_destinatario</i></b>: $mensagem<br></div><img src='../../../imagens/icones/bate_papo/espaco_chat.gif' border='0'>";
		//echo "<img height='20' width='20' border='1' src='$arquivo'> <font color='$cor_mensagem'><b>$nome_usuario</b> &agrave;s $hora_mensagem $modo_mensagem <b><i>$nome_destinatario</i></b>: $mensagem</font><br><br>";
	}
	else
		if (($data_mensagem >= $data_comparacao) and ($hora_mensagem > $hora_comparacao) and ($reservado == "S"))
		{
			if (($_SESSION["cod_usuario"] == $cod_destinatario) or ($_SESSION["cod_usuario"] == $cod_usuario))
			{
				$_SESSION["data_comparacao"] = $data_mensagem;
				$_SESSION["hora_comparacao"] = $hora_mensagem;
				$hora_mensagem = substr($hora_mensagem, 0, 5);
				echo "<div class='$cor_mensagem'>&nbsp;<b>$nome_usuario</b> &agrave;s $hora_mensagem Fala em Reservado com <b><i>$nome_destinatario</i></b>: $mensagem<br></div><img src='../../../imagens/icones/bate_papo/espaco_chat.gif' border='0'>";
				//echo "<img height='15' width='15' border='1' src='$arquivo'> <font color='$cor_mensagem'><b>$nome_usuario</b> &agrave;s $hora_mensagem Fala em Reservado com <b><i>$nome_destinatario</i></b>: $mensagem</font><br><br>";
			}
		}
	
	$mensagens_bate_papo->proximo();
}
?>