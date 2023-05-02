<?php

include('connect.php');

$datacodey=$_POST['datacode'];
    $datapiny=$_POST['datapin'];

 
    if(isset($datacodey)){

        $fetchdata=mysqli_query($connect, "SELECT * FROM datashares WHERE file_code='$datacodey' && file_pin='$datapiny' && status='' && data_type='1'");
        $countdata=mysqli_num_rows($fetchdata);
        if($countdata!='0'){
            
                        $data['status']='10';
                        echo json_encode($data);
                        exit();
                    
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