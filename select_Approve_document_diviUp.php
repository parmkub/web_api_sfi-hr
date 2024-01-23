<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // ถ้าเป็น TableTest ชื่อ Table sf_per_asence_tmp
    //require_once 'connect-test.php';

    // ถ้าเป็น TableProd ชื่อ Table sf_per_absence_mobile
    require_once 'connect.php';


    $code = $_GET['code'];
    $namePosiyer = $_GET['namePosiyer'];
    $positionGroupCode = $_GET['positionGroupCode'];
    // $selectStatus = $_GET['selectStatus'];

    if ($code == '5230') {   // ส่วนงาน 5230  HRD
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
        AND emp.$namePosiyer in('$code','5240') --HRD HRR
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
        ORDER by creation_date ASC";
    }else if($code == '5300'){// ส่วนงาน 5300  ธุระการสำนักงานชุมพร คุณอรุณี
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
        AND emp.$namePosiyer in('$code','5100','7200') --ธุระการสำนักงานชุมพร, จัดซื่อทั่วไปชุมพร ,ขนส่งชุมพร
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
        ORDER by creation_date ASC";

    }else if($code == '7180'){// ส่วนงาน 7180  บัญชีต้นทุน  พี่ใจ
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
        AND emp.$namePosiyer in('$code','7170') --บัญชชีต้นทุน, บัญชี 
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
        ORDER by creation_date ASC";

    }
    // แผนก 3112  FG3 Cooling Freezer  และ  3113  FG3 แกะกุ้ง   และ 3116 
    else if($code == '3112'){
        $sql = "SELECT  
        a.START_DATE,a.END_DATE, 
        a.COUNT_DATE,b.first_name||' '|| 
        b.last_name name,a.EMPLOYEE_CODE, 
        a.ABSENCE_CODE,a.ABSENCE_DAY, 
         CASE  
        WHEN MOD(a.absence_hour,1) > 0 THEN  SUBSTR(a.absence_hour, 1, 1) || '.5'
        ELSE to_char(a.absence_hour)
    END absence_hour,a.DELETE_MARK, 
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
        a.SECT_CODE  
        FROM  
        sf_per_absence_moble_v a, 
        sf_per_employees_v b  
        WHERE a.employee_code = b.employee_code  
        and   b.sect_code IN ('3112','3113','31116') and a.ABSENCE_STATUS < 2 
        and b.position_group_code < 032
        ORDER BY a.creation_date DESC";

    } else if($code == '1200'){  //ฝ่ายโรงงาน 1200  คุณธรรมปพจน์ เอาเฉพาะหัวหน้าแผนกขึ้นไป
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
    -- AND a.absence_status > 2
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
    ORDER by creation_date ASC";

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
    -- AND a.absence_status > 2
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
    ORDER by creation_date ASC";
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
