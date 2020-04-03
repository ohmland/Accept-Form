<?php session_start(); ?>
<?php require('../web_config.php'); ?>
<?php require('../mysql/config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Title Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
  
  if(isset($_POST['submit'])) {
    $titleName = $_POST['txtTitleName'];
    $topicId = $_POST['ddlTopicId'];
    $titleDescription = $_POST['txtTitleDescription'];
    $project = $_POST['txtProject'];
    $meetingDate = $_POST['txtMeetingDate'];
    $meetingStartTime = $_POST['txtMeetingStartTime'];
    $meetingEndTime = $_POST['txtMeetingEndTime'];
    $meetingPlace = $_POST['txtMeetingPlace'];
    $enable = 1;
    $createDate = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO title(TopicId, TitleName, Description, Project, 
                        MeetingDate, MeetingStartTime, MeetingEndTime, 
                        MeetingPlace, Enable, CreateDate) 
            VALUES ('$topicId', '$titleName', '$titleDescription', '$project', 
                    '$meetingDate', '$meetingStartTime', '$meetingEndTime', 
                    '$meetingPlace', '$enable', '$createDate')";

    require('../mysql/connect.php');

    if($result === TRUE) {
      $_SESSION['success'] = "บันทึกชื่อเรื่องเสร็จสิ้น";
    } else {
      $_SESSION['error'] = "บันทึกชื่อเรื่องผิดพลาด กรุณาตรวจสอบ";
    }

    require('../mysql/unconn.php');
    header("Location: title_list.php");
  }
?>
  <br>
  <header>
    <h2 style="text-align: center;">เพิ่มชื่อเรื่อง</h2>
  </header>
  <div class="container">
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="txtTitleName">ชื่อเรื่อง:</label>
        <input type="text" name="txtTitleName" id="txtTitleName" placeholder="ชื่อเรื่อง" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="ddlTopicId">ชื่อหัวข้อ:</label>
        <select name="ddlTopicId" id="ddlTopicId" class="form-control" required>
          <?php
            $sql = "SELECT TopicId, TopicName FROM topic ORDER BY TopicId ASC";
            require('../mysql/connect.php');
            
            while($record = mysqli_fetch_array($result)) {
              // $topic_name = $rows['TopicName'];
              echo ("<option value='" .$record[0]. "'>" . $record[1] . "</option>");
            }

            require('../mysql/unconn.php');
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="txtTitleDescription">คำอธิบาย:</label>
        <textarea name="txtTitleDescription" id="txtTitleDescription" rows="5" cols="40" placeholder="คำอธิบาย" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="txtProject">ชื่อโครงการ:</label>
        <input type="text" name="txtProject" id="txtProject" placeholder="ชื่อโครงการ" class="form-control">
      </div>
      <div class="form-group">
        <label for="txtMeetingDate">วันที่ประชุม:</label>
        <input type="date" id="txtMeetingDate" name="txtMeetingDate" class="form-control">
      </div>
      <div class="form-group">
        <label for="txtMeetingStartTime">เวลาเริ่มการประชุม:</label>
        <input type="time" id="txtMeetingStartTime" name="txtMeetingStartTime" class="form-control">
      </div>
      <div class="form-group">
        <label for="txtMeetingEndTime">เวลาสิ้นสุดการประชุม:</label>
        <input type="time" id="txtMeetingEndTime" name="txtMeetingEndTime" class="form-control">
      </div>
      <div class="form-group">
        <label for="txtMeetingPlace">สถานที่ประชุม:</label>
        <input type="text" name="txtMeetingPlace" id="txtMeetingPlace" placeholder="สถานที่ประชุม" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="บันทึก">
      </div>
    </form>
  </div>
</body>
</html>