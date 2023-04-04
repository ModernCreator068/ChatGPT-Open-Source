<?php
include('config.php');
include('functions.php');
$count = countRecords($host, $dbname, $username, $password, 'commands');



// Get the current page number from URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Set the number of records to display per page
$records_per_page = 10;

// PDO database connection
global $pdo;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the commands data from the database
$commands = getCommands($host, $dbname, $username, $password, $page, $records_per_page);

// Calculate the total number of records in the commands table
$total_records = countRecords($host, $dbname, $username, $password, 'commands');


// Create the pagination links
global $pagination;

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
    <div id="typing-text"></div>
    <main>
        <div class="promptscontainer">
            <?php foreach ($commands as $command) { ?>
                <div class="promptbox">
                    <div class="title">
                        <?php echo $command['title']; ?>
                    </div>
                    <div class="prompttext">
                        <p >
                            <?php
                            echo $command['prompt'];

                            ?>
                        </p>
                        
                    </div>
                    <!-- <button class="expand-btn">Expand</button> -->
                    <div class="bottomicons">
                        <div class="copybtn">
                        <img class="promptcopy" src="./imgs/copy.svg">
                        <!-- <button class="promptcopy ctabtn">Copy Prompt</button> -->

                            <span style="margin:0rem 1rem;">
                                <div class="writer" id="typing-text">
                                    <?php echo $command['writer']; ?>
                                </div>
                            </span>
                        </div>

                    </div>


                </div>
            <?php } ?>
        </div>


        <div class="pagination">
            <?php echo $pagination; ?>
        </div>

    </main>


    <script>
  
    </script>



    <footer>
        <div class="footercontainer">
            <p>Copyright 2023 | All rights reserved</p>
        </div>
    </footer>
    <script src="promptjs.js"></script>


</body>

</html>