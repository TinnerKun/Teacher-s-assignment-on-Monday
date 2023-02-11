<?php
session_start();

if(!isset($_SESSION['id'])) return header('Location: ../pages/login.php?error=กรุณาเข้าสู่ระบบก่อน');

include '../config/connect.php';

// check permission
if($_SESSION['permission'] < 1) return header('Location: ../pages/index.php?error=คุณไม่มีสิทธิ์เข้าถึงหน้านี้');

// get count user from database
$sql_users = "SELECT COUNT(*) AS count FROM users WHERE 1";
$stmt_users = $pdo->prepare($sql_users);
$stmt_users->execute();
$count_user = $stmt_users->fetch()->count;

// get count order from database
// SELECT `id`, `id_user`, `id_ product`, `timestamp` FROM `order` WHERE 1
$sql_order = "SELECT COUNT(*) AS count FROM `order` WHERE 1";
$stmt_order = $pdo->prepare($sql_order);
$stmt_order->execute();
$count_order = $stmt_order->fetch()->count;

// get count topup from database
// SELECT `id`, `id_user`, `voucher_code`, `balance`, `timestamp` FROM `topup` WHERE 1
$sql_topup = "SELECT COUNT(*) AS count FROM topup WHERE 1";
$stmt_topup = $pdo->prepare($sql_topup);
$stmt_topup->execute();
$count_topup = $stmt_topup->fetch()->count;

$count_view = number_format(@file_get_contents('../pages/count.txt'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tinner Lnw Shop | Dashboard 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Kanit', sans-serif;
    }
  </style></head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<?php include '../plugin/toast.php'; ?>
<div class="wrapper">
  <?php include '../plugin/nav_admin.php'; ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $count_order; ?></h3>

                <p>Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $count_view; ?></h3>

                <p>View Web Site</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $count_user; ?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $count_topup; ?></h3>

                <p>Voucher Redeem</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
    </div>

    <div class="content">
    <div class="row">

    <div class="col-lg-6">
    <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">ประวัติผู้เติมเงิน</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>ชื่อผู้เติม</th>
                    <th>รหัสบัตร</th>
                    <th>จำนวนเงิน</th>
                    <th>วันที่เติม</th>
                  </tr>
                  </thead>
                  <tbody>
                    <!-- 
                      SELECT `id`, `id_user`, `voucher_code`, `balance`, `timestamp` FROM `topup` WHERE 1
                      SELECT `id`, `username`, `password`, `ban`, `permission`, `balance` FROM `users` WHERE 1

                      // get user name in users table
                      // get balance in topup table

                     -->
                    <?php
                      $sql = "SELECT * FROM topup ORDER BY id DESC LIMIT 5";
                      $result = $pdo->prepare($sql);
                      $result->execute();
                      while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $id_user = $row['id_user'];
                        $voucher_code = $row['voucher_code'];
                        $balance = $row['balance'];
                        $timestamp = $row['timestamp'];

                        $sql2 = "SELECT * FROM users WHERE id = :id_user";
                        $result2 = $pdo->prepare($sql2);
                        $result2->execute(array(
                          ':id_user' => $id_user
                        ));
                        $row2 = $result2->fetch(PDO::FETCH_ASSOC);
                        $username = $row2['username'];
                    ?>
                    <tr>
                      <td>
                        <?= $username; ?>
                      </td>
                      <td>
                        <?= $voucher_code; ?>
                      </td>
                      <td>
                        <?= $balance; ?>
                      </td>
                      <td>
                        <?= $timestamp; ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
      </div>
      </div>

      <div class="col-lg-6">
    <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">รายชื่อผู้ใช้สมัครล่าสุด</h3>
                <div class="card-tools">
                  <!-- button model add user -->
                  <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-add-user">
                    <!-- icon color green -->
                    <i class="fas fa-plus text-success"></i>
                  </button>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>ชื่อผู้ใช้</th>
                    <th>เงินในบัญชี</th>
                    <th>สิทธิ์</th>
                    <th>สถานะ ระงับการใช้งาน</th>
                    <th>เครื่องมือ</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 10";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $row){ 
                      // check permission 0 = user 1 = admin
                      if($row['permission'] == 0){
                        $permission = "User";
                      }else{
                        $permission = "Admin";
                      }
                      ?>
                    <tr>
                      <td>
                        <?= $row['username']; ?>
                      </td>
                      <td>
                        <?= $row['balance']; ?>
                      </td>
                      <td>
                        <!-- Badge user = primary admin = danger -->
                        <?php if($row['permission'] == 0){ ?>
                          <span class="badge badge-primary"><?= $permission; ?></span>
                        <?php }else{ ?>
                          <span class="badge badge-danger"><?= $permission; ?></span>
                        <?php } ?>
                      </td>
                      <td>
                        <!-- Badge ban = danger not ban = success -->
                        <?php if($row['ban'] == 0){ ?>
                          <span class="badge badge-success">ไม่ระงับ</span>
                        <?php }else{ ?>
                          <span class="badge badge-danger">ระงับ</span>
                        <?php } ?>
                      <td>
                        <!-- edit profile button and delete button -->
                        <!-- button edit profile open modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-user-<?= $row['id']; ?>" data-whatever="@mdo">
                          แก้ไข
                        </button>
                        <!-- button delete user -->
                        <a href="delete_user.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบผู้ใช้นี้ใช่หรือไม่?');">
                          ลบ
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
      </div>
      </div>
      </div>
      </div>

  </div>
</div>
</div>

<!-- Modal edit user get data from button edit profile -->
<?php
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){ ?>
<div class="modal fade" id="modal-edit-user-<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="edit_user.php" method="POST">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">ชื่อผู้ใช้:</label>
          <input type="text" class="form-control" id="recipient-name" name="username" value="<?= $row['username']; ?>">
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">รหัสผ่าน:</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="password-<?= $row['id']; ?>" name="password" value="สร้างรหัสผ่าน">
            <div class="input-group-append">
              <a class="btn btn-outline-secondary" onclick="generatePassword('<?= $row['id']; ?>')">สร้างรหัสผ่าน</a>
            </div>
            <script>
              function generatePassword(id) {
                var length = 8,
                  charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                  retVal = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                  retVal += charset.charAt(Math.floor(Math.random() * n));
                }
                document.getElementById("password-" + id).value = retVal;
              }
            </script>
          </div>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">เงินในบัญชี:</label>
          <input type="text" class="form-control" id="recipient-name" name="balance" value="<?= $row['balance']; ?>">
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">สิทธิ์:</label>
          <select class="form-control" name="permission">
            <option value="0" <?php if($row['permission'] == 0){ echo "selected"; } ?>>User</option>
            <option value="1" <?php if($row['permission'] == 1){ echo "selected"; } ?>>Admin</option>
          </select>
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">สถานะ:</label>
          <select class="form-control" name="ban">
            <option value="0" <?php if($row['ban'] == 0){ echo "selected"; } ?>>ใช้งานปกติ</option>
            <option value="1" <?php if($row['ban'] == 1){ echo "selected"; } ?>>ระงับการใช้งาน</option>
          </select>
        </div>

        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <input type="hidden" name="path" value="<?= $file_view ?>">

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php } ?>

<!-- Modal add user -->
<div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ใช้</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="add_user.php" method="POST">
    <div class="form-group">
      <label for="recipient-name" class="col-form-label">ชื่อผู้ใช้:</label>
      <input type="text" class="form-control" id="recipient-name" name="username" placeholder="ชื่อผู้ใช้" required>
    </div>
    <div class="form-group">
      <label for="recipient-name" class="col-form-label">รหัสผ่าน:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="password" name="password" placeholder="สร้างรหัสผ่าน" required>
        <div class="input-group-append">
          <a class="btn btn-outline-secondary" onclick="generatePassword()">สร้างรหัสผ่าน</a>
        </div>
        <script>
          function generatePassword() {
            var length = 8,
              charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
              retVal = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
              retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            document.getElementById("password").value = retVal;
          }
        </script>
      </div>
    </div>

    <div class="form-group">
      <label for="recipient-name" class="col-form-label">สิทธิ์:</label>
      <select class="form-control" name="permission">
        <option value="0">User</option>
        <option value="1">Admin</option>
      </select>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>
</div>





  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
