<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $empCode = $_GET['empCode'];
   // $password = $_GET['password'];

    $sql = "SELECT
    a.userid,
    a.username,
    a.name,
    a.empcode,
    a.positiongroup,
    a.positiongroupname,
    a.sectcode,
    a.divicode,
    a.departcode,
    t.pass_authen,
    t.email,
    t.token,
    t.resign_status
FROM
(select 
'0000' userid,
UPPER(f.eng_first_name)username,
f.first_name||' '||f.last_name name,
f.employee_code empcode,
f.position_group_code positiongroup,
f.position_name positiongroupname,
f.sect_code sectcode,
f.divi_code divicode,
f.depart_code departcode
FROM sf_per_employees_v f 
where  f.resign_date is null
AND f.nationality = 'ไทย'
)a,sf_emp_mobile_token t
where a.empcode = t.empcode
and a.empcode = '$empCode'";
//and t.pass_authen ='$password'";

    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($row = oci_fetch_assoc($s)) {
        $result[] = $row;
        echo json_encode($result);
        oci_close($objConnect);
    } else {

        echo 'Null';
        oci_close($objConnect);
    }





    // try{
    //     if ($objExecute) {
    //         while($row =  oci_fetch_assoc($s)){
    //             $output[] = $row;
    //         }
    //         echo json_encode($output);
    //     } else {
    //         echo 'false';
    //     }
    // }catch (Exception $e){
    //     echo 'error'.$e;
    // }
    // oci_close($objConnect);

}
