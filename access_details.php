<?php
include('connect.php');

$thedataID=$_POST['dataid'];

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

    $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE id='$thedataID' && user_id='$user_id' && status=''");
        $countdata=mysqli_num_rows($fetchdata);
        if($countdata!='0'){
            $getall=mysqli_fetch_array($fetchdata);
            $filecode=$getall['file_code'];
            $filepin=$getall['file_pin'];
            $file_exptimee=$getall['exp_date'];
            $file_exptime=date("d M H:i", strtotime($file_exptimee));

            $data['status']='10';
            $data["code"] = $filecode;
            $data["pin"] = $filepin;
            $data["exp"] = 'Valid till '.$file_exptime;
            $data["url"] = 'data72.io/?'.$filecode.'';
            echo json_encode($data);
            exit();
        }else{
            $data['status']='12';
            echo json_encode($data);
            exit();
        }

}else{
    $data['status']='11';
    echo json_encode($data);
    exit();
}

?>