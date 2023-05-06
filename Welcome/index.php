<?php
session_name("SESSILGN");
session_start();
if (!isset($_SESSION["login-user"]) || !isset($_COOKIE["UUsSRlGnEQthORoe"]) || !isset($_COOKIE["UDsSRlGnEQthORue"])) {
    header("Location: ../index.php");
    exit;
}


$id = $_COOKIE["UUsSRlGnEQthORoe"];
$key = $_COOKIE["UDsSRlGnEQthORue"];

// cek username berdasarkan id
$result = mysqli_query(mysqli_connect("localhost", "root", "", "perpus"), "SELECT * FROM loginuser WHERE id='$id'");
$row = mysqli_fetch_assoc($result); //ambil
$username = '';

// cek COOKIE dan username
if ($key === hash("sha512", $row["username"])) {
    $username = $row["username"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome User~</title>
    <script src="https://kit.fontawesome.com/80e53aea6c.js" crossorigin="anonymous"></script>
    <script src="../Admin/JS/jquery-3.6.3.min.js"></script>
    <script src="JS/script.js"></script>
    <link rel="stylesheet" id="css" href="CSS/User/index.css" />
    <link rel="stylesheet" id="dm" />
    <script src="JS/history.js"></script>
</head>

<body>
    <div class="popup" hidden></div>

    <nav>
        <ul>
            <li>
                <h1 id="darkmode" class="light"><i class="fa-solid fa-moon"></i></h1>
                <button id="humberger"><span></span><span></span><span></span></button>
            </li>
            <li>
                <h1 class="title">E-Perpus Mejayan</h1>
            </li>
            <li>
                <div>
                    <h2>
                        <?= ucfirst($username) ?>
                    </h2>
                    <p>Anggota</p>
                </div>
                <img src="../.temp/<?= $row['gambar'] ?>" alt="" />
                <div class="dropdown-logout">
                    <a href="../logout-user.php" onclick="return confirm('Yakin mau logout?');"><i
                            class="fi fi-rr-sign-out-alt"></i>
                        Logout</a>
            </li>
            </div>
            </li>
        </ul>
    </nav>

    <header>
        <ul>
            <li id="home" class="on"><i class="fa-solid fa-house"></i>Home</li>
            <li id="cari-buku"><i class="fa-solid fa-book"></i>Cari Buku</li>
            <li id="riwayat">
                <i class="fa-solid fa-clock-rotate-left"></i>Riwayat
            </li>
            <li id="feedback" onclick="
              $('main').load('component/feedback.php?usr_nm=data_dummy');
              $('*').removeClass('on');
              $(this).addClass('on');"><i class="fa-solid fa-comment-pen"></i>Feedback</li>
        </ul>
    </header>

    <main></main>

    <footer>
        <h2>
            COPYRIGHT &#x24B8;
            <a href="https://smkn1mejayan.sch.id/" target="_blank">
                2023 SMKN 1 MEJAYAN Kab. MADIUN</a>,All rights Reserved
        </h2>
    </footer>
</body>

</html>