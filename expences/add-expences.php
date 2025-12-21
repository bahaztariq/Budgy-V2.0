<?php
require('../db/db_connect.php');

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $category = $_POST['category'];
   $montant = $_POST['montant'];
   $cardNum = $_POST['Card'];
   $Description = $_POST['description'] ;
   $Date = $_POST['Date'] ;

   $sql = "INSERT INTO expences(UserID,montant,date_,description,cardNumber,category) VALUES ('$userid','$montant','$Date','$Description','$cardNum','$category')";
   $sql2 = "UPDATE cards SET balance = balance - '$montant' WHERE cardNumber = '$cardNum' "; 
   if(mysqli_query($connect,$sql) && mysqli_query($connect,$sql2)){
    header("location:../pages/expences.php");
   }else{
    echo mysqli_error($connect);
   }
}


?>