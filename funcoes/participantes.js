// JavaScript Document - Listagem de Participantes OnLine
function defineLayer()
{
	var div = document.getElementById('layer1');
	var width = 450;
	var height = 220;
	var left = ((window.screen.width - width) / 2);
	var top = ((window.screen.height - height) / 2);
	/*jQuery(div).css({width: "450px",
				     height: "220px",
				     left: left,
				     top: top});*/
	div.style.width = width + 'px';
	div.style.height = height + 'px';
	div.style.left = left + 'px';
	div.style.top = top + 'px';
}

function ToggleFloatingLayer(DivID, iState) // 1 visible, 0 hidden
{
	if (iState == 1)
	{
		var left = ((window.screen.width - 450) / 2);
		var top = ((window.screen.height - 220) / 2);
		//<![CDATA[
		jQuery(document).ready(function()
		{
			var flutua = new posicao(DivID,left,top);
			flutua.init();
		});
		//]]>
	}
	
    if(document.layers)	   //NN4+
    {
       document.layers[DivID].visibility = iState ? "show" : "hide";
    }
    else if(document.getElementById)	  //gecko(NN6) + IE 5+
    {
        var obj = document.getElementById(DivID);
        obj.style.visibility = iState ? "visible" : "hidden";
    }
    else if(document.all)	// IE 4
    {
        document.all[DivID].style.visibility = iState ? "visible" : "hidden";
    }
}

posicao = function(id,l,t)
{
	var obj = this;
	var o = document.getElementById(id);
	
	jQuery(o).css({"z-index": "102",
				   "position": "absolute"});
	
	this.getPageScrollTop = function()
	{
		var yScrolltop;
		var xScrollleft;
		if (self.pageYOffset || self.pageXOffset)
		{
			yScrolltop = self.pageYOffset;
			xScrollleft = self.pageXOffset;
		}
		else if(document.documentElement && document.documentElement.scrollTop || document.documentElement.scrollLeft )
		{	 // Explorer 6 Strict
			yScrolltop = document.documentElement.scrollTop;
			xScrollleft = document.documentElement.scrollLeft;
		}
		else if(document.body)
		{// all other Explorers
			yScrolltop = document.body.scrollTop;
			xScrollleft = document.body.scrollLeft;
		}
		arrayPageScroll = new Array(xScrollleft,yScrolltop) 
		return arrayPageScroll;
	};
	
	this.position = function()
	{
		var arrayPageScroll = obj.getPageScrollTop();
		jQuery(o).css({left: (arrayPageScroll[0] + l), top: (arrayPageScroll[1] + t) });
	};
	
	this.init = function()
	{
		jQuery(window).scroll(function(){obj.position();});
		jQuery(window).resize(function(){obj.position();});
		obj.position();
	};
};