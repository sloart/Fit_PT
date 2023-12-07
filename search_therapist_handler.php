<?php
global $connection;
include 'header.php';
require 'functions.php';

$selectedTherapist = isset($_POST['therapistDropdown']) ? $_POST['therapistDropdown'] : '';

$therapists = getTherapists($connection, $selectedTherapist);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<section class="page">
    <div class="popup" id="therapistList">
        <?php if ($therapists): ?>
            <div class="last-minute">
                <input type="text" id="search-therapist-list-input" onkeyup="searchTherapistTable()" placeholder="Search therapists" title="Type a name">
            </div>
            <table id="therapistTable">
                <tr>
                    <th style="min-width: 100px">Therapist Name</th>
                    <th style="max-width: 150px">Current Certifications</th>
                    <th style="width: 500px">Add or Delete Certifications</th>
                    <th>Remove Therapist From Database<br></th>
                </tr>
                <?php foreach ($therapists as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td>
                            <?php
                            $therapistId = $row['user_id'];
                            $certsQuery = "SELECT cert_name FROM therapist_certification_relation WHERE therapist_id = ?;";
                            $certsStmt = $connection->prepare($certsQuery);
                            if ($certsStmt) {
                                $certsStmt->bind_param("i", $therapistId);
                                if ($certsStmt->execute()) {
                                    $certsResult = $certsStmt->get_result();
                                    while ($certRow = $certsResult->fetch_assoc()) {
                                        echo $certRow['cert_name'] . "<br>";
                                    }
                                } else {
                                    echo "Error: " . $certsStmt->error;
                                }
                                $certsStmt->close();
                            } else {
                                echo "Error: " . $connection->error;
                            }
                            ?>
                        </td>
                        <td style="text-align: right">
                            <div class="input-field">
                            <?php
                            // Option to add certifications
                            echo '<form class="highlight-on-hover" action="update_therapist_handler.php" method="post">';
                            echo '<input type="hidden" name="therapistId" value="' . $therapistId . '">';
                            echo 'Add Certification: ';
                            echo '<select name="newCert">';
			                echo '<option value="">Select</option>';
			                echo '<option value="AET">AET</option>';
			                echo '<option value="CAPP-OB">CAPP-OB</option>';
			                echo '<option value="CAPP-Pelvic">CAPP-Pelvic</option>';
			                echo '<option value="CHT">CHT</option>';
			                echo '<option value="CKTP">CKTP</option>';
			                echo '<option value="CLT">CLT</option>';
			                echo '<option value="CREX">CREX</option>';
			                echo '<option value="CSCS">CSCS</option>';
			                echo '<option value="CYT">CYT</option>';
			                echo '<option value="GCS">GCS</option>';
			                echo '<option value="LMT">LMT</option>';
			                echo '<option value="OCS">OCS</option>';
			                echo '<option value="PAS">PAS</option>';
			                echo '<option value="PCS">PCS</option>';
			                echo '<option value="SCS">SCS</option>';
			                echo '<option value="WCS">WCS</option>';
			                echo '</select>';
                            echo '<input type="submit" class="smallerButtons" name="addCert" value="Submit">';
                            echo '</form>';
                            echo '<br>';

                            // Option to delete certifications
                            echo '<form class="highlight-on-hover" action="update_therapist_handler.php" method="post">';
                            echo '<input type="hidden" name="therapistId" value="' . $therapistId . '">';
                            echo 'Delete Certification: ';
                            echo '<select name="certToDelete">';
			                echo '<option value="">Select</option>';
			                echo '<option value="AET">AET</option>';
			                echo '<option value="CAPP-OB">CAPP-OB</option>';
			                echo '<option value="CAPP-Pelvic">CAPP-Pelvic</option>';
			                echo '<option value="CHT">CHT</option>';
			                echo '<option value="CKTP">CKTP</option>';
			                echo '<option value="CLT">CLT</option>';
			                echo '<option value="CREX">CREX</option>';
			                echo '<option value="CSCS">CSCS</option>';
			                echo '<option value="CYT">CYT</option>';
			                echo '<option value="GCS">GCS</option>';
			                echo '<option value="LMT">LMT</option>';
			                echo '<option value="OCS">OCS</option>';
			                echo '<option value="PAS">PAS</option>';
			                echo '<option value="PCS">PCS</option>';
			                echo '<option value="SCS">SCS</option>';
			                echo '<option value="WCS">WCS</option>';
			                echo '</select>';
                            echo '<input type="submit" class="smallerButtons" name="deleteCert" value="Submit">';
                            echo '</form>';
                            echo '<br>';
                            ?>
                            </div>
                        </td>
                        <td>
                        <?php
//                            // Option to delete therapist record
                            echo '<form action="update_therapist_handler.php" method="post">';
                            echo '<input type="hidden" name="therapistId" value="' . $therapistId . '">';
                            echo '<input type="submit" class="smallerButtonsRed" name="deleteTherapist" value="Delete">';
                            echo '</form>';
                            echo '<br>';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="formButtons">
                <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
            </div>
        <?php else: ?>
            <p>No therapists found.</p>
        <?php endif; ?>
    </div>
</section>

<!--handles making the table searchable!-->
<script>
    function searchTherapistTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search-therapist-list-input");
        filter = input.value.toUpperCase();
        table = document.getElementById("therapistTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>