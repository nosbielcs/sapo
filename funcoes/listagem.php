<?php

if ($_GET["cod"])
{
	$_SESSION["cod_cur"] = $_GET["cod"];
	//Inicio Listagem
	$pg = $_GET["pag"];
	$qtd = 15;
	
	if (!isset($qtd))
	$qtd = $num_pg;
	
	if (!isset($pg)) 
	$inicial = $pg = 1;
	
	$inicial = $pg - 1;
	$inicial = $inicial * $qtd; 
	
	$pesquisa = new mysql();
	$_SESSION["sql_inscr"] = "select 
								inscr_cur.cod_cur, 
								inscr_cur.cod_inscr, 
								inscr_cur.data, 
								inscr_cur.hora,
								inscritos.cod_inscr,
								inscritos.nome,
								inscritos.endereco,
								inscritos.cep,
								inscritos.cidade,
								inscritos.bairro,
								inscritos.uf,
								inscritos.telefone,
								inscritos.email,
								inscritos.documentos,
								inscritos.pagamento,
								inscritos.data_doc,
								inscritos.data_pagou,
								inscritos.material,
								inscritos.data_mater,
								inscritos.hora_mater
							from 
								inscr_cur, inscritos
							where 
								inscr_cur.cod_cur = ".$_GET["cod"]." 
							and 
								inscritos.cod_inscr = inscr_cur.cod_inscr ";
			
	if ($_GET["opcao"])
	{
		switch($_GET["opcao"])
		{
			//Inscritos
			case 1:
				$_SESSION["sql_inscr"].= "";
			break;
			//Verifica Situação de Envio de documentação e de Pagamentos dos Inscritos
			case 2:
				$_SESSION["sql_inscr"].= "";
			break;
			//Enviou Documentação e Efetuou o Pagamento
			case 3:
				$_SESSION["sql_inscr"].= "and 
											 documentos = 'S'
										  and
											 pagamento = 'S' ";		
			break;
			//Não Enviou Documentação e não Efetuou o Pagamento
			case 4:
				$_SESSION["sql_inscr"].= "and 
											 documentos = 'N'
										  and
											 pagamento = 'N' ";
			break;
			//Foi Enviado o Material
			case 5:	
				$_SESSION["sql_inscr"].= "and 
											 documentos = 'S'
										  and
											 pagamento = 'S'
										  and
										     material = 'S' ";
			break;
			//Não Foi Enviado o Material	
			case 6:
				$_SESSION["sql_inscr"].= "and 
											 documentos = 'S'
										  and
											 pagamento = 'S'
										  and 
											 material = 'N' ";
			break;
			//Verifica Situação de Envio do material para os Inscritos
			case 7:
				$_SESSION["sql_inscr"].= "";
			break;
			//Seleciona as pessoas com Situação = Inscrito
			case 8:
				$_SESSION["sql_inscr"].= "and
											 situacao = 'I' ";
			break;
			//Seleciona as pessoas com Situação = Cursando 
			case 9:
				$_SESSION["sql_inscr"].= "and
											 situacao = 'C' ";
			break;
			//Seleciona as pessoas com Situação = Desistente
			case 10:
				$_SESSION["sql_inscr"].= "and
											 situacao = 'D' ";
			break;
			//Pagamento Integral
			case 11:
				$_SESSION["sql_inscr"].= "and 
				  							 tipo_pagamento = 'I' ";
			break;
			//Insento do Pagamento
			case 12:
				$_SESSION["sql_inscr"].= "and 
				  							 tipo_pagamento = 'S' ";
			break;
			//20% de desconto
			case 13:
				$_SESSION["sql_inscr"].= "and 
				  							 tipo_pagamento = '2' ";
			break;
			//Parcelado
			case 14:
				$_SESSION["sql_inscr"].= "and 
				  							 tipo_pagamento = 'P' ";
			break;
			//Desconto e Parcelado
			case 15:
				$_SESSION["sql_inscr"].= "and 
				  							 tipo_pagamento = 'E' ";
			break;
			//Cidades
			case 16:
				$_SESSION["sql_inscr"].= "";
			break;
			//Cidade
			case 17:
				$_SESSION["sql_inscr"].= "and 
				  							 cidade like '".$_GET["cidade"]."'
										  and 
											 documentos = 'S'
										  and
											 pagamento = 'S' ";
			break;
		}
	}
	
	if ($_GET["ordem"])
	{
		switch($_GET["ordem"])
		{
			case 1:
				$_SESSION["sql_inscr"].= "order by 
				                     		nome ASC";
				$ordem_nome = "seta_ordenar_1.gif";
				$ordem_data = "seta_ordenar.gif"; 
			break;
			case 2:
				$_SESSION["sql_inscr"].= "order by 
				                     		nome DESC";
				$ordem_nome = "seta_ordenar.gif";
				$ordem_data = "seta_ordenar.gif"; 
			break;
			case 3:
				$_SESSION["sql_inscr"].= "order by 
				                     		data ASC";
				$ordem_nome = "seta_ordenar.gif";
				$ordem_data = "seta_ordenar_1.gif"; 
			break;
			case 4:
				$_SESSION["sql_inscr"].= "order by 
				                     		data DESC";
				$ordem_nome = "seta_ordenar.gif";
				$ordem_data = "seta_ordenar.gif"; 
			break;
		}
	}
	else
	{
		$_SESSION["sql_inscr"].= "order by 
				                     nome";
		$ordem_nome = "seta_ordenar_1.gif";
		$ordem_data = "seta_ordenar.gif"; 
	}

	$inscritos = new mysql();
	$inscritos->query($_SESSION["sql_inscr"]);
	$total_inscritos = $inscritos->count;
	
	$limite = " limit ".$qtd." offset ".$inicial;
	$sql = $_SESSION["sql_inscr"];
	$sql.= $limite;
			  
	$pesquisa->query($sql);
	$qtde_inscritos = $pesquisa->count;
	
	if ($qtd != 0) 
	$pages = ceil($total_inscritos / $qtd);
	
	$paginas = "<b>Página</b> ";
	if ($pg <> 1)
	{
		$url = $pg - 1;
		$paginas.= "<a id=mulink href='index.php?cod=".$_GET["cod"]."&pag=".$url."'></a> ";
	}
	else
	{
		$paginas.=  " ";
	}
	
	for ($i = 1; $i<($pages + 1); $i++)
	{
		if ($i == $pg)
		{
			$paginas.=  "<font face=Arial size=2 color=ff0000><b>&nbsp;&nbsp;".$i."&nbsp;&nbsp;</b></font>";
		}
		else
		{
			$paginas.=  "<a href='index.php?cod=".$_GET["cod"]."&pag=".$i."&ordem=".$_GET["ordem"]."&opcao=".$_GET["opcao"]."'>&nbsp;&nbsp;".$i."&nbsp;&nbsp;</a>";
		}
	}
	
	if ($pg < $pages)
	{
		$url = $pg + 1;
		$paginas.=  "<a href='index.php?cod=".$_GET["cod"]."&pag=".$url."&ordem=".$_GET["ordem"]."&opcao=".$_GET["opcao"]."'></a> ";
	}
	else
	{
		$paginas.=  " ";
	}
	//Fim Listagem
}

?>