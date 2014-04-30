<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Folder.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Common_Notes.cls");
	Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST ['nID']))
		$nID = $_REQUEST ['nID'];

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	if ($nID == 0) return;

	// ==========================================
	// Get Notes Folder

	$fldrTarget = rootFolder();

	// =======================================
	// Set Notes Folder

	$objSecurity = New ENetArch_Security_Security();
	$objSecurity->setState ($fldrTarget);

	// ==========================================
	// Create A New Folder

	$newGroup = $objSecurity->Create_Group ("New Group", "A New Group");

	// ==========================================
	// Get View Data

	$pnlFolder = new ENetArch_Panels_Ladder_Folder();
	$pnlFolder->setPanelName ($szNameSpace . ".Group");
	$pnlFolder->getPOST();
	$pnlFolder->updateObject ($newGroup);

	$newGroup->Store();

	// need to add logic to avoid having a new group added with the same
	// name as an existing group
}
?>