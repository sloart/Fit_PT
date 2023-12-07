<?php
include "header.php";
?>

<!-- <body> tag started in header.php -->
<section class="page">
    <div class="mainContainer">
    <header style="text-align: center;">Welcome, please enter your information below to login.</header>

        <!-- Check for invalid credentials error and alert the user -->
        <?php
        if (isset($_GET["error"]) && $_GET["error"] === "invalid") {
            echo "<p class='error-message'><center>Invalid username or password.</center></p>";
        }
        ?>

        <!-- Login form -->
        <form action="login_handler.php" method="post">
            <div class="center">
                <div id="login-form">
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id="email" size="30" maxlength="50" required><br>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" size="30" maxlength="50" required><br>
                </div>
                <div class="formButtons" style="text-align: center;">
                    <input type="reset" class="button" value="Reset">
                    <input type="submit" class="button" value="Login">
                </div>
            </div>
        </form>
    </div>
</section>
</body>
</html>
