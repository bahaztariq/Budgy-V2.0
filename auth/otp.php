<?php
require '../db/db_connect.php';
require '../sendemail.php';


if (!isset($_SESSION['Temp_user_id'])) {   
      header("Location: login.php");    
      exit;
}


$userid = $_SESSION['Temp_user_id'];

 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stmt = $connect->prepare("SELECT otpCode,expiresAt,email from OTP where UserID='$userid' ");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($otpCode,$expires_at,$email);
        $stmt->fetch();


if(isset($_POST["verifyBtn"])){
    $otp = $_POST["otpInput"];
    if(date("Y-m-d H:i:s") < $expires_at){
        if($otp === $otpCode){
                $_SESSION['user_id'] = $userid;
                header("Location:../pages/Dashboard.php");
            }else{
                echo "<script> alert('OTP IS WRONG TRY AGAIN') </script>";
            }
    }else{
        echo "<script> alert('OTP EXPIRED TRY AGAIN') </script>";
    }
        
}


if(isset($_POST["resendBtn"])){
            generateOTP($connect,$email);
            // $otp = rand(100000,999999);
            // $expires_at = date("Y-m-d H:i:s", strtotime("+1 minutes"));

            // $otp_stmt = $connect->prepare("INSERT INTO otp (otpCode, user_id,expires_at) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE otpCode = VALUES(otpCode), expires_at = VALUES(expires_at) ");
            // $otp_stmt->bind_param('iis',$otp,$user_id,$expires_at);
            // $otp_stmt->execute();

            
            // $_SESSION['Temp_user_id'] = $user_id;
            header("Location: otp.php");
    }

    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP - Verification</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/css/all/all.min.css">
    <link rel="icon" href="./imgs/icon.png">

</head>
<body>
    <div class=" w-full h-screen flex justify-center items-center">
        <div class="flex flex-col justify-center items-center shadow-md p-4 rounded-xl gap-4">
            <div class="form-header text-center flex flex-col gap-2">
                <h2 class="text-3xl font-bold">OTP Verification</h2>
                <p>Enter the 6-digit code sent to your email</p>
            </div>

           

            <form id="otpForm" method="POST" class="w-full flex flex-col gap-4">
                <div class="w-full">
                    <input  type="text" name="otpInput" class="w-full text-2xl rounded-xl p-4 bg-gray-100 text-center tracking-[12px]" maxlength="6" inputmode="numeric" pattern="[0-9]*" placeholder="XXXXXX">
                </div>

                
           
 

                <button type="submit" class="bg-[#70E000] cursor-pointer w-full p-2 rounded-xl" name="verifyBtn" >Verify OTP</button>

                <div class="w-full flex flex-col gap-2">
                    Didn't receive the code? 
                    <button type="submit" class="bg-black text-white cursor-pointer w-full p-2 rounded-xl" name="resendBtn">Resend OTP</button>
                </div>

                <div class="back-link">
                    <a href="login.php" class="flex  items-center gap-2 text-gray-500">
                      <i class="fi fi-ts-angle-left flex justify-center items-center"></i>
                      <span>Back To login </span>
                    </a>
                </div>
            </form>
        </div>
    </div>

  
</body>
</html>