<?php
require_once './db_connect.php';

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

      if (!empty($publish_date) && $publish_date != "0000-00-00") {
        $publish_date_obj = date_create($publish_date);
        $publish_date = date_format($publish_date_obj, "F j, Y");
      } else {
        $publish_date = "";
      }

      $layout = "<div class='container col-xxl-8 px-4 pt-3'>
                   <div class='row flex-lg-row-reverse align-items-center g-5 py-5'>
                     <div class='col-10 col-sm-8 col-lg-6'>
                       <img src='$image' class='d-block mx-lg-auto shadow' alt='' loading='lazy'>
                    </div>
                    <div class='col-lg-6 rounded-2 p-4'>
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
    img {
      width: 500px;
      height: auto;
    }
  </style>
</head>

<body>
  <?= $layout ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>