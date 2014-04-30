<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	include_once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	include_once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Folder.cls");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 1;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$szNameSpace = "ENetArch_Panel_Folder_DetailView";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// View

	$fldrRoot = rootFolder();
	$objFolder = gblLadder()->getItem ($nID);

	// ==========================================
	// Create New Instance

	$fldrPolicies = new ENetArch_Site_Policies ();
	$fldrPolicies->setState ($objFolder);

	// ==========================================
	// View

	$pnlFolder = new ENetArch_Panels_Ladder_Folder();
	$pnlFolder->setPanelName ($szNameSpace . ".FolderDetail");
	$pnlFolder->getPOST();
	$pnlFolder->updateObject($fldrPolicies);

	$fldrPolicies->Store();
}
?>