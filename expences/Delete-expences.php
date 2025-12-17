<?php
require('../db_connect.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $connect->prepare("DELETE FROM expences WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location:../pages/expences.php");
        exit();
    } else {
        header("Location:../pages/expences.php?error=delete_failed");
        exit();
    }
    
    $stmt->close();
} else {
    header("Location:../pages/expences.php");
    exit();
}
?>