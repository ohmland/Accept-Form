<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accept Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <div class="container">
    <br>
    <br>
    <h2 align="center">Dynamic add</h2>
    <div class="form-group">
      <form name="add_name" action="" id="add_name" >
        <table class="table table-bordered" id="dynamic_field">
          <tr>
            <td><input type="text" name="name[]" id="name" placeholder="ชื่อ-สกุล" class="form-control name_list"></td>
            <td><input type="text" name="level[]" id="level" placeholder="ตำแหน่ง" class="form-control level_list"></td>
            <td><button type="button" name="add" id="add" class="btn btn-success">เพิ่ม</button></td>
          </tr>
        </table>
        <input type="button" name="submit" id="submit" value="Submit">
      </form>
    </div>
  </div>
</body>
</html>
<script>
  $(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" id="name" placeholder="ชื่อ-สกุล" class="form-control name_list"></td><td><input type="text" name="level[]" id="level" placeholder="ตำแหน่ง" class="form-control level_list"></td><td><button name="remove" id="'+i+'" class="btn-danger btn_remove">ลบ</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
    });

    $('#submit').click(function() {
      $.ajax({
        url:"name.php",
        method:"POST",
        data:$('#add_name').serialize(),
        success:function(data) {
          alert(data);
          $('#add_name')[0].reset();
        }
      })
    });

  });
</script>