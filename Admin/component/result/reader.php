<?php
require '../../database/functions.php';
if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../../login-admin.php");
    exit;
}

$dataPerHalaman = $_GET['lim'];
$jumlahData = count(query("SELECT * FROM pembaca"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;


$keyword = $_GET["key"];

$read = mysqli_query($db, "SELECT * FROM pembaca WHERE
bukunya LIKE '%$keyword%' OR username LIKE '$keyword%' OR tanggal_baca LIKE '$keyword%' ORDER BY id DESC LIMIT $awalData, $dataPerHalaman");
?>
<!-- isi data -->
<script src="JS/jquery-3.6.3.min.js"></script>
<div class="isi-data">
    <div class="data">
        <table width="100%">
            <thead width="100%">
                <th>NO</th>
                <th>PEMINJAM</th>
                <th>PP PEMINJAM</th>
                <th>JUDUL BUKU</th>
                <th>KATEGORI</th>
                <th>TGL PINJAM</th>
                <th>ACTION</th>
            </thead>
            <tbody width="100%" cellspacing="10">
                <?php
                $id = 1;
                foreach ($read as $reader):
                    ?>
                    <tr cellspacing="10">
                        <td>
                            <p>
                                <?= $id ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?= $reader['username'] ?>
                            </p>
                        </td>
                        <td>
                            <img src="../.temp/<?= $reader['pp_user'] ?>" alt="photo profile pembaca" height="70">
                        </td>
                        <td class="limit">
                            <p>
                                <?= $reader['bukunya'] ?>
                            </p>
                        </td>
                        <td class="limit center">
                            <p>
                                <?= $reader['kategori'] ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?= $reader['tanggal_baca'] ?>
                            </p>
                        </td>
                        <td>
                            <button class="member" onclick="
                                    $.post('component/Data-Pembaca.php', { 
                                        rid: <?= $reader['id'] ?>
                                     });
                                     alert('Data berhasil dihapus!');
                                     $('#isi-data').load('component/result/reader.php?lim=' + $('#selection').val() + '&&page=<?= $halamanAktif ?>&&key=' + $('#search').val())
                                "><i class="fa-solid fa-delete-left"></i>
                            </button>
                        </td>
                    </tr>
                    <?php $id++; endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="description">
        <p>Showing
            <?= $id -= 1; ?> of
            <?= $dataPerHalaman ?> entries
        </p>

        <!-- Pagenation -->

        <div class="pagination">
            <?php if ($halamanAktif > 1): ?>
                <button class="left" onclick="
                $('.isi-data').load(
                    'component/result/reader.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif - 1 ?>&&key=<?= $keyword ?>'
                )">
                    <i class=" fa-solid fa-angle-left"></i>
                    Prev
                </button>
            <?php endif ?>
            <?php for ($i = 1; $i <= $halamanAktif; $i++): ?>
                <?php if ($i == $halamanAktif): ?>
                    <p class="amount-of-data">
                        <?= $i ?>
                    </p>
                <?php endif ?>
            <?php endfor ?>
            <?php if ($halamanAktif < $jumlahHalaman): ?>
                <button onclick="
                $('.isi-data').load(
                        'component/result/reader.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=<?= $keyword ?>'
                    )">
                    Next
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            <?php endif ?>
        </div>
    </div>
</div>