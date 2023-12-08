<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

     require_once 'connect.php';
    //require_once 'connect-test.php';
    $job_id = $_GET['job_id'];
  

    $sql = "DELETE FROM sfi.sf_per_my_job a
    WHERE a.job_id = '$job_id'";

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
