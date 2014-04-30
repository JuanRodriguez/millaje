<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 

		header('Location: memberpage.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-7">
<title>Sign Engineering - Mileage Report</title>
<style type="text/css">
<!--
body, td, th {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333;
}
body {
	background-color: #FFF;
	margin: 0;
}
a, a:visited {
	color: #000066;
	text-decoration: underline;
}
a:hover {
	text-decoration: none;
}
form {
	margin: 0;
	padding: 0;
}
input, select, textarea {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding: 3px;
}
#login_container {
	color: #333;
	background-color: #FFF;
	text-align: left;
	width: 330px;
	padding: 1px;
	margin: 20px auto 10px auto;
	border: 1px solid #CCCCCC;
}
#logo {
	text-align: center;
	margin: 0;
	padding: 50px 0 0 0;
}
#login_container #login {
	background-color: #EFEFEF;
	text-align: left;
	margin: 0;
	padding: 10px;
}
#login_container #login_failed {
    background-color: #FCF9D2;
    text-align: center;
    padding: 10px;
    margin: 0 0 1px 0;
}
#login_container #extra_info {
	background-color: #CCC;
	text-align: left;
	padding: 10px;
	margin: 1px 0 0 0;
}
-->
</style>
<script language="javascript">
function sf(){ document.frmlogin.username.focus(); }
</script>
</head>

<body onload="sf()">
<div id="logo"><img src="images/report.jpg" alt="MILEAGE REPORT" height="62" width="205"></div>
<div id="login_container">
  <div id="login">
    <form action="" method="post" name="frmlogin" id="frmlogin">

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>

	<table border="0" cellpadding="5" cellspacing="0" width="100%">
        <tbody><tr>
          <td valign="middle" width="30%" align="right"><strong>Username: </strong></td>
          <td valign="middle" align="center"><input name="username" type="text" id="username" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1"></td>
        </tr>
        <tr>
		  <td valign="middle" width="30%" align="right"><strong>Password: </strong></td>
          <td valign="middle" align="center"><input name="password" type="password" id="password" placeholder="Password" tabindex="3"></td>
        </tr>
        <!--<tr>
          <td valign="middle" width="30%" align="right"><input name="rememberme" id="rememberme" type="checkbox"></td>
          <td valign="middle" align="left"><label for="rememberme" style="cursor:hand">Remember me until I logout.</label></td>
        </tr>-->
        <tr>
         </tr>
		 <tr>
        </tr>
        <tr>
          <td align="right" valign="middle" width="30%">&nbsp;</td>
          <td align="center" valign="middle"><input value="Login" class="button" type="submit" tabindex="5"></td>
        </tr>
      </tbody></table>
    </form>
  </div>
  <div id="extra_info">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody><tr>

<?php
$PHPprotectV57 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

?>

        <td valign="middle" align="left">IP Logged: <strong><?php echo $PHPprotectV57
?></strong></td>
        <td align="right" valign="middle">Powered by <a href="http://www.SIGNENG.com/" target="_blank">SE</a></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div align="center"><a href='reset.php'>Forgot your password?</a></div>

</body></html>