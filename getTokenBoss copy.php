<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'connect.php';
    $departCode = $_POST['departCode'];
    $diviCode = $_POST['diviCode'];
    $sectCode = $_POST['sectCode'];

    $posigtion_group_code = '';

    if($sectCode == 'null'){
        $sectCode = 'is null';
        $posigtion_group_code = '042'; //ผู้จัดการส่วน
    }
    if($diviCode == 'null'){
        $diviCode = 'is null';
        $posigtion_group_code = '052'; //ผู้จัดการฝ่าย
    }


    $sql = "SELECT
    e.first_name||' '||e.last_name name,
    e.employee_code,
    (select t.token
    from sf_emp_mobile_token t
    where t.empcode = e.employee_code) token
FROM sf_per_employees_v e
where e.resign_date is null
and e.depart_code = '$departCode'
and e.position_group_code = '052'
UNION ALL
SELECT 
     e.first_name||' '||e.last_name name,
    e.employee_code,
    (select t.token
    from sf_emp_mobile_token t
    where t.empcode = e.employee_code) token
FROM sf_per_employees_v e
WHERE e.position_group_code = '042'
and e.resign_date is null
and e.per_depart = '$diviCode'
UNION ALL
SELECT
   e.first_name||' '||e.last_name name,
    e.employee_code,
    (select t.token
    from sf_emp_mobile_token t
    where t.empcode = e.employee_code) token
FROM sf_per_employees_v e
where e.resign_date is null
and e.position_group_code != '022'
and e.position_group_code > '021'
and e.per_depart = '$sectCode'";

$response = oci_parse($objConnect, $sql,);
$output = null;


    if(oci_execute($response)){
        while($row =  oci_fetch_assoc($response)){
            $output[] = $row;
        }
        echo json_encode($output);
    }
    else {
        echo "Null";
    }



oci_close($objConnect);


}
