/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

ENetArch.Security.Content =
{
	nCurrentID : 0 ,
	aryIDs: new Array (),
	divTarget : null,
	szNameSpace : "",
	szPasteMode : "",
	szFile_New : "_new.php",
	szFile_Edit : "_edit.php",
	szFile_View : "_view.php",
	szFile_Delete : "_delete.php",
	szFile_Copy : "_copy.php",
	szFile_Move : "_move.php",
	szFile_Properties : "_properties.php",

	// =================================================

	display : function (nID)
	{
		this.nCurrentID = nID;

		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nID=" + nID + "&" +
			"szSortBy=ID";

		ENetArch.Security.getPanel (this.szFile_View, this.divTarget, szParams);
	},

	// =================================================

	onCheckID : function (me)
	{
		// this.nCurrentID = me.value;
		if (me.checked)
		{ this.aryIDs [me.value] = me.value; }
		else
		{ this.aryIDs [me.value] = undefined; }
	},

	// =================================================

	Selected : function (nID)
	{	ENetArch.Security.selected (nID);	},

	selected : function (nID)
	{
		this.nCurrentID = nID;

		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nID=" + nID + "&";

		ENetArch.Security.getPanel (this.szFile_View, this.divTarget, szParams);
	},

	// =================================================

	cmdNew : function (nClass)
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nClass=" + nClass + "&" +
			"nID=" + this.nCurrentID + "&";

		ENetArch.Security.getPanel (this.szFile_New, this.divTarget, szParams);
	},

	cmdEdit : function ()
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nID=" + this.nCurrentID + "&" ;

		ENetArch.Security.getPanel (this.szFile_Edit, this.divTarget, szParams);
	},

	cmdView : function ()
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nID=" + this.nCurrentID + "&" ;

		ENetArch.Security.getPanel (this.szFile_View, this.divTarget, szParams);
	},

	// =================================================

	cmdClearIDs : function ()
	{ this.aryIDs = new Array (); },

	cmdDelete : function ()
	{
		var szIDs = ENetArch.Security.stringIDs (this.aryIDs);

		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"szIDs=" + szIDs + "&";

		ENetArch.Security.getPanel (this.szFile_Delete, this.divTarget, szParams);
		this.aryIDs = new Array ();
		// ENetArch.Security.selected (this.nCurrentID);
	},

	// =================================================

	cmdCopy : function ()
	{ this.szPasteMode = this.szFile_Copy; },

	cmdCut : function ()
	{ this.szPasteMode = this.szFile_Move; },

	cmdPaste : function ()
	{
		var szIDs = ENetArch.Security.stringIDs (this.aryIDs);

		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"szIDs=" + nIDs + "&" +
			"nID=" + this.nCurrentID + "&" ;

		ENetArch.Security.getPanel (this.szPasteMode, this.divTarget, szParams);
		this.aryIDs = new Array ();
		ENetArch.Security.selected (this.nCurrentID);
	},

	// =================================================

	cmdProperties : function ()
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nID=" + this.nCurrentID + "&" ;

		ENetArch.Security.getPanel (this.szFile_Properties, this.divTarget, szParams);
	},

	// =================================================

	cmdCreateFolder : function (thsForm)
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + this.szNameSpace + "&" +
			ENetArch.Security.getFormData (thsForm) ;

		ENetArch.Security.postPanel ("forms/Notes/add.php", this.DivTarget, szParams);
		ENetArch.Security.selected (this.nCurrentID);
	},

	cmdUpdateFolder : function (thsForm)
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + this.szNameSpace + "&" +
			ENetArch.Security.getFormData (thsForm) ;

		ENetArch.Security.postPanel ("forms/Notes/update.php", this.DivTarget, szParams);
		ENetArch.Security.selected (this.nCurrentID);
	},

	// =================================================

	cmdCreateNote : function (thsForm)
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + this.szNameSpace + "&" +
			ENetArch.Security.getFormData (thsForm) ;

		ENetArch.Security.postPanel ("forms/Note/add.php", this.DivTarget, szParams);
		ENetArch.Security.selected (this.nCurrentID);
	},

	cmdUpdateNote : function (thsForm)
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + this.szNameSpace + "&" +
			ENetArch.Security.getFormData (thsForm) ;

		ENetArch.Security.postPanel ("forms/Note/update.php", this.DivTarget, szParams);
		ENetArch.Security.selected (this.nCurrentID);
	},

	// =================================================

};
