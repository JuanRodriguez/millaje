<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Site_App.cls");

Class ENetArch_Site_Apps extends ldrFolder
{
	Function __construct () 	{ }
	Function ENetArch_Site_Apps () { __construct (); }
	
	// ====================================

	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0)
	{
		if ($thsParent == null) return;
		if ($thsClass == 0) $thsClass = $this->getClass();
		
		$newFolder = $thsParent->Create_Folder ($thsName, $thsDescription, $thsClass);
		$this->setState ($newFolder);
	}

	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Site_Apps")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}
	
	// ====================================

	Function Count () 
	{
		//$objApps = new ENetArch_Site_Apps ();
		$objApp = new ENetArch_Site_App ();
		
		$clsApps =  $this->getClass();
		$clsApp =  $objPerson->getClass();
		
		$aryClasses = Array (1=>$clsApps, 2=>$clsApp);
		$nCount = parent::Count ("", $aryClasses);
		return ($nCount);
	}

	Function Item ($nPos) 
	{
		//$objApps = new ENetArch_Site_Apps ();
		$objApp = new ENetArch_Site_App ();

		$clsApps =  $this->getClass();
		$clsApp =  $objPerson->getClass();
		
		$aryClasses = Array (1=>$clsApps, 2=>$clsApp);
		$fldrPerson = parent::Item ($nPos, $aryClasses);
		$objPerson->setState ($fldrPerson);
		return ($objPerson);
	}
	
	// ====================================

	Function Create_App ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objApp = new ENetArch_Site_App ();
		$this->objApp->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objApp);
	}
	

	Function get_App() 
	{
		if ($this->objApp != null) return ($this->objApp);
		
		$this->objApp = new ENetArch_Site_App();

		$clsSite_App = $this->objApp->getClass();
		$aryClasses = Array (1=>$clsSite_App);
		$itmApp = $this->Item (1, $aryClasses);

		$this->objApp->setState ($itmApp);

		return ($this->objApp);
	}
	
	// ====================================
	
}
?>