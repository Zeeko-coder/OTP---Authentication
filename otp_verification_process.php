<?php
session_start();

// Check if OTP was submitted
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['otp'])) {
    $submittedOTP = $_POST['otp'];
    
    // Get the username from session (set during login)
    if (!isset($_SESSION['username'])) {
        echo "Session expired. Please login again.";
        exit();
    }
    
    $username = $_SESSION['username'];
    
    // Read users.json to get stored OTP
    $jsonData = file_get_contents('users.json');
    $data = json_decode($jsonData, true);
    
    $otpValid = false;
    
    foreach ($data['users'] as &$user) {
        if ($user['username'] === $username) {
            // Check if OTP matches and hasn't expired
            if (isset($user['otp']) && isset($user['otp_expiry'])) {
                if ($user['otp'] == $submittedOTP && time() < $user['otp_expiry']) {
                    $otpValid = true;
                    
                    // Clear OTP after successful verification (optional security measure)
                    $user['otp'] = null;
                    $user['otp_expiry'] = null;
                    
                    // Save the updated data
                    file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));
                    
                    // Set session for logged-in user
                    $_SESSION['logged_in'] = true;
                    
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Invalid or expired OTP.";
                }
            } else {
                echo "No OTP found. Please login again.";
            }
            break;
        }
    }
    
    if (!$otpValid) {
        echo "OTP verification failed. <a href='otp_verification.php'>Try again</a>";
    }
} else {
    echo "Invalid request.";
}
?>

