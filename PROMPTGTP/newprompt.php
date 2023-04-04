<?php
require_once 'config.php';
// Check if the user is logged in
if (!isset($_COOKIE['token'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $title = $_POST['title'];
    $prompt = $_POST['prompt'];
    $writer = 'PromptGPT';
    
    // Prepare and execute SQL statement
    $stmt = $pdo->prepare("INSERT INTO commands (title, prompt, writer) VALUES (:title, :prompt, :writer)");
    $stmt->execute(['title' => $title, 'prompt' => $prompt, 'writer' => $writer]);
    
    // Redirect to home page
    header('Location: prompts.php');
    exit();
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
    <?php
if (isset($_COOKIE['token'])) {
    include('loggedinheader.php');
} else {
    include('header.html');
}
?>

    </header>

    <main>
    <section class="logincontainer">
    <div class="loginbox">
      <h2>Make New Prompt Online</h2>
      <?php if (isset($error)): ?>
        <p style="color: red"><?php echo $error; ?></p>
      <?php endif; ?>
      <div class="loginform">
        <form method="post">
          <input class="inputfield" type="text" name="title" required placeholder="Please enter prompt title*">
          <textarea class="textareaa" type="textarea" required name="prompt" placeholder="Please enter your prompt*"></textarea>
          <input class="inputfield" type="text" name="writer" id="writer" value="PromptGPT" disabled>
          <button class="submitbtn" type="submit">Add New Submission</button>
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