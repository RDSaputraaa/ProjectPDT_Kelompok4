<?php
include 'koneksi.php'; // Pakai file koneksi yang sudah ada

// Logika panggil Procedure Tambah Buku
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $stok = $_POST['stok'];
    $kat = $_POST['id_kategori'];
    mysqli_query($conn, "CALL tambah_buku('$judul', $stok, $kat)");
    echo "Buku berhasil ditambah lewat Procedure!";
}
?>

<h2>Admin - Kelola Buku (Stored Procedure)</h2>
<form method="POST">
    <input type="text" name="judul" placeholder="Judul Buku" required>
    <input type="number" name="stok" placeholder="Stok" required>
    <input type="number" name="id_kategori" placeholder="ID Kategori (1-5)" required>
    <button type="submit" name="tambah">Tambah via Procedure</button>
</form>
