<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	======================================= */

function dirPath() { return ("../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
Include_Once (dirPath() . "Marketing/Security/rootFolder.php");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Register.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$fldrSecurity = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security ();
	$objSecurity->setState ($fldrSecurity);
?>
<style>
#Security_Register_DIV
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}

#Security_Register
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_Register tr td input
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_Register_UID
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Register_PSW
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Register_Confirm
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Register_Email
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Register_UID_Header { text-align:right; }
#Security_Register_PSW_Header { text-align:right; }
#Security_Register_Confirm_Header { text-align:right; }
#Security_Register_Email_Header { text-align:right; }
</style>

<script>
var Security =
{
	Register :
	{
		cmdRegister : function (me)
		{ me.action = "add.php"; me.Submit(); },

	},
}
</script>

<form ID="frmRegister" name="frmRegister" method="post" action=""
	onSubmit="Security.Register.cmdRegister(this); return false;";>
<div id="Security_Register_DIV">
<?
	$pnlRegister= new ENetArch_Panels_Security_Register ();
	$pnlRegister->setPanelName ("Security.Register");
	$pnlRegister->drawPanel ();
?>
</div>
<input id="" name="btnSubmit" value="submit" type="Submit">
</form>
<?
}
?>
