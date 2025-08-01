<?php
session_start();

// Not logged in, go back to login page
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
  header("location: user_login.php");
}

require_once './components/db_connect.php';
require_once './components/util.php';

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

$layout = "";

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM `medium` WHERE id=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      $id = $row['id'];
      $title = $row['title'];
      $image = $row['image'];
      $isbn_code = $row['isbn_code'] ? ("<li class='list-group-item'>ISBN: " . $row['isbn_code'] . "</li>") : "";
      $short_description = $row['short_description'];
      $type = $row['type'];
      $author_first_name = $row['author_first_name'];
      $author_last_name = $row['author_last_name'];
      $publisher_name = $row['publisher_name'];
      $publisher_address = $row['publisher_address'];
      $publish_date = $row['publish_date'];
      $status = ($row['status']) ? "Available" : "Reserved";

      $publish_date = date_format_for_display($publish_date);

      $layout = "<div class='container col-xxl-8 px-4 pt-4'>
                   <div class='row flex-lg-row-reverse align-items-start g-5 pb-5'>
                     <div class='col-12 col-sm-8 col-lg-6'>
                       <img src='$image' class='d-block mx-lg-auto shadow medium-details-img' alt='' loading='lazy'>
                    </div>
                    <div class='col-lg-6 rounded-2 p-4 p-sm-2 mt-0 mt-sm-3 mt-md-5'>
                      <h1 class='display-5 fw-bold text-body-emphasis lh-1 mb-3'>$title</h1>
                      <p class='h5 lh-base'>$short_description</p>
                      <div class='mt-3 mb-4'>
                        <ul class='list-group'>
                          <li class='list-group-item'>Type: $type</li>
                          $isbn_code
                          <li class='list-group-item'>Author: $author_first_name $author_last_name</li>
                          <li class='list-group-item'>Published: $publish_date</li>
                          <li class='list-group-item'>Publisher Name: $publisher_name</li>
                          <li class='list-group-item'>Publisher Address: $publisher_address</li>
                          <li class='list-group-item'>Status: $status</li>
                        </ul>
                      </div>
                      <div class='d-grid gap-2 d-md-flex justify-content-md-start'>
                        <a href='./index.php' class='btn btn-secondary btn-md px-4'>Back</a>
                      </div>
                    </div>
                   </div>
                 </div>";
    } else {
      echo $error_msg_general;
    }
  } else {
    echo $error_msg_general;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library - Medium Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
  <style>
    .medium-details-img {
      width: 500px;
      height: auto;
    }

    @media (width < 576px) {
      .medium-details-img {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php require_once './components/navbar.php'; ?>
  <?= $layout ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>