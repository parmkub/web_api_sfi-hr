<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $empCode = $_GET['empcode'];



    $sql = "SELECT
    token
FROM sf_emp_mobile_token
where empcode = '$empCode'";

    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($row = oci_fetch_assoc($s)) {
        $result[] = $row;
        echo json_encode($result);
        oci_close($objConnect);
    } else {

        echo 'null';
        oci_close($objConnect);
    }



}
?>
