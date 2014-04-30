<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];
?>

#<?= $szNameSpace ?>_DIV
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}

#<?= $szNameSpace ?>
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#<?= $szNameSpace ?> tr td input
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#<?= $szNameSpace ?>_UID
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#<?= $szNameSpace ?>_PSW
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#<?= $szNameSpace ?>_Confirm
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#<?= $szNameSpace ?>_Email
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#<?= $szNameSpace ?>_UID_Header { text-align:right; }
#<?= $szNameSpace ?>_PSW_Header { text-align:right; }
#<?= $szNameSpace ?>_Confirm_Header { text-align:right; }
#<?= $szNameSpace ?>_Email_Header { text-align:right; }

