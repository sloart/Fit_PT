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

$appointment_id = null;

if(isset($_POST['Delete'])) { 
    echo "This is Button1 that is selected"; 
} 

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $appointment_id = $_GET['id'];
    $get_appointment_info_query = "SELECT * FROM appointments WHERE appt_id = " . $appointment_id . ";";
    $appointments_result = mysqli_query($connection, $get_appointment_info_query);
    $appointment_info = mysqli_fetch_assoc($appointments_result);
}

$get_therapists_users = "SELECT * FROM system_users WHERE user_type = 't';";
$therapists_users = mysqli_query($connection, $get_therapists_users);

$get_certifications = "SELECT * FROM `certifications`;";
$certifications = mysqli_query($connection, $get_certifications);
?>

<html>
<head>
    <script src="https://kit.fontawesome.com/6a7c3fe12b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/appointment_form.css">
</head>
<body>

<section class="page">
    <div class="mainContainer">
        <header>Edit Appointment</header>
        <form id="schedule_appointment" action="edit_appointment_handler.php" method="post">
            <input type="hidden" name="appointmentID" id="appointmentID" value="<?php echo $appointment_info['appt_id']?>" required>
            
            <div class="details">
                <span class="title">Patient Information</span>
                <div class="fields-apt">
                    <div class="input-field-apt">
                        <label for="firstName">Name</label>
                        <input type="text" class="entries" value="<?php echo $appointment_info['patient_name']?>" disabled>
                    </div>
                    <div class="input-field-apt">
                        <label for="patientEmail">Email Address</label>
                        <input class="entries" required type="email" name="patientEmail" id="patientEmail" placeholder="Enter patient email" value="<?php echo $appointment_info['patient_email']?>">
                    </div>
                    <div class="input-field-apt">
                        <label for="patientPhone">Phone Number</label>
                        <input class="entries" required type="tel" name="patientPhone" id="patientPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                            placeholder="Enter patient phone" value="<?php echo $appointment_info['patient_phone']?>">
                    </div>
                </div>
            </div>
            <div class="details">
                <span class="title">Notes</span>
                <div class="fields">
                    <div class="sidebyside">
                        <div class="input-field" style="width: 100%;">
                            <textarea name="intakeNotes" id="intakeNotes"
                                placeholder="Enter any comments regarding patient"><?php echo $appointment_info['intake_notes']?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details appointment">
                <span class="title">Appointment Details</span>
                <div class="fields">
                    <div style="display: flex; width: 100%; justify-content: space-between;">
                        <div class="input-field-apt">
                            <label for="date">Date</label>
                            <input class="entries"  style="width: 198px;" type="date" name="date" id="date" value="<?php echo $appointment_info['appointment_date']?>" required>
                        </div>
                        <div class="input-field-apt">
                            <label for="time">Time</label>
                            <select name="time" id="time" required>
                                <option value="" disabled>Select Appointment Time</option>
                                <option <?php if ($appointment_info['start_time'] == 8) {
                                    echo 'selected ';} ?> value="8am">8am</option>
                                <option <?php if ($appointment_info['start_time'] == 9) {
                                    echo 'selected ';} ?>value="9am">9am</option>
                                <option <?php if ($appointment_info['start_time'] == 10) {
                                    echo 'selected ';} ?>value="10am">10am</option>
                                <option <?php if ($appointment_info['start_time'] == 11) {
                                    echo 'selected ';} ?>value="11am">11am</option>
                                <option <?php if ($appointment_info['start_time'] == 12) {
                                    echo 'selected ';} ?>value="12pm">12pm</option>
                                <option <?php if ($appointment_info['start_time'] == 1) {
                                    echo 'selected ';} ?>value="1pm">1pm</option>
                                <option <?php if ($appointment_info['start_time'] == 2) {
                                    echo 'selected ';} ?>value="2pm">2pm</option>
                                <option <?php if ($appointment_info['start_time'] == 3) {
                                    echo 'selected ';} ?>value="3pm">3pm</option>
                                <option <?php if ($appointment_info['start_time'] == 4) {
                                    echo 'selected ';} ?>value="4pm">4pm</option>
                            </select>
                        </div>
                        <div class="input-field-apt">
                            <label for="certificationDropdown">Type of Therapy:</label>
                            <select name="certificationDropdown" id="certificationDropdown">
                                <option value="" disabled selected>Select Type of Therapy</option>
                                <!-- populating cert filter dropdown -->
                                <?php
                                    while ($row = mysqli_fetch_assoc($certifications)) {
                                        $selected = ($row['name_short'] == $appointment_info['type_of_therapy']) ? 'selected' : '';
                                        echo "<option value='{$row['name_short']}' {$selected}>{$row['type_of_therapy']}</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details _therapist">
                <span class="title">Select Therapist</span>

                <div id="therapistContainer" class="therapistContainer">
                    <span id="selectTherapyType">
                        <!-- <i class="fa-solid fa-circle-info fa-2xl" style="color: #4d4d4d;"></i> -->
                        <p>Please select a time, date, and type of therapy to select a therapist.</p>
                    </span>
                </div>

                <input type="hidden" name="therapistInput" id="therapistInput" required>
            </div>

            <div class="formButtons">
                <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
                <input type="submit" name="deleteBtn" class="redBtn"  value="Delete">
                <input type="submit" name="submitBtn" value="Submit">
            </div>
        </form>
    </div>
</section>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Changes successful!");
    window.location.href = "index.php"</script>';
}
?>

<!-- setting min date on date input -->
<!-- <script>
    let dateInput = document.getElementById("date");

    //function to set the minimum selectable date to today
    function setMinDate() {
        let currentDate = new Date();
        console.log(currentDate.toISOString().slice(0, 10));

        // min requires date in iso string format - slicing off excess
        dateInput.min = currentDate.toISOString().slice(0, 10);
    }
    window.addEventListener('load', setMinDate);
</script> -->
</html>
