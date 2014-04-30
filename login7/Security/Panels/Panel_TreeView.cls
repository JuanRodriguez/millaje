<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Panel_TreeView Extends ENetArch_Panel
{
	private $aryFolders = null;
	private $aryTargets = Array();
	private $aryClasses = null;
	
	public $picPlus = "";
	public $picMinus = "";
	public $picFolderOpen = "";
	public $picFolderClosed = "";
	public $picItem = "";
	public $picReference = "";
	public $picEmpty = "";
	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.TreeView"); }
	Function ENetArch_Panel_TreeView () { __Construct(); }
	
	// =======================================
	//		TreeView.Expand (nID)
	//		TreeView.Collapse (nID)
	//		TreeView.Selected (nID, bStatus := [Exp |  Col])
	
	// ====================================
	// testing would be added here to insure proper types
	
	Function setFolders ($thsFolders)
	{ $this->aryFolders = $thsFolders; }
	
	// $bStatus = "Col"; // [ Col | Exp ]
	Function updateTargetID ($thsID, $thsStatus)
	{ 
		$this->getSession();

		if ($thsStatus == "Exp")
		{
			if (! in_array ($thsID, $this->aryTargets))
			{
				$nCount = count ($this->aryTargets);
				$this->aryTargets [$nCount] = $thsID;
			}
		}
		else
		{
			if (in_array ($thsID, $this->aryTargets))
			{
				$nPos = array_search ($thsID, $this->aryTargets);
				unset ($this->aryTargets [$nPos]);
			}
			else
			{
				$nCount = count ($this->aryTargets);
				$this->aryTargets [$nCount] = $thsID;
			}
		}

		sort ($this->aryTargets);
		$this->setSession();
	}

	Function setClasses ($thsClasses)
	{ $this->aryClasses = $thsClasses; }

	// ====================================
	
	Function getSession () 
	{
		if (! isset ($_SESSION [$this->getPanelID()]['aryTargets']))
		{ $_SESSION [$this->getPanelID()]['aryTargets'] = Array (); }
		else
		{ $this->aryTargets = $_SESSION [$this->getPanelID()]['aryTargets']; }
	}
	
	Function setSession () 
	{
		if (! isset ($_SESSION [$this->getPanelID()]['aryTargets']))
		{ $_SESSION [$this->getPanelID()]['aryTargets'] = Array (); }
		else
		{ $_SESSION [$this->getPanelID()]['aryTargets'] = $this->aryTargets; }
	}
	
	Function getPOST () {}
	Function getGETs () {}
	
	// ====================================
	
	Function setPanel (ldrFolder $thsObject) 
	{ $this->topFolder = $thsObject; }
	
	Function updateObject ($thsObject) {}
	
	Function clearPanel () 
	{
		$this->topFolder = null;
		$this->aryTargetIDs = Array();
		$this->aryClasses = null;

		$this->picPlus = "";
		$this->picMinus = "";
		$this->picFolderOpen = "";
		$this->picFolderClosed = "";
		$this->picItem = "";
		$this->picReference = "";
		$this->picEmpty = "";
	}

	// ====================================
	
	Function drawPanel () 
	{ 
		if ($this->aryFolders == null)
		{
			$topFolder = gblLadder()->getItem (1);

			$this->aryFolders = Array (1=>$topFolder->ID());
		}
		
		$this->List_Folders ($this->aryFolders, $this->aryTargets, $this->aryClasses); 
	}

	// ============================================

	Function List_Folders ($aryFolders, $aryPath, $aryClasses)
	{
		if (count ($aryFolders) == 0) return;

	?>
	<table border=0  cellspacing=0 cellpadding=0>
	<?
		For ($t=1; $t<count ($aryFolders)+1; $t++)
		{
			$objFolder = gblLadder()->getItem ($aryFolders[$t]);

			$nID = $objFolder->ID ();
			$szName = $objFolder->Name ();
			$cFolderPic = $this->picFolderClosed;
			$bPic = "Exp";

			$bIDFound = false;
			if ($aryPath != null)
				$bIDFound = in_Array ($nID, $aryPath);

			if ($bIDFound)
			{
				$cFolderPic = $this->picFolderOpen;
				$bPic = "Col";
			}

			$nCount = $objFolder->Count ("", $aryClasses);
			if ($nCount == 0) $bPic = "";
	?>
	<tr>
		<td nowrap><?= $this->LinkExpCol ($nID, $bPic) ?></td>
		<td>
	<table border=0  cellspacing=1 cellpadding=1>
	<tr>
		<td><?= $this->LinkPic ($nID, $bPic, $cFolderPic) ?></td>
		<td nowrap><?= $this->LinkTopic ($nID, $bPic, $szName) ?></td>
	<tr>
	</table>
		</td>
	</tr>
	<?
			if ($bIDFound)
			if ($nCount > 0)
			{
				$arySubFolders = $objFolder->SubFolders ("", $aryClasses);
				$aryItems = $objFolder->Items ("", $aryClasses);
				$aryRefs = $objFolder->References ("", $aryClasses);

				If
					 (
						 (count ($arySubFolders) != 0) ||
						 (count ($aryItems) != 0)  ||
						 (count ($aryRefs) != 0)
					)
				{
	?>
	<tr>
		<td>&nbsp;</td>
		<td  nowrap>
	<?
				$this->List_Folders ($arySubFolders, $aryPath, $aryClasses);
				$this->List_Items ($aryItems);
				$this->List_Refs ($aryRefs);
	?>
		</td>
	</tr>
	<?
				}
			}

		} // For Loop
	?>
	</table>
	<?
	}

	// ============================================

	Function List_Items ($aryItems)
	{
		if (count ($aryItems) == 0) return;

	?>
	<table border=0  cellspacing=0 cellpadding=0>
	<?

		For ($t=1; $t<count ($aryItems)+1; $t++)
		{
			$objItem = gblLadder()->getItem ($aryItems[$t]);
			$nID = $objItem->ID ();
			$szName = $objItem->Name ();
			$cFolderPic = $this->picItem;
			$bPic = $this->picEmpty;
	?>
	<tr>
		<td nowrap><?= $this->LinkExpCol ($nID, $bPic) ?></td>
		<td>
	<table border=0  cellspacing=1 cellpadding=1>
	<tr>
		<td><?= $this->LinkPic ($nID, $bPic, $cFolderPic) ?></td>
		<td nowrap><?= $this->LinkTopic ($nID, "", $szName) ?></td>
	<tr>
	</table>
		</td>
	</tr>
	<?
		}
	?>
	</table>
	<?
	}

	// ============================================

	Function List_Refs ($aryItems)
	{
		if (count ($aryItems) == 0) return;
	?>
	<table border=0  cellspacing=0 cellpadding=0>
	<?

		For ($t=1; $t<count ($aryItems)+1; $t++)
		{
			$objItem = gblLadder()->getItem ($aryItems[$t]);
			$nID = $objItem->ID ();
			$szName = $objItem->Name ();
			$cFolderPic = $this->picReference;
			$bPic = $this->picEmpty;
	?>
	<tr>
		<td nowrap><?= $this->LinkExpCol ($nID, $bPic) ?></td>
		<td>
	<table border=0  cellspacing=1 cellpadding=1>
	<tr>
		<td><?= $this->LinkPic ($nID, $bPic, $cFolderPic) ?></td>
		<td nowrap><?= $this->LinkTopic ($nID, "", $szName) ?></td>
	<tr>
	</table>
		</td>
	</tr>
	<?
		}
	?>
	</table>
	<?
	}

	// ============================================

	Function LinkPic ($nID, $bStatus, $szImg)
	{
		$szRtn =
		"<A " .
			"name=\"" . $nID . "\" " .
			"HREF=\"" .
			"javascript:" . $this->getPanelName () . ".Selected " . 
			" (" . $nID  . ", '" . $bStatus . "' )" .
			"\" >" .
			"<IMG SRC=\"" . $szImg . "\" border=0 >" .
		"</a>";

		return ($szRtn);
	}

	Function LinkTopic ($nID, $bStatus, $szTopic)
	{
		$szRtn =
			"<A HREF=\"" .
				"javascript:" . $this->getPanelName () . ".Selected " . 
				" (" . $nID . ", '" . $bStatus . "' )" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}

	Function LinkExpCol ($nID, $bExp)
	{
		switch ($bExp)
		{
			Case "Exp":
				$szImg = $this->picPlus;
				$szRtn =
					"<A HREF=\"" .
					"javascript:" . $this->getPanelName () . ".Expand " . 
					" (" . $nID . " )" .
					"\" >" .
					"<IMG SRC=\"" . $szImg . "\" border=0 >" .
					"</a>";
				break;

			Case "Col":
				$szImg = $this->picMinus;
				$szRtn =
					"<A HREF=\"" .
					"javascript:" . $this->getPanelName () . ".Collapse " . 
					" (" . $nID . " )" .
					"\" >" .
					"<IMG SRC=\"" . $szImg . "\" border=0 >" .
					"</a>";
				break;

			Default:
				$szImg = $this->picEmpty;
				$szRtn =
					"<IMG SRC=\"" . $szImg . "\" border=0 >";
				break;
		}

		return ($szRtn);
	}	
}
?>