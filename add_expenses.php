<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Sign Engineering - Mileage Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
		
<?PHP

	include ('scripts.php');
//    include ('accesscontrol.php');

	include ('connect.php');
		  
	require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php"); 
	   
	// check if the form has been submitted.
	if (isset($_POST['submit']))
	{ 	
		$user_result = mysql_query("SELECT * FROM uc_users WHERE user_name = '$loggedInUser->username'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
				$user = $row_user["id"];
				
				$rate_result = mysql_query("SELECT * FROM uc_user_rate WHERE user_id = '$user'")
					or die(mysql_error()); 
								 
					// loop through results of database query, displaying them in the table
					while($row_rates = mysql_fetch_array( $rate_result )) 
					{
						$rate_final = mysql_query("SELECT * FROM uc_rates WHERE  id = '$row_rates[rate]'")
						or die(mysql_error()); 
									 
						// loop through results of database query, displaying them in the table
						while($row_rate = mysql_fetch_array( $rate_final )) 
						{
						$rate = $row_rate["rate"];
						} 
					} 
				} 

		$id = $_GET['id'];
		$m = $_GET['m'];
		$y = $_GET['y'];
		$type = ($_POST['type']);
		$amount = ($_POST['amount']);
		$notes = mysql_real_escape_string(htmlspecialchars($_POST['note']));

				// save the data to the database
				mysql_query("INSERT expenses SET 
					user='$user',
					month='$m',
					year='$y',
					type='$type',
					amount='$amount',
					notes='$notes'")

				or die(mysql_error()); 
	 
				// once saved, redirect back to the view page
				header("Location: add_expenses.php?m=".$m."&y=".$y."&u=".$user); 
		
			
	 
	}
	else
	{
		$m = $_GET['m'];
		$month_result = mysql_query("SELECT * FROM months WHERE id = $m");
		while($row_month = mysql_fetch_array( $month_result )) 
			{
			$month = $row_month["month"];
			} 

		$y = $_GET['y'];
		$year_result = mysql_query("SELECT * FROM year WHERE id = $y");
		while($row_year = mysql_fetch_array( $year_result )) 
			{
			$year = $row_year["year"];
			} 		

		$user_result = mysql_query("SELECT * FROM uc_users WHERE user_name = '$loggedInUser->username'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
				$name = $row_user["display_name"];
				$last = $row_user["display_last"];
				$user = $row_user["id"];
				} 
				
		?>
		</head>
		<body>    
		<form action="" name="forma" id="forma" class="register" method="POST">
			<h1><?PHP echo $name." ".$last ?> - Mileage Report</h1>
				
			<fieldset class="row2">
				<legend>Report Details</legend>
				<p> 
					<label for="year">Year: <?PHP echo $year ?></label>
					<label for="mes">Month: <?PHP echo $month ?></label>
				</p>
				
				<table id="dataTable" class="form" border="1">
					<tbody>
						<tr>
							<th> </th>
							<th>Type</th>
							<th>Amount</th>
							<th>Notes</th>
						</tr>

						<?PHP

						$sum = 0;
						$number = 0;
						$result = mysql_query("SELECT * FROM expenses WHERE month = $m and year = $y and user = $user")
								or die(mysql_error()); 

								// loop through results of database query, displaying them in the table
								while($row = mysql_fetch_array( $result )) 
									{
										$number = $number + 1;
										$type = $row['type'];
										$amount = $row['amount'];
										$notes = $row['notes'];
										//if ($row['status'] == 0)
										//{$status_name = "Inactive";}
										//else {$status_name = "Active";}

										$result_type = mysql_query("SELECT * FROM expenses_types WHERE id = $type")
										or die(mysql_error()); 
										// loop through results of database query, displaying them in the table
										while($row_type = mysql_fetch_array( $result_type )) 
											{
												$type_name = $row_type["type"];	
											} 
	
										printf("<tr bgcolor=eeeeee><td align=center>%s</td><td align=center>%s</td><td align=right>%s</td><td>%s</td></tr>\n",
											$number, $type_name, $amount, $notes);
				
										$sum = $sum + $amount;	

										
									} 
										
	}						
	?>
						<tr>
							<td></td>
							<tr> </tr>
							<td></td>
							<td align=center>Sub-Total:</td>
							<td align=right><?PHP echo number_format($sum,2); ?></td>
							<tr> </tr>
							<tr> </tr>
									<tr> </tr>
							
									<tr>
										<p>
											<td>
												Expense:
											</td>
											
											<td>
												<?PHP	
												$result_types = mysql_query("SELECT * FROM expenses_types");
												echo "<select name=type size=1 class=formulario_select2>";
												while ($row_result_types = mysql_fetch_array($result_types)) 
												{
													echo "<option value='" . $row_result_types['id'] . "'>" . $row_result_types['type'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												<input name="amount" class="formulario_text" style="text-align:right" value="0.00" size="10" type="text">
											</td>
											<td>
												<input name="note" type="text" class="formulario_text"  value="">
											</td>
										</p>
									</tr>


					</tbody>
				</table>
				<div class="clear"></div>
			</fieldset>
			
			<p>
				<input type="submit" name="submit" value="Save Line" />
				<input type="button" name="link" value="Back" onclick="window.location='input.php?m=<?PHP echo $m."&y=".$y ?>';"/>		
			
				<!--<input type="button" value="Edit Line" onClick="addRow('dataTable')" /> -->
				<!--<input type="button" value="Remove Line" onClick="deleteRow('dataTable')"  /> -->
				<!--<p>(All actions apply only to entries with check marked check boxes only.)</p> -->
				<p></p>
			</p>
			<!--<input class="submite" type="submite" value="Confirm &raquo;" />-->
			<!--<a class="submite" href="http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP"/>Back to</a>-->
			<!--<a class="submite" href="logout.php"/>Logout</a>-->
				
			<div class="clear"></div>
		</form>
		</body>
		</html>