<?php
// delete user by id get data from url

session_start();
if(!isset($_SESSION['id'])) return header('Location: login.php?error=กรุณาเข้าสู่ระบบก่อน');
include '../config/connect.php';
if($_SESSION['permission'] < 1) return header('Location: ../pages/index.php?error=คุณไม่มีสิทธิ์เข้าถึงหน้านี้');

// get data from url
$id = $_GET['id'];

// check id in db
$sql = "SELECT * FROM users WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();

// delete user
$sql = "DELETE FROM users WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();

header('Location: ?success=ลบข้อมูลสำเร็จ # : ' . $id . " Name : " . $user->username);
?>
