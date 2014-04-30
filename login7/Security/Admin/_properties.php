<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../"); }

	include_once (dirPath() . "Marketing/Notes/Panel_Panel.cls");
	include_once (dirPath() . "Marketing/Notes/Panel_Ladder_Properties.cls");
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
	// Get Folder

	$objFolder = gblLadder()->getItem ($nID);

	$pnlProperties = new ENetArch_Panels_Ladder_Properties();

	$pnlProperties->setPanel ($objFolder);
	$pnlProperties->drawPanel();
}
?>