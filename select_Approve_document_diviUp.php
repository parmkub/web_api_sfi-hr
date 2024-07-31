<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // ถ้าเป็น TableTest ชื่อ Table sf_per_asence_tmp
    //require_once 'connect-test.php';

    // ถ้าเป็น TableProd ชื่อ Table sf_per_absence_mobile
    require_once 'connect.php';

    $code = $_GET['code'];
    $namePosiyer = $_GET['namePosiyer'];
    $positionGroupCode = $_GET['positionGroupCode'];

    //echo $code;

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

    // ดึงตำแหน่งพนักงานที่รับผิดชอบ
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
    //echo $stringInPosition;

    if ($code == '1200') {  //ฝ่ายโรงงาน 1200  คุณธรรมปพจน์ เอาเฉพาะหัวหน้าแผนกขึ้นไป
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
    AND emp.position_group_code > 031
     AND a.absence_status < 2
    --AND to_char(a.creation_date,'YY')= to_char(SYSDATE,'YY')
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
    ORDER by creation_date ASC";
    } else {
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
        AND emp.$namePosiyer $stringInPosition
        AND a.absence_status < 2 --HRD HRR
        AND to_char(a.creation_date,'YY')= to_char(SYSDATE,'YY')
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
        ORDER by creation_date ASC";

        //echo $sql;
    }

    $response = oci_parse($objConnect, $sql,);
    $output = null;


    if (oci_execute($response)) {
        while ($row =  oci_fetch_assoc($response)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
        echo "Null";
    }

    oci_close($objConnect);
}
