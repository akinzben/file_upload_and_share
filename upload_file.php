<?php
include('connect.php');
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

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1000);
    $suffixes = array('bytes', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1000, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

$file_code=random_strings(5);
$rand_url=random_strings(17);

$temp = explode(".", $_FILES["file"]["name"]);

$filename=$temp[0];
$file_ext=end($temp);

$image_exts = Array('jpg','png','gif','jpeg','svg','psd','bmp','ai','tif','tiff');
$video_exts = Array('mp4','mov','wmv','mpeg','flv','avi','webm','avchd','mkv');
$pdf_exts = Array('pdf');
$docs_exts = Array('doc','docx','txt','ppt','pptx','pps','xls','xlsx','csv');
$coding_exts = Array('html','htm','js','css','php','py','cs','cpp','class','c');
$zip_exts = Array('zip');
$audio_exts = Array('mp3','aif','cda','mid','mpa','ogg','wav','wma');

if(in_array($file_ext, $image_exts)){
    $icon_link='<i class="icofont-file-jpg"></i>';
}elseif(in_array($file_ext, $video_exts)){
    $icon_link='<i class="icofont-file-avi-mp4"></i>';
}elseif(in_array($file_ext, $pdf_exts)){
    $icon_link='<i class="icofont-file-pdf"></i>';
}elseif(in_array($file_ext, $coding_exts)){
    $icon_link='<i class="icofont-file-code"></i>';
}elseif(in_array($file_ext, $zip_exts)){
    $icon_link='<i class="icofont-file-zip"></i>';
}elseif(in_array($file_ext, $audio_exts)){
    $icon_link='<i class="icofont-file-mp3"></i>';
}elseif(in_array($file_ext, $docs_exts)){
    $icon_link='<i class="icofont-file-document"></i>';
}else{
    $icon_link='<i class="icofont-file-file"></i>';
}

$newfilename = ''.$filename.'-'.$file_code . '.' . end($temp);

$randnum=rand(50000,90000);
$target_filesec = $target_dir . basename($_FILES["file"]["name"]) . $rand_url;
$uploadOksec = 1;
$imageFileTypesec = strtolower(pathinfo($target_filesec,PATHINFO_EXTENSION));


$rand_pin=rand(1000,9999);

if(move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename)) {

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

        $filesize=filesize("uploads/" . $newfilename);
        $filesize=formatBytes($filesize);
    
        $getuser=mysqli_fetch_array($check_credentials);
        $user_id=$getuser['id'];

        $addtobase=mysqli_query($connect, "INSERT INTO datashares(data_type, file_code, file_pin, file_url, file_size, max_views, current_views, date_added, exp_date, user_id) VALUE('1', '$file_code', '$rand_pin', '$newfilename', '$filesize', '$maxviews', '0', NOW(), '$exp_time', '$user_id')");

        $file_exptime=date("d M H:i", strtotime($exp_time));
	
        $data["status"] = '10';
        $data["iconlink"] = $icon_link;
        $data["code"] = $file_code;
        $data["pin"] = $rand_pin;
        $data["exp"] = 'Valid till '.$file_exptime;
        $data["url"] = 'data72.io/?'.$file_code.'';
        echo json_encode($data);
        exit();
    }else{
        $filesize=filesize("uploads/" . $newfilename);
        $filesize=formatBytes($filesize);

        $addtobase=mysqli_query($connect, "INSERT INTO datashares(data_type, file_code, file_pin, file_url, file_size, max_views, current_views, date_added, exp_date) VALUE('1', '$file_code', '$rand_pin', '$newfilename', '$filesize', '$maxviews', '0', NOW(), '$exp_time')");

        $file_exptime=date("d M H:i", strtotime($exp_time));
	
        $data["status"] = '10';
        $data["iconlink"] = $icon_link;
        $data["code"] = $file_code;
        $data["pin"] = $rand_pin;
        $data["exp"] = 'Valid till '.$file_exptime;
        $data["url"] = 'data72.io/?'.$file_code.'';
        echo json_encode($data);
        exit();
    }

  }else{
    $data["status"] = '11';
    echo json_encode($data);
	exit();
}
?>