<?php
require_once('config.php');
require_once('functions.php');

// Define $user outside of the if statement
// $user = null;
$user = array();


// Check if the user is logged in
if (isset($_COOKIE['token'])) {
    // Retrieve the user data from the database using the token
    $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $stmt->execute([$_COOKIE['token']]);
    $user = $stmt->fetch();
}

?>

<header>
    <div class="headercontainer">
        <div class="logocontainer">
            <a href="./">
                <img src="./imgs/icon.png" style="width: 42px; border-radius: 6px;" alt="" class="icon">
            </a>
        </div>
        <div class="menucontainer">
            <ul>
                <li><a href="./">Home</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./prompts.php">Prompts</a></li>
                <li><a href="./submission.php">Submission</a></li>
                <?php if (isset($_COOKIE['token'])) { ?>
                    <li><a href="./profile.php">Profile</a></li>
                <?php } ?>
                <?php if (isset($_COOKIE['token'])) { ?>
                    <li><a href="./logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="ctacontainer">
        <?php if (isset($user['first_name'])) { ?>
        <p>Welcome, <?php echo $user['first_name']; ?>!
            
        </p>
        
    <?php } ?>
               
            
        </div>
    </div>
</header>