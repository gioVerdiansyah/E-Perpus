<?php
require '../../database/functions.php';

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
                $id = 1;
                foreach ($books as $book):
                    ?>
                    <tr cellspacing="10">
                        <td>
                            <?= $id ?>
                        </td>
                        <td>
                            <img src="Temp/<?= $book['image'] ?>" alt=" Thumbnail" height="70">
                        </td>
                        <td style="width:16%; text-align:left;">
                            <?= $book['judul_buku'] ?>
                        </td>
                        <td>
                            <?= $book['kategori'] ?>
                        </td>
                        <td>
                            <?= $book['penulis'] ?>
                        </td>
                        <td>
                            <?= $book['penerbit'] ?>
                        </td>
                        <td>
                            <a href="database/update.php?id=<?= $book['id'] ?>"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="database/delete.php?id=<?= $book['id'] ?>"><i class="fa-solid fa-delete-left"></i></a>
                        </td>
                    </tr>
                    <?php
                    $id++;
                endforeach;
                ?>
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