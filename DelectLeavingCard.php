<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

     require_once 'connect.php';
    //require_once 'connect-test.php';
    $leavDocument = $_GET['leavDocument'];
  

    $sql = "DELETE FROM sfi.sf_per_absence_mobile a
    WHERE a.absence_document = '$leavDocument'";

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
