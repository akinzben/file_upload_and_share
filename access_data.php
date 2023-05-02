<?php
    include('connect.php');

    $datacodey=$_POST['datainputcode'];
    $datapiny=$_POST['datainputpin'];

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
    

    if(isset($_POST['datainputcode'])){

        $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE file_code='$datacodey' && file_pin='$datapiny' && status=''");
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
            
            if($max_views==$current_views){
                //if data is a file, rename file
                if($datatype=='1'){

                    $nothing="YES";
                }else{  
                    $updatedata=mysqli_query($connect, "UPDATE datashares SET status='1', current_views='$current_views' WHERE file_code='$datacodey' && file_pin='$datapiny'");

                    $deletefrombase=mysqli_query($connect, "UPDATE datashares SET file_code='$random_code', texts='', status='1', newinfo='$datatexts' WHERE id='$thedataID'");

                    $data["status"] = '10';
                    $data["type"] = '2';
                    $data["code"] = $filecode;
                    $data["texts"] = $texts;
                    echo json_encode($data);
                    exit();
                }

                
            }
            

            if($datatype=='1'){

                $temp = explode(".", $fileurl);

                $file_ext=end($temp);

                $image_exts = Array('jpg','png','gif','jpeg','svg','psd','bmp','ai','tif','tiff');
                $video_exts = Array('mp4','mov','wmv','mpeg','flv','avi','webm','avchd','mkv');
                $pdf_exts = Array('pdf');
                $docs_exts = Array('doc','docx','txt','ppt','pptx','pps','xls','xlsx','csv');
                $coding_exts = Array('html','htm','js','css','php','py','cs','cpp','class','c');
                $zip_exts = Array('zip');
                $audio_exts = Array('mp3','aif','cda','mid','mpa','ogg','wav','wma');

                if(in_array($file_ext, $image_exts)){
                    $icon_link='<img style="width:100px;" src="uploads/'.$fileurl.'">';
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

                $btndatacode="'".$datacodey."'";
                $data["status"] = '10';
                $data["type"] = '1';
                $data["fileimg"]= $icon_link;
                $data["code"] = $filecode;
                $data["filename"] = $fileurl."<br><span class='text-gray filesize'>".$file_size."</span>";
                $data["url"] = '<button onclick="downloadfile('.$datapiny.', '.$btndatacode.')"><i class="icofont-download-alt"></i> Download File</button>';
                echo json_encode($data);

                exit();
            }else{
                
                $updatedata=mysqli_query($connect, "UPDATE datashares SET current_views='$current_views' WHERE file_code='$datacodey' && file_pin='$datapiny'");

                $data["status"] = '10';
                $data["type"] = '2';
                $data["code"] = $filecode;
                $data["texts"] = $texts;
                echo json_encode($data);
                exit();
            }
        }else{
            $data["status"] = '11';
            echo json_encode($data);
            exit();
        }

    }else{
        $data["status"] = '12';
        echo json_encode($data);
        exit();
    }
?>
