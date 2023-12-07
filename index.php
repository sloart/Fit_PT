<?php include "header.php"; ?>
<?php require "mysqli_connect.php" ?>

<header><center>Home page. Can redirect to login, or the users landing page where their user type will be checked. :) :)</center></header>
<header><center>Once logged in, the user's info will print out here from the session to test for now</center></header>

<?php
    // getting user info
    $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
    $user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    // redirecting to user's associated landing page
    switch ($user_type) {
        case 't':
            header("Location: therapist_landing_page.php");
            break;
            case 's':
                header("Location: scheduler_nav_page.php");
                break;
        case 'a':
            header("Location: admin_nav_page.php");
            break;
        default:
        header("Location: initial_login_page.php");
    }

?>

<?php include "footer.php"; ?>

