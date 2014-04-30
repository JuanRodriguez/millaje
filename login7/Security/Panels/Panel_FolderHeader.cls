Class ENetArch_Panel
{
	Private $szPanelName = "";
	Private $pnlListClasses = null;
	
	// =======================================
	
	Function set pnlListClasses ($thsPanel)
	{ 
		$this->pnlListClasses = $thsPanel
		$this->pnlListClasses->setPanelName ($this->szPanelName . ".ListClasses");
	}
	
	// =======================================
	
	Function setPanelName ($thsName)
	{ 	
		$this->szPanelName = $thsName; 
		
		if ($this->pnlListClasses != null)
		$this->pnlListClasses->setPanelName ($this->szPanelName . ".ListClasses");
	}
	
	// =======================================
	
	Function getSession () {}
	Function setSession () {}
	Function getPOST () {}
	Function getGETs () {}
	
	// =======================================
	
	Function setPanel ($thsObject) 
	{
		$this->objFolder = thsObject;
		if ($this->objFolder->isItem()) return;
	}

	Function updateObject ($thsObject) {}
	Function clearPanel () { $this->objFolder = null; }

	// =======================================
	
	Function drawPanel () 
	{
		$nID = $objFolder->ID();
		$nParent = $objFolder->Parent();	

?>
	<p ID="<?= $this->getPanelID() ?>">
	<?	if ($nParent != 0) { ?>
		<a href="view.php?nID=<?= $nParent ?>&">Parent</a> |
	<? } ?>
		New - <?= $this->pnlListClasses->drawPanel () ?>
		 |
		<a href="edit.php?nID=<?= $nID ?>&">Edit</a> |
		<a href="delete.php?nID=<?= $nID ?>&">Delete</a> |
	</p>
<?
	}
}
