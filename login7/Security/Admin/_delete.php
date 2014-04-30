<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../"); }

	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$szIDs = "";
	if (isset ($_REQUEST["szIDs"]))
		$szIDs = $_REQUEST["szIDs"];

	$szNameSpace = "ENetArch_Panel_Folder_DetailView";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations


	// ==========================================
	// Delete Item

	if ($nID <> 0)
	{
		$objItem = gblLadder()->getItem ($nID);
		$nParent = $objItem->Parent();
		$objItem->Delete();

		$szParams =
			"nID=" . $nParent . "&" .
			"szNameSpace=" . $szNameSpace . "&";

		header ("Location:_view.php?" . $szParams);
		return;
	}

	// ==========================================
	// Delete Items

	$aryIDs = parseString ($szIDs, ",");

	for ($t=0; $t<count ($aryIDs); $t++)
	{
		$nID = $aryIDs [$t];
		if ($nID > 0)
		{
			$objItem = gblLadder()->getItem ($nID);
			$objItem->Delete();
		}
	}
}
?>