<?php
// this file is used to connect our database with backend
// Do not alter !!!!
ob_start(); // Turns on output buffering
// i.e waits untill the whole page was loaded
session_start(); // starting the session

// The date_default_timezone_set() function sets the default timezone used by     all date/time functions in the script.
date_default_timezone_set('Asia/Kolkata');
// echo date('d-m-Y H:i'); // to verify TimeZone

// for Catching errors and exception using try - catch 
try {
    // setup PDO connection
    $con = new PDO("mysql:dbname=chillflix;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>

