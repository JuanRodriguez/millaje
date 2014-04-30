<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

Class ENetArch_Panel_Folder_DetailList2 extends ENetArch_Panel_List3
{
	private $objItem = null;
	private $nID = 0;
	
	public $picFolderOpen = "";
	public $picFolderClosed = "";
	public $picItem = "";
	public $picReference = "";
	public $picEmpty = "";

	Function __Construct () { parent::setPanelName ("ENetArch.Panel.Folder.DetailList"); }
	Function ENetArch_Panel_ClassList () { __Construct(); }

	// ===========================================

	Function setPanel ($thsObject)
	{
		$this->objItem = $thsObject;
		$this->cPic = "";

		switch ($thsObject->BaseType())
		{
			case ldrGlobals::cisRoot():
				$this->cPic = $this->picFolderClosed;
				break;

			case ldrGlobals::cisFolder():
				$this->cPic = $this->picFolderClosed;
				break;

			case ldrGlobals::cisItem():
				$this->cPic = $this->picItem;
				break;

			case ldrGlobals::cisReference():
				$this->cPic = $this->picReference;
				break;
		}
	}

	Function clearPanel ()
	{
		$this->objItem = null;
		
		$this->picFolderOpen = "";
		$this->picFolderClosed = "";
		$this->picItem = "";
		$this->picReference = "";
		$this->picEmpty = "";		
	}

	// ===========================================

	Function hasHeaders () { return (true); }
	
	Function hdrColCount() { return (5); }
	Function hdrRowCount() { return (1); }
	
	Function dataColCount() { return (5); }
	Function dataRowCount() { return (1); }
	
	Function drawHdrCell ($x, $y) 
	{ 
		switch ($x)
		{
			case 0: print ("<td>" . $this->LinkFunction ("ID", "SortBy_ID") . "</td>");  break;
			case 1: 
			{
				$szImage = "<IMG SRC=\"" . $this->picFolderClosed . "\" border=\"0\" >";
				print ("<td>" . $this->LinkFunction ($szImage, "SortBy_BaseType") . "</td>"); 
				break;
			}
			case 2: print ("<td>" . $this->LinkFunction ("Name", "SortBy_Name")  . "</td>"); break;
			case 3: print ("<td>" . $this->LinkFunction ("Description", "SortBy_Description")  . "</td>");  break;
			case 4: print ("<td>" . $this->LinkFunction ("Class", "SortBy_Class")  . "</td>"); break;
		}
	}
	
	Function drawRowCell ($nRow, $x, $y) 
	{ 
		$nID = $this->objItem->ID();
		
		switch ($x)
		{
			case 0: print ("<td>" . $this->LinkTopic ($nID, $nID)  . "</td>");  break;
			case 1: print ("<td>" . $this->LinkPic ($nID, $this->cPic)  . "</td>"); break;
			case 2: print ("<td>" . $this->LinkTopic ($nID, $this->objItem->Name() )  . "</td>"); 		break;
			case 3: print ("<td>" . $this->objItem->Description()  . "</td>");  break;
			case 4: print ("<td>" . $this->objItem->getClass()  . "</td>"); break;
		}
	}
	
	Function drawNonFound ()
	{ print ("No Items were found"); }

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

	Function LinkFunction ($szTopic, $szFunction)
	{
		$szRtn =
			"<A HREF=\"" .
				"javascript:" . $this->getPanelName () . "." . $szFunction .
				"()" .
				"\" >" .
				$szTopic .
			"</a>";

		return ($szRtn);
	}
	
	// ============================================
}

?>

