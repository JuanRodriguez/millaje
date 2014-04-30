<?

	function dirPath() { return ("../../../"); }

	include_once (dirPath() . "Marketing/Security/rootFolder.php");
	include_once (dirPath() . "Shared/Classes/Ladder/Ladder_Ladder.cls");
	include_once (dirPath() . "Marketing/Security/Classes/Security_Security.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_Panel.cls");
	include_once (dirPath() . "Marketing/Security/Panels/Panel_TriView.cls");
	include_once (dirPath() . "Shared/_app.inc");

Function php_Main ()
{
	$nID = 0;
	if (isset ($_GET ['nID']))
		$nID = $_GET ["nID"];


	// =======================================
	// Application Root Directory

	$fldrRoot = rootFolder();

	// =======================================
	// find Security Folder

	$fldrSecurity = new ENetArch_Security_Security ();
	$fldrSecurity->setState ($fldrRoot);

	$nID = $fldrSecurity->ID();

	// ========================================

	$pnlTriView = new ENetArch_Panel_TriView ();

	$pnlTriView->setPanel_Menu ("view_Menu.php");
	$pnlTriView->setPanel_Left ("view_Left.php");
	$pnlTriView->setPanel_Content ("_view.php");

	$pnlTriView->setPanelName ("ENetArch.Security");
	$pnlTriView->setPanel ($fldrSecurity);

	// ========================================

?>
<html>

<script> var pagePath = function () { return ("<?= pagePath() ?>"); }; </script>
<!--
<script src="<?= pagePath () ?>Shared/ajax.js"></script>
<script src="<?= pagePath () ?>Shared/jquery_lite.js"></script>
<script src="<?= pagePath () ?>Shared/_ENetArch.js"></script>
<script src="<?= pagePath () ?>Shared/_menus2.js"></script>
-->
<script>
<?
include_once (pagePath () . "Shared/ajax.js");
include_once (pagePath () . "Shared/jquery_lite.js");
include_once (pagePath () . "Shared/_ENetArch.js");
include_once (pagePath () . "Shared/_menus2.js");
include_once (pagePath () . "Marketing/Security/Admin/trgrs_Security.js.php");
include_once (pagePath () . "Marketing/Security/Admin/trgrs_Menus.js.php");
include_once (pagePath () . "Marketing/Security/Admin/trgrs_Left.js.php");
include_once (pagePath () . "Marketing/Security/Admin/trgrs_Content.js.php");
?>
</script>

<body id="body">
<? $pnlTriView->drawPanel(); ?>

<div style="clear:both; width:5px; height:400px;"></div>
<div style="min-width:75%; float:left; border: 1px solid black; "><?= memory_get_usage() ?></div>
</body>

<style type="text/css">
	@import url("<?= pagePath () ?>shared/styles.css");
	@import url("<?= pagePath () ?>Marketing/Security/Styles/TriView.css.php?szNameSpace=<?=$pnlTriView->getPanelID() ?>&");
</style>

</html>
<?
}
?>