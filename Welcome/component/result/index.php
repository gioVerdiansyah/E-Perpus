<?php
require "../../../Admin/database/functions.php";

$dataPerHalaman = $_GET['lim'];
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;


$keyword = $_GET["key"];

$books = mysqli_query($db, "SELECT * FROM buku WHERE
judul_buku LIKE '%$keyword%' OR penulis LIKE '$keyword%' OR penerbit LIKE '$keyword%' ORDER BY id ASC LIMIT $awalData, $dataPerHalaman");
?>
<!-- isi data -->
<script src="JS/jquery-3.6.3.min.js"></script>
<div class="isi-data">
    <div class="data">
        <table width="100%">
            <thead width="100%">
                <th>NO</th>
                <th>THUMBNAIL</th>
                <th>JUDUL BUKU</th>
                <th>KATEGORI</th>
                <th>PENULIS</th>
                <th>PENERBIT</th>
                <th>ACTION</th>
            </thead>
            <tbody width="100%" cellspacing="10">
                <?php
                $num = 1;
                foreach ($books as $book):
                    ?>
                    <tr cellspacing="10">
                        <td>
                            <?= $num ?>
                        </td>
                        <td>
                            <img src="../Admin/Temp/<?= $book["image"] ?>" alt="image_of_book" height="70" />
                        </td>
                        <td>
                            <p class="limit">
                                <?= $book['judul_buku'] ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?= $book['kategori'] ?>
                            </p>
                        </td>
                        <td>
                            <p class="limit">
                                <?= $book['penulis'] ?>
                            </p>
                        </td>
                        <td>
                            <p class="limit">
                                <?= $book['penerbit'] ?>
                            </p>
                        </td>
                        <td id="detail">
                            <button onclick="
                                $('.popup').load('component/result/fraction_group.php?bukid=<?= $book['id'] ?>');
                                $('.popup').removeAttr('hidden');
                                "><i class="fa-solid fa-chart-simple"></i>Detail</button>
                        </td>
                    </tr>
                    <?php
                    $num++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="description">
        <p>Showing
            <?= $num -= 1; ?> of
            <?= $dataPerHalaman ?> entries
        </p>

        <!-- Pagenation -->

        <div class="pagination">
            <?php if ($halamanAktif > 1): ?>
                <button class="left" onclick="
                $('.isi-data').load(
                    'component/result/index.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif - 1 ?>&&key=<?= $keyword ?>'
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
                        'component/result/index.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=<?= $keyword ?>'
                    )">
                    Next
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            <?php endif ?>
        </div>
    </div>
</div>