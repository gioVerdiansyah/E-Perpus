<?php
$db = mysqli_connect(
    "localhost",
    "root",
    "",
    "perpus"
);

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// INSERT
function insert($data)
{
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $image = upload();

    if (!$image) {
        return false;
    }

    global $db;
    $query = "INSERT INTO buku VALUES ('', '$judul_buku','$kategori','$penulis','$penerbit','$image')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function upload()
{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $fileError = $_FILES["image"]["error"];
    $fileTemp = $_FILES["image"]["tmp_name"];

    if ($fileError === 1) {
        echo "<script>alert('Masukkan gambar!');</script>";
        return false;
    }

    $extensionValid = ["jpg", "jpeg", "png"];
    $extensionFile = explode('.', $fileName);
    $extensionFile = strtolower(end($extensionFile));

    if (!in_array($extensionFile, $extensionValid)) {
        echo "
        <script>
            alert('masukkan ekstensi gambar: \"jpg\",\"jpeg\",\"png\"!');
        </script>";
        return false;
    }

    if ($fileSize > 10000000) {
        echo "
        <script>
            alert('gambar tidak boleh lebih 10MB');
        </script>";
        return false;
    }

    $fileGenerateName = uniqid() . "." . $extensionFile;

    move_uploaded_file($fileTemp, "../Temp/" . $fileGenerateName);
    return $fileGenerateName;
}
?>