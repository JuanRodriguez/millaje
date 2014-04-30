<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Security_ResetPsw Extends ENetArch_Panel
{
	private $szOldPSW = "";
	private $szPSW = "";
	private $szConfirm = "";
	
	private $aryFields = Array ("szOldPSW", "szPSW", "szConfirm", "szEmail");
	
	// ==============================================

	function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szOldPSW']))
			$this->szOldPSW = $_SESSION [$this->getPanelID()]['szOldPSW'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szPSW']))
			$this->szPSW = $_SESSION [$this->getPanelID()]['szPSW'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szConfirm']))
			$this->szConfirm = $_SESSION [$this->getPanelID()]['szConfirm'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['szOldPSW'] = $this->szOldPSW;
		$_SESSION [$this->getPanelID()]['szPSW'] = $this->szPSW;
		$_SESSION [$this->getPanelID()]['szConfirm'] = $this->szConfirm;
	}
	
	function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szOldPSW']))
			$this->szOldPSW = $_REQUEST [$this->getPanelID() . '_szOldPSW'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szPSW']))
			$this->szPSW = $_REQUEST [$this->getPanelID() . '_szPSW'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szConfirm']))
			$this->szConfirm = $_REQUEST [$this->getPanelID() . '_szConfirm'];
		
//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	// ================================================

	Function clearPanel () 
	{
		$this->szOldPSW = "";
		$this->szPSW = "";
		$this->szConfirm = "";
	}

	// ================================================
	
	Function drawHeader () {	}
	
	Function drawPanel ()
	{
?>
<table ID="<?= $this->getPanelID() ?>">
	<tr>
		<td ID="<?= $this->getPanelID() ?>_OldPSW_Header">Old PSW:</td>
		<td><input  ID="<?= $this->getPanelID() ?>_OldPSW" name="<?= $this->getPanelID() ?>_szOldPSW" size="10" type="text"></td>
	</tr>
	<tr>
		<td  ID="<?= $this->getPanelID() ?>_PSW_Header">PSW:</td>
		<td><input ID="<?= $this->getPanelID() ?>_PSW" name="<?= $this->getPanelID() ?>_szPSW" size="10" type="text"></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Confirm_Header">Confirm:</td>
		<td><input  ID="<?= $this->getPanelID() ?>_Confirm" name="<?= $this->getPanelID() ?>_szConfirm" size="10" type="text"></td>
	</tr>
</table>
<?
	}

	function drawPanel_Edit ()	{	}
	
	// ================================================
	
}
?>

