<?php
require 'functions.php';
if (isset($_POST['submit'])) {
    if (insert($_POST) > 0) {
        echo "<script>
        alert('Data berhasil di tambahkan!');
        document.location.href = '../Home-Admin.php';
        </script>";
    } else {
        echo "Data gagal di tambahkan" . "<br>" . mysqli_error($db);
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <ul style="list-style-type:none;">

        <li>
            <label for="judul_buku">Judul Buku</label><br>
            <input type="text" name="judul_buku" id="judul_buku" required>
        </li>

        <li>
            <label for="kategori">Kategori</label><br>
            <input type="text" name="kategori" id="kategori" required>
        </li>

        <li>
            <label for="penulis">Penulis</label><br>
            <input type="text" name="penulis" id="penulis" required>
        </li>

        <li>
            <label for="penerbit">Penerbit</label><br>
            <input type="text" name="penerbit" id="penerbit" required>
        </li>

        <li>
            <label for="image">Thumbnail</label><br>
            <input type="file" name="image" id="image" required>
        </li>

        <li style="margin-top:5px;">
            <button type="submit" name="submit">Send</button>
            <button type="reset">Reset</button>
        </li>

    </ul>
</form>