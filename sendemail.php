<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require __DIR__ . '/vendor/autoload.php';
$dotenv = DotenvVault\DotenvVault::createImmutable(__DIR__);
$dotenv->safeLoad();

function generateOTP($connect,$email){
  $userid =$_SESSION['Temp_user_id'];
  $otp = random_int(100000,999999);
  $date = new DateTime("+5 min");
  $expiredate = $date->format('Y-m-d H:i:s');
  $sql = $connect->prepare ("INSERT INTO OTP (UserID,otpCode,Email,expiresAt) values (?,?,?,?) ON DUPLICATE KEY UPDATE otpCode = VALUES(otpCode), expiresAt = VALUES(expiresAt)");
  $sql->bind_param("isss",$userid,$otp,$email,$expiredate);
  $sql->execute();
  sendEmail($otp,$email);
};

function sendEmail($otp,$email){
$mail = new PHPMailer(true);



try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $_ENV['smtp_host'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV['smtp_user'];                     //SMTP username
    $mail->Password   = $_ENV['smtp_pass'];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // ENCRYPTION_SMTPS=465 Enable implicit TLS encryption
    $mail->Port       = $_ENV['smtp_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('Bahaztariq@gmail.com', 'Budgy Dashboard');
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com','Name');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP Verification Code';
    $mail->Body    = 'Your Otp code is : '. $otp;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}