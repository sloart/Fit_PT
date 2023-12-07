<?php include "header.php"; ?>

<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/6a7c3fe12b.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</head>

<!--<body>-->

<section class="page">
    <div class="mainContainer" id="initialSelections">
        <header>Welcome Back Admin</header>

        <div class="formButtons">
            <input onclick="openAddTherapistPopup()" type="button" class="button" value="Add New Therapist">
            <input onclick="window.location.href='search_therapist_handler.php'" type="button" class="button" value="Modify/Remove Therapist">
            <input onclick="window.location.href='admin_calendar.php'" type="button" class="button" value="View Calendar">
        </div>

    </div>
</section>

<!--</body>-->

</html>

<?php include "search_therapist_popup.php"; ?>
<?php include "add_new_therapist_popup.php"; ?>

<?php include "footer.php"; ?>
