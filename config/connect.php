<?php
// Connect to database
$host = '';
$user = '';
$pass = '';
$db = '';

// Redeem Voucher Code System
$mobile = "0652366373";
$endpoint_redeem_truewallet = "https://codex.servwire.cloud/api/truewallet.php";

$dsn = "mysql:host=$host;dbname=$db";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION['id'])) {
    $id_user_con = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = '$id_user_con'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch();
    $balance = $user->balance;
    $_SESSION['balance'] = $balance;
    $_SESSION['permission'] = $user->permission;
    if($user->ban == 1) {
        session_destroy();
        header('Location: login.php?error=บัญชีของคุณถูกระงับการใช้งาน');
    }
}
?>
