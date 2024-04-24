<?php
require_once 'connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //รับข้อมูล json ที่ส่งมาจาก Flutter
    $json = file_get_contents('php://input');
    //ตรวจสอบว่ามีข้อมูลส่งมาหรือไม่
    if (!empty($json)) {
        //แปลงข้อมูลที json ไปเป็น array
        $dataList = json_decode($json, true);
        //echo count($dataList);
        $success = 0;
        
        //ปริ้นข้อมูลที่ได้
       // print_r($dataList);

        // วนลูปเพื่อ insert ข้อมูล หรือ update ข้อมูล
    foreach ($dataList as $data) {
        $ITEM_CODE = $data['ITEM_CODE'];
        $COUNT = $data['COUNT'];
        $UNIT = $data['UNIT'];
        $EMP_CODE = $data['EMP_CODE'];

        // echo $ITEM_CODE ;
        // echo $COUNT;
        // echo $UNIT;
        // echo $EMP_CODE;

        //check data ว่ามีข้อมูลนี้อยู่หรือไม่

        $sql = "SELECT * FROM sfi.SF_PROD_COLDROOM_TRANSITION WHERE item_code = '$ITEM_CODE'";
           
             $objParse = oci_parse($objConnect, $sql);
             oci_execute($objParse, OCI_DEFAULT);
             $objResult = oci_fetch_array($objParse, OCI_BOTH);

             if(!$objResult){
                //echo "insert";
                $sql = "INSERT INTO sfi.SF_PROD_COLDROOM_TRANSITION (ITEM_CODE, COUNT, UNIT, LAST_UPDATE_DATE, LAST_UPDATE_BY, CREATION_DATE, CREATION_BY)
                VALUES (:ITEM_CODE, :COUNT, :UNIT, SYSDATE, :EMP_CODE, SYSDATE, :EMP_CODE)";
                $s = oci_parse($objConnect, $sql);
                oci_bind_by_name($s, ':ITEM_CODE', $ITEM_CODE);
                oci_bind_by_name($s, ':COUNT', $COUNT);
                oci_bind_by_name($s, ':UNIT', $UNIT);
                oci_bind_by_name($s, ':EMP_CODE', $EMP_CODE);
                $objExecute = oci_execute($s);
                $success++;
               
             }else{
                //update
                $sql = "UPDATE sfi.SF_PROD_COLDROOM_TRANSITION SET COUNT = :COUNT, UNIT = :UNIT, LAST_UPDATE_DATE = SYSDATE, LAST_UPDATE_BY = :EMP_CODE WHERE ITEM_CODE = :ITEM_CODE";
                $s = oci_parse($objConnect, $sql);
                oci_bind_by_name($s, ':ITEM_CODE', $ITEM_CODE);
                oci_bind_by_name($s, ':COUNT', $COUNT);
                oci_bind_by_name($s, ':UNIT', $UNIT);
                oci_bind_by_name($s, ':EMP_CODE', $EMP_CODE);
                $objExecute = oci_execute($s);
            
                //echo "update";
                $success++;
             }


        
    }
  


        // //วนลูปเพื่อ insert ข้อมูล หรือ update ข้อมูล
        // foreach ($dataList as $data) {
        //     $itemCode = $data['ITEM_CODE'];
        //     $count = $data['COUNT'];
        //     $unit = $data['UNIT'];
        //     $EmpCode = $data['EMP_CODE'];
        //     $CreateDate = 'SYSDATE';
        //     $UpdateDate = 'SYSDATE';
        //     $CreateBy = $data['CREATE_BY'];
        //     $UpdateBy = $data['UPDATE_BY'];

        //     //check data ว่ามีข้อมูลนี้อยู่หรือไม่
        //     $sql = "SELECT * FROM sfi.SF_PROD_COLDROOM_TRANSITION WHERE item_code = '$itemCode'";
        //     $objParse = oci_parse($objConnect, $sql);
        //     oci_execute($objParse, OCI_DEFAULT);
        //     $objResult = oci_fetch_array($objParse, OCI_BOTH);
        //     if (!$objResult) {
        //         //insert
        //         $sql = "INSERT INTO sfi.SF_PROD_COLDROOM_TRANSITION (ITEM_CODE, COUNT, UNIT, LAST_UPDATE_DATE, LAST_UPDATE_BY, CREATION_DATE, CREATION_BY) 
        //         VALUES (:itemCode, :itemName, :itemType, :itemGroup, :itemUnit, :itemPrice, :itemStatus, :itemRemark, :itemCreateBy, :itemCreateDate, :itemUpdateBy, :itemUpdateDate)";
        //         $s = oci_parse($objConnect, $sql);
        //         oci_bind_by_name($s, ':itemCode', $itemCode);
        //         oci_bind_by_name($s, ':COUNT', $count);
        //         oci_bind_by_name($s, ':UNIT', $unit);
        //         oci_bind_by_name($s, ':LAST_UPDATE_DATE', $CreateDate);
        //         oci_bind_by_name($s, ':LAST_UPDATE_BY', $EmpCode);
        //         oci_bind_by_name($s, ':CREATION_DATE', $CreateDate);
        //         oci_bind_by_name($s, ':CREATION_BY', $EmpCode);

        //         $objExecute = oci_execute($s);
        //         if ($objExecute) {
        //             echo 'true';
        //         } else {
        //             echo 'false';
        //         }
        //     } else {
        //         //update
        //         $sql = "UPDATE sfi.SF_PROD_COLDROOM_TRANSITION SET COUNT = :COUNT, UNIT = :UNIT, LAST_UPDATE_DATE = :LAST_UPDATE_DATE, LAST_UPDATE_BY = :LAST_UPDATE_BY WHERE ITEM_CODE = :ITEM_CODE";
        //         $s = oci_parse($objConnect, $sql);
        //         oci_bind_by_name($s, ':ITEM_CODE', $itemCode);
        //         oci_bind_by_name($s, ':COUNT', $count);
        //         oci_bind_by_name($s, ':UNIT', $unit);
        //         oci_bind_by_name($s, ':LAST_UPDATE_DATE', $UpdateDate);
        //         oci_bind_by_name($s, ':LAST_UPDATE_BY', $EmpCode);

        //         $objExecute = oci_execute($s);
        //         if ($objExecute) {
        //             echo 'true';
        //         } else {
        //             echo 'false';
        //         }
        //     }
        // }
    }
    oci_commit($objConnect);
    oci_close($objConnect);

    // ตรวจสอบจำนวนแถวที่ insert และ update ได้
    //echo $success;
 
    if($success == count($dataList)){
       echo "true";
    }else{
        echo "false";
    }
}
