<?php require('makeSecure.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Example Secure Page</title>
</head>

<body>
<div class="cent">
	<h2>This is an example page made secure</h2>
	<p><? echo "Hello, " . $_SESSION['userName'];?></p>
	<p>Welcome to your secure page only viewable when logged in!</p><br />
	<p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
