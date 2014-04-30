<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../"); }

	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{

	$szNameSpace = "ENetArch_Panel_Menu";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Get Classes

	$clsSite_Apps = gblLadder()->getClass ("Site_Apps")->ID();
	$clsSite_App = gblLadder()->getClass ("Site_App")->ID();
	$clsSite_Help = gblLadder()->getClass ("Site_Help")->ID();
	$clsSite_Policies = gblLadder()->getClass ("Site_Policies")->ID();
	$clsSite_Policy = gblLadder()->getClass ("Site_Policy")->ID();
	$clsSecurity_Groups = gblLadder()->getClass ("Security_Groups")->ID();
	$clsSecurity_Group = gblLadder()->getClass ("Security_Group")->ID();
	$clsSecurity_Users = gblLadder()->getClass ("Security_Users")->ID();
	$clsSecurity_User = gblLadder()->getClass ("Security_User")->ID();
	$clsCommon_Note = gblLadder()->getClass ("Common_Note")->ID();
	$clsCommon_Notes = gblLadder()->getClass ("Common_Notes")->ID();

	// ==========================================
?>
<script>

	// =================================

	var appMenus = new ENetArch.Menu();
	appMenus.menuDirection = "H";

	var mnuNotes = appMenus.add ("Security", "");
	var mnuNew = mnuNotes.add ("New", "");
	mnuNew.add ("User", "javascript:ENetArch.Security.cmdNew(<?= $clsSecurity_User ?>);");
	mnuNew.add ("Group", "javascript:ENetArch.Security.cmdNew(<?= $clsSecurity_Group ?>);");
	mnuNew.add ("Site App", "javascript:ENetArch.Security.cmdNew(<?= $clsSite_App ?>);");
	mnuNew.add ("Site Policy", "javascript:ENetArch.Security.cmdNew(<?= $clsSite_Policy ?>);");
	mnuNew.add ("Site Policy Folder", "javascript:ENetArch.Security.cmdNew(<?= $clsCommon_Note ?>);");
	mnuNew.add ("Help Note", "javascript:ENetArch.Security.cmdNew(<?= $clsCommon_Note ?>);");
	mnuNew.add ("Help Note Folder", "javascript:ENetArch.Security.cmdNew(<?= $clsCommon_Note ?>);");

	var mnuEdit = appMenus.add ("Edit", "");
	mnuEdit.add ("View", "javascript:ENetArch.Security.cmdView();");
	mnuEdit.add ("Edit", "javascript:ENetArch.Security.cmdEdit();");
	mnuEdit.add ("Delete", "javascript:ENetArch.Security.cmdDelete();");

	mnuEdit.add ("<hr>", "");

	mnuEdit.add ("Cut", "javascript:ENetArch.Security.cmdCut();");
	mnuEdit.add ("Copy", "javascript:ENetArch.Security.cmdCopy();");
	mnuEdit.add ("Paste", "javascript:ENetArch.Security.cmdPaste();");

	mnuEdit.add ("<hr>", "");

	mnuEdit.add ("Select All", "javascript:ENetArch.Security.cmdSelectAll();");
	mnuEdit.add ("Invert Selection", "javascript:ENetArch.Security.cmdInvertSelection();");

	mnuEdit.add ("<hr>", "");

	mnuEdit.add ("Properties", "javascript:ENetArch.Security.cmdProperties();");

	var mnuView = appMenus.add ("View", "");
	mnuView.add ("Details", "javascript:ENetArch.Security.cmdView_Details();");
	mnuView.add ("List", "javascript:ENetArch.Security.cmdView_List();");
	mnuView.add ("Thumb nails", "javascript:ENetArch.Security.cmdView_List();");

	domMenus._init (divMenus, appMenus);
	domMenus.show();

	// =================================

</script>
<?
}
?>