<?
Class ENetArch_Panel_Folder_DetailList extends ENetArch_Panel
{
	public $picFolderOpen = "";
	public $picFolderClosed = "";
	public $picItem = "";
	public $picReference = "";
	public $picEmpty = "";

	Function __Construct () { parent::setPanelName ("ENetArch.Panel.Folder.DetailList"); }
	Function ENetArch_Panel_ClassList () { __Construct(); }

	// ===========================================

	Function setPanel (ldrFolder $thsObject)
	{
		$this->objFolder = $thsObject;
		if ($this->objFolder->isItem()) return;
	}

	Function clearPanel ()
	{
		$this->objFolder = null;

		$this->picFolderOpen = "";
		$this->picFolderClosed = "";
		$this->picItem = "";
		$this->picReference = "";
		$this->picEmpty = "";		
	}

	Function drawPanel () 	{ $this->List_Folders(); }

	// ===========================================

	Function List_Folders ()
	{
		$nID = $this->objFolder->ID();
?>
	<table border=0  cellspacing=1 cellpadding=1 width=500>
		<tr bgcolor="dddddd">
			<th><?=$this->LinkFunction($nID, "ID", "SortBy_ID"); ?></th>
			<th><IMG SRC="<?= $this->picEmpty ?>" border=0 ></th>
			<th><?=$this->LinkFunction($nID, "Name", "SortBy_Name"); ?></th>
			<th><?=$this->LinkFunction($nID, "Description", "SortBy_Description"); ?></th>
			<th><?=$this->LinkFunction($nID, "Class", "SortBy_Class"); ?></th>
		</tr>
<?
		$nCount = $this->objFolder->Count();

		$arySubFolders = $this->objFolder->SubFolders();
		$aryItems = $this->objFolder->Items();
		$aryRefs = $this->objFolder->References();

		If	(count ($arySubFolders) != 0)
			$this->List_Items ($arySubFolders);

		if (count ($aryItems) != 0)
			$this->List_Items ($aryItems);

		if (count ($aryRefs) != 0)
			$this->List_Items ($aryRefs);
?>
	</table>
<?
	}

	// ============================================

	Function List_Items ($aryItems)
	{
		For ($t=1; $t<Count ($aryItems)+1; $t++)
		{
			$objItem = gblLadder()->getItem ($aryItems[$t]);
			$nID = $objItem->ID();
			$szName = $objItem->Name();
			$szDescription = $objItem->Description();
			$nClass = $objItem->getClass();
			$cPic = "";

			switch ($objItem->BaseType())
			{
				case ldrGlobals::cisRoot():
					$cPic = $this->picFolderClosed;
					break;

				case ldrGlobals::cisFolder():
					$cPic = $this->picFolderClosed;
					break;

				case ldrGlobals::cisItem():
					$cPic = $this->picItem;
					break;

				case ldrGlobals::cisReference():
					$cPic = $this->picReference;
					break;
		}
	?>
		<tr align="left">
			<td><?= $this->LinkTopic ($nID, $nID) ?></td>
			<td><?= $this->LinkPic ($nID, $cPic)  ?></td>
			<td><?= $this->LinkTopic ($nID, $szName) ?></td>
			<td><?= $szDescription ?></td>
			<td><?= $nClass ?></td>
		</tr>
	<?
		}
	}

	// ============================================

	Function LinkPic ($nID, $szImg)
	{
		$szRtn =
		"<A " .
			"name=\"" . $nID . "\" " .
			"HREF=\"" .
			"javascript:" . $this->getPanelName () . ".Selected " .
			"(" . $nID  . " )" .
			"\" >" .
			"<IMG SRC=\"" . $szImg . "\" border=0 >" .
		"</a>";

		return ($szRtn);
	}

	Function LinkTopic ($nID, $szTopic)
	{
		$szRtn =
			"<A HREF=\"" .
				"javascript:" . $this->getPanelName () . ".Selected " .
				"(" . $nID . " )" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}

	Function LinkFunction ($nID, $szTopic, $szFunction)
	{
		$szRtn =
			"<A HREF=\"" .
				"javascript:" . $this->getPanelName () . "." . $szFunction .
				"(" . $nID . " )" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}
	// ============================================
}

?>

