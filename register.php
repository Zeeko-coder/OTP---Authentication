<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Account Registration</h2>
    <form action="process_register.php" method="post">
        <label for="">Username: </label><br>
        <input type="text" name="username" required><br><br>

         <label for="">Email: </label><br>
        <input type="email" name="email" required><br><br>

        <label for="">Password: </label><br>
        <input type="password" name="password" required><br><br>

        <label for="">Confirm Password: </label><br>
        <input type="password" name="confirmPassword" required><br><br>

        <button type="submit">Register</button>
    </form>

    <h3>Already have an account? <a href="login.php">Login here</a></h3>
</body>
</html>