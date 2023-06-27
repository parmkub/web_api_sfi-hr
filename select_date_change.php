<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $absence_date = $_GET['absence_date'];
    $employee_code = $_GET['employee_code'];

    $sql = "SELECT
    absence_date
    FROM sf_per_absence
    WHERE absence_date = '$absence_date'
    and employee_code = '$employee_code'
    and absence_code = '01'
    and MOVE_FROM_DATE is null
    and absence_comment is null ";

   $response = oci_parse($objConnect, $sql,);
   $output = null;


       if(oci_execute($response)){
           while($row =  oci_fetch_assoc($response)){
               $output[] = $row;
           }
           //echo json_encode($output);
           if($output != null){
            echo 'true';
           }
           else {
            echo 'false';
           }
        //echo 'true';
       }
       else {
           echo 'false';
       }



   oci_close($objConnect);
  
}
   
