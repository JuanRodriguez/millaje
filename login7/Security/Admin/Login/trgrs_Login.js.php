<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	$szNameSpace = "ENetArch_Security_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	$aryNameSpace = explode (".", $szNameSpace);
	$szParent = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -1));
	$szApp = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -2));
?>

<?= $szNameSpace?> =
{
	cmdActivate : function ()
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"bActive=1&";

		<?= $szApp ?>.getPanel ("login/activate.php", <?= $szParent ?>.divTarget, szParams);
		<?= $szApp ?>.getPanel ("login/view.php", <?= $szParent ?>.divTarget, szParams);
	},

	cmdDeActivate : function ()
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"bActive=0&";

		<?= $szApp ?>.getPanel ("login/activate.php", <?= $szParent ?>.divTarget, szParams);
		<?= $szApp ?>.getPanel ("login/view.php", <?= $szParent ?>.divTarget, szParams);
	},

	ckboxChanged : function (me)
	{
		szParams =
			"nID=" + <?= $szParent ?>.nCurrentID + "&" +
			"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
			"bActive=" + ( (me.checked) ? 1 : 0 ) + "&";

		<?= $szApp ?>.getPanel ("login/activate.php", <?= $szParent ?>.divTarget, szParams);
		<?= $szApp ?>.getPanel ("login/view.php", <?= $szParent ?>.divTarget, szParams);
	},
};