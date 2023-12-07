<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the create account form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database configuration
    $servername = "localhost";
    $dbUsername = "root"; // Replace with your MySQL username
    $dbPassword = ""; // Replace with your MySQL password
    $dbname = "Fit_PT";

    // Create a database connection
    $connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    // Check the connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Hash the user's password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user's data into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

    if (mysqli_query($connection, $sql)) {
        // User account created successfully
        $_SESSION['user'] = [
            'email' => $email,
            // Add other user data as needed
        ];

        // Redirect to the user's dashboard or desired page
        header("Location: index.php"); // Replace with your dashboard page
        exit;
    } else {
        echo "Error creating the account: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
</head>
<body>
    <h1>Create Account</h1>

    <!-- Create Account form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Create Account">
    </form>
</body>
</html>
