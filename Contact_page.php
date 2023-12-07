<?php
include "header.php";
?>

<section class="page">
<div class="mainContainer">
<header><center>Contact Us Page</center></header>

<!-- About us -->
<h1><center>About us: </center></h1><br>
<p><center>The Fit Physical Therapy, is ment for the people in the office to use. What we can do is schedule anyone for an apointment weather that may be doing walk in's, call's over the phone, or making an apointment online.
For people looking for a specify therapists, we have a list of decriptions describing our professional therapists. The receptionists working up front can help 
set anyone up with their choosing. We also have some Admin's who look through the backgrounds to make any major changes.</center><p><br>

    <p><center>If you have any questions or concerns about your visit, you can send us an email, under the "Contact us here" section. Thank you!</center></p><br>

<!-- Feedback -->
<h1><center></center></h1><br>
    <center>
        <label for="email">Contact us here:</label><br>
        <input type="email" name="email" id="email" size="30" maxlength="50" required><br>
    <center>
        <input type="submit" class="button" value="Submit">
        <input type="reset" class="button" value="Reset">
    </center>
</div>
</section>

<?php
echo "<br>";
echo "<center><a href='843-555-5555'>843-555-5555</a></center>";
echo "<br>";
echo "<center><a href='mailto:fpt@fitphysicaltherapy.com'>fpt@fitphysicaltherapy.com</a></center>";
include "footer.php";
?>