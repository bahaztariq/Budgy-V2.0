<?php
require '../db/db_connect.php';

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}
$userid = $_SESSION['user_id'];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cardNumber = $_POST['Card'];
    $montant = $_POST['montant'];
    $category = $_POST['category'];
    $repititon = $_POST['repititon'];
    

    $sql = "INSERT INTO Recurring_transactions(UserID, CardNumber, Montant, Category, repititon) values(?,?,?,?,?)";
    $stmt =$connect->prepare($sql);
    $stmt-> bind_param("issss",$userid,$cardNumber,$montant,$category,$repititon);
    $stmt->execute();
    header("location:../pages/Reccuring.php");
}


?>