<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Security_User.cls");

Class ENetArch_Security_Users extends ldrFolder
{
	Function __construct () 	{ }
	Function ENetArch_Security_Users () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Security_Users")->ID()); }
	
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
	
	Function Create_User ($thsName, $thsDescription, $thsClass=0)
	{
		$newUser = new ENetArch_Security_User ();
		$newUser->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($newUser);
	}
	
	Function add_User ($szUser, $szDescription, $szPSW, $szEmail)
	{
		if (strLen ($szUser) == 0) return;
		if ($this->has_User ($szUser)) return;
		
		$objUser = $this->Create_User ($szUser, $szDescription);
		$objUser->Store();
		
		$objUser->Init_Folder($szPSW, $szEmail);
		
		return ($objUser);
	}
	
	Function count_Users ()
	{
		$objUser = new ENetArch_Security_User();
		$clsSecurity_User = $objUser->getClass();
		$aryClasses = Array (1=>$clsSecurity_User);
		$nCount = parent::Count ("", $aryClasses);
		return ($nCount);
	}
	
	Function get_User ($nPos, $szUser) 
	{
		$objUser = new ENetArch_Security_User();

		$clsSecurity_User = $objUser->getClass();
		$aryClasses = Array (1=>$clsSecurity_User);
		
		$fldrUser = null;
		
		if ($nPos > 0)
		$fldrUser = $this->Item ($nPos, $aryClasses);

		if (strLen ($szUser) != 0)
		$fldrUser = $this->getFolder ($szUser, $clsSecurity_User);

		if ($fldrUser == null) return;
		
		$objUser->setState ($fldrUser);

		return ($objUser);
	}
	
	Function has_User ($thsUser) // As Boolean
	{
		$objUser = new ENetArch_Security_User();
		$clsSecurity_User = $objUser->getClass();
		$aryClasses = Array (1=>$clsSecurity_User);
		$bExists = parent::Exists ($thsUser, $aryClasses);
		return ($bExists);
	}	
	
	// ====================================
}
?>