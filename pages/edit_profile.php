<!-- edit_profile.php -->
<?php
session_start();
if(!isset($_SESSION['id'])) return header('Location: login.php');

require_once '../config/connect.php';

$id_user = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id = '$id_user'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$user = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // no update username
    $password_old = $_POST['password_old'];
    $password_new = $_POST['password_new'];
    $confirm_password = $_POST['confirm_password'];

    // check empty
    if(empty($password_old) || empty($password_new) || empty($confirm_password)) return header('Location: ?error=กรุณากรอกข้อมูลให้ครบ');

    // check password old
    if(!password_verify($password_old, $user->password)) return header('Location: ?error=รหัสผ่านเดิมไม่ถูกต้อง');

    // check password new
    if($password_new != $confirm_password) return header('Location: ?error=รหัสผ่านใหม่ไม่ตรงกัน');

    // update password
    $password = password_hash($password_new, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$password' WHERE id = '$id_user'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header('Location: index.php?success=แก้ไขข้อมูลสำเร็จ');
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
    ?>
    
    <div class="container-fluid" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(../assets/image/bg1.jpg); background-size: cover; background-position: center; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4">
            <!-- card theme black -->
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?php echo $_SESSION['username'] ?>" disabled>
                        </div>

                        <!-- input password old -->
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password_old" placeholder="Old Password">
                        </div>

                        <!-- input password new -->

                        <div class="mb-3 d-flex justify-content-between mt-3">
                            <input type="password" id="password" name="password_new" placeholder="New Password" class="form-control me-2">
                            <input type="password" id="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        </div>

                        <hr class="bg-white">

                        <!-- submit button -->
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-50 me-2" name="submit">Update</button>
                            <a href="index.php" class="btn btn-danger w-50">Cancel</a>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
