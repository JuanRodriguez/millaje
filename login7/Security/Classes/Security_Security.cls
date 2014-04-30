<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Site_Site.cls");
include_once ("Security_Groups.cls");
include_once ("Security_Policies.cls");
include_once ("Security_Users.cls");

Class ENetArch_Security_Security extends ldrFolder
{
	private $objGroups = null;
	private $objUsers = null;

	Function __construct () 	{ }
	Function ENetArch_Security_Security () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Security_Security")->ID()); }
	
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
	
	Function Init_Folder ()
	{
		$this->Site = new ENetArch_Site_Site ();
		$this->Site->setState ($this);
		$this->Site->Init_Folder();
		
		$this->Create_Groups ("Groups", "Groups are stored here");		
		$this->objGroups->store();
		
		$objGroup = $this->Create_Group ("Everyone", "Every User Found Here");
		$objGroup->Store();
		
		$objGroup = $this->Create_Group ("Administrators", "Administrative Users of this site");
		$objGroup->Store();
		
		$this->Create_Users ("Users", "Users are stored here");
		$this->objUsers->Store();	
		
		$objUser = $this->add_User ("Admin", "The administrative user of this site", "Password", "");
		$objUser->Store();
		
		$objGroup->add_User ($objUser);
	}
	
	// ====================================

	Function Create_Groups ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objGroups = new ENetArch_Security_Groups ();
		$this->objGroups->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objGroups );
	}
	
	Function get_Groups () 
	{
		if ($this->objGroups != null) return ($this->objGroups);
		
		$this->objGroups = new ENetArch_Security_Groups ();

		$clsSecurity_Groups = $this->objGroups->getClass();
		$aryClasses = Array (1=>$clsSecurity_Groups);
		$fldrGroups = $this->Item (1, $aryClasses);

		$this->objGroups->setState ($fldrGroups);

		return ($this->objGroups);
	}
	
	// ====================================

	Function Create_Users ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objUsers = new ENetArch_Security_Users ();
		$this->objUsers->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objUsers);
	}
	
	Function get_Users () 
	{
		if ($this->objUsers != null) return ($this->objUsers);
		
		$this->objUsers = new ENetArch_Security_Users ();

		$clsSecurity_Users = $this->objUsers->getClass();
		$aryClasses = Array (1=>$clsSecurity_Users);
		$fldrUsers = $this->Item (1, $aryClasses);

		$this->objUsers->setState ($fldrUsers);

		return ($this->objUsers);
	}
	
	// ====================================

	Function create_Group ($thsName, $thsDescription)
	{
		$objGroups = $this->get_Groups ();
		$objGroup = $objGroups->create_Group ($thsName, $thsDescription);
		return ($objGroup);
	}
	
	Function get_Group ($nPos, $thsName)
	{
		$objGroups = $this->get_Groups ();
		$objGroup = $objGroups->get_Group ($nPos, $thsName);
		return ($objGroup);
	}
	
	// ====================================

	Function add_User ($szUser, $szDescription, $szPSW, $szEmail)
	{
		$objUsers = $this->get_Users ();
		
		if ($objUsers->has_User ($szUser)) return (null);
		$objUser = $objUsers->add_User ($szUser, $szDescription, $szPSW, $szEmail);
				
		$objEveryone = $this->get_Group (0, "Everyone");
		$objEveryone->add_User ($objUser);
		
		return ($objUser);
	}

	Function has_User ($szUser)
	{
		$objUsers = $this->get_Users ();
		return ($objUsers->has_User ($szUser));
	}
	
	Function remove_User ($objUser)
	{
		$objUser = $this->get_User (0, $szUser);
		if ($objUser == null) return;
		
		$objGroups = $this->get_Groups ();
		$objGroups->remove_User ($objUser);
		
		$objUsers->remove_User ($objUser);
	}
	
	Function get_User ($nPos, $szName)
	{
		$objUsers = $this->get_Users ();
		$objUser = $objUsers->get_User ($nPos, $szName);
		return ($objUser);
	}
	
	Function Login ($szUser, $thsPSW)
	{
		$objUser = $this->get_User (0, $szUser);
		if ($objUser == null) return;

		$objLogin = $objUser->get_Login ();
		
		if (! $objLogin->bActive()) return (false);
		
		$szPSW = $objLogin->szPassword();
		if ($thsPSW != $szPSW) return (false);
		
		$objLogin->update_dLogin();
		
		return (true);		
	}
	
	Function emailPSW ()
	{
		$objUser = $this->get_User (0, $szUser);
		if ($objUser == null) return;

		$objLogin = $objUser->get_Login ();
		
		$szPSW = $objLogin->szPassword();
		$szEmail = $objLogin->szEmail();
		
		// email password	
	}
	
	// ====================================

	Function get_Policy ($objUser, $thsPolicy)
	{
		// returns 0 or more policies concering the target user
		// policies may be found at the Site Level, Group Level,
		// or User Level.  Note that a Policy may be in 1 or more
		//	groups.
		
		if ($thsUser == null) return (null);
		if (trim ($thsPolicy) == "") return (null);
		
		$aryResults1 = $objUser->get_Policy ($thsPolicy);
		$aryResults2 = $objGroups->get_Policy ($thsPolicy);
		$aryResults3 = $objPolicies->get_Policy ($thsPolicy);
		
		// merge arrays
		
		return ($aryMerged);
	}
	
}
?>