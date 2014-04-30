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
	Include_Once (dirPath() . "Marketing/Security/Classes/Security_Login.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Security_User.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_H_ButtonBar.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_PathList.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Login2.cls");
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

	$szNameSpace = "ENetArch_Panel_Security_Logins";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	// if ($nFolderID == 0) return;
	// if ($nPos == 0) return;

	// ==========================================
	// Get Logins Folder

	$fldrRoot = rootFolder();
	// $fldrUser = gblLadder()->getItem ($nFolderID);
	// $fldrLogins = New ENetArch_Security_User();
	// $fldrLogins->setState ($fldrTarget);

	// ==========================================
	// Get Item

	$objLogin = gblLadder()->getItem ($nID);
	$itmLogin = new ENetArch_Security_Login ();
	$itmLogin->setState ($objLogin);

	// $itmLogin = $fldrLogins->Item ($nPos, Array (1=>$clsSecurity_Login));
	if ($itmLogin == null) return;

	// ==========================================
	// View

	$pnlPath = new ENetArch_Panels_Ladder_PathList();
	$pnlPath->setPanelName ($szNameSpace . ".PathList");
	$pnlPath->setPanel ($itmLogin, $fldrRoot);
	$pnlPath->drawPanel();

	$pnlButtons = new ENetArch_Panels_H_ButtonBar();
	$pnlButtons->setPanelName ($szNameSpace .".HButtonBar");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/file_edit.gif", "cmdEdit");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/empty.gif", "");
	$pnlButtons->addButton (pagePath() .  "Images/Ladder/folder_up.gif", "cmdParentFolder");
	$pnlButtons->drawPanel();

	$pnlLogin = new ENetArch_Panels_Security_Login2();
	$pnlLogin->setPanelName ($szNameSpace . ".Login");
	$pnlLogin->setPanel ($itmLogin);

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdUpdate(this); return false;\">\n");
	$pnlLogin->drawHeader();
	$pnlLogin->drawPanel();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>\n");

	// ==========================================
	// Import CSS
?>
<style type="text/css">
@import url("<?= pagePath () ?>Marketing/Security/Styles/HButtonBar.css.php?szNameSpace=<?= $pnlButtons->getPanelID() ?>");
#<?= $pnlLogin->getPanelID() ?> TR TH
	{ text-align: right; }
</style>
<?
	// ==========================================
	// Import JavaScript
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Login/trgrs_PathList.js.php?szNameSpace=<?= $pnlPath->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Login/trgrs_HButtonBar.js.php?szNameSpace=<?= $pnlButtons->getPanelName() ?>&"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Login/trgrs_Login.js.php?szNameSpace=<?= $pnlLogin->getPanelName() ?>"></script>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Login/trgrs_FormData.js.php?szNameSpace=<?= $szNameSpace ?>&"></script>
<script><?= $szNameSpace ?>.nCurrentID = <?= $nID ?>;</script>
<?
}
?>