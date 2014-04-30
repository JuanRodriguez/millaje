<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Site_App Extends ENetArch_Panels_Ladder_Item
{
	private $szApp = "";
	
	private $aryFields = Array ("szName", "szDescription", "szApp");
	
	// ==============================================

	function getSession ()
	{
		parent::getSession ();

		if (isset ($_SESSION [$this->getPanelID()]['szApp']))
			$this->szApp = $_SESSION [$this->getPanelID()]['szApp'] ;
	}
	
	function setSession()
	{
		parent::setSession ();

		$_SESSION [$this->getPanelID()]['szApp'] = $this->szApp;
	}
	
	function getPOST ()
	{
		parent::getPOST ();
		
		if (isset ($_REQUEST [$this->getPanelID() . '_szApp']))
			$this->szApp = $_REQUEST [$this->getPanelID() . '_szApp'];

//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	function getGETs ()
	{
		parent::getGETs ();
		
		print ("getting .. " . $this->getPanelID() . '_szApp' . "<BR>");
		
		if (isset ($_GET [$this->getPanelID() . '_szApp']))
			$this->szApp = $_GET [$this->getPanelID() . '_szApp'];

		print ("szApp = " . $this->szApp . "<BR>");
	}
	
	// ================================================

	Function clearPanel () 
	{
		parent::clearPanel ();

		$this->szApp = "";
	}

	function setPanel (ENetArch_Site_App$thsObject) 
	{
		if ($thsObject == null) return;
		parent::setPanel ($thsObject);

		$this->szApp = $thsObject->Field ("szApp" );
	}

	function updateObject (ENetArch_Site_App $thsObject)
	{
		if ($thsObject == null) return;
		parent::updateObject ($thsObject);

		$thsObject->setField ("szApp", $this->szApp);
	}

	// ================================================
	
	Function drawHeader () {	}
	
	Function drawPanel ()
	{
?>
		<table ID="<?= $this->getPanelID() ?>">
		<tr>
			<th>Name: </th>
			<td><?= $this->szName ?></td>
		</tr>
		
		<tr>
			<th>Description: </th>
			<td><?= $this->szDescription ?></td>
		</tr>

		<tr>
			<th>App: </th>
			<td><?= $this->szApp ?></td>
		</tr>
	  </table>
<?
	}

	function drawPanel_Edit ()
	{
?>
		<table>
		<tr>
			<th>Name: </th>
			<td><input type="text" name="<?= $this->getPanelID() . '_szName' ?>" size="40" value="<?= $this->szName ?>" ></td>
		</tr>
		
		<tr>
			<th>Description: </th>
			<td><input type="text" name="<?= $this->getPanelID() . '_szDescription' ?>" size="40" value="<?= $this->szDescription ?>" ></td>
		</tr>

		<tr>
			<th>App: </th>
			<td><input type="text" name="<?= $this->getPanelID() . '_szApp' ?>" size="40" value="<?= $this->szApp ?>" ></td>
		</tr>		
	  </table>
<?
	}
}
?>

