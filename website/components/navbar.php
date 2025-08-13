<header class='p-0 mb-3 border-bottom title-row'>
  <div class='container'>
    <div class='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start'>
      <a href='index.php' style="text-decoration: none; color: inherit;">
        <h1 class="text-center my-0 me-3">Big Library</h1>
      </a>
      <ul class='nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0'>
        <li><a href='index.php' class='btn btn-outline-dark me-3'>Home</a></li>
        <?php if (isset($_SESSION['admin'])) { ?>
          <li><a href='admin_dashboard.php' class='btn btn-outline-dark me-3'>Dashboard</a></li>
        <?php } else { ?>
          <?php if (
            !isset($_SESSION['user']) && !isset($_SESSION['admin'])
            && !str_contains($_SERVER['SCRIPT_NAME'], 'user_login.php')
            && !str_contains($_SERVER['SCRIPT_NAME'], 'user_register.php')
          ) { ?>
            <li>
              <a href="user_login.php" class="btn btn-outline-primary me-3">Sign In</a>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>
      <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])) { ?>
        <div class='dropdown text-end'>
          <a href='#' class='d-block link-body-emphasis text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            <img src='<?= $my_profile_img_src ?>' alt='profile image' width='32' height='32' class='rounded-circle'>
          </a>
          <ul class='dropdown-menu text-small'>
            <li><a class='dropdown-item' href='user_update.php'>Profile</a></li>
            <li>
              <hr class='dropdown-divider'>
            </li>
            <li><a class='dropdown-item' href='./user_logout.php'>Sign out</a></li>
          </ul>
        </div>
      <?php } ?>
    </div>
  </div>
</header>