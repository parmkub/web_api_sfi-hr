<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
   // require_once 'connect-test.php';
    

    $empcode = $_GET['empcode'];

    // $sql = "select 
    // max(summer_day)*8 Pakron, 
    // SUBSTR(sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_29)*8),1,2) use ,
    // (max(summer_day)*8 )-(SUBSTR(sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_29)*8),1,2)) diff
    // FROM sfi.sf_per_stat_total tstat
    // where employee_code = '$empcode'
    // and TO_CHAR(TO_DATE(tstat.period_name,'MON-RR'),'RRRR') = TO_CHAR(TO_DATE(SYSDATE,'DD-MON-RR'),'RRRR')";

    $sql = "SELECT
    DISTINCT
    (SELECT
    nvl(holiday_num,0) + nvl(holiday_2num,0)
         FROM sf_per_yholiday
         where year = to_char(SYSDATE,'RRRR')
         and employee_code = '$empcode'
         )clain_pakron,
     
     (SELECT
     nvl((sum(nvl(a.absence_day,0)*8)+sum(nvl(a.absence_hour,0)))/8 ,0)
     
         FROM sfi.sf_per_absence a    
         where a.employee_code = '$empcode'
         and a.absence_code = '29'
         and TO_CHAR(absence_date,'RRRR') = to_char(SYSDATE,'RRRR')
         and nvl(a.absence_comment,0) =0)USE_PAKRON,
         
         (SELECT
         nvl(holiday_num,0) + nvl(holiday_2num,0)
         FROM sf_per_yholiday
         where year = to_char(SYSDATE,'RRRR')
         and employee_code = '$empcode'
         ) - (SELECT
     nvl((sum(nvl(a.absence_day,0)*8)+sum(nvl(a.absence_hour,0)))/8,0)  
         FROM sfi.sf_per_absence a    
         where a.employee_code = '$empcode'
         and a.absence_code = '29'
         and TO_CHAR(absence_date,'RRRR') = TO_CHAR(SYSDATE,'RRRR')
         and nvl(a.absence_comment,0) =0)DIFF_PAKRON
    
 FROM sf_per_yholiday a,sf_per_absence b
 where b.employee_code = a.employee_code
 and a.employee_code = '$empcode'
 and a.year = TO_CHAR(SYSDATE,'RRRR')
 and b.absence_code = '29'";
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
   
