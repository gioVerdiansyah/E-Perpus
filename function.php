<?php
// koneksi ke databases
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

function register($data)
{
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    // strtolower() ini fungsi untuk mengubah huruf besar menjadi huruf kecil, stripslashes() ini fungsi untuk menghilangkan karaker unik dalam username
    $pass = mysqli_real_escape_string($db, $data["pass"]);
    // ini fungsi untuk memungkinkan si user untuk memasukkan password ada tanda kutipnya dan akan dimasukkan ke dalam DB secara aman
    $confirmPass = mysqli_real_escape_string($db, $data["confirmPass"]);


    // cek username sudah ada atau belum?
    $result = mysqli_query($db, "SELECT username FROM loginadmin WHERE username = '$username'");
    // cari data username dari tabel user dimana username = variabel username (TRUE)

    if (mysqli_fetch_assoc($result)) {
        // berarti TRUE dan arraynya ada isinya
        $err = "username sudah ada!";
        $_SESSION["error"] = $err;
        return false;
    }


    // cek konfirmasi password
    if ($pass !== $confirmPass) {
        $err = "password tidak sama!";
        $_SESSION["error"] = $err;
        return false; //supaya masuk kedalam else
    }

    // Enkripsi password
    // menggunakan fungsi password_hash() untuk mengenkripsi karena jika menggunakan md5 itu adalah versi lama dan mudah untuk diketahui, hanya memasukkan string enkripsinya di google
    $pass = password_hash($pass, PASSWORD_DEFAULT);


    // menambah kan ke dalam database
    mysqli_query($db, "INSERT INTO loginadmin VALUE(
        '', '$username', '$pass'
        )");

    return mysqli_affected_rows($db);
}