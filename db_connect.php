<?php

$hostname = "localhost";
$username = "root";
$password = null;
$databaseName = "be25_exam4_kimschlueter_biglibrary";

$conn = mysqli_connect($hostname, $username, $password, $databaseName);

if (!$conn) {
  die("Database connection failed!");
}

$error_msg_general = 'Something went wrong. Please try again later.';
