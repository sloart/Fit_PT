<?php

include 'mysqli_connect.php';

$username = "root";
$password = "";
$database = "Fit_PT";
$mysqli = new mysqli("localhost", $username, $password, $database);

if ($mysqli->connect_error) {
    die('Connection error: ' . $mysqli->connect_error);
}

// Get user input from the form
$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];
$hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Insert data into the system_users table
$sql = "INSERT INTO system_users (user_name, user_email, user_password, user_type) VALUES ('$userName', '$userEmail', '$hashedUserPassword', 't')";

if ($mysqli->query($sql) === TRUE) {
    // Get the user_id of the newly inserted user
    $newUserId = $mysqli->insert_id;

//if ($mysqli->query($sql) === TRUE) {
    echo '<script>alert("New therapist added successfully!")</script>';
    echo '<script> window.open("admin_nav_page.php", "_self")</script>';
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// button to go back to admin_nav_page.php
echo '<br><a href="admin_nav_page.php"><button>Go Back to Admin Page</button></a>';

// Close the database connection
$mysqli->close();