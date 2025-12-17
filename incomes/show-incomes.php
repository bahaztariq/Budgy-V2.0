<?php
require '../db/db_connect.php';
$sql = "SELECT * FROM incomes";
$incomes = mysqli_query($connect,$sql);
?>