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
	$nID = 1;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$nClass = 1;
	if (isset ($_REQUEST["nClass"]))
		$nClass = $_REQUEST["nClass"];

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Get Classes

	$clsSite_Site = gblLadder()->getClass ("Site_Site")->ID();
	$clsSite_Apps = gblLadder()->getClass ("Site_Apps")->ID();
	$clsSite_App = gblLadder()->getClass ("Site_App")->ID();
	$clsSite_Help = gblLadder()->getClass ("Site_Help")->ID();
	$clsSite_Policies = gblLadder()->getClass ("Site_Policies")->ID();
	$clsSite_Policy = gblLadder()->getClass ("Site_Policy")->ID();
	$clsSecurity_Security = gblLadder()->getClass ("Security_Security")->ID();
	$clsSecurity_Groups = gblLadder()->getClass ("Security_Groups")->ID();
	$clsSecurity_Group = gblLadder()->getClass ("Security_Group")->ID();
	$clsSecurity_Users = gblLadder()->getClass ("Security_Users")->ID();
	$clsSecurity_User = gblLadder()->getClass ("Security_User")->ID();
	$clsSecurity_UserRef = gblLadder()->getClass ("Security_UserRef")->ID();
	$clsSecurity_Login= gblLadder()->getClass ("Security_Login")->ID();
	$clsCommon_Note = gblLadder()->getClass ("Common_Note")->ID();
	$clsCommon_Notes = gblLadder()->getClass ("Common_Notes")->ID();

	// ==========================================
	// Where to go

	$szParams =
		"nID=" . $nID . "&" .
		"nClass=" . $nClass . "&" .
		"szNameSpace=" . $szNameSpace . "&";

	$szURL = dirPath() . "Marketing/Security/Admin/";

	switch ($nClass)
	{
		case $clsSite_Site: $szURL .= "Site/new.php"; break;
		case $clsSite_Apps: $szURL .= "Apps/new.php"; break;
		case $clsSite_App: $szURL .= "App/new.php"; break;
		case $clsSite_Help: $szURL .= "Help/new.php"; break;
		case $clsSite_Policies: $szURL .= "Policies/new.php"; break;
		case $clsSite_Policy: $szURL .= "Policy/new.php"; break;
		case $clsSecurity_Security: $szURL .= "Security/new.php"; break;
		case $clsSecurity_Groups: $szURL .= "Groups/new.php"; break;
		case $clsSecurity_Group: $szURL .= "Group/new.php"; break;
		case $clsSecurity_UserRef: $szURL .= "UserRef/new.php"; break;
		case $clsSecurity_Users: $szURL .= "Users/new.php"; break;
		case $clsSecurity_User: $szURL .= "User/new.php"; break;
		case $clsSecurity_Login: $szURL .= "Login/new.php"; break;
		case $clsCommon_Notes: $szURL .= "Notes/new.php"; break;
		case $clsCommon_Note: $szURL .= "Note/new.php"; break;
	}

	// ==========================================
	// print ("ClassID = " . $objFolder->getClass() . "<BR>");
	// print ("clsCommon_Notes = " . $clsCommon_Notes . "<BR>");
	// print_r ($_GET); print ("<BR>");
	// print ("Location:" . $szURL . "?" . $szParams );
	// return;

	header ("Location:" . $szURL . "?" . $szParams );
	// header ("Location:" . dirPath() . "Marketing/Notes/helloworld.php");
}
?>