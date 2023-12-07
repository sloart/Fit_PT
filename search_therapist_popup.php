<?php

function getMysqli_result()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fit_pt";

    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die(mysqli_connect_error());
    }

    $get_therapists_users = "SELECT * FROM system_users WHERE user_type = 't' ORDER BY user_name;";
    return mysqli_query($connection, $get_therapists_users);
}

$therapists_users = getMysqli_result();
?>

<section class="page">
<div class="mainContainer" id="search-therapist" style="display: none">
    <form action="search_therapist_handler.php" method="post">
        <div class="search-therapist">
            <header>Modify/Remove Therapist</header>
            <br>
            <div class="fields"></div>
                <div class="input-field">
                    <label for="therapistDropdown">Select:</label>
                    <select name="therapistDropdown" id="therapistDropdown">
                        <option value="" disabled selected>Select</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($therapists_users)) {
                            echo '<option value="' . $row['user_name'] . '">';
                            echo $row['user_name'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
        </div>
            <div class="formButtons">
                <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
                <input type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
</section>