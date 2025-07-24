<?php
session_start();

require_once './components/db_connect.php';
require_once './components/util.php';
require_once './components/file_upload.php';

if (isset($_SESSION["admin"])) {
  header("location: admin_dashboard.php");
} else if (isset($_SESSION["user"])) {
  header("location: index.php");
}

if (isset($_POST['register'])) {
  $username = clean_input($_POST['username']);
  $password = clean_input($_POST['password']);
  $email = clean_input($_POST['email']);
  $first_name = clean_input($_POST['first_name']);
  $last_name = clean_input($_POST['last_name']);
  $date_of_birth = clean_input($_POST['date_of_birth']);
  $picture = image_file_upload($_FILES['picture'], PICTURE_FOLDER_NAME);

  $error = false;

  if (empty($username)) {
    $error = true;
    $error_username = "Username must not be empty.";
  } else if (strlen($username) < USR_NAME_MIN_LENGTH) {
    $error = true;
    $error_username = "Username has to be at least " . USR_NAME_MIN_LENGTH . " characters long.";
  } else {
    $sql = "SELECT * FROM `user` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die("query failed");

    if (mysqli_num_rows($result) > 0) {
      $error = true;
      $error_username = "Username already exists.";
    }
  }

  if (empty($password)) {
    $error = true;
    $error_password = "Password must not be empty.";
  } else if (strlen($password) < PW_MIN_LENGTH) {
    $error = true;
    $error_password = "Password has to be at least " . PW_MIN_LENGTH . " characters long.";
  }

  if (empty($email)) {
    $error = true;
    $error_email = "Email must not be empty.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $error_email = "Email format is invalid.";
  } else {
    $sql = "SELECT * FROM `user` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die("query failed");

    if (mysqli_num_rows($result) > 0) {
      $error = true;
      $error_email = "Email already exists.";
    }
  }

  if ($picture[1] != ImageFileUploadResult::Success && $picture[1] != ImageFileUploadResult::NoFileUploaded) {
    $error = true;
    $picture_error = image_file_get_error_message($picture[1]);
  }

  if ($error) {
    image_file_delete($picture, PICTURE_FOLDER_NAME);
  } else {
    $password = hash("sha256", $password);

    $sql = "INSERT INTO `user` (`username`, `password`, `email`, `picture`, `first_name`, `last_name`, `date_of_birth`)
            VALUES ('$username', '$password', '$email', '$picture[0]', '$first_name', '$last_name', '$date_of_birth')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo 'Registered successfully!<br><br>';
    } else {
      image_file_delete($picture, PICTURE_FOLDER_NAME);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <div class="container">
    <form method="POST" enctype="multipart/form-data" class="mt-3" style="max-width: 500px;">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?= $username ?? "" ?>">
        <p class="text-danger"><?= $error_username ?? "" ?></p>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control">
        <p class="text-danger"><?= $error_password ?? "" ?></p>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= $email ?? "" ?>">
        <p class="text-danger"><?= $error_email ?? "" ?></p>
      </div>
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="first_name" name="first_name" id="first_name" class="form-control" value="<?= $first_name ?? "" ?>">
      </div>
      <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="last_name" name="last_name" id="last_name" class="form-control" value="<?= $last_name ?? "" ?>">
      </div>
      <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date Of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= $date_of_birth ?? "" ?>">
      </div>
      <div class="mb-3">
        <label for="picture" class="form-label">Picture</label>
        <input type="file" name="picture" id="picture" class="form-control" value="<?= $picture ?? "" ?>">
        <p class="text-danger"><?= $picture_error ?? "" ?></p>
      </div>
      <input type="submit" value="Register" name="register" class="btn btn-primary mt-3">
    </form>
    <div class="mt-5">
      <a href="user_login.php">Back</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>