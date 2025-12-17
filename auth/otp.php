<?php
require('../db/db_connect.php');


session_start();
if (!isset($_SESSION['Temp_user_id'])) {   
      header("Location: login.php");    
      exit;
}
?>