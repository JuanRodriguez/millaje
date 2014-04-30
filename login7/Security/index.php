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
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_Login.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$fldrSecurity = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security ();
	$objSecurity->setState ($fldrSecurity);
?>
<style>
#Security_Login_DIV
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}

#Security_Login
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_Login tr td input
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_Login_UID
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Login_UID_Header { text-align:right; }
#Security_Login_PSW
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Login_Submit
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_Login_PSW_Header { text-align:right; }
#Security_Login_Register a { text-decoration:none; }
#Security_Login_SendPSW a { text-decoration:none; }
</style>

<script>
var Security =
{
	Login :
	{
		cmdLogin : function (me)
		{ me.action = "login.php"; me.Submit(); },

		cmdSendPsw : function (me)
		{ location = "SendPsw.php"; },

		cmdRegister : function (me)
		{ location = "Register.php"; },

	},
}
</script>

<form ID="frmLogin" name="frmLogin" method="post" action=""
	onSubmit="Security.Login.cmdLogin(this); return false;";>
<div id="Security_Login_DIV">
<?
	$pnlLogin= new ENetArch_Panels_Security_Login ();
	$pnlLogin->setPanelName ("Security.Login");
	$pnlLogin->drawPanel ();
?>
</div>
</form>
<?
}
?>
