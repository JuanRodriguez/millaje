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
	Include_Once (dirPath() . "Marketing/Notes/Common_Note.cls");
	Include_Once (dirPath() . "Marketing/Notes/Common_Notes.cls");
	Include_Once (dirPath() . "Marketing/Notes/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
	Include_Once (dirPath() . "Marketing/Notes/Panel_Ladder_Item.cls");
	Include_Once (dirPath() . "Marketing/Notes/Panel_Common_Note.cls");
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

	$szNameSpace = "ENetArch_Panel_Common_Notes";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	// if ($nFolderID == 0) return;
	// if ($nPos == 0) return;

	// ==========================================
	// Get Notes Folder

	$fldrRoot = rootFolder();
	$fldrTarget = gblLadder()->getItem ($nFolderID);

	// =======================================
	// Set Notes Folder

	$fldrNotes = New ENetArch_Common_Notes();
	// $fldrNotes->setState ($fldrTarget);

	// ==========================================
	// Get Item

	$itmNote = new ENetArch_Common_Note ();

	$objNote = gblLadder()->getItem ($nID);
	$itmNote->setState ($objNote);

	// $itmNote = $fldrNotes->Item ($nPos, Array (1=>$clsCommon_Note));
	if ($itmNote == null) return;

	// ==========================================
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($itmNote, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace .".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/file_edit.gif", "cmdEdit");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/delete.gif", "cmdDelete");
	$pnlButtons->drawPanel();

	$pnlNote = new ENetArch_Panels_Common_Note();
	$pnlNote->setPanelName ($szNameSpace. ".Note");
	$pnlNote->setPanel ($itmNote);

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdUpdate(this); return false;\">\n");
	$pnlNote->drawPanel_Edit();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>\n");

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>Marketing/Security/Styles/HButtonBar.css.php?szNameSpace=<?= $pnlButtons->getPanelID() ?>");
#<?= $pnlNote->getPanelID() ?> TR TH
	{ text-align: right; }
</style>
<?
	// ==========================================
	// Import JavaScript
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Note/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Note/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Note/trgrs_FormData.js.php?szNameSpace=<?= $szNameSpace ?>&"></script>
<script><?= $szNameSpace ?>.nCurrentID = <?= $nID ?>;</script>
<?
}
?>