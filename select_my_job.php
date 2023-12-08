<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $userID = $_GET['user_id'];

    $sql ="SELECT
    *
    
FROM sf_per_my_job m, sf_per_job_blank j
WHERE  m.job_id = j.job_id
and m.user_id = '$userID'";

$response = oci_parse($objConnect, $sql,);
$output = null;


if (oci_execute($response)) {
    while ($row =  oci_fetch_assoc($response)) {
        $output[] = $row;
    }
    echo json_encode($output);
} 
    oci_close($objConnect);

}