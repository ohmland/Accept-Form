<?php 
  // $dbhost=$_ENV["DB_HOST"];
  // $dbname=$_ENV["DB_DATABASE"];
  // $dbuser=$_ENV["DB_USERNAME"];
  // $dbpass=$_ENV["DB_PASSWORD"];
  
  $dbhost = getenv('DB_HOST', true);
  $dbname= getenv('DB_DATABASE');
  $dbuser= getenv('DB_USERNAME');
  $dbpass= getenv('DB_PASSWORD');
?>
