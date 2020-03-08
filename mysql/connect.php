<?php
  $conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  mysqli_query($conn,"SET NAMES utf8");
  $result=mysqli_query($conn,$sql);
  $last_id = mysqli_insert_id($conn);
?>