<?php
session_start();

if(!isset($_SESSION['id'])) return header('Location: ../pages/login.php?error=กรุณาเข้าสู่ระบบก่อน');

include '../config/connect.php';

// check permission
if($_SESSION['permission'] < 1) return header('Location: ../pages/index.php?error=คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tinner Lnw Shop | Users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
<body class="hold-transition sidebar-mini">
<?php include '../plugin/toast.php'; ?>
<div class="wrapper">
<?php include '../plugin/nav_admin.php'; ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Data Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Permission</th>
                    <th>Balance</th>
                    <th>Ban Status</th>
                    <th>Tool kit</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = "SELECT * FROM users ORDER BY id DESC";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  $users = $stmt->fetchAll();
                  foreach($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user->id . "</td>";
                    echo "<td>" . $user->username . "</td>";
                    // badge permission user = 0 admin = 1
                    if($user->permission == 0) {
                      echo "<td><span class='badge bg-primary'>User</span></td>";
                    } else {
                      echo "<td><span class='badge bg-warning'>Admin</span></td>";
                    }
                    echo "<td>" . $user->balance . "</td>";
                    // badge ban status
                    if($user->ban == 0) {
                      echo "<td><span class='badge bg-success'>Unban</span></td>";
                    } else {
                      echo "<td><span class='badge bg-danger'>Ban</span></td>";
                    }
                    // <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-user-<?= $row['id']; ?/>" data-whatever="@mdo">
                    //       แก้ไข
                    //     </button>
                    //     <!-- button delete user -->
                    //     <a href="delete_user.php?id=<?= $row['id']; ?/>" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบผู้ใช้นี้ใช่หรือไม่?');">
                    //       ลบ
                    //     </a>

                    echo "<td>
                    <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modal-edit-user-$user->id' data-whatever='@mdo'>
                      แก้ไข
                    </button>
                    <!-- button delete user -->
                    <a href='delete_user.php?id=$user->id' class='btn btn-danger btn-sm' onclick='return confirm('คุณต้องการลบผู้ใช้นี้ใช่หรือไม่?');'>
                      ลบ
                    </a>
                    </td>";

                    echo "</tr>";
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Permission</th>
                    <th>Balance</th>
                    <th>Ban Status</th>
                    <th>Tool kit</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>


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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
