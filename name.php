<?php
  $conn = mysqli_connect("localhost", "root", "", "test_dynamic_db");
  // $number = count($_POST["name"]);
  // if($number > 1) {
  //   for ($i=0; $i < $number; $i++) { 
  //     if(trim($_POST["name"][$i]) != '' && trim($_POST["level"][$i]) != '') {
  //       $sql = "INSERT INTO tbl_name(name, level) VALUES('".mysqli_real_escape_string($conn, $_POST["name"][$i])."', '".mysqli_real_escape_string($conn, $_POST["level"][$i])."')";
  //       mysqli_query($conn,"SET NAMES utf8");
  //       mysqli_query($conn, $sql);
  //     }
  //   }
  //   echo "Data Inserted";
  // } else {
  //   echo "Enter Name And Level";
  // }
  var_dump($_POST)

?>