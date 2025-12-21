<?php

require '../db/db_connect.php';

$sql = 'SELECT * FROM Recurring_transactions';
$result = mysqli_query($connect, $sql);

$today = date('D');  
$dayOfMonth = date('d'); 

foreach($result as $row){
    $repitition = $row['repititon'];
    $card = $row['cardNumber'];
    $montant = $row['montant'];

    switch($repitition){
        case 'daily': 
            mysqli_query($connect, "UPDATE cards SET balance = balance - '$montant' WHERE cardNumber = '$card'");
            break;
            
        case 'weekly': 
            if($today === 'Mon'){
                mysqli_query($connect, "UPDATE cards SET balance = balance - '$montant' WHERE cardNumber = '$card'");
            }
            break;

        case 'monthly':
            if($dayOfMonth === '01'){
                 mysqli_query($connect, "UPDATE cards SET balance = balance - '$montant' WHERE cardNumber = '$card'");
            }
            break;
    }
}
?>