<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';


    $empcode = $_GET['empcode'];

    $sql = "SELECT
    *
FROM SF_PER_STAT_LAVE_V a
WHERE a.employee_code = '$empcode'
and a.fiscal_year = to_char(SYSDATE,'YYYY')";
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
