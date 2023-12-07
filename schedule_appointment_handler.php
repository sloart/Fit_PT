<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fit_pt";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die(mysqli_connect_error());
}

// getting form data

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$patientEmail = $_POST["patientEmail"];
$patientPhone = $_POST["patientPhone"];
$intakeNotes = $_POST["intakeNotes"];
$date = $_POST["date"];
$time = $_POST["time"];
$typeOfTherapy = $_POST["certificationDropdown"];
$therapist = $_POST["therapistInput"];

$fullName = $firstName . ' ' . $lastName;

// placeholder for testing
echo 'First Name: ' . $firstName . '<br>';
echo 'Last Name: ' . $lastName . '<br>';
echo 'Patient Email: ' . $patientEmail . '<br>';
echo 'Patient Phone: ' . $patientPhone . '<br>';
echo 'Intake Notes: ' . $intakeNotes . '<br>';
echo 'Date: ' . $date . '<br>';
echo 'Time: ' . $time . '<br>';
echo 'Type of Therapy: ' . $typeOfTherapy . '<br>';
echo 'Therapist ID: ' . $therapist . '<br>';

// checking for scheduling conflict
$sql_check_scheduling_conflict = "SELECT * FROM appointments
        WHERE therapist_id = ?
        AND appointment_date = ? AND start_time = ?";
$conflict_check_query = $connection->prepare($sql_check_scheduling_conflict);
$conflict_check_query->bind_param("isi", $therapist, $date, $time);
$conflict_check_query->execute();

$conflict_check_result = $conflict_check_query->get_result();

if ($conflict_check_result->num_rows > 0) {
    echo "Sorry, there may be a scheduling conflict. Please choose a different date or time.";
} else if (!$therapist) {
    echo "NO THERAPIST SELECTED";
} else {
    // adding appointment if no conflict
    $sql_schedule_appointment = "INSERT INTO `appointments`(`patient_name`, `patient_phone`,
            `patient_email`, `intake_notes`, `start_time`, `therapist_id`,
            `type_of_therapy`, `appointment_date`)
            VALUES (?,?,?,?,?,?,?,?);";
    $statement = $connection->prepare($sql_schedule_appointment);
    $statement->bind_param(
        "ssssssss",
        $fullName,
        $patientPhone,
        $patientEmail,
        $intakeNotes,
        $time,
        $therapist,
        $typeOfTherapy,
        $date
    );

    // error check
    if ($statement->execute()) {
        echo "Record inserted successfully.";
        header("Location: schedule_appointment.php?success=1");
    } else {
        echo "Error: " . $sql_schedule_appointment . "<br>" . $connection->error;
    }
    $statement->close();
}

$connection->close(); ?>
