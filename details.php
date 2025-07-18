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
      $isbn_code = $row['isbn_code'];
      $short_description = $row['short_description'];
      $type = $row['type'];
      $author_first_name = $row['author_first_name'];
      $author_last_name = $row['author_last_name'];
      $publisher_name = $row['publisher_name'];
      $publisher_address = $row['publisher_address'];
      $publish_date = $row['publish_date'];
      $status = ($row['status']) ? "Available" : "Reserved";

      $layout = "<div>
                   <div class='card' style='width: 18rem;'>
                     <img src='$image' class='card-img-top' alt=''>
                     <div class='card-body'>
                       <h5 class='card-title'>$title</h5>
                       <p class='card-text'>$short_description</p>
                       <p class='card-text'>Type: $type</p>
                       <p class='card-text'>ISBN: $isbn_code</p>
                       <p class='card-text'>Author: $author_first_name $author_last_name</p>
                       <p class='card-text'>Published on $publish_date by $publisher_name, $publisher_address</p>
                       <p class='card-text'>$status</p>
                       <a href='./index.php' class='btn btn-secondary'>Back</a>
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
  <title>Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-4">
    <?= $layout ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>