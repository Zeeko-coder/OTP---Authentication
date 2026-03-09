<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>
    <form action="process_login.php" method="post">
        <label for="">Username: </label><br>
        <input type="text" name="username" class="username-input" onkeydown="loginKeydown(event);" required><br><br>

        <label for="">Password: </label><br>
        <input type="password" name="password" class="password-input" onkeydown="loginKeydown(event);" required><br><br>

        <button type="submit" onclick="submitLogin();" class="loginBtn">Login</button>
    </form>
    <h3>Dont have an account? <a href="register.php">Register here</a></h3>
</body>
</html>