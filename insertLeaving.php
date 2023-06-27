<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    
    $absence_document = $_POST['absence_document'];
    $absence_date = $_POST['absence_date'];
    $employee_code = $_POST['employee_code'];
    $absence_code = $_POST['absence_code'];
    $absence_day = $_POST['absence_day'];
    $absence_hour = $_POST['absence_hour'];
    $absence_status = $_POST['absence_status'];
    $absence_detail = $_POST['absence_detail'];
    $absence_token = $_POST['absence_token'];
    $dayCount = $_POST['dayCount'];

    $startdate = strtotime("$absence_date");//วันที่เริ่มหยุด
    $enddate = strtotime("+$dayCount day", $startdate);

    while ($startdate < $enddate) {
        $_absence_date =  date("d-M-y", $startdate);
        $startdate = strtotime("+1 day", $startdate);

        $sql = "INSERT INTO sf_per_absence_mobile (absence_document,absence_date, employee_code, absence_code, absence_day,
        absence_hour,delete_mark,absence_period,absence_status,absence_detail,absence_token,CREATION_DATE,CREATED_BY,LAST_UPDATE_DATE,LAST_UPDATED_BY)
        VALUES('$absence_document','$_absence_date' ,'$employee_code','$absence_code','$absence_day',$absence_hour,0,
        to_char(SYSDATE,'MON-YY'),$absence_status,'$absence_detail','$absence_token',SYSDATE,1165,SYSDATE,1165)";

        $s = oci_parse($objConnect, $sql);
        $objExecute = oci_execute($s);
       
    }
    if ($objExecute) {
        echo 'true';
    } else {
        echo 'false';
    }
  

    oci_commit($objConnect);
    oci_close($objConnect);
}
