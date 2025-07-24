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
  return isset($_SESSION["user"]) ? $_SESSION["user"] : $_SESSION["admin"];
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
