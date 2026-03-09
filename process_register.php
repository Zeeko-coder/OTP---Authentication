<?php

$jsonData = file_get_contents('users.json');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $newUser = $_POST['username'];
    $newPassword = $_POST['password'];
    $newEmail = $_POST['email'];
    $confirmPassword = $_POST['confirmPassword'];

    if (strlen($newPassword) < 8 ||
        !preg_match("/[A-Z]/", $newPassword) ||
        !preg_match("/[a-z]/" , $newPassword) ||
        !preg_match("/[0-9]/" , $newPassword) ||
        !preg_match("/[\W]/" , $newPassword)
    ){
        die("Password must be atleast 8 characters long and include uppercase, lowercase, numbers, and special characters!");
    }

    if ($newPassword !== $confirmPassword) {
        die("Password do not match!");
    }

    foreach($data['users'] as $user) {
        if($user['username'] === $newUser){
            die("Username already exists!");
        }
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $data['users'][] = [
        "username" => $newUser,
        "email" => $newEmail,
        "password" => $hashedPassword
    ];

    file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));

    echo "Registered successfully!";
}

?>
<br>
<a href='login.php'>Login here</a>
