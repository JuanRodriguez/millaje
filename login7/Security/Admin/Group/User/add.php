<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	include_once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	include_once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 1;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$szIDs = "";
	if (isset ($_REQUEST["szIDs"]))
		$szIDs = $_REQUEST["szIDs"];

	$szNameSpace = "ENetArch_Panel_Folder_DetailView";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// get Folders

	$fldrRoot = rootFolder();
	$objFolder = gblLadder()->getItem ($nID);

	$objGroup = new ENetArch_Security_Group ();
	$objGroup->setState ($objFolder);

	// ==========================================
	// View

	$aryIDs = parseString ($szIDs, ",");

	for ($t=0; $t<count ($aryIDs); $t++)
	{
		$nID = $aryIDs [$t];
		if ($nID > 0)
		{
			$fldrUser = gblLadder()->getItem ($nID);
			$objUser = new ENetArch_Security_User ();
			$objUser->setState ($fldrUser);

			$objGroup->add_User ($objUser);
		}
	}
}

?>