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
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
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

	$szNameSpace = "ENetArch_Panel_Site_App";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	// if ($nFolderID == 0) return;
	// if ($nPos == 0) return;

	// ==========================================
	// Get Site Root Folder Folder

	$fldrRoot = rootFolder();
	// $fldrTarget = gblLadder()->getItem ($nFolderID);
	// $fldrApps = New ENetArch_Site_Apps();
	// $fldrApps->setState ($fldrTarget);

	// ==========================================
	// Get Item

	$objApp = gblLadder()->getItem ($nID);
	$itmApp = new ENetArch_Site_App ();
	$itmApp->setState ($objApp);

	// $clsSite_App = $itmApp->getClass();
	// $itmApp = $fldrNotes->Item ($nPos, Array (1=>$clsSite_App));
	if ($itmApp == null) return;

	// ==========================================
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($itmApp, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace . ".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/file_edit.gif", "cmdEdit");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->drawPanel();

	$pnlApp = new ENetArch_Panels_Site_App();
	$pnlApp->setPanelName ($szNameSpace. ".App");
	$pnlApp->setPanel ($itmApp);

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdAdd(this); return false;\">\n");
	$pnlApp->drawHeader();
	$pnlApp->drawPanel_Edit();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>");

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>shared/styles.css");
#<?= $pnlButtons->getPanelID() ?>
	{ border-top: black 1px solid; border-bottom: black 1px solid; width:100%; }
#<?= $pnlApp->getPanelID() ?> TR TH
	{ text-align: right; }
</style>
<script><?= $szNameSpace ?>.nCurrentID = <?= $nID ?>;</script>
<?
	// ==========================================
	// Import JavaScript
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/App/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/App/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/App/trgrs_FormData.js.php?szNameSpace=<?= $szNameSpace ?>&"></script>
<script><?= $szNameSpace ?>.nCurrentID = <?= $nID ?>;</script>
<?
}
?>