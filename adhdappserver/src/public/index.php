<?php
    session_start();
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    switch($uri) {
        //I'm conflicted here. On one hand, it makes sense to have the page creation be done inside each file, but on the other hand I would like to minimize code reuse.
        //The limiting factor here is that we can't output any HTML until after we've ensured we don't need to do any redirects.
        case '/dashboard': //Should act identically to the root page
        case '/':
            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                header('Location: /about');     //Redirect new users to the landing page
            }
            include('../control/dashboard.php');
            break;

        case '/about':
            include('../control/about.php');
            break;

        case '/login':
            include('../control/login.php');
            break;
        
        case '/signup':
            include('../control/signup.php');
            break;

        default:
            http_response_code(404);
            break;
    }
?>