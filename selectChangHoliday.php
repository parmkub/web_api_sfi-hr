<?php 
$documentNo = $_GET['documentNo'];

$sql = "SELECT 
c.creation_date,
c.ABSENCE_DOCUMENT,
c.ABSENCE_DATE_FROM,
c.ABSENCE_DATE_TO,
emp.title||emp.first_name ||' '||emp.last_name name,
emp.employee_code,
emp.sect_name,
emp.depart_name,
emp.position_name,
emp.divi_name,
c.absence_detail,
(select emp.title||emp.first_name ||' '||emp.last_name FROM sf_per_employees_v emp WHERE emp.employee_code = c.absence_review) absence_review, 
    (select emp.title||emp.first_name ||' '||emp.last_name FROM sf_per_employees_v emp WHERE emp.employee_code = c.ABSENCE_APPROVE) ABSENCE_APPROVE, 
c.absence_day day,
c.absence_hour hour
FROM sf_per_absence_chang c,sf_per_employees_v emp
where emp.employee_code = c.employee_code
and c.absence_document  = '$documentNo'";

$result = oci_parse($objConnect, $sql,);
oci_execute($result);
while (($row = oci_fetch_assoc($result)) != false) {
 $output = $row;
 
}

$documentNo = $output['ABSENCE_DOCUMENT'];
$dateFrom = $output['ABSENCE_DATE_FROM'];
$dateTo = $output['ABSENCE_DATE_TO'];
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
$countDay = $output['DAY'];
$countHour = $output['HOUR'];
$showCount ='';



$img = str_split($employeeCode,2);
 $ImgUrl = "http://10.2.2.5/img/sfi/".$img[0]."-".$img[1].$img[2].'.jpg';
 

if($countDay >= 1){
    $showCount = $countDay.' วัน';
}else{
    $showCount = $countHour.' ชั่วโมง';
}
