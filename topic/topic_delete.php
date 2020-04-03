<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic Delete</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
  $tpid = $_GET['tpid'];

  $sql = "DELETE FROM topic
          WHERE TopicId = '$tpid'";

  require('../mysql/connect.php');

  if($result === TRUE) {
    $_SESSION['success'] = "ลบหัวข้อเสร็จสิ้น";
  } else {
    $_SESSION['error'] = "ลบหัวข้อผิดพลาด กรุณาตรวจสอบ";
  }

  require('../mysql/unconn.php');
  header("Location: topic_list.php");

?>
</body>
</html>