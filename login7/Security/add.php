<?
	function dirPath() { return ("../../"); }

	Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	Include_Once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
	Include_Once (dirPath() . "Marketing/Security/rootFolder.php");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Register.cls");
	Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{


	// =========================================

	$pnlRegister= new ENetArch_Panels_Security_Register ();
	$pnlRegister->setPanelName ("Security.Register");
	$pnlRegister->getPOST();

	// ========================================
	// Validations

	if ($pnlRegister->szPSW != $pnlRegister->szConfirm)
	{
		$_SESSION ['szError'] = "Passwords Don't Match";
		header ("Location: register.php");
		return;
	}

	// ========================================
	// Core Code

	$objRoot = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security();
	$objSecurity->setState($objRoot);

	if ($objSecurity->has_User ($pnlRegister->szUID))
	{
		$_SESSION["szUID"] = $pnlRegister->szUID;
		header ("Location:id_unavailable.php");
		return;
	}

	// ========================================
	// Core Code

	$objUser = $objSecurity->add_User
		($pnlRegister->szUID, "User", $pnlRegister->szPSW,
		$pnlRegister->szEmail);

	if ($objUser == null)
	{
		header ("Location:id_unavailable.php");
		return;
	}

	// =========================================

	header ("Location:home.php");
}

?>