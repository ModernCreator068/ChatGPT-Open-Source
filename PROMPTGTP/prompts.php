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
                <button class="ctabtn" href="#">Prompts</button>
            </div>
        </div>
    </header>

    <main>
        <div class="promptscontainer">
            <?php foreach ($commands as $command) { ?>
                <div class="promptbox">
                    <div class="title">
                        <?php echo $command['title']; ?>
                    </div>
                    <div class="prompttext">
                        <p>
                            <?php
                            $words = explode(" ", $command['prompt']);
                            if (count($words) > 30) {
                                $words = array_slice($words, 0, 50);
                                echo implode(" ", $words) . " ...";
                            } else {
                                echo $command['prompt'];
                            }
                            ?>
                        </p>
                    </div>
                    <div class="bottomicons">
                        <div class="copybtn">
                            <button class="promptcopy"> Copy Prompt</button>
                            
                            <span style="margin:0rem 1rem;">
                                <div class="writer">
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




    <footer>
        <div class="footercontainer">
            <p>Copyright 2023 | All rights reserved</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>