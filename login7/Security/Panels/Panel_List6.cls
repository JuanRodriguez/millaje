<?
/*	=======================================
	Copyright 1998, 2000, 2003, 2007, 2009 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Panels_Common_List Extends ENetArch_Panel
{
	private $nTotal = 0;
	
	private $rowPanel = null;
	private $fldrTarget = null;
	
	public $nPerPage = 0;
	public $nCurrentPage = 0;
	
	public $bShowNPos = false;

	function setPanelName ($thsName)
	{ 
		parent::setPanelName ($thsName);
		if ($this->rowPanel != null)
			$this->rowPanel->setPanelName ($thsName);
	}
	
	function setRowPanel ($thsPanel)
	{
		$this->rowPanel = $thsPanel;
		$this->rowPanel->setPanelName ($this->getPanelName());
	}
	
	function setFolder (ldrFolder $thsFolder)
	{ $this->fldrTarget = $thsFolder; }

	// ==========================================

	function getSession ()
	{
		if (isset ($_SESSION [$this->getPanelID()]['nCurrentPage']))
			$this->nCurrentPage = $_SESSION [$this->getPanelID()]['nCurrentPage'] ;

		if (isset ($_SESSION [$this->getPanelID()]['nPerPage']))
			$this->nPerPage = $_SESSION [$this->getPanelID()]['nPerPage'] ;
	}
	
	function setSession()
	{
		$_SESSION [$this->getPanelID()]['nCurrentPage'] = $this->nCurrentPage;
		$_SESSION [$this->getPanelID()]['nPerPage'] = $this->nPerPage;
	}
	
	function getPOST ()
	{
		if (isset ($_POST [$this->getPanelID() . '_nPage']))
			$this->nCurrentPage = $_POST [$this->getPanelID() . '_nPage'];

		if (isset ($_POST [$this->getPanelID() . '_nPerPage']))
			$this->nPerPage = $_POST [$this->getPanelID() . '_nPerPage'];
	}

	// ==========================================
	
	function drawPanel ()
	{
		if (trim ($this->getPanelName()) == "") return;
		if ($this->rowPanel == null) return;
		if ($this->fldrTarget == null) return;
		
		if ($this->nPerPage == 0) $this->nPerPage = 10;
		if ($this->nCurrentPage < 1) $this->nCurrentPage = 1;

		print ("<table ID=\"". $this->getPanelID() ."\">\n");
		$this->drawHeader ();
		
		$this->nTotal = $this->fldrTarget->Count();
		if ($this->nTotal == 0) $this->drawNonFound ();

		if (($this->nCurrentPage * $this->nPerPage) > $this->nTotal)
			$this->nCurrentPage = 1;
			
		$nStart = $this->nPerPage * ($this->nCurrentPage -1); 
		$nStop = $this->nPerPage * $this->nCurrentPage;
		
		$nStart = max (0, $nStart);
		$nStop = min ($this->nTotal, $nStop);
		
		for ($t=$nStart; $t<$nStop; $t++)
			$this->drawLine ($t+1); 
		
		print ("</table>\n");
	}
	
	function drawHeader ()
	{
		if (!$this->rowPanel->hasHeaders()) return;

		$nColumns = $this->rowPanel->hdrColCount();
		$nRows = $this->rowPanel->hdrRowCount();

		for ($y=0; $y<$nRows; $y++)
		{
			print ("<tr ID=\"" . $this->getPanelID() . "_Header\">\n");

			if ($y == 0)
			{
				print (
					"<th>" .
					"<input type=\"checkbox\" name=\"" . $this->getPanelID() . "_ID[]\" ".
					"value=\"0\" ".
					"onChange=\"" . $this->getPanelName() . ".onCheckID(this);\">" .
					"</th>\n");
			}
			else
			{
				print ("<td></td>\n");
			}

			for ($x=0; $x<$nColumns; $x++)
				$this->rowPanel->drawColumnHeader ($x, $y);

			print ("</tr>\n");
		}
	}
	
	function drawNonFound ()
	{ 
		print ("<tr ID=\"" . $this->getPanelID() . "nonFound" . "\">\n");
				print ( "<td> &nbsp; </td>\n");

		$this->rowPanel->drawNonFound(); 
		print ("</tr>\n");	
	}

	function drawLine ($nPos)
	{
		$itmItem = $this->fldrTarget->Item ($nPos);
		
		$this->rowPanel->setPanel ($itmItem);
		
		$nColumns = $this->rowPanel->dataColCount();
		$nRows = $this->rowPanel->dataRowCount();

		$szEvenOdd = iif ( ($nPos % 2), "_EvenRow", "_OddRow");
		
		for ($y=0; $y<$nRows; $y++)
		{
			if ($y == 0)
			{
				print ("<tr ID=\"" . $this->getPanelID() . $szEvenOdd . "\">\n");
				print (
					"<td>" . 
					"<input type=\"checkbox\" name=\"" . $this->getPanelID() . "_ID[]\" ".
					"value=\"" . $nPos . "\" " .
					"onChange=\"" . $this->getPanelName() . ".onCheckID(this);\">" .
					"</td>\n");
			}
			else
			{
				print ("<tr ID=\"" . $this->getPanelID() . $szEvenOdd . "\">\n");
				print ("<td></td>\n");
			}
			
			for ($x=0; $x<$nColumns; $x++)
				$this->rowPanel->drawCell ($x, $y);

			print ("</tr>\n");	
		}
	}
	
	// ==========================================
	
	function drawNavigation ()
	{
		if ($this->nCurrentPage-1 > 0) $this->printLink ("|<", 1);
		if ($this->nCurrentPage-10 > 0) $this->printLink ("<<", $this->nCurrentPage-100);
		if ($this->nCurrentPage-1 > 0) $this->printLink ("<", $this->nCurrentPage-10);
		
		$nStart = $this->nCurrentPage -5;
		$nStop = $this->nCurrentPage +5;
		
		$nStart = max (1, $nStart);
		$nStop = min ($this->nTotal / $this->nPerPage, $nStop);
		
		for ($t=$nStart; $t<$nStop; $t++)
			$this->printLink ($t, $t);
			
		if ($this->nCurrentPage+1 < $this->nTotal) $this->printLink (">", $this->nCurrentPage+1);
		if ($this->nCurrentPage+10 < $this->nTotal) $this->printLink (">>", $this->nCurrentPage+1);
		if ($this->nCurrentPage+1 < $this->nTotal) $this->printLink (">|", $this->nTotal);

?>
	<tr>
	  <td><input type="hidden" name="<?= $this->getPanelID() . '_nPage' ?>" ID="<?= $this->getPanelID() . '_nPage' ?>"  value="<?= $this->nCurrentPage ?>" ></td>
	</tr>
<?
	}
	
	function printLink ($szText, $nValue)
	{
		print ("<a href=\"javascript:void(0);\" name=\"" . $this->getPanelID() . "_thsPage" . 
			"\" onClick=\"" . $this->getPanelName() . ".gotoPage($nValue)\">
			$szText</a>\n");
	}
	
	function drawPerPage ()
	{
?>
		<select name="<?= $this->getPanelID() . "_nPerPage" ?>" onChange="<?= $this->getPanelName() ?>.pageSize()">
			<option value="10" <?= iif (($this->nPerPage==10), "SELECTED", "")  ?> >10</option>
			<option value="20" <?= iif (($this->nPerPage==20), "SELECTED", "")  ?> >20</option>
			<option value="50" <?= iif (($this->nPerPage==50), "SELECTED", "")  ?> >50</option>
			<option value="100" <?= iif (($this->nPerPage==100), "SELECTED", "")  ?> >100</option>
		</select>
<?
	}
}

/* ======================================
Version Updates

2010-06-30 - added function  drawNonFound ()
	this properly displays the message that no rows were found to
	display in the list.
	

	======================================
*/

