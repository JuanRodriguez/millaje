<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

class ENetArch_Panels_Ladder_Properties Extends ENetArch_Panel
{
	private $objItem = null;
	
	// ==============================================
	
	Function setPanel ($thsObject) 
	{
		if ($thsObject == null) return;

		$this->objItem = $thsObject;
	}

	Function clearPanel ()
	{	$this->objItem = null;	}
	
	// ==============================================

	Function drawHeader ()	{	}
	
	Function drawPanel ()
	{
?>
	<table id="<?= $this->getPanelName() ?>_Name">
		<tr>
			<th>Parent:</th>
			<td><?= $this->LinkTopic ($this->objItem->Parent (), $this->objItem->Parent ()) ?></td>
		</tr>
		<tr>
			<th>Name:</th>
			<td><?= $this->objItem->Name() ?></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td><?= $this->objItem->Description() ?></td>
		</tr>
		<tr>
			<th>Created:</th>
			<td><?= $this->objItem->Created() ?></td>
		</tr>
		<tr>
			<th>BaseType:</th>
			<td><?= $this->objItem->BaseType() ?></td>
		</tr>
		<tr>
			<th>Class:</th>
			<td><?= $this->objItem->getClass() ?></td>
		</tr>
		
	</table>
<?
	}
	
	Function drawPanel_Edit ()	{ }	
	
	// =============================================
	
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

}
?>