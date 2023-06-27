<?php 
 require_once 'connect.php';
    

    if(isset($_POST['appeal'])){
        $appeal = $_POST['appeal'];

        $insetSQL = "INSERT INTO sf_per_appeal (
            appeal,creat_date) 
        VALUES ('$appeal',sysdate)";
        $s = oci_parse($objConnect, $insetSQL);
        $objExecute = oci_execute($s);

 
    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }

    }

            
   

oci_close($objConnect);
