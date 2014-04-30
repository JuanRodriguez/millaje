<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
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
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($objFolder, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace .".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->drawPanel();

	$pnlRegister= new ENetArch_Panels_Security_Register ();
	$pnlRegister->setPanelName ($szNameSpace . ".Register");

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdAdd(this); return false;\">\n");
	$pnlRegister->drawPanel ();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>");

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>Marketing/Security/Styles/HButtonBar.css.php?szNameSpace=<?= $pnlButtons->getPanelID() ?>");
</style>
<?
	// ==========================================
	// Import CSS
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/User/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/User/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/User/trgrs_FormData.js.php?szNameSpace=<?= $szNameSpace ?>&"></script>
<?
}
?>