<?php
            include('connect.php');

            if(isset($_GET['fld'])){
                $filecode=$_GET['fld'];
                $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE file_code='$filecode'");
                $countdata=mysqli_num_rows($fetchdata);
                if($countdata!='0'){
                    $getall=mysqli_fetch_array($fetchdata);
                    $fileurl=$getall['file_url'];
                    $filepin=$getall['file_pin'];

                }
            }
        ?>

<div id="filearea" style="display:none;">
            <span id="fileimg"><img style="width:100px;" src="uploads/<?php echo $fileurl; ?>"></span>
            <div id="filedetails">
                <div id="fileydetails">
                <p>Can only access this Data once</p>
                <p><b>Data Code:</b> <span id="datacode"><?php echo $filecode; ?></span></p>
                <p><b>Data PIN:</b> <span id="datapin"><?php echo $filepin; ?></span></p>
                <p><b>Data Url:</b> <span id="dataurl"><a href="file/<?php echo $filecode; ?>">datatrans.xyz/file/<?php echo $filecode; ?></a></span></p>
                </div>
                <button onclick="myFunction()" onmouseout="outFunc()" class="tooltip">
                    <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                    Copy Details
                </button> 
                <button onclick="deletedata('<?php echo $filecode; ?>')">Delete</button>
            </div>
        </div>