<?php
    //session_start(); Unneeded because we start the session in index.php before including this file, and we only include this file if the user is logged in.
    echo "Welcome, " . $_SESSION['profile'] . "!\n";
    echo "This page is still under construction, but if you are seeing this message then it means you have successfully logged in! Congrats! :)";
?>