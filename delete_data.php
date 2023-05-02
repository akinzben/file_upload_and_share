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
                    $random_name=random_strings(35);
                    $random_code=random_strings(11);

//if its from uploads page
if($_POST['uploaded']=='YES'){
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
                $datatype=$getall['data_type'];
                $dataurl=$getall['file_url'];
                $datatexts=$getall['texts'];
                
                //if data is a file, rename file
                if($datatype=='1'){
                    

                    $temp = explode(".", $dataurl);
                    $file_ext=end($temp);

                    $filePath = 'uploads/'.$dataurl.'';
  
                    /* New File name */
                    $newFileName = 'uploads/deleted-'.$random_name.'.'.$file_ext.'';
                    
                    /* Rename File name */
                    if( !rename($filePath, $newFileName) ) {  
                        $data['status']='13';
                        echo json_encode($data);
                        exit();  
                    }else{  
                        $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', status='1', newinfo='$newFileName' WHERE id='$thedataID'"); 
                        $data['status']='10';
                        echo json_encode($data);
                        exit();
                    } 
                }else{
                    $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', texts='', status='1', newinfo='$datatexts' WHERE id='$thedataID'");
                    $data['status']='10';
                    echo json_encode($data);
                    exit();
                }

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

}else{

    $datay_code=$_POST['datacode'];
    $datay_pin=$_POST['datapin'];

    $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE file_code='$datay_code' && file_pin='$datay_pin' && status=''");
            $countdata=mysqli_num_rows($fetchdata);
            if($countdata!='0'){
                $getall=mysqli_fetch_array($fetchdata);
                $datatype=$getall['data_type'];
                $dataurl=$getall['file_url'];
                $datatexts=$getall['texts'];
                $thedataID=$getall['id'];
                
                //if data is a file, rename file
                if($datatype=='1'){
                    
                    $temp = explode(".", $dataurl);
                    $file_ext=end($temp);

                    $filePath = 'uploads/'.$dataurl.'';
  
                    /* New File name */
                    $newFileName = 'uploads/deleted-'.$random_name.'.'.$file_ext.'';
                    
                    /* Rename File name */
                    if( !rename($filePath, $newFileName) ) {  
                        $data['status']='13';
                        echo json_encode($data);
                        exit();  
                    }else{  
                        $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', status='1', newinfo='$newFileName' WHERE id='$thedataID'"); 
                        $data['status']='10';
                        echo json_encode($data);
                        exit();
                    } 
                }else{
                    $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', texts='', status='1', newinfo='$datatexts' WHERE id='$thedataID'");
                    $data['status']='10';
                    echo json_encode($data);
                    exit();
                }

            }else{
                $data['status']='11';
                echo json_encode($data);
                exit();
            }
  
    $data["status"] = '10';
	echo json_encode($data);
	exit();
}
?>