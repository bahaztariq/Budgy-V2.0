<?php

require '../db/db_connect.php';
require '../sendemail.php';

if (isset($_SESSION['user_id'])) {   
      header("Location: ../pages/Dashboard.php?message='You are loged in'");    
      exit;
}

$message = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connect->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['Temp_user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['userName'];
            generateOTP($connect,$email);
            header("Location: otp.php");
            exit();
        } else {
            $message = "Invalid password.";
            echo $message;
        }
    } else {
        $message = "User not found.";
        echo $message;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budgy - Login To Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/css/all/all.min.css">
    <link rel="icon" href="imgs/icon.png">

</head>
<body class="bg-gray-100">
    <main class="w-full h-screen flex items-center">
        <div class="w-full h-screen flex flex-col justify-center items-center gap-4 px-4 ">
            <div class="w-full md:w-3/5 h-1/8 flex justify-start items-center" >
                <a href="../pages/index.php" class="flex justify-center items-center gap-2 text-gray-500"> 
                    <i class="fi fi-ts-angle-left flex justify-center items-center" ></i>
                    <span>Back To Home </span>
                </a>
            </div>
            <form action="login.php" method="POST" class="w-full md:w-3/5 h-7/8 rounded-xl p-2 flex flex-col gap-6 ">
                <h1 class=" text-black font-bold text-5xl">Sign In</h1>
                <div class="flex flex-col gap-2">
                    <label for="">UserName Or Email :</label>
                    <input type="text" name="email" placeholder="Enter Your userName Or email" class="w-full p-2 bg-gray-200 rounded-md">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Password :</label>
                    <input type="Password" name="password" placeholder="Enter Your userName Or email" class="w-full p-2 bg-gray-200 rounded-md">
                </div>
                <div class="flex flex-col gap-2">
                <input type="submit" name="submit" value="Login Now" class="w-full p-2 bg-[#70E000] rounded-md">
                <p>Don't have an account?<a href="Register.php" class="text-[#70E000]"> Sign Up</a></p>
                </div>
            </form>
        </div>
        
        <img src="../imgs/heroBanner.png" alt="" class="hero-banner w-1/2 h-screen hidden lg:block ">
    </main>
    
</body>
</html>