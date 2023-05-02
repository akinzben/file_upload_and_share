<?php
setcookie('email', '', time() + (86400 * 30)); // 86400 = 1 day
setcookie('theuserID', '', time() + (86400 * 30)); // 86400 = 1 day

$data["status"] = '10';
	echo json_encode($data);
	exit();
?>