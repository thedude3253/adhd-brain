<?php
    require_once('../control/apicomms.php');
    $method = $_SERVER['REQUEST_METHOD'];
    switch($method) {
        case 'GET':
            http_response_code(200);
            include('../template/signupform.html');
            break;
        
        case 'POST':
            //validate user input
            //First we check to see if the user's input even makes sense, if not we don't even have to pass it to the api.
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            if(empty($username) || empty($password) || empty($confirmpassword)) {
                http_response_code(400);
                echo "Username and password cannot be empty.";
                include('../template/signupform.html');
                exit();
            }
            if($password !== $confirmpassword) {
                http_response_code(400);
                echo "Passwords do not match.";
                include('../template/signupform.html');
                exit();
            }
            $apiresponse = send_api_request('/user', 'POST', [
                'username' => $username,
                'password' => $password
            ]);
            if(isset($apiresponse['error'])) {
                http_response_code(500);
                echo "Error communicating with API: " . $apiresponse['error'];
                exit();
            }
            switch($apiresponse['status']) {
                case 201:
                    //Account created successfully, redirect to login page
                    header('Location: /login');
                    exit();
                    break;
                case 409:
                    http_response_code(409);
                    echo "Username already exists.";
                    include('../template/signupform.html');
                    break;
                default:
                    http_response_code(500);
                    echo "There was an error processing your request: ";
                    var_dump($apiresponse);
                    include('../template/signupform.html');
                    break;
            }
            break;

        default:
            //We don't know what to do with other types of request on this page
            http_response_code(501);
            break;
    }
?>