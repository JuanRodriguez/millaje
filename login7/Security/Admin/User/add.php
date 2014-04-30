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
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Security_Register.cls");
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

	$pnlRegister= new ENetArch_Panels_Security_Register ();
	$pnlRegister->setPanelName ($szNameSpace . ".Register");
	$pnlRegister->getPOST();

	// ========================================
	// Core Code

	$objRoot = rootfolder();
	$objSecurity = new ENetArch_Security_Security();
	$objSecurity->setState($objRoot);

	// ========================================
	// Core Code

	$objUser = $objSecurity->add_User
		($pnlRegister->szUID, "User", $pnlRegister->szPSW,
		$pnlRegister->szEmail);
}
?>