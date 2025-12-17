<?php
$server = "localhost";
$db_user = "root";
$db_password ="";
$db_name = "Smart_Wallet";

  $connect = mysqli_connect($server, $db_user, $db_password, $db_name);



if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}
session_set_cookie_params([
  'httponly' => true,
  'secure'   => false,
  'samesite' => 'Strict'
]);
session_start();
?>