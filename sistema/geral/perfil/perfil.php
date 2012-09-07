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

include("../../../config/session.lib.php");
include("../../../config/config.bd.php");
include("../../../classes/classe_bd.php");
include("../../../classes/usuario.php");
include("../../../classes/perfil.php");
include("../../../funcoes/funcoes.php");

$cod_usuario = $_GET["cod_usuario"];
$cod_turma = $_SESSION["cod_turma"];

if ($cod_usuario)
{
	//Dados Perfil -> Objeto Usuário
	$usuario = new usuario();
	$usuario->carregar($cod_usuario);
	
	$nome = $usuario->getNome();
	$data_nascimento = formataData($usuario->getDataNascimento(), "/");
	$sexo = $usuario->getSexo();
	$login = $usuario->getLogin();
	$cpf = $usuario->getCPF();
	$email = $usuario->getEmail();
	
	$usuario->verificaAcessoTurma($cod_usuario, $cod_turma);
	$acesso = $usuario->data["acesso"];
	
	if ($acesso == "T")
	$tipo_acesso = "Tutor";
	else
		if ($acesso == "L")
			$tipo_acesso = "Aluno";
		else
			if ($acesso == "S")
				$tipo_acesso = "Suporte OnLine";
	//
	
	//Dados Perfil -> Objeto Perfil
	$perfil = new perfil();
	$perfil->carregar($cod_usuario);
	
	$cod_perfil = $perfil->getCodigo();
	if ($cod_perfil != "")
	{
		//Dados Pessoais
		$descricao = $perfil->getDescricaoPessoal();
		$interesse = $perfil->getInteresse();
		$foto = $perfil->getFoto();
		$miniatura= $perfil->getMiniatura();
		$cidade = $perfil->getCidade();
		$uf = $perfil->getUF();
		$uf = ufExtenso($uf);
		$site_pessoal = $perfil->getSitePessoal();
		
		//Dados Profissionais
		$empresa = $perfil->getEmpresa();
		$cargo = $perfil->getCargo();
		$detalhes = $perfil->getDetalhes();
		$profissao = $perfil->getProfissao();
		$site_profissional = $perfil->getSiteProfissional();
		$diretorio = $_SESSION["dir_perfil"].$cod_usuario."/";
		
		if ($foto != "sem_foto.gif")
		{
			//Diretório dos Arquivos
			//Miniatura da Imagem
			if (($miniatura != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $miniatura)) and (file_exists($diretorio.$miniatura)))
			{
				$arquivo = "../../../arquivos/perfil/".$cod_usuario."/".$miniatura;
				$img_miniatura = true;
			}
			else
			{
				$img_miniatura = false;
				//echo "miniatura false";	
			}
			
			//Foto no tamanho Original	
			if (($foto != "") and (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto)) and (file_exists($diretorio.$foto)))
			{
				$foto_g = "../../../arquivos/perfil/".$cod_usuario."/".$foto;
				$img_foto = true;
			}
			else
			{
				$img_foto = false;
				//echo "foto false";
			}
				
			if ($img_foto === true)
			{
				if ($img_miniatura === true)
				{
					$dimensoes = dimensoesImagem($foto_g, 40);
					$dimensoes = explode(".", $dimensoes);
					$largura = $dimensoes[0];
					$altura = $dimensoes[1];
					$link = "janela('Foto','".$foto_g."' ,100 ,100 ,".$largura." ,".$altura." ,0 ,0 ,0 ,1 ,1);";
				}
				else
					$link = "";
			}
			else
				{
					$arquivo = "../../imagens/sem_foto.gif";
					$link = "";
				}
		}
		else
			{
				$arquivo = "../../imagens/sem_foto.gif";
				$link = "";
			}
	}
	else
		$sem_perfil = "redimensionar(this, 400, 140);";
}	

?>
<html>
<head>
<title>Sa&sup2;po - Perfil</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../funcoes/funcoes.js"></script>

<body leftmargin="0" topmargin="0" onLoad="<?php echo $sem_perfil; ?>">
<table width="99%" border="0" cellspacing="0" cellpadding="0" class="tabelaMenu">
  <tr>	
	<td valign="top">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
	  	<?php
			if ($cod_perfil != "")
			{
		?>
	    <tr>
		  <td colspan="3" class="menuTitulo">Perfil do Usuário <?php echo $login; ?></td>
		</tr>
	    <tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Categoria:</td>
		  <td width="10">&nbsp;</td>
		  <td align="left" class="conteudoTextoBold"><?php echo $tipo_acesso; ?></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="3" align="left" class="menuTitulo">Dados Pessoais</td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td width="140" align="right" valign="top" class="conteudoTextoBold">Imagem de Exibição:</td>
		  <td width="10">&nbsp;</td>
		  <td align="left"><a href="#" onClick="<?php echo $link; ?>"><img src="<?php echo $arquivo; ?>" border="0"></a></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Nome Completo:</td>
		  <td>&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($nome == "")
		  		echo "Não Informado";		
			else
				echo $nome;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Sexo:</td>
		  <td>&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php 
		  	if ($sexo == "")
				echo "Não Informado";
			else
			{
				if ($sexo == "M") 
					echo "Masculino";
				else 
					if ($sexo == "F") echo "Feminino";
			}
		  ?>
		  </td>
		</tr>
		<tr>
  		  <td width="140" align="right" class="conteudoTextoBold">Data de Nascimento:</td>
		  <td>&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($data_nascimento == "")
				echo "Não Informado";
			else
		  		echo $data_nascimento;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Cidade / Estado:</td>
		  <td >&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php 
		  	if (($cidade == "") or ($uf == ""))
				echo "Não Informado";
			else
				echo $cidade." / ".$uf;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold" valign="top">Descri&ccedil;&atilde;o Pessoal:</td>
		  <td>&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($descricao == "")
				echo "Não Informado";
			else
		  		echo nl2br($descricao); 
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold" valign="top">Interesses:</td>
		  <td>&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($interesse == "")
				echo "Não Informado";
			else
		  		echo nl2br($interesse);
		   ?>
		   </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Site Pessoal:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($site_pessoal == "")
				echo "Não Informado";
			else 
				echo "<a href=\"".$site_pessoal."\" target=\"_blank\">".$site_pessoal."</a>";
		  ?>
		  </td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="3" align="left" class="menuTitulo">Dados Profissionais</td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Profiss&atilde;o:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($profissao == "")
				echo "Não Informado";
			else
		  		echo $profissao;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Institui&ccedil;&atilde;o / Empresa:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($empresa == "")
				echo "Não Informado";
			else
		  		echo $empresa;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Cargo / Fun&ccedil;&atilde;o:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($cargo == "")
				echo "Não Informado";
			else	
				echo $cargo;
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold">Site:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($site_profissional == "")	
		 		echo "Não Informado";
			else
				echo "<a href=\"".$site_profissional."\" target=\"_blank\">".$site_profissional."</a>";
		  ?>
		  </td>
		</tr>
		<tr>
		  <td width="140" align="right" class="conteudoTextoBold" valign="top">Detalhes:</td>
		  <td width="10">&nbsp;</td>
		  <td class="conteudoTexto">
		  <?php
		  	if ($detalhes == "")
		 		echo "Não Informado";
			else
		  		echo nl2br($detalhes);
		  ?>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php
  	}
	else
	{
  ?>
  <tr>
    <td class="conteudoTextoBold" align="center">Infelizmente o Usuário "<?php echo $nome; ?>" não possui Perfil cadastrado no sistema.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php
  	}
  ?>
  <tr>
    <td align="center"><input type="button" name="fecha" value="Fechar" onClick="JavaScript: self.close();"></td>
  </tr>
</table>
</body>
</html>