<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    $empCode = $_GET['empcode'];

    // $sql = "SELECT
    // UPPER(v.eng_first_name||substr(v.eng_last_name,1,1)) username,
    // v.employee_code empcode,
    // v.position_group_code positiongroup,
    // v.position_f_group_name positiongroupname,
    // v.sect_code sectcode,
    // v.divi_code divicode,
    // v.depart_code departcode
    // FROM sfi.sf_per_employees_v v
    // WHERE v.employee_code = '$empCode'
    // AND v.resign_date IS NULL";

    $sql ="select v.title||v.first_name||' '||v.last_name name,
    v.gender,
    v.hire_date,
    v.employee_code,
    v.sect_code,
    v.sect_name,
    v.divi_code,
    v.divi_name,
    v.depart_code,
    v.depart_name,
    v.position_name,
    v.position_group_name,
    v.nationality_code,
    v.nationality,
    v.company_name from sf_per_employees_v v
    where v.employee_code = '$empCode'";

    $s = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($s);

    if ($row = oci_fetch_assoc($s)) {
        $result[] = $row ;
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