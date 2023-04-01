<?php
require_once('config.php');
require_once('functions.php');

// Check if the user is already logged in
if (isset($_COOKIE['token'])) {
  // Redirect the user to prompts.php
  header('Location: prompts.php');
  exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the email and password from the form submission
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare and execute a SQL statement to retrieve the user with the specified email
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Check if a user was found with the specified email
  if ($user) {
    // Verify that the password matches the stored hash
    if (verifyPassword($password, $user['password'])) {
      // Password is correct, create a cookie and redirect to prompts.php
      $token = bin2hex(random_bytes(16));
      setcookie('token', $token, time() + 86400, '/');
      $stmt = $pdo->prepare('UPDATE users SET token = ? WHERE id = ?');
      $stmt->execute([$token, $user['id']]);
      header('Location: prompts.php');
      exit();
    } else {
      // Password is incorrect, show error message
      $error = 'Invalid password.';
    }
  } else {
    // User with specified email not found, show error message
    $error = 'No user found with that email.';
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
      <h2>Login Here</h2>
      <?php if (isset($error)): ?>
        <p style="color: red"><?php echo $error; ?></p>
      <?php endif; ?>
      <div class="loginform">
        <form method="post">
          <input class="inputfield" type="email" required name="email" placeholder="Please enter your email">
          <input class="inputfield" type="password" required name="password" placeholder="Please enter your password">
          <button class="submitbtn" type="submit">Login Now</button>
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