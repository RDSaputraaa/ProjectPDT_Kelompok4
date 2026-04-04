<?php
include 'koneksi.php';

if (!isset($_POST['id_buku'])) {
    echo "Akses tidak valid";
    exit;
}

$id_buku = $_POST['id_buku'];

mysqli_begin_transaction($conn);

try {

    $cek = mysqli_query($conn, "SELECT stok FROM buku WHERE id_buku='$id_buku' FOR UPDATE");
    $data = mysqli_fetch_assoc($cek);

    if (!$data) {
        mysqli_rollback($conn);
        echo "Buku tidak ditemukan";
        exit;
    }

    if ($data['stok'] > 0) {

        mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'");

        mysqli_query($conn, "INSERT INTO peminjaman (id_anggota, tanggal) VALUES (1, CURDATE())");

        $id_pinjam = mysqli_insert_id($conn);

        mysqli_query($conn, "INSERT INTO detail_pinjam (id_pinjam, id_buku) VALUES ('$id_pinjam', '$id_buku')");

        mysqli_commit($conn);

        echo "<h3>Transaksi berhasil</h3>";

    } else {

        mysqli_rollback($conn);
        echo "<h3>Transaksi gagal, stok habis</h3>";
    }

} catch (Exception $e) {

    mysqli_rollback($conn);
    echo "<h3>Error, transaksi dibatalkan</h3>";
}
?>