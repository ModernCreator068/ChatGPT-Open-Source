<?php
require_once('config.php');
require_once('functions.php');

// Define $user outside of the if statement
$user = null;

// Check if the user is logged in
if (isset($_COOKIE['token'])) {
  // Retrieve the user data from the database using the token
  $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
  $stmt->execute([$_COOKIE['token']]);
  $user = $stmt->fetch();
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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


    <div class="headercontainer"> 
    <p>Welcome, <?php echo $user['first_name']; ?>! 
    <?php if ($user['verified'] == 1): ?>
      <img class="verified" src="./imgs/check.svg" alt="">
    <?php else: ?>
      <img class="free" src="./imgs/FREE.svg" alt="">
    <?php endif; ?>

    <!-- <?php if ($user['verified'] == 1): ?>
    <img class="verified" src="./imgs/Check.svg" alt="">
<?php endif; ?> -->


  </p>  
    </div>
    
</body>
</html>
