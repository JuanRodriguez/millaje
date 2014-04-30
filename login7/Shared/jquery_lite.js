/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */


// JQuery LITE =)
var $ = function (ID)
	{
		var thsID = document.getElementById (ID);
		// if (thsID == null) window.alert ("ID = " + ID + " not found!! ");
		if (thsID == null) return null;
		thsID.$ = next$;
		return thsID
	}
	
var next$ = function (thsChild)
	{
		nextID = getChild (this, thsChild);
		// if (nextID == null) window.alert ("thsChild = " + thsChild + " not found!! ");
		if (nextID == null) return null;
		nextID.$ = next$;
		return nextID;
	}

function getChild (currentElement, childElement)
{
	if (!currentElement) return;

	var i=0;
	var currentChild = currentElement.childNodes[i];

	while (currentChild)
	{
		if (currentChild)
			if (
					(currentChild.tagName == childElement) ||
					(currentChild.id == childElement)
				) return currentChild;

		i++;
		currentChild = currentElement.childNodes[i];
	}
}

