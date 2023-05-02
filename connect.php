<?php 
//connect.php;
$connect = mysqli_connect("localhost", "root", "", "nextfile");
define('TIMEZONE', 'Africa/Lagos');
date_default_timezone_set(TIMEZONE);
$generaldate = date('Y-m-d H:i:s');
?>
