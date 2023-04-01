<?php
// Start session
session_start();


// Check if the user is already logged in
if (isset($_COOKIE['token'])) {
    // Redirect the user to prompts.php
    header('Location: prompts.php');
    exit();
  }

  
// Include necessary files
require_once 'config.php';
require_once 'functions.php';

// Initialize variables
$email = '';
$password = '';
$confirm_password = '';
$errors = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Check if email already exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        $errors['email'] = 'Email already exists';
    }

    // Validate password
    if (empty($password)) {
        $errors['password'] = 'Please enter a password';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long';
    }

    // Validate confirm password
    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'Please confirm your password';
    } elseif ($password != $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    // If no errors, register user
    if (empty($errors)) {
        $hashed_password = hashPassword($password);
        $role = 'normal';
        $subscription = 'free';

        $stmt = $pdo->prepare('INSERT INTO users (email, password, role, subscription) VALUES (?, ?, ?, ?)');
        $stmt->execute([$email, $hashed_password, $role, $subscription]);

        // Redirect to login page
        header('Location: login.php');
        exit;
    }
}
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROMPTGPT - ChatGPT Jailbreak and Prompts</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-r5kyk0bM1yXRSJx51x2QmIbcDxd0ZJzQlKbN/1znnOEdI/VRnpX9xNLFpJazdxtNqO3lK5ZViG5ZO5zIJfYAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header>
        <div class="headercontainer">
            <div class="logocontainer">
                <h2>PromptGPT</h2>
            </div>
            <div class="menucontainer">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about.html">About</a></li>
                    <li><a href="/prompts.html">Prompts</a></li>
                    <li><a href="/login.html">Login</a></li>
                </ul>
            </div>
            <div class="ctacontainer">
                <button class="ctabtn" href="prompts.html">Prompts</button>
            </div>
        </div>
    </header>

    <main>
        <section class="logincontainer">
            <div class="loginbox">
                <h2>Register Here</h2>
                <p>You must be register an account to log in</p>
                <div class="loginform">
                    <form action="" method="POST">
                        <input class="inputfield" type="email" name="email" required
                            placeholder="Please enter your email" value="<?php echo htmlspecialchars($email); ?>">
                        <?php if (isset($errors['email']))
                            echo '<span class="error">' . $errors['email'] . '</span>'; ?>
                        <input class="inputfield" type="password" name="password" required
                            placeholder="Please enter your password">
                        <?php if (isset($errors['password']))
                            echo '<span class="error">' . $errors['password'] . '</span>'; ?>
                        <input class="inputfield" type="password" name="confirm_password" required
                            placeholder="Please re-enter your password">
                        <?php if (isset($errors['confirm_password']))
                            echo '<span class="error">' . $errors['confirm_password'] . '</span>'; ?>
                        <button class="submitbtn" type="submit">Register Account</button>
                    </form>
                </div>
            </div>
        </section>

    </main>



    <footer>
        <div class="footercontainer">
            <p>Copyright 2023 | All rights reserved Developed by <a href="#">Team Modernlisim</a></p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>