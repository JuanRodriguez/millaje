/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

function AJAX () 
{ return ( 
{
	request : null, 
	divTarget: null,
	szRandom : parseInt (Math.random()*9999999999999),
	szURL : "", 
	
	Get : function (szPage, thsDiv, szParams)
	{
		var thsInstance = this;
		thsInstance.divTarget = thsDiv;
		var callback = function () { thsInstance.Response (thsInstance); };
		
		thsInstance.szURL = szPage + "?" + thsInstance.szRandom +"&" + szParams;

		thsInstance.request = new XMLHttpRequest();
		thsInstance.request.open ("GET", thsInstance.szURL, true);
		thsInstance.request.onreadystatechange = callback;
		thsInstance.request.send (null);
	},

	Post : function (szPage, thsDiv, szParams)
	{
		var thsInstance = this;
		thsInstance.divTarget = thsDiv;
		var callback = function () { thsInstance.Response (thsInstance); };
		
		thsInstance.szURL = szPage + "?" + thsInstance.szRandom +"&";
		
		thsInstance.request = new XMLHttpRequest();
		thsInstance.request.open ("POST", thsInstance.szURL, true);
		thsInstance.request.onreadystatechange = callback;
		thsInstance.request.setRequestHeader ("Content-type", "application/x-www-form-urlencoded");
		thsInstance.request.setRequestHeader ("Content-length", szParams.length);
		// thsInstance.request.setRequestHeader ("Connection", "close");
		thsInstance.request.send (szParams);
	},

	Response : function (thsInst)
	{
		if (thsInst.request.readyState != 4) return;
		if (thsInst.request.status != 200)
		{
			window.alert ("error occured! \n" + 
				"URL = "+ thsInst.szURL + "\n"+
				thsInst.request.status + " - "	+ 
				thsInst.request.statusText);
			return;
		}

		if (thsInst.divTarget == null) return;

		var szText = thsInst.request.responseText;
		thsInst.divTarget.innerHTML = szText;
		thsInst.add_Script_Tags (thsInst.divTarget);
		
		if (thsInst.divTarget.onUpdate != null)
			thsInst.divTarget.onUpdate();
	},
	
	add_Script_Tags : function (thsTag)
	{
		var codeText = thsTag.getElementsByTagName ('script');
	
		for (var t=0; t<codeText.length; t++)
		{
			var szCode = codeText[t].text;
	
			if (szCode.length != 0)
			{ window.eval (szCode); }
			else
			{
				var szSrc = codeText[t].src;
				var oScript = document.createElement ("script");
				oScript.src = szSrc;
				document.body.appendChild (oScript);
			}
		}
	}
});
}


