<?php
require '../db/db_connect.php'; 

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cardNumber = $_POST['Card'];
    $amount = $_POST['amount'];
    $recipientEmail = $_POST['recipientEmail'];
    $recipientCard = $_POST['recipientCard'];

$sql1 ="SELECT u.UserID FROM users u JOIN cards c ON u.UserID = c.UserID WHERE u.email = '$recipientEmail' AND c.cardNumber = '$recipientCard'";
$result = mysqli_query($connect, $sql1);
if (mysqli_num_rows($result) == 0) {
   die(json_encode(['success' => false, 'error' => 'Invalid Recipient']));
}


$sql2 ="UPDATE cards SET balance = balance + $amount WHERE cardNumber = '$recipientCard'";
$sql3 ="UPDATE cards SET balance = balance - $amount WHERE cardNumber = '$cardNumber'";
$add = mysqli_query($connect, $sql2);
$minus  = mysqli_query($connect, $sql3);

if ($minus && $add) {
    echo json_encode(['success' => true]);
    header('Location: ../pages/Bills.php');
} else {
    echo json_encode(['success' => false, 'error' => 'Transfer Failed']);
}
}
?>