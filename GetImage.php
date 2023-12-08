<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    $username = $_GET['username'];


    // $location = $_GET['location'];

    $sql = "SELECT
    employee_code FROM sf_per_employees_fnduser_v where user_name = '$username'";
    $response = oci_parse($objConnect, $sql,);
    $output = null;


    if (oci_execute($response)) {
        while ($row =  oci_fetch_assoc($response)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
        echo "Null";
    }

    oci_close($objConnect);
}
