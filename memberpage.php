<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//include header template
require('layout/header.php'); 
?>

<div class="container">

	<div class="row">
	
<?php 
	  include ('connect.php');
			$result = mysql_query("SELECT * FROM members WHERE username = :$user") 
			or die(mysql_error());  
			while($row_data = mysql_fetch_array( $result )) {
 			$name = $row_data['name'];
 			$last = $row_data['last'];
			}

echo $name ;?>

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>Member only page</h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>


</div>

<?php 
//include header template
require('layout/footer.php'); 
?>