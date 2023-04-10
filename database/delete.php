<?php
require 'functions.php';

$id = $_GET["id"];

if (del($id) > 0) {
    echo "
    <script>
        alert('Data berhasil di hapus!');
        document.location.href = '../Home-Admin.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data gagal di hapus!');
        document.location.href = '../Home-Admin.php;
    </script>
    ";
}

?>