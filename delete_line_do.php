		
<?PHP

	include ('scripts.php');
    include ('accesscontrol.php');
	   
		$id = $_GET['id'];
		$m = $_GET['m'];
		$y = $_GET['y'];
		
		// delete the data to the database
		mysql_query("DELETE FROM miles WHERE id = $id");

	 
		// once saved, redirect back to the view page
		header("Location: input.php?m=".$m."&y=".$y); 
	 
			
		?>
