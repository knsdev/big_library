<header class='p-0 mb-3 border-bottom title-row'>
  <div class='container'>
    <div class='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start'>
      <a href='index.php' style="text-decoration: none; color: inherit;">
        <h1 class="text-center my-0 me-2">Big Library</h1>
      </a>
      <ul class='nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0'>
        <?php if (isset($_SESSION['admin'])) { ?>
          <li><a href='index.php' class='nav-link px-2 link-body-emphasis'>Home</a></li>
          <li><a href='admin_dashboard.php' class='nav-link px-2 link-body-emphasis'>Dashboard</a></li>
        <?php } ?>
        <!-- <li><a href='#' class='nav-link px-2 link-secondary'>Inventory</a></li> -->
      </ul>
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
    </div>
  </div>
</header>