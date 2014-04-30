<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

Class ENetArch_Common_Note Extends ldrItem
{
	private $szNote = "";
	
	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0)
	{		
		if ($thsParent == null) return;
		if ($thsClass == "") $thsClass = $this->getClass();
		
		$newItem = $thsParent->Create_Item ($thsName, "Person", $thsClass);
		$this->setState ($newItem);
	}
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass("Common_Note")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}

}
?>