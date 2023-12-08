<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';


    $code = $_GET['code'];
    $namePosiyer = $_GET['namePosiyer'];
    $positionGroupCode = $_GET['positionGroupCode'];
    // $selectStatus = $_GET['selectStatus'];

    if ($code == '5230') {
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
and emp.$namePosiyer in('$code','5240')
and to_char(c.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
order by c.creation_date desc";
    } else if ($code == '5300') { //ส่วนงานคุณอรุณี ดูแลสามฝ่าย 5300,7200,5100
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
    and emp.$namePosiyer in('$code','7200','5100')
    and to_char(c.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
    order by c.creation_date desc";
    }else if ($code == '7180') { //ส่วนงานคุณอรุณี ดูแลสามฝ่าย 5300,7200,5100
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
    and emp.$namePosiyer in('$code','7170')
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
and emp.$namePosiyer = '$code'
and to_char(c.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
order by c.creation_date desc";
    }


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
