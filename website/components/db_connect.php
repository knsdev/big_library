<?php

$dbHostname = "localhost";
$dbUsername = "root";
$dbPassword = null;
$dbName = "be25_exam4_kimschlueter_biglibrary";

$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Database connection failed!");
}

$error_msg_general = 'Something went wrong. Please try again later.';
