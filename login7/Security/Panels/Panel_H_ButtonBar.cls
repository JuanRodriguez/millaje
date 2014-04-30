<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

/* ==========================
	szBtnImage
	szFunction
	szPopUpText
	szAltText
	==========================*/

class ENetArch_Panels_H_ButtonBar Extends ENetArch_Panel
{
	protected $aryButtons = Array();
	
	// ==============================================

	Function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['aryButtons']))
			$this->aryButtons = $_SESSION [$this->getPanelID()]['aryButtons'] ;
	}

	Function setSession ()
	{
		$_SESSION [$this->getPanelID()]['aryButtons'] = $this->aryButtons;
	}

	Function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_aryButtons']))
			$this->aryButtons = $_REQUEST [$this->getPanelID() . '_aryButtons'];
	}

	// ==============================================
	
	Function setPanel () {	}
	// this class does not accept ladder instances
	// though it could, if it pointed to a folder w button dara
	
	Function clearPanel ()
	{ $this->aryButtons = Array(); }
	
	Function addButton ($szBtnImage, $szFunction)
	{
		$this->aryButtons [count ($this->aryButtons)] = Array ($szBtnImage, $szFunction);
	}

	// ==============================================
	
	Function drawPanel ()
	{
?>
	<div id="<?= $this->getPanelID() ?>">
	<table>
		<tr>
<?		
		foreach ($this->aryButtons as $Key => $szValue)
		{
			$szImage = $szValue[0];
			$szFunction = $szValue[1];
			
			$szImgTag = "<img src=\"" . $szImage . "\" border=\"0\">";
			$szLink = $this->LinkFunction ($szImgTag, $szFunction);
			print ("<td>" . $szLink . "</td>");
		}
?>		
		</tr>
	</table>
	</div>
<?
	}
	
	Function LinkFunction ($szTopic, $szFunction)
	{
		$szRtn =
			"<A HREF=\"javascript:void(0);\" " .
				"onClick =\"" .
				$this->getPanelName () . "." . $szFunction . "()" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}
}
?>