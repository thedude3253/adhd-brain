<!--Common Header File and other layout stuff handled by Index.php-->
<!--Login Form-->
<!--Should check if this is a post request, which would mean that they already submitted their login.
If so, then before serving the page we need to validate their input by sending their form to the api, start a session, and then redirect them to the dashboard-->
<?php
    $method = $_SERVER['REQUEST_METHOD'];
    switch($method) {
        case 'POST':
            //validate user input
            //First we check to see if the user's input even makes sense, if not we don't even have to pass it to the api.
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(empty($username) || empty($password)) {
                http_response_code(400);
                echo "Username and password cannot be empty.";
                include('../template/loginform.html');
                exit();
            }
            //respond accordingly
            break;
        case 'GET':
            http_response_code(200);
            include('../template/loginform.html');
            break;

        default:
            //We don't know what to do with other types of request on this page
            http_response_code(501);
            break;
    }
?>
