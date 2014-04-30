		
<?PHP

	include ('scripts.php');
//    include ('accesscontrol.php');
	require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php"); 
	   
//		$id = $_GET['id'];
		$m = $_GET['m'];
		$y = $_GET['y'];
		

		// once saved, redirect back to the view page
//		header("Location: input.php?m=".$m."&y=".$y); 

		?>

			<script langauge="JavaScript">
			function not_the_same2() {
			alert("Transaction not in the current month.");
			window.location='input.php?m=<?PHP echo $m . '&y=' . $y ?>';
			}
			</script>
			

			<body onload="not_the_same2()">
			</body>
