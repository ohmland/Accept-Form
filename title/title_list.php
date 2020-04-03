<?php session_start(); ?>
<?php require('../mysql/config.php'); ?>
<?php require('../web_config.php'); ?>
<?php

  $sql = "SELECT t.*, p.TopicName
          FROM title t
          INNER JOIN topic p
          ON t.topicid = p.topicid
          WHERE 1";

  if(isset($_GET['keywordSearch'])) {
    $keywordSearch = $_GET['keywordSearch'];
    $sql.= " AND TopicName LIKE '%$keywordSearch%'";
  }
  
  $sql.= " ORDER BY titleid ASC";
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
  <h2 style="text-align: center;">รายการชื่อเรื่อง</h2>
</header>
<div class="container">
  <form action="title_list.php" method="get" name="search_Form" target="_self">
    <div class="input-container">
      <input class="input-field" type="text" placeholder="ชื่อเรื่องที่ต้องการค้นหา" name="keywordSearch">
      <input name="submit" type="submit" value="ค้นหา">
    </div>
    <br>
    <a href="title_form.php">เพิ่มชื่อเรื่องใหม่</a>
  </form><br />

  <?php require('../mysql/connect.php'); ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อเรื่อง</th>
        <th>ประเภทหัวข้อ</th>
        <th>รายละเอียด</th>
        <th>ชื่อโครงการ</th>
        <th>วันที่ประชุม</th>
        <th>สถานที่ประชุม</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>

    <?php while($record=mysqli_fetch_array($result)) { ?>
      <tr>
        <td><?php echo($record[0]); ?></td>
        <td><?php echo($record[2]); ?></td>
        <td><?php echo($record[12]); ?></td>
        <td><?php echo($record[3]); ?></td>
        <td><?php echo($record[4]); ?></td>
        <td><?php echo($record[5]); ?></td>
        <td><?php echo($record[8]); ?></td>
        <td><?php echo($arrStatusOfEnable[$record[9]]); ?></td>
        <td>
          <?php echo '<a href="'. "title_detail.php?ttid=" . $record[0] . '">ดู</a>'; ?>
          <?php echo '<a href="'. "title_edit.php?ttid=" . $record[0] . '">แก้ไข</a>'; ?>
          <a href="javascript:rmtitle('<?php echo($record[0]); ?>');">ลบ</a>
        </td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
  <?php require('../mysql/unconn.php'); ?>
  <script language="javascript">
    function rmtitle(v1) {
      var url="title_delete.php?ttid=" + v1;
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