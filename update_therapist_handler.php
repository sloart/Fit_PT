<?php
$username = "root";
$password = "";
$database = "Fit_PT";
$mysqli = new mysqli("localhost", $username, $password, $database);

if ($mysqli->connect_error) {
    die('Connection error: ' . $mysqli->connect_error);
}

// Handle adding certification
if (isset($_POST['addCert'])) {
    $therapistId = $_POST['therapistId'];
    $newCert = $_POST['newCert'];

    // Check if the certification already exists for the therapist
    $checkCertQuery = "SELECT * FROM therapist_certification_relation WHERE therapist_id = ? AND cert_name = ?;";
    $checkCertStmt = $mysqli->prepare($checkCertQuery);

    if ($checkCertStmt) {
        $checkCertStmt->bind_param("is", $therapistId, $newCert);

        if ($checkCertStmt->execute()) {
            $checkCertResult = $checkCertStmt->get_result();

            if ($checkCertResult->num_rows == 0) {
                // Certification does not exist, add it
                $addCertQuery = "INSERT INTO therapist_certification_relation (therapist_id, cert_name) VALUES (?, ?);";
                $addCertStmt = $mysqli->prepare($addCertQuery);

                if ($addCertStmt) {
                    $addCertStmt->bind_param("is", $therapistId, $newCert);

                    if ($addCertStmt->execute()) {
//                        header('Location: search_therapist_handler.php');
                        echo '<script>alert("Certification added successfully!")</script>';
                        echo '<script> window.open("admin_nav_page.php", "_self")</script>';
                        exit();
//                        echo "Certification added successfully.";
                    } else {
                        echo "Error adding certification: " . $addCertStmt->error;
                    }

                    $addCertStmt->close();
                } else {
                    echo "Error preparing addCert statement: " . $mysqli->error;
                }
            } else {
                echo "Certification already exists for this therapist.";
            }
        } else {
            echo "Error executing checkCert query: " . $checkCertStmt->error;
        }

        $checkCertStmt->close();
    } else {
        echo "Error preparing checkCert statement: " . $mysqli->error;
    }
}

// Handle deleting certification
if (isset($_POST['deleteCert'])) {
    $therapistId = $_POST['therapistId'];
    $certToDelete = $_POST['certToDelete'];

    $deleteCertQuery = "DELETE FROM therapist_certification_relation WHERE therapist_id = ? AND cert_name = ?;";
    $deleteCertStmt = $mysqli->prepare($deleteCertQuery);

    if ($deleteCertStmt) {
        $deleteCertStmt->bind_param("is", $therapistId, $certToDelete);

        if ($deleteCertStmt->execute()) {
//            header('Location: search_therapist_handler.php');
            echo '<script>alert("Certification deleted successfully!")</script>';
            echo '<script> window.open("admin_nav_page.php", "_self")</script>';
            exit();
//            echo "Certification deleted successfully.";
        } else {
            echo "Error deleting certification: " . $deleteCertStmt->error;
        }

        $deleteCertStmt->close();
    } else {
        echo "Error preparing deleteCert statement: " . $mysqli->error;
    }
}

// Handle deleting therapist record
if (isset($_POST['deleteTherapist'])) {
    $therapistId = $_POST['therapistId'];

    $deleteTherapistQuery = "DELETE FROM system_users WHERE user_id = ?;";
    $deleteTherapistStmt = $mysqli->prepare($deleteTherapistQuery);

    if ($deleteTherapistStmt) {
        $deleteTherapistStmt->bind_param("i", $therapistId);

        if ($deleteTherapistStmt->execute()) {
//            echo "Therapist record deleted successfully.";
            echo '<script>alert("Therapist has been removed from the database.")</script>';
            echo '<script> window.open("admin_nav_page.php", "_self")</script>';
            exit();
        } else {
            echo "Error deleting therapist record: " . $deleteTherapistStmt->error;
        }

        $deleteTherapistStmt->close();
    } else {
        echo "Error preparing deleteTherapist statement: " . $mysqli->error;
    }
}

$mysqli->close(); // Close the database connection