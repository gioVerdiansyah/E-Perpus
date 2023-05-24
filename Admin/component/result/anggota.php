<?php
require '../../database/functions.php';

if (!isset($_SESSION["login"]) && !isset($_COOKIE["UIuDSteKukki"]) && !isset($_COOKIE["UNmeKySteKukki"])) {
    header("Location: ../login-admin.php");
    exit;
}

$ops = (isset($_GET['ops'])) ? $_GET['ops'] : 'loginuser';

$dataPerHalaman = $_GET['lim'];
$jumlahData = count(query("SELECT * FROM $ops"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;


$key = $_GET['key'];

$member = mysqli_query($db, "SELECT * FROM $ops WHERE username LIKE '%$key%' ORDER BY id DESC LIMIT $awalData,$dataPerHalaman");
?>

<script src="JS/jquery-3.6.3.min.js"></script>
<div class="isi-data" id="isi-data">
    <div class="data">
        <table width="100%" cols="7">
            <thead width="100%">
                <th>NO</th>
                <?php if ($_GET['ops'] === 'loginuser') { ?>
                    <th>PP ANGGOTA</th>
                <?php } else { ?>
                    <th>PP ADMIN</th>
                <?php } ?>
                <?php if ($_GET['ops'] === 'loginuser') { ?>
                    <th>NICKNAME USER</th>
                <?php } else { ?>
                    <th>NICKNAME ADMIN</th>
                <?php } ?>
                <th>ACTION</th>
            </thead>
            <tbody width="100%">
                <?php
                $id = 1;
                foreach ($member as $members):
                    ?>
                    <tr>
                        <td>
                            <?= $id ?>
                        </td>
                        <td>
                            <?php if ($_GET['ops'] === 'loginuser') { ?>
                                <img src="../.temp/<?= $members['gambar'] ?>" alt="Thumbnail" height="70">
                            <?php } else { ?>
                                <img src="Temp/<?= $members['gambar'] ?>" alt="Thumbnail" height="70">
                            <?php } ?>
                        </td>
                        <td class="limit">
                            <p>
                                <?= $members['username'] ?>
                            </p>
                        </td>
                        <td>
                            <button class="member" onclick="
                                    let isDelete = confirm('Apakah anda yakin ingin mengahpus akun: <?= $members['username'] ?>?');
                                    if(!isDelete){
                                        return;
                                    }
                                    $.post('component/Master-Anggota.php', { 
                                        id: '<?= $members['id'] ?>',
                                        ops: '<?= $ops ?>'
                                     });
                                     alert('Data berhasil dihapus!');
                                     $('#isi-data').load('component/result/anggota.php?ops=' + $('#opsi').val() + '&&lim=' + $('#selection').val() + '&&page=<?= $halamanAktif ?>&&key=' + $('#search').val())
                                ">
                                <i class="fa-solid fa-delete-left"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                    $id++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <div class="description">
        <p>Showing
            <?= $id -= 1; ?> of
            <?= $dataPerHalaman ?> entries
        </p>

        <!-- Pagenation -->

        <div class="pagination">
            <?php if ($halamanAktif > 1): ?>
                <button class="left" onclick="
                $('.isi-data').load(
                    'component/result/anggota.php?ops=<?= $ops ?>&&lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif - 1 ?>&&key=<?= $key ?>'
                )">
                    <i class=" fa-solid fa-angle-left"></i>
                    Prev
                </button>
            <?php endif ?>
            <?php for ($i = 1; $i <= $halamanAktif; $i++): ?>
                <?php if ($i == $halamanAktif): ?>
                    <p class="amount-of-data">
                        <?= $i ?>
                    </p>
                <?php endif ?>
            <?php endfor ?>
            <?php if ($halamanAktif < $jumlahHalaman): ?>
                <button onclick="
                $('.isi-data').load(
                        'component/result/anggota.php?ops=<?= $ops ?>&&lim=<?= $dataPerHalaman ?>&&page=<?= $halamanAktif + 1 ?>&&key=<?= $key ?>'
                    )">
                    Next
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            <?php endif ?>
        </div>
    </div>
</div>