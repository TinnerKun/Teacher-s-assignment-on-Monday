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
  <title>Tinner Lnw Shop | Statement</title>
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
                <h3 class="card-title">Statement of all users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>หมายเลขรายการ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>รหัสบัตร</th>
                    <th>จำนวนเงิน</th>
                    <th>วันที่</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  // SELECT `id`, `id_user`, `voucher_code`, `balance`, `timestamp` FROM `topup` WHERE 1
                  // SELECT `id`, `username`, `password`, `ban`, `permission`, `balance` FROM `users` WHERE 1

                  // get user name in users table
                  // get balance in topup table
                  
                  $sql = "SELECT * FROM topup";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  $topups = $stmt->fetchAll();
                  foreach($topups as $topup) {
                    $sql = "SELECT * FROM users WHERE id = '$topup->id_user'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $user = $stmt->fetch();
                    echo "
                    <tr>
                      <td>$topup->id</td>
                      <td>$user->username</td>
                      <td><span class='badge bg-primary'>$topup->voucher_code</span></td>
                      <td>$topup->balance</td>
                      <td>$topup->timestamp</td>
                    </tr>
                    ";
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>หมายเลขรายการ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>รหัสบัตร</th>
                    <th>จำนวนเงิน</th>
                    <th>วันที่</th>
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
