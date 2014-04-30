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
?>

<?= $szNameSpace?>.cmdUpdate = function (thsForm)
	{
		szParams =
			"nID=" + this.nCurrentID + "&" +
			"szNameSpace=" + this.szNameSpace + "&" +
			<?= $szParent ?>.getFormData (thsForm);

		<?= $szParent ?>.getPanel ("login/update.php", this.divTarget, szParams);
		<?= $szParent ?>.selected (this.nCurrentID);
	};

