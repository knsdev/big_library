<?php
require_once './db_connect.php';

if (!isset($_GET['publisher_name'])) {
  echo $error_msg_general;
  exit();
}

$publisher_name = $_GET['publisher_name'];
var_dump($publisher_name);

$sql = "SELECT * FROM `medium` WHERE `publisher_name`='$publisher_name'";
$result = mysqli_query($conn, $sql);
$publishers = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo '<pre>';
var_dump($publishers);
echo '</pre>';
