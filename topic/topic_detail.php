<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic Detail</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
  $tpid=$_GET['tpid'];
  
  $sql = "SELECT TopicId, TopicName, Description,
                Enable, CreateDate, EditDate
                FROM topic 
                WHERE TopicId = '$tpid'";

  require('../mysql/connect.php');

  list($topicId, $topicName, $description,
  $enable, $createDate, $editDate)=mysqli_fetch_array($result);
?>
  <br>
  <header>
    <h2 style="text-align: center;">รายละเอียดหัวข้อ</h2>
  </header>
  <div class="container">
    รหัสหัวข้อ : <?php echo($tpid); ?><br />
    ชื่อหัวข้อ : <?php echo($topicName); ?><br />
    รายละเอียด : <br /><?php echo(str_replace("\n","<br />", $description)); ?><br />
    สถานะ : <?php echo($arrStatusOfEnable[$enable]); ?><br />
    วันที่สร้าง : <?php echo date_format(date_create($createDate),"d/m/Y"); ?><br />
    วันที่แก้ไข : <?php echo ($editDate == '0000-00-00 00:00:00' ? 'ยังไม่มีการแก้ไข' : date_format(date_create($editDate),"d/m/Y")); ?><br />
    <?php require('../mysql/unconn.php'); ?>
    <br /><br /><br />
    <a href="topic_edit.php?tpid=<?php echo($tpid); ?>" class="btn btn-success">แก้ไข</a>
    <a href="javascript:rmtopic('<?php echo($tpid); ?>');" class="btn btn-danger">ลบ</a>
    <a href="javascript:window.history.back();" class="btn btn-primary">กลับ</a>
  </div>
  <script language="javascript">
    function rmtopic(v1) {
      var url="topic_delete.php?tpid=" + v1;
      var r=confirm("ยืนยันการลบข้อมูล");
      if(r==true) {
        window.location.href=url;
      }
    }
  </script>
</body>
</html>