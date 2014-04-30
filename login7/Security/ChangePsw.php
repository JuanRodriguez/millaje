<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	======================================= */

function dirPath() { return ("../../"); }

Include_Once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
Include_Once (dirPath() . "Marketing/Security/Security_Security.cls");
Include_Once (dirPath() . "Marketing/Security/rootFolder.php");
Include_Once (dirPath() . "Marketing/Security/Panel_Panel.cls");
Include_Once (dirPath() . "Marketing/Security/Panel_Security_ResetPsw.cls");
Include_Once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$fldrSecurity = gblLadder()->getItem (rootFolder ());
	$objSecurity = new ENetArch_Security_Security ();
	$objSecurity->setState ($fldrSecurity);
?>
<style>
#Security_ResetPsw_DIV
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}

#Security_ResetPsw
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_ResetPsw tr td input
{
   font-family: Arial, Helvetica, sans-serif; font-size: 8pt;
   font-style: normal;
   font-weight: normal;
}
#Security_ResetPsw_OldPsw
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_ResetPsw_PSW
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_ResetPsw_Confirm
{
   background-color: #FFFF99;
   border-style: solid;
   border-top-width: 1px;
   border-right-width: 1px;
   border-bottom-width: 1px;
   border-left-width: 1px
}
#Security_ResetPsw_UID_Header { text-align:right; }
#Security_ResetPsw_PSW_Header { text-align:right; }
#Security_ResetPsw_Confirm_Header { text-align:right; }
</style>

<script>
var Security =
{
	ResetPsw :
	{
		cmdResetPsw : function (me)
		{ window.alert (" Reset Psw"); },

	},
}
</script>

<form ID="frmResetPsw" name="frmResetPsw" method="post" action=""
	onSubmit="Security.ResetPsw.cmdResetPsw(this); return false;";>
<div id="Security_ResetPsw_DIV">
<?
	$pnlResetPsw= new ENetArch_Panels_Security_ResetPsw ();
	$pnlResetPsw->setPanelName ("Security.ResetPsw");
	$pnlResetPsw->drawPanel ();
?>
</div>
<input id="" name="btnSubmit" value="submit" type="Submit">
</form>
<?
}
?>
