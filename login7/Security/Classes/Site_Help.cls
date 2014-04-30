<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Common_Notes.cls");

Class ENetArch_Site_Help extends ldrFolder
{
	Function __construct () 	{ }
	
	Function ENetArch_Site_Help () { __construct (); }
	
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
	{	return ( gblLadder()->getClass ("Site_Help")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}
		
	// ====================================

	Function Create_Note ($thsName, $thsDescription, $thsClass=0)
	{
		$objNote = new ENetArch_Common_Note ();
		$objNote->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($objNote);
	}
	
	Function count_Note ()
	{
		$objNote = new ENetArch_Common_Note ();

		$clsCommon_Note = $objNote->getClass();
		$aryClasses = Array (1=>$clsCommon_Note);
		$nCount = parent::Count (1, $aryClasses);

		return ($nCount);
	}

	Function get_Note($nPos) 
	{
		$objNote = new ENetArch_Common_Note ();

		$clsCommon_Note = $objNote->getClass();
		$aryClasses = Array (1=>$clsCommon_Note);
		$itmNote = $this->Item ($nPos, $aryClasses);

		$objNote->setState ($itmNote);

		return ($objNote);
	}
	
	// ====================================

	Function Create_Notes ($thsName, $thsDescription, $thsClass=0)
	{
		$objNotes = new ENetArch_Common_Notes();
		$objNotes->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($objNotes);
	}
	
	Function count_Notes ()
	{
		$objNotes = new ENetArch_Common_Notes ();

		$clsCommon_Notes = $objNotes->getClass();
		$aryClasses = Array (1=>$clsCommon_Notes);
		$nCount = parent::Count (1, $aryClasses);

		return ($nCount);
	}
	
	Function get_Contacts() 
	{
		if ($objNotes != null) return ($objNotes);
		
		$objNotes = new ENetArch_Common_Notes();

		$clsCommon_Notes = $objNotes->getClass();
		$aryClasses = Array (1=>$clsCommon_Contacts);
		$fldrNotes = $this->Item (1, $aryClasses);

		$objNotes->setState ($fldrNotes);

		return ($objNotes);
	}

	// ====================================
	
}
?>