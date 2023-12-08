<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'connect.php';
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    


        $sqlUpdate = "UPDATE SF_PER_JOB_REGISTER a  SET a.PASSWORD ='$password' WHERE a.ID = '$user_id'";
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