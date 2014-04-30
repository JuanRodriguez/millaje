<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Common_Person Extends ENetArch_Panel_List
{
	public $szName = "";
	public $szDescription = "";
	
	public $pnlName = null;
	public $pnlAddress = null;
	public $pnlContacts = null;

	// ==============================================
	
	Function setPanelName ($thsName)
	{ 
		parent::setPanelName ($thsName);
		
		if ($this->pnlName != null)
			$this->pnlName->setPanelName ($thsName . ".Name");
		
		if ($this->pnlAddress != null)
			$this->pnlAddress->setPanelName ($thsName . ".Address");

		if ($this->pnlContacts != null)
			$this->pnlContacts->setPanelName ($thsName . ".Contacts");
	}
	
	// ==============================================

	Function setPanel_Name ($thsPanel)
	{
		$this->pnlName = $thsPanel;
		$this->pnlName->setPanelName ($this->getPanelName() . ".Name");
	}
	
	Function setPanel_Address ($thsPanel)
	{
		$this->pnlAddress = $thsPanel;
		$this->pnlAddress->setPanelName ($this->getPanelName() . ".Address");
	}
	
	Function setPanel_Contacts ($thsPanel)
	{
		$this->pnlContacts = $thsPanel;
		$this->pnlContacts->setPanelName ($this->getPanelName() . ".Contacts");
	}
	
	// ==============================================

	Function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szName']))
			$this->szName = $_SESSION [$this->getPanelID()]['szName'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szDescription']))
			$this->szDescription = $_SESSION [$this->getPanelID()]['szDescription'] ;


		$this->pnlName->getSession();
		$this->pnlAddress->getSession();
		$this->pnlContacts->getSession();
	}

	Function setSession ()
	{
		$_SESSION [$this->getPanelID()]['szName'] = $this->szName;
		$_SESSION [$this->getPanelID()]['szDescription'] = $this->szDescription;

		 $this->pnlName->setSession();
		 $this->pnlAddress->setSession();
		 $this->pnlContacts->setSession();
	}

	Function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szName']))
			$this->szName = $_REQUEST [$this->getPanelID() . '_szName'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szDescription']))
			$this->szDescription = $_REQUEST [$this->getPanelID() . '_szDescription'];

		$this->pnlName->getPOST();
		$this->pnlAddress->getPOST();
		$this->pnlContacts->getPOST();
	}

	// ==============================================
	
	Function setPanel ($thsObject) 
	{
		$clsCommon_Person = gblLadder()->getClass ("Common_Person")->ID();
		
		if ($thsObject == null) return;
		if ($thsObject->ClassID() != $clsCommon_Person) return;

		$this->szName = $thsObject->Name();
		$this->szDescription = $thsObject->Description();
		
		$itmName = $thsObject->get_Name();
		$itmAddress = $thsObject->get_Address();
		$fldrContacts = $thsObject->get_Contacts();

		$this->pnlName->setPanel ($itmName);
		$this->pnlAddress->setPanel ($itmAddress);
		$this->pnlContacts->setPanel ($fldrContacts);
	}

	Function updateObject ($thsObject) 
	{
		$thsObject->setName ($this->szName);
		$thsObject->setDescription ($this->szDescription);
	}
	
	Function clearPanel ()
	{
		$this->szName = "";
		$this->szDescription = "";

		$this->pnlName->clearPanel();
		$this->pnlAddress->clearPanel();
		$this->pnlContacts->clearPanel();	
	}
	
	// ==============================================

	Function drawHeader ()	{	}
	
	Function drawPanel ()
	{
?>
	<table id="<?= $this->getPanelName() ?>_Name">
		<tr>
			<th>Display As:</th>
			<td><?= $this->szName ?></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td><?= $this->szDescription ?></td>
		</tr>
	</table>
<?
		if ($this->pnlName == null) return;
		if ($this->pnlAddress == null) return;
		if ($this->pnlContacts == null) return;

		$this->pnlName->drawPanel ();
		$this->pnlAddress->drawPanel ();
		$this->pnlContacts->drawPanel ();
	}
	
	Function drawPanel_Edit ()
	{		
?>
	<table id="<?= $this->getPanelID() ?>_Name">
		<tr>
			<th>Display As:</th>
			<td><input type="text" name="<?= $this->getPanelID() ?>_szName" size="40" value="<?= $this->szName ?>"></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td><input type="text" name="<?= $this->getPanelID() ?>_szDescription" size="40" value="<?= $this->szDescription ?>"></td>
		</tr>
	</table>
<?
		if ($this->pnlName == null) return;
		if ($this->pnlAddress == null) return;
		if ($this->pnlContacts == null) return;
		
		$this->pnlName->drawPanel_Edit ();
		$this->pnlAddress->drawPanel_Edit ();
		$this->pnlContacts->drawPanel_Edit ();
	}
	
	// ================================================
	
		Function hasHeaders () { return (false); }
	
		Function hdrColCount() { return (0); }
		Function hdrRowCount() { return (0); }
		
		Function dataColCount() { return (0); }
		Function dataRowCount() { return (0); }

	// ================================================

	Function drawColumnHeader ($x)	{	}

	Function drawCell ($x,$y) {	}	
}
?>

