<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Sign Engineering - Mileage Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
		
<?PHP

	include ('scripts.php');
    include ('accesscontrol.php');
	   
	// check if the form has been submitted.
	if (isset($_POST['submit']))
	{ 	
				mysql_query("INSERT INTO payments SET 
					user='3',
					month='3',
					amount='13.13'")
				or die(mysql_error());		


				// redirect back to the view page
				header("Location: admin_search.php"); 
	}

		?>
		</head>
		<body>    
		<form action="" name="forma" id="forma" class="register" method="POST">
			<h1> - Post Payments</h1>
	
			<p>
				<input type="submit" name="submit" value="Post Payment" />
			</p>
				
			<div class="clear"></div>
		</form>
		</body>
		</html>