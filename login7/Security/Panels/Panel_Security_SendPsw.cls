<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Security_SendPsw Extends ENetArch_Panel
{
	private $szUID = "";
	
	private $aryFields = Array ("szUID");
	
	// ==============================================

	function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szUID']))
			$this->szUID = $_SESSION [$this->getPanelID()]['szUID'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['szUID'] = $this->szUID;
	}
	
	function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szUID']))
			$this->szUID = $_REQUEST [$this->getPanelID() . '_szUID'];

//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	// ================================================

	Function clearPanel () 
	{
		$this->szUID = "";
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
	</tr>
</table>
<?
	}

	function drawPanel_Edit ()	{	}
	
	// ================================================
	
}
?>

