<?php
session_name("SESSILGN");
session_start();
require "../../Admin/database/functions.php";

if (!isset($_SESSION["login-user"]) && !isset($_COOKIE["UUsSRlGnEQthORoe"]) && !isset($_COOKIE["UDsSRlGnEQthORue"])) {
    header("Location: ../../index.php");
    exit;
}

$dataPerHalaman = (isset($_GET['lim'])) ? $_GET['lim'] : 10;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$id = $_COOKIE["UUsSRlGnEQthORoe"];
$key = $_COOKIE["UDsSRlGnEQthORue"];

// cek username berdasarkan id
$result = mysqli_query(mysqli_connect("localhost", "root", "", "perpus"), "SELECT * FROM loginuser WHERE id='$id'");
$row = mysqli_fetch_assoc($result); //ambil
$username = '';
$rowGambar = $row['gambar'];

// cek COOKIE dan username
if ($key === hash("sha512", $row["username"])) {
    $username = $row["username"];
}


$buku = mysqli_query($db, "SELECT * FROM buku ORDER BY id  ASC LIMIT $dataPerHalaman");
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['userMembaca'])) {
    $bukunya = $_POST['bukunya'];
    $kategori = $_POST['kategori'];
    $date = date("H:i/d/m/Y");

    $dataPembaca = "INSERT INTO pembaca VALUES('', '$rowGambar', '$username', '$bukunya', '$kategori', '$date')";
    mysqli_query($db, $dataPembaca);
}

?>

<link rel="stylesheet" href="CSS/User/Buku.css">
<link rel="stylesheet" href="CSS/User/Fraction_group.css" />
<div class="title">
    <h2>Cari Buku</h2>
    <p>Data di update secara otomatis</p>
</div>
</script>
<!-- ini.isi -->
<div class="data-wrapper">
    <div class="data-indicator">
        <div class="data-entries">
            <p>show</p>
            <select id="selection" name="selection"
                onchange="
                    let value = $(this).val();
                    $('#isi-data').load('component/result/index.php?lim=' + value + '&&page=<?= $halamanAktif ?>&&key=' + $('#search').val())">
                <option value="10">10</option>
                <option value="5">5</option>
                <option value="2">2</option>
            </select>
            <p>entries</p>
        </div>
        <div class="data-search">
            <label for="search">Search by</label>
            <input type="search" name="search" id="search" onkeyup="
            $('#isi-data').load(
                    'component/result/index.php?lim=' + $('#selection').val() + '&&page=<?= $halamanAktif ?>&&key=' + $(this).val()
                )
            " placeholder="judul buku/penulis/penerbit" />
        </div>
    </div>
    <!-- isi data -->
    <div class="isi-data" id="isi-data">
        <div class="data">
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
                <tbody>
                    <?php
                    $num = 1;
                    foreach ($buku as $books):
                        ?>
                    <tr>
                        <td>
                            <p>
                                <?= $num ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <img src="../Admin/Temp/<?= $books["image"] ?>"
                                    alt="image of book: <?= $books['judul_buku'] ?>" height="70" />
                            </p>
                        </td>
                        <td>
                            <p class="limit">
                                <?= $books["judul_buku"] ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <?= $books["kategori"] ?>
                            </p>
                        </td>
                        <td>
                            <p class="limit">
                                <?= $books["penulis"] ?>
                            </p>
                        </td>
                        <td>
                            <p class="limit">
                                <?= $books["penerbit"] ?>
                            </p>
                        </td>
                        <td id="detail">
                            <a href="<?= $books['link'] ?>" id="read-book">
                                <button onclick="
                                    let buku = '<?= $books['judul_buku'] ?>';
                                    let val = {buku: buku,value: date().khusus};
                                    putHistory(val, 2);
                                    $.post('component/Buku.php', { 
                                        userMembaca: true,
                                        bukunya: '<?= $books['judul_buku'] ?>',
                                        kategori: '<?= $books['kategori'] ?>'
                                     });
                                " id="baca-buku">Baca Buku</button>
                            </a>
                            <button onclick="
                                $('.popup').load('component/result/fraction_group.php?bukid=<?= $books['id'] ?>');
                                $('.popup').removeAttr('hidden')
                                "><i class="fa-solid fa-chart-simple"></i>Detail</button>
                        </td>
                    </tr>
                    <?php $num++; endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <div class="description">
            <p>Showing
                <?= $num -= 1 ?> of 10 entries
            </p>
            <div class="pagination">
                <p class="amount-of-data">1</p>
                <?php if ($halamanAktif < $jumlahHalaman): ?>
                <button onclick="
                    $('.isi-data').load(
                        'component/result/index.php?lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=' + $('#search').val())'
                    )">
                    Next
                    <i class="fa-solid fa-angle-right"></i>
                </button>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>