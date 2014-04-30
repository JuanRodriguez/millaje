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
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Ladder_Item.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Login.cls");
	Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	printVars();

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

	// =======================================
	// Classes

	$clsSecurity_Login = gblLadder()->getClass ("Security_Login")->ID();

	// ==========================================
	// Get Logins Folder

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

	$pnlLogin = new ENetArch_Panels_Security_Login();
	$pnlLogin->setPanelName ($szNameSpace);
	$pnlLogin->setPanel ($itmLogin);

	print ("<form ID=\"" . $szNameSpace . "_Form\" " .
		"onSubmit=\"" . $szNameSpace . ".cmdUpdate(this); return false;\">\n");
	$pnlLogin->drawHeader();
	$pnlLogin->drawPanel_Edit();
	print ("<input type=\"submit\" name=\"btnSubmit\" value=\"Submit\">\n");
	print ("</form>\n");
?>
<script src="<?= pagePath () ?>Marketing/Security/Admin/Login/trgrs_Login.js.php?szNameSpace=<?= $szNameSpace ?>"></script>
<?
}
?>