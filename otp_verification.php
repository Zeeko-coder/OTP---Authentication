<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>

<h2>Enter OTP Code</h2>

<form action="otp_verification_process.php" method="POST">

    <label>OTP Code:</label><br>
    <input type="text" name="otp" required maxlength="6"><br><br>

    <button type="submit" name="verify">Verify OTP</button>

</form>

</body>
</html>