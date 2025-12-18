<?php
require '../db/db_connect.php';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];
$sql = "SELECT * FROM expences where UserID = '$userid'";
$expences = mysqli_query($connect,$sql);
?>