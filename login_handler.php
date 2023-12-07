<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "Fit_PT";

// Create a database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "email" and "password" keys exist in the $_POST array
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // User email and password from the form
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Retrieve the hashed password from the database for the given email
        $sql = "SELECT user_email, user_password, user_id, user_name, user_type FROM system_users WHERE user_email = '$email'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPasswordFromDB = $row["user_password"];

            // Verify the entered password against the stored hashed password
            if (password_verify($password, $hashedPasswordFromDB)) {
                // Store user data in the session upon successful login
                $_SESSION['user_email'] = $row["user_email"];
                $_SESSION['user_id'] = $row["user_id"];
                $_SESSION['user_type'] = $row["user_type"];
                $_SESSION['user_name'] = $row["user_name"];
                header("Location: index.php"); // Redirect to the dashboard or desired page
                exit;
            }
        }

        // If no match is found or the file doesn't exist, display an error message.
        echo "Invalid login credentials.";
        echo '<script>alert("Invalid login credentials. Please try again.")</script>';
        echo '<script> window.open("initial_login_page.php", "_self")</script>';
    } else {
        // If "email" or "password" keys are not set in the $_POST array, handle the error appropriately.
        echo "Missing input fields.";
    }
}

// Close the database connection
mysqli_close($connection);
?>
