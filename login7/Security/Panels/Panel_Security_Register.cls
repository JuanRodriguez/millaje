<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Security_Register Extends ENetArch_Panel
{
	public $szUID = "";
	public $szPSW = "";
	public $szConfirm = "";
	public $szEmail = "";
	
	private $aryFields = Array ("szUID", "szPSW", "szConfirm", "szEmail");
	
	// ==============================================

	function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szUID']))
			$this->szUID = $_SESSION [$this->getPanelID()]['szUID'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szPSW']))
			$this->szPSW = $_SESSION [$this->getPanelID()]['szPSW'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szConfirm']))
			$this->szConfirm = $_SESSION [$this->getPanelID()]['szConfirm'] ;
			
		if (isset ($_SESSION [$this->getPanelID()]['szEmail']))
			$this->szEmail = $_SESSION [$this->getPanelID()]['szEmail'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['szUID'] = $this->szUID;
		$_SESSION [$this->getPanelID()]['szPSW'] = $this->szPSW;
		$_SESSION [$this->getPanelID()]['szConfirm'] = $this->szConfirm;
		$_SESSION [$this->getPanelID()]['szEmail'] = $this->szEmail;
	}
	
	function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szUID']))
			$this->szUID = $_REQUEST [$this->getPanelID() . '_szUID'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szPSW']))
			$this->szPSW = $_REQUEST [$this->getPanelID() . '_szPSW'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szConfirm']))
			$this->szConfirm = $_REQUEST [$this->getPanelID() . '_szConfirm'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szEmail']))
			$this->szEmail = $_REQUEST [$this->getPanelID() . '_szEmail'];
		
//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	// ================================================

	Function clearPanel () 
	{
		$this->szUID = "";
		$this->szPSW = "";
		$this->szConfirm = "";
		$this->szEmail = "";
	}

	// ================================================
	
	Function drawHeader () {	}
	
	Function drawPanel ()
	{
?>
<table ID="<?= $this->getPanelID() ?>">
	<tr>
		<td ID="<?= $this->getPanelID() ?>_UID_Header">Login - UID:</td>
		<td><input  ID="<?= $this->getPanelID() ?>_UID" name="<?= $this->getPanelID() ?>_szUID" size="10" type="text"></td>
	</tr>
	<tr>
		<td  ID="<?= $this->getPanelID() ?>_PSW_Header">PSW:</td>
		<td><input ID="<?= $this->getPanelID() ?>_PSW" name="<?= $this->getPanelID() ?>_szPSW" size="10" type="text"></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Confirm_Header">Confirm:</td>
		<td><input  ID="<?= $this->getPanelID() ?>_Confirm" name="<?= $this->getPanelID() ?>_szConfirm" size="10" type="text"></td>
	</tr>
	<tr>
		<td  ID="<?= $this->getPanelID() ?>_Email_Header">Email:</td>
		<td><input ID="<?= $this->getPanelID() ?>_Email" name="<?= $this->getPanelID() ?>_szEmail" size="40" type="text"></td>
	</tr>
</table>
<?
	}

	function drawPanel_Edit ()	{	}
	
	// ================================================
	
}
?>

