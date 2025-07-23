<?php
session_start();

require_once './components/db_connect.php';
require_once './components/util.php';

if (!isset($_SESSION["admin"])) {
  if (isset($_SESSION["user"])) {
    header("location: home.php");
  } else {
    header("location: login.php");
  }
}

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

$layout = "";

if (isset($_GET["id"])) {
  $user_id = $_GET["id"];
  list($row, $user_profile_img_src) = getUserData($conn, $user_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <?php
  renderNavbar($my_profile_img_src);
  ?>
  <main>
    <div class="container">
      <?= $layout ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>