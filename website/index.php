<?php
require_once './db_connect.php';

$layout = "";

$sql = "SELECT * FROM `medium`";
$result = mysqli_query($conn, $sql);

if ($result) {
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($rows as $row) {
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

    $title_max_length = 30;

    if (strlen($title) > $title_max_length) {
      $title = substr($title, 0, $title_max_length - 3);
      $title .= "...";
    }

    $layout .= "<div class='col' style='width: fit-content'>
                  <div class='card mb-3' style='width: 18rem'>
                    <img src='$image' class='card-img-top' alt=''>
                    <div class='card-body'>
                      <h5 class='card-title mb-2'>$title</h5>
                      <p class='card-text mb-2'>$author_first_name $author_last_name</p>
                      <p class='card-text mb-2'>$type</p>
                      <p class='card-text'>$status</p>
                      <a href='./details.php?id=$id' class='btn btn-primary'>Details</a>
                    </div>
                  </div>
                </div>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <style>
    .card img {
      width: 100%;
      height: 450px;
      object-fit: cover;
      object-position: top;
    }
  </style>
</head>

<body>
  <div class="container mt-4">
    <a href="./create_medium.php" class="btn btn-primary mb-4">Create new Medium</a>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 justify-content-center justify-content-md-start">
      <?= $layout ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>