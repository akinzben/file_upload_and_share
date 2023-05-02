<?php
include("connect.php");

if(isset($_COOKIE['email']) && isset($_COOKIE['theuserID'])){
        $user_email=$_COOKIE['email'];
        $user_ID=$_COOKIE['theuserID'];
    
        $check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$user_email' && user_ID='$user_ID' && account_status='1'");
    
        $count_check=mysqli_num_rows($check_credentials);
    
        if($count_check==0){
            $data['status']='10';
            echo json_encode($data);
            exit();
        }
}else{
    $data['status']='11';
            echo json_encode($data);
            exit();
}

?>