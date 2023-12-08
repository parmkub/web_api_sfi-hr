<?php

require_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

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

  <!-- <script type="text/javascript" src="jsPDF/jspdf.min.js"></script> -->

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>






  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title></title>
</head>

<body>
  <?php include 'selectChangHoliday.php'; ?>

  <div id="contnet">
    <div class="container col-6 mt-5">
      <div class="card regular shadow">
        <div class="card-header mt-4 text-center">
          <div>
            บริษัท ซีเฟรชอินดัสตรีจำกัด (มหาชน) 402 หมู่ 8 ตำบล ปากน้ำ อำเภอ เมือง จังหวัดชุมพร 86120
          </div>
          <div>
            Seafresh Industry Public Company Limited 402 Village 8, Parknam, Chumphon 86120 Thailand
          </div>

        </div>
        <div class="card-body mt-2">
          <div class="text-center font-weight-bold">
            <h4 class="font-weight-bold">ใบเลื่อนวันหยุดลอย</h4>
          </div>
          <div class="row mt-3">
            <div class="col">
              <p><?php echo 'เลขที่เอกสาร: ' . $documentNo ?></p>
              <input type="hidden" id="documentNo" value="<?php echo $documentNo ?>">
            </div>
            <div class="col">
              <p><?php echo 'วันที่ ' . $creationDate ?></p>
            </div>
          </div>


          <div class="text-start">
            <p>
              เรียน ผู้บังคับบัญชาต้นสังกัด
            </p>
          </div>

          <div class="row">

            <div class="text-start col-4">
              <p><?php echo 'ข้าพเจ้า ' . $employeeName ?></p>
            </div>
            <div class="text-start col-3">
              <p><?php echo 'รหัสพนักงาน ' . $employeeCode ?></p>
            </div>
            <div class="text-start col-5">
              <p><?php echo 'ตำแหน่ง' . $positionName ?> </p>
            </div>
          </div>
          <div class="row">

            <div class="text-start col-4">
              <p><?php echo 'แผนก ' . $sectName ?></p>
            </div>
            <div class="text-start col-4">
              <p><?php echo 'ส่วน ' . $diviName ?></p>
            </div>
            <div class="text-start col-4">
              <p><?php echo 'ฝ่าย ' . $departName ?></p>
            </div>
          </div>

        </div>
        <!-- <div class="col ms-3">
          <p class="text-sm-left">มีความประส่งขอลา </p>
        </div>

        <div class="row m-2 mt-0">
          <div class="col align-middle">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input" value="lagit" checked>
                </div>
              </div>
              <p class="text-sm-left ms-2"> ลากิจธุระจำเป็น</p>
            </div>
          </div>
          <div class="col-2">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
              </div>
              <p class="text-sm-left ms-2"> ลาป่วย</p>
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
              </div>
              <p class="text-sm-left ms-2"> ลาพักผ่อนประจำปี</p>
            </div>
          </div>
          <div class="col-2">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
              </div>
              <p class="text-sm-left ms-2"> ลาคลอดบุตร</p>
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
              </div>
              <p class="text-sm-left ms-2">อุบัติเหตุจากทำงาน</p>
            </div>
          </div>
        </div> -->

        <div class="row">
          <div class="col">
            <div class="col mx-3">
              <p>ได้รับการอนุมัติเลือนวันหยุด</p>
            </div>

            <div class="col mx-3">
              <input type="hidden" id="startDate" value="<?php echo $dateFrom ?>">
              <input type="hidden" id="endDate" value="<?php echo $dateTo ?>">
              <p>จาก <?php echo $dateFrom ?> เป็น <?php echo $dateTo ?> </p>
              <p><?php echo 'จำนวนลา ' . $showCount ?></p>
            </div>
          </div>
          <div class="col-4 ">
            
            <Img width="120px" class="regular shadow" src= "<?php echo $ImgUrl?>" ></Img> 
      
                                 
          </div>
        </div>

        <div id="diffDays"></div>


        <!-- <div class="co-5 m-3">
          <p>เหตุผล:</p>

          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="รายละเอียด" disabled>
          <?php echo $detail ?>
           </textarea>
        </div> -->


        <div class="row m-5 ">
          <div class="col text-center mt-5">
            <p><?php echo 'ลงชื่อ ' . $review . ' ผู้ทบทวน' ?></p>

          </div>
          <div class="col  text-center mt-5">
            <p><?php echo 'ลงชื่อ ' . $approve . ' ผู้อนุมัติ' ?></p>

          </div>
        </div>
      </div>

<!-- 
      <div class="row justify-content-center mt-3">
        <div class="col-5 d-grid ">
          <button id="btnNo" type="button" class="btn btn-info btn-xs " value='AbsenceCode Update'>ไม่อนุมัติ</button>
        </div>
        <div class="col-5 d-grid">
          <button id="btnAprove" type="button" class="btn btn-primary btn-lg " value='AbsenceCode Update'>อนุมัติ</button>
        </div>
      </div> -->

      <script type="text/javascript">
        $(document).ready(function() {

          $("#btnNo").click(function(e) {
            var documentNo = document.getElementById("documentNo").value;
            var absenceCode = 'AB';
            console.log(documentNo);
            console.log(absenceCode);
            swal({
                title: "คุณแน่นใจหรือไม่!",
                text: "เปลี่ยนสถานะการลากิจจ่ายเงินเป็นไม่จ่ายเงิน",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willChangStatus) => {
                if (willChangStatus) {
                  $.ajax({
                    url: "http://10.2.2.5/sfi-hr/updateAseceCode.php",
                    method: "POST",
                    data: {
                      documentNo: documentNo,
                      absenceCode: absenceCode
                    },
                    success: function(data) {
                      if (data == "true") {
                        swal("เปลี่ยนสถานะเป็นไม่จ่ายเงินเรียบร้อย", {
                          icon: "success",
                        }).then(function() {
                          console.log('refresh หน้าเว็บ');
                          e.preventDefault();
                          window.location.reload();
                        })

                      } else {
                        swal("ไม่สารถมารถเปลี่ยนสถานะได้", {
                          icon: "warning",
                        });
                      }
                    }
                  })

                } else {
                  swal("ยกเลิกการเปลี่ยนสถานะ");
                }
              });



          });

          $("#btnAprove").click(function(e) {
            var documentNo = document.getElementById("documentNo").value;
            var absenceCode = '02';
            console.log(documentNo);
            console.log(absenceCode);
            swal({
                title: "คุณแน่นใจหรือไม่!",
                text: "เปลี่ยนสถานะการลากิจไม่จ่ายเงินเป็นจ่ายเงิน",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willChangStatus) => {
                if (willChangStatus) {
                  $.ajax({
                    url: "http://10.2.2.5/sfi-hr/updateAseceCode.php",
                    method: "POST",
                    data: {
                      documentNo: documentNo,
                      absenceCode: absenceCode
                    },
                    success: function(data) {
                      if (data == "true") {
                        swal("เปลี่ยนสถานะเป็นจ่ายเงินเรียบร้อย", {
                          icon: "success",
                        }).then(function() {
                          console.log('refresh หน้าเว็บ');
                          e.preventDefault();
                          window.location.reload();
                        })
                      } else {
                        swal("ไม่สารถมารถเปลี่ยนสถานะได้", {
                          icon: "warning",
                        });
                      }
                    }
                  })

                } else {
                  swal("ยกเลิกการเปลี่ยนสถานะ");
                }

              });



          });



        });
      </script>

      <!-- <script>
        function updateAseceCode() {

          //e.preventDefault(); //ปิดการประพริบหน้าเว็บเมื่อมีการ Reset
          var documentNo = document.getElementById("documentNo").value;
          var absenceCode = 'AB';
          console.log(documentNo);
          console.log(absenceCode);

          $.ajax({
            url: "http://10.2.2.5/sfi-hr/updateAseceCode.php",
            method: "POST",
            data: {
              documentNo: documentNo,
              absenceCode: absenceCode
            },
            contentType: 'application/json; charset=utf-8', //ส่งข้อมูลเป็นก้อนทุกอย่างที่อยู่ในฟอร์ม
            success: function(data) {
              if (data == "true") {
                alert("อนุมัติเรียบร้อย");
                window.location.href = "index.php";
              } else {
                alert("ไม่สามารถอนุมัติได้");
              }
            }
          })
        }

        // $(document).ready(function() {

        //     $('#login-form').on('submit', function(e) {
        //         e.preventDefault(); //ปิดการประพริบหน้าเว็บเมื่อมีการ Reset
        //         var uid = document.getElementById("user").value;
        //         var password = document.getElementById("password").value;
        //         // console.log(uid);
        //         // console.log(password);
        //         $.ajax({
        //             url: "login.php",
        //             method: "POST",
        //             data: {
        //                 function: 'login',
        //                 username: uid,
        //                 password: password
        //             }, //ส่งข้อมูลเป็นก้อนทุกอย่างที่อยู่ในฟอร์ม
        //             success: function(data) {
        //                 if (data == "true") {
        //                     sessionStorage.setItem("login", "true");
        //                     let personName = sessionStorage.getItem("login");
        //                     console.log(personName);
        //                     window.location.replace("http://10.2.2.5/contacts/home.php");
        //                 } else {
        //                     swal({
        //                         title: " User หรือ Password ผิด",
        //                         text: "กรุณากดปุ่มตกลง",
        //                         icon: "error",
        //                         button: "ตกลง",
        //                     });
        //                 }
        //             }
        //         });
        //     });
        // }
        //);
      </script> -->














      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>