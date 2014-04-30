<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Security_User_Ref Extends ldrReference
{
	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0, ldrFolder $thsFolder)
	{		
		if ($thsParent == null) return;
		if ($thsClass == "") $thsClass = $this->getClass();
		
		$newRef = $thsParent->Create_Reference ($thsName, $thsDescription, $thsClass, $thsFolder);
		$this->setState ($newItem);
	}
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass("Security_UserRef")->ID()); }
	
	Function setState ($objReference)
	{	
		parent::setState ($objReference->getState()); 
		parent::Connect ($objReference->cn);
	}
}
?>