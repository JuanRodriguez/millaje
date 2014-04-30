<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

class ENetArch_Panels_Site_Policy Extends ENetArch_Panels_Ladder_Item
{
	private $szPolicy = "";
	
	private $aryFields = Array ("szName", "szDescription", "szPolicy");
	
	// ==============================================

	function getSession ()
	{
		parent::getSession ();

		if (isset ($_SESSION [$this->getPanelID()]['szPolicy']))
			$this->szPolicy = $_SESSION [$this->getPanelID()]['szPolicy'] ;
	}
	
	function setSession()
	{
		parent::setSession ();

		$_SESSION [$this->getPanelID()]['szPolicy'] = $this->szPolicy;
	}
	
	function getPOST ()
	{
		parent::getPOST ();
		
		if (isset ($_REQUEST [$this->getPanelID() . '_szPolicy']))
			$this->szPolicy = $_REQUEST [$this->getPanelID() . '_szPolicy'];

//		for ($t=0; $t<count ($this->aryFields); $t++)
//		{ print ($this->getPanelID() . '_' . $this->aryFields[$t] . " = " . $_REQUEST [$this->getPanelID() . '_' . $this->aryFields[$t] ] . "<BR>"); }
	}
	
	function getGETs ()
	{
		parent::getGETs ();
		
		print ("getting .. " . $this->getPanelID() . '_szPolicy' . "<BR>");
		
		if (isset ($_GET [$this->getPanelID() . '_szPolicy']))
			$this->szPolicy = $_GET [$this->getPanelID() . '_szPolicy'];

		print ("szPolicy = " . $this->szPolicy . "<BR>");
	}
	
	// ================================================

	Function clearPanel () 
	{
		parent::clearPanel ();

		$this->szPolicy = "";
	}

	function setPanel (ENetArch_Site_Policy$thsObject) 
	{
		if ($thsObject == null) return;
		parent::setPanel ($thsObject);

		$this->szPolicy = $thsObject->Field ("szPolicy" );
	}

	function updateObject (ENetArch_Site_Policy $thsObject)
	{
		if ($thsObject == null) return;
		parent::updateObject ($thsObject);

		$thsObject->setField ("szPolicy", $this->szPolicy);
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
			<th>Policy: </th>
			<td><?= $this->szPolicy ?></td>
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
			<th>Policy: </th>
			<td><input type="text" name="<?= $this->getPanelID() . '_szPolicy' ?>" size="40" value="<?= $this->szPolicy ?>" ></td>
		</tr>		
	  </table>
<?
	}
}
?>

