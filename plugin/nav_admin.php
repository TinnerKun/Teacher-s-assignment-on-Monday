<?php

$file_view = basename($_SERVER['PHP_SELF']); 
$file_view = str_replace('.php', '', $file_view); 
if($file_view == 'index') $file_view = 'Dashboard';

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../assets/image/marenol.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Tinner Lnw Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/image/tinner.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['username']; ?> </a>
        </div>
      </div>
      
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php if($file_view == 'Dashboard') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($file_view == 'Dashboard') echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link <?php if($file_view == 'Dashboard') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?php if($file_view == 'users' || $file_view == 'orders' || $file_view == 'statement') echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if($file_view == 'users' || $file_view == 'orders' || $file_view == 'statement') echo 'active'; ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Table
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users.php" class="nav-link <?php if($file_view == 'users') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Control</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link <?php if($file_view == 'orders') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders list</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="statement.php" class="nav-link <?php if($file_view == 'statement') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Statement</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- $file_view and 1 char to upper case -->
            <h1 class="m-0"><?php echo ucfirst($file_view); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <!-- get file name -->
              <?php 
              ?>
              <li class="breadcrumb-item active"><?php echo $file_view; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>