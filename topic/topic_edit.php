<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic Edit</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php

  if(isset($_GET['tpid'])) {
    $tpid=$_GET['tpid'];
    $oldid = $tpid;
  
    $sql = "SELECT TopicId, TopicName, Description,
                  Enable, CreateDate, EditDate
                  FROM topic 
                  WHERE TopicId = '$tpid'";
  
    require('../mysql/connect.php');
  
    list($topicId, $topicName, $description,
    $enable, $createDate, $editDate)=mysqli_fetch_array($result);
  
    require('../mysql/unconn.php');
  }

  if(isset($_POST['submit'])) {

    $tpOldid = $_POST['oldid'];
    $tpName = $_POST['txtTopicName'];
    $tpDesc = $_POST['txtTopicDescription'];
    $tpEnable = $_POST['rdbTopicStatus'];
    $tpEditDate = date('Y-m-d H:i:s');

    $sql="UPDATE topic SET
      TopicName='$tpName', 
      Description='$tpDesc', 
      Enable='$tpEnable', 
      EditDate='$tpEditDate'";

    $sql.= " WHERE TopicId='$tpOldid'";

    require('../mysql/connect.php');

    if($result === TRUE) {
      $_SESSION['success'] = "แก้ไขหัวข้อเสร็จสิ้น";
    } else {
      $_SESSION['error'] = "แก้ไขหัวข้อผิดพลาด กรุณาตรวจสอบ";
    }

    require('../mysql/unconn.php');
    header("Location: topic_detail.php?tpid=" . $tpOldid);
    
  }
?>

  <br>
  <header>
    <h2 style="text-align: center;">แก้ไขหัวข้อ</h2>
  </header>
  <div class="container">
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="txtTopicId">รหัสหัวข้อ : </label>
        <input name="oldid" type="hidden" value="<?php echo($oldid); ?>">
        <input type="text" name="txtTopicId" id="txtTopicId" class="form-control" value="<?php echo($topicId); ?>" disabled>
      </div>
      <div class="form-group">
        <label for="txtTopicName">ชื่อหัวข้อ : </label>
        <input type="text" name="txtTopicName" id="txtTopicName" placeholder="ชื่อหัวข้อ" class="form-control" value="<?php echo($topicName); ?>" required>
      </div>
      <div class="form-group">
        <label for="txtTopicDescription">คำอธิบาย : </label>
        <textarea name="txtTopicDescription" id="txtTopicDescription" rows="5" cols="40" placeholder="คำอธิบาย" class="form-control"><?php echo($description); ?></textarea>
      </div>
      <div class="form-group">
        <label for="rdbTopicStatus">สถานะ : </label>
        <label class="radio-inline">
          <input type="radio" id="rdbTopicStatusOff" name="rdbTopicStatus" value="0" <?php echo ($enable==0) ? 'checked' : '' ?>>ปิด
        </label>
        <label class="radio-inline">
          <input type="radio" id="rdbTopicStatusOn" name="rdbTopicStatus" value="1" <?php echo ($enable==1) ? 'checked' : '' ?>>เปิด
        </label>
      </div>
      <div class="form-group">
        <label for="txtTopicCreateDate">วันที่สร้าง : </label>
        <input type="datetime" name="txtTopicCreateDate" id="txtTopicCreateDate" placeholder="วันที่สร้าง" class="form-control" value="<?php echo(date_format(date_create($createDate),"d/m/Y")); ?>" disabled>
      </div>
      <div class="form-group">
        <label for="txtTopicEditDate">วันที่แก้ไข : </label>
        <input type="datetime" name="txtTopicEditDate" id="txtTopicEditDate" placeholder="วันที่แก้ไข" class="form-control" value="<?php echo ($editDate == '0000-00-00 00:00:00' ? 'ยังไม่มีการแก้ไข' : date_format(date_create($editDate),"d/m/Y")); ?>" disabled>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-success" value="บันทึก">
        <a href="javascript:window.history.back();" class="btn btn-primary">กลับ</a>
      </div>
    </form>
  </div>
</body>
</html>