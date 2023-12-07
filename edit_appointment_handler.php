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
$appointmentID = $_POST["appointmentID"];
$patientEmail = $_POST["patientEmail"];
$patientPhone = $_POST["patientPhone"];
$intakeNotes = $_POST["intakeNotes"];
$date = $_POST["date"];
$time = $_POST["time"];
$typeOfTherapy = $_POST["certificationDropdown"];
$therapist = $_POST["therapistInput"];

// placeholder for testing
echo 'Patient Email: ' . $patientEmail . '<br>';
echo 'Patient Phone: ' . $patientPhone . '<br>';
echo 'Intake Notes: ' . $intakeNotes . '<br>';
echo 'Date: ' . $date . '<br>';
echo 'Time: ' . $time . '<br>';
echo 'Type of Therapy: ' . $typeOfTherapy . '<br>';
echo 'Therapist ID: ' . $therapist . '<br>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submitBtn"])) {
        // checking for scheduling conflict
        $sql_check_scheduling_conflict = "SELECT * FROM appointments
                WHERE therapist_id = ?
                AND appointment_date = ? AND start_time = ? AND appt_id != ?";
        $conflict_check_query = $connection->prepare($sql_check_scheduling_conflict);
        $conflict_check_query->bind_param("isii", $therapist, $date, $time, $appointmentID);
        $conflict_check_query->execute();

        $conflict_check_result = $conflict_check_query->get_result();

        if ($conflict_check_result->num_rows > 0) {
            echo "Sorry, there may be a scheduling conflict. Please choose a different date or time.";
        } else {
            // adding appointment if no conflict
            $sql_schedule_appointment = "UPDATE appointments SET patient_email = '$patientEmail',
                patient_phone = '$patientPhone', intake_notes = '$intakeNotes', appointment_date = '$date',
                start_time = '$time' WHERE appt_id = '$appointmentID'";

            // error check
            if (mysqli_query($connection, $sql_schedule_appointment)) {
                echo "Record inserted successfully.";
                header("Location: edit_appointment.php?id=$appointmentID&success=1");
            } else {
                echo "Error: " . $sql_schedule_appointment . "<br>" . $connection->error;
            }
            $statement->close();
        }
    } elseif ((isset($_POST["deleteBtn"]))) {
        //query to delete appointment
        $delete_query = "DELETE FROM appointments WHERE appt_id = '$appointmentID'";

        // execute and error check
        if (mysqli_query($connection, $delete_query)) {
            echo "Record deleted successfully.";
            header("Location: edit_appointment.php?id=$appointmentID&success=1");
        } else {
            echo "Error: " . $sql_schedule_appointment . "<br>" . $connection->error;
        }
        $statement->close();
        echo "deleted";
    }
}
$connection->close();
