<nav>
    <div>LOGO</div>
    <div>
        <h1><?php echo($page_name); ?></h1>
    </div>
    <div>
        <ul>
            <?php    
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                    //Show profile picture (which acts as a link to /profile)
                    //Display personalized message and provide relevant links
                    $username = $_SESSION['username'];
                    echo("<li style=\"margin-bottom: 0.5em;\">Welcome, {$username}!</li>");
                    echo('<li><a href="/logout">Sign Out</a></li>');
                }
                else {
                    //Provide relevant links
                    echo('<li style="margin-bottom: 0.5em;"><a href="/login">Log In</a></li>');
                    echo('<li><a href="/signup">Sign Up</a></li>');
                }
            ?>
        </ul>
    </div>
</nav>