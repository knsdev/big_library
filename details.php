<?php
require_once './db_connect.php';

$layout = "";

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM `medium`";
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

      $layout = "<div>
                   <div class='card' style='width: 18rem;'>
                     <img src='$image' class='card-img-top' alt=''>
                     <div class='card-body'>
                       <h5 class='card-title'>$title</h5>
                       <p class='card-text'>$short_description</p>
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
</head>

<body>
  <div class="container">
    <?= $layout ?>
  </div>
</body>

</html>