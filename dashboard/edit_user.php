<?php
session_start();
if(!isset($_SESSION['id'])) return header('Location: login.php?error=กรุณาเข้าสู่ระบบก่อน');
include '../config/connect.php';
if($_SESSION['permission'] < 1) return header('Location: ../pages/index.php?error=คุณไม่มีสิทธิ์เข้าถึงหน้านี้');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$balance = $_POST['balance'];
$ban = $_POST['ban'];
$permission = $_POST['permission'];

$path = $_POST['path'];

$sql = "SELECT * FROM users WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();

if($password == "สร้างรหัสผ่าน"){
    $password = $user->password;
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
}

$sql = "UPDATE users SET username = '$username', password = '$password', balance = '$balance', permission = '$permission', ban = '$ban' WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();

}

if($path === "Dashboard") header('Location: index.php?success=แก้ไขข้อมูลสำเร็จ # : ' . $id . " Name : " . $username);
if($path === "users") header('Location: users.php?success=แก้ไขข้อมูลสำเร็จ # : ' . $id . " Name : " . $username);

?>
