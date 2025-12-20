<?php
require '../db/db_connect.php';


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

    $sql = "INSERT INTO cards(UserID ,
                              cardNumber ,
                              expiryDate,
                              cardCvv ,  
                              cardType ,       
                              BankName ,
                              CardHolder,
                              balance) values(?,?,?,?,?,?,?,?) ";
    $stmt =$connect->prepare($sql);
    $stmt-> bind_param("ississsi",$userid,$cardNum,$expiryDate,$cardCvv,$cardType,$bankname,$cardHolder,$balance);
    $stmt->execute();
    header("location:../pages/Cards.php");
}

?>