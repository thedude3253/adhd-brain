<?php
    //Initial PHP block to detect and handle things that might need to take place before sending page body.
    //First check to see if the user is already logged in. If so, they should be viewing the profile page instead.
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        header('Location: /profile');
    }
    //Next, handle login forms.
    $method = $_SERVER['REQUEST_METHOD'];
    if($method === 'POST') {
        include_once('../control/apicomms.php');
        //Validate the form locally
        if(empty($_POST['username']) || empty($_POST['password'])) {
            //Post is invalid, abort
            header('Location: /login?error=400');
        }
        //Send the form to the api
        $api_response = send_api_request('/auth','GET',$_POST);
        //Check the response
        //If there was an error with the api, we consider it a server error
        if(isset($api_response['error'])) {
            header('Location: /login?error=500');
            exit();
        }
        $response_code = $api_response['status'];
        switch($response_code) {
            case '401':
                //API rejected the username/password combo
                header('Location: /login?error=401');
                exit();
            case '200':
                //API accepted the username/password combo
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $_POST['username'];
                header('Location: /');
                exit();
        }
        //We shouldn't be here. Panic!
        http_response_code(500);
        echo("You've discovered a bug, congrats! Please screenshot this page and contact the dev.");
        var_dump($_POST);
        var_dump($_SESSION);
        var_dump($api_response);
        exit();
    }
    //If we're still here, its because we actually want to render the page.
    http_response_code(200);
    $page_name = "Log In";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log In</title>
        <?php include('../template/head_include.html'); ?>
    </head>
    <body class="darkmode">
        <?php include('navbar.php'); ?>
        <br>
        <main>
            <form action="/login" method="POST" style="grid-column: 2;">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required autofocus autocomplete="username" style="min-width: 16ch;">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" style="min-width: 16ch;">
                </div>
                <div><button type="submit">Log In</button></div>
            </form>
        </main>
    </body>
</html>