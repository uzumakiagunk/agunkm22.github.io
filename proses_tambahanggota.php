<?php
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil nilai dari formulir tambah.php
    $nama_peminjam = $_POST['nama_peminjam'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // Query untuk menambahkan data ke dalam tabel buku
    $queryTambah = "INSERT INTO buku (NamaPeminjam, Alamat, NoTelepon) VALUES ('$nama_peminjam', '$alamat', '$no_telepon')";

    // Eksekusi query
    if (mysqli_query($koneksi, $queryTambah)) {
        // Jika berhasil, redirect ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi error, tampilkan pesan error
        echo "Error: " . $queryTambah . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika bukan metode POST, redirect ke halaman tambah.php
    header("Location: tambah.php");
    exit();
}
?>