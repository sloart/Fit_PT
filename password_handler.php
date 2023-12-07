<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "Fit_PT";

// Create a database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "email" and keys exist in the $_POST array
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // User email and password from the form
        $email = $_POST["email"];

        // Retrieve the hashed password from the database for the given email
        $sql = "SELECT email, password FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPasswordFromDB = $row["password"];

        }

        // If no match is found or the file doesn't exist, display an error message.
        echo "Invalid login credentials.";
    } else {
        // If "email" keys are not set in the $_POST array, handle the error appropriately.
        echo "Missing input fields.";
    }
}

// Close the database connection
mysqli_close($connection);
?>
