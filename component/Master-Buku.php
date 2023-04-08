<?php
require '../database/functions.php';
$books = mysqli_query($db, 'SELECT * FROM buku ORDER BY id ASC');
?>



<link rel="stylesheet" href="CSS/style-content.css">
<div class="title">
    <h1>Buku</h1>
    <hr>
    <h2>Data Buku <img src="assets/angle-small-right.svg" alt=""></h2>
    <h3>Index</h3>
</div>
<!-- ini.isi -->
<div class="card-wrapper">
    <a href="database/insert.php" target="_blank" rel="noopener noreferrer">
        <button class="tambah"><i class="fa-solid fa-plus"></i>Tambah</button>
    </a>
    <div class="data-wrapper">
        <div class="data-indicator">
            <div class="data-entries">
                <p>show</p>
                <select id="selection">
                    <option value="10">10</option>
                    <option value="5">5</option>
                    <option value="1">1</option>
                </select>
                <p>entries</p>
            </div>
            <div class="data-search">
                <label for="search">Search:</label>
                <input type="search" name="" id="">
            </div>
        </div>
        <!-- isi data -->
        <div class="isi-data" id="isi-data">
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
                            <img src="Temp/<?= $book['image'] ?>" alt="Thumbnail" height="70">
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
                    <?= $id -= 1; ?> of 2 entries
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
    </div>
</div>
<script src="../JS/jquery-3.6.3.min.js">
$(document).ready(function() {
    $("#selection").on("change", function() {
        let value = $(this).val();

        // $.get("component/pagenation/index.php?lim=" + value, (data) => {
        //     $("#isi-data").html(data);
        // })
        // $.ajax({
        //     type: "GET",
        //     url: "pagenation/index.php",
        //     data: {
        //         selectedValue: selectedValue
        //     },
        //     success: function(response) {
        //         console.log(response);
        //     }
        // });

        $("body").addClass("test");
    })
})
</script>