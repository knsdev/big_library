<?php
session_start();

require_once './components/db_connect.php';
require_once './components/util.php';
require_once './components/file_upload.php';

// Check Session Data
$isAdmin = isset($_SESSION["admin"]);
$isUser = isset($_SESSION["user"]);

if (!$isAdmin && !$isUser) {
  header("location: user_login.php");
}

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

// Get User Id
if ($isAdmin) {
  if (isset($_GET["id"]))
    $user_id = $_GET["id"];
  else
    $user_id = getMyUserIdFromSession();
} else if ($isUser) {
  $user_id = getMyUserIdFromSession();
} else {
  header("location: user_login.php");
}

list($user_data, $profile_img_src) = getUserData($conn, $user_id);

if (!$user_data) {
  die("Failed to get user data for id: " . $user_id);
}

$username = $user_data['username'];
$email = $user_data['email'];
$first_name = $user_data['first_name'];
$last_name = $user_data['last_name'];
$date_of_birth = $user_data['date_of_birth'];

if (!empty($user_data['picture'])) {
  $picture = [$user_data['picture'], ImageFileUploadResult::Success];
} else {
  $picture = ["", ImageFileUploadResult::NoFileUploaded];
}

if (isset($_POST['update'])) {
  $username = clean_input($_POST['username']);
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
  } else if ($username != $user_data['username']) {
    $sql = "SELECT * FROM `user` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die("query failed");

    if (mysqli_num_rows($result) > 0) {
      $error = true;
      $error_username = "Username already exists.";
    }
  }

  if (empty($email)) {
    $error = true;
    $error_email = "Email must not be empty.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $error_email = "Email format is invalid.";
  } else if ($email != $user_data['email']) {
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
    $sql = "UPDATE `user`
            SET `username`='$username', `email`='$email', `picture`='$picture[0]',
                `first_name`='$first_name', `last_name`='$last_name', `date_of_birth`='$date_of_birth'
            WHERE `id`=$user_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo 'Updated user successfully!<br><br>';
    } else {
      image_file_delete($picture, PICTURE_FOLDER_NAME);
      echo 'Failed to update user!<br><br>';
    }
  }
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
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <?php
  require_once './components/navbar.php';
  ?>
  <main>
    <div class="container">
      <form method="POST" enctype="multipart/form-data" class="mt-3" style="max-width: 500px;">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?= $username ?? "" ?>">
          <p class="text-danger"><?= $error_username ?? "" ?></p>
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
          <input type="file" name="picture" id="picture" class="form-control">
          <p class="text-danger"><?= $picture_error ?? "" ?></p>
        </div>
        <input type="submit" value="Update" name="update" class="btn btn-primary mt-3">
      </form>
      <div class="mt-5">
        <a href="<?= $isAdmin ? "admin_dashboard.php" : "index.php" ?>">Back</a>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>