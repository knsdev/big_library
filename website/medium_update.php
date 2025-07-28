<?php
session_start();

if (!isset($_SESSION["admin"])) {
  header("location: user_login.php");
}

require_once './components/db_connect.php';
require_once './components/util.php';

$my_user_id = getMyUserIdFromSession();
list($my_user_data, $my_profile_img_src) = getUserData($conn, $my_user_id);

$input_error_messages = "";
$result_message = "";
$id = null;
$row = null;

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM `medium` WHERE id=$id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      $id = $row['id'];
    } else {
      exit($error_msg_general);
    }
  } else {
    exit($error_msg_general);
  }
} else {
  exit($error_msg_general);
}

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
$status = $row['status'];

// Handle POST request 'update'
if (isset($_POST['update'])) {
  $title = clean_input($_POST['title']);
  $image = filter_var(clean_input($_POST['image']), FILTER_SANITIZE_URL);
  $isbn_code = clean_input($_POST['isbn_code']);
  $short_description = clean_input($_POST['short_description']);
  $type = clean_input($_POST['type']);
  $author_first_name = clean_input($_POST['author_first_name']);
  $author_last_name = clean_input($_POST['author_last_name']);
  $publisher_name = clean_input($_POST['publisher_name']);
  $publisher_address = clean_input($_POST['publisher_address']);
  $publish_date = clean_input($_POST['publish_date']);
  $status = (int) filter_var(clean_input($_POST['status']), FILTER_VALIDATE_BOOLEAN);

  if (empty($title)) {
    $input_error_messages .= 'Title is not allowed to be empty!<br />';
  }

  if (empty($type)) {
    $input_error_messages .= 'Type is not allowed to be empty!<br />';
  }

  if (empty($input_error_messages)) {
    $sql = "UPDATE `medium` SET
    `title` = '$title',
    `image` = '$image',
    `isbn_code` = '$isbn_code',
    `short_description` = '$short_description',
    `type` = '$type',
    `author_first_name` = '$author_first_name',
    `author_last_name` = '$author_last_name',
    `publisher_name` = '$publisher_name',
    `publisher_address` = '$publisher_address',
    `publish_date` = '$publish_date',
    `status` = $status
    WHERE `id` = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $result_message = "Medium updated successfully!";
    } else {
      $result_message = $error_msg_general;
    }
  }
  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library - Update Medium</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <?php require_once './components/navbar.php'; ?>

  <div class="container mt-2">
    <form method="POST">
      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="title">Title:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $title ?>" type="text" name="title" id="title" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="image">Image:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $image ?>" type="text" name="image" id="image" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="isbn_code">ISBN:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $isbn_code ?>" type="text" name="isbn_code" id="isbn_code" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="short_description">Short Description:</label></div>
        <div class="col-8 col-sm-6 col-md-4">
          <textarea name="short_description" id="short_description" rows="10" maxlength="800" class="form-control"><?= $short_description ?></textarea>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="type">Type:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $type ?>" type="text" name="type" id="type" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_first_name">Author First Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $author_first_name ?>" type="text" name="author_first_name" id="author_first_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_last_name">Author Last Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $author_last_name ?>" type="text" name="author_last_name" id="author_last_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_name">Publisher Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $publisher_name ?>" type="text" name="publisher_name" id="publisher_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_address">Publisher Address:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $publisher_address ?>" type="text" name="publisher_address" id="publisher_address" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publish_date">Publish Date:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input value="<?= $publish_date ?>" type="text" name="publish_date" id="publish_date" placeholder="YYYY-MM-DD" class="form-control"></div>
      </div>

      <div class="row mb-4">
        <div class="col-3 col-md-2"><label class="form-label" for="status">Status:</label></div>
        <div class="col-8 col-sm-6 col-md-4">
          <select name="status" id="status" class="form-select">
            <option value="1" <?= ($status != 0) ? 'selected' : '' ?>>Available</option>
            <option value="0" <?= ($status == 0) ? 'selected' : '' ?>>Reserved</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-3 col-md-2"></div>
        <div class="col-8 col-sm-6 col-md-4 d-flex gap-3 align-items-start">
          <input type="submit" value="Update" name="update" class="btn btn-success" style="width:200px">
        </div>
        <div class="col">
          <div>
            <?= $input_error_messages ?>
            <?= $result_message ?>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"></div>
        <div class="col-8 col-sm-6 col-md-4">
          <a href="./index.php" class="btn btn-secondary" style="width:200px">Back</a>
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>