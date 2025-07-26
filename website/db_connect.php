<?php

$hostname = "localhost";
$username = "root";
$password = null;
$databaseName = "big_library";

$conn = new mysqli($hostname, $username, $password, $databaseName);

if (!$conn) {
  die("Database connection failed!");
}

$error_msg_general = 'Something went wrong. Please try again later.';
