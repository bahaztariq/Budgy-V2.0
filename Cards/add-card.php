<?php
require '../db/db_connect';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cardNum = $_POST['cardNumber'];
    $cardHolder =$_POST['cardHolder'];
    $balance =$_POST['balance'];
    $cardType =$_POST['cardType'];
    $bankname =$_POST['bankname'];
    $expiryDate =$_POST['expiryDate'];
    $cardCvv =$_POST['cardCvv'];

    $sql = "INSERT INTO cards() values(?,?,?,?,?,?,?) ";
    $stmt =$connect->prepare($sql);
    $stmt-> bindparam("ssisssi",);
    $stmt->execute();
}

?>