<?php
require_once './db_connect.php';

$input_error_messages = "";
$result_message = "";

function insert_new_medium()
{
  global $conn;
  global $input_error_messages;
  global $result_message;

  $title = $_POST['title'];
  $image = $_POST['image'];
  $isbn_code = $_POST['isbn_code'];
  $short_description = $_POST['short_description'];
  $type = $_POST['type'];
  $author_first_name = $_POST['author_first_name'];
  $author_last_name = $_POST['author_last_name'];
  $publisher_name = $_POST['publisher_name'];
  $publisher_address = $_POST['publisher_address'];
  $publish_date = $_POST['publish_date'];
  $status = (int) filter_var($_POST['status'], FILTER_VALIDATE_BOOLEAN);

  if (empty($title)) {
    $input_error_messages .= 'Title is not allowed to be empty!<br />';
  }

  if (empty($type)) {
    $input_error_messages .= 'Type is not allowed to be empty!<br />';
  }

  if ($input_error_messages)
    return;

  // echo '<pre>';
  // var_dump($_POST);
  // echo '</pre>';

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
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $statement = $conn->prepare($sql);

  $statement->bind_param(
    "ssssssssssi",
    $title,
    $image,
    $isbn_code,
    $short_description,
    $type,
    $author_first_name,
    $author_last_name,
    $publisher_name,
    $publisher_address,
    $publish_date,
    $status
  );

  if ($statement->execute()) {
    $result_message = "New medium created successfully";
  } else {
    $result_message = "Error: " . $statement->error;
  }

  $statement->close();
}

if (isset($_POST['create'])) {
  insert_new_medium();
  $conn->close();
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
  <div class="container mt-4">
    <form method="POST">
      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="title">Title:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="title" id="title" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="image">Image:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="image" id="image" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="isbn_code">ISBN:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="isbn_code" id="isbn_code" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="short_description">Short Description:</label></div>
        <div class="col-8 col-sm-6 col-md-4">
          <textarea name="short_description" id="short_description" rows="10" maxlength="800" class="form-control"></textarea>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="type">Type:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="type" id="type" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_first_name">Author First Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="author_first_name" id="author_first_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="author_last_name">Author Last Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="author_last_name" id="author_last_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_name">Publisher Name:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publisher_name" id="publisher_name" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publisher_address">Publisher Address:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publisher_address" id="publisher_address" class="form-control"></div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"><label class="form-label" for="publish_date">Publish Date:</label></div>
        <div class="col-8 col-sm-6 col-md-4"><input type="text" name="publish_date" id="publish_date" class="form-control"></div>
      </div>

      <div class="row mb-4">
        <div class="col-3 col-md-2"><label class="form-label" for="status">Status:</label></div>
        <div class="col-8 col-sm-6 col-md-4">
          <select name="status" id="status" class="form-select">
            <option value="1">Available</option>
            <option value="0">Reserved</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-3 col-md-2"></div>
        <div class="col-8 col-sm-6 col-md-4">
          <input type="submit" value="Create" name="create" class="btn btn-primary" style="width:50%">
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"></div>
        <div class="col-8 col-sm-6 col-md-4">
          <a href="./index.php" class="btn btn-secondary" style="width:50%">Back</a>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-3 col-md-2"></div>
        <div class="col-8 col-sm-6 col-md-4">
          <?= $input_error_messages ?>
          <?= $result_message ?>
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>