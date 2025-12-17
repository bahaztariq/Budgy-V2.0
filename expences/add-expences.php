<?php
require('../db_connect.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $montant = $_POST['montant'] ;
   $Description = $_POST['description'] ;
   $Date = $_POST['Date'] ;

   $sql = "INSERT INTO expences(montant,date_,description) VALUES ('$montant','$Date','$Description')";

   if(mysqli_query($connect,$sql)){
    header("location:../expences.php");
   }else{
    echo mysqli_error($connect);
   }
}


?>