<?php
session_start();

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre><br>';

require_once './components/db_connect.php';
require_once './components/util.php';

// Already logged in, go to home or dashboard
if (isset($_SESSION["admin"])) {
  header("location: dashboard.php");
} else if (isset($_SESSION["user"])) {
  header("location: index.php");
}

if (isset($_POST["login"])) {
  $username_or_email = clean_input($_POST["username_or_email"]);
  $password = hash("sha256", clean_input($_POST["password"]));

  if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
    $email = $username_or_email;
    $sql = "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'";
  } else {
    $username = $username_or_email;
    $sql = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";
  }

  $result = mysqli_query($conn, $sql);

  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);

      if ($row["authority"] == "admin") {
        $_SESSION["admin"] = $row["id"];
        header("location: admin_dashboard.php");
      } else {
        $_SESSION["user"] = $row["id"];
        header("location: index.php");
      }

      $my_user_id = getMyUserIdFromSession();
      list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);
    } else {
      echo "<div class='alert alert-warning' role='alert'>
              Wrong credentials!
            </div>";
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
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <?php require_once './components/navbar.php'; ?>

  <div class="container">
    <form method="POST" class="mt-4 mb-3 d-flex flex-column justify-content-start align-items-start">
      <div>
        <div class="d-flex mb-3">
          <label for="username_or_email" class="form-label" style="flex-basis: 250px">Username/Email:</label>
          <input type="text" name="username_or_email" id="username_or_email" class="form-control" value="<?= $username_or_email ?? "" ?>">
        </div>
        <div class="d-flex mb-3">
          <label for="password" class="form-label" style="flex-basis: 250px">Password:</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div>
          <input type="submit" name="login" value="Login" class="btn btn-primary">
        </div>
      </div>
    </form>

    <a href="./user_register.php">Register new Account</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>