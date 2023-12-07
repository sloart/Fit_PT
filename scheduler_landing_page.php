<?php
include "header.php";
?>

<!-- begin page content -->

    <p style='text-align: center;'>This is the first page a system user of type <strong>scheduler</strong> will see upon entering their credentials at login.</p>
       
    <?php
    $months = [
      1 => "January", 2 => "Febuary", 3 => "March", 4 => "April",
      5 => "May", 6 => "June", 7 => "July", 8 => "August",
      9 => "September", 10 => "October", 11 => "November", 12 => "December"
    ];
    $monthNow = date("m");
    $yearNow = date("Y"); ?>

    <section id="calendar">
        <!-- period selector -->
        <div id="calendarHeader">
        <div id="periodSelector">
            <input id="todayBtn" type="button" value="Today">
            <input id="backBtn" type="button" class="mi" value="&lt;">
            <select id="selectMonth"><?php foreach ($months as $m=>$mth) {
            printf("<option value='%u'%s>%s</option>",
                $m, $m==$monthNow?" selected":"", $mth
            );
            } ?></select>
            <input id="selectYear" type="number" value="<?=$yearNow?>">
            <input id="nextBtn" type="button" class="mi" value="&gt;">
        </div>
        <input id="addBtn" type="button" value="+">
        </div>

        <!-- calendar wrapper -->
        <div id="calendarWrapper">
        <div id="calendarDays"></div>
        <div id="calendarBody"></div>
        </div>

        <!-- event popout form -->
        <dialog id="calendarForm">
            <form method="dialog">
            <div id="evtCX">X</div>
            <h2 class="evt100">Add/Edit Appointment</h2>
            <div class="evt50">
                <label>Start</label>
                <input id="evtStart" type="datetime-local" required>
            </div>
            <div class="evt50">
                <label>End</label>
                <input id="evtEnd" type="datetime-local" required>
            </div>
            <div class="evt100">
                <label>Patient Name</label>
                <input id="patientName" type="text" autocomplete="off" required>
            </div>
            <div class="evt100">
                <label>Patient Phone</label>
                <input id="patientPhone" type="text" autocomplete="off" required>
            </div>
            <div class="evt100">
                <label>Patient Email</label>
                <input id="patientEmail" type="text" autocomplete="off" required>
            </div>
            <div class="evt100">
                <label>Event</label>
                <input id="evtTxt" type="text" autocomplete="off" required>
            </div>
            <div class="evt100">
                <input type="hidden" id="apptId">
                <input type="button" id="deleteBtn" value="Delete">
                <input type="submit" id="saveBtn" value="Save">
            </div>
            </form>
        </dialog>
    </section>
<!-- end page content -->
 
 <?php
 include "footer.php";
?>