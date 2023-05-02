<?php
session_start();

include('connect.php');

$email=strtolower($_POST['email']);
$userpassword=$_POST['userpassword'];
$rememberme=$_POST['rememberme'];

$check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$email' && password='$userpassword' && account_status='1'");
$count_check=mysqli_num_rows($check_credentials);

if($count_check==0){
    $data['status']='11';
    echo json_encode($data);
    exit();
}

$fetchuser=mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
$getuser=mysqli_fetch_array($fetchuser);
$userid=$getuser['id'];
$user_ID=$getuser['user_ID'];
$user_firstname=$getuser['firstname'];


$ip = getenv("REMOTE_ADDR");
$browserAgent = $_SERVER['HTTP_USER_AGENT'];
	
$addactivity=mysqli_query($connect, "INSERT INTO activity(userid, description, date_added, ip, user_agent) VALUES('$userid', 'Successful Login (using Email+Password)', NOW(), '$ip', '$browserAgent')");

if(!$addactivity){
    $data['status']='12';
    echo json_encode($data);
    exit();
}else{
    $_SESSION['theuserid']=$email;
    if($rememberme=="yes"){
        setcookie('email', $email, time() + (86400 * 30)); // 86400 = 1 day
        setcookie('theuserID', $user_ID, time() + (86400 * 30)); // 86400 = 1 day
    }else{
        setcookie('email', $email, time() + (3600 * 1)); // 86400 = 1 day
        setcookie('theuserID', $user_ID, time() + (3600 * 1)); // 86400 = 1 day
    }
    
    $data['status']='10';
    $data['firstname']=ucfirst($user_firstname);
    echo json_encode($data);
    exit();
}


?>