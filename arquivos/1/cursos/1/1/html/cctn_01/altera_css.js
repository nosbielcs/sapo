var Limit = 0;
function AlterCss()
{
	// DESCRIÇÃO DA FUNÇÃO:
	// Aumenta e diminui os valores dos textos
	// nos arquivos .css anexados ao arquivo e declarados no array ClsObj
	// ARGUMENTOS DA FUNÇÃO:
	// Argumento  0 = bol	[Modo + / -]
	// SOBRE O ESCOPO:
	// A variável [Limit] declarada anteriormente no escopo global,
	// é incrementada ou decrementada a partir desta função
	var MyMode = arguments[0];
	var MaxLen = 20;
	var MinLen = 0;
	var CssObj = document.styleSheets;
	var CssLen = CssObj.length;
	var LimCnt = 0;
	var ClsObj = new Array()
		ClsObj[0] = "NotTit"
		ClsObj[1] = "NotSin"
		ClsObj[2] = "NotTxt"
		ClsObj[3] = "NotAut"
		ClsObj[4] = "NotLeg"
		ClsObj[5] = "Indice"
		ClsObj[6] = "MaisNot"
		ClsObj[7] = "ChnDir"
		ClsObj[8] = "ChnEsq"
		ClsObj[9] = "ChnSin"
		ClsObj[10] = "ChnTit"
		ClsObj[11] = "SepIdx"
	for(i = 0; i < CssLen; i++)
	{
		var MyCss = CssObj[i];
		var MyRul = (document.all ? MyCss.rules : MyCss.cssRules);
		var Valid = MyCss.href != document.location && MyCss.href != "" ? true : false;
		if(Valid)
		{
			for(j = 0; j < MyRul.length; j++)
			{
				for(k = 0; k < ClsObj.length; k++)
				{
					var Classe = "#" + ClsObj[k];
					var ClsTxt = MyRul[j].selectorText;
					if(ClsTxt == Classe)
					{
						var MySize = MyRul[j].style.fontSize;
						if(MyMode > 0)
						{
							if(Limit < MaxLen)
							{
								MyRul[j].style.fontSize = (parseInt(MySize) + 1) + "px";
								LimCnt++;
							}
						}
						else
						{
							if(Limit > MinLen)
							{
								MyRul[j].style.fontSize = (parseInt(MySize) - 1) + "px";
								LimCnt++;
							}
						}
					}
				}
			}
			if(LimCnt > 0)
			{
				MyMode > 0 ? Limit++ : Limit--;
			}
		}
	}
	return void(0);
}