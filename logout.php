<?php
session_start(); // Start the session

// Clear all session data
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or another desired location
header("Location: initial_login_page.php"); // Change "login.php" to your actual login page
exit;
?>