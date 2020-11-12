<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/CategoryContainers.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/EntityProvider.php");
require_once("includes/classes/ErrorMessage.php");
require_once("includes/classes/SeasonProvider.php");
require_once("includes/classes/Season.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoProvider.php");
require_once("includes/classes/User.php");

if(!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Chillflix</title>
        <!-- Embedding jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


        <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
        <!-- Using font awesome for buttons -->

        <script src="https://kit.fontawesome.com/c09edbcfe1.js" crossorigin="anonymous"></script>

        <script src ="assets/js/script.js"></script>
        <script defer src="assets/js/cursor.js"></script>
    </head>
    <body>
        <div class="cursor"></div>
        <div class='wrapper'>

          <?php
              if(!isset($hideNav)){
                include_once("includes/navBar.php");
              }
           ?>
