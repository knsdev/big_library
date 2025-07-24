<?php
session_start();

// Not logged in as Admin, go back to login page
if (!isset($_SESSION["admin"])) {
  header("location: login.php");
}

require_once './components/db_connect.php';
require_once './components/util.php';

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

$sql = "SELECT * FROM `user`";
$result = mysqli_query($conn, $sql);
$layout = "";

if ($result) {
  $rows = mysqli_fetch_all($result, MYSQLI_BOTH);

  $num_rows = count($rows);
  $num_columns_both = count($rows[0]);
  $num_columns_single = $num_columns_both / 2;
  $keys = array_keys($rows[0]);

  $layout .= "<table class='table'>";
  $layout .= "<thead><tr>";

  for ($i = 1; $i < $num_columns_both; $i += 2) {
    if ($keys[$i] == "password") continue;

    $layout .= "<th scope='col'>" . $keys[$i] . "</th>";
  }

  $layout .= "<th scope='col'></th>"; # Tool

  $layout .= "</tr></thead>";

  for ($i = 0; $i < $num_rows; $i++) {
    $layout .= "<tr>";
    $current_user_id = $rows[$i][0];

    for ($j = 0; $j < $num_columns_single; $j++) {
      if ($keys[$j * 2 + 1] == "password") continue;

      if ($j == 0) {
        $layout .= "<th scope='row'>";
        $layout .= $rows[$i][$j];
        $layout .= "</th>";
      } else {
        $layout .= "<td>";
        $layout .= $rows[$i][$j];
        $layout .= "</td>";
      }
    }

    $layout .= "<td><a href='./user_update.php?id=$current_user_id'><i class='bi bi-pencil'></i></a></td>";
    $layout .= "</tr>";
  }

  $layout .= "</table>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <?php
  require_once './components/navbar.php';
  ?>
  <main>
    <div class="container">
      <h2 class="text-center my-4">Welcome back<br><?= $my_user_data["first_name"] . ' ' . $my_user_data["last_name"] . '!' ?></h2>
      <?= $layout ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>