<?php
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    switch($uri) {
        case '/':
            http_response_code(200);
            echo "Hello world~!";
            break;

        case '/login':
            http_response_code(200);
            include('../template/login.php');
            break;

        default:
            http_response_code(404);
            break;
    }
?>