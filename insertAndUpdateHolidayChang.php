<?php 
 require_once 'connect.php';
    $documentNo = $_GET['documentNo'];

    $sql = "SELECT * FROM sf_per_absence_chang a
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
                MOVE_FROM_DATE,
                ABSENCE_COMMENT,
                DELETE_MARK,
                CREATION_DATE,
                CREATED_BY,
                LAST_UPDATE_DATE,
                LAST_UPDATED_BY,
                ABSENCE_PERIOD,
                LEAVE_DESC,
                ABSENCE_DOCUMENT) 
            VALUES ('".$row['ABSENCE_DATE_TO']."',
                '".$row['EMPLOYEE_CODE']."',
                '01',
                '".$row['ABSENCE_DAY']."',
                '".$row['ABSENCE_HOUR']."',
                '".$row['ABSENCE_DATE_FROM']."',
                '0',
                 0,
                SYSDATE,
                '9999',
                SYSDATE,
                '9999',
                to_char(SYSDATE,'MON-YY'),
                '',
                '".$row['ABSENCE_DOCUMENT']."')";
             $s = oci_parse($objConnect, $insetSQL);
             $objExecute = oci_execute($s);

        // echo $row['ABSENCE_DAY'];

            if($row['ABSENCE_DAY'] == "1"){
                $updateSQL = "UPDATE sf_per_absence SET absence_comment = '2',
                ABSENCE_BALANCE = 0, LAST_UPDATE_DATE = SYSDATE,LAST_UPDATED_BY = '9999'
                WHERE ABSENCE_DATE = '$row[ABSENCE_DATE_FROM]' 
                and EMPLOYEE_CODE = '$row[EMPLOYEE_CODE]'";
               
            }else if($row['ABSENCE_HOUR'] == "4"){
                $updateSQL = "UPDATE sf_per_absence SET ABSENCE_DAY = '0',ABSENCE_HOUR = '4',LAST_UPDATE_DATE = SYSDATE
                WHERE ABSENCE_DATE = '$row[ABSENCE_DATE_FROM]' AND EMPLOYEE_CODE = '$row[EMPLOYEE_CODE]'";
            }
           // echo $updateSQL;

             $s1 = oci_parse($objConnect, $updateSQL);
            $objExecute2 = oci_execute($s1);

            require_once 'updateOldDayChang.php';


            // echo $output[] = $row;
        }
        if ($objExecute && $objExecute2) {
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