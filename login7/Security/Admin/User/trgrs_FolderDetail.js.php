<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../../"); }
	Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Globals.cls");

	// ======================================

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	$aryNameSpace = explode (".", $szNameSpace);
	$szParent = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -1));
	$szApp = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -2));
?>

<?= $szParent ?>.cmdClearIDs();

<?= $szNameSpace ?> =
{
	Selected : function (nID)
	{ <?= $szApp ?>.selected (nID); },

	onCheckID : function (nID)
	{ <?= $szParent ?>.onCheckID (nID); },

	SortBy_ID : function ()
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szSortBy=" + "<?= ldrGlobals::cOrderBy_ID () ?>"+ "&";

		<?= $szApp ?>.getPanel ("User/view.php", this.divTarget, szParams);
		// <?= $szApp ?>.selected (this.nCurrentID);
	},

	SortBy_BaseType : function ()
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szSortBy=" + "<?= ldrGlobals::cOrderBy_BaseType () ?>"+ "&";

		<?= $szApp ?>.getPanel ("User/view.php", this.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

	SortBy_Name : function ()
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szSortBy=" + "<?= ldrGlobals::cOrderBy_Name () ?>"+ "&";

		<?= $szApp ?>.getPanel ("User/view.php", this.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

	SortBy_Description : function ()
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szSortBy=" + "<?= ldrGlobals::cOrderBy_Description () ?>"+ "&";

		<?= $szApp ?>.getPanel ("User/view.php", this.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

	SortBy_Class : function ()
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szSortBy=" + "<?= ldrGlobals::cOrderBy_Class() ?>"+ "&";

		<?= $szApp ?>.getPanel ("User/view.php", this.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

//	<?= $szApp ?>.getFormData (thsForm) ;

}
