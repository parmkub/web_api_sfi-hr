<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //require_once 'connect.php';
    require_once 'connect.php';
    

    $empcode = $_GET['empcode'];

    $sql = "SELECT
    v.first_name ||' '||v.last_name name, 
    c.employee_code ,
    c.absence_status,
    c.absence_date_from,
    c.absence_date_to,
    c.absence_document,
    c.absence_day,
    c.absence_hour,
    nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_review) ,'...')absence_review,
    nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_approve) ,'...')absence_approve, 
    c.status_approve,
    c.creation_date,
    c.absence_token
FROM sf_per_absence_chang c,sf_per_employees_v v
WHERE c.employee_code = v.employee_code 
and c.employee_code = '$empcode'
order by c.creation_date desc";
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
   
