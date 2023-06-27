<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    
    $absence_document = $_POST['absence_document'];
    $absence_date_from = $_POST['absence_date_from'];
    $absence_date_to = $_POST['absence_date_to'];
    $employee_code = $_POST['employee_code'];
    $absence_day = $_POST['absence_day'];
    $absence_hour = $_POST['absence_hour'];
    $absence_detail = $_POST['absence_detail'];
    $absence_token = $_POST['absence_token'];


        $sql = "INSERT INTO sf_per_absence_chang (ABSENCE_DOCUMENT,ABSENCE_DATE,ABSENCE_DATE_FROM,ABSENCE_DATE_TO,EMPLOYEE_CODE,ABSENCE_DAY,
        absence_hour,absence_period,absence_status,status_approve,absence_detail,absence_token,CREATION_DATE,CREATED_BY,LAST_UPDATE_DATE,LAST_UPDATED_BY)
        VALUES('$absence_document',SYSDATE,'$absence_date_from','$absence_date_to','$employee_code',$absence_day,$absence_hour,to_char(SYSDATE,'MON-YY'),0,'0','','$absence_token',SYSDATE,1165,SYSDATE,1165)";

        $s = oci_parse($objConnect, $sql);
        $objExecute = oci_execute($s);
       
    
    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
  

    oci_commit($objConnect);
    oci_close($objConnect);
}
