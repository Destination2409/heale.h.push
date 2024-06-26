<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Candel Gel Wax - Heale.H</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">

                            <div class="text-center">
                            <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                style="width: 185px;" alt="logo"> -->
                            <h4 class="mt-1 mb-5 pb-1">ยินดีต้อนรับสู่ร้าน Heale.H</h4>
                            </div>

                            <form action="controller/register-customer.php" method="POST">
                            <p>กรอกข้อมูลเพื่อสมัครสมาชิคผู้ใช้งาน</p>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control"
                                placeholder="กรุณากรอกอีเมล" />
                                <label class="form-label" for="email">อีเมล</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" 
                                placeholder="กรุณากรอกรหัสผ่าน" />
                                <label class="form-label" for="password">รหัสผ่าน</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="name" name="name" class="form-control" 
                                placeholder="ชื่อ นามสกุล" />
                                <label class="form-label" for="name">ชื่อ-นามสกุล</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="tel" id="tel" name="tel" class="form-control" 
                                placeholder="เบอร์โทร" />
                                <label class="form-label" for="tel">เบอร์โทร</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="address" name="address" class="form-control" 
                                placeholder="ที่อยู่" />
                                <label class="form-label" for="address">ที่อยู่</label>
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">สมัครสมาชิค</button>
                                <!-- <a class="text-muted" href="#!">ลืมรหัสผ่าน?</a> -->
                            </div>

                            <div class="d-flex align-items-center justify-content-center pb-4">
                                <p class="mb-0 me-2">มีชื่อผู้ใช้งานแล้ว ?</p>
                                <a href="login.php" class="btn btn-outline-danger">เข้าสู่ระบบเลย</a>
                            </div>
                            <?php
                            if (isset($_REQUEST['check'])) {
                            ?>
                                <div class="text-center text-danger">
                                    <?php
                                    if($_REQUEST['check'] == 'con-password'){
                                        echo 'รหัสผ่านไม่ตรงกัน !!';
                                        // echo 'Password not Match !!';
                                    }elseif($_REQUEST['check'] == 'alreadyexists'){
                                        echo 'มีผู้ใช้งานนี้อยู่แล้ว !!';
                                        // echo 'Duplicate Username !!';
                                    }elseif($_REQUEST['check'] == 'error'){
                                        echo 'มีบางอย่างผิดพลาด.';
                                        // echo 'Something went wrong.';
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>

                            </form>

                        </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center" style="background-image: url('assets/img/register_bg.jpg')">
                        <!-- <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <h4 class="mb-4">We are more than just a company</h4>
                            <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div> -->
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
    </body>
</html>
