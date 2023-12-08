<?php
require_once 'connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $selectSQL = "SELECT * FROM SF_PER_JOB_REGISTER WHERE email = '$email'";
    $response = oci_parse($objConnect, $selectSQL);
    oci_execute($response, OCI_DEFAULT);
    $objResult = oci_fetch_array($response);
    if ($objResult) {
        echo 'duplicate';
    } else {

        $insetSQL = "INSERT INTO SF_PER_JOB_REGISTER (
            email,password,PHONE,CREATE_DATE,UPDATE_DATE) 
        VALUES ('$email','$password','$phone',sysdate,sysdate)";
        $s = oci_parse($objConnect, $insetSQL);
        $objExecute = oci_execute($s);


        if ($objExecute) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
oci_commit($objConnect);




oci_close($objConnect);
