<?php

use JetBrains\PhpStorm\Language;

require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'connect-test.php';
session_start();
$sql = "SELECT 
(SELECT MAX(b.absence_date)
FROM sf_per_absence_tmp b
WHERE b.absence_document = a.absence_document) Max,
(SELECT Min(b.absence_date)
FROM sf_per_absence_tmp b
WHERE b.absence_document = a.absence_document) Min,
(SELECT COUNT(*) from sf_per_absence_tmp c
WHERE c.absence_document = a.absence_document)day,
a.employee_code,
a.absence_code,
emp.title||emp.first_name||' '||emp.last_name name,
emp.position_group_code,
a.absence_day,
a.absence_hour,
a.delete_mark,
a.absence_period,
a.absence_status,
a.absence_token,
a.absence_detail,
a.ABSENCE_DOCUMENT,
a.CREATION_DATE
FROM sf_per_absence_tmp a
INNER JOIN sf_per_employees_v emp
ON emp.employee_code = a.employee_code
WHERE a.absence_code = '11'
OR a.absence_code = 'Ba'
AND to_char(a.creation_date,'MM-YY')= to_char(SYSDATE,'MM-YY')
GROUP BY a.employee_code,
a.absence_code,
emp.title||emp.first_name||' '||emp.last_name , 
emp.position_group_code,
a.absence_day,
a.absence_hour,
a.delete_mark,
a.absence_period,
a.absence_status,
a.absence_token,
a.absence_detail,
a.ABSENCE_DOCUMENT,
a.CREATION_DATE
ORDER by creation_date ASC";

$objParse = oci_parse($objConnect, $sql);
oci_execute($objParse);
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Google fonts -->

  <link href="http://10.2.2.5/sfifix/css/font.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css">

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <script src="sweetalert/unpkg/sweetalert.min.js"></script>


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title>โปรแกรมอนุมัติใบลาป่วย</title>


</head>

<body>


  <div class="container">

    <br>
    <h3 class="text-center">โปรแกรมอนุมัติใบลา</h3>
    </br>

    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <tr class="text-center">
        <th width="10%">รูป</th>
        <th width="10%">เลขที่เอกสาร</th>
        <th width="20%">ชื่อ-นามสกุล</th>
          <th width="12%">รหัสพนักงาน</th>
          <th width="8%">วันที่ป่วย</th>
          <th width="8%">วันที่หายป่วย</th>
          <th width="8%">รวม/วัน</th>
          <th width="15%">ไม่อนุมัติ</th>
          <th width="15%">อนุมัติ</th>
          
        </tr>

        <?php while ($row = oci_fetch_assoc($objParse)) { ?>
          <tr class="text-center">
                        <td><img src="http://10.2.2.5/sfifix/image/<?php echo substr($row["EMPLOYEE_CODE"],0,2)."-".substr($row["EMPLOYEE_CODE"],2)?>.jpg" alt="Lamp" width="60" ></td>
                        <td><?php echo $row["ABSENCE_DOCUMENT"]; ?></td>         
                        <td><?php echo $row["NAME"]; ?></td>          
                        <td><?php echo $row["EMPLOYEE_CODE"]; ?></td>
                        <td><?php echo $row["MIN"]; ?></td>
                        <td><?php echo $row["MAX"]; ?></td>
                        <td><?php echo $row["DAY"]; ?></td>
                        <td><input type="button" name="view" value="ไม่อนุมัติ" class=" btn btn-warning btn-xs  col view_data" id="<?php echo $row['ABSENCE_DOCUMENT']; ?>"></td>
                        <td><input type="button" name="edit" value="  อนุมัติ  " class="btn  btn-primary btn-xs edit_data col" id="<?php echo $row['ABSENCE_DOCUMENT']; ?>"></td>
                         
          </tr>

        <?php } ?>

      </table>

    </div>




    <?php
    if (isset($_POST['submit'])) {
      $textBoxResultDetail = $_POST['textBoxResultDetail'];
      $RadioCheckWork = $_POST['RadioCheckWork'];
      $flexRadioEstimate = $_POST['flexRadioEstimate'];


      $sql = "";

      $objParse = oci_parse($objConnect, $sql);
      if (oci_execute($objParse, OCI_COMMIT_ON_SUCCESS)) {

        echo '<script>swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  text: "กรุณากดปุ่มตกลง",
                  icon: "success",
                  confirmButtomText: "ตกลง",
                  
                }).then(()=>{
                  window.location.replace("http://10.2.2.5/sfifix/finishEstimateUpdate.php");
                });
               
                </script>';
        oci_commit($objConnect);

        //   
      } else {
        oci_rollback($objConnect);
        echo '<script>swal({
                  title: "บันทึกข้อมูลไม่สำเร็จ",
                  text: "กรุณากดปุ่มตกลง",
                  icon: "error",
                  button: "ตกลง",
                });
                </script>';
      }
      oci_close($objConnect);
    }

    ?>
  </div>

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>