/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

ENetArch.Security.Menus =
{
	divTarget : null,
	szNameSpace : "",
	szFile : "",

	display : function (nID)
	{
		var szParams =
			"szNameSpace=" + this.szNameSpace + "&" +
			"nFolderID=" + nID + "&" +
			"szSortBy=ID";
		ENetArch.Security.getPanel (this.szFile, this.divTarget, szParams);
	},
};
