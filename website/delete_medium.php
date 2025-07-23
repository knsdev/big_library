<?php
require_once './components/db_connect.php';

if ($_GET['id']) {
  $id = $_GET['id'];
  $sql = "DELETE FROM `medium` WHERE id=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("location: index.php");
  } else {
    echo 'Error: Failed to delete database entry.';
    header("refresh: 2; url: index.php");
  }
} else {
  header("location: index.php");
}
