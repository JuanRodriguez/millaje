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

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];

	// ==========================================
	// Validations

	if ($nID == 0) return;
	// if ($nFolderID == 0) return;
	// if ($nPos == 0) return;

	// ==========================================
	// Get Notes Folder

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

	$pnlPolicy = new ENetArch_Panels_Site_Policy();
	$pnlPolicy->setPanelName ($szNameSpace. ".Policy");
	$pnlPolicy->getPost ();
	$pnlPolicy->updateObject ($itmPolicy);

	$itmPolicy->Store();
}
?>