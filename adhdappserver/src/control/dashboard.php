<?php
    /*
        NOTE: So far in this file I am using the username instead of a session uuid (as prescribed by the api doc) for the api calls.
        This is because so far all of the session handling has been done by PHP, since its pre-existing and fairly robust.
        Time will tell whether I need to update this page, or update the API documentation.
        The determiner will be whether or not I have issues with the PHP session expiring during project operations.
        We can't save the user's data if we don't know who the user is, and it would be wrong to tell a user they lost their changes because they spent too long thinking.
    */
    
    //Dashboard will handle both the projects view and the project view. /dashboard/[project_id] will show that project's page
    //Task view will use javascript for interactive elements, and a save button for sending a snapshot of the current state to the server for storage.
    //First we need to parse the url for a potential project ID, and if it's invalid then we redirect to the projects view
    include_once('apicomms.php');
    $parsed_uri = explode('/',substr($uri,1));  //Takes off the leading slash and then separates what's left based on that
    switch(count($parsed_uri)) {
        case 1:
            // "/dashboard" just show project view
            $api_response = send_api_request('/projects', 'GET', [$_SESSION['user']]);
            break;
        case 2:
            // "/dashboard/projectid"
            //validate and fetch info on projectid
            $project_id = $parsed_uri[1];
            $api_response = send_api_request('/project', 'GET', [$_SESSION['user'],$project_id]);
            if(isset($api_response['error'])) {
                //Issue with api comms. 500.
            }
            switch($api_response['status']) {
                case 200:
                    //Don't need to do anything.
                    break;
                case 403:
                    //User does not have the required permissions to access this project.
                    //Not sure yet whether to redirect to the dashboard or inform the user that they can't access it
                    //If I decide to redirect, then the logic should be flipped in this block. Check for 200 status, and for anything else redirect
                    break;
                case 404:
                    //Project ID is invalid.
                    header('Location: /dashboard');
                    exit();
                default:
                    //We shouldn't end up here. Panic!
                    http_response_code(500);
                    echo("You've discovered a bug. Congrats! Please screenshot this page and send it to the dev.");
                    var_dump($parsed_uri);
                    var_dump($_SESSION);
                    var_dump($api_response);
                    exit();
            }
            break;
        default:
            //Anything else
            http_response_code(404);
            exit();
    }
    //The dashboard will eventually need to handle POST requests for saving state so that will go here

    //If we're still here we want to render a page.
    http_response_code(200);
    $page_name = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../template/head_include.php') ?>
    </head>
    <body>
        <?php include('../template/navbar.php') ?>
        <main>
            <?php
                //We need to decide if we're looking at the projects overview or the project viewer
                if(isset($project_id)) {
                    //If we're looking at a project, we need to set up the workspace (might relegate this to a different file for cleanliness)
                }
                else {
                    //If we're looking at the overview, we need to create a list of projects the user can view and click on.
                    $projects = json_decode($api_response['response']);
                    foreach($projects as $project) {
                        include('../template/project_block.php');
                    }
                }
            ?>
        </main>
    </body>
</html>