<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
   // require_once 'connect-test.php';
    

    $empcode = $_GET['empcode'];

    $sql = "select 
    max(summer_day)*8 Pakron, 
    SUBSTR(sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_29)*8),1,2) use ,
    (max(summer_day)*8 )-(SUBSTR(sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_29)*8),1,2)) diff
    FROM sfi.sf_per_stat_total tstat
    where employee_code = '$empcode'
    and TO_CHAR(TO_DATE(tstat.period_name,'MON-RR'),'RRRR') = TO_CHAR(TO_DATE(SYSDATE,'DD-MON-RR'),'RRRR')";
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
   
