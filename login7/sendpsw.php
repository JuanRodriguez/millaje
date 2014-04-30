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
Include_Once (dirPath() . "Marketing/Security/Panels/Panel_Security_SendPsw.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$fldrSecurity = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security ();
	$objSecurity->setState ($fldrSecurity);
?>
<style>
#Security_SendPsw_DIV
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}

#Security_SendPsw
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_SendPsw tr td input
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_SendPsw_UID
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_SendPsw_UID_Header { text-align:right; }
#Security_SendPsw_PSW
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_SendPsw_Submit
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_SendPsw_PSW_Header { text-align:right; }
#Security_SendPsw_Register a { text-decoration:none; }
#Security_SendPsw_SendPsw a { text-decoration:none; }
</style>

<script>
var Security =
{
	SendPsw :
	{
		cmdSendPsw : function (me)
		{ me.action = "pswsent.php"; me.Submit(); },
	},
}
</script>

<form ID="frmSendPsw" name="frmSendPsw" method="post" action=""
	onSubmit="Security.SendPsw.cmdSendPsw(this); return false;";>
<div id="Security_SendPsw_DIV">
<?
	$pnlSendPsw= new ENetArch_Panels_Security_SendPsw ();
	$pnlSendPsw->setPanelName ("Security.SendPsw");
	$pnlSendPsw->drawPanel ();
?>
</div>
</form>
<?
}
?>
