<?
/*	=======================================
	Copyright 1998 - 2010 - E Net Arch
	This program is distributed under the terms of the GNU
	General Public License (or the Lesser GPL).
	www.ENetArch.net
	======================================= */

	$szNameSpace = "ENetArch_Panel_Content";
	if (isset ($_REQUEST["szNameSpace"]))
		$szNameSpace = $_REQUEST["szNameSpace"];
?>

#<?= $szNameSpace ?>_Menu { width:100%; clear:both; border: 1px solid black; padding:4px;}
#<?= $szNameSpace ?>_VSpacer { clear:both; width:5px; height:5px; }
#<?= $szNameSpace ?>_Wrapper { float:left; width:900px; height:5px;}
#<?= $szNameSpace ?>_Left { min-width:20%; min-height:400px; float:left; border: 1px solid black; }
#<?= $szNameSpace ?>_HSpacer { float:left; width:5px; height:5px;}
#<?= $szNameSpace ?>_Content { min-width:75%; min-height:400px; float:left; border: 1px solid black; }
