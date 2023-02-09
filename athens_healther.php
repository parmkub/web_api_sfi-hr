
<?php




if ($_SERVER['REQUEST_METHOD'] == 'GET') {


   // require_once 'connect.php';
    require_once 'connect-test.php';




    $username = $_GET['username'];
    

    $sql = "SELECT * FROM sf_per_healther WHERE status_acount = 1 AND username = '$username'";

   $response = oci_parse($objConnect, $sql,);
   $output = null;


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
  
}
   
