<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    

    $empcode = $_GET['empcode'];

    $sql = "Select * from
    (select 
           '<< Total >>' period_name
           ,TO_DATE('31-DEC'||SUBSTR(tstat.period_name,-2),'DD-MON-RR') perioddate
           ,TO_CHAR(TO_DATE(tstat.period_name,'MON-RR'),'RRRR') fiscal_year
           ,tstat.employee_code
           ,emp.title||' '||emp.first_name||' '||emp.last_name empname
           ,emp.position_code
           ,sect.sect_name,sect.divi_name
           ,sect.depart_name
           ,SUM(tstat.sai) sai
           ,sfi.sf_per_employee.trans_hrmn(SUM(tstat.sai_hrmn)) sai_hrmn
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_02))  lagit_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_11))  lapouy_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_12)) aubuttihat
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_14))  lacrod_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_23)) mattajit
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_25)) boud
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_29)) pukronh
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_AA)) aa
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_AB)) lagit_not_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_AC)) kadhang
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_AD)) ad
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_AE)) abrom_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_BA)) lapouy_not_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_BD))lacrod_net_jay
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.absence_BE)) be
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.summer_1used)) summer1
           ,sfi.sf_per_employee.trans_hrmn2(SUM(tstat.summer_2used)) summer2
    
           ,null N02
           ,null N11
           ,null N12
           ,null N14
           ,null N23
           ,null N25
           ,null N29
           ,null Naa
           ,null Nab
           ,null Nac
           ,null Nad
           ,null Nae
           ,null Nba
           ,null Nbd
           ,null Nbe
           ,null Nsummer1
           ,null Nsummer2
    
            ,sfi.sf_per_employee.trans_hrmn2(SUM(NVL(tstat.absence_02,0)+NVL(tstat.absence_11,0)+NVL(tstat.absence_AC,0)+NVL(tstat.absence_AB,0)+NVL(tstat.absence_BA,0)))   N02_11
           ,sfi.sf_per_employee.trans_hrmn2(SUM(NVL(tstat.working_mn,0))/60 )  working_day
    
           ,tstat.summer_date
        ,max(tstat.summer_day) summer_day
    
           ,emp.employee_group
           ,decode(emp.resign_date,null,null,'ÅÒÍÍ¡') resign_flag
          ,sect.per_depart
          ,sect.depart_code
          ,sect.divi_code
          ,null holiday_day
           ,null holiday_num
          ,null  holiday_2num 
          ,null holiday_start_date
         ,null holiday_end_date
          ,null holiday_2start_date  
        ,null holiday_2end_date 
    ,case when pos.position_group_code like '01%'   Then 'Daily' Else 'Monthly' end group_employee
    ,NULL  position_f_group_name
    from sfi.sf_per_stat_total tstat
         ,SFI.SF_PER_EMPLOYEES emp
    ,SFI.SF_PER_POSITION_MST POS
         ,sfi.sf_per_sectdept_V sect
    WHERE emp.employee_code = tstat.employee_code
     and substr(emp.position_code,1,4) = sect.per_depart
     and emp.position_code = pos.position_code
    
    ---and emp.employee_code = '480001'
    GROUP BY  '<< Total >>'
           ,TO_DATE('31-DEC'||SUBSTR(tstat.period_name,-2),'DD-MON-RR')
           ,TO_CHAR(TO_DATE(tstat.period_name,'MON-RR'),'RRRR') 
           ,tstat.employee_code
           ,emp.title||' '||emp.first_name||' '||emp.last_name 
           ,emp.position_code
           ,sect.sect_name
           ,sect.divi_name
           ,sect.depart_name 
           ,emp.employee_group
           ,decode(emp.resign_date,null,null,'ÅÒÍÍ¡') 
           ,sect.per_depart
               ,sect.depart_code
          ,sect.divi_code
           ,tstat.summer_date
     ,case when pos.position_group_code like '01%'   Then 'Daily' Else 'Monthly' end  )a
     
     WHERE a.employee_code = '$empcode'
     AND a.fiscal_year = to_char(SYSDATE,'YYYY')";
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
   
