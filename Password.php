<?php
include "header.php";
?>

<section class="page">
    <div class="mainContainer">
    <header><center>Reset Password</center></header>

    <!-- Check for invalid credentials error and alert the user -->
    <?php
    if (isset($_GET["error"]) && $_GET["error"] === "invalid") {
        echo "<p style='color:red'><center>Invalid email.</center></p>";
    }
    ?>

    <!-- Reset Password form -->
    <h1><center>Enter your email below.</center></h1>
	<form action="password_handler.php" method="post">
        <center>
	        <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" size="30" maxlength="50" required><br>
		<center>
			<input type="reset" class="button" value="Reset">
        </center>
    </form>
</div>
</section>

<?php
include "footer.php"; // Include your footer or closing HTML here
?>