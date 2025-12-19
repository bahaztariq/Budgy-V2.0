<?php
require '../db/db_connect.php';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];
$sql = "SELECT * FROM incomes WHERE UserID = '$userid' ";
$incomes = mysqli_query($connect,$sql);
?>