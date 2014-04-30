<?PHP

session_start();

if (!(isset($_SESSION['myusername']) && $_SESSION['myusername'] != '')) {

header ("Location: login.php");

}


        // connect to the database
    include ('connect.php');
	

        // verificar pp
		

?>