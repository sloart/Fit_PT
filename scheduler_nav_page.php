<?php include "header.php"; ?>

<html lang="en">

<head>
    <title>Scheduler Dashboard</title>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/6a7c3fe12b.js" crossorigin="anonymous"></script>
</head>

<!--<body>-->

<section class="page">
    <div class="mainContainer">
        <header>Welcome Back Scheduler</header>

        <div class="formButtons">
            <input onclick="window.location.href='schedule_appointment.php'" type="button" class="button" value="New Appointment">
            <input onclick="window.location.href='scheduler_calendar.php'" type="button" class="button" value="View Calendar">
        </div>

    </div>
</section>
<!--</body>-->
</html>

<?php include "footer.php"; ?>