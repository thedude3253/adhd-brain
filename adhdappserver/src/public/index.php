<?php
    session_start();
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //conflicted whether /about/somethingelse should get automatically shortened to /about or just 404
    switch($uri) {
        case (!!preg_match("/^\/dashboard/i",$uri)): //Should act identically to the root page
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