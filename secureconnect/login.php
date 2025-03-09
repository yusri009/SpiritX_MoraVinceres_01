<?php
session_start();
include('includes/db_connect.php');

$usernameError = $passwordError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    $valid = true;

    if (empty($username)) {
        $usernameError = "Username is required!";
        $valid = false;
    }

    if (empty($password)) {
        $passwordError = "Password is required!";
        $valid = false;
    }

    if ($valid) {
        // Check if username exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() == 0) {
            $usernameError = "Username does not exist!";
        } else {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header("Location: hello.php");
                exit();
            } else {
                $passwordError = "Incorrect password!";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($username) ? $username : ''; ?>">
            <div id="usernameError" class="error"><?php echo isset($usernameError) ? $usernameError : ''; ?></div>

            <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>">
            <div id="passwordError" class="error"><?php echo isset($passwordError) ? $passwordError : ''; ?></div>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
    <script src="assets/js/app.js"></script>
</body>
</html>
