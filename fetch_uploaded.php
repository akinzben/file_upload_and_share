<?php
include('connect.php');

//if user is logged in
if(isset($_COOKIE['email']) && isset($_COOKIE['theuserID'])){
    $user_email=$_COOKIE['email'];
    $user_ID=$_COOKIE['theuserID'];

    $check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$user_email' && user_ID='$user_ID' && account_status='1'");

    $count_check=mysqli_num_rows($check_credentials);

    //if user is valid
    if($count_check==0){
        $data['status']='12';
        echo json_encode($data);
        exit();
    }

    //if user is valid, get user id
    $getuser=mysqli_fetch_array($check_credentials);
    $user_id=$getuser['id'];

    //get user uploads
    $fetchuploads=mysqli_query($connect, "SELECT * FROM datashares WHERE user_id='$user_id' ORDER BY id DESC LIMIT 100");
    $countuploads=mysqli_num_rows($fetchuploads);

    //if user has no uploads
    if($countuploads==0){
        $data['status']='11';
        echo json_encode($data);
        exit();
    }

    //if user has uploads, fetch them
    while($getuploads=mysqli_fetch_array($fetchuploads)){

        $data_id=$getuploads['id'];
        $data_type=$getuploads['data_type'];
        $data_maxviews=$getuploads['max_views'];
        $data_currentviews=$getuploads['current_views'];
        $data_status=$getuploads['status'];
        $data_datee=$getuploads['date_added'];
        $data_date=date_create($data_datee);
        $data_texts=$getuploads['texts'];
        $data_name=$getuploads['file_url'];
        $data_filesize=$getuploads['file_size'];
        $data_exptime=$getuploads['exp_date'];
        $randic=rand(1,2);
        if($data_type=='1'){
            $data_name=$data_name;

            $temp = explode(".", $data_name);

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
                if($data_status=='1'){
                    $icon_link='<i class="icofont-file-jpg"></i>';
                }else{
                    $icon_link='<img src="uploads/'.$data_name.'">';
                }
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

            $dataicon=$icon_link;
        }else{
            if($data_status=='1'){
                $data_name="<i class='icofont-exclamation-tringle'></i> Not Found";
                
            }else{
                $data_name=strip_tags(substr($data_texts,0,95)).'';
            }
            $dataicon='<i class="icofont-file-alt"></i>';
        }

        if($data_status=='1'){
            $status_valid='<span class="text-warning"><i class="icofont-exclamation-circle"></i> Deleted from server</span>';
            $tools_style="style='display:none;'";
            $box_style="style='opacity:0.4;'";
            $data_filesize='';
        }else{
            $status_valid='<span class="text-primary"><i class="icofont-ui-timer"></i> Valid till '.date("d M H:i", strtotime($data_exptime)).'</span>';
            $tools_style="style='display:block;'";
            $box_style="";
        }

        $uploads.='<div id="uploaded" '.$box_style.'>
        <div id="uploaded-icon">
            <div id="coverdiv"></div>
            <div id="showupicon"><center>'.$dataicon.'<br><span class="text-gray" style="font-size:13px;line-height:2.6">'.$data_filesize.'</span>  </center></div>
        </div>
        <div id="uploaded-name">
            '.$data_name.'<br>
            <span><i class="icofont-upload"></i> '.date_format($data_date,"d M H:i").'</span>
            &nbsp;&nbsp;
            <span><i class="icofont-eye-alt"></i> '.$data_currentviews.'/'.$data_maxviews.' views</span>
            <br>
           '.$status_valid.'

            
            <div id="uploaded-tools" '.$tools_style.'>
                <div onclick="share('.$data_id.')"><i class="icofont-link"></i> Share Link</div>
                <div onclick="deleteuploaded('.$data_id.')" class="text-gray"><i class="icofont-trash"></i> Delete</div>
            </div>
        </div>
    </div>';

    }

    $data['status']='10';
    $data['uploads']=$uploads;
    echo json_encode($data);
    exit();

    
}else{
    //if user is not logged in
    $data['status']='12';
    echo json_encode($data);
    exit();
}


?>