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
    (SELECT MAX(b.absence_date)
    FROM sf_per_absence_mobile b
    WHERE b.absence_document = a.absence_document) Max,
    (SELECT Min(b.absence_date)
    FROM sf_per_absence_mobile b
    WHERE b.absence_document = a.absence_document) Min,
    (SELECT COUNT(*) from sf_per_absence_mobile c
    WHERE c.absence_document = a.absence_document)day,
    a.employee_code,
    a.absence_code,
    emp.title||emp.first_name||' '||emp.last_name name,
    emp.position_group_code,
    a.absence_day,
     CASE  
        WHEN MOD(a.absence_hour,1) > 0 THEN  SUBSTR(a.absence_hour, 1, 1) || '.5'
        ELSE to_char(a.absence_hour)
    END absence_hour,
    a.delete_mark,
    NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_review),'...')review,
         NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_approve),'...')approve,
    a.absence_period,
    a.absence_status,
    a.absence_token,
    a.absence_detail,
    a.ABSENCE_DOCUMENT,
    a.CREATION_DATE,
    a.STATUS_APPROVE
    FROM sf_per_absence_mobile a
    INNER JOIN sf_per_employees_v emp
    ON emp.employee_code = a.employee_code
    WHERE emp.position_group_code != '$positionGroupCode'
    AND emp.$namePosiyer in('$code','5240')
    AND to_char(a.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
    GROUP BY a.employee_code,
    a.absence_code,
    emp.title||emp.first_name||' '||emp.last_name , 
    emp.position_group_code,
    a.absence_day,
    a.absence_hour,
    a.delete_mark,
   
        a.absence_review,
        a.absence_approve,
    a.absence_period,
    a.absence_status,
    a.absence_token,
    a.absence_detail,
    a.ABSENCE_DOCUMENT,
    a.CREATION_DATE,
    a.STATUS_APPROVE
    ORDER by absence_status DESC";
    }else if($code == '3112'){// แผนก 3112  FG3 Cooling Freezer  และ  3113  FG3 แกะกุ้ง  และ 3116 
       
        $sql="SELECT 
        (SELECT MAX(b.absence_date)
        FROM sf_per_absence_mobile b
        WHERE b.absence_document = a.absence_document) Max,
        (SELECT Min(b.absence_date)
        FROM sf_per_absence_mobile b
        WHERE b.absence_document = a.absence_document) Min,
        (SELECT COUNT(*) from sf_per_absence_mobile c
        WHERE c.absence_document = a.absence_document)day,
        a.employee_code,
        a.absence_code,
        emp.title||emp.first_name||' '||emp.last_name name,
        emp.position_group_code,
        a.absence_day,
         CASE  
        WHEN MOD(a.absence_hour,1) > 0 THEN  SUBSTR(a.absence_hour, 1, 1) || '.5'
        ELSE to_char(a.absence_hour)
    END absence_hour,
        a.delete_mark,
        NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
            where c.employee_code =  a.absence_review),'...')review,
             NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
            where c.employee_code =  a.absence_approve),'...')approve,
        a.absence_period,
        a.absence_status,
        a.absence_token,
        a.absence_detail,
        a.ABSENCE_DOCUMENT,
        a.CREATION_DATE,
        a.STATUS_APPROVE
        FROM sf_per_absence_mobile a
        INNER JOIN sf_per_employees_v emp
        ON emp.employee_code = a.employee_code
        WHERE emp.position_group_code != '$positionGroupCode'
        AND emp.$namePosiyer in('$code','3113','3116')
        AND to_char(a.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
        GROUP BY a.employee_code,
        a.absence_code,
        emp.title||emp.first_name||' '||emp.last_name , 
        emp.position_group_code,
        a.absence_day,
        a.absence_hour,
        a.delete_mark,
            a.absence_review,
            a.absence_approve,
        a.absence_period,
        a.absence_status,
        a.absence_token,
        a.absence_detail,
        a.ABSENCE_DOCUMENT,
        a.CREATION_DATE,
        a.STATUS_APPROVE
        ORDER by absence_status DESC";

    } 
    
    else {

        $sql = "SELECT 
    (SELECT MAX(b.absence_date)
    FROM sf_per_absence_mobile b
    WHERE b.absence_document = a.absence_document) Max,
    (SELECT Min(b.absence_date)
    FROM sf_per_absence_mobile b
    WHERE b.absence_document = a.absence_document) Min,
    (SELECT COUNT(*) from sf_per_absence_mobile c
    WHERE c.absence_document = a.absence_document)day,
    a.employee_code,
    a.absence_code,
    emp.title||emp.first_name||' '||emp.last_name name,
    emp.position_group_code,
    a.absence_day,
     CASE  
        WHEN MOD(a.absence_hour,1) > 0 THEN  SUBSTR(a.absence_hour, 1, 1) || '.5'
        ELSE to_char(a.absence_hour)
    END absence_hour,
    a.delete_mark,
    NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_review),'...')review,
         NVL((select c.first_name||' '||c.last_name from sf_per_employees_v c
        where c.employee_code =  a.absence_approve),'...')approve,
    a.absence_period,
    a.absence_status,
    a.absence_token,
    a.absence_detail,
    a.ABSENCE_DOCUMENT,
    a.CREATION_DATE,
    a.STATUS_APPROVE
    FROM sf_per_absence_mobile a
    INNER JOIN sf_per_employees_v emp
    ON emp.employee_code = a.employee_code
    WHERE emp.position_group_code != '$positionGroupCode'
    AND emp.$namePosiyer = '$code'
    AND a.absence_status < 2
    AND to_char(a.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
    GROUP BY a.employee_code,
    a.absence_code,
    emp.title||emp.first_name||' '||emp.last_name , 
    emp.position_group_code,
    a.absence_day,
    a.absence_hour,
    a.delete_mark,
   
        a.absence_review,
        a.absence_approve,
    a.absence_period,
    a.absence_status,
    a.absence_token,
    a.absence_detail,
    a.ABSENCE_DOCUMENT,
    a.CREATION_DATE,
    a.STATUS_APPROVE
    ORDER by absence_status DESC";
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