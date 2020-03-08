<?php session_start(); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accept Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <br>
  <h2 style="text-align: center;">แบบตอบรับการเข้าร่วมประชุม</h2>
  <p style="text-align: center;">การประชุมรับฟังความคิดเห็นของประชาชน ครั้งที่2</p>
  <p style="text-align: center;">(กลุ่มย่อย)</p>
  <div class="container">
    <!-- <form action="" method="post"> -->
    <form id="acceptForm" action="accept_save.php" method="post" name="acceptForm" target="_self">
      <div class="form-group">
        <input type="text" name="txtOwnerName" id="txtOwnerName" placeholder="ชื่อ-สกุล" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtOwnerLevel" id="txtOwnerLevel" placeholder="หน่วยงาน" class="form-control level_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtAddrNum" id="txtAddrNum" placeholder="ที่อยู่" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtVillageNo" id="txtVillageNo" placeholder="หมู่ที่" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtRoad" id="txtRoad" placeholder="ถนน" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtLane" id="txtLane" placeholder="ซอย" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtSubDistrict" id="txtSubDistrict" placeholder="ตำบล/แขวง" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtDistrict" id="txtDistrict" placeholder="อำเภอ/เขต" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtProvince" id="txtProvince" placeholder="จังหวัด" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtPostalCode" id="txtPostalCode" placeholder="รหัสไปรษณีย์" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="text" name="txtPhone" id="txtPhone" placeholder="โทรศัพท์/มือถือ" class="form-control name_list">
      </div>
      <div class="form-group">  
        <input type="text" name="txtEmail" id="txtEmail" placeholder="Email" class="form-control name_list">
      </div>
      <div class="form-group">
        <input type="radio" id="notaccept" name="rdbAccept" value="notaccept" checked>
        <label for="notaccept">ไม่สามารถเข้าร่วมประชุมได้</label>
      </div>
      <div class="form-group">
        <input type="radio" id="accept" name="rdbAccept" value="accept">
        <label for="accept">ยินดีเข้าร่วมประชุม หรือส่งผู้แทนเข้าร่วมคือ</label>
      </div>
    <!-- </form> -->

    <br>

    <div class="form-group form-child hide" id="childEmpForm">
      <!-- <form name="add_name" action="" id="add_name" > -->
        <table class="table table-bordered" id="dynamic_field">
          <tr>
            <td style="text-align: left;"><p><strong>จัดการ</strong></p></td>
            <td colspan="2" style="text-align: center;"><p><strong>ผู้แทนเข้าร่วม</strong></p></td>
          </tr>
          <tr>
            <td style="text-align: left;">
              <button type="button" name="add" id="add" class="btn btn-success">เพิ่ม</button>
            </td>
            <td colspan="2"><input type="text" name="empname[]" id="name" placeholder="ชื่อ-สกุล" class="form-control name_list"></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2"><input type="text" name="emplevel[]" id="level" placeholder="ตำแหน่ง" class="form-control level_list"></td>
          </tr>
        </table>
      <!-- </form> -->
    </div>
    <input type="submit" name="submit" class="btn btn-primary" value="บันทึก" >
    </form>
  </div>
</body>
</html>
<script>
  $(document).ready(function() {
    let i = 1;
    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<tr name="row'+i+'"><td style="text-align: left;"><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">ลบ</button>  </td><td colspan="2"><input type="text" name="empname[]" id="name" placeholder="ชื่อ-สกุล" class="form-control name_list"></td></tr><tr name="row'+i+'"><td></td><td colspan="2"><input type="text" name="emplevel[]" id="level" placeholder="ตำแหน่ง" class="form-control level_list"></td></tr>');
    });

    // $('input[type="radio"]').click(function() {
    //   let inputValue = $(this).attr("value");
    //   if(inputValue === "accept") {
    //     $('.form-child').show();
    //   } else {
    //     $('.form-child').hide();
    //   }
    // });

    $('input[type="radio"]').click(function() {
      let x = document.getElementById("childEmpForm");
      if (x.classList.contains("hide")) {
        x.classList.remove("hide");
      } else {
        x.classList.add("hide");
      }
    });
    
    $(document).on('click', '.btn_remove', function() {
      let button_id = $(this).attr("id");
      //$('#row'+button_id+'').remove();
      let rowName = 'row' + button_id;
      $('tr[name ='+rowName+']').remove();
    });

    // $('#submit').click(function() {
    //   $.ajax({
    //     url:"name.php",
    //     method:"POST",
    //     data:$('#add_name').serialize(),
    //     success:function(data) {
    //       alert(data);
    //       $('#add_name')[0].reset();
    //     }
    //   })
    // });

  });
</script>