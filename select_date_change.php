<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $absence_date = $_GET['absence_date'];
    $employee_code = $_GET['employee_code'];

    $sql = "SELECT
    absence_date,
    absence_day,
    absence_hour,
    move_from_date,
    'true' status
    FROM sf_per_absence
    WHERE absence_date = '$absence_date'
    and employee_code = '$employee_code'
    and absence_code in('01','29')
    and (absence_comment = 0 or absence_comment is null)";

    // $sql = "SELECT * From (
    //     SELECT
    //         absence_date,
    //         absence_day,
    //         absence_hour,
    //         move_from_date,
    //         'true' status,
    //         (decode(b.hour1,null,1,0) + decode(b.hour2,null,1,0) + decode(b.hour3,null,1,0) + decode(b.hour4,null,1,0) + decode(b.hour5,null,1,0) + decode(b.hour6,null,1,0)) Hour_null
    //         FROM sf_per_absence a ,sf_per_root_dtl b 
    //         WHERE a.employee_code = b.employee_code
    //         and a.absence_date = b.root_date
    //         and a.absence_date = '11-AUG-23'
    //         and a.employee_code = '570811'
    //         and a.absence_code in('01','29')
    //         and (a.absence_comment = 0 or a.absence_comment is null)) c
    //         where c.Hour_null <= 5";

   $response = oci_parse($objConnect, $sql,);
   $output = null;


       if(oci_execute($response)){
           while($row =  oci_fetch_assoc($response)){
               $output[] = $row;
           }
           //echo json_encode($output);
           if($output != null){
            echo json_encode($output);
            //echo 'true';
           }
           else {
            $output = array(['STATUS' => 'false']);
            echo json_encode($output);
           }
        //echo 'true';
       }
       else {
           echo 'false';
       }



   oci_close($objConnect);
  
}
   
