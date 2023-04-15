<link rel="stylesheet" href="CSS/style-content.css">
<div class="title">
    <h1>Laporan</h1>
    <hr>
    <h2>Data Laporan <img src="assets/angle-small-right.svg" alt=""></h2>
    <h3>Index</h3>
</div>
<div class="download">
    <h3><i class="fi fi-rr-download"></i> Download Data Peminjaman (PDF)</h3>
</div>
<!-- ini.isi -->
<div class="card-wrapper penulis">
    <div class="data-wrapper">
        <div class="data-indicator">
            <div class="data-entries">
                <p>show</p>
                <select>
                    <option value="10">10</option>
                    <option value="5">5</option>
                    <option value="2">2</option>
                </select>
                <p>entries</p>
            </div>
            <div class="data-search">
                <label for="search">Search:</label>
                <input type="search" name="search" id="search">
            </div>
        </div>
        <!-- isi data -->
        <div class="isi-data">
            <div class="data">
                <table width="100%">
                    <thead width="100%">
                        <th>NO</th>
                        <th>PEMINJAM</th>
                        <th>JUDUL BUKU</th>
                        <th>KATEGORI</th>
                        <th>TGL PINJAM</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody width="100%" cellspacing="10">
                        <tr cellspacing="10">
                            <td>1</td>
                            <td>verdi</td>
                            <td>Hello World</td>
                            <td>Pemrograman</td>
                            <td>2021-05-25</td>
                            <td>
                                <a href=""><i class="fa-solid fa-delete-left"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="description">
                <p>Showing 1 to 2 of 2 entries</p>
                <div class="pagination">
                    <p>
                        <i class="fa-solid fa-angle-left"></i>
                        Previous
                    </p>
                    <p class="amount-of-data">1</p>
                    <p>
                        Next
                        <i class="fa-solid fa-angle-right"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>