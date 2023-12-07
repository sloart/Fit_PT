<?php
include "header.php";

$host = "localhost";
$username = "root";
$password = "";
$database = "Fit_PT";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die(mysqli_connect_error());
}

// queries
$get_therapists_users = "SELECT * FROM system_users WHERE user_type = 't';";
$therapists_users = mysqli_query($connection, $get_therapists_users);

$get_certifications = "SELECT * FROM certifications;";
$certifications = mysqli_query($connection, $get_certifications);

$get_system_users = "SELECT * FROM system_users;";
$system_users = mysqli_query($connection, $get_system_users);

?>

<html>
<head></head>
<section class="page">
<div class="mainContainer">

<h1>*****Each of these separate forms is going to be split out into its own popup window, accessible by selecting from the buttons on <a href="admin_nav_page.php">admin_nav_page</a>*****</h1>
<br>
<hr>
<form id="update-certifications" action="schedule_appointment_handler.php" method="post"> 
    <!-- <center id="update-certifications"> -->
    <div class="update-certifications">
        <header>Update Certifications</header>
        <br>
        <select name="systemUserDropdown" id="systemUserDropdown">
        <option value="" disabled selected>(choose from list)</option>
            <?php
                while ($row = mysqli_fetch_assoc($therapists_users)) {
                    echo '<option value="' . $row['user_name'] . '">';
                    echo $row['user_name'];
                    echo '</option>';
                }
            ?>
        </select>
    </div>
    <div class="fields">
        <div class="input-field">
            <label for="addCertification">Add Certification:</label>
            <input type="text" name="addCertification" id="addCertification" placeholder="certification to add" required>
        </div>
        <div class="input-field">
            <label for="deleteCertification">Delete Certification:</label>
            <input type="text" name="deleteCertification" id="deleteCertification" placeholder="certification to delete" required>
        </div>
    </div>
    <center class="formButtons">
        <input type="submit" class="button" value="Submit">
    </center>
</form>
<br>
<hr>
<!-- wondering if this should be for editing any user... not just therapists? -->
<form id="edit-existing-therapist" action="schedule_appointment_handler.php" method="post"> 
    <!-- <center id="edit-existing-therapist"> -->
    <div class="edit-existing-therapist">
        <header>Edit Existing Therapist</header>
        <br>
        <select name="systemUserDropdown" id="systemUserDropdown">
        <option value="" disabled selected>(choose from list)</option>
            <?php
                while ($row = mysqli_fetch_assoc($therapists_users)) {
                    echo '<option value="' . $row['user_name'] . '">';
                    echo $row['user_name'];
                    echo '</option>';
                }
            ?>
        </select>
    </div>
    <div class="fields">
        <div class="input-field">
            <label for="userName">Change Name To:</label>
            <input type="text" name="userName" id="userName" placeholder="new name" required>
        </div>
        <div class="input-field">
            <label for="userEmail">Change Email To:</label>
            <input type="email" name="userEmail" id="userEmail" placeholder="different@fitpt.com" required>
        </div>
        <div class="input-field">
            <label for="userPassword">Change Password To:</label>
            <input type="password" name="userPassword" id="userPassword" placeholder="newPassword" required>
        </div>
    </div>
    <center class="formButtons">
        <input type="submit" class="button" value="Submit">
    </center>
</form>
<br>
<hr>
</div>
</section>
</html>