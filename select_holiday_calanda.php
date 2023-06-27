<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    

    $empcode = $_GET['empcode'];

    $sql = "SELECT absence_date,employee_code,absence_code,absence_day,absence_hour,absence_comment,move_from_date,delete_mark FROM sf_per_absence
    WHERE employee_code = '$empcode'
    AND to_char(absence_date,'YY')=to_char(SYSDATE,'YY')
    ";
   $response = oci_parse($objConnect, $sql,);
   $output = null;


       if(oci_execute($response)){
           while($row =  oci_fetch_assoc($response)){
               $output[] = $row;
           }
           echo json_encode($output);
       }
       else {
           echo "Null";
       }



   oci_close($objConnect);
  
}
   
