<?php
session_start();
include('connect.php');


$firstname= strtolower($_POST['firstname']);
$lastname= strtolower($_POST['lastname']);
$email= strtolower($_POST['email']);
$userpassword= $_POST['password'];

$check_email=mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
$count_email=mysqli_num_rows($check_email);

if($count_email!=0){
    $data["status"] = '11';
	echo json_encode($data);
	exit();
}

// Validate password strength
$uppercase = preg_match('@[A-Z]@', $userpassword);
$lowercase = preg_match('@[a-z]@', $userpassword);
$number    = preg_match('@[0-9]@', $userpassword);
$specialChars = preg_match('@[^\w]@', $userpassword);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($userpassword) < 8) {
    $data["status"] = '12';
	echo json_encode($data);
	exit();
}


$user_ID=rand(10000000,99999999);
$adduser=mysqli_query($connect, "INSERT INTO users(user_ID, email, firstname, lastname, password, date_joined, email_status, account_status) VALUES('$user_ID', '$email', '$firstname', '$lastname', '$userpassword', NOW(), '0', '1')");

$_SESSION['theuserid']=$email;

$fetchuser=mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
$getuser=mysqli_fetch_array($fetchuser);
$userid=$getuser['id'];

$ip = getenv("REMOTE_ADDR");
$browserAgent = $_SERVER['HTTP_USER_AGENT'];
$addactivity=mysqli_query($connect, "INSERT INTO activity(userid, description, date_added, ip, user_agent) VALUES('$userid', 'Successful Login (using Email+Password)', NOW(), '$ip', '$browserAgent')");

setcookie('email', $email, time() + (86400 * 30)); // 86400 = 1 day
setcookie('theuserID', $user_ID, time() + (86400 * 30)); // 86400 = 1 day

$data["status"] = '10';
	echo json_encode($data);
	exit();

?>