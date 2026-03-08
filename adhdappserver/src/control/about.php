<?php
    //I don't think the about page will need any pre-page logic but I'm putting this block here for consistency.
    http_response_code(200);
    $page_name = "About the Project";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../template/head_include.php') ?>
    </head>
    <body class="darkmode">
        <?php include('../template/navbar.php') ?>
        <br>
        <main>
            <article style="grid-area: 1/2;">
                <h1>Welcome to the ADHD-Brain Project!</h1>
                <p>
                    This project serves two purposes. First it acts as a local repository to store projects, their information, and related notes and tasks. 
                    Secondly it acts as a demonstration of my current skills to put on my portfolio.
                    <br>
                    Sound interesting? Sign Up or Log In to get started!
                </p>
            </article>
        </main>
    </body>
</html>