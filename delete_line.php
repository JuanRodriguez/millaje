<!DOCTYPE html>
<html>
<head>

<?PHP

	include ('scripts.php');
//    include ('accesscontrol.php');

	require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php"); 

		$id = $_GET['id'];
		$m = $_GET['m'];
		$y = $_GET['y'];
		
?>

<script>
function delete_entry() {
			if (confirm("Confirm Delete. Click Ok to Proceed or Cancel to Abort.")) {
			window.location='delete_line_do.php?m=<?PHP echo $m . "&y=" . $y . "&id=" . $id?>';
			}
			else
			{window.location='input.php?m=<?PHP echo $m . "&y=" . $y ?>';
			}}
</script>
</head>

<body onload="delete_entry()">

</body>

</html>