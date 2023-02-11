<?php
// history_topup page show history topup money table responsive bootstrap 5.3
// https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
// https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js

// SELECT `id`, `id_user`, `voucher_code`, `balance`, `timestamp` FROM `topup` WHERE 1
session_start();

if(!isset($_SESSION['id'])) return header('Location: login.php?error=กรุณาเข้าสู่ระบบก่อน');

include '../config/connect.php';

$sql = "SELECT * FROM topup WHERE id_user = ".$_SESSION['id'] . " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$topups = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Kanit', sans-serif;
    }
  </style></head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>ประวัติการเติมเงิน</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">รหัสบัตร</th>
                            <th scope="col">จำนวนเงิน</th>
                            <th scope="col">วันที่</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($topups as $topup) { ?>
                            <tr>
                                <th scope="row"><?php echo $topup->id ?></th>
                                <td><?php echo $topup->voucher_code ?></td>
                                <td><?php echo $topup->balance ?></td>
                                <td><?php echo $topup->timestamp ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>