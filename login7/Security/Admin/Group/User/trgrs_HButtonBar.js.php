/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

<?
	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	$aryNameSpace = explode (".", $szNameSpace);
	$szParent = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -1));
	$szApp = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -2));

?>

<?= $szNameSpace ?> =
{
	cmdAdd_Users : function ()
	{
		var szIDs = ENetArch.Security.stringIDs (<?= $szParent ?>.aryIDs);

		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"szIDs=" + szIDs + "&";

		<?= $szApp ?>.getPanel ("Group/User/add.php", <?= $szParent ?>.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

	cmdDelete : function ()
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" ;

		<?= $szApp ?>.getPanel ("Users/deletebummer.php", <?= $szParent ?>.divTarget, szParams);
		<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
	},

	cmdParentFolder : function ()
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" ;

		<?= $szApp ?>.getPanel ("_parent.php", <?= $szParent ?>.divTarget, szParams);
	},
}
