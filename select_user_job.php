<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';


    $email = $_GET['email'];

    $sql = "SELECT
    *
FROM SF_PER_JOB_REGISTER a
WHERE a.email = '$email'";
$output = null;
   $response = oci_parse($objConnect, $sql,);

    if (oci_execute($response)) {
        while ($row =  oci_fetch_assoc($response)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } 



    oci_close($objConnect);
}
