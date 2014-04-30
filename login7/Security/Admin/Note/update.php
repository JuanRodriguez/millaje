<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

function dirPath() { return ("../../../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Notes/Common_Note.cls");
Include_Once (dirPath() . "Marketing/Notes/Common_Notes.cls");
Include_Once (dirPath() . "Marketing/Notes/Panel_Panel.cls");
Include_Once (dirPath() . "Marketing/Notes/Panel_Ladder_Item.cls");
Include_Once (dirPath() . "Marketing/Notes/Panel_Common_Note.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST ['nID']))
		$nID = $_REQUEST ['nID'];

	$szNameSpace = "ENetArch_Panel_Common_Notes";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	if ($nID == 0) return;

	// ==========================================
	// Get Notes Folder

	$objNote = gblLadder()->getItem ($nID);

	// =======================================
	// Set Notes Folder

	$itmNote = New ENetArch_Common_Note();
	$itmNote->setState ($objNote);

	// ==========================================
	// Panels

	$pnlNote = new ENetArch_Panels_Common_Note();
	$pnlNote->setPanelName ($szNameSpace. ".Note");
	$pnlNote->getPOST();
	$pnlNote->updateObject ($itmNote);

	$itmNote->Store();
}
?>