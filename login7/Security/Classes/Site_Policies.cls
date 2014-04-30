<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

include_once ("Site_Policy.cls");

Class ENetArch_Site_Policies extends ldrFolder
{
	Function __construct () 	{ }
	
	Function ENetArch_Site_Policies () { __construct (); }
	
	// ====================================
	
	Function getClass () 
	{	return ( gblLadder()->getClass ("Site_Policies")->ID()); }
	
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
	
	// ====================================

	Function Count () 
	{
		//$objPolicies = new ENetArch_Site_Policies ();
		$objPolicy = new ENetArch_Site_Policy ();
		
		$clsPolicies =  $this->getClass();
		$clsPolicy =  $objPolicy->getClass();
		
		$aryClasses = Array (1=>$clsPolicies, 2=>$clsPolicy);
		$nCount = parent::Count ("", $aryClasses);
		return ($nCount);
	}

	Function Item ($nPos) 
	{
		//$objPolicies = new ENetArch_Site_Policies ();
		$objPolicy = new ENetArch_Site_Policy ();

		$clsPolicies =  $this->getClass();
		$clsPolicy =  $objPolicy->getClass();
		
		$aryClasses = Array (1=>$clsPolicies, 2=>$clsPolicy);
		$fldrPolicy = parent::Item ($nPos, $aryClasses);
		$objPolicy->setState ($fldrPolicy);
		return ($objPolicy);
	}
	
	// ====================================

	Function Create_Policies ($thsName, $thsDescription, $thsClass=0)
	{
		$newPolicies = new ENetArch_Site_Policies ();
		$newPolicies->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($newPolicies);
	}
	
	Function count_Policies()
	{
		$clsPolicies =  $this->getClass();
		$aryClasses = Array (1=>$clsPolicies);
		$nCount = parent::Count (1, $aryClasses);

		return ($nCount);		
	}
	
	Function get_Policies ($nPos, $szName) 
	{
		$objPolicies = new ENetArch_Site_Policies();

		$clsPolicies =  $this->getClass();
		$aryClasses = Array (1=>$clsPolicies);
		
		if ($nPos > 0) 
		$fldrPolicies = $this->Item ($nPos, $aryClasses);

		if (strLen ($szName) > 0) 
		$fldrPolicies = $this->getFolder ($szName, $aryClasses);

		$objPolicies->setState ($fldrPolicies);

		return ($objPolicies);
	}
	
	// ====================================

	Function Create_Policy ($thsName, $thsDescription, $thsClass=0)
	{
		$newPolicy = new ENetArch_Site_Policy ();
		$newPolicy->Create ($this, $thsName, $thsDescription, $thsClass);
		return ($newPolicy);
	}
	
	Function count_Policys()
	{
		$objPolicy = new ENetArch_Site_Policy();

		$clsPolicy =  $objPolicy->getClass();
		$aryClasses = Array (1=>$clsPolicy);
		$nCount = parent::Count (1, $aryClasses);

		return ($nCount);
	}
	
	Function get_Policy ($nPos, $szName) 
	{
		$objPolicy = new ENetArch_Site_Policy();

		$clsPolicy =  $objPolicy->getClass();
		$aryClasses = Array (1=>$clsPolicy);
		
		if ($nPos > 0) 
		$itmPolicy = $this->Item ($nPos, $aryClasses);

		if (strLen ($szName) > 0) 
		$itmPolicy = $this->getFolder ($szName, $aryClasses);

		$objPolicy->setState ($itmPolicy);

		return ($objPolicy);
	}
	
	// ====================================

	Function add_Policy ($szPath, $szDescription, $szValue)
	{
		if (strLen ($szPath) == 0) return;
		
		$clsPolicies = $this->getClass();
		$clsPolicy = ENetArch_Site_Policy::getClass();
		
		$aryPath = explode ("/", $szPath);
		$nFolders = count ($aryPath)-1;
		
		if ($nFolders == 0) return;

		$thsFolder = $this;
		for ($t=1; $t<count ($aryPath); $t++)
		{
			if ($t < $nFolders)
			{
				$fldrPolicies = $thsFolder->getFolder ($aryPath [$t], $clsPolicies);
				if ($fldrPolicies == null)
				{
					$newPolicies = $thsFolder->Create_Policies ($aryPath [$t], "Policy Folder");
					$newPolicies->Store();
					$thsFolder = $newPolicies;
				}
				else
				{
					$newPolicies = new ENetArch_Site_Policies ();
					$newPolicies->setState ($fldrPolicies);
					$thsFolder = $newPolicies;
				}			
			}
			else
			{
				$itmPolicy = $thsFolder->getItem ($aryPath [$t], $clsPolicy);
				if ($itmPolicy == null)
				{
					$newPolicy = $thsFolder->Create_Policy ($aryPath [$t], $szDescription);
					$newPolicy->setField ("szPolicy", $szValue);
					$newPolicy->Store();
				}
				else
				{
					$newPolicy = $itmPolicy;
					$newPolicy->setField ("szPolicy", $szValue);
					$newPolicy->Store();
				}

				return ($newPolicy);
			}
		}
		
	}

	Function get_Policy2 ($szPath)
	{
		if (strLen ($szPath) == 0) return;
		
		$aryPath = explode ("/", $szPath);
		$nFolders  = count ($aryPath)-1;
		
		if ($nFolders == 0) return;

		$thsFolder = $this;
		for ($t=1; t<count ($aryPath); $t++)
		{
			if ($t < $nFolders)
			{
				$fldrPolicies = $thsFolder->Item (0, $aryPath [$t]);
				if ($fldPolicies != null)
				{
					$thsFolder = $fldrPolicies;
				}			
			}
			else
			{
				$itmPolicy = $thsFolder->Item (0, $aryPath [$t]);
				return ($newPolicy);
			}
		}
	}

	// ====================================

}
?>