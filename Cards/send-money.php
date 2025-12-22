<?php
require '../db/db_connect.php'; 

if (!isset($_SESSION['user_id'])) {   
      header("Location: ../auth/login.php");    
      exit;
}

$userid = $_SESSION['user_id'];

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

$sql4 ="INSERT INTO transactions(UserID,montant, cardNumber, recipientcard) VALUES ('$userid', '$amount, '$cardNumber', '$recipientCard')";
$trx = mysqli_query($connect, $sql4);


if ($minus && $add) {
    echo json_encode(['success' => true]);
    header('Location: ../pages/Transactions.php');
} else {
    echo json_encode(['success' => false, 'error' => 'Transfer Failed']);
}
}
?>