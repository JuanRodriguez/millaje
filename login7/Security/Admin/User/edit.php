<?
	function dirPath() { return ("../../../"); }
	function pagePath() { return ($_SESSION['pagePath']); }

	include_once (dirPath() . "Shared/Panels/Common/Name/edit.inc");
	include_once (dirPath() . "Shared/Panels/Common/Address/edit.inc");
	include_once (dirPath() . "Shared/Panels/Common/Contacts/edit.inc");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	global $gblLadder;

	$nID = 0;
	$bStatus = "";
	$aryTargetIDs = Array();

	if (isset ($_GET ['nID']))
		$nID = $_GET ["nID"];

	$objFolder = $gblLadder->getItem ($nID);
	$nID = $objFolder->ID();

?>

<html>
<head>
<title>Ladder View</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<? ENetArch.Panels.Common.Name.edit (); ?>
<? ENetArch.Panels.Common.Address.edit (); ?>
<? ENetArch.Panels.Common.Contacts.edit (); ?>
</body>
</html>
}
?>
