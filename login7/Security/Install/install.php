<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	======================================= */

function dirPath() { return ("../../../"); }

Include_Once (dirPath() . "Shared/Install_Functions.inc");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
   $szStr =
		" szTitle VarChar(5), " .
		" szFirst VarChar(20), " .
		" szMiddle VarChar(20), " .
		" szLast VarChar(20), " .
		" szSuffix varChar(10) " ;

   CreateClass ("Common_Name", ldrGlobals::cisItem(), 0 , true, $szStr);

   $szStr =
		" szStreet1 VarChar(40), " .
		" szStreet2 VarChar(40), " .
		" szCity VarChar(20), " .
		" szState VarChar(2), " .
		" szZip varChar(10) " ;

   CreateClass ("Common_Address", ldrGlobals::cisItem(), 0 , true, $szStr);

   $szStr =
		" szType varChar(20) " ;

   CreateClass ("Common_ContactType", ldrGlobals::cisItem(), 0 , true, $szStr);

   $szStr =
		" szMethod varChar(250) " ;

   CreateClass ("Common_ContactMethod", ldrGlobals::cisItem(), 0 , true, $szStr);

   CreateClass ("Common_ContactTypes", ldrGlobals::cisFolder(), 0 , true);
   CreateClass ("Common_ContactTypes_Ref", ldrGlobals::cisReference(), 0 , true);

   CreateClass ("Common_Contact", ldrGlobals::cisFolder(), 0 , true);
   CreateClass ("Common_Contacts", ldrGlobals::cisFolder(), 0 , true);

   CreateClass ("Common_Person", ldrGlobals::cisFolder(), 0 , true);

   CreateClass ("Common_People", ldrGlobals::cisFolder(), 0 , true);

	// ======================================================

   $szStr =
		" szNote varChar(250) " ;

   CreateClass ("Common_Note", ldrGlobals::cisItem(), 0 , true, $szStr);

   CreateClass ("Common_Notes", ldrGlobals::cisFolder(), 0 , true);

	// ======================================================

	CreateClass ("Site_Site", ldrGlobals::cisFolder(), 0 , true);

	CreateClass ("Site_Apps", ldrGlobals::cisFolder(), 0 , true );

	$szStr =
		" szApp varchar(250) " ;
	CreateClass ("Site_App", ldrGlobals::cisItem(), 0 , False, $szStr);

	CreateClass ("Site_Help", ldrGlobals::cisFolder(), 0 , true);

	CreateClass ("Site_Policies", ldrGlobals::cisFolder(), 0 , true);

	$szStr =
		" szPolicy varchar(250) " ;
	CreateClass ("Site_Policy", ldrGlobals::cisItem(), 0 , false, $szStr);

	// ======================================================

  	CreateClass ("Security_Security", ldrGlobals::cisFolder(), 0 , true);

	CreateClass ("Security_Groups", ldrGlobals::cisFolder(), 0 , true);

	CreateClass ("Security_Group",  ldrGlobals::cisFolder(), 0 , true);

	//"Security_UserRef" Reference Class "?"
	CreateClass ("Security_UserRef",  ldrGlobals::cisReference(), 0 , true);

	//"Security_Policies" Folder Class "Site_Policies"
	$clsSite_Policies = gblLadder()->getClass ("Site_Policies")->ID();
	CreateClass ("Security_Policies", ldrGlobals::cisFolder(), $clsSite_Policies , true);

	CreateClass ("Security_Users", ldrGlobals::cisFolder(), 0 , true);

	CreateClass ("Security_User", ldrGlobals::cisFolder(), 0 , true);

	$szStr =
		" dLogin DateTime, " .
		" szPassword varChar(40), " .
		" bActive Integer, " .
		" dInActive DateTime, " .
		" szEmail varChar(250) ";
	CreateClass ("Security_Login", ldrGlobals::cisItem(), 0 , true, $szStr);
}
?>