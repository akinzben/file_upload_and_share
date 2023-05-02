<?php
include('connect.php');

$old_password=$_POST['oldpass'];
$new_password=$_POST['newpass'];

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

    //if user is valid, get user id
    $getuser=mysqli_fetch_array($check_credentials);
    $user_id=$getuser['id'];
    $user_password=$getuser['password'];

    if($user_password!=$old_password){
        $data['status']='12';
        echo json_encode($data);
        exit();
    }

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $lowercase = preg_match('@[a-z]@', $new_password);
    $number    = preg_match('@[0-9]@', $new_password);
    $specialChars = preg_match('@[^\w]@', $new_password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8) {
        $data["status"] = '13';
        echo json_encode($data);
        exit();
    }

    $changepass=mysqli_query($connect, "UPDATE users SET password='$new_password' WHERE id='$user_id'");
    $data["status"] = '10';
        echo json_encode($data);
        exit();
}else{
    $data['status']='11';
        echo json_encode($data);
        exit();
}

?>