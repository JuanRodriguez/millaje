<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	function dirPath() {return ("../../"); }

	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_REQUEST["nIDs"]))
		$nID = $_REQUEST["nIDs"];

	$nIDs = Array();
	if (isset ($_REQUEST["nIDs"]))
		$nID = $_REQUEST["nIDs"];

	// ==========================================
	// Validations

	if ($nID == 0) return;

	// ==========================================
	// get Folder

	$objFolder = gblLadder()->getItem ($nID);
	if (! $objFolder->isFolder ()) return;

	// ==========================================
	// Copy Items

	$aryIDs = parseString ($szIDs, ",");

	for ($t=0; $t<count ($aryIDs); $t++)
	{
		$nID = $aryIDs [$t];
		if ($nID > 0)
		{
			objFolder()->Copy ($nID);
		}
	}
}
?>