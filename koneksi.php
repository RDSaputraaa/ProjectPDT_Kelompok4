<?php
$conn = mysqli_connect("localhost", "root", "", "perpustakaan_pdt");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
