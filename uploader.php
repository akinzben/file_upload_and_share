<?php
include('connect.php');

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
$rand_url=random_strings(17);

$temp = explode(".", $_FILES["thefile"]["name"]);
$newfilename = $rand_url . '.' . end($temp);

$randnum=rand(50000,90000);
$target_filesec = $target_dir . basename($_FILES["thefile"]["name"]) . $rand_url;
$uploadOksec = 1;
$imageFileTypesec = strtolower(pathinfo($target_filesec,PATHINFO_EXTENSION));


$rand_pin=rand(1000,9999);

if(move_uploaded_file($_FILES["thefile"]["tmp_name"], "uploads/" . $newfilename)) {
    $addtobase=mysqli_query($connect, "INSERT INTO datashares(data_type, file_code, file_pin, file_url) VALUE('1', '$file_code', '$rand_pin', '$newfilename')");
	header('location:index.php?fld='.$file_code);
  }else{
    echo "failed";
    }
?>