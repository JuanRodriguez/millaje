<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

include_once ("Common_Note.cls");

Class ENetArch_Common_Notes extends ldrFolder
{
	
	Function __construct () 	{ }
	
	Function ENetArch_Common_Notes () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass("Common_Notes")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}

	// ====================================

	Function Create_Note ($thsName, $szDescription)
	{
		$newNote = new ENetArch_Common_Note();
		$newNote->Create ($this, $thsName, $szDescription);
		return ($newNote);
	}
	
	Function get_Note ($nPos=0)
	{
		$objNote = new ENetArch_Common_Note();
		
		$clsCommon_Note = $objNote->getClass();
		$aryClasses = Array (1=>$clsCommon_Note);
		$itmNote = $this->Item ($nPos, $aryClasses);

		$objNote->setState ($itmNote);

		return ($objNote);	
	}
	
	Function count_Note ()
	{
		$newNote = new ENetArch_Common_Note();
		$clsCommon_Note = $newNote->getClass();
		$nCount = $this->Count ("", Array (1=>$clsCommon_Note) );
		return ($nCount);
	}
	
	// ====================================
	
	Function Create_Notes ($thsName, $szDescription)
	{

		$newNotes = new ENetArch_Common_Notes();
		$clsCommon_Notes = $newNotes->getClass();

		$objFolder = $this->Create_Folder ($thsName, $szDescription, $clsCommon_Notes);
		
		$newNotes->setState ($objFolder);
		return ($newNotes);
	}
	
	Function get_Notes ($nPos=0)
	{
		$objNotes = new ENetArch_Common_Notes();
		
		$clsCommon_Notes = $objNotes->getClass();
		$aryClasses = Array (1=>$clsCommon_Notes);
		$fldrNotes = $this->Item ($nPos, $aryClasses);

		$objNotes->setState ($fldrNotes);

		return ($objNotes);	
	}
	
	Function count_Notes ()
	{
		$newNotes = new ENetArch_Common_Notes();
		$clsCommon_Notes = $newNotes->getClass();
		$nCount = $this->Count ("", Array (1=>$clsCommon_Notes) );
		return ($nCount);
	}
	
}
?>