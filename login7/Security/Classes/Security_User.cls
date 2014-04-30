<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Security_Login.cls");
include_once ("Security_Policies.cls");

Class ENetArch_Security_User extends ldrFolder
{
	private $objLogin = null;
	private $objPolicies = null;

	Function __construct () 	{ }
	
	Function ENetArch_Security_User () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Security_User")->ID()); }
	
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
	
	Function Init_Folder ($szPSW, $szEmail)
	{
		$this->add_Login ($szPSW, $szEmail);
		$this->add_Policies ();
		
		$this->add_Policy("/password/can change", "can the user change their password", "true");
		$this->add_Policy("/password/must change", "must the user change the password the next time they log in", "false");
		$this->add_Policy("/password/never expires", "this overrides the need to change the password every x days", "false");
		$this->add_Policy("/password/expires on", "when does the password expire", Now () + 30);
	}
	
	// ====================================

	Function Create_Login ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objLogin = new ENetArch_Security_Login ();
		$this->objLogin->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objLogin);
	}
	
	Function add_Login ($szPSW, $szEmail)
	{
		$objLogin = $this->Create_Login ("Login", "Login Details", $thsClass=0);
		$objLogin->setField ("szPassword", $szPSW);
		$objLogin->setField ("szEmail", $szEmail);
		$objLogin->Store();
		
		return ($objLogin);
	}
	
	Function get_Login() 
	{
		if ($this->objLogin != null) return ($this->objName);
		
		$this->objLogin = new ENetArch_Security_Login();

		$clsSecurity_Login = $this->objLogin->getClass();
		$aryClasses = Array (1=>$clsSecurity_Login);
		$itmLogin = $this->Item (1, $aryClasses);

		$this->objLogin->setState ($itmLogin);

		return ($this->objLogin);
	}
	
	// ====================================

	Function Create_Policies ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objPolicies = new ENetArch_Site_Policies ();
		$newPolicies = $this->objPolicies->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objPolicies);
	}
	
	Function add_Policies ()
	{
		$objPolicies = $this->Create_Policies ("Policies", "Policies specific to the user");
		$objPolicies->Store();
		return ($objPolicies);
	}
	
	Function get_Policies () 
	{
		if ($this->objPolicies != null) return ($this->objPolicies);
		
		$this->objPolicies = new ENetArch_Site_Policies ();

		$clsSecurity_Policies = $this->objPolicies->getClass();
		$aryClasses = Array (1=>$clsSecurity_Policies);
		$fldrPolicies = $this->Item (1, $aryClasses);

		$this->objPolicies->setState ($fldrPolicies);

		return ($this->objPolicies);
	}
	
	// ====================================
	
	Function add_Policy ($szPath, $szDescription, $szValue)
	{
		$objPolicies = $this->get_Policies ();
		$objPolicy = $objPolicies->add_Policy ($szPath, $szDescription, $szValue);
		return ($objPolicy);
	}

	Function get_Policy ($nPos, $szPolicy)
	{
		$objPolicies = $this->get_Policies ();
		$objPolicy = $objPolicies->get_Policy ($nPos, $szPolicy);
		return ($objPolicy);
	}

	// ====================================
	
	Function LinkTo (ldrFolder $thsFolder)
	{
		$objUserRef = new ENetArch_Security_User_Ref ();
		$objClass = $objUserRef->getClass()->ID();
		$refUser = $thsFolder->Create_Reference ($this->szName, "User Reference", $objClass, $this);
		$objUserRef->setState ($refGroup);
		return ($objUserRef);
	}
	
	Function unLink (ldrFolder $thsFolder)
	{
		$objUserRef = new ENetArch_Security_User_Ref ();
		$objClass = $objUserRef->getClass()->ID();
		$aryClasses = Array (1=>$objClass);
		$refUser = $thsFolder->Item (1, $aryClasses);
		$refUser->Delete();
	}

	// ====================================
}
?>