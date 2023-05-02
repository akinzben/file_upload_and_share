<?php
include('connect.php');

$firstname=$_POST['newfirstname'];
$lastname=$_POST['newlastname'];
$email=$_POST['newemail'];

//if user is logged in
if(isset($_COOKIE['email']) && isset($_COOKIE['theuserID'])){
    $user_email=$_COOKIE['email'];
    $user_ID=$_COOKIE['theuserID'];

    $check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$user_email' && user_ID='$user_ID' && account_status='1'");

    $count_check=mysqli_num_rows($check_credentials);

    //if user is valid
    if($count_check==0){
        $data['status']='11';
        echo json_encode($data);
        exit();
    }

    $check_email=mysqli_query($connect, "SELECT * FROM users WHERE email='$email' && user_ID!='$user_ID'");
    $count_email=mysqli_num_rows($check_email);

    if($count_email!=0){
        $data["status"] = '12';
        echo json_encode($data);
        exit();
    }

    //if user is valid, get user id
    $getuser=mysqli_fetch_array($check_credentials);
    $user_id=$getuser['id'];

    $changepass=mysqli_query($connect, "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id='$user_id'");

    setcookie('email', $email, time() + (86400 * 30)); // 86400 = 1 day
    $data["status"] = '10';
        echo json_encode($data);
        exit();
}else{
    $data['status']='11';
        echo json_encode($data);
        exit();
}

?>