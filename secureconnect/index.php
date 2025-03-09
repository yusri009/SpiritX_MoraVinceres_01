<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: hello.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>SpiritXPro1</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to SecureConnect</h2>
        <p>Secure authentication for your project! Choose an action below:</p>
        
        <div class="actions">
            <a href="signup.php" class="btn">Sign Up</a>
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>
</body>
</html>
