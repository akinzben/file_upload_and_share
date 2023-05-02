<?php
include('connect.php');

$textddata=strip_tags($_POST['textdata']);
$maxviews=$_POST['maxviews'];
$exp_time = date("Y-m-d H:i:s", strtotime('+72 hours'));

function random_strings($length_of_string)
{
  
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result), 
                       0, $length_of_string);
}
$file_code=random_strings(5);

$rand_pin=rand(1000,9999);

if(isset($_COOKIE['email']) && isset($_COOKIE['theuserID'])){
    $user_email=$_COOKIE['email'];
    $user_ID=$_COOKIE['theuserID'];

    $check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$user_email' && user_ID='$user_ID' && account_status='1'");

    $count_check=mysqli_num_rows($check_credentials);

    if($count_check==0){
        $data['status']='11';
        echo json_encode($data);
        exit();
    }

    $getuser=mysqli_fetch_array($check_credentials);
    $user_id=$getuser['id'];

    $addtobase=mysqli_query($connect, "INSERT INTO datashares(data_type, file_code, file_pin, file_url, texts, max_views, current_views, date_added, exp_date, user_id) VALUE('2', '$file_code', '$rand_pin', '$newfilename', '$textddata', '$maxviews', '0', NOW(), '$exp_time', '$user_id')");

    $file_exptime=date("d M H:i", strtotime($exp_time));
	
    $data["status"] = '10';
    $data["code"] = $file_code;
    $data["pin"] = $rand_pin;
    $data["exp"] = 'Valid till '.$file_exptime;
    $data["url"] = 'data72.io/?'.$file_code.'';
	echo json_encode($data);
	exit();

}else{
    $addtobase=mysqli_query($connect, "INSERT INTO datashares(data_type, file_code, file_pin, file_url, texts, max_views, current_views, date_added, exp_date) VALUE('2', '$file_code', '$rand_pin', '$newfilename', '$textddata', '$maxviews', '0', NOW(), '$exp_time')");

    $file_exptime=date("d M H:i", strtotime($exp_time));
	
    $data["status"] = '10';
    $data["code"] = $file_code;
    $data["pin"] = $rand_pin;
    $data["exp"] = 'Valid till '.$file_exptime;
    $data["url"] = 'data72.io/?'.$file_code.'';
	echo json_encode($data);
	exit();
}

?>