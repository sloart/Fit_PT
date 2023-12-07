<!-- begin footer -->
<div id="footer" style="position: fixed; bottom: 0; width: 100%;">

    <?php
    if (!isset($_SESSION['user'])) {
        // User is not logged in, display the "Login" link
        // echo '<a style="padding-inline: 3vh;" href="initial_login_page.php">Login</a>';
    }
    ?>
</div>
</body>
</html>
