<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 1;
	if (isset ($_REQUEST["nID"]))
		$nID = $_REQUEST["nID"];

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Get Folder

	$objFolder = gblLadder()->getItem ($nID);
	$nParentID = $objFolder->Parent();

	// ==========================================
	// Validations

	if ($nID == rootID()) $nParentID = rootID();

	// ==========================================
	// Where to go

	$szParams =
		"nID=" . $nParentID . "&" .
		"szNameSpace=" . $szNameSpace . "&";

	// ==========================================

	header ("Location:_view.php?" . $szParams );
}
?>