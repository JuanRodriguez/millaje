<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU 
	General Public License (or the Lesser GPL).
	======================================= */

Class ENetArch_Panel
{
	Private $szPanelName = "";
	
	// =======================================
	
	Function __Construct () { $this->setPanelName ("ENetArch.Panel"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function setPanelName ($thsName)
	{ 	$this->szPanelName = $thsName; }
	
	Function getPanelName () { return ( $this->szPanelName); }
	Function getPanelID() { return ( strtr ( $this->szPanelName, ".", "_")); }
	
	Function getSession () {}
	Function setSession () {}
	Function getPOST () {}
	Function getGETs () {}
	
	Function setPanel ($thsObject) {}
	Function updateObject ($thsObject) {}
	Function clearPanel () {}

	Function drawPanel () {}
}


Class ENetArch_Panel_List Extends ENetArch_Panel
{	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.List"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function hasHeaders () { return (false); }
	
	Function colCount() { return (0); }
	Function rowCount() { return (0); }
	
	Function drawColumnHeader ($x) { }

	Function drawCell ($x, $y) { }
}

Class ENetArch_Panel_List2 Extends ENetArch_Panel
{	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.List"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function hasHeaders () { return (false); }
	
	Function hdrColCount() { return (0); }
	Function hdrRowCount() { return (0); }
	
	Function dataColCount() { return (0); }
	Function dataRowCount() { return (0); }
	
	Function drawHdrCell ($x, $y) { }
	Function drawRowCell ($x, $y) { }
	
	Function drawNonFound ()
	{ print ("No Items were found"); }
}

Class ENetArch_Panel_List3 Extends ENetArch_Panel
{	
	// =======================================
	
	Function __Construct () { parent::setPanelName ("ENetArch.Panel.List"); }
	Function ENetArch_Panel () { __Construct(); }
	
	// =======================================
	
	Function hasHeaders () { return (false); }
	
	Function hdrColCount() { return (0); }
	Function hdrRowCount() { return (0); }
	
	Function dataColCount() { return (0); }
	Function dataRowCount() { return (0); }
	
	Function drawHdrCell ($x, $y) { }
	Function drawRowCell ($nRow, $x, $y) { }
	
	Function drawNonFound ()
	{ print ("No Items were found"); }
}

/* ======================================
Version Updates

2010-06-30 - added function  drawNonFound ()
	this properly displays the message that no rows were found to
	display in the list.

2010-07-08 - added function  getGETs ()
	this retrieves variables from the URL

2010-07-17 - added constructors to the classes to set the class
	name to default names.
	
2010-07-22 - extended the dataHdrCell and dataRowCell to include 
	which row the list was drawing.  That way the information can be 
	used in links by the row and fed back into the system.
	
	======================================
*/
?>
