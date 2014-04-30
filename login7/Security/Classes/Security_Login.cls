<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Security_Login Extends ldrItem
{
		private $dLogin = "";
		private $szPassword = "";
		private $bActive = "0";
		private $dInActive = "";
		private $szEmail = "";

	Function Create (ldrFolder $thsParent, $thsName, $thsDescription, $thsClass=0)
	{		
		if ($thsParent == null) return;
		if ($thsClass == "") $thsClass = $this->getClass();
		
		$newItem = $thsParent->Create_Item ($thsName, "Person", $thsClass);
		$this->setState ($newItem);
	}
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass("Security_Login")->ID()); }
	
	Function setState ($objFolder)
	{	
		parent::setState ($objFolder->getState()); 
		parent::Connect ($objFolder->cn);
	}
	
	Function bActive ()
	{ return ($this->Field ("bActive") == "1"); }

	Function setActive ()
	{ $this->setField ("bActive", "1"); }

	Function setInActive ()
	{ 
		$this->setField ("bActive", "0" );
		$this->setField ("dInActive", Date_Create ()->Format ("Y-m-d H:i:s ") ); 
	}

	Function szPassword ()
	{ return ($this->Field ("szPassword") ); }

	Function setPassword ($thsPSW)
	{ $this->setField ("szPassword", $thsPsw); }
	
	Function szEmail ()
	{ return ($this->Field ("szEmail") ); }

	Function getEmail ($thsEMail)
	{ $this->setField ("szEmail", $thsEMail); }
	
	Function dLoggedIn()
	{ return ($this->Field ("dLogin") ); }
	
	Function update_dLogin()
	{ $this->setField ("dLogin", Date_Create ()->Format ("Y-m-d H:i:s ") ); }
	
}
?>