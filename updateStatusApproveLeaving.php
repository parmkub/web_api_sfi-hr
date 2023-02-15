<?php

use JetBrains\PhpStorm\Language;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'connect.php';
    //require_once 'connect-test.php';
    $absenceDocument = $_GET['absenceDocument'];
    $statusApprove = $_GET['statusApprove'];
    $columeApprove = $_GET['columeApprove'];
    $empCode =$_GET['empCode'];
  

        $sqlUpdate = "UPDATE sf_per_absence_mobile a  SET a.absence_status ='$statusApprove',a.$columeApprove = '$empCode'
               WHERE a.ABSENCE_DOCUMENT = '$absenceDocument'";
        $s = oci_parse($objConnect, $sqlUpdate);
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
