<?php
$host = 'localhost';  // MySQL host
$dbname = 'secureconnect'; // Database name
$username = 'root'; // MySQL username
$password = ''; // MySQL password (change it)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
