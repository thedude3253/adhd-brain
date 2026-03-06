<div>
    <div style="display:list-item">
        <?php
            if($_SESSION['loggedin'] === true) {
                echo 'Welcome, ' . $_SESSION['username'] . '!';
                echo '<a href="/logout">Log Out</a>';
            }
            else {
                echo '<a href="/login">Log In</a>';
                echo '<a href="/signup">Sign Up</a>';
            }
        ?>
    </div>
</div>