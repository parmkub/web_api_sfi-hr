<?php 
 require_once 'connect.php';
    $documentNo = $_GET['documentNo'];

    $sql = "SELECT * FROM sf_per_absence_mobile a
    WHERE a.ABSENCE_DOCUMENT = '$documentNo'";

$response = oci_parse($objConnect, $sql,);
$output = null;


    if(oci_execute($response)){
        while($row =  oci_fetch_assoc($response)){
            $insetSQL = "INSERT INTO sf_per_absence (
                ABSENCE_DATE,
                EMPLOYEE_CODE,
                ABSENCE_CODE,
                ABSENCE_DAY,
                ABSENCE_HOUR,
                ABSENCE_COMMENT,
                DELETE_MARK,
                CREATION_DATE,
                CREATED_BY,
                LAST_UPDATE_DATE,
                LAST_UPDATED_BY,
                ABSENCE_PERIOD,
                LEAVE_DESC,
                ABSENCE_DOCUMENT) 
            VALUES ('".$row['ABSENCE_DATE']."',
                '".$row['EMPLOYEE_CODE']."',
                '".$row['ABSENCE_CODE']."',
                '".$row['ABSENCE_DAY']."',
                '".$row['ABSENCE_HOUR']."',
                '0',
                 0,
                SYSDATE,
                '9999',
                SYSDATE,
                '9999',
                to_char(SYSDATE,'MON-YY'),
                '".$row['ABSENCE_DETAIL']."',
                '".$row['ABSENCE_DOCUMENT']."')";
            $s = oci_parse($objConnect, $insetSQL);
            $objExecute = oci_execute($s);

            //$output[] = $row;
        }
        if ($objExecute) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    else {
        echo "1";
    }

oci_close($objConnect);
?>