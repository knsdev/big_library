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

function renderNavbar($profile_img_src)
{
  echo "
  <header class='p-3 mb-3 border-bottom'>
    <div class='container'>
      <div class='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start'>
        <ul class='nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0'>
          <li><a href='#' class='nav-link px-2 link-body-emphasis'>Home</a></li>
          <li><a href='#' class='nav-link px-2 link-secondary'>Inventory</a></li>
        </ul>
        <form method='POST' class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3' role='search'>
          <input type='search' name='search' class='form-control' placeholder='Search...' aria-label='Search'>
        </form>
        <div class='dropdown text-end'>
          <a href='#' class='d-block link-body-emphasis text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='$profile_img_src' alt='profile image' width='32' height='32' class='rounded-circle'>
          </a>
          <ul class='dropdown-menu text-small'>
            <li><a class='dropdown-item' href='#'>New project...</a></li>
            <li><a class='dropdown-item' href='#'>Settings</a></li>
            <li><a class='dropdown-item' href='#'>Profile</a></li>
            <li>
              <hr class='dropdown-divider'>
            </li>
            <li><a class='dropdown-item' href='./user_logout.php'>Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  ";
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
    $row = mysqli_fetch_assoc($result);

    if (empty($row['picture'])) {
      $my_profile_img_src = './images/user.png';
    } else {
      $my_profile_img_src = './images/' . $row['picture'];
    }
  } else {
    return null;
  }

  return [$row, $my_profile_img_src];
}
