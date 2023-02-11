<!-- register -->
<?php
session_start();

if(isset($_SESSION['id'])) return header('Location: index.php');

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // check empty
    if(empty($username) || empty($password) || empty($password_confirm)) return header('Location: ?error=กรุณากรอกข้อมูลให้ครบ');

    if($password !== $password_confirm) return header('Location: ?error=รหัสผ่านไม่ตรงกัน');

    // encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // check username in db 
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch();

    if($user) return header('Location: ?error=มีชื่อผู้ใช้นี้แล้ว');

    // insert user
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header('Location: login.php');

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
<!-- background: #f8f9fa; -->
<body style="background: #f8f9fa;">
<?php
include '../plugin/toast.php';
?>
    
    <!-- background image ../assets/image/bg1.jpg and background gardient -->
    <!-- card center page -->
    <div class="container-fluid" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(../assets/image/105066511_p0.png); background-size: cover; background-position: center; height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">
                <!-- card theme black -->
                <div class="card bg-dark text-white">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">Password Confirm</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Password Confirm">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="login.php" class="btn btn-success">Login</a>
                                <a href="index.php" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>