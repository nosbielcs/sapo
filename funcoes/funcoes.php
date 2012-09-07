<?php

function substituiCaracter($texto, $tipo)
{	
	if ($tipo == "link")
	{
		//Maísculas
		$caracteres["À"] = "%C0";
		$caracteres["Á"] = "%C1";
		$caracteres["Â"] = "%C2";
		$caracteres["Ã"] = "%C3";
		
		$caracteres["È"] = "%C8";
		$caracteres["É"] = "%C9";
		$caracteres["Ê"] = "%CA";
		
		$caracteres["Ì"] = "%C8";
		$caracteres["Í"] = "%C9";
		$caracteres["Î"] = "%C9";
		
		$caracteres["Ò"] = "%D2";
		$caracteres["Ó"] = "%D3";
		$caracteres["Ô"] = "%D4";
		$caracteres["Õ"] = "%D5";
		
		$caracteres["Ù"] = "%D9";
		$caracteres["Ú"] = "%DA";
		$caracteres["Û"] = "%DB";
		
		$caracteres["Ç"] = "%C7";
		
		//Minusculas
		$caracteres["à"] = "%E0";
		$caracteres["á"] = "%E1";
		$caracteres["â"] = "%E2";
		$caracteres["ã"] = "%E3";
		
		$caracteres["è"] = "%E8";
		$caracteres["é"] = "%E9";
		$caracteres["ê"] = "%EA";
		
		$caracteres["ì"] = "%EC";
		$caracteres["í"] = "%ED";
		$caracteres["î"] = "%EE";
		
		$caracteres["ò"] = "%F2";
		$caracteres["ó"] = "%F3";
		$caracteres["ô"] = "%F4";
		$caracteres["õ"] = "%F5";
		
		$caracteres["ù"] = "%F9";
		$caracteres["ú"] = "%FA";
		$caracteres["û"] = "%FB";
		
		$caracteres["ç"] = "%E7";
		
		$caracteres[" "] = "%20";
	}
	
	if ($tipo == "diretorio")
	{
		$caracteres[","] = "\,";
		$caracteres["("] = "\(";
		$caracteres[")"] = "\)";
	}
	
	if(array_key_exists($texto, $caracteres))
		return($caracteres["$texto"]);
	else
		return($texto);
}

//Função que reduz Textos Longos e coloca 3 pontos
function reduzTexto($texto, $tamanho)
{
	if (strlen($texto) > $tamanho) 
	{
		$texto = substr($texto, 0, intval($tamanho)) ."...";
	}
	
	return $texto;
}

//Função de paginação
function paginacao($pagina, $inicial, $qtd_listagem, $total_linhas, $url, $variavel)
{
	if ($variavel)
		$url.= "&";
	else
		$url.= "?";
			
	//Inicio Listagem	
	if ($qtd_listagem != 0) 
		$total_paginas = ceil($total_linhas / $qtd_listagem);
	
	$numeracao = "<font class=\"preto\">Página</font> ";
	if ($pagina <> 1)
	{
		$num_pag = $pagina - 1;
		$numeracao.= "<a onClick=\"window.location.href = '".$url."pag=".$num_pag."&qtd=".$qtd_listagem."#topo'\" onMouseOver=\"JavaScript: window.status = 'Página $i';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Página $i\" style=\"cursor: pointer\"></a> ";
	}
	else
	{
		$numeracao.=  " ";
	}
	
	for ($i = 1; $i < ($total_paginas + 1); $i++)
	{
		if ($i == $pagina)
		{
			$numeracao.=  "<font class=\"vermelho\">&nbsp;&nbsp;".$i."&nbsp;&nbsp;</font>";
		}
		else
		{
			$numeracao.=  "<a onClick=\"window.location.href = '".$url."pag=".$i."&qtd=".$qtd_listagem."#topo'\" class=\"link_preto\" onMouseOver=\"JavaScript: window.status = 'Página $i';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" title=\"Página $i\" style=\"cursor: pointer\">&nbsp;".$i."&nbsp;</a>";
		}
	}
	
	if ($pagina < $total_paginas)
	{
		$num_pag = $pagina + 1;
		$paginas.=  "<a href='".$url."&pag=".$num_pag."'></a> ";
	}
	else
	{
		$numeracao.=  " ";
	}
	
	return $numeracao;
	//Fim Listagem
}

//Função para Formatar uma data no formato dd/mm/aaaa
function formataData($data, $separador)
{
	$dia = substr($data, 8, 2);
	$mes = substr($data, 5, 2);
	$ano = substr($data, 0, 4);
	
	$resultado = $dia.$separador.$mes.$separador.$ano;
	
	return $resultado;
}

//Função para Calculo de dias entre duas datas
function calculardiasentreduasdatas($data_inicio, $data_fim)
{
	$ano_inicio = substr($data_inicio, 6, 4);
	$mes_inicio = substr($data_inicio, 3, 2);
	$dia_inicio = substr($data_inicio, 0, 2);
	
	$ano_fim = substr($data_fim, 6, 4);
	$mes_fim = substr($data_fim, 3, 2);
	$dia_fim = substr($data_fim, 0, 2);
	
	$data_inicio = mktime(0, 0, 0, $mes_inicio, $dia_inicio, $ano_inicio);
	$data_fim = mktime(0, 0, 0, $mes_fim, $dia_fim, $ano_fim);
	
	$dias = ($data_fim - $data_inicio) / 86400;
	$dias = ceil($dias);
	
	return $dias;
}

//Criação de Diretórios
function verificaDiretorio($diretorio)
{
	if (!file_exists($diretorio))
	{
		mkdir($diretorio);
		chmod($diretorio, 0777);	
	}
		
	return $diretorio;
}

function removerDiretorio($diretorio)
{
    $t = glob($diretorio);
    foreach($t as $rs) 
	{
        if (is_dir($rs)) 
		{
            if (preg_match('/\.\.?$/', $rs))
			continue;
            removerDiretorio($rs.DIRECTORY_SEPARATOR.".*");
            removerDiretorio($rs.DIRECTORY_SEPARATOR."*");
            rmdir($rs);
        } 
		else 
            unlink($rs);
    }
}

function verificaArquivo($arquivo, $diretorio)
{
	$caminho = $diretorio.$arquivo;
	if (file_exists($caminho))
		$existe = true;
	else
		$existe = false;
	
	return $existe;
}

function redimensionaImagem($imagem, $diretorio)
{
	# Constantes
	define(BASE, $diretorio);
	define(ALTURA_MAX, 94);
	define(LARGURA_MAX, 86);
	
	# Carrega Imagem
	$img = null;
	$extensao = strtolower(end(explode('.', BASE.$imagem)));
	if (($extensao == 'jpg') || ($extensao == 'jpeg'))
		$img = @imagecreatefromjpeg(BASE.$imagem);
	else
		if ($extensao == 'png')
			$img = @imagecreatefrompng(BASE.$imagem); 
	  	else
			# Somente se sua GD suportar GIF
			if ($extensao == 'gif')
		  		$img = @imagecreatefromgif(BASE.$imagem);
	
	# Se a imagem for carregada com sucesso, teste o tamanho da imagem
	if ($img)
	{
		# Captura o tamanho e a escala da Imagem
		$largura = imagesx($img);
		$altura = imagesy($img);
		$escala = min(LARGURA_MAX / $largura, ALTURA_MAX / $altura);
	
		# If the image is larger than the max shrink it
		if (($escala < 1) or (($largura > LARGURA_MAX) or ($altura > ALTURA_MAX))) 
		{
			$nova_largura = floor($escala * $largura);
			$nova_altura = floor($escala * $altura);
	
			# Cria uma imagem temporaria
			$tmp_img = imagecreatetruecolor($nova_largura, $nova_altura);
	
			# Copia e redimensiona a imagem antiga para a nova imagem
			imagecopyresized($tmp_img, $img, 0, 0, 0, 0,$nova_largura, $nova_altura, $largura, $altura);
			imagedestroy($img);
			$img = $tmp_img;
		}
		
		# Cria a imagem nova
		if (($largura > LARGURA_MAX) or ($altura > ALTURA_MAX))
		{
			//Gera nome com _p para o novo arquivo redimensionado
			$nome = explode(".", $imagem);
			$miniatura = $nome[0]."_p.".$nome[1];
			imagejpeg($img, BASE.$miniatura);
		}
		else
			$miniatura = $imagem;
	}
	else
		# Cria erro se necessário
		if (!$img)
		{
			$img = imagecreate(LARGURA_MAX, ALTURA_MAX);
			imagecolorallocate($img, 0, 0, 0);
			$c = imagecolorallocate($img, 70, 70, 70);
			imageline($img, 0, 0, LARGURA_MAX, ALTURA_MAX, $c2);
			imageline($img, LARGURA_MAX, 0, 0, ALTURA_MAX, $c2);
		}
	
	return $miniatura;
}

function dimensoesImagem($imagem, $dimensao)
{
	$extensao = strtolower(end(explode('.', $imagem)));
	
	if ($extensao == 'jpg' || $extensao == 'jpeg')
		$img = @imagecreatefromjpeg($imagem);
	else
		if ($extensao == 'png')
			$img = @imagecreatefrompng($imagem); 
	  	else
			# Somente se sua GD suportar GIF
			if ($extensao == 'gif')
		  		$img = @imagecreatefromgif($imagem);
	
	$largura = imagesx($img) + $dimensao;
	$altura = imagesy($img) + $dimensao;
	
	return $largura.".".$altura; 
}

function ufExtenso($uf)
{
	switch($uf)
	{
		case "AC": return "Acre";
		case "AL": return "Alagoas";
		case "AM": return "Amazonas";
		case "AP": return "Amapá";
		case "BA": return "Bahia";
		case "CE": return "Ceará";
		case "DF": return "Distrito Federal";
		case "ES": return "Espírito Santo";
		case "GO": return "Goiás";
		case "MA": return "Maranhão";
		case "MG": return "Minas Gerais";
		case "MT": return "Mato Grosso";
		case "MS": return "Mato Grosso do Sul";
		case "PA": return "Pará";
		case "PB": return "Paraíba";
		case "PE": return "Pernambuco";
		case "PR": return "Paraná";
		case "PI": return "Piauí";
		case "RJ": return "Rio de Janeiro";
		case "RN": return "Rio Grande do Norte";
		case "RO": return "Rondônia";
		case "RR": return "Roraima";
		case "RS": return "Rio Grande do Sul";
		case "SC": return "Santa Catarina";
		case "SP": return "São Paulo";
		case "SE": return "Sergie";
		case "TO": return "Tocantins";
	}
}

function validaWebSite($website)
{
	if ($website != "")
	{
		if (!preg_match('#^http[s]?:\/\/#i', $website))
		{
			$website = 'http://' . $website;
		}

		if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $website))
		{
			$website = '';
		}
	}
	
	return $website;
}

function validaCPF($cpf)
{
	if (strlen($cpf) != 11)
		$resultado = 1;
	else
	{
		$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) +
				 ($cpf[2] * 8) + ($cpf[3] * 7) +
				 ($cpf[4] * 6) + ($cpf[5] * 5) +
				 ($cpf[6] * 4) + ($cpf[7] * 3) + ($cpf[8] * 2);
		$resto = $soma1 % 11;
		$digito1 = $resto < 2 ? 0 : 11 - $resto;
		$soma2 = ($cpf[0] * 11) + ($cpf[1]  * 10) +
			     ($cpf[2]  * 9) + ($cpf[3]  * 8) +
				 ($cpf[4]  * 7) + ($cpf[5]  * 6) +
			     ($cpf[6]  * 5) + ($cpf[7]  * 4) +
				 ($cpf[8]  * 3) + ($cpf[9] * 2);
		$resto = $soma2 % 11;
		$digito2 = $resto < 2 ? 0 : 11 - $resto;
		$retorno = (($cpf[9] == $digito1) && ($cpf[10] == $digito2));
		if ($retorno == 0) 
			$resultado = 1;
		if ($retorno == 1) 
			$resultado = 0;
			
	}
	return $resultado;
}

function formatarRecado($mensagem, $tipo)
{
	$mensagem = explode("\n", $mensagem);
	$tamanho = sizeof($mensagem);
	if ($tipo == "responder")
		$nova_mensagem = "\n\n\n--- Mensagem Original ---\n";
	else
		if ($tipo == "encaminhar")
			$nova_mensagem = "\n\n\n--- Mensagem Encaminhada ---\n";
	
	for ($i = 0; $i < $tamanho; $i++)
	{
		$string = strlen($mensagem[$i]);
		if ($string > 48)
		{
			$texto = explode(" ", $mensagem[$i]);
			$partes = sizeof($texto);
			$verifica = 0;
			for ($j = 0; $j < $partes; $j++)
			{
				if ($verifica == 0)
				{
					$novoTexto.= ">".$texto[$j]." ";
					$verifica = 1;
				}
				else
					$novoTexto.= $texto[$j]." ";
				
				
				if ($partes > ($j + 1))	
				{
					$testeNovoTexto = $novoTexto." ".$texto[$j + 1];
					$tamanhoTesteNovoTexto = strlen($testeNovoTexto);
					if ($tamanhoTesteNovoTexto >= 48)
					{
						$nova_mensagem.= trim($novoTexto)."\n";
						$verifica = 0;
						$novoTexto = trim("");
					}
				}
				else
				{
					$nova_mensagem.= trim($novoTexto)."\n";
					$novoTexto = trim("");
				}
			}
		}
		else		
			$nova_mensagem.= ">".$mensagem[$i]."\n";
	}	
	
	return $nova_mensagem;
}

function citarMsgForum($mensagem, $smilies)
{
	$mensagem = str_replace("[quote]", "£", $mensagem);
	$mensagem = str_replace("[/quote]", "¬", $mensagem);
	
	$total = strlen($mensagem);
	$inicio_tag = 0;
	$fim_tag = 0;
	$posicao_inicial = 0;
	$posicao_final = 0;
	$retorno = "";
	
	//Conta o Total de Tags que o Texto Possui
	for ($i = 0; $i < $total; $i++)
	{
		if ($mensagem[$i] == "£")
		{	
			$inicio_tag++;
			if ($inicio_tag == 1)
				$posicao_inicial = $i;
		}
		else
			if ($mensagem[$i] == "¬")
			{
				$fim_tag++;
				if ($fim_tag == $inicio_tag)
					$posicao_final = $i;
			}
	}
			
	//Substitui
	for ($i = 0; $i < $total; $i++)
	{
		if (($mensagem[$i] == "£"))
		{	
			$retorno.= "<table width=\"90%\" align=\"center\"><tr><td class=\"quote\">";	
		}
		else
			if (($mensagem[$i] == "¬"))
			{
				$retorno.= "</td></tr></table>";
			}
			else
				$retorno.= $mensagem[$i];			
	}
	
	$retorno = str_replace("£", "", $retorno);
	$retorno = str_replace("¬", "", $retorno);	
	$retorno = str_replace("</table><br />", "</table>", $retorno);
	
	$retorno = substituiSmilies($retorno, $smilies, "../../../imagens/icones/smilies/");
	return $retorno;
}

function formataCitacaoForum($autor, $mensagem)
{
	$retorno.= "[quote]<b>".$autor." escreveu:</b>\n".$mensagem."[/quote]";
	
	return $retorno;
}

function tamanhoDiretorio($diretorio, $tamanho)
{
	$diretorio_corrente = opendir($diretorio);
	
	while($entrada = readdir($diretorio_corrente))
	{
 		if(is_dir("$dir/$entrada") and ($entrada != "." and $entrada != ".."))
		{
			tamanhoDiretorio("${dir}/${entrada}", $tamanho);
		}
		else
			 if($entrada != "." and  $entrada != "..")
			 {
				$tamanho+=filesize("${diretorio}/${entrada}");
			 }
	}
	closedir($diretorio_corrente);
	
	return $tamanho;
}

function tamanhoArquivo($tamanho) 
{
 	$siglas = array("B", "KB", "MB", "GB", "TB", "PB");
    $posicao = 0;

    while ($tamanho >= 1024)
	{
		$tamanho /= 1024;
		$posicao++;
	}

    return round($tamanho, 2)." ".$siglas[$posicao];
}

function excluirDiretorio($diretorio)
{
	$diretorio_corrente = opendir($diretorio);
	while($entrada = readdir($diretorio_corrente))
	{
 		if(is_dir("$diretorio/$entrada") and ($entrada != "." and $entrada!=".."))
		{
			excluirDiretorio("${diretorio}/${entrada}");
		}
		else
			 if($entrada != "." and  $entrada!="..")
			 {
				 unlink("${diretorio}/${entrada}");
			 }
	}
	closedir($diretorio_corrente);
	rmdir(${diretorio});
}

function logSistema($cod_usuario, $cod_turma, $acao, $id_session, $data_log, $hora_log)
{	
	$log = new log_sistema();
	$log->setCodigoUsuario($cod_usuario);
	$log->setCodigoTurma($cod_turma);
	$log->setAcao($acao);
	$log->setSessionID($id_session);
	$log->setDataLog($data_log);
	$log->setHoraLog($hora_log);
	$log->inserir();
}

function forneceAcessoConteudo($cod_conteudo, $cod_usuario, $cod_turma, $diretorio_conteudo, $login_usuario, $senha_usuario, $acesso, $insere, $tipo)
{
	if ($insere)
	{
		$conteudo_usuario = new conteudo_usuario();
		$conteudo_usuario->setCodigoConteudo($cod_conteudo);
		$conteudo_usuario->setCodigoUsuario($cod_usuario);
		$conteudo_usuario->setCodigoTurma($cod_turma);
		$conteudo_usuario->setAcesso($acesso);
		$conteudo_usuario->inserir();
	}
	
	$total_caracteres = strlen($diretorio_conteudo);
	for($x = 0; $x < $total_caracteres; $x++)
    	$diretorio_conteudo_ .= substituiCaracter($diretorio_conteudo[$x], $tipo);
	
	$arquivo = $diretorio_conteudo_.".htpasswd";
	
	if (!file_exists($arquivo))
	{
		exec("/usr/sbin/htpasswd2 -bc ".$arquivo." ".$login_usuario." ".$senha_usuario."");
	}
	else
	{
		exec("/usr/sbin/htpasswd2 -D ".$arquivo." ".$login_usuario);
		exec("/usr/sbin/htpasswd2 -b ".$arquivo." ".$login_usuario." ".$senha_usuario."");
	}
}

function substituiSmilies($conteudo, $smilies, $diretorio)
{	
 	while(list($chave, $valor) = each($smilies))
 	{
  		$conteudo = str_replace($valor, "<img src=\"".$diretorio.$chave.".gif\" border=\"0\" alt=\"".$valor."\">", $conteudo );
 	}
	
 	return $conteudo;
}

function montaTabelaSmilies($smilies, $diretorio, $formulario, $modulo, $modo, $cor_tabela)
{	
	if ($modo == "horizontal")
	{
		$colspan = $divisor = 10;
		$porcentagem = "9%";
	}
	else
	{
		$divisor = 2;
		$colspan = 3;
		$porcentagem = "49%";
	}
	
	$conteudo = "<table width=\"90%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"".$cor_tabela."\">";
	$conteudo.= "  <tr>";
	$conteudo.= "    <td colspan=\"".$colspan."\" align=\"center\" class=\"preto\">Smilies</td>";
	$conteudo.= "  </tr>";
	$conteudo.= "  <tr>";
	$conteudo.= "    <td colspan=\"".$colspan."\" height=\"10\"></td>";
	$conteudo.= "  </tr>";
	$situacao = "fechado";

	while(list($chave, $valor) = each($smilies))
	{
		if ((($chave % $divisor) == 0) and ($situacao == "fechado"))
		{
			$situacao = "aberto";
			$conteudo.= "  <tr>";
		}
		else
			if ((($chave % $divisor) == 0) and ($situacao == "aberto"))
			{
				$conteudo.= "  </tr>";
				$situacao = "fechado";
			}
			
		if ($modulo == "forum")
			$conteudo.= "    <td width=\"".$porcentagem."\"><a onClick=\"JavaScript: adicionaSmilie('".$valor['codigo']."', '".$formulario."');\" onMouseOver=\"JavaScript: window.status = 'Adicionar Smilie ".$valor['codigo']."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"".$diretorio.$chave.".gif\" border=\"0\" valign=\"absmiddle\" alt=\"".$valor['codigo']."\"></a></td>";
		else
			if ($modulo == "chat")
				$conteudo.= "    <td width=\"".$porcentagem."\"><a onClick=\"JavaScript: adicionaSmilieBatePapo('".$valor['codigo']."', '".$formulario."')\" onMouseOver=\"JavaScript: window.status = 'Adicionar Smilie ".$valor['codigo']."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"".$diretorio.$chave.".gif\" border=\"0\" valign=\"absmiddle\" alt=\"".$valor['codigo']."\"></a></td>";
			else
				if ($modulo == "recados")
					$conteudo.= "    <td width=\"".$porcentagem."\"><a onClick=\"JavaScript: adicionaSmilieRecado('".$valor['codigo']."', '".$formulario."')\" onMouseOver=\"JavaScript: window.status = 'Adicionar Smilie ".$valor['codigo']."';\" onMouseOut=\"JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';\" style=\"cursor:pointer\"><img src=\"".$diretorio.$chave.".gif\" border=\"0\" valign=\"absmiddle\" alt=\"".$valor['codigo']."\"></a></td>";
						
			$conteudo.= "    <td width=\"2%\"></td>";
	}
	
	$conteudo.= "  <tr>";
	$conteudo.= "    <td colspan=\"".$colspan."\" height=\"10\"></td>";
	$conteudo.= "  </tr>";
	$conteudo.= "</table>";
	
 	return $conteudo;
}

function enviarEmail($de, $para, $assunto, $mensagem)
{
	$mail = new PHPMailer();

	$mail->IsSMTP(); // mandar via SMTP
	$mail->Host = "mail.fepe.org.br"; // Seu servidor smtp
	$mail->SMTPAuth = true; // smtp autenticado
	$mail->Username = "nead@fepe.org.br"; // usuário deste servidor smtp
	$mail->Password = "neadfp"; // senha
	
	$mail->From = "nead@fepe.org.br";
	$mail->FromName = "NEAD - FEPE";
	$mail->AddAddress($para, $nome_para);
	
	$mail->WordWrap = 100;// set word wrap
	//$mail->IsHTML(true);// send as HTML
	
	$mail->Subject = $assunto;
	$mail->Body = $mensagem;
	
	if(!$mail->Send())
		$retorno = true;
	else
		$retorno = false;
		
	return $retorno;
}

//Função para Criação de Input Select com Hierarquia
function inputSelectHierarquia($nome, $valores, $padrao = '', $parametros = '', $selecionado = '') 
{
	$campo = '<select name=' . $nome . '';
	
	if ($parametros) 
		$campo .= ' ' . $parametros;
		
	$campo .= '>';
	$campo .= '<option value=0 SELECTED>Conteúdo Principal</option>';
	
	for ($i = 0; $i < sizeof($valores); $i++) 
	{
		$campo .= '<option value=' . $valores[$i]['cod_conteudo'] . '';
		if (($selecionado == $valores[$i]['cod_conteudo']) || ($padrao == $valores[$i]['cod_conteudo']))
		{ 
			$campo.= ' SELECTED';
		}
		
		$campo .= '>' . $valores[$i]['descricao'] . '</option>';
	}
	
	$campo .= '</select>';

	return $campo;
}

function usuariosOnline($cod_turma_)
{
	$oUsers = new usuario_online;
	$oUsers->getUsuarioOnline();
	$onlineUsers = $oUsers->showNumberUsers();
	$total_usuarios = $oUsers->showNumberUsers();
	$dados_usuarios = $oUsers->showUsers();
	
	$usuarios_turma = array();
	
	for ($i = 0; $i < $total_usuarios; $i++)
	{
		($oUsers->searchIT("sessionID", $dados_usuarios[$i]["sessionID"])) ? $cod_turma = $dados_usuarios[$i]["cod_turma"] : $cod_turma = $dados_usuarios[$i]["cod_turma"];
		($oUsers->searchIT("sessionID", $dados_usuarios[$i]["sessionID"])) ? $nome = $dados_usuarios[$i]["nome_usuario"] : $nome = $dados_usuarios[$i]["nome_usuario"];
		($oUsers->searchIT("sessionID", $dados_usuarios[$i]["sessionID"])) ? $cod_usuario = $dados_usuarios[$i]["cod_usuario"] : $cod_usuario = $dados_usuarios[$i]["cod_usuario"];
		($oUsers->searchIT("sessionID", $dados_usuarios[$i]["sessionID"])) ? $acesso = $dados_usuarios[$i]["acesso"] : $acesso = $dados_usuarios[$i]["acesso"];			
		
		if ($cod_turma == $cod_turma_)
			$usuarios_turma[] = array("cod_usuario" => $cod_usuario, "nome" => $nome, "acesso" => $acesso);
	}
	
	$total_alunos = count($usuarios_turma);
	$usuarios_online = array();
	
	if ($total_alunos > 0)
	{
		for ($j = 0; $j < $total_alunos; $j++)
		{
			$achou = "nao";
			$codigo = $usuarios_turma[$j]["cod_usuario"];
			$total_vetor_online = count($usuarios_online);
			$acesso = $usuarios_turma[$j]["acesso"];
			
			if ($total_vetor_online > 0)
			{
				for ($i = 0; $i < $total_vetor_online; $i++)
				{
					$cod_usuario = $usuarios_online[$i]["cod_usuario"];
					
					if (($codigo == $cod_usuario) and ($achou == "nao"))
						$achou = "sim";
				}
				
				if ($achou == "nao")
				{
					if ($acesso != "P")
					{
						$cod_usuario = $usuarios_turma[$j]["cod_usuario"];
						$nome = $usuarios_turma[$j]["nome"];
						$acesso = $usuarios_turma[$j]["acesso"];
						$usuarios_online[] = array("cod_usuario" => $cod_usuario, "nome" => $nome, "acesso" => $acesso);
					}
				}
			}
			else
			{
				if ($acesso != "P")
				{
					$cod_usuario = $usuarios_turma[$j]["cod_usuario"];
					$nome = $usuarios_turma[$j]["nome"];
					$acesso = $usuarios_turma[$j]["acesso"];
					$usuarios_online[] = array("cod_usuario" => $cod_usuario, "nome" => $nome, "acesso" => $acesso);
				}
			}
		}
	}
	
	$total_usuarios_online = count($usuarios_online);
	
	return $usuarios_online;
}

?>