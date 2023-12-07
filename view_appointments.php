<?php
global $connection;
include "header.php";
?>

<section class="page">
    <div class="popup" id="appointments">

        <?php

        require "mysqli_connect.php";

        if ($connection) {

            // getting date from url if it exists
            $date = isset($_GET['date']) ? $_GET['date'] : '';

            // getting user info
            $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

            // if date exists...
            if ($date) {
                echo '<header>' . $date . '</header>';

                if ($user_type == 't') {
                    $get_appointments_by_date_query = "SELECT patient_name AS 'patient name', start_time AS 'start time', intake_notes as 'intake notes',
                        certifications.type_of_therapy AS 'type of therapy', patient_phone AS 'patient phone', patient_email AS 'patient email' FROM appointments INNER JOIN certifications ON
                        appointments.type_of_therapy=certifications.name_short WHERE DATE(appointments.appointment_date) = '" . $date . "' AND appointments.therapist_id = '" . $user_id . "' ORDER BY FIELD(start_time, 8,9,10,11,12,1,2,3,4,5);";
                    $appointments_by_date_result = mysqli_query($connection, $get_appointments_by_date_query);

                    if ($appointments_by_date_result) {
                        echo '<div class="table_container">';
                        echo '<table class="sortable">
                                <thead>
                                <tr>
                                    <th class="sortable">Patient Name</th>
                                    <th class="sortable">Therapy Type</th>
                                    <th class="sortless">Start Time</th>
                                    <th class="sortless">Intake Notes</th>
                                </tr>
                                </thead>
                            <tbody>';

                        // populating therapist's appointments
                        while ($row = mysqli_fetch_assoc($appointments_by_date_result)) {
                            if ($row['start time'] >=8 && $row['start time'] <= 11) {
                                $timeString = $row['start time'] . 'AM';
                            // } else if ($row['start time'] == 12) {
                            //     $timeString = $row['start time'] . 'PM';
                            } else {
                                $timeString = $row['start time'] . 'PM';
                            }
                            echo '<tr>
                                <td>' . $row['patient name'] . '</td>'
                                . '<td>' . $row['type of therapy'] . '</td>'
                                . '<td>' . $timeString . '</td>'
                                . '<td>' . $row['intake notes'] . '</td>
                                </tr>';
                        }

                        echo '</tbody></table>';
                        echo '</div>';

                        mysqli_free_result($appointments_by_date_result);
                    } else {
                        echo '<p class="error">Error running the query: ' . mysqli_error($connection) . '</p>';
                    }
                } else {
                    // scheduler with date selected

                    // TODO ADD THERAPIST NAME TO QUERY
                    $get_appointments_by_date_query = "SELECT patient_name AS 'patient name', start_time AS 'start time', intake_notes as 'intake notes',
                        certifications.type_of_therapy AS 'type of therapy', appointments.appt_id, patient_phone AS 'patient phone', patient_email AS 'patient email', system_users.user_name AS 'therapist name' FROM appointments INNER JOIN certifications ON
                        appointments.type_of_therapy=certifications.name_short INNER JOIN system_users ON appointments.therapist_id=system_users.user_id WHERE DATE(appointments.appointment_date) = '" . $date . "' ORDER BY FIELD(start_time, 8,9,10,11,12,1,2,3,4,5);";
                    $appointments_by_date_result = mysqli_query($connection, $get_appointments_by_date_query);

                    if ($appointments_by_date_result) {
                        echo '<div class="table_container">';
                        echo '<table class="sortable">
                                <thead>
                                <tr>
                                    <th class="sortable">Therapist Name</th>
                                    <th class="sortable">Patient Name</th>
                                    <th class="sortable">Therapy Type</th>
                                    <th class="sortless">Start Time</th>
                                    <th class="sortless">Patient Email</th>
                                    <th class="sortless">Patient Phone</th>
                                    <th class="sortless">Intake Notes</th>
                                    <th class="sortless">Cancel Appointment</th>
                                </tr>
                                </thead>
                            <tbody>';

                        // populating therapist's appointments
                        while ($row = mysqli_fetch_assoc($appointments_by_date_result)) {
                            if ($row['start time'] >=8 && $row['start time'] <= 11) {
                                $timeString = $row['start time'] . 'AM';
                            // } else if ($row['start time'] == 12) {
                            //     $timeString = $row['start time'] . 'PM';
                            } else {
                                $timeString = $row['start time'] . 'PM';
                            }
                            echo '<tr>'
                            . '<td>' . $row['therapist name'] . '</td>'
                            . '<td>' . $row['patient name'] . '</td>'
                            . '<td>' . $row['type of therapy'] . '</td>'
                            . '<td>' . $timeString . '</td>'
                            . '<td>' . $row['patient email'] . '</td>'
                            . '<td>' . $row['patient phone'] . '</td>'
                            . '<td class="truncate" title="' . htmlspecialchars($row['intake notes']) . '">' . $row['intake notes'] . '</td>'
                            . '<td><a href="cancel_appointment.php?id=' . $row['appt_id'] . '"><input type="submit" class="smallerButtonsRed" name="cancelBtn" value="Cancel"></a></td>'
                            . '</tr>';
                        }

                        echo '</tbody></table>';
                        echo '</div>';

                        mysqli_free_result($appointments_by_date_result);
                    } else {
                        echo '<p class="error">Error running the query: ' . mysqli_error($connection) . '</p>';
                    }
                }
            } else {
                // if no date selected

                //if scheduler and no date
                if ($user_type == 's') {
                    $get_all_appointments_query = "SELECT patient_name AS 'patient name', start_time AS 'start time', intake_notes as 'intake notes',
                    certifications.type_of_therapy AS 'type of therapy', appointments.appt_id, patient_phone AS 'patient phone', patient_email AS 'patient email', system_users.user_name AS 'therapist name'
                    FROM appointments
                    INNER JOIN certifications ON appointments.type_of_therapy=certifications.name_short
                    INNER JOIN system_users ON appointments.therapist_id=system_users.user_id
                    ORDER BY FIELD(start_time, 8,9,10,11,12,1,2,3,4,5);";
                    $appointments_result = mysqli_query($connection,  $get_all_appointments_query);

                    if ($appointments_result) {
                        echo '<div class="table_container">';
                        echo '<table class="sortable">
                            <thead>
                            <tr>
                                <th class="sortable">Therapist Name</th>
                                <th class="sortable">Patient Name</th>
                                <th class="sortable">Therapy Type</th>
                                <th class="sortless">Start Time</th>
                                <th class="sortless">Patient Email</th>
                                <th class="sortless">Patient Phone</th>
                                <th class="sortless">Intake Notes</th>
                                <th class="sortless">Edit Appointment</th>
                            </tr>
                            </thead>
                        <tbody>';

                        // populating therapist's appointments
                        while ($row = mysqli_fetch_assoc($appointments_result)) {
                            if ($row['start time'] >=8 && $row['start time'] <= 11) {
                                $timeString = $row['start time'] . 'AM';
                            // } else if ($row['start time'] == 12) {
                            //     $timeString = $row['start time'] . 'PM';
                            } else {
                                $timeString = $row['start time'] . 'PM';
                            }
                            // add therapist name & DATE & EDIT BUTTON
                            echo '<tr>'
                                . '<td>' . $row['therapist name'] . '</td>'
                                . '<td>' . $row['patient name'] . '</td>'
                                . '<td>' . $row['type of therapy'] . '</td>'
                                . '<td>' . $timeString . '</td>'
                                . '<td>' . $row['patient email'] . '</td>'
                                . '<td>' . $row['patient phone'] . '</td>'
                                . '<td class="truncate" title="' . htmlspecialchars($row['intake notes']) . '">' . $row['intake notes'] . '</td>'
                                . '<td><a href="edit_appointment.php?id=' . $row['appt_id'] . '"><input type="button" value="EDIT"></a></td>'
                                . '</tr>';
                        }

                        echo '</tbody></table>';
                        echo '</div>';

                        mysqli_free_result($appointments_result);
                    } else {
                        echo '<p class="error">Error running the query: ' . mysqli_error($connection) . '</p>';
                    }
                }
            }
        } else {
            echo '<p class="error">Database connection failed: ' . mysqli_connect_error() . '</p>';
        }
        ?>
        <div class="formButtons">
            <input id="backBtn" onclick="window.location.href = 'scheduler_calendar.php'" type="button" class="button" value="Back">
        </div>
    </div>
</section>

<!--handles making some of the columns sortable-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
        const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

        document.querySelectorAll('.sortable th').forEach(th => th.addEventListener('click', (() => {
            const table = th.closest('table');
            const tbody = table.querySelector('tbody');
            Array.from(tbody.querySelectorAll('tr'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => tbody.appendChild(tr) );
        })));
    });
</script>

<?php
mysqli_close($connection);
include "footer.php";
?>