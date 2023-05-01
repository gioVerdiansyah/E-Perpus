<?php
require 'functions.php';
if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../login-admin.php");
    exit;
}

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
    <style>
        ul li input {
            width: 30%;
        }
    </style>
    <ul style="list-style-type:none;">
        <input type="hidden" name="id" value="<?= $books['id'] ?>">
        <input type="hidden" name="oldImage" value="<?= $books['image'] ?>">
        <li>
            <label for="judul_buku">Judul Buku</label><br>
            <input type="text" name="judul_buku" id="judul_buku" maxlength="74" required
                value="<?= $books['judul_buku'] ?>">
        </li>
        <li>
            <label for="kategori">Kategori</label><br>
            <input type="text" name="kategori" id="kategori" maxlength="144" required value="<?= $books['kategori'] ?>">
        </li>

        <li>
            <label for="penulis">Penulis</label><br>
            <input type="text" name="penulis" id="penulis" maxlength="144" required value="<?= $books["penulis"] ?>">
        </li>

        <li>
            <label for="penerbit">Penerbit</label><br>
            <input type="text" name="penerbit" id="penerbit" maxlength="144" required value="<?= $books["penerbit"] ?>">
        </li>
        <li>
            <label for="tahun_terbit">Tahun Terbit</label><br>
            <input type="date" name="tahun_terbit" id="tahun_terbit" required value="<?= $books["tahun_terbit"] ?>">
        </li>
        <li>
            <label for="isbn">ISBN</label><br>
            <input type="text" name="isbn" id="isbn" maxlength="144" required value="<?= $books["isbn"] ?>">
        </li>
        <li>
            <label for="jumlah_halaman">Jumlah Halaman</label><br>
            <input type="number" name="jumlah_halaman" id="jumlah_halaman" required
                value="<?= $books["jumlah_halaman"] ?>">
        </li>
        <li>
            <label for="link" title="isi 404 jika E-Book tidak ada!">Link Buku</label><br>
            <input type="text" name="link" id="link" required value="<?= $books['link'] ?>">
        </li>
        <li>
            <label for="sinopsis">Sinopsis Buku</label><br>
            <textarea name="sinopsis" id="sinopsis" cols="70" rows="10"></textarea>
            <script>
                document.querySelector("textarea").value = "<?= $books["sinopsis"] ?>";
            </script>
        </li>
        <li>
            <label for="image">Thumbnail</label><br>
            <img src="../Temp/<?= $books['image'] ?>" id="img" alt="gambar sebelumnya" height="70"><br>
            <input type="file" name="image" id="image" onchange="
                    let img = document.querySelector('#img');
                    let input = document.querySelector('#gambar');
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                    ">
        </li>

        <li style="margin-top:5px;">
            <button type="submit" name="submit">Send</button>
            <button type="reset">Reset</button>
        </li>
    </ul>
</form>