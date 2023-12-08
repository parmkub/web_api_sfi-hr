<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $job_id = $_GET['job_id'];
    $user_id = $_GET['user_id'];

    $sqlQery = "SELECT
    *
FROM sf_per_my_job
WHERE job_id = '$job_id'
and user_id = '$user_id'";
    $response = oci_parse($objConnect, $sqlQery,);
    oci_execute($response, OCI_DEFAULT);
    $objResult = oci_fetch_array($response);

    if ($objResult) {
        echo 'true';
    } else {
        echo 'false';
    }
    oci_close($objConnect);
}
