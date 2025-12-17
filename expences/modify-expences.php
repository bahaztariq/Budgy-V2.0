<?php
    require('../db_connect.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $montant = $_POST['montant'];
        $description = $_POST['description'];
        $date = $_POST['Date'];


        $sql = "UPDATE expences SET montant = '$montant',date_ = '$date', description = '$description' WHERE id = $id";
        if(mysqli_query($connect,$sql)){
            header("Location:../expences.php");
        }else{
            echo mysqli_error($connect);
        }

    }

?>