<?php
// get user data from database by id

session_start();
if(!isset($_SESSION['id'])) return header('Location: login.php?error=กรุณาเข้าสู่ระบบก่อน');
include '../config/connect.php';
if($_SESSION['permission'] < 1) return header('Location: ../pages/index.php?error=คุณไม่มีสิทธิ์เข้าถึงหน้านี้');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$permission = $_POST['permission'];

$path = $_POST['path'];

if(empty($username) || empty($password)) return header('Location: index.php?error=กรุณากรอกข้อมูลให้ครบ');

// check id in db
$sql = "SELECT * FROM users WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();

// check password == "สร้างรหัสผ่าน" = default password in database
$password = password_hash($password, PASSWORD_DEFAULT);

// insert user
$sql = "INSERT INTO users (username, password, permission) VALUES ('$username', '$password', '$permission')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

}

if($path === "Dashboard") header('Location: index.php?success=แก้ไขข้อมูลสำเร็จ # : ' . $id . " Name : " . $username);
if($path === "users") header('Location: users.php?success=แก้ไขข้อมูลสำเร็จ # : ' . $id . " Name : " . $username);

?>
