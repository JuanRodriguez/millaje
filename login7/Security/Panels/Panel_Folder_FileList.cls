<?
Class ENetArch_Panel
{
	Private $szPanelName = "";

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
?>