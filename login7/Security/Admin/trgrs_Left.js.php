/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

ENetArch.Security.Left =
{
	nTopFolder : 0 ,
	divTarget : null,
	szNameSpace : "",
	szFile : "",
	bStatus : "",

	display : function (nID)
	{
		this.nTopFolder = nID;
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nFolderID=" + this.nTopFolder + "&" +
			"nID=" + nID + "&" +
			"bStatus=Exp";
		ENetArch.Security.getPanel (this.szFile, this.divTarget, szParams);
	},

	// =================================================

	Expand : function (nID)
	{
		// location="?nFolderID=" + this.nCurrent + "&nID=" + nID + "&bStatus=Exp";
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nFolderID=" + this.nTopFolder + "&" +
			"nID=" + nID + "&" +
			"bStatus=Exp";
		ENetArch.Security.getPanel (this.szFile, this.divTarget, szParams);
	},

	Collapse : function (nID)
	{
		// location="?nFolderID=" + this.nCurrent + "&nID=" + nID + "&bStatus=Col";
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nFolderID=" + this.nTopFolder + "&" +
			"nID=" + nID + "&" +
			"bStatus=Col";
		ENetArch.Security.getPanel (this.szFile, this.divTarget, szParams);
	},

	// =================================================

	Selected : function (nID, bStatus)
	{
		this.bStatus = bStatus;
		ENetArch.Security.selected (nID);
	},

	selected : function (nID)
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nFolderID=" + this.nTopFolder + "&" +
			"nID=" + nID + "&" +
			"bStatus=" + this.bStatus;
		ENetArch.Security.getPanel (this.szFile, this.divTarget, szParams);
	},
};
