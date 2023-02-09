<?php

use JetBrains\PhpStorm\Language;

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
  <script type="text/javascript" src="jsPDF/pdfmake.min.js"></script>
  <script type="text/javascript" src="jsPDF/vfs_fonts.js"></script>



  <script type="text/javascript">
    function genPDF() {

      var doc = new jsPDF();

      doc.text('Hello world!', 10, 10);
      doc.save('a4.pdf');
    }

    function Convert_HTML_TO_PDF() {
      var doc = new jsPDF();
      var elementHTML = document.querySelector("#contnet").innerHTML;
      var specialElementHandlers = {
        '#elementH': function(element, renderer) {
          return true;
        }
      };
      doc.fromHTML(elementHTML, 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
      });

      // Save the PDF
      doc.save('sample-document.pdf');
    }
  </script>


  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->

  <link rel="shortcut icon" href="http://10.2.2.5/sfifix/image/bg/icon.jpg">

  <title></title>
</head>

<body>

  <h1>jsPDF Demos</h1>
  <a href="javascript:Convert_HTML_TO_PDF()">Download PDF</a>

  <div id="contnet">
    <div class="container col-6">
      <div class="card">
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
            <p class="font-weight-bold">ใบลา</p5>
          </div>
          <div class="text-end">
            <p>วันที่...............................เดือน........................พ.ศ...................</p>
          </div>
          <div class="text-start">
            <p>
              เรียน ผู้บังคับบัญชาต้นสังกัด
            </p>
          </div>

          <div class="row">

            <div class="text-start col-4">
              <p>ข้าพเจ้า............................................</p>
            </div>
            <div class="text-start col-3">
              <p>รหัส...........................................</p>
            </div>
            <div class="text-start col-5">
              <p>ตำแหน่ง........................................................................</p>
            </div>
          </div>
          <div class="row">

            <div class="text-start col-4">
              <p>แผนก..............................................</p>
            </div>
            <div class="text-start col-4">
              <p>ส่วน................................................</p>
            </div>
            <div class="text-start col-4">
              <p>ฝ่าย...............................................</p>
            </div>
          </div>

        </div>
        <div class="col ms-3">
          <p class="text-sm-left">มีความประส่งขอลา </p>
        </div>
        <div class="row m-2 mt-0">
          <div class="col align-middle">
            <div class="input-group mb-3">
              <div>
                <div>
                  <input type="checkbox" aria-label="Checkbox for following text input">
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

         

        </div>

      </div>



    </div>

    <div id="elementH"></div>










    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>