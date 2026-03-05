<?php
    session_start();
    echo "Welcome, " . $_SESSION['profile'] . "!";
    echo "This page is still under construction, but if you are seeing this message then it means you have successfully logged in! Congrats! :)";
?>