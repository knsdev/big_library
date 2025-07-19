<?php
require_once './db_connect.php';
require_once './media_card_layout.php';

$layout = "";
$sql = "SELECT * FROM `medium`";
$result = mysqli_query($conn, $sql);

if ($result) {
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $layout = create_media_card_layout($rows, true);
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
    <a href="./create_medium.php" class="btn btn-primary mb-4">Create new Medium</a>
    <?= $layout ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>