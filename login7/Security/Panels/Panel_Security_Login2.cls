<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

/*	=======================================
	Data Structure
		dLogin DateTime
		szPassword varChar(40)
		bActive Bit
		dInActive Bit
		szEmail varChar(250) 

	HTML Form Names
		<input name="<?= $this->getPanelID() ?>_szPSW" type="text">
		<input name="<?= $this->getPanelID() ?>_szEmail" type="text">
		<input name="<?= $this->getPanelID() ?>_Active" value="1" <?= $szChecked ?> onClick="<?= $this->getPanelName() ?>.ckboxChanged(this)">

	JavaScript Triggers
		.ckboxChanged(this)
		.cmdActivate()
		.cmdDeActivate()
		
	CSS IDs
		TABLE ID="<?= $this->getPanelID() ?>"
		TD  ID="<?= $this->getPanelID() ?>_PSW_Header"
		TD  ID="<?= $this->getPanelID() ?>_PSW"
		INPUT ID="<?= $this->getPanelID() ?>_PSW"
		TD ID="<?= $this->getPanelID() ?>_Email_Header"
		TD ID="<?= $this->getPanelID() ?>_Email"
		INPUT  ID="<?= $this->getPanelID() ?>_Email"
		TD ID="<?= $this->getPanelID() ?>_Created_Header"
		TD ID="<?= $this->getPanelID() ?>_Created"
		TD ID="<?= $this->getPanelID() ?>_LastLogin_Header"
		TD ID="<?= $this->getPanelID() ?>_LastLogin"
		TD ID="<?= $this->getPanelID() ?>_Active_CKBOX"
		INPUT ID="<?= $this->getPanelID() ?>_Active" 
		TD ID="<?= $this->getPanelID() ?>_Active"

	======================================= */



class ENetArch_Panels_Security_Login2 Extends ENetArch_Panel
{
	public $dLogin = "";
	public $szPSW = "";
	public $szEmail = "";
	public $bActive ="0";
	public $dInActive ="";
	private $dCreated = "";
	
	private $aryFields = Array ("dLogin", "szPSW", "szEmail", "bActive", "dInActive", "dCreated");
	
	// ==============================================

	function getSession ()
	{

		if (isset ($_SESSION [$this->getPanelID()]['szPSW']))
			$this->szPSW = $_SESSION [$this->getPanelID()]['szPSW'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szEmail']))
			$this->szEmail = $_SESSION [$this->getPanelID()]['szEmail'] ;

		if (isset ($_SESSION [$this->getPanelID()]['bActive']))
			$this->bActive = $_SESSION [$this->getPanelID()]['bActive'] ;

		if (isset ($_SESSION [$this->getPanelID()]['dInActive']))
			$this->dInActive = $_SESSION [$this->getPanelID()]['dInActive'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['szPSW'] = $this->szPSW;
		$_SESSION [$this->getPanelID()]['szEmail'] = $this->szEmail;
		$_SESSION [$this->getPanelID()]['bActive'] = $this->bActive;
		$_SESSION [$this->getPanelID()]['dInActive'] = $this->dInActive;
	}
	
	function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szPSW']))
			$this->szPSW = $_REQUEST [$this->getPanelID() . '_szPSW'];
		
		if (isset ($_REQUEST [$this->getPanelID() . '_szEmail']))
			$this->szEmail = $_REQUEST [$this->getPanelID() . '_szEmail'];

		if (isset ($_REQUEST [$this->getPanelID() . '_bActive']))
			$this->bActive = $_REQUEST [$this->getPanelID() . '_bActive'];

//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	// ================================================

	Function clearPanel () 
	{
		$this->dLogin = "";
		$this->szPSW = "";
		$this->szEmail = "";
		$this->bActive ="0";
		$this->dInActive ="";
		$this->dCreated = "";
	}

	// ================================================

	function setPanel (ENetArch_Security_Login $thsObject) 
	{
		if ($thsObject == null) return;

		$this->dLogin = $thsObject->Field ("dLogin" );
		$this->szPSW = $thsObject->Field ("szPassword" );
		$this->szEmail = $thsObject->Field ("szEmail" );
		$this->bActive = $thsObject->Field ("bActive" );
		$this->dInActive = $thsObject->Field ("dInActive" );
		$this->dCreated = $thsObject->Created();
	}

	function updateObject (ENetArch_Security_Login $thsObject)
	{
		if ($thsObject == null) return;

		$thsObject->setField ("szPassword", $this->szPSW);
		$thsObject->setField ("szEmail", $this->szEmail);
		
		if ($this->bActive == 1)
		{ $thsObject->setActive(); }
		else
		{ $thsObject->setInActive(); }
	}

	// ================================================
	
	Function drawHeader () {	}
	
	Function drawPanel ()
	{
		$szChecked = iif (($this->bActive),"CHECKED", "");
?>
<table ID="<?= $this->getPanelID() ?>">
	<tr>
		<td ID="<?= $this->getPanelID() ?>_PSW_Header">PSW:</td>
		<td ID="<?= $this->getPanelID() ?>_PSW"><input ID="<?= $this->getPanelID() ?>_PSW" name="<?= $this->getPanelID() ?>_szPSW" size="10" type="password" value="<?= $this->szPSW ?>"></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Email_Header">Email:</td>
		<td ID="<?= $this->getPanelID() ?>_Email"><input  ID="<?= $this->getPanelID() ?>_Email" name="<?= $this->getPanelID() ?>_szEmail" size="40" type="text" value="<?= $this->szEmail ?>"></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Created_Header">Created:</td>
		<td ID="<?= $this->getPanelID() ?>_Created"><?= $this->dCreated ?></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_LastLogin_Header">Last Login:</td>
		<td ID="<?= $this->getPanelID() ?>_LastLogin"><?= $this->dLogin ?></td>
	</tr>
	<tr>
		<td ID="<?= $this->getPanelID() ?>_Active_CKBOX">
			<input type="checkbox" ID="<?= $this->getPanelID() ?>_bActive" name="<?= $this->getPanelID() ?>_bActive" value="1" <?= $szChecked ?> onClick="<?= $this->getPanelName() ?>.ckboxChanged(this)">
		</td>
		<td ID="<?= $this->getPanelID() ?>_Active">
<? if (! $this->bActive ) { ?>
InActive since: <?= $this->dInActive ?> <a href="javascript:void(0);" onClick="<?= $this->getPanelName() ?>.cmdActivate()">Activate</a>
<? } else { ?>
<a href="javascript:void(0);" onClick="javascript:<?= $this->getPanelName() ?>.cmdDeActivate()">DeActivate</a>
<? } ?>			
		</td>
	</tr>
</table>
<?
	}

	// ================================================
	
}
?>

