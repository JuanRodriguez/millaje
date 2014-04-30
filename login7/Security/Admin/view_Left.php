<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../"); }
	function pagePath() {return ("../../../"); }

	include_once (dirPath() . "Marketing/Notes/Panel_Panel.cls");
	include_once (dirPath() . "Marketing/Notes/Panel_TreeView.cls");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nFolderID = 1;
	if (isset ($_REQUEST["nFolderID"]))
		$nFolderID = $_REQUEST["nFolderID"];

	$nID = 1;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$bStatus = "";
	if (isset ($_REQUEST["bStatus"]))
		$bStatus = $_REQUEST["bStatus"];

	$szNameSpace = "ENetArch_Panel_TreeView";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// =======================================

	$objFolder = gblLadder()->getItem($nFolderID);

	// =======================================

	$pnlTreeView = new ENetArch_Panel_TreeView();
	$pnlTreeView->setPanelName ($szNameSpace);

	$pnlTreeView->picPlus = pagePath() . "Images/Ladder/plus.gif";
	$pnlTreeView->picMinus = pagePath() . "Images/Ladder/minus.gif";

	$pnlTreeView->picFolderOpen = pagePath() . "Images/Ladder/folder_open.gif";
	$pnlTreeView->picFolderClosed = pagePath() . "Images/Ladder/folder_closed.gif";
	$pnlTreeView->picItem = pagePath() . "Images/Ladder/file.gif";
	$pnlTreeView->picReference = pagePath() . "Images/Ladder/reference.gif";
	$pnlTreeView->picEmpty = pagePath() . "Images/Ladder/empty.gif";

	$pnlTreeView->setPanel ($objFolder);
	// $pnlTreeView->setFolders ($aryFolders);
	$pnlTreeView->updateTargetID ($nID, $bStatus);

	$pnlTreeView->drawPanel();
}
?>