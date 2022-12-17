<?php
include("../conn.php");
session_start();
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
        <link href="<?=$hosturl.'/css/styles.css'?>" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Heale.H</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?=$hosturl.'/main/index.php'?>">หน้าแรก</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li> -->
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarResponsive2">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <?php
                        if (isset($_SESSION['user']) && $_SESSION['user']['permission'] > 0) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$hosturl.'/admin/order.php'?>">จัดการร้าน</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarResponsive3">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['user'])) {
                            ?>
                                <a class="nav-link"><?="สวัสดีคุณ ".$_SESSION['user']['name']?></a>
                            <?php
                            }else{
                            ?>
                            <a class="nav-link" href="<?=$hosturl.'/login.php'?>">Login</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['user'])) {
                            ?>
                                <a class="nav-link" href="<?=$hosturl.'/controller/logout-auth.php'?>">Logout</a>
                            <?php
                            }else{
                            ?>
                                <a class="nav-link" href="<?=$hosturl.'/controller/register.php'?>">Register</a>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>