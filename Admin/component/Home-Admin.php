<?php
require '../database/functions.php';

if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../login-admin.php");
    exit;
}

$books = mysqli_query($db, "SELECT * FROM buku ORDER BY id");
$user = mysqli_query($db, "SELECT * FROM loginuser ORDER BY id");

$jumlahBuku = 1;
$jumlahUser = 1;
foreach ($books as $book) {
    $jumlahBuku++;
}
foreach ($books as $book) {
    $jumlahUser++;
}
?>

<link rel="stylesheet" href="CSS/M-dashboard.css">
<div class="content">
    <div class="title">
        <h1>Dashboard</h1>
        <hr>
        <h2>Dashboard <img src="assets/angle-small-right.svg" alt=""></h2>
        <h3>Index</h3>
    </div>
    <div class="card-wrapper">
        <div class="card1">
            <div class="col1">
                <h2>Welcome Admin Ku!</h2>
                <p>Anda bisa mengatur data buku</p>
            </div>
            <div class="col2">
                <h1>
                    <?= $jumlahBuku ?> Buku
                </h1>
                <button>Atur Data Buku</button>
            </div>
        </div>
        <div class="card2">
            <div class="title">
                <h1>Jumlah Data</h1>
                <p>Data terupdate otomatis</p>
            </div>
            <div class="content-data">
                <ul>
                    <li>
                        <div class="icon">
                            <h1><i class="fa-solid fa-book-open-reader"></i></h1>
                        </div>
                        <div>
                            <h2>
                                <?= $jumlahBuku ?>
                            </h2>
                            <p>Buku</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <h1><i class="fa-solid fa-user"></i></h1>
                        </div>
                        <div>
                            <h2>
                                <?= $jumlahUser ?>
                            </h2>
                            <p>Anggota</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <h1><i class="fa-solid fa-cubes"></i></h1>
                        </div>
                        <div>
                            <h2>3</h2>
                            <p>Peminjaman</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>