<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['certification'])) {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fit_pt";

    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die(mysqli_connect_error());
    }

    // getting certification associated with type of therapy that was selected
    $selectedCertification = $_POST['certification'];

    if ($selectedCertification == "") {
        // temp
        echo 'NO TYPE_OF_THERAPY SELECTED';
    } else {
        // filter by type of therapy
        $sql = "SELECT * FROM therapist_certification_relation
            LEFT JOIN system_users ON therapist_certification_relation.therapist_id=system_users.user_id
            WHERE cert_name = '$selectedCertification';";
        $filtered_therapists = mysqli_query($connection, $sql);
        // Generating Filtered Therapists
        $therapistDivs = "";
        if ($filtered_therapists) {
            while ($row = mysqli_fetch_assoc($filtered_therapists)) {
                $therapistDivs .= '<div class="therapist" data-therapistid="' . $row['user_id'] . '">
                <i class="fa-solid fa-user fa-2xl" style="color: #fff;"></i><h2>' . $row['user_name'] . '</h2>' . '</div>';
            }
        } else {
            echo "QUERY ERROR: " . mysqli_error($connection);
        }

        // outputting filtered therapists
        echo $therapistDivs;
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid Request";
}
?>