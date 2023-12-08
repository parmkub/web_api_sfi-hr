<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'connect.php';
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


        $sqlUpdate = "UPDATE SF_PER_JOB_REGISTER a  SET a.FIRST_NAME ='$first_name',
        a.LAST_NAME = '$last_name',a.PHONE = '$phone',a.ADDRESS = '$address'
               WHERE a.ID = '$user_id'";
        $s = oci_parse($objConnect, $sqlUpdate);
        $objExecute = oci_execute($s);

        if ($objExecute) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }
        oci_commit($objConnect);
        oci_close($objConnect);
    
}

?>