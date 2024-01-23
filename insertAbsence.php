
<!--หมายเหตุ เพิ่มส่วนงานกรุงเทพด้วยการส่งเมลล์เมื่อมีการอนุมัติใบลา 20-12-2023 -->

<?php
require_once 'connect.php';
$documentNo = $_GET['documentNo'];

$sql = "SELECT DISTINCT b.employee_place FROM sf_per_absence_mobile a ,sf_per_employees_v b
WHERE a.ABSENCE_DOCUMENT = '$documentNo'
and a.employee_code = b.employee_code";

$employee_place = oci_parse($objConnect, $sql);

oci_execute($employee_place);
$row = oci_fetch_assoc($employee_place);
$employee_place = $row['EMPLOYEE_PLACE'];


if ($employee_place == 'CHP' || $employee_place == 'FRM') {

    $sql = "SELECT * FROM sf_per_absence_mobile a
WHERE a.ABSENCE_DOCUMENT = '$documentNo'";

    $response = oci_parse($objConnect, $sql,);
    $output = null;

    if (oci_execute($response)) {
        $checkDuplicate = "SELECT * FROM sf_per_absence a
WHERE a.ABSENCE_DOCUMENT = '$documentNo'";
        $responseCheck = oci_parse($objConnect, $checkDuplicate,);
        $outputCheck = null;
        oci_execute($responseCheck);
        $rowCheck = oci_fetch_assoc($responseCheck);

        if ($rowCheck) {
            echo 'duplicate';
            exit();
        } else {

            while ($row =  oci_fetch_assoc($response)) {
                if ($row['ABSENCE_CODE'] == 'ฺBA' || $row['ABSENCE_CODE'] == '11') {
                    $columDetail = 'SICK_DESC';
                } else {
                    $columDetail = 'LEAVE_DESC';
                }

                $preiodDate = date('M-y', strtotime($row['ABSENCE_DATE']));

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
            $columDetail,
            ABSENCE_DOCUMENT) 
        VALUES ('" . $row['ABSENCE_DATE'] . "',
            '" . $row['EMPLOYEE_CODE'] . "',
            '" . $row['ABSENCE_CODE'] . "',
            '" . $row['ABSENCE_DAY'] . "',
            '" . $row['ABSENCE_HOUR'] . "',
            '0',
             0,
            SYSDATE,
            '9999',
            SYSDATE,
            '9999',
            '$preiodDate',
            '" . $row['ABSENCE_DETAIL'] . "',
            '" . $row['ABSENCE_DOCUMENT'] . "')";
                $s = oci_parse($objConnect, $insetSQL);
                $objExecute = oci_execute($s);

                //$output[] = $row;
            }
            if ($objExecute) {

                $sql = "select DISTINCT
                a.eng_title||a.eng_first_name ||'_'||a.eng_last_name name,
                a.employee_code
                from sf_per_employees_v a,sf_per_absence_mobile b
                where a.employee_code = b.employee_code
                and b.absence_document = '$documentNo'";
                $response = oci_parse($objConnect, $sql,);
                $output = null;
                $employee_code = null;
                $name = null;

                if (oci_execute($response)) {
                    while ($row =  oci_fetch_assoc($response)) {
                        $employee_code = $row['EMPLOYEE_CODE'];
                        $name = $row['NAME'];
                    }
                    sendEmailToHR($documentNo, $name,$employee_place);
                }

                echo 'true';
            } else {
                echo 'false';
            }
        }
    } else {
        echo "1";
    }
} else if ($employee_place == 'BKK') {
    echo $employee_place;


    $sql = "select DISTINCT
    a.eng_title||a.eng_first_name ||'_'||a.eng_last_name name,
    a.employee_code
    from sf_per_employees_v a,sf_per_absence_mobile b
    where a.employee_code = b.employee_code
    and b.absence_document = '$documentNo'";

    $response = oci_parse($objConnect, $sql,);
    $output = null;
    $employee_code = null;
    $name = null;

    if (oci_execute($response)) {
        while ($row =  oci_fetch_assoc($response)) {
            $employee_code = $row['EMPLOYEE_CODE'];
            $name = $row['NAME'];
        }
    }
    echo $employee_code;
    echo $name;
    sendEmailToHR($documentNo, $name,$employee_place);
    
}
oci_commit($objConnect);

oci_close($objConnect);


function sendEmailToHR($documentNo, $name,$employee_place)
{
    if($employee_place == 'CHP' || $employee_place == 'FRM'){
        $url = "http://61.7.142.47:3002/leavingAlert?documentNo=$documentNo&name=$name";
    }
    else if($employee_place == 'BKK'){
        $url = "http://61.7.142.47:3002/sendMailHrBkk?documentNo=$documentNo&name=$name";

    }
    //echo $url;

    $response = file_get_contents($url); // ทำคำขอ GET

    // ตรวจสอบว่ามีข้อมูลที่ได้รับหรือไม่
    if ($response !== false) {
        // ทำอะไรกับข้อมูลที่ได้รับ เช่น แปลง JSON หรือประมวลผลข้อมูล
        $decoded_response = json_decode($response, true); // แปลง JSON เป็น Associative Array

        // ตรวจสอบว่าการแปลง JSON สำเร็จหรือไม่
        if ($decoded_response !== null) {
            // ทำอะไรกับข้อมูลที่ได้หลังจากแปลง JSON
           // print_r($decoded_response);
        } else {
            // ไม่สามารถแปลง JSON ได้
           // echo "ไม่สามารถแปลงข้อมูล JSON ได้";
        }
    } else {
        // ไม่สามารถรับข้อมูลจาก URL ได้
        //echo "ไม่สามารถรับข้อมูลจาก URL ได้";
    }
}


?>
