<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Site_Apps.cls");
include_once ("Site_Help.cls");
include_once ("Site_Policies.cls");

Class ENetArch_Site_Site extends ldrFolder
{
	private $objApps = null;
	private $objHelp = null;
	private $objPolicies = null;	

	Function __construct () 	{ }
	Function ENetArch_Site_Policy () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Site_Policy")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}
	
	// ====================================
	
	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0)
	{
		if ($thsParent == null) return;
		if ($thsClass == 0) $thsClass = $this->getClass();
		
		$newFolder = $thsParent->Create_Folder ($thsName, $thsDescription, $thsClass);
		$this->setState ($newFolder);
	}
	
	Function Init_Folder ()
	{	
		$this->Create_Apps ("Apps", "URL's to applications stored here");
		$this->Create_Help ("Help", "Site level documentation stored here");
		$this->Create_Policies ("Policies", "Site level policies stored here");
		
		$this->objApps->store();
		$this->objHelp->store();
		$this->objPolicies->store();
	}
	
	// ====================================

	Function Create_Apps ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objApps = new ENetArch_Site_Apps ();
		$this->objApps->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objApps);
	}
	
	Function get_Apps() 
	{
		if ($this->objApps != null) return ($this->objName);
		
		$this->objApps = new ENetArch_Site_Apps();

		$clsSite_Apps = $this->objApps->getClass();
		$aryClasses = Array (1=>$clsSite_Apps);
		$fldrApps = $this->Item (1, $aryClasses);

		$this->objApps->setState ($fldrApps);

		return ($this->objApps);
	}
	
	// ====================================

	Function Create_Help ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objHelp = new ENetArch_Site_Help ();
		$this->objHelp->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objHelp);
	}
	
	Function get_Help() 
	{
		if ($this->objHelp != null) return ($this->objHelp);
		
		$this->objHelp = new ENetArch_Site_Help();

		$clsSite_Help = $this->objHelp->getClass();
		$aryClasses = Array (1=>$clsSite_Help);
		$fldrHelp = $this->Item (1, $aryClasses);

		$this->objHelp->setState ($fldrHelp);

		return ($this->objHelp);
	}
	
	// ====================================

	Function Create_Policies ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objPolicies = new ENetArch_Site_Policies();
		$this->objPolicies->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objPolicies);
	}
	
	Function get_Policies() 
	{
		if ($this->objPolicies != null) return ($this->objContacts);
		
		$this->objPolicies = new ENetArch_Site_Policies();

		$clsSite_Policies = $this->objPolicies->getClass();
		$aryClasses = Array (1=>$clsSite_Policies);
		$fldrPolicies = $this->Item (1, $aryClasses);

		$this->objPolicies->setState ($fldrPolicies);

		return ($this->objPolicies);
	}

	// ====================================
}
?>