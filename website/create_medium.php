<?php
require_once './db_connect.php';
require_once './util.php';

$input_error_messages = "";
$result_message = "";
$status = 1;

if (isset($_POST['create'])) {
  $title = cleanInput($_POST['title']);
  $image = filter_var(cleanInput($_POST['image']), FILTER_SANITIZE_URL);
  $isbn_code = cleanInput($_POST['isbn_code']);
  $short_description = cleanInput($_POST['short_description']);
  $type = cleanInput($_POST['type']);
  $author_first_name = cleanInput($_POST['author_first_name']);
  $author_last_name = cleanInput($_POST['author_last_name']);
  $publisher_name = cleanInput($_POST['publisher_name']);
  $publisher_address = cleanInput($_POST['publisher_address']);
  $publish_date = cleanInput($_POST['publish_date']);
  $status = (int) filter_var(cleanInput($_POST['status']), FILTER_VALIDATE_BOOLEAN);

  if (empty($title)) {
    $input_error_messages .= 'Title is not allowed to be empty!<br />';
  }

  if (empty($type)) {
    $input_error_messages .= 'Type is not allowed to be empty!<br />';
  }

  if (empty($input_error_messages)) {
    $sql = "INSERT INTO `medium`(
    `title`,
    `image`,
    `isbn_code`,
    `short_description`,
    `type`,
    `author_first_name`,
    `author_last_name`,
    `publisher_name`,
    `publisher_address`,
    `publish_date`,
    `status`)
    VALUES (
      '$title',
      '$image',
      '$isbn_code',
      '$short_description',
      '$type',
      '$author_first_name',
      '$author_last_name',
      '$publisher_name',
      '$publisher_address',
      '$publish_date',
       $status)";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $result_message = "New medium created successfully";
      $title = null;
      $image = null;
      $isbn_code = null;
      $short_description = null;
      $type = null;
      $author_first_name = null;
      $author_last_name = null;
      $publisher_name = null;
      $publisher_address = null;
      $publish_date = null;
      $status = 1;
    } else {
      $result_message = $error_msg_general;
    }

    $conn->close();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library - Create Medium</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
  <div class="title-row">
    <h1 class="text-center">Big Library</h1>
  </div>
  <div class="container mt-2">
    <form method="POST">
      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="title">Title:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="title" id="title" value="<?= $title ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="image">Image:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="image" id="image" value="<?= $image ?? "" ?>" class=" form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="isbn_code">ISBN:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="isbn_code" id="isbn_code" value="<?= $isbn_code ?? "" ?>" class=" form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="short_description">Short Description:</label></div>
        <div class="col-8 col-sm-6 col-md-4">
          <textarea name="short_description" id="short_description" rows="10" maxlength="800" class=" form-control"><?= $short_description ?? "" ?></textarea>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="type">Type:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="type" id="type" value="<?= $type ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_first_name">Author First Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="author_first_name" id="author_first_name" value="<?= $author_first_name ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_last_name">Author Last Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="author_last_name" id="author_last_name" value="<?= $author_last_name ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_name">Publisher Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publisher_name" id="publisher_name" value="<?= $publisher_name ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_address">Publisher Address:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publisher_address" id="publisher_address" value="<?= $publisher_address ?? "" ?>" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publish_date">Publish Date:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publish_date" id="publish_date" value="<?= $publish_date ?? "" ?>" placeholder="YYYY-MM-DD" class="form-control"></div>
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
          <input type="submit" value="Create" name="create" class="btn btn-primary" style="width:200px">
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