<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Title Edit</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php

  if(isset($_GET['ttid'])) {
    $ttid=$_GET['ttid'];
    $oldid = $ttid;
  
    $sql = "SELECT t.*, p.TopicName
            FROM title t
            INNER JOIN topic p
            ON t.topicid = p.topicid
            WHERE t.TitleId = '$ttid'";
  
    require('../mysql/connect.php');
  
    list($titleId, $topicId, $titleName, $description, $project, $meetingDate,
    $meetingStartTime, $meetingEndTime, $meetingPlace, $enable,
    $createDate, $editDate, $topicName)=mysqli_fetch_array($result);
  
    require('../mysql/unconn.php');
  }

  if(isset($_POST['submit'])) {
    $ttOldId = $_POST['oldid'];
    $titleName = $_POST['txtTitleName'];
    $topicId = $_POST['ddlTopicId'];
    $titleDescription = $_POST['txtTitleDescription'];
    $project = $_POST['txtProject'];
    $meetingDate = $_POST['txtMeetingDate'];
    $meetingStartTime = $_POST['txtMeetingStartTime'];
    $meetingEndTime = $_POST['txtMeetingEndTime'];
    $meetingPlace = $_POST['txtMeetingPlace'];
    $ttEnable = $_POST['rdbTitleStatus'];
    $ttEditDate = date('Y-m-d H:i:s');

    $sql="UPDATE title SET
      TopicId='$topicId',
      TitleName='$titleName',
      Description='$titleDescription',
      Project='$project',
      MeetingDate='$meetingDate',
      MeetingStartTime='$meetingStartTime',
      MeetingEndTime='$meetingEndTime',
      MeetingPlace='$meetingPlace',
      Enable='$ttEnable',
      EditDate='$ttEditDate'";

    $sql.= " WHERE TitleId='$ttOldId'";
    
    require('../mysql/connect.php');

    if($result === TRUE) {
      $_SESSION['success'] = "แก้ไขหัวข้อเสร็จสิ้น";
    } else {
      $_SESSION['error'] = "แก้ไขหัวข้อผิดพลาด กรุณาตรวจสอบ";
    }

    require('../mysql/unconn.php');
    header("Location: title_detail.php?ttid=" . $ttOldId);
    
  }
?>

  <br>
  <header>
    <h2 style="text-align: center;">แก้ไขชื่อเรื่อง</h2>
  </header>
  <div class="container">
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="txtTitleId">รหัสชื่อเรื่อง : </label>
        <input name="oldid" type="hidden" value="<?php echo($oldid); ?>">
        <input type="text" name="txtTitleId" id="txtTitleId" class="form-control" value="<?php echo($titleId); ?>" disabled>
      </div>
      <div class="form-group">
        <label for="txtTitleName">ชื่อเรื่อง : </label>
        <input type="text" name="txtTitleName" id="txtTitleName" placeholder="ชื่อเรื่อง" class="form-control" value="<?php echo($titleName); ?>" required>
      </div>
      <div class="form-group">
        <label for="ddlTopicId">ชื่อหัวข้อ :</label>
        <select name="ddlTopicId" id="ddlTopicId" class="form-control" required>
          <?php
            $sql = "SELECT TopicId, TopicName FROM topic ORDER BY TopicId ASC";
            require('../mysql/connect.php');
            
            while($record = mysqli_fetch_array($result)) {
              if($record[0] == $topicId){
                echo ("<option selected='" . "selected" . "' value='" .$record[0]. "'>" . $record[1] . "</option>");
              } else {
                echo ("<option value='" . $record[0] . "'>" . $record[1] . "</option>");
              }
            }

            require('../mysql/unconn.php');
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="txtTitleDescription">คำอธิบาย : </label>
        <textarea name="txtTitleDescription" id="txtTitleDescription" rows="5" cols="40" placeholder="คำอธิบาย" class="form-control"><?php echo($description); ?></textarea>
      </div>
      <div class="form-group">
        <label for="txtProject">ชื่อโครงการ : </label>
        <input type="text" name="txtProject" id="txtProject" placeholder="ชื่อโครงการ" class="form-control" value="<?php echo($project); ?>">
      </div>
      <div class="form-group">
        <label for="txtMeetingDate">วันที่ประชุม : </label>
        <input type="date" id="txtMeetingDate" name="txtMeetingDate" class="form-control" value="<?php echo($meetingDate); ?>">
      </div>
      <div class="form-group">
        <label for="txtMeetingStartTime">เวลาเริ่มการประชุม : </label>
        <input type="time" id="txtMeetingStartTime" name="txtMeetingStartTime" class="form-control" value="<?php echo($meetingStartTime); ?>">
      </div>
      <div class="form-group">
        <label for="txtMeetingEndTime">เวลาสิ้นสุดการประชุม : </label>
        <input type="time" id="txtMeetingEndTime" name="txtMeetingEndTime" class="form-control" value="<?php echo($meetingEndTime); ?>">
      </div>
      <div class="form-group">
        <label for="txtMeetingPlace">สถานที่ประชุม : </label>
        <input type="text" name="txtMeetingPlace" id="txtMeetingPlace" placeholder="สถานที่ประชุม" class="form-control" value="<?php echo($meetingPlace); ?>" required>
      </div>
      <div class="form-group">
        <label for="rdbTitleStatus">สถานะ : </label>
        <label class="radio-inline">
          <input type="radio" id="rdbTitleStatusOff" name="rdbTitleStatus" value="0" <?php echo ($enable==0) ? 'checked' : '' ?>>ปิด
        </label>
        <label class="radio-inline">
          <input type="radio" id="rdbTitleStatusOn" name="rdbTitleStatus" value="1" <?php echo ($enable==1) ? 'checked' : '' ?>>เปิด
        </label>
      </div>
      <div class="form-group">
        <label for="txtTitleCreateDate">วันที่สร้าง : </label>
        <input type="datetime" name="txtTitleCreateDate" id="txtTitleCreateDate" placeholder="วันที่สร้าง" class="form-control" value="<?php echo(date_format(date_create($createDate),"d/m/Y")); ?>" disabled>
      </div>
      <div class="form-group">
        <label for="txtTitleEditDate">วันที่แก้ไข : </label>
        <input type="datetime" name="txtTitleEditDate" id="txtTitleEditDate" placeholder="วันที่แก้ไข" class="form-control" value="<?php echo ($editDate == '0000-00-00 00:00:00' ? 'ยังไม่มีการแก้ไข' : date_format(date_create($editDate),"d/m/Y")); ?>" disabled>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-success" value="บันทึก">
        <a href="javascript:window.history.back();" class="btn btn-primary">กลับ</a>
      </div>
    </form>
  </div>
</body>
</html>