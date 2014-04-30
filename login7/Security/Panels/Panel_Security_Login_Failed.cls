<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Security_Login Extends ENetArch_Panel
{
	private $szUID = "";
	private $szPSW = "";
	
	private $aryFields = Array ("szUID", "szPSW");
	
	// ==============================================

	function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szUID']))
			$this->szUID = $_SESSION [$this->getPanelID()]['szUID'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szPSW']))
			$this->szPSW = $_SESSION [$this->getPanelID()]['szPSW'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['szUID'] = $this->szUID;
		$_SESSION [$this->getPanelID()]['szPSW'] = $this->szPSW;
	}
	
	function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szUID']))
			$this->szUID = $_REQUEST [$this->getPanelID() . '_szUID'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szPSW']))
			$this->szPSW = $_REQUEST [$this->getPanelID() . '_szPSW'];
		
//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	// ================================================

	Function clearPanel () 
	{
		$this->szUID = "";
		$this->szPSW = "";
	}

	// ================================================
	
	Function drawHeader () {	}
	
	Function drawPanel ()
	{
?>
<table ID="<?= $this->getPanelID() ?>">
	<tr>
		<td ID="<?= $this->getPanelID() ?>_UID_Header">Login - UID:</td>
		<td><input  ID="<?= $this->getPanelID() ?>_UID" name="szUID" size="10" class="Login" type="text"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td  ID="<?= $this->getPanelID() ?>_PSW_Header">PSW:</td>
		<td><input ID="<?= $this->getPanelID() ?>_PSW" name="<?= $this->getPanelID() ?>_szPSW" size="10" class="Login" type="password"></td>
		<td><input ID="<?= $this->getPanelID() ?>_Submit" name="<?= $this->getPanelID() ?>_Submit" value="Go" class="Login" type="submit"></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Register"><a href="javascript:<?= $this->getPanelName() ?>.cmdRegister();">Register</a></td>
		<td ID="<?= $this->getPanelID() ?>_SendPSW"><a href="javascript:<?= $this->getPanelName() ?>.cmdSendPsw();">Send PSW</a></td>
	</tr>
</table>
<?
	}

	function drawPanel_Edit ()	{	}
	
	// ================================================
	
}
?>

