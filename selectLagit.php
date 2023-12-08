<?php
$documentNo = $_GET['documentNo'];


$sql = "SELECT Min(absence_date),
Max(absence_date),
SUM(ABSENCE_DAY) day,
SUM(absence_hour) hour,
EMPLOYEE_CODE,
(Select  title||first_name||' '||last_name from sf_per_employees_v where employee_code = m.employee_code)name,
absence_document,
CREATION_DATE,
ABSENCE_DETAIL,
ABSENCE_CODE,
(Select  POSITION_NAME from sf_per_employees_v where employee_code = m.employee_code)position_name,
(Select  SECT_NAME from sf_per_employees_v where employee_code = m.employee_code)SECT_NAME,
(Select  DIVI_NAME from sf_per_employees_v where employee_code = m.employee_code)DIVI_NAME,
(Select  DEPART_NAME from sf_per_employees_v where employee_code = m.employee_code)DEPART_NAME,
(Select  title||first_name||' '||last_name from sf_per_employees_v where employee_code = m.ABSENCE_REVIEW)ABSENCE_REVIEW,
(Select  title||first_name||' '||last_name from sf_per_employees_v where employee_code = m.ABSENCE_APPROVE)ABSENCE_APPROVE
FROM sf_per_absence_mobile m
where ABSENCE_DOCUMENT = '$documentNo'
group by EMPLOYEE_CODE,absence_document,CREATION_DATE,
ABSENCE_DETAIL,
ABSENCE_CODE,
ABSENCE_REVIEW,
ABSENCE_APPROVE";

$result = oci_parse($objConnect, $sql,);
oci_execute($result);
while (($row = oci_fetch_assoc($result)) != false) {
    $output = $row;
}
if (!$output) {
    echo 'false';
    exit();
} else {


    $documentNo = $output['ABSENCE_DOCUMENT'];
    $startDate = $output['MIN(ABSENCE_DATE)'];
    $endDate = $output['MAX(ABSENCE_DATE)'];
    $employeeName = $output['NAME'];
    $employeeCode = $output['EMPLOYEE_CODE'];
    $positionName = $output['POSITION_NAME'];
    $sectName = $output['SECT_NAME'];
    $diviName = $output['DIVI_NAME'];
    $departName = $output['DEPART_NAME'];
    $documentNo = $output['ABSENCE_DOCUMENT'];
    $creationDate = $output['CREATION_DATE'];
    $detail = $output['ABSENCE_DETAIL'];
    $review = $output['ABSENCE_REVIEW'];
    $approve = $output['ABSENCE_APPROVE'];
    $absenceCode = $output['ABSENCE_CODE'];
    $countDay = $output['DAY'];
    $countHour = $output['HOUR'];
    $showCount = '';



    $img = str_split($employeeCode, 2);
    $ImgUrl = "http://10.2.2.5/img/sfi/" . $img[0] . "-" . $img[1] . $img[2] . '.jpg';

    if ($absenceCode == "02") {
        $absenceName = 'ลากิจจ่าย';
    } else if ($absenceCode == "AB") {
        $absenceName = 'ลากิจไม่จ่าย';
    } else {
        $absenceName = 'ไม่มีข้อมูล';
    }

    if ($countDay >= 1) {
        $showCount = $countDay . ' วัน';
    } else {
        $showCount = $countHour . ' ชั่วโมง';
    }
}
