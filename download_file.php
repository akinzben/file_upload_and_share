<?php

include('connect.php');

$datacodey=$_GET['datacode'];
    $datapiny=$_GET['datapin'];

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

    if(isset($datacodey)){

        $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE file_code='$datacodey' && file_pin='$datapiny' && status='' && data_type='1'");
        $countdata=mysqli_num_rows($fetchdata);
        if($countdata!='0'){
            $getall=mysqli_fetch_array($fetchdata);
            $fileurl=$getall['file_url'];
            $thedataID=$getall['id'];
            $filecode=$getall['file_code'];
            $texts=$getall['texts'];
            $file_size=$getall['file_size'];
            $datatype=$getall['data_type'];
            $max_views=$getall['max_views'];
            $current_views=$getall['current_views'];

            $current_views=$current_views+1;

            $filepath = "uploads/" . $fileurl;
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            if (readfile($filepath) !== false && !connection_aborted()) {

                
            $updatedata=mysqli_query($connect, "UPDATE datashares SET current_views='$current_views' WHERE file_code='$datacodey' && file_pin='$datapiny'");

                if($max_views==$current_views){

                    $temp = explode(".", $fileurl);
                    $file_ext=end($temp);

                    $filePath = 'uploads/'.$fileurl.'';
  
                    /* New File name */
                    $newFileName = 'uploads/deleted-'.$random_name.'.'.$file_ext.'';
                    
                    /* Rename File name */
                    if(!rename($filePath, $newFileName) ) { 
                        $data['status']='13';
                        echo json_encode($data);
                        exit();  
                    }else{
                        $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', status='1', newinfo='$newFileName' WHERE id='$thedataID'"); 
                        $data['status']='10';
                        echo json_encode($data);
                        exit();
                    } 

                    $updatedata=mysqli_query($connect, "UPDATE datashares SET status='1' WHERE file_code='$datacodey' && file_pin='$datapiny'");
                }
                die();
            }else{
                $data["status"] = '11';
                echo json_encode($data);
                exit();
            }
            
            
        }else{
            $data["status"] = '11';
            echo json_encode($data);
            exit();
        }

    }else{
        $data["status"] = '11';
        echo json_encode($data);
        exit();
    }



?>