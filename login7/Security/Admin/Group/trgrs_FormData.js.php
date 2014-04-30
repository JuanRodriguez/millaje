<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	$aryNameSpace = explode (".", $szNameSpace);
	$szParent = $szNameSpace;
	$szApp = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -1));
?>

<?= $szNameSpace ?>.cmdAdd = function (thsForm)
{
	szParams =
		"nID=" + <?= $szParent ?>.nCurrentID + "&" +
		"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
		<?= $szApp ?>.getFormData (thsForm) ;

	<?= $szApp ?>.postPanel ("Group/add.php", this.divTarget, szParams);
	<?= $szApp ?>.selected (this.nCurrentID);
};

<?= $szNameSpace ?>.cmdUpdate = function (thsForm)
{
	szParams =
		"nID=" + <?= $szParent ?>.nCurrentID + "&" +
		"szNameSpace=" + <?= $szParent ?>.szNameSpace + "&" +
		<?= $szApp ?>.getFormData (thsForm) ;

	<?= $szApp ?>.postPanel ("Group/update.php", this.divTarget, szParams);
	<?= $szApp ?>.selected (<?= $szParent ?>.nCurrentID);
};
