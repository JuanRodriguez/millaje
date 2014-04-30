<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Security_User_Ref.cls");
include_once ("Security_Policies.cls");

Class ENetArch_Security_Group extends ldrFolder
{
	private $objPolicies = null;

	Function __construct () 	{ }
	
	Function ENetArch_Security_Group () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Security_Group")->ID()); }
	
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
	
	Function Init_Folder () {}
	
	// ====================================

	Function Count () 
	{ return ($this->Count() ); }

	Function Item ($nPos) 
	{ return ($this->Item ($nPos) ); }

	// ====================================
	
	Function Add_User (ENetArch_Security_User $thsUser)
	{
		$objUserRefs = new ENetArch_Security_User_Ref ();

		$thsName = $thsUser->Name();
		$thsDescription = "Group member";
		$thsClass = $objUserRefs->getClass();

		$refUser = parent::Create_Reference ($thsName, $thsDescription, $thsClass, $thsUser);
		$refUser->Store();

		$objUserRefs->SetState ($refUser);

		return ($objUserRefs);
	}

	Function Remove_User (ENetArch_Security_User $thsUser)
	{
		$objUserRefs = new ENetArch_Security_User_Ref ();
		$clsUserRefs =  $objUserRefs->getClass();
		$aryClasses = Array (1=>$clsGroup);
		$refUser = parent::getReference (0, $aryClasses);
		$objRef->setState ($fldrGroup);

	}
	
	Function count_Users () 
	{
		$objUserRefs = new ENetArch_Security_User_Ref ();
		$clsUserRefs =  $objUserRefs->getClass();
		$aryClasses = Array (1=>$clsUserRefs);
		$nCount = parent::Count ("", $aryClasses);
		return ($nCount);
	}

	Function get_User ($nPos, $szUser) 
	{
		$objUserRefs = new ENetArch_Security_User_Ref ();
		$clsUserRefs =  $objUserRefs->getClass();
		$aryClasses = Array (1=>$clsUserRefs);
		if ($nPos > 0)
		{ $refUser = parent::Item ($nPos, $aryClasses); }
		else
		{ $refUser = parent::getReference ($szUser, $clsUserRefs); }
		$objUserRefs->setState ($refUser);
		$fldrUser = $objUserRefs->getFolder();
		return ($fldrUser);
	}
	
	Function has_User ($szUser) 
	{
		$objUserRefs = new ENetArch_Security_User_Ref ();
		$clsUserRefs =  $objUserRefs->getClass();
		$aryClasses = Array (1=>$clsUserRefs);
		$bExists = parent::Exists ($szUser, $aryClasses);
		return ($bExists);
	}

	// ====================================

	Function get_UserIDs ()
	{
		$aryRtn = Array();
		
		$objUserRefs = new ENetArch_Security_User_Ref ();
		$clsUserRefs =  $objUserRefs->getClass();
		$aryClasses = Array (1=>$clsUserRefs);
		$nCount = parent::Count ("", $aryClasses);
		
		for ($t=1; $t<$nCount+1; $t++)
		{
			$refUser = parent::Item ($t, $aryClasses); 
			$aryRtn[$t] = $refUser->nLeaf;
		}

		return ($aryRtn);
	}
	
	// ====================================

	Function Create_Policies ($thsName, $thsDescription, $thsClass=0)
	{
		$this->objPolicies = new ENetArch_Site_Policies ();
		$this->objPolicies->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($this->objPolicies);
	}
	
	Function get_Policies () 
	{
		if ($this->objPolicies != null) return ($this->objPolicies);
		
		$this->objPolicies = new ENetArch_Site_Policies ();

		$clsSecurity_Policies = $this->objAddress->getClass();
		$aryClasses = Array (1=>$clsCommon_Address);
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

	Function remove_Policy ($szPath)
	{
		$objPolicies = $this->get_Policies ();
		$objPolicy = $objPolicies->remove_Policy ($szPath);
		return ($objPolicy);
	}

	// ====================================
	
	Function LinkTo (ldrFolder $thsFolder)
	{
		$objGroupRef = new ENetArch_Security_Group_Ref ();
		$objClass = $objGroupRef->getClass()->ID();
		$refGroup = $thsFolder->Create_Reference ($this->szName, "Group Reference", $objClass, $this);
		$objGroupRef->setState ($refGroup);
		return ($objGroupRef);
	}
	
	Function unLink (ldrFolder $thsFolder)
	{
		$objGroupRef = new ENetArch_Security_Group_Ref ();
		$objClass = $objGroupRef->getClass()->ID();
		$aryClasses = Array (1=>$objClass);
		$refGroup = $thsFolder->Item (1, $aryClasses);
		$refGroup->Delete();
	}

	// ====================================
	
}
?>