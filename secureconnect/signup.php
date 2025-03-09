<?php
session_start();
include('includes/db_connect.php');

$usernameError = $passwordError = $confirmPasswordError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validate inputs
    $valid = true;

    // if (empty($username)) {
    //     $usernameError = "Username is required!";
    //     $valid = false;
    // }

    if (empty($password)) {
        $passwordError = "Password is required!";
        $valid = false;
    }

    if ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match!";
        $valid = false;
    }

    if ($valid) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if username exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $usernameError = "Username already taken!";
            $valid = false;
        } else {
            // Insert user into database
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashedPassword])) {
                $_SESSION['username'] = $username;
                header("Location: login.php");
                exit();
            } else {
                $error = "Something went wrong!";
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
    <title>Signup</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
        <form method="POST" action="">
            <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($username) ? $username : ''; ?>">
            <div id="usernameError" class="error"><?php echo isset($usernameError) ? $usernameError : ''; ?></div>

            <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>">
            <div id="passwordError" class="error"><?php echo isset($passwordError) ? $passwordError : ''; ?></div>

            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo isset($confirmPassword) ? $confirmPassword : ''; ?>">
            <div id="confirmPasswordError" class="error"><?php echo isset($confirmPasswordError) ? $confirmPasswordError : ''; ?></div>

            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html>
