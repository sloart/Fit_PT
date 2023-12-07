<?php
include "header.php";
?>

<section class="page">
<div class="mainContainer">

<?php
include 'calendar.php';
$calendar = new Calendar();
echo $calendar->show();
?>

<!-- Begin page content -->

<?php
$months = [
  1 => "January", 2 => "February", 3 => "March", 4 => "April",
  5 => "May", 6 => "June", 7 => "July", 8 => "August",
  9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$monthNow = date("m");
$yearNow = date("Y");
?>

    <div class="formButtons">
        <input id="backBtn" onclick="window.location.href = 'index.php'" type="button" class="button" value="Back">
    </div>

</div>
</section>

<!-- End page content -->

<?php
include "footer.php";
?>
