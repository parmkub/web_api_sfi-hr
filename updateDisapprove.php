<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'connect.php';
    //require_once 'connect-test.php';
    $absenceDocument = $_POST['absenceDocument'];
    $reason = $_POST['reason'];

        $sqlUpdate = "UPDATE sf_per_absence_mobile a  SET a.DETAIL_APPROVE ='$reason',a.STATUS_APPROVE = 'disapprove'
               WHERE a.ABSENCE_DOCUMENT = '$absenceDocument'";
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