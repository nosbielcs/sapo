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
include("../classes/instituicao.php");
include("../classes/curso.php");
include("../funcoes/funcoes.php");

$cod_inst = $_GET["cod_inst"];

$instituicao = new instituicao();
$instituicao->carregar($cod_inst);
$nome = $instituicao->getNome();
$descricao = $instituicao->getDescricao();
$cidade = $instituicao->getCidade();
$endereco = $instituicao->getEndereco();
$cep = $instituicao->getCEP();
$telefone = $instituicao->getTelefone();
$email = $instituicao->getEmail();
$site = $instituicao->getSite();
$uf = $instituicao->getUF();
$uf = ufExtenso($uf);

?>
<html>
<head>
<title>Informações Sobre a Instituição - <?php echo $nome; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../config/estilo.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../funcoes/funcoes.js"></script>

<body leftmargin="0" topmargin="0">
<table width="99%" border="0" cellpadding="0" cellspacing="0" class="tabelaMenu">
  <tr>
    <td>
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php				
	  	if (isset($cod_inst))
		{
	  ?>
		<tr>
		  <td class="conteudoTextoBold">Informa&ccedil;&otilde;es Sobre a Institui&ccedil;&atilde;o</td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td>
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="80" class="campos" align="right">Nome:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $nome; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right" valign="top">Descrição:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo nl2br($descricao); ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Site:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo "<a href=\"".$site."\" target=\"_blank\">".$site."</a>"; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Email:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $email; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Cidade:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $cidade; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Estado:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $uf; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Endereço:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $endereco; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">CEP:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $cep; ?></td>
			</tr>
			<tr>
			  <td width="80" class="campos" align="right">Telefone:</td>
			  <td width="10">&nbsp;</td>
			  <td colspan="3" class="conteudoTextoBold" align="left"><?php echo $telefone; ?></td>
			</tr>
			</table>
		  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td class="conteudoTextoBold" align="left">Cursos Ofertados</td>
		</tr>
	  <?php
	  		$cursos_instituicao = new curso();
			$cursos_instituicao->colecaoCursoInstituicao($cod_inst);
			$total_cursos = $cursos_instituicao->linhas;
			
			if ($total_cursos > 0)
			{
	  ?>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td>
	  	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <?php
				for ($i = 0; $i < $total_cursos; $i++)
				{
					$cod_curso = $cursos_instituicao->data["cod_curso"];
					$curso = new curso();
					$curso->carregar($cod_curso);
					$nome_curso = $curso->getNome();
					$link_curso = "<a href=\"#\" onClick=\"JavaScript: visualizaCurso(".$cod_curso.");\">".$nome_curso."</a>";
	  ?>
	        <tr>
		      <td width="80" class="campos" align="right">Curso:</td>
			  <td width="10">&nbsp;</td>
	          <td><?php echo $link_curso; ?></td>
	        </tr>
	  <?php		
	  				$cursos_instituicao->proximo();
	  			}
	  ?>
	  	  </table>
		</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td class="conteudoTextoBold">Observação: Para obter mais Informações clique sobre o Curso.</td>
	  </tr>
	  <?php	
	  		}
			else
			{
	  ?>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td class="conteudoTexto">No momento esta Instituição não está ofertando cursos.</td>
	  </tr>
	  <?php
	  		}
		}
	  ?>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center"><input type="button" name="fecha" value="Fechar" onClick="JavaScript: self.close();"></td>
	  </tr>
	  </table>
    </td>
  </tr>
</table>
</body>
</html>