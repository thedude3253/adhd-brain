<!--Common Header File and other layout stuff handled by Index.php-->
<!--Login Form-->
<!--Should check if this is a post request, which would mean that they already submitted their login.
If so, then before serving the page we need to validate their input by sending their form to the api, start a session, and then redirect them to the dashboard-->
<?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST') {
        //Validate
        //if valid, start session and redirect
        //else, inform the client
    }
?>
<form action="/login" method="POST" style="display: flex; flex-direction: column; gap: 1rem; max-width: 300px;">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required autofocus autocomplete="username">

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required autocomplete="current-password">

    <button type="submit">Log in</button>
</form>