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

  <!-- <link href="http://10.2.2.5/sfifix/css/font.css" rel="stylesheet"> -->

  <!-- Bootstrap CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/style1.css" />

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

  <script src="sweetalert/unpkg/sweetalert.min.js"></script>

  <!-- <script type="text/javascript" src="jsPDF/jspdf.min.js"></script> -->

  <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>






  <!-- <link href="jquery.datetimepicker.min.css" rel="stylesheet" /> -->


  <title></title>
</head>

<body>
  <?php include 'selectReportDetail.php'; ?>

  <div id="contnet">
    <div class="row justify-content-center">


      <div class=" col-12 col-md-10 col-lg-7 col-sm-12 card shadow border-dark ">
        <div class="card-header " align="center">
          <p>บริษัท ซีเฟรชอินดัสตรี จำกัด (มหาชน) 402 หมู่ 8 ตำบล ปากน้ำ อำเภอ เมือง จังหวัด ชุมพร 86120</p>
          <p>Seafresh Industry Public Company Limited 402 Moo 8, Paknam Chumphon, Chumphon 86120 Thailand</p>

        </div>
        <div class="card-body">
          <table align="center">
            <thead>


              <tr align="center">
                <th>ใบลา</th>

              </tr>

            </thead>
          </table>
          <table align="center" class="table table-responsive-sm  borderless">
            <tbody>
              <tr>
                <td style="width:240px">เลขที่เอกสาร:<?php echo $documentNo ?></td>
                <td></td>
                <td style="width:200px"></td>
                <td></td>
                <td style="width:300px">วันที่ <?php echo $creationDate ?></td>

              </tr>
              <tr>
                <td>เรียนผู้บังคับบัญชาต้นสังกัด</td>
              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:240px">ข้าพเจ้า..<?php echo 'ข้าพเจ้า ' . $employeeName ?>
                <td>
                <td style="width:200px">รหัสพนักงาน..<?php echo  $employeeCode ?>
                <td>
                <td style="width:300px">ตำแหน่ง.<?php echo $positionName ?></td>
              </tr>

          </table>

          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:240px">แผนก <?php echo $sectCode ?></td>
                <td style="width:250px">ส่วน <?php echo $diviCode ?></td>
                <td style="width:250px">ฝ่าย <?php echo $departCode ?></td>
              </tr>

          </table>
          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:150px">มีความประสงค์ขอลา </td>
                <td style="width:150px"><input disabled <?php if ($absenceCode == "AB" || $absenceCode == "02") echo "checked" ?> type="checkbox"> ลาเพื่อกิจธุระจำเป็น</td>
                <td style="width:80px"><input disabled <?php if ($absenceCode == "11" || $absenceCode == "BA") echo "checked" ?> type="checkbox"> ลาป่วย</td>
                <td style="width:140px"><input disabled <?php if ($absenceCode == "29") echo "checked" ?> type="checkbox"> ลาพักผ่อนประจำปี</td>
                <td style="width:120px"><input disabled <?php if ($absenceCode == "14" || $absenceCode == "BD") echo "checked" ?> type="checkbox"> ลาคลอดบุคร</td>
                <td style="width:100px"><input type="checkbox"> ลาเนื่องจาก</td>
              </tr>
          </table>
          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:180px">อุบัติเหตุจากการทำงาน</td>
                <td style="width:180px"><input type="checkbox" aria-label="Checkbox for following text input" @ViewBag.checkbox>ลาอื่นๆ(ระบุ)...................</td>
                <td style="width:380px; font-weight:800">เนื่องจาก <?php echo $detail ?></td>

              </tr>
          </table>
          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:240px">ตั้งแต่วันที่ <?php echo $startDate ?> </td>
                <td style="width:250px">ถึงวันที่ <?php echo $endDate ?></td>
                <td style="width:250px">รวม<?php echo $showCount ?></td>
              </tr>
          </table>


          <table align="center" class="table table-responsive-sm borderless">

            <tbody>
              <tr>
                <td style="width:740px">ในการลาต้องมีหลักฐานประกอบการลา</td>
              </tr>
            </tbody>
          </table>

          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:740px">
                  <input type="checkbox" aria-label="Checkbox for following text input"> ใบรับรองแพทย์ กรณี ลาป่วยติดต่อกัน 3 วันขึ้นไป ลาเนื่องจากอุบัติเหตุในการทำงาน กรณีลาเนื่องจากอุบัติเหตุในการทำงานต้องไปพบแพทย์/พยาบาลประจำบริษัทเพื่อสอบถามอาการ ตามรายละเอียดด้านหลัง
                </td>
              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:740px">
                  <input type="checkbox" aria-label="Checkbox for following text input"> ใบบันทึกประวัติอาการท้องเสีย (กรณีลาป่วยเนื่องจากอาการท้องเสีย ท้องร่วง หรือถ่ายเหลว)
                </td>
              </tr>

            </tbody>
          </table>
          <br />
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td align="center" style="width:370px">
                  <Img width="120px" class="regular shadow" src="<?php echo $ImgUrl ?>"></Img>
                </td>
                <td align="center" style="width:370px">

                  <p>เรียนมาเพื่อพิจารณาอนุมัติ</p>
                  <p>ลงชื่อ <?php echo $employeeName ?></p>
                </td>
              </tr>

            </tbody>
          </table>
          <hr />
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:740px">
                  <p style="font-weight:800">
                    ความคิดเห็น สำหรับแพทย์/พยาบาล ประจำบริษัท กรณีลาป่วย หรือลาเนื่องจากอุบัติเหตุในการทำงาน
                  </p>
                </td>
              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:520px">
                  สอบถามอาการหลังหายป่วย หรืออุบัติเหตุในการทำงานและตรวจสุขภาพเบื้องต้น
                </td>
                <td style="width:110px">
                  <input disabled <?php if ($statusHeathy == 'Y') echo "checked"; ?> type="checkbox" aria-label="Checkbox for following text input"> หายเป็นปกติ
                </td>
                <td style="width:110px">
                  <input disabled <?php if ($statusHeathy == 'N') echo "checked";  ?> type="checkbox" aria-label="Checkbox for following text input"> ยังไม่หาย
                </td>

              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:740px">
                  <p style="font-weight:800">
                    เนื่องจาก <?php echo $healthyDetail ?>


                </td>
              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td style="width:340px">
                </td>
                <td align="center" style="width:4000px">


                  <p>ลงชื่อ <?php echo $nameDoctor ?> แพทย์/พยาบาล วันที่ <?php echo $lastUpdateDate ?></p>
                </td>
              </tr>

            </tbody>
          </table>
          <hr />
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td align="center" style="width:370px">
                  <p>ลงชื่อ <?php echo $review ?> ผู้ทบทวน</p>
                </td>
                <td align="center" style="width:370px">

                  <p>ลงชื่อ <?php echo $approve ?> ผู้อนุมัติ</p>
                </td>
              </tr>

            </tbody>
          </table>
          <table align="center" class="table table-responsive-sm borderless">
            <tbody>
              <tr>
                <td align="center" style="width:370px">
                  <p>วันที่ <?php echo $dateReview ?></p>
                </td>
                <td align="center" style="width:370px">

                  <p>วันที่ <?php echo $dateApprove ?></p>
                </td>
              </tr>

            </tbody>
          </table>

          <table class="table table-responsive-sm borderless" align="center">
            <thead>
              <tr align="center">
                <th>ส่วนงานตรวจสอบสถิติการลาของพนักงานก่อนการอนุมัติใน Discoverer-Employee Holiday-sheet3 สถิติการลา</th>
              </tr>
            </thead>

          </table>


          <table class="table table-responsive-sm " align="center">
            <thead class="border border-dark">

              <tr align="center">
                <th>การลากิจ ลาป่วย ลาพักผ่อนประจำปี ลาคลอด ลาฝึกทหาร ลาเมตตาจิต และลาอื่นๆ</th>
              </tr>


            </thead>

          </table>
          <table class="table table-responsive-sm" align="center">
            <thead class="border border-dark">
              <tr align="center">
                <th class="col">R->Review (ทบทวน) A ->Approve (อนุมัติ)</th>
              </tr>

            </thead>
          </table>

          <table align="center" class="table table-responsive-sm ">
            <thead>

              <tr align="center">
                <th class="border border-dark" width="196px">หัวหน้าแผนก</th>
                <th class="border border-dark" width="190px">ผช. /ผจก.ส่วน</th>
                <th class="border border-dark" width="190px">ผช./ผจก.ฝ่าย</th>
                <th class="border border-dark" width="190px">ผช./ผจก.ฝ่าย</th>
              </tr>


            </thead>
            <tbody>
              <tr align="center">
                <td align="left" class="border border-dark">-พนักงานรายวัน</td>
                <td class="border border-dark">R</td>
                <td class="border border-dark">A</td>
                <td class="border border-dark"></td>
              </tr>
              <tr align="center">
                <td class="border border-dark" align="left">-จนท.รายเดือน-หน.แผนก</td>
                <td class="border border-dark">R</td>
                <td class="border border-dark">A</td>
                <td class="border border-dark"></td>
              </tr>
              <tr align="center">
                <td class="border border-dark" align="left">-ผช.ผจก.ส่วน - ผจก.ส่วน</td>
                <td class="border border-dark"></td>
                <td class="border border-dark">R</td>
                <td class="border border-dark">A</td>
              </tr>
            </tbody>
          </table>
          <br />

          <div class="text-start">
            <p>
              ความเห็นของส่วนสรรหา แรงงานสัมพันธ์และสารสนเทศงานบุคคล................................
            </p>
          </div>
          <table align="center">
            <tbody>
              <tr align="center">
                <th width="195px"></th>
                <th width="190px"></th>
                <th width="190px">ลงชื่อ........................</th>
                <th width="190px">........../.........../..........</th>
              </tr>
            </tbody>

          </table>

        </div>
        <div class="card-footer">
          <div class="row justify-content-between">
            <div class="col">


            </div>
            <div class="col" align="end">

              <p>F-5210-25 (R8-3/5/67)</p>

            </div>

          </div>

        </div>

      </div>
      <div class="mt-3">

      </div>

      <div class=" col-12 col-md-10 col-lg-7 col-sm-12 card shadow border-dark ">
       
          <div class="card-body">
            <div align="center">
             
              <Img width="100%" class="regular " src="image/backLa.png"></Img>
           

            </div>
          

          </div>
      </div>

    </div>
















</body>

</html>