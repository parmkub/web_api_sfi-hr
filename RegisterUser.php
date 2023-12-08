<?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //require_once 'connect.php';
    require_once 'connect.php';
    $empCode = $_POST['empCode'];
    $nAme = $_POST['nAme'];
    $email = $_POST['email'];
    $passAuthen = $_POST['passAuthen'];

        $sqlInsert = "INSERT INTO sfi.sf_emp_mobile_token (EMPCODE,NAME,PASS_AUTHEN,EMAIL,RESIGN_STATUS,CREATE_DATE,LAST_UPDATE_DATE)
        VALUES('$empCode','$nAme','$passAuthen','$email','N',sysdate,sysdate)";

        $s = oci_parse($objConnect, $sqlInsert);
        $objExecute = oci_execute($s);
    
        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }
    
    oci_commit($objConnect);
    oci_close($objConnect);
}
