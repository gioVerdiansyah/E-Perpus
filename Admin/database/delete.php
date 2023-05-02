<?php
require 'functions.php';
if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../login-admin.php");
    exit;
}

$id = $_GET["id"];
$table = $_GET["table"];

if (del($id, $table) > 0) {
    echo "
    <script>
        alert('Data berhasil di hapus!');
        document.location.href = '../index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data gagal di hapus!');
        document.location.href = '../index.php;
    </script>
    ";
}

?>