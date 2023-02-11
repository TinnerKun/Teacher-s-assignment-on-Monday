<?php 
session_start();

include '../config/connect.php';
include '../config/count_view.php';

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <!-- loading fullpage -->
    <style>
        * {
            font-family: 'Kanit', sans-serif;
        }
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background color black with opacity 0.5 */
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }
        .loading .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border: 10px solid #f3f3f3;
            border-top: 10px solid #3498db;
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>

    <script>
        window.addEventListener('load', function() {
            const loading = document.querySelector('.loading');
            loading.classList.add('fadeOut');
            setTimeout(function() {
                loading.style.display = 'none';
            }, 1000);
        });
    </script>

<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Kanit', sans-serif;
    }
  </style></head>
<body>

<!-- loading fullpage -->
<!-- style text center page -->

<div class="loading">
    <h1 class="text-center" style="color: #fff; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">กำลังโหลดข้อมูล กรุณารอสักครู่</h1>
</div>

<?php
include '../plugin/toast.php';
include '../plugin/nav.php';
?>



<?php if(isset($_GET['success'])) { ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: '<?php echo htmlspecialchars($_GET['success']) ?>'
            })
        </script>
<?php } ?>

<section class="py-4 py-xl-5">
    <div class="container">
        <div class="border rounded border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: linear-gradient(#000000, rgb(0 0 0 / 23%) 135%), url(../assets/image/105066511_p0.png) center / cover no-repeat;">
            <div class="row">
                <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                    <div>
                        <h1 class="fw-bold mb-3 text-white">TINNER Lnw SHOP</h1>
                        <h3 class="text-white mb-0">เว็บซื้อขายคุณภาพที่ ใหนก็ไม่รู้ ถามคนอืนเอาเองละกันนะ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-4 py-xl-5">
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                <i class="bi bi-person-plus-fill"></i>
                </div>
                <div class="px-3">
                    <h4>Register / Login</h4>
                    <p>สมัครสมาชิก หรือ เข้าสู่ระบบ ได้อย่างง่ายดาย เพียงไม่กี่ขั้นตอน</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                <i class="bi bi-wallet"></i>
                </div>
                <div class="px-3">
                    <h4>ระบบ เติมเงิน และ กระเป๋าออนไลน์</h4>
                    <p>เติมเงินได้ง่ายๆ และ สามารถเก็บเงินได้ในกระเป๋าออนไลน์ และ <b>ไม่สามารถถอนเงินได้ทุกเวลา</b></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-center d-flex flex-column align-items-center align-items-xl-center">
                <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                <i class="bi bi-box2-fill"></i>
                </div>
                <div class="px-3">
                    <h4>สินค้าและบริการ</h4>
                    <p>สินค้าและบริการที่เรามี มีมากมาย และ มีราคาถูก ที่สุดในตลาด เพราะไม่ได้ขายจริง</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container py-4 py-xl-5">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>สินค้าของเรา</h2>
            <p class="w-lg-50">สินค้าของเรา มีมากมาย และ มีราคาถูก ที่สุดในตลาด เพราะไม่ได้ขายจริง</p>
        </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="card">
                <div style='height: 200px;background: url("../assets/image/4.webp");background-position: center;background-size: contain;background-repeat: no-repeat;'></div>
                <div class="card-body p-4">
                    <p class="text-primary card-text mb-0">Software license</p>
                    <h4 class="card-title">Windows 11 OEM</h4>
                    <p class="card-text">Windows 11 OEM ติดตั้งได้ 1 คอมพิวเตอร์ 1 ครั้งเท่านั้น ไม่สามารถติดตั้งซ้ำได้ ราคา 1,000 บาท</p>
                    <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="https://cdn-icons-png.flaticon.com/512/732/732221.png" />
                        <div>
                            <p class="fw-bold mb-0">Microsoft Thailand</p>
                            <p class="text-muted mb-0">Software license</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div style='height: 200px;background: url("https://www.mikrotik-hotspotwifi.com/wp-content/uploads/2021/07/1.RB5009UGSIN.jpg");background-position: center;background-size: contain;background-repeat: no-repeat;'></div>
                <div class="card-body p-4">
                    <p class="text-primary card-text mb-0">Network Device</p>
                    <h4 class="card-title">Mikrotik RB5009UG+S+IN</h4>
                    <p class="card-text">อุปกรณ์เสริมเครือข่าย รุ่น RB5009UG+S+IN คุณสมบัติ รองรับ 9 แบนด์ 2.4GHz และ 5GHz รองรับ 2.5Gbps ราคา 3,500 บาท</p>
                    <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="https://cdn.shopify.com/s/files/1/0653/8759/3953/files/512.png?v=1657867177" />
                        <div>
                            <p class="fw-bold mb-0">Mikrotik Official</p>
                            <p class="text-muted mb-0">Network Device</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div style='height: 200px;background: url("https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/workstations/fixed-workstations/precision/3660/media-gallery/workstations-precision-3660-gallery-3.psd?fmt=pjpg&pscan=auto&scl=1&hei=402&wid=302&qlt=100,1&resMode=sharp2&size=302,402&chrss=full");background-position: center;background-size: contain;background-repeat: no-repeat;'></div>
                <div class="card-body p-4">
                    <p class="text-primary card-text mb-0">Computer</p>
                    <h4 class="card-title">Dell Precision 3660</h4>
                    <p class="card-text">คอมพิวเตอร์ Dell Precision 3660 หมวด Workstation เกรด Server ราคา 50,000 บาท</p>
                    <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Dell_logo_2016.svg/2048px-Dell_logo_2016.svg.png" />
                        <div>
                            <p class="fw-bold mb-0">Dell Thailand</p>
                            <p class="text-muted mb-0">Computer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container py-4 py-xl-5">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>แนะนำจากผู้ใช้บริการ</h2>
        </div>
    </div>
    <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
        <div class="col">
            <div>
                <p class="bg-light border rounded border-0 border-light p-4">บิดแล้วรวย หมายถึงเจ้าของร้าน</p>
                <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="https://cdn.discordapp.com/attachments/930061356344934431/1072880648773185637/9k.png" />
                    <div>
                        <p class="fw-bold text-primary mb-0"><a href="https://www.facebook.com/tyxm.n" target="_blank">tyxm.n</a></p>
                        <p class="text-muted mb-0"><span style="color: rgba(33, 37, 41, 0.75);">Network Engineer</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div>
                <p class="bg-light border rounded border-0 border-light p-4">ห้องน้ำอร่อย อาหารสะอาด</p>
                <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="../assets/image/Gigachad.jpg" />
                    <div>
                        <p class="fw-bold text-primary mb-0"><a href="https://www.facebook.com/profile.php?id=100024220563128" target="_blank">OhayoOniiChan</a></p>
                        <p class="text-muted mb-0">Firewall Developer</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div>
                <p class="bg-light border rounded border-0 border-light p-4">ผมเจ้าของเว็บ</p>
                <div class="d-flex"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="50" height="50" src="../assets/image/need.png" />
                    <div>
                        <p class="fw-bold text-primary mb-0"><a href="https://www.facebook.com/deleteduser.6740" target="_blank">DeletedUser</a></p>
                        <p class="text-muted mb-0">แ ฮ ก เ ก อ ร์ แ ม น</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container py-4 py-xl-5">
    <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>ทีมพัฒนาเว็บไซต์</h2>
            <p class="lead">ทีมพัฒนาเว็บไซต์ <b>ที่ไม่มีประสบการณ์ และ ไม่มีความรู้ความสามารถ</b> ในการพัฒนาเว็บไซต์ และ ระบบ ต่างๆ</p>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3" style="text-align: left;display: flex;justify-content: center;">
    <div class="col" style="display: flex;justify-content: center;">
        <div class="card border-0 shadow-none">
            <div class="card-body d-flex align-items-center p-0"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="130" height="130" src="../assets/image/tinner.jpg" />
                <div>
                    <h5 class="fw-bold text-primary mb-0"><strong>Khanathip Rnagphong</strong></h5>
                    <p class="text-muted mb-1"><b>Back-End Developer</b></p>
                    <ul class="list-inline fs-6 text-muted w-100 mb-0">
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.facebook.com/TinnerXKun"><svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                </svg></a></div>
                        </li>
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.instagram.com/tinner.x/"><svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                </svg></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col" style="display: flex;justify-content: center;">
        <div class="card border-0 shadow-none">
            <div class="card-body d-flex align-items-center p-0"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="130" height="130" src="../assets/image/tinner.jpg" />
                <div>
                    <h5 class="fw-bold text-primary mb-0"><strong>Khanathip Rnagphong</strong></h5>
                    <p class="text-muted mb-1"><b>Back-End Developer</b></p>
                    <ul class="list-inline fs-6 text-muted w-100 mb-0">
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.facebook.com/TinnerXKun"><svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                </svg></a></div>
                        </li>
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.instagram.com/tinner.x/"><svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                </svg></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col" style="display: flex;justify-content: center;">
        <div class="card border-0 shadow-none">
            <div class="card-body d-flex align-items-center p-0"><img class="rounded-circle flex-shrink-0 me-3 fit-cover" width="130" height="130" src="../assets/image/tinner.jpg" />
                <div>
                    <h5 class="fw-bold text-primary mb-0"><strong>Khanathip Rnagphong</strong></h5>
                    <p class="text-muted mb-1"><b>Back-End Developer</b></p>
                    <ul class="list-inline fs-6 text-muted w-100 mb-0">
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.facebook.com/TinnerXKun"><svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                </svg></a></div>
                        </li>
                        <li class="list-inline-item text-center">
                            <div class="d-flex flex-column align-items-center"><a href="https://www.instagram.com/tinner.x/"><svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                </svg></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="text-center bg-dark">
    <div class="container text-white py-4 py-lg-5">
        <ul class="list-inline">
            <li class="list-inline-item me-4"><a class="link-light" href="https://sycer.network">SycerNetwork</a></li>
            <li class="list-inline-item me-4"><a class="link-light" href="https://servwire.cloud">Servwire</a></li>
            <li class="list-inline-item"><a class="link-light" href="https://drite.in.th">DriteStudio</a></li>
        </ul>
        <p class="mb-0 text-white mb-2">ผู้ชมจำนวน <?= $count ?> ครั้ง</p>
        <p class="mb-0 text-white">© 2023 TinnerX. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>

const options = {
  bottom: '64px', // default: '32px'
  right: 'unset', // default: '32px'
  left: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#fff', // default: '#fff'
  saveInCookies: false, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();

  function addDarkmodeWidget() {
    new Darkmode().showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>