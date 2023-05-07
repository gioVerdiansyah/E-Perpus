<?php
require_once __DIR__ . '/vendor/autoload.php';
require '../../database/functions.php';
if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../../login-admin.php");
    exit;
}

$dataPerHalaman = $_GET['lim'];
$jumlahData = count(query("SELECT * FROM pembaca"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;


$keyword = $_GET["key"];

$read = mysqli_query($db, "SELECT * FROM pembaca WHERE
bukunya LIKE '%$keyword%' OR username LIKE '$keyword%' OR tanggal_baca LIKE '$keyword%' ORDER BY id DESC LIMIT $awalData, $dataPerHalaman");

$html = '
<table width="100%">
<tr>
        <th>NO</th>
        <th>PEMINJAM</th>
        <th>PP PEMINJAM</th>
        <th>JUDUL BUKU</th>
        <th>KATEGORI</th>
        <th>TGL PINJAM</th>
    </tr>';
$id = 1;
foreach ($read as $reader) {
    $html .= '
<tr cellspacing="10">
    <td>
        <p>
            ' . $id . '
</p>
</td>
<td>
    <p>
        ' . $reader["username"] . '
    </p>
</td>
<td>
    <img src="../../../.temp/' . $reader["pp_user"] . '" alt="photo profile pembaca" height="70">
</td>
<td class="limit">
    <p>
        ' . $reader["bukunya"] . '
    </p>
</td>
<td class="limit center">
    <p>
        ' . $reader["kategori"] . '
    </p>
</td>
<td>
    <p>
        ' . $reader["tanggal_baca"] . '
    </p>
</td>
</tr>
';
}
;
$html .= '
</table>
<link rel="stylesheet" href="../../CSS/cetak.css">
<style>
table tr:nth-child(odd) {
    background-color: rgba(255, 255, 255, 0.8);
  }
  table tr td.center {
    text-align: center !important;
  }</style>
';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output("History_E-Perpus.pdf", "I");