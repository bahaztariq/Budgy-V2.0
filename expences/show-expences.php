<?php
require '../db/db_connect.php';
$sql = "SELECT * FROM expences";
$expences = mysqli_query($connect,$sql);
?>