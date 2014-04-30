<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Panel_TriView extends ENetArch_Panel
{
	Private $pnlMenu = null;
	Private $pnlLeft = null;
	Private $pnlContent = null;
	
	Private $objFolder = null;
	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.TriView"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function setPanelName ($thsName)
	{ 	
		parent::setPanelName ($thsName);
		
		if ($this->pnlMenu != null) 
		$this->pnlMenu->setPanelName ($this->getPanelName() . ".Menu");

		if ($this->pnlLeft != null) 
		$this->pnlLeft->setPanelName ($this->getPanelName() . ".Left");

		if ($this->pnlContent != null) 
		$this->pnlContent->setPanelName ($this->getPanelName() . ".Content");
	}
	
	Function setPanel_Menu (ENetArch_Panel $thsPanel)
	{
		$this->pnlMenu = $thsPanel;
		
		if ($this->pnlMenu != null) 
		$this->pnlMenu->setPanelName ($this->getPanelName() . ".Menu");		
	}
	
	Function setPanel_Left (ENetArch_Panel $thsPanel)
	{
		$this->pnlLeft = $thsPanel;

		if ($this->pnlLeft != null) 
		$this->pnlLeft->setPanelName ($this->getPanelName() . ".Left");
	}

	Function setPanel_Content (ENetArch_Panel $thsPanel)
	{
			$this->pnlContent = $thsPanel;

			if ($this->pnlContent != null) 
			$this->pnlContent->setPanelName ($this->getPanelName() . ".Content");
	}

	// =======================================

	Function getSession () 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->getSession ();

		if ($this->pnlLeft != null) 
		$this->pnlLeft->getSession ();

		if ($this->pnlContent != null) 
		$this->pnlContent->getSession ();
	}
	
	Function setSession () 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->setSession ();

		if ($this->pnlLeft != null) 
		$this->pnlLeft->setSession ();

		if ($this->pnlContent != null) 
		$this->pnlContent->setSession ();
	}
	
	Function getPOST () 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->getPOST ();

		if ($this->pnlLeft != null) 
		$this->pnlLeft->getPOST ();

		if ($this->pnlContent != null) 
		$this->pnlContent->getPOST ();
	}
	
	Function getGETs () 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->getGETs ();

		if ($this->pnlLeft != null) 
		$this->pnlLeft->getGETs ();

		if ($this->pnlContent != null) 
		$this->pnlContent->getGETs ();
	}
	
	// =======================================

	Function setPanel ($thsObject) 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->setPanel ($thsObject);

		if ($this->pnlLeft != null) 
		$this->pnlLeft->setPanel ($thsObject);

		if ($this->pnlContent != null) 
		$this->pnlContent->setPanel ($thsObject);
	}
	
	Function updateObject ($thsObject) 
	{}
	
	Function clearPanel () 
	{
		if ($this->pnlMenu != null) 
		$this->pnlMenu->clearPanel ();

		if ($this->pnlLeft != null) 
		$this->pnlLeft->clearPanel ();

		if ($this->pnlContent != null) 
		$this->pnlContent->clearPanel ();
	}

	// =======================================

	Function drawPanel () 
	{
		print ("<div ID=\"" . $this->getPanelID() . "_Menu\">\n");
		if ($this->pnlMenu != null) 
			$this->pnlMenu->drawPanel ();
		print ("</div>\n");

		print ("<div ID=\"" . $this->getPanelID() . "_VSpacer\"></div>\n");
		
		print ("<div ID=\"" . $this->getPanelID() . "_Wrapper\">\n");

			print ("<div ID=\"" . $this->getPanelID() . "_Left\">\n");
			if ($this->pnlLeft != null) 
				$this->pnlLeft->drawPanel ();
			print ("</div>\n");

			print ("<div ID=\"" . $this->getPanelID() . "_HSpacer\"></div>\n");

			print ("<div ID=\"" . $this->getPanelID() . "_Content\">\n");
			if ($this->pnlContent != null) 
				$this->pnlContent->drawPanel ();
			print ("</div>\n");
		
		print ("</div>\n");
	}
}

?>