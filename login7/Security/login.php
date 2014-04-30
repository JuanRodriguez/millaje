<?
	$szURLPath = "";

function dirPath() { return ("../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
Include_Once (dirPath() . "Marketing/Security/rootFolder.php");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Login.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{


	// =========================================

	$pnlLogin = new ENetArch_Panels_Security_Login ();
	$pnlLogin->setPanelName ("Security.Login");
	$pnlLogin->getPOST();

	// ========================================
	// Core Code

	$objRoot = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security();
	$objSecurity->setState($objRoot);

	// ========================================
	// Core Code

	$objUser = $objSecurity->Login ($pnlLogin->szUID, $pnlLogin->szPSW);
	if ($objUser == null)
	{
		print ("login failed<BR>");
		header ("Location:login_failed.php");
		return;
	}

	// =========================================

	header ("Location:home.php");
}

?>