<?php
$username = "millaje";
$password = "signeng";
$host = "localhost"; 
$database = "millaje"; 

//connection to the database
$dbhandle = mysql_connect($host, $username, $password)
 or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("$database",$dbhandle)
  or die("Could not select database");
?>
