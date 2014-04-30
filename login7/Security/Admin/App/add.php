<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

function dirPath() { return ("../../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Site_App.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Site_Apps.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Site_App.cls");
	Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST ['nID']))
		$nID = $_REQUEST ['nID'];

	$nFolderID = 0;
	if (isset ($_REQUEST ['nFolderID']))
		$nFolderID = $_REQUEST ['nFolderID'];

	$nPos = 0;
	if (isset ($_REQUEST ['nPos']))
		$nPos = $_REQUEST ['nPos'];

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	if ($nID == 0) return;
	// if ($nFolderID == 0) return;
	// if ($nPos == 0) return;

	// ==========================================
	// Get Apps Folder

	$fldrTarget = gblLadder()->getItem ($nID);
	$fldrApps = New ENetArch_Site_Apps();
	$fldrApps->setState ($fldrTarget);

	// ==========================================
	// Create New Instance

	$itmApp = $fldrApps->Create_App("New App", "This is a New App");

	if ($itmApp == null) return;

	// ==========================================
	// View

	$pnlApp = new ENetArch_Panels_Site_App();
	$pnlApp->setPanelName ($szNameSpace. ".App");
	$pnlApp->getPost ();
	$pnlApp->updateObject ($itmApp);

	$itmApp->Store();
}
?>