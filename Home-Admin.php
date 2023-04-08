<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login-admin.php");
    exit;
}
require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage Admin</title>
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" id="dm">
    <script src="https://kit.fontawesome.com/981acb16d7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="side-bar">
        <a href="" class="icon">
            <!-- logo -->
            <div class="kotak"></div>
            <h1>E-perpus Inpres</h1>
        </a>
        <ul>
            <li class="dashboard active">
                <h2><i class="fa-solid fa-house"></i> Dashboard</h2>
            </li>
            <li class="dropdown">
                <div class="master-data">
                    <h2><i class="fa-solid fa-database"></i>Master data <span class="notif">5</span></h2>
                    <div class="dropdown-icon">
                        <h2><i class="fa-sharp fa-solid fa-angle-down"></i></h2>
                    </div>
                </div>
                <ul class="list-master-data" id="list-master-data">
                    <li id="buku">
                        <h3>Buku</h3>
                    </li>
                </ul>
            </li>
            <li id="peminjaman">
                <h2><i class="fa-solid fa-book"></i> Peminjaman</h2>
            </li>
            <!-- <li><h2><i class="fi fi-rr-list-check"></i> Persetujuan</h2></li> -->
            <li id="laporan">
                <h2><i class="fa-solid fa-chart-simple"></i> Laporan</h2>
            </li>
        </ul>
    </div>
    <!-- content -->
    <main>
        <div class="content-wrapper">
            <header class="heading">
                <h1 id="darkmode" class="light"><i class="fa-solid fa-moon"></i></h1>
                <div class="profile">
                    <div class="text">
                        <h2 class="name">
                            <?= ucfirst($_COOKIE["username"]) ?>
                        </h2>
                        <h3 class="type">Admin</h3>
                    </div>
                    <!-- photo profile user -->
                    <!-- <img src="" alt="" srcset=""> -->
                    <div class="profile-user"></div>
                    <div class="dropdown-profile">
                        <ul>
                            <li><a href="logout-admin.php" onclick="return confirm('Sure?');"><i
                                        class="fi fi-rr-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="content">
                <!-- isi konten -->
            </div>
        </div>
        <footer>
            <h2>COPYRIGHT &#x24B8; <a href=""> 2023 SMKN 1 MEJAYAN Kab. MADIUN</a>,All rights Reserved</h2>
        </footer>
    </main>
</body>
<script src="JS/jquery-3.6.3.min.js"></script>
<script src="JS/script.js"></script>

</html>