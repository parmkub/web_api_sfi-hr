<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
   // require_once 'connect-test.php';
    

    $empcode = $_GET['empcode'];

    $sql = "SELECT 
    (SELECT MAX(b.absence_date)
        FROM sf_per_absence_mobile b
        WHERE b.absence_document = a.absence_document) End_date,
        (SELECT Min(b.absence_date)
        FROM sf_per_absence_mobile b 
        WHERE b.absence_document = a.absence_document) Start_date,
        (SELECT COUNT(*) from sf_per_absence_mobile c
        WHERE c.absence_document = a.absence_document) Count_date,
        a.employee_code,
        a.absence_code,
        a.absence_day,
        a.absence_hour,
        a.delete_mark,
        NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_review),'...')review,
         NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_approve),'...')approve,
        a.absence_period,
        a.absence_status,
        a.absence_token,
        a.absence_detail,
        a.ABSENCE_DOCUMENT,
        a.CREATION_DATE,
        a.STATUS_APPROVE
        FROM sf_per_absence_mobile a
        WHERE a.employee_code = '$empcode'
        AND SUBSTR(ABSENCE_DATE,8,2) = to_char(SYSDATE,'yy')
        GROUP BY employee_code,
        a.absence_code,
        a.absence_day,
        a.absence_hour,
        a.delete_mark,
        a.absence_review,
        a.absence_approve,
        a.absence_period,
        a.absence_status,
        a.absence_token,
        a.absence_detail,
        a.ABSENCE_DOCUMENT,
        a.CREATION_DATE,
        a.STATUS_APPROVE
        ORDER by creation_date ASC";
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
   
