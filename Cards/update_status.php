<?php
require '../db/db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $isActive = $_POST['isActive'];

    $sql = "UPDATE cards SET isActive = ? WHERE id = ?"; 
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $isActive, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
}