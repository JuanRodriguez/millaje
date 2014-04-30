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
	Include_Once (dirPath() . "Marketing/Security/Classes/Site_Policy.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Site_Policies.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Site_Policy.cls");
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

	$szNameSpace = "ENetArch_Panel_Site_Policy";
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
	// $fldrPolicies = New ENetArch_Site_Policies();
	// $fldrPolicies->setState ($fldrTarget);

	// ==========================================
	// Get Item

	$objPolicy = gblLadder()->getItem ($nID);
	$itmPolicy = new ENetArch_Site_Policy ();
	$itmPolicy->setState ($objPolicy);

	// $clsSite_Policy = $itmPolicy->getClass();
	// $itmPolicy = $fldrNotes->Item ($nPos, Array (1=>$clsSite_Policy));
	if ($itmPolicy == null) return;

	// ==========================================
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($itmPolicy, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace . ".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/file_edit.gif", "cmdEdit");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/delete.gif", "cmdDelete");
	$pnlButtons->drawPanel();

	$pnlPolicy = new ENetArch_Panels_Site_Policy();
	$pnlPolicy->setPanelName ($szNameSpace. ".Policy");
	$pnlPolicy->setPanel ($itmPolicy);

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdUpdate(this); return false;\">\n");
	$pnlPolicy->drawHeader();
	$pnlPolicy->drawPanel_Edit();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>");

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>Marketing/Security/Styles/HButtonBar.css.php?szNameSpace=<?= $pnlButtons->getPanelID() ?>");
#<?= $pnlPolicy->getPanelID() ?> TR TH
	{ text-align: right; }
</style>
<?
	// ==========================================
	// Import JavaScript
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Policy/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Policy/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Policy/trgrs_FormData.js.php?szNameSpace=<?= $szNameSpace ?>&"></script>
<script><?= $szNameSpace ?>.nCurrentID = <?= $nID ?>;</script>
<?
}
?>