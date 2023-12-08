<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once 'connect.php';
    //require_once 'connect-test.php';
    

    $userID = $_GET['user_id'];

    $sql = "SELECT * FROM sf_per_job_register WHERE id = '$userID'"; 
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
   
