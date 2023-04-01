<?php
require_once 'config.php';

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
<html>
<head>
    <meta charset="UTF-8">
    <title>New Command</title>
</head>
<body>
    <h1>New Command</h1>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br><br>
        <label for="prompt">Prompt:</label>
        <textarea name="prompt" required></textarea><br><br>
        <label for="writer">Writer:</label>
        <input type="text" name="writer" value="CODERRR" disabled><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>



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
          <input class="inputfield" type="text" name="title" required placeholder="Please enter title">
          <textarea class="textareaa" type="textarea" required name="prompt" placeholder="Please enter your prompt"></textarea>
          <input class="inputfield" type="text" name="writer" id="writer" value="PromptGPT" disabled required>
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