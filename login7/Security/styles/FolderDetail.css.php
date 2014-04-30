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

#<?= $szNameSpace ?>_Header { background-color:#CCCCCC; font-size:large; }
#<?= $szNameSpace ?>_EvenRow { background-color:#FFFFFF; }
#<?= $szNameSpace ?>_OddRow { background-color:#CCCCCC; }
