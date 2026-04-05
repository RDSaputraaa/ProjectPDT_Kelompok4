<?php
include 'koneksi.php';
$p = $_GET['p'] ?? '';

if ($p == 'A') {
    mysqli_begin_transaction($conn);
    mysqli_query($conn, "UPDATE buku SET stok = 99 WHERE id_buku = 1");
    echo "Proses A: Mengunci Buku 1. Menunggu 5 detik...";
    sleep(5); 
    mysqli_query($conn, "UPDATE buku SET stok = 99 WHERE id_buku = 2");
    mysqli_commit($conn);
    echo " Selesai!";
} elseif ($p == 'B') {
    mysqli_begin_transaction($conn);
    mysqli_query($conn, "UPDATE buku SET stok = 88 WHERE id_buku = 2");
    echo "Proses B: Mengunci Buku 2. Mencoba akses Buku 1...";
    mysqli_query($conn, "UPDATE buku SET stok = 88 WHERE id_buku = 1");
    mysqli_commit($conn);
    echo " Selesai!";
} else {
    echo "<a href='?p=A' target='_blank'>Jalankan Proses A</a> | <a href='?p=B' target='_blank'>Jalankan Proses B</a>";
}
?>
