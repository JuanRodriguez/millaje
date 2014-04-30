<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	======================================= */

function dirPath() { return ("../../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
   $aryRoots = gblLadder()->getRoots();
   $fldrRoot= gblLadder()->getItem ($aryRoots [1]);

   $fldrSecurity = new ENetArch_Security_Security ();
   $fldrSecurity->Create ($fldrRoot, "Security", "Security info stored here");
   $fldrSecurity->Store();

   $fldrSecurity->Init_Folder();

   print ("The Security Folder ID is " . $fldrSecurity->ID() . "<BR>");
}
?>