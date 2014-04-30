<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Sign Engineering - Mileage Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
		<script type="text/javascript" src="js/script.js"></script> 

		
		<?PHP

			
//				include ('scripts.php');

   // include ('accesscontrol.php');
//	  include ('connect.php');

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php"); 
  
	  
	  
	//	$user_result = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[myusername]'")
	//				or die(mysql_error()); 

							 
					 // loop through results of database query, displaying them in the table
    //    while($row_user = mysql_fetch_array( $user_result )) 
	//		{
	//		$name = $row_user["name"];
	//		$last = $row_user["last"];
	//		$user = $row_user["id"];
	//		} 

//		$user_result = mysql_query("SELECT * FROM members WHERE username = '$_SESSION[myusername]'")
	//				or die(mysql_error()); 

							 
					 // loop through results of database query, displaying them in the table
//        while($row_user = mysql_fetch_array( $user_result )) 
//			{
//			$name = $row_user["name"];
//			$last = $row_user["last"];
//			$user = $row_user["id"];
//			} 	

?>
</head>
<body>    
	<form action="" name="forma" id="forma" class="register" method="POST">
        <h1><?PHP echo $name." ".$last ?> - Mileage Report</h1>
			
        <fieldset class="row2">
		<legend>Report Details</legend>
		<p> 
			<label for="year">Year</label>
			<select id="year" name="year" required="required">
				<option>....</option>
                <option value="13">2013 </option>
                <option selected="selected" value="14">2014 </option>
			</select>

			<label for="mes">Month</label>
			<select id="mes" name="mes" required="required">
                <option selected="selected" value="1">January </option>
                <option value="2">February </option>
                <option value="3">March </option>
                <option value="4">April </option>
                <option value="5">May </option>
                <option value="6">June </option>
                <option value="7">July </option>
                <option value="8">August </option>
                <option value="9">September </option>
                <option value="10">October </option>
                <option value="11">November </option>
                <option value="12">December .</option>
			</select>
</p>
		<br>
<p>
<p>		
<input type="submit" name="submit" value="Continue...">
</p>
	
	<p>
		
<input type="submit" name="submit2" value="Reports">
</p>
<p>
		
<input type="submit" name="submit3" value="Logout">
</p>
</p>			
				
		<div class="clear"></div>
        </fieldset>

			
			<div class="clear"></div>
	</form>

</body>

</html>

		<?PHP

			
	
	
// check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 $y = mysql_real_escape_string(htmlspecialchars($_POST['year']));
 $m = mysql_real_escape_string(htmlspecialchars($_POST['mes']));
 
 // once saved, redirect back to the view page
 header("Location: input.php?m=".$m."&y=".$y); 

}

// check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit3']))
 { 
 
 // once saved, redirect back to the view page
 header("Location: logout.php"); 

}

?>
 






