<?php
session_start();

if(!isset($_SESSION['id'])) return header('Location: login.php?error=กรุณาเข้าสู่ระบบก่อน');

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    $url_true_wallet = htmlspecialchars($_POST['url_true_wallet']);

    if(empty($url_true_wallet)) return header('Location: add_money.php?error=กรุณาใส่ URL ทรูวอลเล็ท');
    if(!preg_match('/https:\/\/gift.truemoney.com\/campaign\/\?v\=/', $url_true_wallet)) return header('Location: add_money.php?error=กรุณาใส่ URL ทรูวอลเล็ทให้ถูกต้อง');

    $url_true_wallet = explode('?', $url_true_wallet);
    $url_true_wallet = explode('=', $url_true_wallet[1]);
    $url_true_wallet = $url_true_wallet[1];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint_redeem_truewallet);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"mobile\" : \"$mobile\",
        \"voucher_code\" : \"$url_true_wallet\"
    }");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = "User-Agent: Kuy - " . random_str(10);
    $headers[] = "Content-Type: application/json";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result_post = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $result_post = json_decode($result_post, true);
    if($result_post['status']['code'] == 'VOUCHER_OUT_OF_STOCK') return header('Location: ?error=เติมเงินไม่สำเร็จ ถูกใช้ไปแล้ว');
    if($result_post['status']['code'] == 'VOUCHER_EXPIRED') return header('Location: ?error=เติมเงินไม่สำเร็จ หมดอายุแล้ว');
    if($result_post['status']['code'] == 'VOUCHER_NOT_FOUND') return header('Location: ?error=เติมเงินไม่สำเร็จ ไม่พบรหัส');
    if($result_post['status']['code'] == 'SUCCESS') {
        $balance = $result_post['data']['my_ticket']['amount_baht'];
        $balance = str_replace('.', '', $balance);
        $balance = (int)$balance;
        $balance = $balance / 100;

        $sql = "UPDATE users SET balance = balance + :balance WHERE id = " . $_SESSION['id'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['balance' => $balance]);
        
        $sql = "INSERT INTO topup (id_user, voucher_code, balance) VALUES (:id_user, :voucher_code, :balance)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_user' => $_SESSION['id'], 'voucher_code' => $url_true_wallet, 'balance' => $balance]);

        header('Location: ?success=เติมเงินสำเร็จ ' . $balance . ' บาท');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
<body style="background: #f8f9fa;">
    

    <?php
    include '../plugin/toast.php';
    include '../plugin/nav.php';
    ?>

    <!-- form center page -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="text-center">เติมเงิน</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="voucher" class="form-label">รหัสเติมเงิน</label>
                                <input type="text" class="form-control" id="voucher" name="url_true_wallet" placeholder="https://gift.truemoney.com/campaign/?v=xxxxxxxxxxxxxxxxxx">
                            </div>
                            <button type="submit" class="btn btn-primary">เติมเงิน</button>
                            <!-- วิธีเติมเงิน modal image -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                วิธีเติมเงิน
                            </button>

                            <!-- ประวัติการเติมเงิน Open new popup window without address bars javascript -->

                            <a href="javascript:window.open('history_topup.php','popup','width=600,height=600');void 0" class="btn btn-primary">ประวัติการเติมเงิน</a>


                            <!-- กลับหน้าหลัก -->
                            <a href="index.php" class="btn btn-danger">กลับหน้าหลัก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- วิธีเติมเงิน Modal -->
        <!-- image "../assets/image/tw.png" -->

<div class="modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">วิธีการเติมเงิน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        1. แอปพลิเคชั่น <b>TrueMoney Wallet</b> <br>
        2. กดเลือก ส่งซองของขวัญ <br>
        3. กรอกยอดเงินที่ต้องการส่ง <br>
        4. กรอกจำนวนคนรับซองของขวัญ <b>ให้เป็น 1 คน เท่านั้น</b> <br>
        5. กด สร้างซองของขวัญ <br>
        6. คัดลอก ลิงค์ ซองของขวัญ <br>
        7. นำมาวางในช่อง รหัสเติมเงิน เว็บไซต์นี้ <br>
        8. กด ยืนยันการเติมเงิน <br>
        <hr>
        เสร็จสิ้น <br>
      </div>
      <div class="modal-footer">
        <!-- ปิด -->
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
    </div>
    </div>
    </div>

    <!-- footer css to end page -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">truemoney © 2023 สงวนลิขสิทธิ์ และ เจ้าของเว็บไซต์</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>


