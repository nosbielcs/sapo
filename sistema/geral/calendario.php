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

include("../../config/session.lib.php");
include("../../config/config.bd.php");
include("../../classes/classe_bd.php");
include("../../classes/usuario.php");
include("../../classes/curso.php");
include("../../classes/turma.php");
include("../../funcoes/funcoes.php");
include("../../classes/evento.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agenda de Eventos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../config/estilo.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript" src="../../funcoes/funcoes.js"></script>

<script type="text/javascript">
	
	function visualizaEventos(dataEvento, possuiEventos)
	{
		document.calendario.data_evento.value = dataEvento;
		document.calendario.possui_evento.value = possuiEventos;
		document.calendario.submit();
	}
</script>
<body topmargin="0" leftmargin="0">
<table width="100%" height="90" cellpadding="0" cellspacing="0" border="0" bgcolor="#FCFFEE">
  <tr> 
    <td align="left">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
		  <td width="5">&nbsp;</td>
          <td width="180" valign="top" align="left"> 
     		<?php
				$eventos = new evento();
				$eventos->colecao($_SESSION["cod_turma"]);
				$total_eventos = $eventos->linhas;
				if ((!is_array($vet_eventos)) and (total_eventos > 0))
					$vet_eventos = array();
						
				for ($i = 0; $i < $total_eventos; $i++)
				{
					$cod_evento = $eventos->data["cod_evento"];
					$evento = new evento();
					$evento->carregar($cod_evento);
					//Dados do Evento
					$cod_evento = $evento->getCodigo();
					$cod_usuario = $evento->getCodigoUsuario();
					$assunto = $evento->getAssunto();
					$descricao = $evento->getDescricao();
					$hora = $evento->getHora();
					$data_evento = $evento->getDataEvento();
					$tipo = $evento->getTipo();
					$situacao = $evento->getSituacao();
					//
					//if ($situacao == "A")
					$vet_eventos[$i] = array('cod_evento' => $cod_evento, 'cod_usuario' => $cod_usuario, 'nome_usuario' => $nome_usuario, 'assunto' => $assunto, 'descricao' => $descricao, 'hora' => $hora, 'data_evento' => $data_evento, 'tipo' => $tipo, 'situacao' => $situacao);
					$eventos->proximo();
				}
						
				if ($_GET["month"])
					$month = $_GET["month"];
				else
					$month = date("m");
					
				if ($_GET["year"])
					$year = $_GET["year"];
				else
					$year = date("Y");
					
				if ($_GET["show_month"])
					$show_month = $_GET["show_month"];
					
				if (isset($show_month)) 
				{
					if ($show_month == ">") 
					{
						if($month == 12) 
						{
							$month = 1;
							$year++;
						} 
						else 
						{
							$month++;
						}
					}
					 
					if ($show_month == "<") 
					{
						if($month == 1) 
						{
							$month = 12;
							$year--;
						} 
						else 
						{
							$month--;
						}
					}
				}
				
				if (isset($day)) 
				{
					if ($day <= "9" & ereg("(^[1-9]{1})", $day)) 
					{
						$day = "0".$day;
					}
				}
				if (isset($month)) 
				{
					if ($month <= "9" & ereg("(^[1-9]{1})",$month)) 
					{
						$month = "0".$month;
					}
				}
				
				if (!isset($year)) 
				{
					$year = date("Y", mktime());
				}
				
				if (!isset($month)) 
				{
					$month = date("m", mktime());
				}
				
				if (!isset($day)) 
				{
					$day = date("d", mktime());
				}
			 
				$thisday = "$year-$month-$day";
				$day_name = array(Dom, Seg, Ter, Qua, Qui, Sex, Sáb );
				$month_abbr = array("", Janeiro, Fevereiro, Março, Abril, Maio, Junho, Julho, Agosto, Setembro, Outubro, Novembro, Dezembro);
		
				$y = date("Y");
				switch ($month) 
				{
					case 1:  $month_name = Janeiro;	  break;
					case 2:  $month_name = Fevereiro; break;
					case 3:  $month_name = Março;	  break;
					case 4:  $month_name = Abril;	  break;
					case 5:  $month_name = Maio;	  break;
					case 6:  $month_name = Junho;	  break;
					case 7:  $month_name = Julho;	  break;
					case 8:  $month_name = Agosto;	  break;
					case 9:  $month_name = Setembro;  break;
					case 10: $month_name = Outubro;	  break;
					case 11: $month_name = Novembro;  break;
					case 12: $month_name = Dezembro;  break;
				}
      		?>
            <table border="0" width="176">
              <tr> 
                <td style="border-width:1px">
				  <table width="175" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="silver">
                    <tr bgcolor="#f5f5f5"> 
                      <td align="center"><a title="Retornar para o Mês Anterior" onClick="JavaScript: window.location.href = 'calendario.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>&show_month=<?php echo "<"; ?>';" class="link_calendar" onMouseOver="JavaScript: window.status = 'Retornar para o Mês Anterior';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer"><<</a></td>
                      <td colspan="5" align="center" class="calendar_bold"><? echo "$month_name $year"; ?></td>
                      <td align="center"><a title="Avançar para o Próximo Mês" onClick="JavaScript: window.location.href = 'calendario.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>&show_month=<?php echo ">"; ?>'" class="link_calendar" onMouseOver="JavaScript: window.status = 'Avançar para o Próximo Mês';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" style="cursor:pointer">>></a></td>
                    </tr>
                    <tr align="center"> 
                      <?php
						for ($i = 0; $i < 7; $i++) 
						{ 
					  ?>
                      <td width="25" align="center" bgColor="ffffff" class="calendar_bold"><?php echo "$day_name[$i]"; ?></td>
                      <?php 
						} 
					  ?>
                    </tr>
                    <tr align="center"> 
                      <?php
						  if (date("w", mktime(0, 0, 0, $month, 2, $year)) == 0) 
						  {
							 $start = 7;
						  } 
						  else 
						  {
							 $start = date("w", mktime(0, 0, 0, $month, 2, $year));
						  }
					  
						  for ($a = ($start - 2); $a >= 0; $a--)
						  {
							 $d = date("t", mktime(0, 0, 0, $month, 0, $year)) - $a;
               		  ?>
                      <td bgcolor="#ffffff" align="center" class="calendar_bold"><font color="#ffffff"><?=$d?></font></td>
                      <?php 
		  	   			  }
						  
						  for ($d = 1; $d <= date("t", mktime(0, 0, 0,($month + 1), 0, $year)); $d++)
						  {
							if ($month == date("m") & $year == date("Y") & $d == date("d")) 
							{
								$bg = "bgcolor=\"#B0E2FF\"";
							} 
							else 
							{
								$bg = "bgcolor=\"#F5DEB3\"";
							}
							
						if (($d >= 1) and ($d < 10))
						{
							$dia = "0".$d;
						}
						else
							$dia = $d;
							
						$evento = "$year-$month-$dia";
						if ($total_eventos == 0)
						{
					?>
                      <td <?=$bg ?> align="center"><a onClick="JavaScript: visualizaEventos('<?php echo $evento; ?>', false);" onMouseOver="JavaScript: window.status = '<?php echo $d." de ".$month_name." de ".$year; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $d." de ".$month_name." de ".$year; ?>" style="cursor:pointer" class="calendar_bold"><?=$d?></a></td>
                      <?php
				}
				else
				{
					$encontrou_eventos = false;
					for($i = 0; $i < $total_eventos; $i++)
					{
						if ($evento == $vet_eventos[$i]["data_evento"])
						{
							$encontrou_eventos = true;
						}
					}
					
					if ($encontrou_eventos == true)
					{
						if ($evento >= date("Y-m-d"))
						{
					?>
                      <td bgcolor="#00FF7F" align="center"><a onClick="JavaScript: visualizaEventos('<?php echo $evento; ?>', true);" onMouseOver="JavaScript: window.status = '<?php echo $d." de ".$month_name." de ".$year; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $d." de ".$month_name." de ".$year; ?>" style="cursor:pointer" class="calendar_bold"><?=$d?></a></td>
                      <?php
						}
						else
						{
					  ?>
                      <td bgcolor="#FFFF99" align="center"><a onClick="javascript: visualizaEventos('<?php echo $evento; ?>', true);" onMouseOver="JavaScript: window.status = '<?php echo $d." de ".$month_name." de ".$year; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $d." de ".$month_name." de ".$year; ?>" style="cursor:pointer" class="calendar_bold"><?=$d?></a></td>
                      <?php
						}
					}
					else
					{
						?>
                      <td <?=$bg ?> align="center"><a onClick="javascript: visualizaEventos('<?php echo $evento; ?>', false);" onMouseOver="JavaScript: window.status = '<?php echo $d." de ".$month_name." de ".$year; ?>';" onMouseOut="JavaScript: window.status = 'SA²pO - Sistema de Apoio à Aprendizagem Online';" title="<?php echo $d." de ".$month_name." de ".$year; ?>" style="cursor:pointer" class="calendar_bold"><?=$d?></a></td>
                      <?php
					}
					
				}
				if (date("w", mktime(0, 0, 0, $month, $d, $year)) == 6 & date("t", mktime(0, 0, 0,($month + 1), 0, $year)) > $d)
				{
				?>
                    </tr>
                    <tr align="center"> 
                      <?php
				 }
			}
			  $d = $d + 1;
			  if (date("w", mktime(0, 0, 0, ($month + 1), 1, $year)) <> 0)
			  {
				$d = 1;
				while(date("w", mktime(0, 0, 0,($month + 1), $d, $year)) <> 0)
				{
		   ?>
                      <td bgcolor="#ffffff" align="center" title="<? echo $cp; ?>" class="calendar_bold"><font color="#ffffff"> 
                        <?=$d?>
                        </font></td>
                      <?php
					$d++;
				}
			  }
			?>
                    </tr>
                  </table>
				</td>
              </tr>
              <tr> 
                <td> 
				  <table width="175" border="0" cellspacing="2" cellpadding="1" align="center">
                    <form name="calendario" action="calendario.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>" method="post">
                      <tr> 
                        <td><input type="hidden" name="data_evento" value=""><input type="hidden" name="possui_evento" value=""></td>
                      </tr>
                    </form>
                  </table>
				</td>
              </tr>
            </table>
		  </td>
		  <td width="5">&nbsp;</td>
          <td width="180" valign="top" align="left">
		    <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr> 
                <td colspan="3" class="calendar_bold">Legenda</td>
              </tr>
              <tr> 
                <td colspan="3" height="10"></td>
              </tr>
              <tr>
                <td width="10" height="15" bgcolor="#F5DEB3"></td>
                <td width="10"></td>
                <td class="calendar_bold">Dia sem Eventos</td>
              </tr>
              <tr> 
                <td width="10" height="15"  bgcolor="#B0E2FF"></td>
                <td width="10"></td>
                <td class="calendar_bold">Hoje sem Eventos</td>
              </tr>
              <tr> 
                <td width="10" height="15"  bgcolor="#00FF7F"></td>
                <td width="10"></td>
                <td class="calendar_bold">Eventos Futuros</td>
              </tr>
              <tr> 
                <td width="10" height="15" bgcolor="#FFFF99"></td>
                <td width="10"></td>
                <td class="calendar_bold">Eventos Passados</td>
              </tr>
            </table>
		  </td>
		  <td width="5">&nbsp;</td>
		  <?php
		  	if ($_POST["data_evento"])
			{
				$day = substr($_POST["data_evento"], 8, 2);
				$month = substr($_POST["data_evento"], 5 ,2);
				$year = substr($_POST["data_evento"], 0, 4);
			}
		  ?>
		  <td valign="top">
		     <table width="100%" cellpadding="0" cellspacing="0" border="0">
			  <tr>
			    <td>
				  <table cellpadding="0" cellspacing="0" border="1" bordercolor="#FFFF99">
				    <tr>
					  <td><iframe frameborder="0" height="90" src="listagem_eventos.php?dia=<?php echo $day; ?>&mes=<?php echo $month; ?>&ano=<?php echo $year; ?>&nome_mes=<?php echo $month_name; ?>"></iframe></td>
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
</body>
</html>
