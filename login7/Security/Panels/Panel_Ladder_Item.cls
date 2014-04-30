<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

class ENetArch_Panels_Ladder_Item Extends ENetArch_Panel
{
	public $szName = "";
	public $szDescription = "";
	
	// ==============================================

	Function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['szName']))
			$this->szName = $_SESSION [$this->getPanelID()]['szName'] ;

		if (isset ($_SESSION [$this->getPanelID()]['szDescription']))
			$this->szDescription = $_SESSION [$this->getPanelID()]['szDescription'] ;
	}

	Function setSession ()
	{
		$_SESSION [$this->getPanelID()]['szName'] = $this->szName;
		$_SESSION [$this->getPanelID()]['szDescription'] = $this->szDescription;
	}

	Function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_szName']))
			$this->szName = $_REQUEST [$this->getPanelID() . '_szName'];

		if (isset ($_REQUEST [$this->getPanelID() . '_szDescription']))
			$this->szDescription = $_REQUEST [$this->getPanelID() . '_szDescription'];
	}

	Function getGETs ()
	{
		if (isset ($_GET [$this->getPanelID() . '_szName']))
			$this->szName = $_GET [$this->getPanelID() . '_szName'];

		if (isset ($_GET [$this->getPanelID() . '_szDescription']))
			$this->szDescription = $_GET [$this->getPanelID() . '_szDescription'];
	}

	// ==============================================
	
	Function setPanel ($thsObject) 
	{
		if ($thsObject == null) return;

		$this->szName = $thsObject->Name();
		$this->szDescription = $thsObject->Description();
	}

	Function updateObject ($thsObject) 
	{
		if ($thsObject == null) return;

		$thsObject->setName ($this->szName);
		$thsObject->setDescription ($this->szDescription);
	}
	
	Function clearPanel ()
	{
		$this->szName = "";
		$this->szDescription = "";
	}
	
	// ==============================================

	Function drawHeader ()	{	}
	
	Function drawPanel ()
	{
?>
	<table id="<?= $this->getPanelName() ?>_Name">
		<tr>
			<th>Name:</th>
			<td><?= $this->szName ?></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td><?= $this->szDescription ?></td>
		</tr>
	</table>
<?
	}
	
	Function drawPanel_Edit ()
	{		
?>
	<table id="<?= $this->getPanelID() ?>_Name">
		<tr>
			<th>Name:</th>
			<td><input type="text" name="<?= $this->getPanelID() ?>_szName" size="40" value="<?= $this->szName ?>"></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td><input type="text" name="<?= $this->getPanelID() ?>_szDescription" size="40" value="<?= $this->szDescription ?>"></td>
		</tr>
	</table>
<?
	}	
}
?>