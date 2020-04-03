<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<?php

  $sql = "SELECT * FROM topic WHERE 1";

  if(isset($_GET['keywordSearch'])) {
    $keywordSearch = $_GET['keywordSearch'];
    $sql.= " AND TopicName LIKE '%$keywordSearch%'";
  }
  
  $sql.= " ORDER BY topicid ASC";
  $keywordSearch = "";
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic List</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<body>

<?php if(isset($_SESSION['success'])) : ?>
  <div class="success">
    <?php
      echo $_SESSION['success'];
    ?>
  </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])) : ?>
  <div class="error">
    <?php
      echo $_SESSION['error'];
    ?>
  </div>
<?php endif; ?>
<?php

?>
<br>
<header>
  <h2 style="text-align: center;">รายการหัวข้อ</h2>
</header>
<div class="container">
  <form action="topic_list.php" method="get" name="search_Form" target="_self">
    <div class="input-container">
      <input class="input-field" type="text" placeholder="ชื่อหัวข้อที่ต้องการค้นหา" name="keywordSearch">
      <input name="submit" type="submit" value="ค้นหา">
    </div>
    <br>
    <a href="topic_form.php">เพิ่มหัวข้อใหม่</a>
  </form><br />

  <?php require('../mysql/connect.php'); ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อหัวข้อ</th>
        <th>รายละเอียด</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>

    <?php while($record=mysqli_fetch_array($result)) { ?>
      <tr>
        <td><?php echo($record[0]); ?></td>
        <td><?php echo($record[1]); ?></td>
        <td><?php echo($record[2]); ?></td>
        <td><?php echo($arrStatusOfEnable[$record[3]]); ?></td>
        <td>
          <?php echo '<a href="'. "topic_detail.php?tpid=" . $record[0] . '">ดู</a>'; ?>
          <?php echo '<a href="'. "topic_edit.php?tpid=" . $record[0] . '">แก้ไข</a>'; ?>
          <a href="javascript:rmtopic('<?php echo($record[0]); ?>');">ลบ</a>
        </td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
  <?php require('../mysql/unconn.php'); ?>
  <script language="javascript">
    function rmtopic(v1) {
      var url="topic_delete.php?tpid=" + v1;
      var r=confirm("ยืนยันการลบข้อมูล");
      if(r==true) {
        window.location.href=url;
      }
    }
  </script>

</div>
</body>
</html>
<?php
	if(isset($_SESSION['success']) || isset($_SESSION['error'])) {
		session_destroy();
	}
?>