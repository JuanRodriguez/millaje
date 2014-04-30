<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Site_Policy Extends ldrItem
{
	private $szPolicy = "";
	
	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0)
	{		
		if ($thsParent == null) return;
		if ($thsClass == "") $thsClass = $this->getClass();
		
		$newItem = $thsParent->Create_Item ($thsName, $thsDescription, $thsClass);
		$this->setState ($newItem);
	}
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass("Site_Policy")->ID()); }
	
	Function setState (ldrProperties $objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}
}
?>