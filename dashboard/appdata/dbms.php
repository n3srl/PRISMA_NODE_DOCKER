<?php
include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';


session_start();



$db_conn = mysqli_connect($db_host ,$db_user, $db_pass,$db_name,$db_port);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
mysqli_select_db($db_conn,$db_name) or die;
mysqli_set_charset($db_conn, "utf8");



