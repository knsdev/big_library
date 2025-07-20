<?php
require_once './db_connect.php';
require_once './media_card_layout.php';
require_once './modal.php';

if (!isset($_GET['publisher_name'])) {
  echo $error_msg_general;
  exit();
}

$layout = "";

$publisher_name = $_GET['publisher_name'];
// var_dump($publisher_name);

$sql = "SELECT * FROM `medium` WHERE `publisher_name`='$publisher_name'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo '<pre>';
// var_dump($rows);
// echo '</pre>';

$layout = create_media_card_layout($rows, false);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $publisher_name ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/media_card_layout.css">
</head>

<body>
  <div class="title-row mb-3">
    <h1 class="text-center">Big Library</h1>
  </div>
  <div class="container">
    <div class="d-flex justify-content-start">
      <button type="button" class="btn" id="toggle-edit"><i class="bi bi-eye"></i></button>
    </div>
    <h2 class="mt-3 mb-4"><span class="text-dark-emphasis">Publisher:</span> <span class="text-dark fw-bold"><?= $publisher_name ?></span></h2>
    <?= $layout ?>
    <a href='./index.php' class='btn btn-secondary btn-md px-4'>Back</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="./js/modal.js"></script>
  <script>
    <?php create_js_id_map($rows); ?>
    setup_delete_buttons_to_open_modal(idMap);
  </script>
  <script src="./js/toggle_edit.js"></script>
</body>

</html>