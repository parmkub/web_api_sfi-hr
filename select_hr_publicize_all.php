<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';


    // $location = $_GET['location'];

    $sql = "SELECT
    id,publicize_title,thumnail
   FROM  sf_per_hr_publicize 
   ORDER BY 1 desc";
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
