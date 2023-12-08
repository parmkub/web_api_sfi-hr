<?php


$documentNo = $_GET['documentNo'];
$typeLeave = $_GET['typeLeave'];




if ($typeLeave == '11'||$typeLeave == 'BA') {
    
$sql = "SELECT  
a.START_DATE,a.END_DATE, 
a.COUNT_DATE, 
b.first_name||' '|| 
b.last_name name, 
a.EMPLOYEE_CODE, 
a.ABSENCE_CODE,
a.ABSENCE_DAY, 
a.ABSENCE_HOUR,
a.DELETE_MARK, 
a.REVIEW, 
a.APPROVE, 
a.ABSENCE_PERIOD, 
a.ABSENCE_STATUS, 
a.ABSENCE_TOKEN, 
a.ABSENCE_DETAIL, 
a.ABSENCE_DOCUMENT, 
a.CREATION_DATE, 
a.STATUS_APPROVE, 
a.DEPART_CODE, 
a.DIVI_CODE, 
a.SECT_CODE,
b.sect_name,
b.divi_name,
b.depart_name,  
b.POSITION_NAME,
a.DATE_REVIEW,
a.DATE_APPROVE,
c.detail HEALTHY_DETAIL,
c.status_healthy ,
d.name name_doctor,
c.last_update_date
FROM  
sf_per_absence_moble_v a, 
sf_per_employees_v b,
SF_PER_EMPLOYEE_HEALTHY c,
sf_personal_healthy d

WHERE 
a.employee_code = b.employee_code
and c.document_id = a.absence_document
and a.absence_document = '$documentNo'  
and d.id_personal_healthy = c.id_personal_healthy";
}else{
   
$sql = "SELECT  
a.START_DATE,a.END_DATE, 
a.COUNT_DATE, 
b.first_name||' '|| 
b.last_name name, 
a.EMPLOYEE_CODE, 
a.ABSENCE_CODE,
a.ABSENCE_DAY, 
a.ABSENCE_HOUR,
a.DELETE_MARK, 
a.REVIEW, 
a.APPROVE , 
a.ABSENCE_PERIOD, 
a.ABSENCE_STATUS, 
a.ABSENCE_TOKEN, 
a.ABSENCE_DETAIL, 
a.ABSENCE_DOCUMENT, 
a.CREATION_DATE, 
a.STATUS_APPROVE, 
a.DEPART_CODE, 
a.DIVI_CODE, 
a.SECT_CODE,  
b.POSITION_NAME,
a.DATE_REVIEW,
a.DATE_APPROVE,

b.sect_name,
b.divi_name,
b.depart_name,
'' STATUS_HEALTHY,
'' HEALTHY_DETAIL,
'' NAME_DOCTOR,
'' LAST_UPDATE_DATE 


FROM  
sf_per_absence_moble_v a, 
sf_per_employees_v b

WHERE 
a.employee_code = b.employee_code
and a.absence_document = '$documentNo'  ";
}

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
    $startDate = $output['START_DATE'];
    $endDate = $output['END_DATE'];
    $employeeName = $output['NAME'];
    $employeeCode = $output['EMPLOYEE_CODE'];
    $positionName = $output['POSITION_NAME'];
    $sectCode = $output['SECT_CODE'];
    $diviCode = $output['DIVI_CODE'];
    $departCode = $output['DEPART_CODE'];
    $sectName = $output['SECT_NAME'];
    $diviName = $output['DIVI_NAME'];
    $departName = $output['DEPART_NAME'];
    $documentNo = $output['ABSENCE_DOCUMENT'];
    $creationDate = $output['CREATION_DATE'];
    $detail = $output['ABSENCE_DETAIL'];
    $review = $output['REVIEW'];
    $dateReview = $output['DATE_REVIEW'];
    $approve = $output['APPROVE'];
    $dateApprove = $output['DATE_APPROVE'];
    $absenceCode = $output['ABSENCE_CODE'];
    $countDay = $output['ABSENCE_DAY'];
    $countHour = $output['ABSENCE_HOUR'];
    $statusHeathy = $output['STATUS_HEALTHY'];
    $healthyDetail = $output['HEALTHY_DETAIL'];
    $nameDoctor = $output['NAME_DOCTOR'];
    $lastUpdateDate = $output['LAST_UPDATE_DATE'];
    $showCount = '';

 

    $img = str_split($employeeCode, 2);
    $ImgUrl = "http://61.7.142.47:8086/img/sfi/" . $img[0] . "-" . $img[1] . $img[2] . '.jpg';

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
