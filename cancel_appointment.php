<?php
include "header.php";
ob_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "fit_pt";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die(mysqli_connect_error());
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Changes successful!");
    history.back()</script>';
}

$appointment_id = null;

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $appointmentID = $_GET['id'];

    //query to delete appointment
    $delete_query = "DELETE FROM appointments WHERE appt_id = '$appointmentID'";

    // execute and error check
    if (mysqli_query($connection, $delete_query)) {
        //echo "Record deleted successfully.";
        echo '<script>alert("Appointment has been cancelled.");
            history.back()</script>';
    } else {
        echo "Error: " . $sql_schedule_appointment . "<br>" . $connection->error;
    }
    // $statement->close();
    echo "deleted";
}

?>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Changes successful!");
    window.location.href = "index.php"</script>';
}
?>