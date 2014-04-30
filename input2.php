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
		$user_result = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[myusername]'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
					$user = $row_user["id"];
				} 
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
		
		// save the data to the database
		mysql_query("INSERT miles SET 
			user='$user',
			month='$month',
			year='$year',
			date='$date',
			fromc='$desde', 
			toc='$hasta',
			amount='$amount',
			miles='$miles',
			notes='$notes'")
 

		or die(mysql_error()); 
	 
		// once saved, redirect back to the view page
		header("Location: input.php?m=".$m."&y=".$y); 
	 
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

		$user_result = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[myusername]'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
				$name = $row_user["name"];
				$last = $row_user["last"];
				$user = $row_user["id"];
				} 
				
		?>
		</head>
		<body>    
		<form action="" name="forma" id="forma" class="register" method="POST">
			<h1><?PHP echo $name." ".$last ?> - Milleage Report</h1>
				
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
						$result = mysql_query("SELECT * FROM miles WHERE month = $m and year = $y and user = $user")
								or die(mysql_error()); 

								// loop through results of database query, displaying them in the table
								while($row = mysql_fetch_array( $result )) 
									{
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
				
										printf("<tr bgcolor=eeeeee><td><input type=checkbox name=chk[] /></td><td align=center>%s</td><td align=center>%s</td><td align=center>%s</td><td align=right>%s</td><td align=right>%s</td><td>%s</td></tr>\n",
											$row["date"], $from, $to, $row["miles"], $row["amount"], $row["notes"]);
				
										$sum = $sum + $row["amount"];	
?>
<tr>
<td><input type="checkbox" name="users[]" value="<?php echo $row["id"]; ?>" ></td>
<td><?php echo $row["date"]; ?></td>
<td><?php echo $from; ?></td>
<td><?php echo $to; ?></td>
<td><a href="edit_user.php?userId=<?php echo $row["date"]; ?>" class="link"><img alt='Edit' title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10' /></a>  <a href="delete_user.php?userId=<?php echo $row["id"]; ?>"  class="link"><img alt='Delete' title='Delete' src='images/delete.png' width='15px' height='15px'hspace='10' /></a></td>
</tr>

<?PHP
									} 
										
		}						
		?>
						<tr>
							<td></td>
							<td align=center>Total:</td>
							<td></td>
							<td></td>
							<td></td>
							<td align=right><?PHP echo $sum ?></td>
							<td></td>
									<tr> </tr>
									<tr> </tr>
									<tr> </tr>
							
									<tr>
										<p>
											<td>
												<input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
											<td>
												<input size="15" name="date"" type="text" style="text-align:center" id="datepicker">
											</td>
											<td>
												<?PHP	
												$result_cf = mysql_query("SELECT * FROM cities");
												echo "<select name=Desde size=1 class=formulario_select2 onchange=calcula(forma.Desde.selectedIndex+1,forma.Hasta.selectedIndex+1,0.75)>";
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
												echo "<select name=Hasta size=1 class=formulario_select2 onchange=calcula(forma.Desde.selectedIndex+1,forma.Hasta.selectedIndex+1,0.75)>";
												while ($rowCt = mysql_fetch_array($result_ct)) 
												{
													echo "<option value='" . $rowCt['id'] . "'>" . $rowCt['city'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												<input name="Distance" class="formulario_text" style="text-align:center" value="0" size="10" type="text">
											</td>
											<td>
												<input name="Result" class="formulario_text" style="text-align:right" value="0.00" size="10" type="text">
											</td>
											<td>
												<input type="text" class="formulario_text"  name="notes">
											</td>
										</p>
									</tr>
					</tbody>
				</table>
				<div class="clear"></div>
			</fieldset>
			
			<p>
				<input type="submit" name="submit" value="Save Line" /> 
				<!--<input type="button" value="Edit Line" onClick="addRow('dataTable')" /> -->
				<!--<input type="button" value="Remove Line" onClick="deleteRow('dataTable')"  /> -->
					<p>(All actions apply only to entries with check marked check boxes only.)</p>
			</p>
			<!--<input class="submite" type="submite" value="Confirm &raquo;" />-->
			<!--<a class="submite" href="http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP"/>Back to</a>-->
			<!--<a class="submite" href="logout.php"/>Logout</a>-->
				
			<div class="clear"></div>
		</form>
		</body>
		</html>