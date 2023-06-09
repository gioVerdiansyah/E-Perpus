<?php
if (!isset($_SESSION["login-user"]) && !isset($_COOKIE["UUsSRlGnEQthORoe"]) && !isset($_COOKIE["UDsSRlGnEQthORue"])) {
    header("Location: ../../index.php");
    exit;
}
?>

<link rel="stylesheet" href="CSS/User/History.css" />

<div class="isi-data" id="isi-data">
    <div class="data-indicator">
        <button id="button" onclick="
    localStorage.clear();
  $('main').load('component/History.php');
  $('*').removeClass('on');
  $('#riwayat').addClass('on');
  ">
            Hapus Riwayat <i class="fa-solid fa-trash"></i>
        </button>
    </div>
    <div class="data" id="data">
        <div id="masuk"></div>
        <div id="keluar"></div>
        <div id="membaca"></div>
    </div>
</div>
<script>
    function showHistory() {
        if (typeof Storage !== "undefined") {
            let historyData = JSON.parse(
                localStorage.getItem("HISTORY_E-PERPUS_MEJAYAN")
            ) || [
                    [],
                    [],
                    []
                ];

            let result = {
                enter: historyData[0],
                out: historyData[1],
                read: historyData[2],
            };

            return result;
        } else {
            return [
                [],
                [],
                []
            ];
        }
    }

    function renderHistory() {
        const historyDataEnter = showHistory().enter;
        const historyDataOut = showHistory().out;
        const historyDataRead = showHistory().read;
        let historyListEnter = document.querySelector("#isi-data .data #masuk");
        let historyListOut = document.querySelector("#isi-data .data #keluar");
        let historyListRead = document.querySelector("#isi-data .data #membaca");

        // selalu hapus konten HTML pada elemen historyList agar tidak menampilkan data ganda
        if (localStorage.getItem(CACHE_KEY) === null) {
            document.getElementById("button").style.display = "none";
            historyListEnter.innerHTML = "<h1>Masuk</h1> <h2>Belum ada data!</h2>";
            historyListRead.innerHTML =
                "<h1>Membaca Buku</h1> <h2>Tidak membaca buku</h2>";
            historyListOut.innerHTML = "<h1>Keluar</h1> <h2>Belum ada data!</h2>";
            $(".isi-data .data-indicator").html(
                "<button id='refresh-btn' onclick='location.reload();$(this).remove();'>Refresh <i class='fa-sharp fa-solid fa-arrows-rotate'></i></button>"
            );
        } else {
            $(document).ready(function () {
                $("#membaca div h2").css("padding", "19px 5px");
            });
            document.getElementById("button").style.display = "inherit";
            historyListEnter.innerHTML = "<h1>Masuk</h1>";
            historyListOut.innerHTML = "<h1>Keluar</h1>";
            historyListRead.innerHTML = "<h1>Membaca Buku</h1>";
        }

        function history(historyData, historyList, dataBuku) {
            if (dataBuku) {
                for (let history of historyDataRead) {
                    let row = document.createElement("div");
                    if (history.buku == null) {
                        row.innerHTML = "<h2>Tidak membaca buku</h2>";
                    } else {
                        row.innerHTML =
                            "<p>" + history.buku + "<br> Pada: " + history.value + "</p>";
                    }
                    historyListRead.appendChild(row);
                }
            } else {
                for (let history of historyData) {
                    let row = document.createElement("div");
                    row.innerHTML = "<p>" + history.value + "</p>";

                    historyList.appendChild(row);
                }
            }
        }

        history(historyDataEnter, historyListEnter, false);
        history(historyDataOut, historyListOut, false);
        history(historyDataRead, historyListRead, true);

        let historyDataHasBeenDeleted = false;
        try {
            let data = JSON.parse(localStorage.getItem(CACHE_KEY));
            if (data[2][0].name === "reading") {
                data.splice(2, 1, ["Tidak membaca buku"]);
                localStorage.setItem(CACHE_KEY, JSON.stringify(data));
            }
        } catch (e) {
            if (!historyDataHasBeenDeleted) {
                console.log("Data riwayat telah di hapus!");
                historyDataHasBeenDeleted = true;
            }
        }
    }
    renderHistory();
</script>