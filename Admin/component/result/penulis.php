<?php
require '../../database/functions.php';



$dataPerHalaman = $_GET['lim'];
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

$key = $_GET["key"];

$write = mysqli_query($db, "SELECT * FROM buku WHERE penulis LIKE '%$key%' ORDER BY id DESC LIMIT $awalData, $dataPerHalaman");

?>
<script src="JS/jquery-3.6.3.min.js"></script>
<div class="isi-data" id="isi-data">
    <div class="data">
        <table width="100%">
            <thead width="100%">
                <th>NO</th>
                <th>NAMA PENULIS</th>
                <th>ACTION</th>
            </thead>
            <tbody width="100%" cellspacing="10">
                <?php
                $id = 1;
                foreach ($write as $writer):
                    ?>
                    <tr cellspacing="10">
                        <td>
                            <p>
                                <?= $id ?>
                            </p>
                        </td>
                        <td class="limit">
                            <p>
                                <?= $writer['penulis'] ?>
                            </p>
                        </td>
                        <td>
                            <button onclick="
                                $('.popup').load('../Welcome/component/result/fraction_group.php?bukid=<?= $writer['id'] ?>');
                                $('.popup').removeAttr('hidden');
                                "><i class="fa-solid fa-chart-simple"></i>Detail
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
                    'component/result/penulis.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif - 1 ?>&&key=<?= $key ?>'
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
                        'component/result/penulis.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=<?= $key ?>'
                    )">
                    Next
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            <?php endif ?>
        </div>
    </div>
</div>