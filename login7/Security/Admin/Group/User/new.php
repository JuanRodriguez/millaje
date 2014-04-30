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
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_List8.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Folder_DetailList2.cls");
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
	// get Folders

	$fldrRoot = rootFolder();
	$objFolder = gblLadder()->getItem ($nID);

	$objSecurity = new ENetArch_Security_Security();
	$objSecurity->setState ($fldrRoot);
	$objUsers = $objSecurity->get_Users();

	$objGroup = new ENetArch_Security_Group ();
	$objGroup->setState ($objFolder);

	$aryIgnoreIDs = $objGroup->get_UserIDs();

	// ==========================================
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($objFolder, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace .".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/plus.gif", "cmdAdd_Users");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->drawPanel();

	$pnlFolderDetails = new ENetArch_Panel_Folder_DetailList2();

	$pnlFolderDetails->picFolderOpen = pagePath() . "Images/Ladder/folder_open.gif";
	$pnlFolderDetails->picFolderClosed = pagePath() . "Images/Ladder/folder_closed.gif";
	$pnlFolderDetails->picItem = pagePath() . "Images/Ladder/file.gif";
	$pnlFolderDetails->picReference = pagePath() . "Images/Ladder/reference.gif";
	$pnlFolderDetails->picEmpty = pagePath() . "Images/Ladder/empty.gif";

	$pnlList = new ENetArch_Panels_Common_List8 ();
	$pnlList->setPanelName ($szNameSpace . ".FolderDetail");
	$pnlList->setRowPanel ($pnlFolderDetails);
	$pnlList->setFolder ($objUsers);
	$pnlList->setIgnoreIDs ($aryIgnoreIDs);
	$pnlList->nPerPage = -1;
	$pnlList->drawPanel();

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>Marketing/Security/Styles/FolderDetail.css.php?szNameSpace=<?= $pnlList->getPanelID() ?>");
@import url("<?= pagePath () ?>Marketing/Security/Styles/HButtonBar.css.php?szNameSpace=<?= $pnlButtons->getPanelID() ?>");
</style>
<?
	// ==========================================
	// Import CSS
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Group/User/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Group/User/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Group/User/trgrs_FolderDetail.js.php?szNameSpace=<?= $pnlList->getPanelName() ?>&"></script>
<?
}
?>