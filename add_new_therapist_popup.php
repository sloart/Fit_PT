<?php

include 'mysqli_connect.php';

$username = "root";
$password = "";
$database = "Fit_PT";
$mysqli = new mysqli("localhost", $username, $password, $database);

?>

<section class="page">
<div class="mainContainer" id="add-new-therapist" style="display: none;">
    <form action="add-new-therapist-handler.php" method="post">
        <div class="add-new-therapist">
            <header>Add New Therapist</header>
            <br>
            <div class="fields">
                <div class="input-field">
                    <label for="userName">Name:</label>
                    <input type="text" name="userName" id="userName" size="30" maxlength="50" placeholder="Name" required>
                </div>
                <br>
                <div class="input-field">
                    <label for="userEmail">Email:</label>
                    <input type="email" name="userEmail" id="userEmail" size="30" maxlength="50" placeholder="Email" required>
                </div>
                <br>
                <div class="input-field">
                    <label for="userPassword">Password:</label>
                    <input type="password" name="userPassword" id="userPassword" size="30" maxlength="50" placeholder="Password" required>
                </div>

            </div>
            <div class="formButtons">
                <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
                <input type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
<?php echo '</section>'; ?>