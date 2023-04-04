<?php
// Check if requested file exists
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
    // File not found, redirect to 404 page
    header('HTTP/1.0 404 Not Found');
    include('404.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-r5kyk0bM1yXRSJx51x2QmIbcDxd0ZJzQlKbN/1znnOEdI/VRnpX9xNLFpJazdxtNqO3lK5ZViG5ZO5zIJfYAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <div class="herocontainer">
            <p class="bluetext">Unleash your chatbot's creativity with our AI-powered prompts.</p>
            <h2 class="heading">What if you could ask <br>
                anything?</h2>
                <a href="prompts.php"><button class="mainbtn">Explore PromptGPT</button></a>
                <img class="wave-animation" src="./imgs/waves.png" alt="" srcset="">
                
                <div class="typing"><span id="typing-text"></span>
                    <!-- <p>Lorem ipsum dolor sit amet.</p> -->
                </div>
            </div>



        <section>
            <div class="infocontainer">
                <div class="leftcontainer">
                    <img src="./imgs/voicebox.png" alt="" srcset="">
                </div>
                <div class="rightcontainer">
                    <h2>No More “Sorry! I’m unable to <br>
                        do this”</h2>
                        <p>Lorem ipsum dolor sit amet consectetur. Nam dignissim pulvinar purus eu rhoncus arcu. Purus aliquam id id aliquam. Neque faucibus quis aliquet sed sed placerat ullamcorper malesuada. Pharetra dui purus mi eget ornare nisl. Scelerisque neque sagittis leo velit.</p>
                        <a href="prompts.php"><button class="mainbtn">Explore PromptGPT</button></a>

                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footercontainer">
            <p>Copyright 2023 | All rights reserved Developed by  <a href="https://www.modernlisim">Team Modernlisim</a></p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>