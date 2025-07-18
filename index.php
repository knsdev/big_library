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
    $author_first_name = $row['author_first_name'];
    $author_last_name = $row['author_last_name'];
    $publisher_name = $row['publisher_name'];
    $publisher_address = $row['publisher_address'];
    $publish_date = $row['publish_date'];

    $layout .= "<div>
                  <div class='card' style='width: 18rem;'>
                    <img src='$image' class='card-img-top' alt=''>
                    <div class='card-body'>
                      <h5 class='card-title'>$title</h5>
                      <p class='card-text'>$short_description</p>
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
</head>

<body>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4">
      <?= $layout ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>