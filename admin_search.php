<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Sign Engineering - Mileage Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
		
<?PHP

	include ('scripts.php');
    include ('accesscontrol.php');
	   
	// check if the form has been submitted for payment
	if (isset($_POST['submit']))
	{ 	
		// get the URL passed values and the posted values
		$user_selected = $_GET['u'];
		$year_selected = $_GET['y'];
		$month_selected = $_GET['m'];
		$post_check = ($_POST['post_check']);
		$post_date = ($_POST['post_date']);
		$post_amount = ($_POST['post_amount']);

		// post the payment data, on the payments table
		mysql_query("INSERT payments SET 
			user='$user_selected',
			month='$month_selected',
			year='$year_selected',
			cheque='$post_check',
			date='$post_date',
			amount='$post_amount'")
			or die(mysql_error());		

		// loop to get the post id, from the posted payment
		$check_result = mysql_query("SELECT * FROM payments WHERE cheque = '$post_check' ")
			or die(mysql_error()); 
		while($row_check_result = mysql_fetch_array( $check_result )) 
			{
				$check_result_id = $row_check_result["id"];
			} 					

		// loop to get all the miles lines, related to the payment
		$get_lines = mysql_query("SELECT * FROM miles WHERE user = '$user_selected' and month = '$month_selected' and year = '$year_selected' ")
			or die(mysql_error()); 
			while($row_get_lines = mysql_fetch_array( $get_lines )) 
				{
				// query to post the payment_id and payment_amount, on the miles lines related to the payment
				mysql_query("UPDATE miles SET 
					status='2',
					payment_id='$check_result_id',
					payment_amount='$row_get_lines[amount]'
					WHERE id = '$row_get_lines[id]' ")
					or die(mysql_error()); 
				} 					

		// loop to get all the expense lines, related to the payment
		$get_expenses = mysql_query("SELECT * FROM expenses WHERE user = '$user_selected' and month = '$month_selected' and year = '$year_selected' ")
			or die(mysql_error()); 
			while($row_get_expenses = mysql_fetch_array( $get_expenses )) 
				{
				// query to post the payment_id and payment_amount, on the expense lines related to the payment
				mysql_query("UPDATE expenses SET 
					status='2',
					payment_id='$check_result_id',
					payment_amount='$row_get_expenses[amount]'
					WHERE id = '$row_get_expenses[id]' ")
					or die(mysql_error()); 
				} 		
	
		// redirect back to the admin_search page
		header("Location: admin_search.php?m=".$month_selected."&y=".$year_selected."&u=".$user_selected); 
	 
	}else
	{

	// check if the form has been submitted for search
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
		$user_selected = $_GET['u'];
		$year_selected = $_GET['y'];
		$month_selected = $_GET['m'];		

		$user_result = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[myusername]'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_user = mysql_fetch_array( $user_result )) 
				{
				$name = $row_user["name"];
				$last = $row_user["last"];
				$user = $row_user["id"];
				} 

		$month_result = mysql_query("SELECT * FROM months WHERE id = '$month_selected'")
			or die(mysql_error()); 
								 
			 // loop through results of database query, displaying them in the table
			while($row_month_result = mysql_fetch_array( $month_result )) 
				{
				$month_selected_name = $row_month_result["month"];
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
							<td align=center><b><u>User</b></u></td>
							<td align=center><b><u>Date</b></u></td>
							<td align=center><b><u>Miles</b></u></td>
							<td align=center><b><u>Expense</b></u></td>
							<td align=center><b><u>Total</b></u></td>
							<td align=center><b><u>Paid</b></u></td>
							<td align=center><b><u>Balance</b></u></td>
							<td align=center><b><u></b></u></td>
							<td align=center><b><u>Check</b></u></td>
							<td align=center><b><u>Date</b></u></td>
							<td align=center><b><u>Amount</b></u></td>
						</tr>

						<?PHP
						$sum_of_miles = 0;
						$sum_of_payments = 0;
						$payments_id = 0;
						$payment_check = 0;
						$payment_date = 0;
						$payment_amount = 0;
						
						// loop to get user name on the dropdown
						$report_user_result = mysql_query("SELECT * FROM users WHERE id = '$user_selected'")
							or die(mysql_error()); 
						while($row_report_user_result = mysql_fetch_array( $report_user_result )) 
							{
								$report_user = $row_report_user_result["name"];
							} 

						// loop to get all the miles lines and the sum of their amount and payments
						$miles_result = mysql_query("SELECT * FROM miles WHERE user = '$user_selected' and month = '$month_selected' and year = '$year_selected'")
							or die(mysql_error()); 
						while($row_miles_result = mysql_fetch_array( $miles_result )) 
							{
								$sum_of_miles = $sum_of_miles + $row_miles_result["amount"];
								$sum_of_payments = $sum_of_payments + $row_miles_result["payment_amount"];
								// condition to get the last valid payment_id
								if ( $row_miles_result['payment_id'] > 0 )
									{
										$payment_id = $row_miles_result['payment_id'];
						
										// loop to get the payment info of the last payment_id
										$payments_result = mysql_query("SELECT * FROM payments WHERE id = '$payment_id'")
											or die(mysql_error()); 
										while($row_payments_result = mysql_fetch_array( $payments_result )) 
											{
												$payment_check = $row_payments_result["cheque"];
												$payment_date = $row_payments_result["date"];
												$payment_amount = $row_payments_result["amount"];
											} 
									} 
							}
				
						$sum_of_expenses = 0;

						// loop to get all the expense lines and the sum of their amount and payments						
						$expenses_result = mysql_query("SELECT * FROM expenses WHERE user = '$user_selected' and month = '$month_selected' and year = '$year_selected'")
							or die(mysql_error()); 
						while($row_expenses_result = mysql_fetch_array( $expenses_result )) 
							{
								$sum_of_expenses = $sum_of_expenses + $row_expenses_result["amount"];
								$sum_of_payments = $sum_of_payments + $row_expenses_result["payment_amount"];
							} 

						$sum_total = $sum_of_miles + $sum_of_expenses;

						$balance = $sum_total - $sum_of_payments;
						
						?>

						<tr>
							<td align=center><?PHP echo $report_user; ?></td>
							<td align=center><?PHP echo $month_selected_name; ?></td>
							<td align=right><?PHP echo number_format($sum_of_miles,2); ?></td>							
							<td align=right><?PHP echo number_format($sum_of_expenses,2); ?></td>
							<td align=right><?PHP echo number_format($sum_total,2); ?></td>
							<td align=right><?PHP echo number_format($sum_of_payments,2); ?></td>
							<td align=right><?PHP echo number_format($balance,2); ?></td>
							<td align=right></td>
							<td align=center><?PHP echo $payment_check; ?></td>
							<td align=center><?PHP echo $payment_date; ?></td>
							<td align=right><?PHP echo number_format($payment_amount,2); ?></td>
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
												<input size="15" name="post_check" type="text" style="text-align:center">
											</td>
<td>
												Date:
											</td>
											<td>
												<input size="15" name="post_date" type="text" style="text-align:center" id="datepicker">
											</td>
<td>
												Amount:
											</td>
											<td>
												<input size="15" name="post_amount" type="text" style="text-align:center">
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