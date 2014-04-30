<?php

/**
 *	Install MySQL DB for use with the LoginScript
 */

////////////////////////////////////////////////////////////////

$db_name = 'millaje';
$db_username = 'millaje';			//Your MySQL Settings here!
$db_password = 'signeng';
$db_host = 'localhost';

/////////////////////////////////////////////////////////////////

$sql = 	"CREATE TABLE IF NOT EXISTS `user_tbl` ( ".
		"`UserName` varchar(20) NOT NULL,".
		"`Password` varchar(32) NOT NULL,".
		"PRIMARY KEY (`UserName`))";

if(isset($_POST['submit']))
{
	// connect to db here!!!!!!
	$connection = mysql_connect($db_host, $db_username, $db_password) 
				or die("Error connecting to MySQL!!");
	
	mysql_select_db($db_name, $connection) or die("Unable to select DB!");
	
	if(mysql_query($sql))
	{
		echo "TABLE Created Succesfully on: $db_name (Database)";
	}
	else
	{
		die("Error Creating TABLE: " . mysql_error());
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login System Database Installation</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<div class="cent">
	<h1>Login System Database Installation</h1>
	<p>This page will help you to install the required user Database for the LoginSystem</p>
	<p class="error"><strong>Make sure you have edited the settings file with your MySQL settings!</strong></p>
	<p>We will use a database called: <strong><? echo $db_name;?></strong></p>
	<form action="" method="post">
		<input name="submit" type="submit" value="Install" />
	</form>
</div>
</body>
</html>