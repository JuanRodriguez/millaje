<?
	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	$aryNameSpace = explode (".", $szNameSpace);
	$szParent = implode (".", array_slice ($aryNameSpace, 0, count ($aryNameSpace) -1));

?>

<?= $szNameSpace ?>.cmdAdd = function (thsForm)
{
	szParams =
		"nID=" + this.nCurrentID + "&" +
		"szNameSpace=" + this.szNameSpace + "&" +
		<?= $szParent ?>.getFormData (thsForm) ;

	<?= $szParent ?>.postPanel ("App/add.php", this.divTarget, szParams);
	<?= $szParent ?>.selected (this.nCurrentID);
};

<?= $szNameSpace ?>.cmdUpdate = function (thsForm)
{
	szParams =
		"nID=" + this.nCurrentID + "&" +
		"szNameSpace=" + this.szNameSpace + "&" +
		<?= $szParent ?>.getFormData (thsForm) ;

	<?= $szParent ?>.postPanel ("App/update.php", this.divTarget, szParams);
	<?= $szParent ?>.selected (this.nCurrentID);
};
