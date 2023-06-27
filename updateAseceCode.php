<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'connect.php';
    //require_once 'connect-test.php';
    $absenceCode = $_POST['absenceCode'];
    $absenceDocument = $_POST['documentNo'];

        $sqlUpdate1 = "UPDATE sf_per_absence_mobile a  SET a.ABSENCE_CODE ='$absenceCode'
               WHERE a.ABSENCE_DOCUMENT = '$absenceDocument'";
        $s1 = oci_parse($objConnect, $sqlUpdate1);
        $objExecute1 = oci_execute($s1);

        $sqlUpdate2 = "UPDATE sf_per_absence a  SET a.ABSENCE_CODE ='$absenceCode'
               WHERE a.ABSENCE_DOCUMENT = '$absenceDocument'";
        $s2 = oci_parse($objConnect, $sqlUpdate2);
        $objExecute2 = oci_execute($s2);



        if ($objExecute1&&$objExecute2) {
            echo 'true';
        } else {
            $e = oci_error($objExecute);
            echo 'false';
        }
        oci_commit($objConnect);
    oci_close($objConnect);
    
}

?>