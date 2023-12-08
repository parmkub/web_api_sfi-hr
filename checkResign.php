<?php 
 require_once 'connect.php';
    

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $empCode = $_GET['empCode'];

        $insetSQL = "SELECT
        employee_code
    FROM sf_per_employees_v
    WHERE employee_code = '$empCode'
    and resign_date is not null";
        $s = oci_parse($objConnect, $insetSQL);
        $objExecute = oci_execute($s);

        if ($row = oci_fetch_assoc($s)) { // ถ้ามีข้อมูลในฐานข้อมูล
            echo 'false';
        } else {

            echo 'true';
            oci_close($objConnect);
        }

    }

            
   

oci_close($objConnect);
