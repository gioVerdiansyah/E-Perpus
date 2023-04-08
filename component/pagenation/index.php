<?php
require '../../database/functions.php';


$dataPerHalaman = $_GET['selectedValue'];
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;


$books = mysqli_query($db, "SELECT * FROM buku ORDER BY id ASC LIMIT $awalData, $dataPerHalaman");
?>
<!-- isi data -->
<div class="isi-data">
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
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href=""><i class="fa-solid fa-delete-left"></i></a>
                </td>
            </tr>
            <?php
                $id++;
            endforeach;
            ?>
        </tbody>
    </table>
    <div class="description">
        <p>Showing
            <?= $id -= 1; ?> of
            <?= $dataPerHalaman ?> entries
        </p>
        <div class="pagination">
            <p>
                <i class="fa-solid fa-angle-left"></i>
                Previous
            </p>
            <p class="amount-of-data">1</p>
            <p>
                Next
                <i class="fa-solid fa-angle-right"></i>
            </p>
        </div>
    </div>
</div>