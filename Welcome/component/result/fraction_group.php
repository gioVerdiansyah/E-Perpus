<?php
require "../../../Admin/database/functions.php";
$id = $_GET["bukid"];

$fillIn = query("SELECT * FROM buku WHERE id = $id")[0];
?>

<div id="pop-up">
    <div class="content">
        <div class="title">
            <h1>Detail Buku</h1>
            <button onclick="
      $('#pop-up').remove();
      ">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="data">
            <table>
                <tr>
                    <td>Judul Buku</td>
                    <td>: <strong>
                            <?= $fillIn["judul_buku"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>: <strong>
                            <?= $fillIn["kategori"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td>: <strong>
                            <?= $fillIn["penulis"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td>: <strong>
                            <?= $fillIn["penerbit"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>tahun Terbit</td>
                    <td>: <strong>
                            <?= $fillIn["tahun_terbit"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td>: <strong>
                            <?= $fillIn["isbn"] ?>
                        </strong></td>
                </tr>
                <tr>
                    <td>Jumlah Halaman</td>
                    <td>: <strong>
                            <?= $fillIn["jumlah_halaman"] ?> halaman
                        </strong></td>
                </tr>
            </table>
            <p class="sinopsis">Sinopsis: </p>
            <p>
                <?= $fillIn["sinopsis"] ?>
            </p>
        </div>
    </div>
</div>