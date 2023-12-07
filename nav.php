<div id="nav">
    <a style="padding-inline: 3vh;" href="index.php">Home</a>

    <?php
    session_start(); // Start the session (make sure this is at the top of your page)

    if (isset($_SESSION['user'])) {
        // User is logged in, display the currently logged-in user and "Logout" link
         $loggedInUser = $_SESSION['user']['email']; // Access the email field from the array
        echo '<div class="user-indicator" style="float: right;">Logged in as: ' . $loggedInUser . ' | <a href="logout.php">Logout</a></div>';
        echo '<a style="padding-inline: 3vh; float: right;" href="view_appointments.php">Calendar</a>';
    } else {
        // User is logged out, display "Create Account" and "Login" links
        // echo '<a style="padding-inline: 3vh; float: right;" href="account_CreationHandler.php">Create Account</a>';
        echo '<a style="padding-inline: 3vh; float: right;" href="initial_login_page.php">Login</a>';
        // echo '<a style="padding-inline: 3vh; float: right;" href="view_appointments.php">Calendar</a>';
    }
    ?>
</div>