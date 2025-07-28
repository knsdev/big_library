<?php

define("USR_NAME_MIN_LENGTH", 4);
define("PW_MIN_LENGTH", 5);
define("PICTURE_FOLDER_NAME", "images");

function clean_input($str)
{
  $result = trim($str);
  $result = strip_tags($result);
  $result = htmlspecialchars($result);
  return $result;
}

function getMyUserIdFromSession()
{
  if (isset($_SESSION["user"])) {
    return $_SESSION["user"];
  } else if (isset($_SESSION["admin"])) {
    return $_SESSION["admin"];
  } else {
    return null;
  }
}

function getUserData($conn, $user_id)
{
  $sql = "SELECT * FROM `user` WHERE `id`='$user_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    if (mysqli_num_rows($result) != 1) {
      return [null, null];
    }

    $row = mysqli_fetch_assoc($result);

    if (empty($row['picture'])) {
      $my_profile_img_src = './images/user.png';
    } else {
      $my_profile_img_src = './images/' . $row['picture'];
    }
  } else {
    return [null, null];
  }

  return [$row, $my_profile_img_src];
}

function date_format_for_database($dateVal)
{
  $default_date_value = "1970-01-01";

  if (empty($dateVal) || $dateVal == "0000-00-00") {
    return $default_date_value;
  }

  $dateValObj = date_create($dateVal);

  if (!$dateValObj)
    return $default_date_value;

  return date_format($dateValObj, "Y-m-d");
}

function date_format_for_display($dateVal)
{
  if (!empty($dateVal) && $dateVal != "0000-00-00") {
    $dateValObj = date_create($dateVal);

    if (!$dateValObj)
      return "";

    return date_format($dateValObj, "F j, Y");
  }

  return "";
}
