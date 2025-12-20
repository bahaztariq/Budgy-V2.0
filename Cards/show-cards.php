<?php
require '../db/db_connect.php';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

$stmt = $connect->prepare("SELECT * FROM cards WHERE Userid = ?");
$stmt->bind_param("i", $userid); 
$stmt->execute();
$result = $stmt->get_result();
