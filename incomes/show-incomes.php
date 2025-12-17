<?php
require './db_connect.php';
$sql = "SELECT * FROM incomes";
$incomes = mysqli_query($connect,$sql);
?>