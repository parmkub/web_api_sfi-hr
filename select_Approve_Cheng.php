<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';


    $code = $_GET['code'];
    $namePosiyer = $_GET['namePosiyer'];
    $positionGroupCode = $_GET['positionGroupCode'];
    // $selectStatus = $_GET['selectStatus'];

    $inPosition = array();
     // ดึงรหัสพนักงาน
    $sqlGetEmpCode = "SELECT
                        employee_code
                        FROM sf_per_employees_v
                        where $namePosiyer = '$code'
                        and position_group_code = '$positionGroupCode'
                        and resign_date is null";
    //echo $sqlGetEmpCode;
    $response = oci_parse($objConnect, $sqlGetEmpCode);
    oci_execute($response);
    while ($row = oci_fetch_array($response)) {
        $empCode = $row[0];
    }
    

    $sqlGetPosition = "select $namePosiyer FROM sf_per_employees_dup_v where employee_code = '$empCode'";

    //echo $sqlGetPosition;
    $response = oci_parse($objConnect, $sqlGetPosition);
    oci_execute($response);
    while ($row = oci_fetch_array($response)) {
        $inPosition[] = $row[0];
    }

    $quoteArray = array_map(function ($value) {
        return "'" . $value . "'";
    }, $inPosition);

    // ใช้ implode เพื่อรวมค่าทั้งหมดใน array ให้เป็น string โดยคั่นด้วย comma
    $stringInPosition = "in (" . implode(",", $quoteArray) . ")";

    if ($code == '1200') { //ฝ่ายโรงงาน
        $sql = "SELECT
        emp.title||emp.first_name||' '||emp.last_name name,
        emp.employee_code,
        c.absence_status,
        c.absence_date_from,
        c.absence_date_to,
        c.absence_document,
        c.absence_day,
        c.absence_hour,
        nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_review) ,'...')absence_review,
        nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_approve) ,'...')absence_approve, 
        c.status_approve,
        c.creation_date,
        c.absence_token
    FROM sf_per_absence_chang c,
    sf_per_employees_v emp
    WHERE c.employee_code = emp.employee_code
    and emp.position_group_code != '$positionGroupCode'
    and emp.$namePosiyer in('$code')
    and emp.position_group_code > 031
    and to_char(c.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
    order by c.creation_date desc";
    } else {

        $sql = "SELECT
    emp.title||emp.first_name||' '||emp.last_name name,
    emp.employee_code,
    c.absence_status,
    c.absence_date_from,
    c.absence_date_to,
    c.absence_document,
    c.absence_day,
    c.absence_hour,
    nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_review) ,'...')absence_review,
    nvl((select emp.first_name||' '||emp.last_name from sf_per_employees_v emp where emp.employee_code = c.absence_approve) ,'...')absence_approve, 
    c.status_approve,
    c.creation_date,
    c.absence_token
FROM sf_per_absence_chang c,
sf_per_employees_v emp
WHERE c.employee_code = emp.employee_code
and emp.position_group_code != '$positionGroupCode'
and emp.$namePosiyer $stringInPosition
and to_char(c.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
order by c.creation_date desc";
    }
    //echo $sql;

    $response = oci_parse($objConnect, $sql,);
    $output = null;


    if (oci_execute($response)) {
        while ($row =  oci_fetch_assoc($response)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
        echo "1";
    }

    oci_close($objConnect);
}
