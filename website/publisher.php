<?php
session_start();

// Not logged in, go back to login page
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
  header("location: user_login.php");
}

require_once './components/db_connect.php';
require_once './components/media_card_layout.php';
require_once './components/modal.php';
require_once './components/util.php';

if (!isset($_GET['publisher_name'])) {
  echo $error_msg_general;
  exit();
}

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

$layout = "";

$publisher_name = $_GET['publisher_name'];

$sql = "SELECT * FROM `medium` WHERE `publisher_name`='$publisher_name'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
  <?php require_once './components/navbar.php'; ?>

  <div class="container">
    <?php if (isset($_SESSION['admin'])) { ?>
      <div class="d-flex justify-content-start">
        <button type="button" class="btn" id="toggle-edit"><i class="bi bi-eye"></i></button>
      </div>
    <?php } ?>
    <h2 class="mt-3 mb-4"><span class="text-dark-emphasis">Publisher:</span> <span class="text-dark fw-bold"><?= $publisher_name ?></span></h2>
    <?= $layout ?>
    <a href='./index.php' class='btn btn-secondary btn-md px-4'>Back</a>
  </div>

  <?php if (isset($_SESSION['admin'])) { ?>
    <script src="./js/modal.js"></script>
    <script>
      <?php create_js_id_map($rows); ?>
      setup_delete_buttons_to_open_modal(idMap);
    </script>
    <script src="./js/toggle_edit.js"></script>
  <?php } ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>