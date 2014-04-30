/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

ENetArch.Security =
{
	nFolderID : 0,
	cbSelected : Array(),

	getPanel : function (thsFile, thsDiv, thsParams)
	{
		var ajPanel = new AJAX();
		ajPanel.Get (thsFile, thsDiv, thsParams);
	},

	postPanel : function (thsFile, thsDiv, thsParams)
	{
		var ajPanel = new AJAX();
		ajPanel.Post (thsFile, thsDiv, thsParams);
	},

	addSelected : function (thsFoo)
	{ this.cbSelected [this.cbSelected.length] = thsFoo; },

	selected : function (nID)
	{
		for (t=0; t<this.cbSelected.length; t++)
		{ 	this.cbSelected[t].selected (nID); }
	},

	// =================================

	cmdNew : function (nClass)
	{ ENetArch.Security.Content.cmdNew(nClass); },

	cmdEdit : function ()
	{ ENetArch.Security.Content.cmdEdit(); },

	cmdView : function ()
	{ ENetArch.Security.Content.cmdView(); },

	// =================================

	cmdCut : function ()	{ window.alert ("not implemented"); },
	cmdCopy : function ()	{ window.alert ("not implemented"); },
	cmdPaste : function ()	{ window.alert ("not implemented"); },

	// =================================

	cmdDelete : function ()
	{ ENetArch.Security.Content.cmdDelete(); },

	// =================================

	cmdSelectAll : function ()	{ window.alert ("not implemented"); },
	cmdInvertSelection : function ()	{ window.alert ("not implemented"); },

	// =================================

	cmdProperties : function ()
	{ ENetArch.Security.Content.cmdProperties(); },

	// =================================

	getFormData : function (thsForm)
	{
		szRtn = "";
		for (t=0; t<thsForm.elements.length; t++)
		{
			field = thsForm.elements[t];
			szRtn += field.name + "=" + field.value + "&";
		}

		return (szRtn);
	},

	stringIDs : function (aryIDs)
	{
		var szIDs = "";
		for (t=0; t<aryIDs.length; t++)
			if (aryIDs[t]!= undefined)
				szIDs += aryIDs[t] + ",";

		return (szIDs);
	},

};
