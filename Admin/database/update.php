<?php
require 'functions.php';

$id = $_GET["id"];

$books = query("SELECT * FROM buku WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (updt($_POST) > 0) {
        echo "<script>
        alert('Data berhasil di Ubah!');
        document.location.href = '../index.php';
        </script>";
    } else {
        echo "Data gagal di Ubah" . "<br>" . mysqli_error($db);
    }
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <ul style="list-style-type:none;">
        <input type="hidden" name="id" value="<?= $books['id'] ?>">
        <input type="hidden" name="oldImage" value="<?= $books['image'] ?>">
        <li>
            <label for="judul_buku">Judul Buku</label><br>
            <input type="text" name="judul_buku" id="judul_buku" required value="<?= $books['judul_buku'] ?>">
        </li>
        <li>
            <label for="kategori">Kategori</label><br>
            <input type="text" name="kategori" id="kategori" required value="<?= $books['kategori'] ?>">
        </li>

        <li>
            <label for="penulis">Penulis</label><br>
            <input type="text" name="penulis" id="penulis" required value="<?= $books["penulis"] ?>">
        </li>

        <li>
            <label for="penerbit">Penerbit</label><br>
            <input type="text" name="penerbit" id="penerbit" required value="<?= $books["penerbit"] ?>">
        </li>

        <li>
            <label for="image">Thumbnail</label><br>
            <img src="../Temp/<?= $books['image'] ?>" alt="gambar sebelumnya" height="70">
            <input type="file" name="image" id="image">
        </li>

        <li style="margin-top:5px;">
            <button type="submit" name="submit">Send</button>
            <button type="reset">Reset</button>
        </li>
    </ul>
</form>