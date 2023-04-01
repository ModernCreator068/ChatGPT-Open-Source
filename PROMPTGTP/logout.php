<?php
// Start a session
session_start();

// Clear the token cookie
setcookie('token', '', time() - 3600, '/');

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: login.php');
exit();
?>
