<html>
<head>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">

<link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
<link rel="manifest" href="assets/site.webmanifest">


<!-- will try to get this styling out of the header eventually. -->
<!--<style>-->
<!--    body {-->
<!--        background-image: url("assets/images/7931.jpg");-->
<!--    }-->
<!--</style>-->
</head>

<!-- body tag starts here in header file -->
<body>
    <nav>
        <div id="nav">
             <a href="index.php"><img class="logo" src="assets/images/logo-nav-transparent.png" alt="Fit Physical Therapy logo"></a>
        </div>
                  
            <input id="menu-toggle" type="checkbox" />
            <label class='menu-button-container' for="menu-toggle">
                <div class='menu-button'></div>
            </label>

            <ul class="menu">
                <li></li> <!-- secret invisible cell at beginning of ul li-->
                <!-- <li><a href="index.html">Home</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="menu.html">Our Menu</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="wedding_cakes.html">Wedding Cakes</a></li> -->
                <?php
                session_start();
                if (isset($_SESSION['user_email'])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="initial_login_page.php">Login</a></li>';
                }
                ?>
            </ul>
    </nav>