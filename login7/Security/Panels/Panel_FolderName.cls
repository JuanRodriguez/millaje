<?
Class ENetArch_Panel
{
	Private $objFolder = null;
	
	Function getSession () {}
	Function setSession () {}
	Function getPOST () {}
	Function getGETs () {}
	
	Function setPanel ($thsObject) { $this->objFolder = $thsObject; }
	Function updateObject ($thsObject) {}
	Function clearPanel () { $this->objFolder = null; }

	Function drawPanel () 
	{
?>
	<p ID="<?= $this->getPanelID() . "_ID" ?>"><?= $this->objFolder->ID() ?> - <span ID="<?= $this->getPanelID() . "_Name" ?>"><?= $objFolder->Name() ?></span></p>
	<p ID="<?= $this->getPanelID() . "_Description" ?>"><?= $This->objFolder->Description() ?></p>
<?	
	}
}
?>