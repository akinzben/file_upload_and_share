<?php

include('connect.php');

if(isset($_COOKIE['email']) && isset($_COOKIE['theuserID'])){
    $user_email=$_COOKIE['email'];
    $user_ID=$_COOKIE['theuserID'];

    $check_credentials=mysqli_query($connect, "SELECT * FROM users WHERE email='$user_email' && user_ID='$user_ID' && account_status='1'");

    $count_check=mysqli_num_rows($check_credentials);


    $getuser=mysqli_fetch_array($check_credentials);
    $user_id=$getuser['id'];
    $user_firstname=$getuser['firstname'];
    $user_lastname=$getuser['lastname'];
    $user_email=$getuser['email'];

    $fetchactivities=mysqli_query($connect, "SELECT * FROM activity WHERE userid='$user_id' ORDER BY id DESC LIMIT 50");
}

?>

<html>
<head>
    <title>Share Data Securely For Free - Data72.io</title>
    <meta name="viewport" content="width=device-width">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/icofont/icofont.min.css">

    <link rel="icon" href="images/nextfile-icon.png">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>

<body>



<div id="pop-modal">
    <div class="loader" id="modalload"></div>
    <div id="closeback" onclick="closemodal()" title="Close Window"></div>
    <div class="modal-box">
        <div id="signup-box" class="popwindow signup">
            <div id="modal-title"><h3>Sign up</h3></div>
            <div id="formbox">
                <div id="multi-input">
                    <div id="leftinput"><input type="text" maxlength="20" placeholder="First Name" id="firstname" class="checkit"></div>
                    <div id="rightinput"><input type="text"  maxlength="20" placeholder="Last Name" id="lastname" class="checkit"></div>
                </div>

                <div id="single-input">
                    <input type="email" placeholder="Email Address" id="email" class="checkit">
                </div>

                <div id="multi-input">
                    <div id="leftinput"><input type="password" maxlength="20" placeholder="Password" id="userpassword" class="checkit"></div>
                    <div id="rightinput"><input type="password" maxlength="20" placeholder="Retype Password" id="retypepass" class="checkit"></div>
                </div>
                <div id="passwordbox" class="passwordbox">- Password should be at least 8 characters in length <br> - Include at least one upper case letter<br>
                - Include at least one number<br> - Include at least one special character.</div>

                <div class="formerrorbox" id="signuperror">Trouble with server. Pls try again!</div>

                <div id="single-input" style="font-size:13px;line-height:1.3;">
                    <p>By proceeding, you hereby agree to our <a href="terms-of-use">Terms of use</a> and also read our <a href="privacy-policy">Privacy Policy.</a></p>
                </div>

                <div id="submitbox"><button class="btn" onclick="signup()" id="regbtn">SIGN UP</button></div>
            </div>
        </div>


        <div id="login-box"  class="popwindow login">
            <div id="modal-title"><h3>Login</h3></div>
            <div id="formbox">
                <div id="single-input">
                    <input type="email" placeholder="Email Address" id="loginemail" class="checklogins">
                </div>

                <div id="single-input">
                    <input type="password" placeholder="Password" id="loginpassword" class="checklogins">
                </div>

                <div id="single-input" style="font-size:16px;line-height:1.3;">
                    <p><input type="checkbox" id="rememberme" style="width:20px;height:20px;vertical-align:middle;"> Remember me.</p>
                </div>

                <div class="formerrorbox" id="loginerror">Trouble with server. Pls try again!</div>

                <div id="submitbox"><button class="btn" id="sendbtn" onclick="signinuser()">SIGN IN</button></div>
            </div>
        </div>

        <div id="sharewindow" class="popwindow about longwindow">
        <div id="box-title">ABOUT DATA72.io</div>
                <div id="infobox">
                Data72.io is free and allows every user an unlimited storage of data sharing. It was built for the comfort of offices & individuals to be able to share/transfer data between devices or co-workers.

                <h4>How safe is Data72.io?</h4>
                <p><b style="color:#7800da">Every data uploaded on our servers gets permanently deleted in 72hours or when upload option is reached.</b> All data is not stored in a single server and is encrypted to protect user information sent between browser and our servers. That information could include everything from payment data to personal information. Our data encryption software, also known as an encryption algorithm or cipher, is used to develop an encryption scheme that theoretically cannot be broken.<br><br>

                We use <b>Asymmetric encryption keys</b>. This type uses two different keys - public and private - that are linked together mathematically. The keys are essentially large numbers that have been paired with each other but aren't identical.
                </p>

                </div>
        </div>

        <div id="sharewindow" class="popwindow contact">
        <div id="box-title">CONTACT US</div>
        <div id="infobox">

                You can reach us anytime via the below emails

                <p><b>Support</b> - <a href="mailto:support@data72.io">support@data72.io</a></p>
                <p><b>Inquiries</b> - <a href="mailto:inquiries@data72.io">Inquiries@data72.io</a></p>
                <p><b>Donations</b> - <a href="mailto:donate@data72.io">donate@data72.io</a></p>

                </div>
        </div>

        <div id="sharewindow" class="popwindow privacy">
        <div id="box-title">PRIVACY POLICY</div>
            <div class="box-error"><i class="icofont-learn"></i> <br> <span>We are updating our Privacy Policy. Check again soon.</span></div>
        </div>

        <div id="sharewindow" class="popwindow terms">
        <div id="box-title">TERMS OF USE</div>
        <div class="box-error"><i class="icofont-learn"></i> <br> <span>We are updating our Terms of Use. Check again soon.</span></div>
        </div>


        <div id="sharewindow" class="popwindow sharebox">
            <div id="box-title"><i class="icofont-database-locked"></i> Data Access Details</div>
                <div id="sharedetails" style="padding-left:20px;">
                <p style="color:#7800da;"><span id="shareexp"></span></p>
                <p><b><i class="icofont-server"></i> Server Code:</b> <span id="sharecode"></span></p>
                <p><b><i class="icofont-link"></i> Data Link:</b> <span id="shareurl"></span></p>
                <p><b><i class="icofont-key"></i> Data PIN:</b> <span id="sharepin"></span></p>
                </div>
                <button onclick="copyshare()" onmouseout="shareoutFunc()" class="tooltip">
                    <span class="tooltiptext" id="shareTooltip">Copy to clipboard</span>
                    <i class="icofont-ui-copy"></i> Copy Details
                </button>
        </div>

        <div id="sharewindow" class="popwindow logoutbox">
        <div id="box-title"><i class="icofont-exclamation-circle"></i> Confirmation</div>
                <div id="sharedetails">
                    <center>
                <p style="font-size:19px;">Are you sure you want to Log out?</p><br>
                
                
                <button onclick="closemodal()"  style="background:#959595;" class="tooltip">
                <i class="icofont-close-circled"></i> Cancel
                </button>

                <button onclick="logoutuser()" class="tooltip">
                <i class="icofont-logout"></i> Log Out
                </button>

                </center>

                </div>
        </div>

        <div id="sharewindow" class="popwindow changepassbox">
            <div id="box-title"><i class="icofont-key"></i> CHANGE PASSWORD</div>
            <div id="formbox">

                <div id="single-input">
                    <input type="password" placeholder="Old Password" id="oldpass" class="passcheckit">
                </div>

                <div id="multi-input">
                    <div id="leftinput"><input type="password" maxlength="20" placeholder="New Password" id="newpass" class="passcheckit"></div>
                    <div id="rightinput"><input type="password" maxlength="20" placeholder="Retype Password" id="retypenewpass" class="passcheckit"></div>
                </div>
                <div id="changepasswordbox" class="passwordbox">- Password should be at least 8 characters in length <br> - Include at least one upper case letter<br>
                - Include at least one number<br> - Include at least one special character.</div>

                <div class="formerrorbox" id="changepasserror">Trouble with server. Pls try again!</div>


                <div id="submitbox"><button class="btn" onclick="changepass()" id="changepassbtn">PROCEED</button></div>
            </div>
        </div>

        <div id="sharewindow" class="popwindow editprofile">
            <div id="box-title"><i class="icofont-ui-user"></i> Change Personal Information</div>
            <div id="formbox">

                <div id="multi-input">
                    <div id="leftinput">
                        <label>First Name</label>
                        <input type="text" maxlength="20" placeholder="" id="editfirstname" value="<?php echo ucfirst($user_firstname); ?>" class="perscheckit"></div>
                    <div id="rightinput">
                        <label>Last Name</label>
                        <input type="text" maxlength="20" placeholder="" id="editlastname" value="<?php echo ucfirst($user_lastname); ?>" class="perscheckit"></div>
                </div>

                <div id="single-input">
                    <label>Email Address</label>
                    <input type="email" maxlength="150" value="<?php echo $user_email; ?>" placeholder="" id="editemail" class="perscheckit">
                </div>

                <div class="formerrorbox" id="personalerror">Trouble with server. Pls try again!</div>


                <div id="submitbox"><button class="btn" onclick="editprofile()" id="changepersbtn">PROCEED</button></div>
            </div>
        </div>

    </div>
</div>

<div id="sidebar">

    <a href="#"><div id="sidelogo"><center><img src="images/sitelogo-light.png">
</center></div></a>

<div id="sidemenu"  class="tab">

<?php  
    $x=0;

    
     foreach($_GET as $key => $value)
     {
        if($x==0){
            $servercodey=$key;
        }
        $x++;

     }

     if($x>0){
     ?>

    <div ><button class="tablinks" onclick="openCity(event, 'filer')"><i class="icofont-diskette"></i><br><span>FILE</span></button></div>
    <div ><button class="tablinks" onclick="openCity(event, 'text')"><i class="icofont-letter"></i><br><span>TEXT</span></button></div>
    <div ><button class="tablinks active" onclick="openCity(event, 'accessdata')"><i class="icofont-key-hole"></i><br><span>ACCESS</span></button></div>

    <?php
     }else{
    ?>

    <div ><button class="tablinks active" onclick="openCity(event, 'filer')"><i class="icofont-diskette"></i><br><span>FILE</span></button></div>
    <div ><button class="tablinks" onclick="openCity(event, 'text')"><i class="icofont-letter"></i><br><span>TEXT</span></button></div>
    <div ><button class="tablinks" onclick="openCity(event, 'accessdata')"><i class="icofont-key-hole"></i><br><span>ACCESS</span></button></div>

    <?php
     }
                if($count_check!=0){

            ?>
            
    <div  class="guestmenu" style="display:none;"><button style="background:#000;" class="tablinks" onclick="openwindow('login')"><i class="icofont-login"></i><br><span>LOGIN</span></button></div>
    <div  class="guestmenu" style="display:none;"><button style="background:#fff;color:#000" class="tablinks" onclick="openwindow('signup')"><i class="icofont-user-alt-5"></i><br><span>SIGNUP</span></button></div>
                

    
        <div class="usermenu"   onclick="fetchuploads()"><button style="background:#000;" class="tablinks" onclick="openCity(event, 'uploads')"><i class="icofont-cloud-upload"></i><br><span>UPLOADS</span></button></div>
        <div class="usermenu"><button style="background:#fff;color:#000" class="tablinks" onclick="openCity(event, 'account')"><i class="icofont-user-alt-5"></i><br><span id="userfirstname"><?php echo ucfirst($user_firstname); ?></span></button></div>
                
    <?php
                }else{
            ?>


    <div class="guestmenu"><button style="background:#000;" class="tablinks" onclick="openwindow('login')"><i class="icofont-login"></i><br><span>LOGIN</span></button></div>
    <div  class="guestmenu"><button style="background:#fff;color:#000" class="tablinks" onclick="openwindow('signup')"><i class="icofont-user-alt-5"></i><br><span>SIGNUP</span></button></div>
                

    
        <div  class="usermenu"  style="display:none;"  onclick="fetchuploads()"><button style="background:#000;" class="tablinks"  onclick="openCity(event, 'uploads')"><i class="icofont-cloud-upload"></i><br><span>UPLOADS</span></button></div>
        <div  class="usermenu" style="display:none;"><button style="background:#fff;color:#000" class="tablinks" onclick="openCity(event, 'account')"><i class="icofont-user-alt-5"></i><br><span id="userfirstname">Profile</span></button></div>
                

<?php
                }
            ?>

</div>

</div>

<div id="maincontent">

    <header>
        <div id="headbox">
            
                <div id="logoarea"><a href="#"><img src="images/sitelogo.png"></a></div>
                <div id="rightheadside" ><i class="icofont-info-square" onclick="openwindow('about')"></i></div>
           
            
        </div>
	</header>
        


    <?php 
    
        if($x>0){
            
    ?>


    
    <div class="tabcontent" id="filer">

    
    <h1><i class="icofont-safety"></i> SECURELY SHARE FILES</h1>
    
        <center><form method="post" enctype="multipart/form-data" id="myform">
        <div id="uploadbox">
            <div>
                <div id="hoverfile">
                    <div>Drag & drop Files<br><a href="#" id="previewfilelink">Browse your device</a></div>
                    <div class='preview' id="previewbox">
                        <div id="blah"><i class="icofont-cloud-upload"></i></div>
                    </div>
                </div>
            </div>
                
                <input type="file" name="file" class="file" id="uploadarea" style="width:100%;"/>
        </div>
        <div id="optionbox">
            <label>Delete data from server after</label>
            <select id="maxviews" name="maxviews">
                <option value="1" selected>1</option>
                <?php
                    $x=2;
                    while($x<1001){
                        echo "<option value=".$x.">".$x."</option>";
                        $x++;
                    }
                ?>
            </select>
            download
        </div>
        <button type="submit" class="button" id="but_upload"><i class="icofont-upload"></i> ENCRYPT & UPLOAD</button>

        <div id="progress-div"><div id="progress-bar"></div></div>
            </form></center>
    
    </div>

    
    <div class="tabcontent" id="accessdata" style="display:block;">
    
        <h1><i class="icofont-key-hole"></i> ACCESS SHARED DATA</h1>
        <center>
            <div id="uploadbox" style="background:#00325b;">
                <p style="font-size:19px;font-weight:600;color:#fff;">Enter Data PIN Below.</p>
                <p style="color:#ff9900;font-size:13px;">Deletes soon. Ensure you download.</p>
                <input type="text" id="datainputcode" style="border:none;" class="inputbox" placeholder="Server Code" value="<?php echo $servercodey; ?>">
                <input type="text" id="datainputpin" style="border:none;" class="inputbox" placeholder="Data PIN">
            </div>
            <button onclick="accessdata()" id="accessbtn"><i class="icofont-server"></i> ACCESS DATA</button>
            </center>

            
    </div>

 

    <?php

        }else{

    ?>

    
    <div class="tabcontent" id="filer" style="display:block;">
    
    <h1><i class="icofont-safety"></i> SECURELY SHARE FILES</h1>
    
        <center><form method="post" enctype="multipart/form-data" id="myform">
        <div id="uploadbox">
            <div>
                <div id="hoverfile">
                    <div>Drag & drop Files<br><a href="#" id="previewfilelink">Browse your device</a></div>
                    <div class='preview' id="previewbox">
                        <div id="blah"><i class="icofont-cloud-upload"></i></div>
                    </div>
                </div>
            </div>
                
                <input type="file" name="file" class="file" id="uploadarea"/>
        </div>
        <div id="optionbox">
            <label>Delete data from server after</label>
            <select id="maxviews" name="maxviews">
                <option value="1" selected>1</option>
                <?php
                    $x=2;
                    while($x<1001){
                        echo "<option value=".$x.">".$x."</option>";
                        $x++;
                    }
                ?>
            </select>
            download
        </div>
        <button type="submit" class="button" id="but_upload"><i class="icofont-upload"></i> ENCRYPT & UPLOAD</button>

        <div id="progress-div"><div id="progress-bar"></div></div>



            </form></center>
    
    </div>


    <div class="tabcontent" id="accessdata" style="display:none;">
    
        <h1><i class="icofont-key-hole"></i> ACCESS SHARED DATA</h1>
        <center>
            <div id="uploadbox" style="background:#00325b;">
                <p style="font-size:19px;font-weight:600;color:#fff;">Enter Data Credentials Below.</p>
                <p style="color:#ff9900;font-size:13px;">Deletes soon. Ensure you download.</p>
                <input type="text" id="datainputcode" style="border:none;" class="inputbox" placeholder="Server Code" value="<?php echo $servercodey; ?>">
                <input type="text" id="datainputpin" style="border:none;" class="inputbox" placeholder="Data PIN">
            </div>
            <button onclick="accessdata()" id="accessbtn"><i class="icofont-server"></i> ACCESS DATA</button>
            </center>

            
    </div>

    <?php

    }

    ?>

    <div class="tabcontent" id="text">
        
    <h1><i class="icofont-safety"></i> SECURELY SHARE TEXT</h1>
        <center><form>
            <div id="uploadbox">
                <textarea id="textbox" rows="12" required placeholder="Text goes here...."></textarea>
            </div>
            <div id="optionbox">
            <label>Delete data from server after</label>
            <select id="textmaxviews">
                <option value="1" selected>1</option>
                <?php
                    $x=2;
                    while($x<1001){
                        echo "<option value=".$x.">".$x."</option>";
                        $x++;
                    }
                ?>
            </select>
            view
        </div>
            <button type="button" onclick="addtext()" id="submitbtn"><i class="icofont-upload"></i> ENCRYPT & UPLOAD</button>
            </form></center>
    </div>


    <div class="tabcontent" id="uploads" style="display:none;">
        
        <h1><i class="icofont-clouds"></i> MY UPLOADS</h1>
        
        <div id="uploads-box" style="margin-bottom:20px;">
            
            <div id="box-title"><i class="icofont-hard-disk"></i> Last 100 uploaded data</div>
            <div id="alluploads">
            <?php
                $fetchuploads=mysqli_query($connect, "SELECT * FROM datashares WHERE user_id='$user_id' ORDER BY id DESC LIMIT 100");
                $countuploads=mysqli_num_rows($fetchuploads);
                if($countuploads==0){
            ?>
                        <div class="box-error"><i class="icofont-learn"></i> <br> <span>No uploads yet!</span></div>
            <?php
                }else{
                    
            ?>
                    <?php 
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
                            $video_exts = Array('mp4','mov','wmv','mpeg','flv','avi','webm','avchd');
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
                    ?>
                    <div id="uploaded" <?php  echo $box_style; ?>>
                        <div id="uploaded-icon">
                            <div id="coverdiv"></div>
                            <div id="showupicon"><center><?php echo $dataicon; ?><br><span class="text-gray" style="font-size:13px;line-height:2.6"><?php echo $data_filesize ?></span>  </center></div>
                        </div>
                        <div id="uploaded-name">
                            <?php echo $data_name; ?><br>
                            <span><i class="icofont-upload"></i><?php echo date_format($data_date,"d M H:i"); ?></span>
                            &nbsp;&nbsp;
                            <span><i class="icofont-eye-alt"></i> <?php echo $data_currentviews; ?>/<?php echo $data_maxviews; ?> views</span>
                            <br>
                            <?php echo $status_valid; ?>

                            
                            <div id="uploaded-tools" <?php  echo $tools_style; ?>>
                                <div onclick="share(<?php echo $data_id; ?>)"><i class="icofont-link"></i> Share Link</div>
                                <div onclick="deleteuploaded(<?php echo $data_id; ?>)" class="text-gray"><i class="icofont-trash"></i> Delete</div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $uploads++;
                        }
                    ?>
                    
                
            <?php
                }
            ?>
            </div>
        </div>

            
    </div>

    <div class="tabcontent" id="account">
    
        <div id="uploads-box" style="background:none;box-shadow:none;">
            
            <div id="accountbox">
                <div id="account-dp"><?php echo ucfirst($user_firstname[0]); ?></div>
                <div id="account-name"><span id="profile-name"><?php echo ucfirst($user_firstname); ?>  <?php echo ucfirst($user_lastname); ?></span> <sup><button onclick="openwindow('editprofile');"><i class="icofont-edit"></i></button></sup></div>
                <div id="account-email"><?php echo $user_email; ?></div>
                <div id="account-tools"><center>
                    <button onclick="openwindow('changepassbox');"><i class="icofont-key"></i> Change Password</button> 
                    <button class=" btn-warning" onclick="openwindow('logoutbox');"><i class="icofont-power"></i> Log Out</button>
                </center></div>

                <div id="uploads-box" style="border-bottom:1px solid #666;">
                    <div id="box-title"><i class="icofont-tasks-alt"></i> Account Activities</div>
                    <table class="allactivities">
                                    <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>IP</th>
                                            <th>User Agent</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                        while($getactivities=mysqli_fetch_array($fetchactivities)){
                                            $act_desc=$getactivities['description'];
                                            $act_date=$getactivities['date_added'];
                                            $act_ip=$getactivities['ip'];
                                            $act_useragent=$getactivities['user_agent'];

                                    ?>

                                        <tr style="border-bottom:1px solid #ddd">
                                            <td data-th="Coin Name"><span class="bt-content">
                                                <div class="coin-name">
                                                    <span class="verified"><i class="icofont-check-alt"></i> <?php echo $act_desc; ?></span><br>
                                                    <span style="font-size:12px;font-weight:300;"><?php echo date('d M Y H:i:s', strtotime($act_date)); ?></span>
                                                </div>
                                            </span></td>
                                            <td data-th="Address"><span class="bt-content"><?php echo $act_ip; ?></span></td>
                                            <td data-th="QR"><?php echo $act_useragent; ?></td>
                                        </tr>
                                    <?php

                                        }
                                    ?>

                                       
                                        
                                    </tbody>
                                </table>
                </div>
            </div>
        </div>

            
    </div>

            <div id="dataviewarea" style="display:none;">
                <center id="viewfileimg"  style="font-size:60px;"><img style="width:150px;" src="#"></center>
                <center id="viewfilename"  style="font-size:14px;padding-top:8px;"></center>
                <hr>
                <div id="filedetails">
                    <div id="fileydetails">
                    <p style="color:#7800da;">Deletes soon!. Download this file.</p>
                    <p><b>Server Code:</b> <span id="viewservercode"></span></p>
                    </div>
                    <span id="viewfileurl"></span>
                </div>
            </div>

            <div id="textdataviewarea" style="display:none;">
                <center >
                    <textarea id="viewtextbox" rows="10" required placeholder="Text goes here...."></textarea>
                </center>
                <div id="filedetails">
                    <div id="fileydetails">
                    <p style="color:#7800da;">Deletes soon! Copy to Clipboard now.</p>
                    <p><b><i class="icofont-server"></i> Server Code:</b> <span id="viewtextservercode"></span></p>
                    </div>
                    <button onclick="gettextbox()" onmouseout="viewoutFunc()" class="tooltip">
                        <span class="tooltiptext" id="viewTooltip">Copy to clipboard</span>
                        <i class="icofont-ui-copy"></i> Copy to Clipboard
                    </button>
                    <span id="viewfileurl"></span>
                </div>
            </div>


    
        <div id="filearea" style="display:none;">
            <span id="fileimg" style="font-size: 50px;"></span>
            <div id="filedetails">
                <div id="dataydetails">
                <p style="color:#7800da;" id="dataexp">Deletes soon!</p>
                <p><b><i class="icofont-server"></i> Server Code:</b> <span id="datacode"></span></p>
                <p><b><i class="icofont-link"></i> Data Link:</b> <span id="dataurl"></span></p>
                <p><b><i class="icofont-key"></i> Data PIN:</b> <span id="datapin"></span></p>
                </div>
                <button onclick="myFunction()" onmouseout="outFunc()" class="tooltip">
                    <span class="tooltiptext" id="myTooltip">Copy Details</span>
                    <i class="icofont-ui-copy"></i> Copy Details
                </button> 
                <button onclick="deletedata()"><i class="icofont-delete-alt"></i> Delete</button>
            </div>
        </div>

<div id="greenalertdiv">&#128465; Data Deleted</div>
<div id="redalertdiv">&#128683; Error !!</div>
<footer>
     MADE WITH <span><i class="icofont-ui-love"></i></span>+<i class="icofont-ssl-security"></i> FOR YOU
    <br><br>
    <a href="#about" onclick="openwindow('about')">About</a> &nbsp; <a href="#contact" onclick="openwindow('contact')">Contact</a> &nbsp; <a href="#privacy-policy" onclick="openwindow('privacy')">Privacy Policy</a> &nbsp; <a href="#terms-of-use" onclick="openwindow('terms')">Terms of use</a>
</footer>


<iframe id="secretIFrame" src="" style="display:none; visibility:hidden;"></iframe>
</div>

</body>

<script src="js/main.js"></script>

</html>