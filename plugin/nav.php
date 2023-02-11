<!-- nav and check login show button right -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Tinner Lnw Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
      <!-- no session show button register and login session show dropdown edit profile and logout -->
        <?php if(!isset($_SESSION['id'])) { ?>
            <!-- color register yellow and login blue -->

            <a href="register.php" class="btn btn-warning me-2">Register</a>
            <a href="login.php" class="btn btn-primary">Login</a>
            
        <?php } else { ?>
            <div class="dropdown">
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['user']->username ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="add_money.php">Balance <?php echo number_format($_SESSION['balance'], 0, '.', ',');?> ฿</a></li>
                    <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                    <?php if($_SESSION['permission'] > 0) { ?>
                        <hr>
                        <li><a class="dropdown-item" href="../dashboard/index.php">Admin</a></li>
                    <?php } ?>
                    <hr>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
  </div>
</nav>