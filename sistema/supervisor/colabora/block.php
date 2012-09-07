<html>
<head>
<link href="../../../config/estilo.css" rel="stylesheet" type="text/css">
<title>Online HTML editor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--
function bold() {
	document.execCommand("Bold"); oDiv.focus();
	return;
}
function makeUnorderedList() {
	document.execCommand("InsertUnorderedList"); oDiv.focus();
	return;
}
function itallic() {
	document.execCommand("Italic"); oDiv.focus();
	return;
}
function left_justify() {
	document.execCommand("JustifyLeft"); oDiv.focus();
	return;
}
function center() {
	document.execCommand("JustifyCenter"); oDiv.focus();
	return;
}
function right_justify() {
	document.execCommand("JustifyRight"); oDiv.focus();
	return;
}
function font_up() {
	size = document.queryCommandValue("FontSize") +1;
	document.execCommand("FontSize", "false", size); oDiv.focus();
	return;
}
function font_down() {
	size = document.queryCommandValue("FontSize") -1;
	document.execCommand("FontSize", "false", size); oDiv.focus();
	return;
}
function setcolor(var1) {
	document.execCommand("ForeColor", "false", var1); oDiv.focus();
	return;
}
function setfont(var1) {
	document.execCommand("FontName", "false", var1); oDiv.focus();
	return;
}
function display() {
	alert(oDiv.innerHTML);	
	return;
}

function makeLink() {
	document.execCommand("CreateLink", "true"); oDiv.focus();
	return;
}

function insertImage() {
	document.execCommand("InsertImage", "true"); oDiv.focus();
	return;
}

function MM_findObj(n, d) { //v3.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); return x;
}

function MM_showHideLayers() { //v3.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}

function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}

function MM_displayStatusMsg(msgStr) { //v1.0
  status=msgStr;
  document.MM_returnValue = true;
}
//-->
</script>

</head>

<body bgcolor="#FFFFFF">
<div id="Layer1" style="position:absolute; left:231px; top:34px; width:111px; height:133px; z-index:1; visibility: hidden"><a href="#" onClick="MM_showHideLayers('Layer1','','hide')"><img src="../../imagens/colabora/pallete.gif" width="151" height="133" usemap="#pallete" border="0"></a></div>
  
<div id="Layer2" style="position:absolute; left:261px; top:34px; width:100px; height:149px; z-index:2; visibility: hidden"><img src="../../imagens/colabora/fontlist.gif" width="100" height="150" usemap="#fontlist" border="0" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','hide')"></div>
<p> &nbsp;<img src="../../imagens/colabora/bold_tool.gif" width="25" height="25" hspace="2" onClick="javascript:bold()" onMouseOver="MM_displayStatusMsg('Makes selected text bold');return document.MM_returnValue"><img src="../../imagens/colabora/itallic_tool.gif" width="25" height="25" vspace="0" hspace="2" onClick="javascript:itallic()" onMouseOver="MM_displayStatusMsg('Makes selected text itallic');return document.MM_returnValue"><img src="../../imagens/colabora/leftjust_tool.gif" width="25" height="25" hspace="2" onClick="javascript:left_justify()" onMouseOver="MM_displayStatusMsg('Left justifies selected text');return document.MM_returnValue"><img src="../../imagens/colabora/centerjust_tool.gif" width="25" height="25" hspace="2" onClick="javascript:center()" onMouseOver="MM_displayStatusMsg('Centers selected text');return document.MM_returnValue"><img src="../../imagens/colabora/rightjust_tool.gif" width="25" height="25" hspace="2" onClick="javascript:right_justify()" onMouseOver="MM_displayStatusMsg('Left justifies selected text');return document.MM_returnValue"><img src="../../imagens/colabora/fontup_tool.gif" width="25" height="25" hspace="2" onClick="javascript:font_up()" onMouseOver="MM_displayStatusMsg('Increases size of selected text');return document.MM_returnValue"><img src="../../imagens/colabora/fontdown_tool.gif" width="25" height="25" hspace="2" onClick="javascript:font_down()" onMouseOver="MM_displayStatusMsg('Decreases size of selected text');return document.MM_returnValue"><img src="../../imagens/colabora/pallete_tool.gif" width="25" height="25" onClick="MM_showHideLayers('Layer1','','show','Layer2','','hide')" hspace="2" onMouseOver="MM_displayStatusMsg('Changes color of selected text');return document.MM_returnValue"><img src="../../imagens/colabora/font_tool.gif" width="25" height="25" hspace="2" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','show')" onMouseOver="MM_displayStatusMsg('Changes face of selected text');return document.MM_returnValue">&nbsp; 
  <button class="botao" onclick="makeLink();">link</button>&nbsp;
  <button class="botao" onclick="insertImage();">image</button>&nbsp;
  <button class="botao" onclick="makeUnorderedList();">UL</button>&nbsp;
  <table width="99%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      
    <td><strong>Titulo:</strong></td>
    </tr>
  </table>
  </button>
</p>
  
<map name="pallete"> <area shape="rect" coords="139,13,147,21" href="javascript:setcolor('00FF33')" > 
  <area shape="rect" coords="76,4,84,12" href="javascript:setcolor('003366')" > 
  <area shape="rect" coords="85,4,93,12" href="javascript:setcolor('003399')" > 
  <area shape="rect" coords="94,4,102,12" href="javascript:setcolor('0033CC')" > 
  <area shape="rect" coords="103,4,111,12" href="javascript:setcolor('0033FF')" > 
  <area shape="rect" coords="112,4,120,12" href="javascript:setcolor('006600')" > 
  <area shape="rect" coords="121,4,129,12" href="javascript:setcolor('006633')" > 
  <area shape="rect" coords="130,4,138,12" href="javascript:setcolor('006666')" > 
  <area shape="rect" coords="139,4,147,12" href="javascript:setcolor('006699')" > 
  <area shape="rect" coords="4,4,12,12" href="javascript:setcolor('000000')" > 
  <area shape="rect" coords="13,4,21,12" href="javascript:setcolor('000033')" > 
  <area shape="rect" coords="22,4,30,12" href="javascript:setcolor('000066')" > 
  <area shape="rect" coords="31,4,39,12" href="javascript:setcolor('000099')" > 
  <area shape="rect" coords="40,4,48,12" href="javascript:setcolor('0000CC')" > 
  <area shape="rect" coords="49,4,57,12" href="javascript:setcolor('0000FF')" > 
  <area shape="rect" coords="58,4,66,12" href="javascript:setcolor('003300')" > 
  <area shape="rect" coords="67,4,75,12" href="javascript:setcolor('003333')" > 
  <area shape="rect" coords="76,13,84,21" href="javascript:setcolor('00CC00')" > 
  <area shape="rect" coords="85,13,93,21" href="javascript:setcolor('00CC33')" > 
  <area shape="rect" coords="94,13,102,21" href="javascript:setcolor('00CC66')" > 
  <area shape="rect" coords="103,13,111,21" href="javascript:setcolor('00CC99')" > 
  <area shape="rect" coords="112,13,120,21" href="javascript:setcolor('00CCCC')" > 
  <area shape="rect" coords="121,13,129,21" href="javascript:setcolor('00CCFF')" > 
  <area shape="rect" coords="130,13,138,21" href="javascript:setcolor('00FF00')" > 
  <area shape="rect" coords="139,4,147,12" href="javascript:#" > <area shape="rect" coords="4,13,12,21" href="javascript:setcolor('0066CC')" > 
  <area shape="rect" coords="13,13,21,21" href="javascript:setcolor('0066FF')" > 
  <area shape="rect" coords="22,13,30,21" href="javascript:setcolor('009900')" > 
  <area shape="rect" coords="31,13,39,21" href="javascript:setcolor('009933')" > 
  <area shape="rect" coords="40,13,48,21" href="javascript:setcolor('009966')" > 
  <area shape="rect" coords="49,13,57,21" href="javascript:setcolor('009999')" > 
  <area shape="rect" coords="58,13,66,21" href="javascript:setcolor('0099CC')" > 
  <area shape="rect" coords="67,13,75,21" href="javascript:setcolor('0099FF')" > 
  <area shape="rect" coords="76,22,84,30" href="javascript:setcolor('3300CC')" > 
  <area shape="rect" coords="85,22,93,30" href="javascript:setcolor('3300FF')" > 
  <area shape="rect" coords="94,22,102,30" href="javascript:setcolor('333300')" > 
  <area shape="rect" coords="103,22,111,30" href="javascript:setcolor('333333')" > 
  <area shape="rect" coords="112,22,120,30" href="javascript:setcolor('333366')" > 
  <area shape="rect" coords="121,22,129,30" href="javascript:setcolor('336699')" > 
  <area shape="rect" coords="130,22,138,30" href="javascript:setcolor('3333CC')" > 
  <area shape="rect" coords="139,22,147,30" href="javascript:setcolor('3333FF')" > 
  <area shape="rect" coords="4,22,12,30" href="javascript:setcolor('00FF66')" > 
  <area shape="rect" coords="13,22,21,30" href="javascript:setcolor('00FF99')" > 
  <area shape="rect" coords="22,22,30,30" href="javascript:setcolor('00FFCC')" > 
  <area shape="rect" coords="31,22,39,30" href="javascript:setcolor('00FFFF')" > 
  <area shape="rect" coords="40,22,48,30" href="javascript:setcolor('330000')" > 
  <area shape="rect" coords="49,22,57,30" href="javascript:setcolor('330033')" > 
  <area shape="rect" coords="58,22,66,30" href="javascript:setcolor('330066')" > 
  <area shape="rect" coords="67,22,75,30" href="javascript:setcolor('330099')" > 
  <area shape="rect" coords="76,31,84,39" href="javascript:setcolor('339966')" > 
  <area shape="rect" coords="85,31,93,39" href="javascript:setcolor('339999')" > 
  <area shape="rect" coords="94,31,102,39" href="javascript:setcolor('3399CC')" > 
  <area shape="rect" coords="103,31,111,39" href="javascript:setcolor('3399FF')" > 
  <area shape="rect" coords="112,30,120,38" href="javascript:setcolor('33CC00')" > 
  <area shape="rect" coords="121,31,129,39" href="javascript:setcolor('33CC33')" > 
  <area shape="rect" coords="130,31,138,39" href="javascript:setcolor('33CC66')" > 
  <area shape="rect" coords="139,31,147,39" href="javascript:setcolor('33CC99')" > 
  <area shape="rect" coords="4,31,12,39" href="javascript:setcolor('336600')" > 
  <area shape="rect" coords="13,31,21,39" href="javascript:setcolor('336633')" > 
  <area shape="rect" coords="22,31,30,39" href="javascript:setcolor('336666')" > 
  <area shape="rect" coords="31,31,39,39" href="javascript:setcolor('336699')" > 
  <area shape="rect" coords="40,31,48,39" href="javascript:setcolor('3366CC')" > 
  <area shape="rect" coords="49,31,57,39" href="javascript:setcolor('3366FF')" > 
  <area shape="rect" coords="58,31,66,39" href="javascript:setcolor('339900')" > 
  <area shape="rect" coords="67,31,75,39" href="javascript:setcolor('339933')" > 
  <area shape="rect" coords="76,40,84,48" href="javascript:setcolor('660000')" > 
  <area shape="rect" coords="85,40,93,48" href="javascript:setcolor('660033')" > 
  <area shape="rect" coords="94,40,102,48" href="javascript:setcolor('660066')" > 
  <area shape="rect" coords="103,40,111,48" href="javascript:setcolor('660099')" > 
  <area shape="rect" coords="112,40,120,48" href="javascript:setcolor('6600CC')" > 
  <area shape="rect" coords="121,40,129,48" href="javascript:setcolor('6600FF')" > 
  <area shape="rect" coords="130,40,138,48" href="javascript:setcolor('663300')" > 
  <area shape="rect" coords="139,40,147,48" href="javascript:setcolor('663333')" > 
  <area shape="rect" coords="4,40,12,48" href="javascript:setcolor('33CCCC')" > 
  <area shape="rect" coords="13,40,21,48" href="javascript:setcolor('33CCFF')" > 
  <area shape="rect" coords="22,40,30,48" href="javascript:setcolor('33FF00')" > 
  <area shape="rect" coords="31,40,39,48" href="javascript:setcolor('33FF33')" > 
  <area shape="rect" coords="40,40,48,48" href="javascript:setcolor('33FF66')" > 
  <area shape="rect" coords="49,40,57,48" href="javascript:setcolor('33FF99')" > 
  <area shape="rect" coords="58,40,66,48" href="javascript:setcolor('33FFCC')" > 
  <area shape="rect" coords="67,40,75,48" href="javascript:setcolor('33FFFF')" > 
  <area shape="rect" coords="76,49,84,57" href="javascript:setcolor('6666CC')" > 
  <area shape="rect" coords="85,49,93,57" href="javascript:setcolor('6666FF')" > 
  <area shape="rect" coords="94,49,102,57" href="javascript:setcolor('669900')" > 
  <area shape="rect" coords="103,49,111,57" href="javascript:setcolor('669933')" > 
  <area shape="rect" coords="112,49,120,57" href="javascript:setcolor('669966')" > 
  <area shape="rect" coords="121,49,129,57" href="javascript:setcolor('669999')" > 
  <area shape="rect" coords="130,49,138,57" href="javascript:setcolor('6699CC')" > 
  <area shape="rect" coords="139,49,147,57" href="javascript:setcolor('6699FF')" > 
  <area shape="rect" coords="4,49,12,57" href="javascript:setcolor('663366')" > 
  <area shape="rect" coords="13,49,21,57" href="javascript:setcolor('663399')" > 
  <area shape="rect" coords="22,49,30,57" href="javascript:setcolor('6633CC')" > 
  <area shape="rect" coords="31,49,39,57" href="javascript:setcolor('6633FF')" > 
  <area shape="rect" coords="40,49,48,57" href="javascript:setcolor('666600')" > 
  <area shape="rect" coords="49,49,57,57" href="javascript:setcolor('666633')" > 
  <area shape="rect" coords="58,49,66,57" href="javascript:setcolor('666666')" > 
  <area shape="rect" coords="67,49,75,57" href="javascript:setcolor('666699')" > 
  <area shape="rect" coords="76,58,84,66" href="javascript:setcolor('66FF66')" > 
  <area shape="rect" coords="85,58,93,66" href="javascript:setcolor('66FF99')" > 
  <area shape="rect" coords="94,58,102,66" href="javascript:setcolor('66FFCC')" > 
  <area shape="rect" coords="103,58,111,66" href="javascript:setcolor('66FFFF')" > 
  <area shape="rect" coords="112,58,120,66" href="javascript:setcolor('990000')" > 
  <area shape="rect" coords="121,58,129,66" href="javascript:setcolor('990033')" > 
  <area shape="rect" coords="130,58,138,66" href="javascript:setcolor('990066')" > 
  <area shape="rect" coords="139,58,147,66" href="javascript:setcolor('990099')" > 
  <area shape="rect" coords="4,58,12,66" href="javascript:setcolor('66CC00')" > 
  <area shape="rect" coords="13,58,21,66" href="javascript:setcolor('66CC33')" > 
  <area shape="rect" coords="22,58,30,66" href="javascript:setcolor('66CC66')" > 
  <area shape="rect" coords="31,58,39,66" href="javascript:setcolor('66CC99')" > 
  <area shape="rect" coords="40,58,48,66" href="javascript:setcolor('66CCCC')" > 
  <area shape="rect" coords="49,58,57,66" href="javascript:setcolor('66CCFF')" > 
  <area shape="rect" coords="58,58,66,66" href="javascript:setcolor('66FF00')" > 
  <area shape="rect" coords="67,58,75,66" href="javascript:setcolor('66FF33')" > 
  <area shape="rect" coords="76,67,84,75" href="javascript:setcolor('996600')" > 
  <area shape="rect" coords="85,67,93,75" href="javascript:setcolor('996633')" > 
  <area shape="rect" coords="94,67,102,75" href="javascript:setcolor('996666')" > 
  <area shape="rect" coords="103,67,111,75" href="javascript:setcolor('996699')" > 
  <area shape="rect" coords="112,67,120,75" href="javascript:setcolor('9966CC')" > 
  <area shape="rect" coords="121,67,129,75" href="javascript:setcolor('9966FF')" > 
  <area shape="rect" coords="130,67,138,75" href="javascript:setcolor('999900')" > 
  <area shape="rect" coords="139,67,147,75" href="javascript:setcolor('999933')" > 
  <area shape="rect" coords="4,67,12,75" href="javascript:setcolor('9900CC')" > 
  <area shape="rect" coords="13,67,21,75" href="javascript:setcolor('9900FF')" > 
  <area shape="rect" coords="22,67,30,75" href="javascript:setcolor('993300')" > 
  <area shape="rect" coords="31,67,39,75" href="javascript:setcolor('993333')" > 
  <area shape="rect" coords="40,67,48,75" href="javascript:setcolor('993366')" > 
  <area shape="rect" coords="49,67,57,75" href="javascript:setcolor('993399')" > 
  <area shape="rect" coords="58,67,66,75" href="javascript:setcolor('9933CC')" > 
  <area shape="rect" coords="67,67,75,75" href="javascript:setcolor('9933FF')" > 
  <area shape="rect" coords="76,76,84,84" href="javascript:setcolor('99CCCC')" > 
  <area shape="rect" coords="85,76,93,84" href="javascript:setcolor('99CCFF')" > 
  <area shape="rect" coords="94,76,102,84" href="javascript:setcolor('99FF00')" > 
  <area shape="rect" coords="103,76,111,84" href="javascript:setcolor('99FF33')" > 
  <area shape="rect" coords="112,76,120,84" href="javascript:setcolor('99FF66')" > 
  <area shape="rect" coords="121,76,129,84" href="javascript:setcolor('99FF99')" > 
  <area shape="rect" coords="130,76,138,84" href="javascript:setcolor('99FFCC')" > 
  <area shape="rect" coords="139,76,147,84" href="javascript:setcolor('99FFFF')" > 
  <area shape="rect" coords="4,76,12,84" href="javascript:setcolor('999966')" > 
  <area shape="rect" coords="13,76,21,84" href="javascript:setcolor('999999')" > 
  <area shape="rect" coords="22,76,30,84" href="javascript:setcolor('9999CC')" > 
  <area shape="rect" coords="31,76,39,84" href="javascript:setcolor('9999FF')" > 
  <area shape="rect" coords="40,76,48,84" href="javascript:setcolor('99CC00')" > 
  <area shape="rect" coords="49,76,57,84" href="javascript:setcolor('99CC33')" > 
  <area shape="rect" coords="58,76,66,84" href="javascript:setcolor('99CC66')" > 
  <area shape="rect" coords="67,76,75,84" href="javascript:setcolor('99CC99')" > 
  <area shape="rect" coords="76,85,84,93" href="javascript:setcolor('CC3366')" > 
  <area shape="rect" coords="85,85,93,93" href="javascript:setcolor('CC3399')" > 
  <area shape="rect" coords="94,85,102,93" href="javascript:setcolor('CC33CC')" > 
  <area shape="rect" coords="103,85,111,93" href="javascript:setcolor('CC33FF')" > 
  <area shape="rect" coords="112,85,120,93" href="javascript:setcolor('CC6600')" > 
  <area shape="rect" coords="121,85,129,93" href="javascript:setcolor('CC6633')" > 
  <area shape="rect" coords="130,85,138,93" href="javascript:setcolor('CC6666')" > 
  <area shape="rect" coords="139,85,147,93" href="javascript:setcolor('CC6699')" > 
  <area shape="rect" coords="4,85,12,93" href="javascript:setcolor('CC0000')" > 
  <area shape="rect" coords="13,85,21,93" href="javascript:setcolor('CC0033')" > 
  <area shape="rect" coords="22,85,30,93" href="javascript:setcolor('CC0066')" > 
  <area shape="rect" coords="31,85,39,93" href="javascript:setcolor('CC0099')" > 
  <area shape="rect" coords="40,85,48,93" href="javascript:setcolor('CC00CC')" > 
  <area shape="rect" coords="49,85,57,93" href="javascript:setcolor('CC00FF')" > 
  <area shape="rect" coords="58,85,66,93" href="javascript:setcolor('CC3300')" > 
  <area shape="rect" coords="67,85,75,93" href="javascript:setcolor('CC3333')" > 
  <area shape="rect" coords="76,94,84,102" href="javascript:setcolor('CCCC00')" > 
  <area shape="rect" coords="85,94,93,102" href="javascript:setcolor('CCCC33')" > 
  <area shape="rect" coords="94,94,102,102" href="javascript:setcolor('CCCC66')" > 
  <area shape="rect" coords="103,94,111,102" href="javascript:setcolor('CCCC99')" > 
  <area shape="rect" coords="112,94,120,102" href="javascript:setcolor('CCCCCC')" > 
  <area shape="rect" coords="121,94,129,102" href="javascript:setcolor('CCCCFF')" > 
  <area shape="rect" coords="130,94,138,102" href="javascript:setcolor('CCFF00')" > 
  <area shape="rect" coords="139,94,147,102" href="javascript:setcolor('CCFF33')" > 
  <area shape="rect" coords="4,94,12,102" href="javascript:setcolor('CC66CC')" > 
  <area shape="rect" coords="13,94,21,102" href="javascript:setcolor('CC66FF')" > 
  <area shape="rect" coords="22,94,30,102" href="javascript:setcolor('CC9900')" > 
  <area shape="rect" coords="31,94,39,102" href="javascript:setcolor('CC9933')" > 
  <area shape="rect" coords="40,94,48,102" href="javascript:setcolor('CC9966')" > 
  <area shape="rect" coords="49,94,57,102" href="javascript:setcolor('CC9999')" > 
  <area shape="rect" coords="61,96,69,104" href="javascript:setcolor('CC99CC')" > 
  <area shape="rect" coords="67,94,75,102" href="javascript:setcolor('CC99FF')" > 
  <area shape="rect" coords="76,103,84,111" href="javascript:setcolor('FF00CC')" > 
  <area shape="rect" coords="85,103,93,111" href="javascript:setcolor('FF00FF')" > 
  <area shape="rect" coords="94,103,102,111" href="javascript:setcolor('FF3300')" > 
  <area shape="rect" coords="103,103,111,111" href="javascript:setcolor('FF3333')" > 
  <area shape="rect" coords="112,103,120,111" href="javascript:setcolor('FF3366')" > 
  <area shape="rect" coords="121,103,129,111" href="javascript:setcolor('FF3399')" > 
  <area shape="rect" coords="130,103,138,111" href="javascript:setcolor('FF33CC')" > 
  <area shape="rect" coords="139,103,147,111" href="javascript:setcolor('FF33FF')" > 
  <area shape="rect" coords="4,103,12,111" href="javascript:setcolor('CCFF66')" > 
  <area shape="rect" coords="13,103,21,111" href="javascript:setcolor('CCFF99')" > 
  <area shape="rect" coords="22,103,30,111" href="javascript:setcolor('CCFFCC')" > 
  <area shape="rect" coords="31,103,39,111" href="javascript:setcolor('CCFFFF')" > 
  <area shape="rect" coords="40,103,48,111" href="javascript:setcolor('FF0000')" > 
  <area shape="rect" coords="49,103,57,111" href="javascript:setcolor('FF0033')" > 
  <area shape="rect" coords="58,103,66,111" href="javascript:setcolor('FF0066')" > 
  <area shape="rect" coords="67,103,75,111" href="javascript:setcolor('FF0099')" > 
  <area shape="rect" coords="76,112,84,120" href="javascript:setcolor('FF9966')" > 
  <area shape="rect" coords="85,112,93,120" href="javascript:setcolor('FF9999')" > 
  <area shape="rect" coords="94,112,102,120" href="javascript:setcolor('FF99CC')" > 
  <area shape="rect" coords="103,112,111,120" href="javascript:setcolor('FF99FF')" > 
  <area shape="rect" coords="112,112,120,120" href="javascript:setcolor('FFCC00')" > 
  <area shape="rect" coords="121,112,129,120" href="javascript:setcolor('FFCC33')" > 
  <area shape="rect" coords="130,112,138,120" href="javascript:setcolor('FFCC66')" > 
  <area shape="rect" coords="139,112,147,120" href="javascript:setcolor('FFCC99')" > 
  <area shape="rect" coords="4,112,12,120" href="javascript:setcolor('FF6600')" > 
  <area shape="rect" coords="13,112,21,120" href="javascript:setcolor('FF6633')" > 
  <area shape="rect" coords="22,112,30,120" href="javascript:setcolor('FF6666')" > 
  <area shape="rect" coords="31,112,39,120" href="javascript:setcolor('FF6699')" > 
  <area shape="rect" coords="40,112,48,120" href="javascript:setcolor('FF66CC')" > 
  <area shape="rect" coords="49,112,57,120" href="javascript:setcolor('FF66FF')" > 
  <area shape="rect" coords="58,112,66,120" href="javascript:setcolor('FF9900')" > 
  <area shape="rect" coords="67,112,75,120" href="javascript:setcolor('FF9933')" > 
  <area shape="rect" coords="4,121,12,129" href="javascript:setcolor('FFCCCC')" > 
  <area shape="rect" coords="13,121,21,129" href="javascript:setcolor('FFCCFF')" > 
  <area shape="rect" coords="22,121,30,129" href="javascript:setcolor('FFFF00')" > 
  <area shape="rect" coords="31,121,39,129" href="javascript:setcolor('FFFF33')" > 
  <area shape="rect" coords="40,121,48,129" href="javascript:setcolor('FFFF66')" > 
  <area shape="rect" coords="49,121,57,129" href="javascript:setcolor('FFFF99')" > 
  <area shape="rect" coords="58,121,66,129" href="javascript:setcolor('FFFFCC')" > 
  <area shape="rect" coords="67,121,75,129" href="javascript:Setcolor('FFFFFF')" > 
</map> <map name="fontlist"> <area shape="rect" coords="7,111,99,125" href="javascript:setfont('Tahoma, Arial, Helvetica, Sans-serif')" > 
  <area shape="rect" coords="4,91,96,108" href="javascript:setfont('Georgia, Times')" > 
  <area shape="rect" coords="3,73,96,90" href="javascript:setfont('impact')" > 
  <area shape="rect" coords="4,58,96,72" href="javascript:setfont('Courier, fixed')" > 
  <area shape="rect" coords="3,39,96,57" href="javascript:setfont('Verdana, Arial, Helvetica, Sans-serif')" > 
  <area shape="rect" coords="3,22,96,38" href="javascript:setfont('Times')" > 
  <area shape="rect" coords="4,3,96,21" href="javascript:setfont('Arial, Helvetica, Sans-serif')" > 
</map> 
<table width="99%" cellpadding="0" cellspacing="0" class="tabelaMenu"><tr><td><DIV id=oDiv contenteditable ALIGN=left"></DIV></td></tr></table> 
<button UNSELECTABLE 
	title="View HTML" 
	onClick='display();'> 
	View HTML
</button>&nbsp;
<button UNSELECTABLE 
	title="Gravar Informações"> 
	Gravar Informações
</button> 
</body>
</HTML>
