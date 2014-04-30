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
	if (isset($_POST['search']))
	{ 	
		$user_result = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[myusername]'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
					$user = $row_user["id"];
				} 
		$user_selected = ($_POST['user_selected']);
		$year_selected = ($_POST['year_selected']);
		$month_selected = ($_POST['month_selected']);
//<input type="button" name="link" value="Search" onclick="window.location='admin_search.php?m= echo $month_selected . '&y=' . $year_selected . '&u=' . $user_selected';"/>	
		
				// redirect back to the view page
				header("Location: admin_search.php?m=".$month_selected."&y=".$year_selected."&u=".$user_selected); 
		
			
	 
	}
	else
	{
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
			<h1><?PHP echo $name." ".$last ?> - Post Payments</h1>
				
			<fieldset class="row2">
				<legend>Report Details</legend>
				
				<table id="selectionTable" class="form" border="1">
					<tbody>


						<?PHP
	}						
	?>
						<tr>
									<tr>
										<p>
											<td>
												User:
											</td>
											<td>
												<?PHP	
												$result_user = mysql_query("SELECT * FROM users");
												echo "<select name=user_selected size=1 class=formulario_select2>";
												while ($row_result_user = mysql_fetch_array($result_user)) 
												{
													echo "<option value='" . $row_result_user['id'] . "'>" . $row_result_user['name'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												Year:
											</td>
											<td>
												<?PHP	
												$result_year = mysql_query("SELECT * FROM year");
												echo "<select name=year_selected size=1 class=formulario_select2>";
												while ($row_result_year = mysql_fetch_array($result_year)) 
												{
													echo "<option value='" . $row_result_year['id'] . "'>" . $row_result_year['year'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												Month:
											</td>
											<td>
												<?PHP	
												$result_months = mysql_query("SELECT * FROM months");
												echo "<select name=month_selected size=1 class=formulario_select2>";
												while ($row_result_months = mysql_fetch_array($result_months)) 
												{
													echo "<option value='" . $row_result_months['id'] . "'>" . $row_result_months['month'] . "</option>";
												}
												echo "</select>";
												?>
											</td>
											<td>
												<input type="submit" name="search" value="Search" />
											</td>
										</tr>

					</tbody>
				</table>
				<br>				
							<table id="summaryTable" class="form" border="1">
					<tbody>
						<tr>
							<td>Date</td>
							<td>Miles</td>
							<td>Expense</td>
							<td>Total</td>
							<td>Paid</td>
							<td>Balance</td>
						</tr>
						
					</tbody>
				</table>
				<br>
							<table id="paymentTable" class="form" border="1">
					<tbody>
				<tr>
										<p>
											<td>
												Check:
											</td>
											<td>
												<input size="15" name="date"" type="text" style="text-align:center" id="datepicker">
											</td>
<td>
												Date:
											</td>
											<td>
												<input size="15" name="date"" type="text" style="text-align:center" id="datepicker">
											</td>
<td>
												Amount:
											</td>
											<td>
												<input size="15" name="date"" type="text" style="text-align:center" id="datepicker">
											</td>											
									</tr>
</tbody>
				</table>									
									
				<div class="clear"></div>
			</fieldset>
			
			<p>
				<input type="submit" name="submit" value="Post Payment" />
				<input type="button" name="link" value="Back" onclick="window.location='index.php'"/>		
			
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