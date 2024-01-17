<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Peminjaman Buku dan Detail Peminjaman</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Form Peminjaman Buku dan Detail Peminjaman</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <div class="form-container">
                <!-- Formulir Tambah Data -->
                <form action="proses_tambahtransaksi.php" method="POST" class="add-form">
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam:</label>
                        <select name="nama_peminjam" id="nama_peminjam">
                        <?php
                                include('koneksi.php');

                                // Ambil data dari tabel mobil (gantilah sesuai dengan tabel dan kolom di database Anda)
                                $query = "SELECT PeminjamID, NamaPeminjam FROM peminjam";
                                $result = mysqli_query($koneksi, $query);

                                // Tampilkan opsi berdasarkan data yang diambil
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['PeminjamID']}'>{$row['NamaPeminjam']}</option>";
                                }

                                // Tutup koneksi
                                mysqli_close($koneksi);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali:</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali">
                    </div>
                    <div class="form-group">
                        <label for="buku_dipinjam">Buku yang Dipinjam:</label>
                        <select name="buku_dipinjam" id="buku_dipinjam">
                        <?php
                                include('koneksi.php');

                                // Ambil data dari tabel mobil (gantilah sesuai dengan tabel dan kolom di database Anda)
                                $query = "SELECT BukuID, Judul FROM buku";
                                $result = mysqli_query($koneksi, $query);

                                // Tampilkan opsi berdasarkan data yang diambil
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['BukuID']}'>{$row['Judul']}</option>";
                                }

                                // Tutup koneksi
                                mysqli_close($koneksi);
                            ?>
                        </select>
                        <button type="button" onclick="tambahJudulBuku()">Tambah Buku</button>
                    </div>
                    <div class="form-group">
                        <table class="responsive-table" id="tabelBukuDipinjam">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </table>
                    </div>
                    <button type="submit">Tambah</button>
                </form>
            </div>
        </section>
        <script src="script.js"></script>
        <script>
            var counter = 1; // Counter untuk nomor urut

            function tambahJudulBuku() {
                var selectedBook = document.getElementById("buku_dipinjam");
                var selectedBookText = selectedBook.options[selectedBook.selectedIndex].text;

                // Buat elemen baris baru untuk tabel
                var newRow = document.createElement("tr");

                // Kolom Nomor
                var cellNo = document.createElement("td");
                cellNo.innerHTML = counter;
                newRow.appendChild(cellNo);

                // Kolom Judul Buku
                var cellTitle = document.createElement("td");
                cellTitle.innerHTML = selectedBookText;
                newRow.appendChild(cellTitle);

                // Kolom Aksi
                var cellAction = document.createElement("td");
                cellAction.innerHTML = '<a href="#" onclick="hapusJudulBuku(this)">Hapus</a>';
                newRow.appendChild(cellAction);

                // Tambahkan baris ke dalam tabel
                document.getElementById("tabelBukuDipinjam").appendChild(newRow);

                // Tingkatkan counter
                counter++;

                // Reset nilai select setelah ditambahkan
                selectedBook.selectedIndex = 0;
            }

            function hapusJudulBuku(row) {
                var index = row.parentNode.parentNode.rowIndex;
                document.getElementById("tabelBukuDipinjam").deleteRow(index);
            }
        </script>
    </body>
</html>
