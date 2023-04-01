<?php
// Database configuration
$host = 'localhost';
$dbname = 'PROMPTGPT';
$username = 'root';
$password = '';

// PDO database connection
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
