<?php session_start(); ?>
<?php require('web_config.php'); ?>
<?php require('mysql/config.php'); ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset=utf-8 />
  <title>Accept Form</title>
</head>
<body>

<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  $ownerName=$_POST['txtOwnerName'];
  $ownerLevel=$_POST['txtOwnerLevel'];
  $addrNum=$_POST['txtAddrNum'];
  $villageNo=$_POST['txtVillageNo'];
  $road=$_POST['txtRoad'];
  $lane=$_POST['txtLane'];
  $subDistrict=$_POST['txtSubDistrict'];
  $district=$_POST['txtDistrict'];
  $province=$_POST['txtProvince'];
  $postalCode=$_POST['txtPostalCode'];
  $phone=$_POST['txtPhone'];
  $email=$_POST['txtEmail'];
  if ($_POST['rdbAccept'] === 'accept') {
    $accept=1;
  } else {
    $accept=0;
  }
  $isDelete=0;
  $createDate = date('Y-m-d H:i:s');

  $sql="INSERT INTO owner(
            OwnerName, OwnerLevel, AddrNum, VillageNo, Road,
            Lane, SubDistrict, District, Province, PostalCode,
            Phone, Email, Accept, IsDelete, CreateDate)
        VALUES (
            '$ownerName', '$ownerLevel', '$addrNum', '$villageNo', '$road',
            '$lane', '$subDistrict', '$district', '$province', '$postalCode',
            '$phone', '$email', '$accept', '$isDelete', '$createDate')";
  require('mysql/connect.php');

  if($result==1) {
    $owenerId = $last_id;
    if ($accept === 1) {
      $sql2="INSERT INTO employee(
                OwnerId, EmpName, EmpLevel)
            VALUES ('$owenerId','','')";
    }
    $empname = $_POST["empname"];
    $emplevel = $_POST["emplevel"];
    $number = count($emp);
    if($number > 0) {
      for ($i=0; $i < $number; $i++) { 
        if(trim($_POST["empname"][$i]) != '' && trim($_POST["emplevel"][$i]) != '') {
          $sql = "INSERT INTO employee(
                      OwnerId, EmpName, EmpLevel)
                  VALUES (
                      '$owenerId', '$empname[$i]', '$emplevel[$i]')";
          require('mysql/connect.php');
        }
      }
      echo "Data Inserted";
    } else {
      echo "Enter Name And Level";
    }

    $v1=1;
    $msg="การบันทึกข้อมูลเสร็จสิ้น";
  }
  else {
    $v1=0;
    $msg="การบันทึกข้อมูลผิดพลาด";
  }

  require('mysql/unconn.php');
?>
</body>
</html>