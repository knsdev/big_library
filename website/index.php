<?php
require_once './db_connect.php';
require_once './media_card_layout.php';

$layout = "";
$sql = "SELECT * FROM `medium`";

if (isset($_POST['search'])) {
  $search_value = $_POST['search'];
  $sql = "SELECT * FROM `medium`
          WHERE `title` LIKE '$search_value%'
             OR `author_first_name` LIKE '$search_value%'
             OR `author_last_name` LIKE '$search_value%'
             OR `publisher_name` LIKE '$search_value%'
             OR `type` LIKE '$search_value%'";
}

$result = mysqli_query($conn, $sql);

if ($result) {
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $layout = create_media_card_layout($rows, true);
}

if (isset($_POST['search'])) {
  $layout .= "<a href='./index.php' class='btn btn-secondary btn-md px-4'>Back</a>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="media_card_layout.css">
</head>

<body>
  <div class="container mt-4">
    <div class="row mb-4 justify-content-between justify-content-md-start">
      <div class="col-12 col-sm-5 col-md-4 mb-3 mb-sm-0">
        <a href="./create_medium.php" class="btn btn-primary">Create new Medium</a>
      </div>
      <div class="col-12 col-sm-6 col-md-4">
        <form role="search" method="POST">
          <input name="search" type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>
      </div>
    </div>
    <?= $layout ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>