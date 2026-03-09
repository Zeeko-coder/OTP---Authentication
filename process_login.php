<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

$jsonData = file_get_contents('users.json');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $InputUser = $_POST['username'];
    $InputPassword = $_POST['password'];
    
    $isValid = false;

    foreach($data['users'] as &$user){
        if($user['username'] === $InputUser && password_verify($InputPassword, $user['password'])){
            
            //Generate OTP
            $otp = rand(100000, 999999);
            $user['otp'] = $otp;
            $user['otp_expiry'] = time() + 300; // OTP valid for 5 minutes
            
            // Set session BEFORE redirect so it's available in otp_verification_process.php
            $_SESSION['username'] = $InputUser;

            // Save the entire data array with updated user
            file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));

            //Send email using phpmailer
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.example.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'myelnicholaiquimbo@gmail.com';
                $mail->Password = 'kkei gehp opls tikw';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('myelnicholaiquimbo@gmail.com', 'Myel');
                $mail->addAddress($user['email']);

                $mail->Subject = 'Your OTP Code';
                $mail->Body = "Your OTP code is: " . $otp;

                $mail->send();
            } catch (Exception $e) {
                // For testing: display OTP if email fails
                echo "Email could not be sent. Your OTP is: " . $otp . "<br>";
                echo "<a href='otp_verification.php'>Continue to OTP Verification</a>";
                exit();
            }

            header("Location: otp_verification.php");
            exit();
            
            $isValid = true;
            break;
    }
    }
    if ($isValid){
        header("Location: dashboard.php");

    } else {
        echo "Invalid username or password";
    }
    
}
?>