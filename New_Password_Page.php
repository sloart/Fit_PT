<?php
include "header.php";
?>
<section class="page">
    <div class="mainContainer">
    <header><center>Enter New Password</center></header>

    <!-- Check for invalid credentials error and alert the user -->
    <?php
    if (isset($_GET["error"]) && $_GET["error"] === "invalid") {
        echo "<p style='color:red'><center>Invalid Password. Pasword Must have 1 Capital letter, with at least 6 characters long and a symbol!</center></p>";
    }
    ?>

    <!-- Reset Password form -->
    <!-- <h1><center>Enter your New Password.</center></h1> -->
	<form action="password_handler.php" method="post">
        <center>
	        <label for="NPassword">New Password:</label><br>
            <input type="NPassword" name="NPassword" id="NPassword" size="30" maxlength="50" required><br>
			
			<label for="CNPassword">Confirm New Password:</label><br>
            <input type="CNPassword" name="CNPassword" id="CNPassword" size="30" maxlength="50" required><br>
		<center>
			<input type="submit" class="button" value="Enter">
			<input type="reset" class="button" value="Reset">
        </center>
    </form>
</div>

<?php
include "footer.php";
?>