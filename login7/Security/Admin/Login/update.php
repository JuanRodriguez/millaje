<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

function dirPath() { return ("../../../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Security/Classes/Security_Login.cls");
Include_Once (dirPath() . "Marketing/Security/Classes/Security_User.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item2.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Login2.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST ['nID']))
		$nID = $_REQUEST ['nID'];

	$szNameSpace = "ENetArch_Panel_Common_Logins";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	if ($nID == 0) return;

	// ==========================================
	// Get Logins Folder

	$objLogin = gblLadder()->getItem ($nID);
	$itmLogin = New ENetArch_Security_Login();
	$itmLogin->setState ($objLogin);

	// ==========================================
	// Panels

	$pnlLogin = new ENetArch_Panels_Security_Login2();
	$pnlLogin->setPanelName ($szNameSpace . ".Login");
	$pnlLogin->getPOST();
	$pnlLogin->updateObject ($itmLogin);

	$itmLogin->Store();
}
?>