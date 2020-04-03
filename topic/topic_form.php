<?php session_start(); ?>
<?php require('../web_config.php'); ?>
<?php require('../mysql/config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
  if(isset($_POST['submit'])) {
    $topicName = $_POST['txtTopicName'];
    $topicDescription = $_POST['txtTopicDescription'];
    $enable = 1;
    $createDate = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO topic(TopicName, Description, Enable, CreateDate)
            VALUES ('$topicName','$topicDescription','$enable','$createDate')";

    require('../mysql/connect.php');

    if($result === TRUE) {
      $_SESSION['success'] = "บันทึกหัวข้อเสร็จสิ้น";
    } else {
      $_SESSION['error'] = "บันทึกหัวข้อผิดพลาด กรุณาตรวจสอบ";
    }

    require('../mysql/unconn.php');
    header("Location: topic_list.php");
  }
?>
  <br>
  <header>
    <h2 style="text-align: center;">เพิ่มหัวข้อ</h2>
  </header>
  <div class="container">
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <input type="text" name="txtTopicName" id="txtTopicName" placeholder="ชื่อหัวข้อ" class="form-control" required>
      </div>
      <div class="form-group">
        <textarea name="txtTopicDescription" id="txtTopicDescription" rows="5" cols="40" placeholder="คำอธิบาย" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="บันทึก">
      </div>
    </form>
  </div>
</body>
</html>