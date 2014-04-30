<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

class ENetArch_Panels_Ladder_PathList Extends ENetArch_Panel
{
	protected $aryPath = Array();
	
	// ==============================================

	Function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['aryPath']))
			$this->aryPath = $_SESSION [$this->getPanelID()]['aryPath'] ;
	}

	Function setSession ()
	{
		$_SESSION [$this->getPanelID()]['aryPath'] = $this->aryPath;
	}

	Function getPOST ()
	{
		if (isset ($_REQUEST [$this->getPanelID() . '_aryPath']))
			$this->aryPath = $_REQUEST [$this->getPanelID() . '_aryPath'];
	}

	// ==============================================
	
	Function setPanel (ldrProperties $thsObject, ldrProperties $strtPoint) 
	{
		if ($thsObject == null) return;

		$aryPath = $thsObject->Path();
		$trmPath = 	$strtPoint->Path();
		$nPathCount = count ($aryPath);
		$nTrmCount = count ($trmPath);
		
		$this->aryPath = array_slice ($aryPath, $nTrmCount-1);
	}
	
	Function clearPanel ()
	{
		$this->aryPath = Array();
	}
	
	// ==============================================
	
	Function drawPanel ()
	{
?>
	<div id="<?= $this->getPanelID() ?>_Path">
	<table>
		<tr>
<?		
		foreach ($this->aryPath as$key => $nID)
		{
			$objItem = gblLadder()->getItem ($nID);
			
			print ("<td>\\ " . $this->LinkTopic ($nID, $objItem->Name()) . "</td>");
		}
?>		
		</tr>
	</table>
	</div>
<?
	}
	
	Function LinkTopic ($nID, $szTopic)
	{
		$szRtn =
			"<A HREF=\"javascript:void(0);\"" .
				"onClick=\"" .
				$this->getPanelName () . ".Selected " . "(" . $nID . " )" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}
}
?>