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
				$name = $row_user["display_name"];
				$last = $row_user["display_last"];
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
		$date_full = mysql_real_escape_string(htmlspecialchars($_POST['date']));
		$month = substr($date_full, 0, -8);
		$year = substr($date_full, -2);
		$date = ($_POST['date']);
		$desde = ($_POST['Desde']);
		$hasta = ($_POST['Hasta']);
		$miles = ($_POST['Distance']);
		$amount = ($_POST['Result']);
		$notes = mysql_real_escape_string(htmlspecialchars($_POST['notes']));
		
		if ($m == $month)
		{ 
			if ($desde === $hasta)
			{ 
				$miles = 5;
			}

				$amount_calculated = $miles * $rate;

				// save the data to the database
				mysql_query("UPDATE miles SET 
					user='$user',
					month='$month',
					year='$year',
					date='$date',
					fromc='$desde', 
					toc='$hasta',
					amount='$amount_calculated',
					miles='$miles',
					notes='$notes'
					WHERE id='$id'")

				or die(mysql_error()); 
	 
				// once saved, redirect back to the view page
				header("Location: input.php?m=".$m."&y=".$y."&u=".$user); 
		}
		else
		{
			// not the same month, redirect back to the view page
			header("Location: not_the_same.php?m=".$m."&y=".$y."&u=".$user); 
		}
			
	 
	}
	else
	{
		$id = $_GET['id'];

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
							<th>Date</th>
							<th>From</th>
							<th>To</th>
							<th>Miles</th>
							<th>Amount</th>
							<th>Notes</th>
						</tr>

						<?PHP

						$sum = 0;
						$number = 0;
						$result = mysql_query("SELECT * FROM miles WHERE month = $m and year = $y and user = $user and id = $id")
								or die(mysql_error()); 

								// loop through results of database query, displaying them in the table
								while($row = mysql_fetch_array( $result )) 
									{
										$number = $number + 1;
										$from_original = $row['fromc'];
										$to_original = $row['toc'];
										//if ($row['status'] == 0)
										//{$status_name = "Inactive";}
										//else {$status_name = "Active";}

										$result_from = mysql_query("SELECT * FROM cities WHERE id = $row[fromc]")
										or die(mysql_error()); 
										// loop through results of database query, displaying them in the table
										while($row_from = mysql_fetch_array( $result_from )) 
											{
												$from = $row_from["city"];	
											} 
					
										$result_to = mysql_query("SELECT * FROM cities WHERE id = $row[toc]")
											or die(mysql_error()); 
						 
										// loop through results of database query, displaying them in the table
										while($row_to = mysql_fetch_array( $result_to )) 
											{
												$to = $row_to["city"];	
											} 
				
										printf("<tr bgcolor=eeeeee><td align=center>%s</td><td align=center>%s</td><td align=center>%s</td><td align=center>%s</td><td align=right>%s</td><td align=right>%s</td><td>%s</td></tr>\n",
											$number, $row["date"], $from, $to, $row["miles"], $row["amount"], $row["notes"]);
				
										$sum = $sum + $row["amount"];	

										$retreve_desde = mysql_query("SELECT * FROM cities WHERE city = '$from'")
										or die(mysql_error()); 
										// loop through results of database query, displaying them in the table
										while($row_retreve_desde = mysql_fetch_array( $retreve_desde )) 
											{
												$retreve_desde_converted = $row_retreve_desde["city"];	
											} 
											
										$retreve_hasta = mysql_query("SELECT * FROM cities WHERE city = '$to'")
										or die(mysql_error()); 
										// loop through results of database query, displaying them in the table
										while($row_retreve_hasta = mysql_fetch_array( $retreve_hasta )) 
											{
												$retreve_hasta_converted = $row_retreve_hasta["city"];	
											} 
											
										$retreve_fecha = $row["date"];
										$retreve_millas = $row["miles"];
										$retreve_cantidad = $row["amount"];
										$retreve_notas = $row["notes"];
										
									} 
										
	}						
	?>
						<tr>
							<td></td>
							<td align=center></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
									<tr> </tr>
									<tr> </tr>
									<tr> </tr>
							
									<tr>
										<p>
											<td>
												Edit:
											</td>
											<td>
												<input size="15" name="date"" type="text" value="<?php echo $retreve_fecha; ?>" style="text-align:center" id="datepicker">
											</td>
											<td>
												<?PHP	
												$result_cf = mysql_query("SELECT * FROM cities");
												echo "<select name=Desde size=1 class=formulario_select2 onchange=calcula(forma.Desde.selectedIndex+1,forma.Hasta.selectedIndex+1,".$rate.")>";
												//	echo "<option selected='selected' value='" . $from_original . "'>" . $retreve_desde_converted . "</option>";
												while ($rowCf = mysql_fetch_array($result_cf)) 
												{
													echo "<option value='" . $rowCf['id'] . "'>" . $rowCf['city'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												<?PHP	
												$result_ct = mysql_query("SELECT * FROM cities");
												echo "<select name=Hasta size=1 class=formulario_select2 onchange=calcula(forma.Desde.selectedIndex+1,forma.Hasta.selectedIndex+1,".$rate.")>";
												//	echo "<option selected='selected' value='" . $to_original . "'>" . $retreve_hasta_converted . "</option>";
												while ($rowCt = mysql_fetch_array($result_ct)) 
												{
													echo "<option value='" . $rowCt['id'] . "'>" . $rowCt['city'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												<input name="Distance" class="formulario_text" style="text-align:center" value="<?php echo $retreve_millas; ?>" size="10" type="text">
											</td>
											<td>

											</td>
											<td>
												<input type="text" class="formulario_text"  value="<?php echo $retreve_notas; ?>" onchange="calcula(forma.Desde.selectedIndex+1,forma.Hasta.selectedIndex+1,<?php echo $rate; ?>)" name="notes">
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