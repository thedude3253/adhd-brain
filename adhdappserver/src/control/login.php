<!--Common Header File and other layout stuff handled by Index.php-->
<!--Login Form-->
<!--Should check if this is a post request, which would mean that they already submitted their login.
If so, then before serving the page we need to validate their input by sending their form to the api, start a session, and then redirect them to the dashboard-->
<?php
    require_once('../control/apicomms.php');
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
            $apiresponse = send_api_request('/auth', 'POST', [
                'username' => $username,
                'password' => $password
            ]);
            //respond accordingly
            if(isset($apiresponse['error'])) {
                http_response_code(500);
                echo "Error communicating with API: " . $apiresponse['error'];
                exit();
            }
            switch($apiresponse['status']) {
                case 200:
                    //Login successful, start session and redirect to dashboard
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['profile'] = $username;
                    header('Location: /dashboard');
                    exit();
                    break;
                case 401:
                    http_response_code(401);
                    echo "Invalid username or password.";
                    include('../template/loginform.html');
                    break;
                default:
                    http_response_code(500);
                    echo "There was an error processing your request: ";
                    var_dump($apiresponse);
                    include('../template/loginform.html');
                    break;
            }
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
