<?php

$txtbox = $_POST['txt'];
$country = $_POST['country'];
 
foreach($txtbox as $a => $b)
  echo "$txtbox[$a]  -  $country[$a] <br />";
 
?>