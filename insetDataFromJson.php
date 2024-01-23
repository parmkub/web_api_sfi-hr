<?php
require_once 'connect.php';

$jsonFile = "SFI-HR-20000.json";

$jsondata = file_get_contents($jsonFile);

//แปลงข้อมูลจาก json ให้เป็น array
$data = json_decode($jsondata, true);

echo $data[0]['Code'];
echo $data[0]['Link'];
echo $data[0]['id'];

foreach ($data as $row){
    $id = $row['id'];
    $code = $row['Code'];
    $link = $row['Link'];

    $sql = "INSERT INTO SF_PER_APPHR_IOS (
        id,
        Code,
        LING_INSTALL)
    VALUES ('$id',
        '$code',
        '$link')";
    $objParse = oci_parse($objConnect, $sql);
    $objExecute = oci_execute($objParse, OCI_DEFAULT);
    if ($objExecute) {
        oci_commit($objConnect);
        echo "Save Done";
    } else {
        oci_rollback($objConnect);
        echo "Error Save [" . $sql . "]";
    }


}
?>