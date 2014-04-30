<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Security_Group.cls");

Class ENetArch_Security_Groups extends ldrFolder
{
	Function __construct () 	{ }
	Function ENetArch_Security_Groups () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Security_Groups")->ID()); }
	
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
		
		$newFolder = $thsParent->Create_Folder ($thsName, "Person", $thsClass);
		$this->setState ($newFolder);
	}
	
	Function Init_Folder ()	{	}
	
	// ====================================

	Function Count () 
	{ return ($this->Count() ); }
	
	Function Item ($nPos) 
	{ return ($this->Item ($nPos) ); }

	// ====================================

	Function Create_Group ($thsName, $thsDescription, $thsClass=0)
	{
		$objGroup = new ENetArch_Security_Group ();
		$objGroup->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($objGroup);
	}
	
	Function count_Groups () 
	{
		$objGroup = new ENetArch_Security_Group ();
		$clsGroup =  $objGroup->getClass();
		$aryClasses = Array (1=>$clsGroup);
		$nCount = parent::Count ("", $aryClasses);
		return ($nCount);
	}

	Function get_Group ($nPos, $thsName) 
	{
		$objGroup = new ENetArch_Security_Group ();
		$clsGroup =  $objGroup->getClass();
		$aryClasses = Array (1=>$clsGroup);
		
		$fldrGroup = null;
		if ($nPos > 0)
		{ $fldrGroup = parent::Item ($nPos, $aryClasses); }
		else
		{ $fldrGroup = parent::getFolder ($thsName, $clsGroup); }
		
		$objGroup->setState ($fldrGroup);
		return ($objGroup);
	}
	
	// ====================================	
}
?>