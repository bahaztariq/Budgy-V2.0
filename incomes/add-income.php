<?php
require('../db/db_connect.php');

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $montant = $_POST['montant'] ;
   $Description = $_POST['description'] ;
   $Date = $_POST['Date'] ;

   $sql = "INSERT INTO incomes(UserID,montant,date_,description) VALUES ('$userid','$montant','$Date','$Description')";

   if(mysqli_query($connect,$sql)){
    header("location:../pages/incomes.php");
   }else{
    echo mysqli_error($connect);
   }
}


?>