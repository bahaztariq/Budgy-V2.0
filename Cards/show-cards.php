<?php
require '../db/db_connect';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

$sql = "SELECT * FROM cards Where Userid = '$userid' ";
$stmt = $connect->prepare($sql);
$stmt->bindresult();
$stmt->execute();
$cards = $stmt->get_result();


print_r($cards);
