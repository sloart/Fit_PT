<?php
include "header.php";

$host = "localhost";
$username = "root";
$password = "";
$database = "fit_pt";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die(mysqli_connect_error());
}

// queries
$get_therapists_users = "SELECT * FROM system_users WHERE user_type = 't';";
$therapists_users = mysqli_query($connection, $get_therapists_users);

$get_certifications = "SELECT * FROM `certifications`;";
$certifications = mysqli_query($connection, $get_certifications);

?>

<html lang="en">

<head>
    <title>Schedule Appointment</title>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/6a7c3fe12b.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</head>

<section class="page">
    <div class="mainContainer">
        <header>New Appointment</header>
        <!-- holds form -->
        <form id="schedule_appointment" action="schedule_appointment_handler.php" method="post">
            <div class="details"> <!-- first of three major divs in this form -->
                <div class="title">Patient Contact Information</div>
                <div class="fields"> <!-- flex direction column so #first-last sits on top of #email-phone -->

                    <div id="first-last"> <!-- flex direction row so #first-name sits to left of #lastName -->
                        <div id="first-name" class="input-field">
                            <label for="firstName">First Name:</label>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                        </div>
                        <div id="last-name" class="input-field">
                            <label for="lastName">Last Name:</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div id="email-phone"> <!-- flex direction row so #patientEmail sits to left of #patientPhone -->
                        <div id="email-address" class="input-field">
                            <label for="patientEmail">Email Address:</label>
                            <input type="email" name="patientEmail" id="patientEmail" placeholder="Email Address" required>
                        </div>
                        <div id = "patient-phone" class="input-field">
                            <label for="patientPhone">Phone Number:</label>
                            <input type="text" class="entries" name="patientPhone" id='patientPhone'  placeholder="(   )___-____" required>
                        </div>
                    </div>
                </div>
            </div> <!-- end of first major div in the form -->

            <div class="details"> <!-- second of three major divs in this form -->
                <div class="title">Appointment Details</div>
                <div class="fields"> <!-- (flex direction column) and takes 95% of container -->

                    <div id="intake-notes" class="input-field"> <!-- flex direction column keeps label above text area -->
                        <label for="intakeNotes">Intake Notes: </label>
                        <textarea name="intakeNotes" id="intakeNotes" placeholder="What brings this patient in today?"></textarea>
                    </div>

                    <div id="date-time-type" class="input-field"> <!-- flex direction column to stack #date-time over #type -->
                        <div id="date-time"> <!-- flex direction row -->
                            <div id="date" class="input-field"> <!--flex column stacks label -->
                                <label for="date">Date: </label>
                                <input type="date" name="date" id="date" required>
                            </div>
                            <div id="time" class="input-field"> <!--flex column stacks label -->
                                <label for="time">Time: </label>
                                <select name="time" id="time" required>
                                    <option value="" disabled selected>Select Time</option>
                                    <option value="8am">8am</option>
                                    <option value="9am">9am</option>
                                    <option value="10am">10am</option>
                                    <option value="11am">11am</option>
                                    <option value="12pm">12pm</option>
                                    <option value="1pm">1pm</option>
                                    <option value="2pm">2pm</option>
                                    <option value="3pm">3pm</option>
                                    <option value="4pm">4pm</option>
                                </select>
                            </div>
                        </div>

                        <div id="type"> <!-- make it flex row -->
                            <label for="certificationDropdown">Type of Therapy: </label>
                            <select name="certificationDropdown" id="certificationDropdown">
                                <option value="" disabled selected>Select Type</option>
                                <!-- populating cert filter dropdown -->
                                <?php
                                while ($row = mysqli_fetch_assoc($certifications)) {
                                    echo '<option value="' . $row['name_short'] . '">';
                                    echo $row['type_of_therapy'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div> <!-- end of second div in this form -->

            <div class="details _therapist"> <!-- third of three divs in this form -->
                <div class="title">Therapist</div>

                <div id="therapistContainer" class="therapistContainer">
                    <span id="selectTherapyType">
                         <i class="fa-solid fa-circle-info fa-2xl" style="color: #4d4d4d;"></i>
                        <p>Please choose a date, time, and type of therapy to show available therapists.</p>
                    </span>
                </div>

                <input type="hidden" name="therapistInput" id="therapistInput" required>
            </div>

            <div class="formButtons">
                <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
                <input type="submit" value="Submit">
            </div> <!-- end of third major div in this form -->
        </form>

    </div>
</section>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Appointment scheduled successfully!")</script>';
    echo '<script> window.open("scheduler_nav_page.php", "_self")</script>';
}
?>

<!-- handles the phone number masking -->
<script>
document.getElementById('patientPhone').addEventListener('input', function (e) {
var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
e.target.value = !x[2] ? x[1] : '(' + x[1] + ')' + x[2] + (x[3] ? '-' + x[3] : '');
});
</script>

<!-- setting min date on date input -->
<script>
    let dateInput = document.getElementById("date");

    //function to set the minimum selectable date to today
    function setMinDate() {
        let currentDate = new Date();
        console.log(currentDate.toISOString().slice(0, 10));

        // min requires date in iso string format - slicing off excess
        dateInput.min = currentDate.toISOString().slice(0, 10);
    }
    window.addEventListener('load', setMinDate);
</script>

<script>
    // adding event listener
    document.addEventListener("DOMContentLoaded", function() {
        const hiddenSelectedTherapistInput = document.getElementById("therapistInput");
        const certificationDropdown = document.getElementById("certificationDropdown");
        const therapistContainer = document.getElementById("therapistContainer");
        certificationDropdown.addEventListener("change", function() {
            hiddenSelectedTherapistInput.value = "";
            const selectedCertification = certificationDropdown.value;
            filterTherapists(selectedCertification);
        });

        function filterTherapists(certification) {
            // AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "filter_therapists.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("certification=" + encodeURIComponent(certification));

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //update therapists
                    therapistContainer.innerHTML = xhr.responseText;
                }
            }
        }
    })

    let selectedTherapist = null;

    // making therapist divs selectable
    therapistContainer.addEventListener("click", function(event) {
        if (event.target.closest(".therapist")) {
            selectTherapist(event.target.closest(".therapist"));
        }
    })

    // handles selecting therapist
    function selectTherapist(therapistDiv) {
        let hiddenSelectedTherapistInput = document.getElementById("therapistInput");
        if (selectedTherapist == therapistDiv) {
            selectedTherapist.classList.remove("selected");
            selectedTherapist = null;
            hiddenSelectedTherapistInput.value = "";
        } else if (selectedTherapist !== null) {
            selectedTherapist.classList.remove("selected");
            therapistDiv.classList.add("selected");
            selectedTherapist = therapistDiv;
            hiddenSelectedTherapistInput.value = selectedTherapist.dataset.therapistid;
        } else if (selectedTherapist == null) {
            therapistDiv.classList.add("selected");
            selectedTherapist = therapistDiv;
            hiddenSelectedTherapistInput.value = selectedTherapist.dataset.therapistid;
        }
    }
</script>
</html>