<?php
require_once 'config.php';

// getting name

// Define $user outside of the if statement
$user = null;

// Check if the user is logged in
if (isset($_COOKIE['token'])) {
    // Retrieve the user data from the database using the token
    $stmt = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $stmt->execute([$_COOKIE['token']]);
    $user = $stmt->fetch();
}


// Retrieve user's existing information from the database
$user_id = 1; // Example user ID, replace with actual user ID
$stmt = $pdo->prepare('SELECT * FROM Users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve submitted form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Validate submitted data
    $errors = [];
    if (empty($first_name)) {
        $errors['first_name'] = 'Please enter your first name';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Please enter your last name';
    }
    if (empty($email)) {
        $errors['email'] = 'Please enter your email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email';
    }

    // If no errors, update user's information in the database
    if (empty($errors)) {
        $stmt = $pdo->prepare('UPDATE Users SET first_name = ?, last_name = ?, email = ? WHERE id = ?');
        $stmt->execute([$first_name, $last_name, $email, $user_id]);

        // Redirect to the updated user's profile page
        header('Location: profile.php');
        exit();
    }
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



        <div class="profilecontainer">
            <div class="profileleft">
                <img class="profilepicture" src="./imgs/profile.png" alt="">


                <div class="profilecontent">
                    <h2 class="username">
                        <?php $name = $user['first_name'] . ' ' . $user['last_name'];
                        $words = explode(' ', $name);
                        $first_two_words = implode(' ', array_slice($words, 0, 2));
                        echo $first_two_words;
                        ?>!

                    </h2>

                    <?php if ($user['verified'] == 1): ?>
                        <img class="verified" src="./imgs/Check.svg" alt="">
                    <?php endif; ?>


                </div>
            </div>


            <div class="profileright">
                <div class="profileheading">
                    <h2>Edit Your Profile</h2>
                    <hr class="thinhr">
                </div>
                <div class="profileinfo">
                    <form class="profileinfoform" action="" method="POST">
                        <input style="width:63% !important;" class="inputfield" type="text" name="first_name" required
                            placeholder="Please enter your first name"
                            value="<?php echo htmlspecialchars($user['first_name']); ?>"><br>
                        <?php if (isset($errors['first_name']))
                            echo '<span class="error">' . $errors['first_name'] . '</span>'; ?>

                        <input style="width:63% !important;" class="inputfield" type="text" name="last_name" required
                            placeholder="Please enter your last name"
                            value="<?php echo htmlspecialchars($user['last_name']); ?>"><br>
                        <?php if (isset($errors['last_name']))
                            echo '<span class="error">' . $errors['last_name'] . '</span>'; ?><br>

                        <input style="width:63%;" class="inputfield" type="email" name="email" required
                            placeholder="Please enter your email"
                            value="<?php echo htmlspecialchars($user['email']); ?>">
                        <?php if (isset($errors['email']))
                            echo '<span class="error">' . $errors['email'] . '</span>'; ?><br>

                        <button class="submitbtn" type="submit">Update Profile</button>
                    </form>






                </div>

            </div>

        </div>
        </div>

</body>

</html>