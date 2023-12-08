<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //require_once 'connect.php';
    require_once 'connect.php';
    

    $card_row = $_GET['card_row'];

    $sql = "select employee_code, first_name,last_name,sect_code,divi_code,depart_code,'คุณ'||first_name||' '||last_name name from sf_per_employees_v where resign_date is null and card_raw = '$card_row'";
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
   
