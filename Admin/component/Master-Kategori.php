<?php
require '../database/functions.php';

if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../login-admin.php");
    exit;
}

$dataPerHalaman = (isset($_GET['lim'])) ? $_GET['lim'] : 10;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$kategor = mysqli_query($db, "SELECT * FROM buku ORDER BY id DESC LIMIT 10");

?>
<style>
    .side-bar {
        height: 100% !important;
        box-shadow: none !important;
    }

    main {
        height: max-content !important;
    }

    .isi-data .data table tbody tr td.center {
        text-align: center !important;
    }
</style>
<link rel="stylesheet" href="CSS/style-content.css">
<script src="JS/jquery-3.6.3.min.js"></script>
<script src="JS/script.js"></script>
<div class="title">
    <h1>Pembaca</h1>
    <hr>
    <h2>Data Pembaca <img src="assets/angle-small-right.svg" alt=""></h2>
    <h3>penulis</h3>
</div>
<!-- ini.isi -->
<div class="card-wrapper penulis">
    <div class="data-wrapper">
        <div class="data-indicator">
            <div class="data-entries">
                <p>show</p>
                <select id="selection" name="selection"
                    onchange="
                    let value = $(this).val();
                    $('#isi-data').load('component/result/kategori.php?lim=' + value + '&&page=<?= $halamanAktif ?>&&key=' + $('#search').val())">
                    <option value="10">10</option>
                    <option value="5">5</option>
                    <option value="2">2</option>
                </select>
                <p>entries</p>
            </div>
            <div class="data-search">
                <label for="search">Search:</label>
                <input type="search" name="search" id="search" onkeyup="
                $('#isi-data').load(
                    'component/result/kategori.php?lim=' + $('#selection').val() + '&&page=<?= $halamanAktif ?>&&key=' + $(this).val()
                )">
            </div>
        </div>
        <!-- isi data -->
        <div class="isi-data" id="isi-data">
            <div class="data">
                <table width="100%">
                    <thead width="100%">
                        <th>NO</th>
                        <th>KATEGORI</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody width="100%" cellspacing="10">
                        <?php
                        $id = 1;
                        foreach ($kategor as $kategori):
                            ?>
                            <tr cellspacing="10">
                                <td>
                                    <p>
                                        <?= $id ?>
                                    </p>
                                </td>
                                <td class="limit">
                                    <p>
                                        <?= $kategori['kategori'] ?>
                                    </p>
                                </td>
                                <td>
                                    <button onclick="
                                $('.popup').load('../Welcome/component/result/fraction_group.php?bukid=<?= $kategori['id'] ?>');
                                $('.popup').removeAttr('hidden');
                                "><i class="fa-solid fa-chart-simple"></i>Detail
                                    </button>
                                </td>
                            </tr>
                            <?php $id++; endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class=" description">
                <p>Showing
                    <?= $id -= 1; ?> of 10 entries
                </p>
                <div class="pagination">
                    <p class="amount-of-data">1</p>
                    <?php if ($halamanAktif < $jumlahHalaman): ?>
                        <button onclick="
                    $('.isi-data').load('component/result/kategori.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=' + $('#search').val())'
                    )">
                            Next
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>