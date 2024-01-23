<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    $empCode = $_POST['employee_code'];
    $code = "";

    //เช็ค รหัสพนักงาน ว่ามีในฐานข้อมูลหรือไม่
    $sql = "SELECT
            *
            FROM sf_per_employees_v
            where employee_code = '$empCode'
            and resign_date is null";

    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);
    if ($objExecute) {
        if ($row = oci_fetch_assoc($s)) {
            $empCode = $row['EMPLOYEE_CODE'];
            $sql = "SELECT
            code
        FROM (SELECT
                *
                FROM sf_per_apphr_ios
                where employee_code is null
                and status  is null
                ORDER BY 1 ASC)
        WHERE ROWNUM = 1";

            $s = oci_parse($objConnect, $sql);
            $objExecute = oci_execute($s);

            if ($row = oci_fetch_assoc($s)) {
                $code = $row['CODE'];
                if ($code != "") {
                    $sql = "UPDATE sf_per_apphr_ios
                SET employee_code = '$empCode', status = 'Y'
                WHERE code = '$code'";
                    $s = oci_parse($objConnect, $sql);
                    $objExecute = oci_execute($s);
                    if ($objExecute) {
                        //convert mordata to json
                        $result = array("code" => $code, "employee_code" => $empCode);
                        echo json_encode($result);
                    } else {
                        echo "false";
                    }
                }


            } else {

                echo 'Null';
            }
         
            //echo $empCode;
        } else {
        //convert to json
        $result = array("code" => "Null", "employee_code" => "Null");
        echo json_encode($result);
            
        }
    }
    oci_close($objConnect);
}
