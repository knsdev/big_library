<?php

$dbHostname = "localhost";
$dbUsername = "root";
$dbPassword = null;
$dbName = "big_library";

$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Database connection failed!");
}

$error_msg_general = 'Something went wrong. Please try again later.';
