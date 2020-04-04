<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Title Detail</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
  $ttid=$_GET['ttid'];
  
  $sql = "SELECT t.*, p.TopicName
  FROM title t
  INNER JOIN topic p
  ON t.topicid = p.topicid
  WHERE t.TitleId = '$ttid'";

  require('../mysql/connect.php');

  list($titleId, $topicId, $titleName, $description, $project, $meetingDate,
       $meetingStartTime, $meetingEndTime, $meetingPlace, $enable,
       $createDate, $editDate, $topicName)=mysqli_fetch_array($result);
?>
  <br>
  <header>
    <h2 style="text-align: center;">รายละเอียดชื่อเรื่อง</h2>
  </header>
  <div class="container">
    <b>รหัสชื่อเรื่อง :</b> <?php echo($ttid); ?><br />
    <b>ชื่อเรื่อง :</b> <?php echo($titleName); ?><br />
    <b>ประเภทหัวข้อ :</b> <?php echo($topicName); ?><br />
    <b>รายละเอียด :</b> <br /><?php echo(str_replace("\n","<br />", $description)); ?><br />
    <b>ชื่อโครงการ :</b> <?php echo($project); ?><br />
    <b>วันที่ประชุม :</b> <?php echo date_format(date_create($meetingDate),"d/m/Y"); ?><br />
    <b>เวลาเริ่มต้นการประชุม :</b> <?php echo($meetingStartTime); ?><br />
    <b>เวลาสิ้นสุดการประชุม :</b> <?php echo($meetingEndTime); ?><br />
    <b>สถานที่ประชุม :</b> <?php echo($meetingPlace); ?><br />
    <b>สถานะ :</b> <?php echo($arrStatusOfEnable[$enable]); ?><br />
    <b>วันที่สร้าง :</b> <?php echo date_format(date_create($createDate),"d/m/Y"); ?><br />
    <b>วันที่แก้ไข :</b> <?php echo ($editDate == '0000-00-00 00:00:00' ? 'ยังไม่มีการแก้ไข' : date_format(date_create($editDate),"d/m/Y")); ?><br />
    <?php require('../mysql/unconn.php'); ?>
    <br /><br /><br />
    <a href="title_edit.php?ttid=<?php echo($ttid); ?>" class="btn btn-success">แก้ไข</a>
    <a href="javascript:rmtitle('<?php echo($ttid); ?>');" class="btn btn-danger">ลบ</a>
    <a href="javascript:window.history.back();" class="btn btn-primary">กลับ</a>
  </div>
  <script language="javascript">
    function rmtitle(v1) {
      var url="title_delete.php?ttid=" + v1;
      var r=confirm("ยืนยันการลบข้อมูล");
      if(r==true) {
        window.location.href=url;
      }
    }
  </script>
</body>
</html>