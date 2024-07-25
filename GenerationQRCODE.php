<?php

require_once 'connect.php';
ob_start();
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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="componance/qrcode/qrcode.min.js"></script>






  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title></title>
</head>

<body>

  <div id="contnet">
    <div class="container col-6 col-lg-8 col-md-12 col-sm-12 mt-5">
      <div class="card regular shadow-lg bg-light">
        <div class="card-header mt-4 text-center">
          <div>
            บริษัท ซีเฟรชอินดัสตรีจำกัด (มหาชน) 402 หมู่ 8 ตำบล ปากน้ำ อำเภอ เมือง จังหวัดชุมพร 86120
          </div>
          <div>
            Seafresh Industry Public Company Limited 402 Village 8, Parknam, Chumphon 86120 Thailand
          </div>

        </div>
        <div class="card-body mt-2 mb-2 ">

          <div class="text-center my-3">
            <img class="shadow-lg img-fluid img-thumbnail" src="image/icon.png" alt="">
          </div>

          <div class="text-center font-weight-bold">
            <h4 class="font-weight-bold">QR CODE APP SFI-HR FOR IOS</h4>
          </div>


          <div class="d-flex mt-4 justify-content-center" id="qrcode"></div>




          <div class="row justify-content-center">
            <div class="col-4">
              <input class="form-control" placeholder="รหัสพนักงาน" type="text" id="employee_code" name="employee_code">
            </div>

          </div>

          <div class="mb-3 d-flex mt-4 justify-content-center">
            <input type="submit" class="btn btn-secondary" onclick="GenerationQR()" value="Generation QR Code">

          </div>

        </div>
        <div class="card-footer">
          <div class="text-start">
            <p>หมายเหตุ: สำหรับ Android สามารถ Download App SFI-HR ได้จาก Play Store</p>
          </div>

        </div>




      </div>




      <script type="text/javascript">
        function GenerationQR() {
          //clear qr code
          document.getElementById("qrcode").innerHTML = "";

          var employee_code = document.getElementById("employee_code").value;
          //console.log(employee_code);

          var urlQR = "";
          //select url from database
          $.ajax({
            type: "POST",
            url: "select_url_app_ios.php",
            data: {
              employee_code: employee_code
            },
            success: function(data) {
              //console.log(data);
              var obj = JSON.parse(data);
              console.log(obj.code);
              console.log(obj.employee_code);
              if (obj.code == "Null") {
                swal("ไม่พบรหัสพนักงาน", "กรุณาตรวจสอบรหัสพนักงาน", "error");
                return false;
              } else {
                urlQR = "https://apps.apple.com/redeem?code=" + obj.code + "&ctx=apps"
                // urlQR = data;
                // console.log(urlQR);
                new QRCode(document.getElementById("qrcode"), urlQR);

                // clear text field employee_code
                document.getElementById("employee_code").value = "";


              }




            }
          });




        }
        //



        // new QRCode(document.getElementById("qrcode"), "http://www.seafresh.com");
      </script>





      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>