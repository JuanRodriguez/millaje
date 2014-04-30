<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Panel_TriView extends ENetArch_Panel
{
	Private $pnlMenu = "menu.php";
	Private $pnlLeft = "left.php";
	Private $pnlContent = "content.php";
	
	Private $objFolder = null;
	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.TriView"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function setPanel_Menu ($thsPanel)
	{	$this->pnlMenu = $thsPanel;	}
	
	Function setPanel_Left ($thsPanel)
	{	$this->pnlLeft = $thsPanel;	}

	Function setPanel_Content ($thsPanel)
	{	$this->pnlContent = $thsPanel;	}

	// =======================================

	Function getSession () 	{	}
	
	Function setSession () 	{	}
	
	Function getPOST () 	{	}
	
	Function getGETs () 	{	}
	
	// =======================================

	Function setPanel (ldrFolder $thsObject)
	{	$this->objFolder = $thsObject;	}
	
	Function updateObject ($thsObject) 	{}
	
	Function clearPanel () 
	{
		$this->objFolder = null;
		$this->pnlMenu = "menu.php";
		$this->pnlLeft = "left.php";
		$this->pnlContent = "content.php";
	}

	// =======================================

	Function drawPanel () 
	{
	$nID = $this->objFolder->ID();
?>
	<div ID="<?= $this->getPanelID() ?>_Menu"></div>
	<div ID="<?= $this->getPanelID() ?>_VSpacer"></div>
	<div ID="<?= $this->getPanelID() ?>_Wrapper">
		<div ID="<?= $this->getPanelID() ?>_Left"></div>
		<div ID="<?= $this->getPanelID() ?>_HSpacer"></div>
		<div ID="<?= $this->getPanelID() ?>_Content"></div>
	</div>

<script>

	function UpdateWidth()
	{
		var divLadder = $("<?= $this->getPanelID() ?>_Left");
		var divContent = $("<?= $this->getPanelID() ?>_Content");
		var divWrapper = $("<?= $this->getPanelID() ?>_Wrapper");
		var w1 = window.innerWidth;
		var w20 = divLadder.offsetWidth;
		var w21 = divContent.offsetWidth;
		var w22 = divLadder.style.paddingLeft *2;
		var w23 = divContent.style.paddingLeft *2;
		var w3 = w20 + w21 + w22 + w23 + 25;
		var w4 = Math.max (w1, w3);
		divWrapper.style.width = w4;
	}

	var divMenus = $("<?= $this->getPanelID() ?>_Menu");
	var domMenus = ENetArch.DOMMenus;

	var divLeft = $("<?= $this->getPanelID() ?>_Left");
	divLeft.onUpdate = UpdateWidth;	

	var divContent = $("<?= $this->getPanelID() ?>_Content");
	divContent.onUpdate = UpdateWidth;
	
	ENetArch.Security.nFolderID = <?= $nID ?>;

	ENetArch.Security.Menus.divTarget = divMenus;
	ENetArch.Security.Menus.szNameSpace = "<?= $this->getPanelName() ?>.Menu";
	ENetArch.Security.Menus.szFile = "<?= $this->pnlMenu ?>";
	
	ENetArch.Security.Left.divTarget = divLeft;
	ENetArch.Security.Left.szNameSpace = "<?= $this->getPanelName() ?>.Left";
	ENetArch.Security.Left.szFile = "<?= $this->pnlLeft ?>";

	ENetArch.Security.Content.divTarget = divContent;
	ENetArch.Security.Content.szNameSpace = "<?= $this->getPanelName() ?>.Content";
	ENetArch.Security.Content.szFile = "<?= $this->pnlContent ?>";

	ENetArch.Security.addSelected (ENetArch.Security.Left);
	ENetArch.Security.addSelected (ENetArch.Security.Content);

	ENetArch.Security.Menus.display(<?= $nID ?>); 
	ENetArch.Security.Left.display(<?= $nID ?>);
	ENetArch.Security.Content.display(<?= $nID ?>); 

</script>
<?
	}
}

?>