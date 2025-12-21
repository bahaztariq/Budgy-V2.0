<?php
require('../db/db_connect.php');

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $card = $_POST['Card'];
   $montant = $_POST['montant'] ;
   $Description = $_POST['description'] ;
   $Date = $_POST['Date'] ;

   $sql = "INSERT INTO incomes(UserID,montant,date_,description,cardNumber) VALUES ('$userid','$montant','$Date','$Description','$card')";
   $sql2 = "UPDATE cards SET balance = balance + '$montant' WHERE cardNumber = '$card' ";
   if(mysqli_query($connect,$sql) && mysqli_query($connect,$sql2)){
    header("location:../pages/incomes.php");
   }else{
    echo mysqli_error($connect);
   }
}


?>