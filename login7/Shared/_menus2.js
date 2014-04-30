/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

var NS = (navigator.appName == "Netscape");
var IE = (navigator.appName != "Netscape");
var NS6 = (NS && parseFloat (navigator.appVersion) >= 5.0)
var NS4 = (NS && parseFloat (navigator.appVersion) < 5.0)

ENetArch.Menu = function ()
	{ return (
	{
		nID : parseInt (Math.random()*9999999999999),
		szDisplay : "",
		szURL : "",
		menuDirection : "V", // Vertical or Horizontal

		Max : 0,
		Menus : new Array (),
		parent : null,

		add : function (thsDisplay, thsURL)
		{
			var thsInst = this;
			var menu = new ENetArch.Menu ();

			menu.szDisplay = thsDisplay
			menu.szURL = thsURL;
			menu.parent = thsInst;

			var x = thsInst.Max++;
			thsInst.Menus [x+1] = menu;

			return menu;
		},

		remove : function ()
		{
			var thsInst = this;
			var thsParent = thsInst.parent;

			for (var t=1; t<thsParent.Max+1; t++)
			{
				var nID = thsParent.Menus[t].nID ;
				if (nID == this.nID)
				{
					thsParent.Menus.splice (t,1);
					thsParent.Max--;
				}
			}
		},
	});
	};

ENetArch.DOMMenus =
	{
		divMenu : null,
		menuActive : false,
		activeMenusCnt : 0,
		activeMenus : new Array(),
		Menus : null,

		_init : function (thsDiv, thsMenus)
		{
			if (thsMenus == null) return;

			if (thsDiv != null)
			{
				this.divMenu = thsDiv;
				this.Menus = thsMenus;

			}
			else
			{
				var divBody = document.getChild ("BODY");
				divBody.innerHTML += "\n" +
					"<div id='Menus_" + this.szRandom + "' class=''>" +
					"</div>";

				this.divMenu = divBody;
			}
		},

		show : function ()
		{
			var thsInst = this;
			var divMenu = thsInst.divMenu;
			divMenu.innerHTML = "";
			var nLevel = 1;

			thsInst.draw (thsInst.Menus, nLevel);
			var szMenuName = "Menu_" + thsInst.Menus.nID;
			var divMenu = $(szMenuName);
			thsInst.visible (divMenu, true);
		},

		draw : function (mnu, nLevel)
		{
			if (mnu == null) return;

			var thsInst = this;
			var divMenu = thsInst.divMenu;

			if (mnu.Max == 0) return;

			var szClass = ( (mnu.menuDirection == "H") ? "mnuBar" : "mnuList");

			var szMenuName = "Menu_" + mnu.nID;

			divMenu.innerHTML += "\n" +"\n" +
				"<div ID='" + szMenuName + "' class='" + szClass + "' " +
					'onMouseOver="ENetArch.DOMMenus.menuActive=true;" ' +
					'onMouseOut="ENetArch.DOMMenus.menuActive=false;" ' +
					'style="visibility:hidden;" ' +
				">" +
				"</div>";

			var divMenuItems = $(szMenuName);

			for (var t=1; t<mnu.Max+1; t++)
			{
				var nID = mnu.Menus[t].nID ;
				var szID = "MenuItem_" + nID;
				var szDisplay = mnu.Menus[t].szDisplay;
				var szURL = mnu.Menus[t].szURL;

				if (szURL == "") szURL = "javascript:void(0);";

				var szMnuItem = "";
				if (szDisplay == "<HR>")
				{ szMnuItem = "<HR>"; }
				else
				{
					szMnuItem =
						'<span ID="' + szID + '" class="mnuItem">' +
						'<a href="' + szURL + '" class="mnuStyle" ' +
							'onMouseOver="ENetArch.DOMMenus.onMouseOver (this, ' + nLevel + ');" ' +
							'Name="' + nID + '" ' +
						'>' + szDisplay + '</a></span> ';

					if (mnu.menuDirection == "V")
						szMnuItem += "<BR>";
				}

				divMenuItems.innerHTML += "\n" + szMnuItem;
			}

			for (var t=1; t<mnu.Max+1; t++)
				thsInst.draw (mnu.Menus[t], nLevel +1);

			setInterval("ENetArch.DOMMenus.hideMenus()",250);

		},

		peek : function ()
		{
			var thsInst = this;
			var mnu
			for (var t=1; t<thsInst.Max+1; t++)
			{
				var szName = "MenuItem_" + thsInst.Menus[t].szRandom ;
				var aHref = $(szName).$("A");

				// note that <div id="szStatus"></div> must exist in the DOM
				var divStatus = $("szStatus");
				divStatus.innerHTML += "<BR>\n" +
					"aHref.id = " + aHref.parentNode.id + ", " +
					"aHref.onclick = " + aHref.onclick;
			}
		},

		hideMenus : function  ()
		{
			if (! this.menuActive)
			{
				for (var t=0; t<this.activeMenusCnt; t++)
					this.visible (this.activeMenus [t], false);

				this.activeMenusCnt = 0;
			}
		},

		closeMenus : function (nLevel)
		{
			for (var t=nLevel-1; t<this.activeMenusCnt; t++)
				if (this.activeMenus [t] != null)
				this.visible (this.activeMenus [t], false);

			this.activeMenusCnt = nLevel -1;
		},

		visible : function (divMenu, tf)
		{
			if (divMenu == null) return;
			divMenu.style.visibility = ((tf) ? "visible" : "hidden");
		},

		onClick : function (ths) { window.alert ("clicked " + ths.parentNode.id); },

		onMouseOut : function  (p) {},

		onMouseOver : function  (p, nLevel)
		{
			var thsInst = this;

			// get the layer that is to be displayed

			var thsSpan = $("MenuItem_" + p.name);
			var thsDiv = p.offsetParent;

			var thsLayer = $("Menu_" + p.name);
			if (thsLayer == null) return;

			// close all other layers that may be open
			// and unnecessary

			thsInst.closeMenus(nLevel);
			thsInst.menuActive = true;

			// position the layer

			var ofx = 0;
			var ofy = 0;

			if (thsInst.activeMenusCnt > 0)
			{
				var t = thsInst.activeMenusCnt -1;
				ofx = thsInst.activeMenus [t].offsetWidth-10;
			}

			thsInst.activeMenus [nLevel-1] = thsLayer;
			thsInst.activeMenusCnt = nLevel;
			thsLayer.zIndex = nLevel;

			// Position the new Menu Layer

			var x = 0;
			var y = 0;

			x = thsSpan.offsetLeft;
			y = thsSpan.offsetTop ;
			if (nLevel == 1)
				y += thsSpan.offsetHeight - 2;

			x += thsDiv.offsetLeft;
			y += thsDiv.offsetTop; // + thsDiv.offsetHeight;

			thsLayer.style.left = x + ofx;
			thsLayer.style.top = y + ofy;
			thsLayer.style.visibility = "visible";
		}
	};
	
